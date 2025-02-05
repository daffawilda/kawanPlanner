<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    public function run()
    {
        DB::table('soal')->insert([
            ['jurusan_id' => 1, 'pertanyaan' => 'Apakah Anda tertarik dengan pemrograman?'],
            ['jurusan_id' => 2, 'pertanyaan' => 'Apakah Anda suka menganalisis sistem bisnis dan data?'],
            ['jurusan_id' => 3, 'pertanyaan' => 'Apakah Anda tertarik dengan listrik dan elektronik?'],
        ]);
    }
}
