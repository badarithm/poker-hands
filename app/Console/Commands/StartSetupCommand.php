<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will help to setup all required parts.';

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
        $this->confirm('Please confirm that you want to actually apply these changes.');

    }
}
