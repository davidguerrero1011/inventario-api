<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class GeneralAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'Administrador General',
            'email' => 'admingeneral@ejemplo.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin'
        ]);
    }
}
