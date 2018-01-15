<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Target;
use App\Models\Setting;
use Illuminate\Console\Command;
use App\Models\TargetImportQueue;
use Illuminate\Support\Facades\DB;

class TargetImportQueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thunderbite:import-targets-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import target files';

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
            'name' => 'target_import_queue_running',
        ]);

        // If not running, continue
        if (null === $running->value) {
            $running->update(['value' => 1]);
        } else {
            $this->info('Target importer is still running... stopping!');

            return;
        }

        // Check if we have an open file to import
        $files = TargetImportQueue::whereNull('done')->get();

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
                $yesterday = Carbon::now()->yesterday()->toDateString();
                $pdo = DB::connection()->getPdo();
                $pdo->exec("LOAD DATA LOCAL INFILE '".$filePath."'
                    INTO TABLE targets
                    FIELDS TERMINATED BY ','
                    LINES TERMINATED BY '\\n'
                    IGNORE 1 LINES
                    (whid, @date, @created_at, @updated_at)
                    SET date='".$yesterday."', created_at='".$now."', updated_at='".$now."'");

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
