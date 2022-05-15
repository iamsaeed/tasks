<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['user', 'ahmad', 'saeed', 'hulkapps'];

        foreach($users as $u)
        {
            $user = new \App\Models\User;
            $user->name = ucfirst($u);
            $user->email = $u.'@app.com';
            $user->password = bcrypt('task@123');
            $user->save();
        }
    }
}
