<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Appelle ton seeder, par exemple SuperAdminSeeder
        $this->call([
            SuperAdminSeeder::class,
        ]);
    }
}
