<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Question;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $csv_files = [
            base_path('soal_spmb_sma_2026_75_soal.csv'),
            base_path('soal_tpa.csv')
        ];

        foreach ($csv_files as $csv_file) {
            if (file_exists($csv_file)) {
                $handle = fopen($csv_file, "r");
                $header = fgetcsv($handle, 1000, ",");
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (count($header) == count($data)) {
                        $row = array_combine($header, $data);
                        Question::updateOrCreate(['id' => $row['id']], [
                            'kategori' => $row['kategori'],
                            'mapel' => $row['mapel'],
                            'tingkat_kesulitan' => $row['tingkat_kesulitan'],
                            'soal' => $row['soal'],
                            'pilihan_a' => $row['pilihan_a'],
                            'pilihan_b' => $row['pilihan_b'],
                            'pilihan_c' => $row['pilihan_c'],
                            'pilihan_d' => $row['pilihan_d'],
                            'jawaban' => $row['jawaban'],
                            'bobot' => $row['bobot'],
                        ]);
                    }
                }
                fclose($handle);
            }
        }
    }
}
