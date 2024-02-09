<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s', time()),
                'password' =>  Hash::make('admin123'),
                'occupation' => 'System Engineer',
                'is_admin' => '1',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s', time()),
                'password' =>  Hash::make('user123'),
                'occupation' => 'Product Manager',
                'is_admin' => '0',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ]
        ];

        User::insert($users);
    }
}
