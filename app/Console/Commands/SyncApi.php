<?php

namespace App\Console\Commands;

use App\Console\Commands\Syncs\SyncComments;
use App\Console\Commands\Syncs\SyncPosts;
use App\Console\Commands\Syncs\SyncUsers;
use Illuminate\Console\Command;

class SyncApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:sync
                            {--users=10 : Maximum amounts of users to fetch}
                            {--posts=50 : Maximum amounts of users to fetch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch api and update a local database.';

    protected $syncs = [
        SyncUsers::class,
        SyncPosts::class,
        SyncComments::class,
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $time = $this->time(function () {
            $limits = [
                'users' => $this->option('users'),
                'posts' => $this->option('posts'),
            ];

            foreach ($this->syncs as $sync) {
                app()->call([new $sync($limits), 'handle']);
            }
        });

        $this->info("API synchronization completed successfully in $time seconds!");
    }

    /**
     * Calculate a given code execution time.
     *
     * @param $callback
     * @return float
     */
    protected function time(Callable $callback)
    {
        $start = microtime(true);
        $callback();
        $end = microtime(true);

        return round($end - $start, 1);
    }

}
