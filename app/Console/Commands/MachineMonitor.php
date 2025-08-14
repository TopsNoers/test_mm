<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Handler\SetupMechine;
use App\Console\Handler\Readings;

class MachineMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'machine:monitor
        {--setup : Buat tabel database dan tambah 3 mesin contoh}
        {--add-reading : Tambah pembacaan baru untuk mesin tertentu}
        {machine_id? : ID mesin untuk pembacaan}
        {--simulate : Generate pembacaan acak (default: 10)}
        {simulate_count? : Jumlah pembacaan acak}
        {--status : Tampilkan semua mesin dengan data terbaru}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor the machine and save the readings to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('setup')) {
            $setup = new SetupMechine();
            $setup->runSetup($this);
            return;
        }

        if ($this->option('add-reading')) {
            $machineId = $this->argument('machine_id');
            $readings = new Readings();
            $readings->runReadings($this, $machineId);
            return;
        }

        if ($this->option('simulate')) {
            $count = $this->argument('simulate_count');
            $readings = new Readings();
            $readings->runSimulate($this, $count);
            return;
        }

        $this->info('No valid options provided');
        $this->runHelp();
    }

    private function runHelp()
    {
        $this->info('Usage: php artisan machine:monitor [options]');
        $this->info('Options:');
        $this->info('  --setup : Buat tabel database dan tambah 3 mesin contoh');
        $this->info('  --add-reading= : Tambah pembacaan baru untuk mesin tertentu');
        $this->info('  --simulate= : Generate pembacaan acak (default: 10)');
        $this->info('  --status : Tampilkan semua mesin dengan data terbaru');
    }
}
