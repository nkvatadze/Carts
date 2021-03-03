<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $user = User::where('role_id', Role::ADMIN)->firstOrFail();
        \App\Models\Product::factory(20)->for($user)->create();
        \App\Models\UserProductGroup::factory(20)->for($user)->create();
    }
}
