<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => Role::ADMIN,
                'name' => 'admin'
            ],
            [
                'id' => Role::NORMAL,
                'name' => 'normal'
            ]
        ];
        foreach ($data as $role)
            Role::create($role);
    }
}
