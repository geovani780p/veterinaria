<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

   
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'geovani780p@gmail.com'],
            [
                'name' => 'leo',
                'password' => '123456', 
        );
    }
}
