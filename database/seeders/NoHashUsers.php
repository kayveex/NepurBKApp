<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class NoHashUsers extends Seeder
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
                'password' =>'200902Rhesa',
                'role' => 'admin'
            ],
            [
                'username' => 'gurutest',
                'email' => 'gurutest@gmail.com',
                'password' =>'12345678',
                'role' => 'guru'
            ],
            [
                'username' => 'kepsektest',
                'email' => 'kepsektest@gmail.com',
                'password' =>'kepsektest',
                'role' => 'kepalaSekolah'
            ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
