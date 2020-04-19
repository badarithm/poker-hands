<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

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
     * This is just to speed up setup for whoever is checking.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Will create local database inside project, apply migrations and create user account. Then it will ask for port number and start local development server. Please confirm.')) {
            $this->info('Creating application key...');
            Artisan::call('create-env-file');
            Artisan::call('key:generate');
            $this->info('Will create SQLite database...');
            Artisan::call('create-local-database');
            $this->info('Created SQLite database.');
            $this->info('Will migrate database tables...');
            Artisan::call('migrate:fresh');
            $this->info('Migrations were completed.');
            $this->info('Will create default user account.');

            $name = $this->getInput('Please enter your name. One letter is considered sufficient.');
            $surname = $this->getInput('Please enter your surname. Again, letter is considered sufficient.');
            $email = $this->getEmail();
            $password = $this->getPassword();
            User::create([
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $this->info("User {$email} was created.");
            $this->info('Setup is ready.');
            $this->info('Will start local development server now.');
            $port = $this->getPort();
            Artisan::call("serve --port={$port}");

        } else {
            $this->info('You chose no to proceed. No changes were applied.');
        }
    }

    protected function getEmail(): string
    {
        $email = $this->ask('Please enter email for admin user.');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->getEmail();
        }
        return $email;
    }

    public function getPassword(): string
    {
        $password = $this->secret('Please enter password. Should consist of at least 6 letters and / or numbers.');
        if (!ctype_alnum($password) && 6 >= strlen(trim($password))) {
            return $this->getPassword();
        }
        return $password;
    }

    public function getInput(string $message): string
    {
        $input = $this->ask($message);
        if (!ctype_alpha($input) && 1 >= strlen(trim($input))) {
            return $this->getInput($message);
        }
        return $input;
    }

    public function getPort(): string
    {
        $input = $this->ask('Please provide port number that is available on your local machine.');
        if (!ctype_digit($input) && 1 >= strlen(trim($input))) {
            return $this->getPort();
        }
        return $input;
    }
}
