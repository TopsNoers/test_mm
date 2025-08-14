<?php

namespace App\Console\Handler;

use App\Models\Machines;

class SetupMechine
{
    public function runSetup($command)
    {
        $command->info('Running setup...');
        // run php artisan migrate
        $command->call('migrate');
        $command->info('Migration completed successfully');

        // run php artisan db:seed
        $command->call('db:seed', ['--class' => 'Mechines']);
        $command->info('Seeding completed successfully');
        $command->info('Setup completed successfully');
    }
}