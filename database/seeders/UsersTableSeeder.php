<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'role_id' => Role::ADMIN,
            'email' => 'admin@example.com',
            'password' => bcrypt('!TestPassword123!')
        ]);
    }
}
