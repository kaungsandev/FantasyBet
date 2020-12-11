<?php

namespace App\Console\Commands;

use App\Http\Controllers\FixtureController;
use Illuminate\Console\Command;

class ForceUpdateFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'force:getFixtures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force Update Fixutres to table';

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
        $forceUpdateFixture = new FixtureController();
        $forceUpdateFixture->getFixtureFromApi();
        return "Fixture added";
    }
}
