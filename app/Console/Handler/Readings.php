<?php

namespace App\Console\Handler;

use App\Models\Machines;
use App\Models\Readings as ReadingsModel;

class Readings
{
    public function runReadings($command, $machineId)
    {
        $command->info('Running add reading for machine: ' . $machineId);

        $machine = Machines::find($machineId);
        if (!$machine) {
            $command->error('Machine not found');
            return;
        }

        // input temperature and conveyor speed
        $temperature = $command->ask('Input Temperature (20-100°C):');
        $speedConveyor = $command->ask('Input Conveyor Speed (0.5-5.0 m/menit):');
        
        // ParameterRentang ValidKondisi Peringatan
        // Suhu20-100°CPeringatan jika > 80°C
        // Kecepatan Conveyor0.5-5.0 m/menitPeringatan jika < 1.0 atau > 4.0
        if ($temperature > 80) {
            $command->warn('Temperature is out of range');
        }

        if ($speedConveyor < 1.0) {
            $command->warn('Conveyor Speed is too low');
        }

        if ($speedConveyor > 4.0) {
            $command->warn('Conveyor Speed is too high');
        }

        // add reading to database
        $reading = new ReadingsModel();
        $reading->machine_id = $machineId;
        $reading->temperature = $temperature;
        $reading->conveyor_speed = $speedConveyor;
        $reading->recorded_at = now();
        $reading->save();

        $command->info('Reading added successfully');
    }

    public function runSimulate($command, $count)
    {
        // check if count is a number
        if (!is_numeric($count)) {
            $command->error('Count must be a number');
            return;
        }

        $command->info('Running simulate for random machine ' . $count . ' times');

        $machines = Machines::all();
        for ($i = 0; $i < $count; $i++) {
            $machine = $machines[rand(0, count($machines) - 1)];
            $temperature = rand(20, 100);
            $speedConveyor = rand(0.5, 5.0);

            // add reading to database
            $reading = new ReadingsModel();
            $reading->machine_id = $machine->id;
            $reading->temperature = $temperature;
            $reading->conveyor_speed = $speedConveyor;
            $reading->recorded_at = now();
            $reading->save();
        }

        $command->info('Simulate for random machine ' . $count . ' times completed');
    }
}