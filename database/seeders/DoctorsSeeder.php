<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorsSeeder extends Seeder
{
    public function run()
    {
        //
        DB::table('doctors')->insert([
        [
          'id' =>'1',
          'name' => 'Jonas',
          'password'=> Hash::make('Jonas'),
          'email'=>'Jonas@gmail.com',
          'occupation'=>'Okulistas',
          'surname'=>'Jonavicius',
          'username'=>'Jonas',
        ],
        [
          'id' =>'2',
          'name' => 'Jurgis',
          'password'=> Hash::make('Jurgis'),
          'email'=>'Jurgis@gmail.com',
          'occupation'=>'Proktologas',
          'surname'=>'Jurgaitis',
          'username'=>'Jurgis',
        ],
        [
          'id' =>'3',
          'name' => 'Ziedas',
          'password'=> Hash::make('Ziedas'),
          'email'=>'Ziedas@gmail.com',
          'occupation'=>'Gastroenterologas',
          'surname'=>'Zeiba',
          'username'=>'Ziedas',
        ]
      ]);

    }
}
