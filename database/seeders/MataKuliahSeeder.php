<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        DB::table('mata_kuliah')->insert([
            [
                'nama_mk' => 'Pemrograman Web',
                'sks' => 3
            ],
            [
                'nama_mk' => 'Basis Data',
                'sks' => 3
            ],
            [
                'nama_mk' => 'Algoritma',
                'sks' => 2
            ]
        ]);
    }
}