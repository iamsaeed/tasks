<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TaskStatusSeeder::class,
        ]);

        Project::factory()->count(15)->create();
    }
}
