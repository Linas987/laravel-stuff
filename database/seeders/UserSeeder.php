<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<99; $i++)
        {
            $x=Str::random(10);
            DB::table('users')->insert([
                'name' => Str::random(10),
                'surname' => Str::random(10),
                'username' => $x,
                'email' => $x . '@gmail.com',
                'password' => Hash::make($x),
                'updated_at'=>date('Y-m-d'),
                'created_at'=>date('Y-m-d')
            ]);
        }
    }
}
