<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            [
                'name' => 'Head of Department',
            ],
            [
                'name' => 'Senior Manager',
            ],
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'Joint Manager',
            ],
            [
                'name' => 'Assistant Manager',
            ],
            [
                'name' => 'Senior Engineer',
            ],
            [
                'name' => 'Junior Engineer',
            ],
            [
                'name' => 'Executive',
            ],
        ];
        foreach ($designations as $designation) {
            \App\Models\Designation::updateOrCreate(['name' => $designation['name']]);
        }
    }
        
    
}
