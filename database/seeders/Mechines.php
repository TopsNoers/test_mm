<?php

namespace Database\Seeders;

use App\Models\Machines;
use Illuminate\Database\Seeder;

class Mechines extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Machine 1',
                'location' => 'Location 1',
                'status' => 'Active',
            ],
            [
                'name' => 'Machine 2',
                'location' => 'Location 2',
                'status' => 'Active',
            ],
            [
                'name' => 'Machine 3',
                'location' => 'Location 3',
                'status' => 'Active',
            ],
        ];

        foreach ($data as $item) {
            Machines::create($item);
            echo "Machine created: " . $item['name'] . "\n";
        }
    }
}
