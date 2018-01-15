<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerImportQueue;

class CustomerImportQueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thunderbite:import-customers-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customer files';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Output info
        $this->info('Starting import script');

        // Check if the instance is still running, if so exit
        $running = Setting::firstOrCreate([
            'name' => 'customer_import_queue_running',
        ]);

        // If not running, continue
        if (null === $running->value) {
            $running->update(['value' => 1]);
        } else {
            $this->info('Customer importer is still running... stopping!');

            return;
        }

        // Check if we have an open file to import
        $files = CustomerImportQueue::whereNull('done')->get();

        // If we have files, loop through them
        if (count($files) > 0) {
            $this->info('Found '.count($files).' file(s) to import');
            $i = 1;

            foreach ($files as $file) {
                // Start with file
                $this->info('Starting with file '.$i);
                $file->update(['processing' => 1]);
                $filePath = storage_path('app/'.$file->file);

                //Load the file into a string
                $string = @file_get_contents($filePath);

                if (!$string) {
                    return $filePath;
                }

                //Convert all line-endings using regular expression
                $string = preg_replace('~\r\n?~', "\n", $string);
                file_put_contents($filePath, $string);

                // Run the query
                $now = Carbon::now()->toDateTimeString();
                $pdo = DB::connection()->getPdo();
                $pdo->exec("LOAD DATA LOCAL INFILE '".$filePath."'
                    INTO TABLE customers
                    FIELDS TERMINATED BY ','
                    LINES TERMINATED BY '\\n'
                    IGNORE 1 LINES
                    (whid, uvs, @created_at, @updated_at)
                    SET created_at='".$now."', updated_at='".$now."'");

                // Update queue row
                $file->fresh()->update([
                    'progress' => 100,
                    'processing' => null,
                    'done' => 1,
                ]);

                ++$i;
            }
        }

        // Output info
        $running->update(['value' => null]);
        $this->info('Done with the import script');
    }
}
