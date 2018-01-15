<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Prize;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thunderbite:prize-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test distribution of prizes';

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
        // Set vars
        $date = Carbon::parse('2017-12-24');
        $tests = 50000;
        $results = [];

        // Reset prizes
        $prizes = Prize::all();

        foreach ($prizes as $prize) {
            $prize->update(['daily_usage' => 0]);
        }

        // Now itterate as often as tests are needed
        for ($k = 0; $k < $tests; ++$k) {
            $redeemedPrizes = [];
            // $redeemedPrizes = ['11', '7', '1', '3', '5'];

            if ('2017-12-25' == $date->toDateString()) {
                $prize = Prize::where('xmas', 1)
                    ->first();
            } else {
                // Try to select a prize based on limits
                $prize = Prize::whereRaw('xmas = 0 AND (daily_limit > daily_usage OR daily_limit IS NULL)')
                    ->whereNotIn('id', $redeemedPrizes)
                    ->inRandomOrder()
                    ->first();

                // If we did not find a prize, we have to ignore the limits
                if (null === $prize) {
                    $prize = Prize::where('xmas', 0)
                        ->whereNotIn('id', $redeemedPrizes)
                        ->inRandomOrder()
                        ->first();
                }
            }

            // Prize has been selected, update the daily total
            $prize->update([
                'daily_usage' => $prize->daily_usage + 1,
            ]);

            // Now for the test results
            $results[$prize->id]['name'] = $prize->name;

            if (array_key_exists('count', $results[$prize->id])) {
                $results[$prize->id]['count'] += 1;
            } else {
                $results[$prize->id]['count'] = 1;
            }

            $results[$prize->id]['daily_limit'] = $prize->daily_limit;

            // $results[$result->id]['desired_weight'] = $result->weight.'%';
            // $percentage = ($results[$result->id]['count'] / $tests) * 100;
            // $results[$result->id]['actual_weight'] = $percentage.'%';
        }

        echo '<p>Test result for '.$tests.' games!</p>';

        echo '<pre>';
        print_r($results);
        echo '</pre>';
    }
}
