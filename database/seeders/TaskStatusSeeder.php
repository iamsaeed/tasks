<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Open', 'In Progress', 'Pending PR', 'QA', 'QA Fail', 'QA Pass', 'Completed', 'Pending Clarification'
        ];

        foreach($statuses as $status)
        {
            $taskStatus = new TaskStatus;
            $taskStatus->name = $status;
            $taskStatus->save();
        }
    }
}
