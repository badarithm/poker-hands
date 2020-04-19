<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateEnvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-env-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will copy default .env.default to .env.';

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
        if (file_exists('.env.example') && !file_exists('.env')) {
            $contents = file_get_contents('.env.example');
            $handle = fopen('.env', 'w+');
            fclose($handle);
            file_put_contents('.env', $contents);
        }
        return 0;
    }
}
