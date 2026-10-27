<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'superadmin@enset.ma'],
            [
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
                'club_id' => null,
            ]
        );
    }
}
