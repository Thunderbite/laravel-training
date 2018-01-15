<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Prize;
use App\Models\PrizeDailyUsage;
use Illuminate\Console\Command;

class DailyResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thunderbite:daily-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all distributed prizes for a day, this has to run at 12:00 UK time';

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
        // Set some vars
        $date = Carbon::now()->yesterday();

        // Fetch all Prizes
        $prizes = Prize::all();

        // Loop over all prizes
        foreach ($prizes as $prize) {
            // Add daily entry
            PrizeDailyUsage::firstOrCreate([
                'prize_id' => $prize->id,
                'date' => $date->toDateString(),
                'used' => $prize->daily_usage,
            ]);

            // Now reset the prize
            $prize->update(['daily_usage' => 0]);
        }
    }
}
