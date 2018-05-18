<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MergeServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:merge_server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MU Merge Server';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $db = \DB::table('merge');
        // Get job
        $jobs = $db->where('status', 0)->get();
        \Log::info('Merge server data', $jobs->toArray());
        foreach ($jobs as $job) {
            \Log::info('Merge Server Date Condition: ' . (\date('Y-m-d H:i:00', \time()) == $job->time) ? 'true' : 'false');
            if (\date('Y-m-d H:i:00', \time()) == $job->time) {
                // Update status
                $db->where('id', $job->id)->update(['status' => 1]);

                // Execute
                $query = "?game={$job->game}&from={$job->from}&from_type={$job->from_type}&to={$job->to}&backup={$job->backup}";
                \Log::info('Run merge server:' . $query);
                \file_get_contents('http://' . $job->ip . '/merge/merge.php' . $query);
            }
        }
    }
}
