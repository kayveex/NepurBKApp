<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'adminkay',
                'email' => 'rhesakornelius@gmail.com',
                'password' =>bcrypt('200902Rhesa'),
                'role' => 'admin'
            ],
            [
                'username' => 'kepsektest',
                'email' => 'kepsektest@gmail.com',
                'password' =>bcrypt('kepsektest'),
                'role' => 'kepalaSekolah'
            ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
