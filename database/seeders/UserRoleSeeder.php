<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'id' =>'1',
                'name' => 'Adminas',
                'password'=> Hash::make('Admin'),
                'email'=>'Admin@gmail.com',
                'surname'=>'Adminavicius',
                'username'=>'Admin',
                'updated_at'=>date('Y-m-d'),
                'created_at'=>date('Y-m-d')
            ]
        ]);
        DB::table('roles')->insert([
            [
                'id'=>1,
                'name'=>'admin',
                'guard_name'=>'web'
            ]
        ]);
        DB::table('permissions')->insert([
            [
                'id'=>1,
                'name'=>'create doctor',
                'guard_name'=>'web'
            ]
        ]);
        DB::table('user_has_roles')->insert([
            [
                'role_id'=>1,
                'model_type'=>'App\Models\User',
                'user_id'=>1
            ]
        ]);
        DB::table('user_has_permissions')->insert([
            [
                'permission_id'=>1,
                'model_type'=>'App\Models\User',
                'user_id'=>1
            ]
        ]);
    }
}
