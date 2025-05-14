<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name'        => 'completed',
            'description' => 'It means that the task has been completed',
            'color'       => '#4bb93b',  
        ]);

        Status::create([
            'name'        => 'pending',
            'description' => 'The task is waiting for an action or decision before it can be executed.',
            'color'       => '#FFEB3B',  
        ]);

        Status::create([
            'name'        => 'On Hold',
            'description' => 'The task is postponed for some reason',
            'color'       => '#FF9800',  
        ]);

        Status::create([
            'name'        => 'In Progress',
            'description' => 'The task is currently in progress.',
            'color'       => '#2196F3',  
        ]);

        Status::create([
            'name'        => 'Cancelled',
            'description' => 'The task has been canceled and will not be executed.',
            'color'       => '#F44336 ',  
        ]);
        }
}
