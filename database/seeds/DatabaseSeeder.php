<?php

namespace Database\Seeders;
use Database\Seeders\RoleSeeder as SeedersRoleSeeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SeedersRoleSeeder::class);
    }
}
