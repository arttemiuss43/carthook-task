<?php

namespace App\Console\Commands;

use App\Console\Commands\Syncs\CommentsSync;
use App\Console\Commands\Syncs\PostsSync;
use App\Console\Commands\Syncs\UsersSync;
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
        UsersSync::class,
        PostsSync::class,
        CommentsSync::class,
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $limits = [
            'users' => $this->option('users'),
            'posts' => $this->option('posts'),
        ];

        foreach ($this->syncs as $sync) {
            app()->call([new $sync($limits), 'handle']);
        }

        $this->info('API synchronization completed successfully!');
    }

}
