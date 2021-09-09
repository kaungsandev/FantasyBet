<?php

namespace App\Console\Commands;

use App\Console\UpdateBetResultTask;
use App\Console\UpdateFixtureTask;
use App\Console\UpdateTeamsTask;
use Illuminate\Console\Command;

class UpdateDB extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Fixture and Bet Result';

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
     * @return int
     */
    public function handle()
    {
        echo("Updating teams' data ...\r\n");
        call_user_func(new UpdateTeamsTask);
        echo ("Updating fixture ...\r\n");
        call_user_func(new UpdateFixtureTask);
        echo ("Updating bet results ...\r\n");
        call_user_func(new UpdateBetResultTask);
        echo ("Database updated. \r\n");
        return 0;
    }
}
