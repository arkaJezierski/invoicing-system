<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class SetupProject extends Command
{
    protected $signature = 'project:setup {--dev} {--local} {--composer-dump} {--no-garbage} {--npm}';

    protected $description = 'Setup the project by copying .env, migrating, and seeding the database';

    public function handle()
    {

        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info('.env file created from .env.example');
            Artisan::call('key:generate');
            $this->info('App key generated');

            $dbPassword = $this->secret('Enter database password');
            $this->updateEnvFile('DB_PASSWORD', $dbPassword);
            $this->reloadConfig();
            $this->info('Database password set in .env file.');
        }

        $dbExists = $this->databaseExists();

        if (! $dbExists) {
            $this->info('Database does not exist. Running migrations...');
            Artisan::call('migrate', [], $this->output);
        } else {
            $this->info('Database exists. Running migrate:fresh...');
            Artisan::call('migrate:fresh', [], $this->output);
        }

        $this->info('Running database seeders...');
        Artisan::call('db:seed --admin', [], $this->output);
        Artisan::call('db:seed --prod', [], $this->output);

        if ($this->option('dev')) {
            Artisan::call('db:seed --dev', [], $this->output);
        }

        if ($this->option('local')) {
            Artisan::call('db:seed --local', [], $this->output);
        }

        $this->info('Running optimize:clear...');
        Artisan::call('optimize:clear', [], $this->output);

        if ($this->option('composer-dump')) {
            $this->info('Running composer dump-autoload...');
            $this->runProcess(['composer', 'dump-autoload']);
        }

        if ($this->option('npm')) {
            $this->runProcess(['npm', 'run', 'build']);
        }

        $this->info('Project setup completed.');

        echo "\r$this->logo";
        Artisan::call('inspire', [], $this->output);
        sleep(5);
        echo "\033[2J\033[H";

    }

    private function runProcess(array $command): void
    {
        $process = new Process($command);
        $process->setWorkingDirectory(base_path());

        if (Process::isTtySupported()) {
            $process->setTty(true);
        }

        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (! $process->isSuccessful()) {
            $this->error('Error running '.implode(' ', $command));
            exit(1);
        }
    }

    private function databaseExists(): bool
    {
        try {
            DB::connection()->getPdo();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function updateEnvFile($key, $value): void
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        if (preg_match("/^{$key}=.*/m", $envContent)) {
            $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envContent);
        } else {
            $envContent .= "\n{$key}={$value}\n";
        }

        File::put($envPath, $envContent);
    }

    private function reloadConfig(): void
    {
        Artisan::call('config:clear');
        Artisan::call('config:cache');

        config(['database.connections.pgsql.password' => env('DB_PASSWORD')]);
        DB::purge('pgsql');
    }

    private string $logo = "


              _             _                   _     _
             | |           (_)                 | |   (_)
   __ _      | |  ___  ____ _   ___  _ __  ___ | | __ _
  / _` | _   | | / _ \|_  /| | / _ \| '__|/ __|| |/ /| |
 | (_| || |__| ||  __/ / / | ||  __/| |   \__ \|   < | |
  \__,_| \____/  \___|/___||_| \___||_|   |___/|_|\_\|_|




    ";
}
