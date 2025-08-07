<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'Ganpati Industries',
            'email' => 'khushiagarwal6367@gamil.com',
            'password' => bcrypt('khushi@(6367)'),
            'mobile' => '6367600234',
            'address' => 'Ganpati Industries, Road Number 7, Industrial Area, Rani Bazar, Bikaner - 334001',
            'is_admin' => 1,
        ]);
    }
}
