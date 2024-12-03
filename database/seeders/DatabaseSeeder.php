<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'emaployee',
            'guard_name'=>User::class
        ]);
        // User::factory(10)->create();
        $this->call([
            UserSeed::class,
            TaskSeed::class,
        ]);
       
    }
}