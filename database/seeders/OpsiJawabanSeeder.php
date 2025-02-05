<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpsiJawabanSeeder extends Seeder
{
    public function run()
    {
        DB::table('opsi_jawaban')->insert([
            // Soal 1 - Teknik Informatika
            ['soal_id' => 1, 'jawaban' => 'Ya', 'mata_pelajaran_id' => 1], // Jaringan Komputer
            ['soal_id' => 1, 'jawaban' => 'Tidak', 'mata_pelajaran_id' => 2], // Basis Data

            // Soal 2 - Sistem Informasi
            ['soal_id' => 2, 'jawaban' => 'Ya', 'mata_pelajaran_id' => 2], // Basis Data
            ['soal_id' => 2, 'jawaban' => 'Tidak', 'mata_pelajaran_id' => 3], // Elektronika Dasar

            // Soal 3 - Teknik Elektro
            ['soal_id' => 3, 'jawaban' => 'Ya', 'mata_pelajaran_id' => 3], // Elektronika Dasar
            ['soal_id' => 3, 'jawaban' => 'Tidak', 'mata_pelajaran_id' => 1], // Jaringan Komputer

            // Soal 4 - Sistem Informasi
            ['soal_id' => 4, 'jawaban' => 'Ya', 'mata_pelajaran_id' => 2], // Basis Data
            ['soal_id' => 4, 'jawaban' => 'Tidak', 'mata_pelajaran_id' => 1], // Jaringan Komputer

            // Soal 5 - Teknik Elektro
            ['soal_id' => 5, 'jawaban' => 'Ya', 'mata_pelajaran_id' => 3], // Elektronika Dasar
            ['soal_id' => 5, 'jawaban' => 'Tidak', 'mata_pelajaran_id' => 2], // Basis Data
        ]);
    }
}
