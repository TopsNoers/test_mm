<?php

namespace App\Console\Handler;

use App\Models\Machines;
use App\Models\Readings as ReadingsModel;

class ReportMechines
{
    public function runReport($command)
    {
        $command->info('Running data terbaru dari mesin mesin yang sudah tersimpan di database');
        $machines = Machines::all();
        foreach ($machines as $machine) {
            $readings = ReadingsModel::where('machine_id', $machine->id)->orderBy('recorded_at', 'desc')->take(5)->get();
            // make table
            $command->info('Data terbaru dari mesin ' . $machine->name);
            if ($readings->count() > 0) {
            $command->table(
                ['Machine ID', 'Machine Name', 'Temperature', 'Conveyor Speed', 'Recorded At'],
                $readings->map(function ($reading) use ($machine) {
                    return [
                        $reading->machine_id,
                        $machine->name,
                        $reading->temperature,
                        $reading->conveyor_speed,
                        $reading->recorded_at,
                    ];
                })
            );
            } else {
                $command->info('Tidak ada data terbaru dari mesin ' . $machine->name);
            }
        }
    }
}