<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Machines;
use App\Console\Handler\SetupMechine;

class MachineMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'machine:monitor
        {--setup : Buat tabel database dan tambah 3 mesin contoh}
        {--add-reading= : Tambah pembacaan baru untuk mesin tertentu}
        {--simulate= : Generate pembacaan acak (default: 10)}
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
            $this->runSetup();
            return;
        }

        $this->info('No valid options provided');
        $this->runHelp();
    }

    private function runSetup()
    {
        $setup = new SetupMechine();
        $setup->runSetup($this);
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
