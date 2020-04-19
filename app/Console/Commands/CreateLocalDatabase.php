<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateLocalDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-local-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will create local database inside of the project.';

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
        $dbFilePath = database_path('database.sqlite');
        if (!file_exists($dbFilePath)) {
            $handle = fopen($dbFilePath, 'r+');
            fclose($handle);
        }
        return 0;
    }
}
