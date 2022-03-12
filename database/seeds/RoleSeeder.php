<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Roles;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles::truncate(); //xoa tat ca du lieu trong table
        Roles::create(['role'=>'ADMIN', 'name'=>'ADMIN']);
        Roles::create(['role'=>'USER', 'name'=>'MEMBER']);
        Roles::create(['role'=>'MOD', 'name'=>'MODERATOR']);
    }
}
