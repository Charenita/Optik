<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@system.com'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        Penyakit::truncate();
        Gejala::truncate();
        Rule::truncate();

        $penyakits = [
            [
                'kode_penyakit' => 'P01',
                'nama_penyakit' => 'Miopi',
                'deskripsi' => 'Miopi atau rabun jauh adalah kelainan mata yang menyebabkan seseorang sulit melihat objek yang berada jauh dengan jelas, sedangkan objek dekat masih terlihat lebih jelas.',
                'gejala_umum' => 'Penglihatan kabur saat melihat jauh, menyipitkan mata saat melihat, sering mendekatkan objek saat melihat, kesulitan melihat saat malam hari, sakit kepala saat membaca atau fokus, mata cepat lelah atau tegang, mata terasa perih, sensitif terhadap cahaya',
                'saran_penanganan' => 'Disarankan melakukan pemeriksaan mata ke optik atau dokter mata untuk mengetahui ukuran minus yang sesuai. Gunakan kacamata atau lensa kontak sesuai hasil pemeriksaan, istirahatkan mata setelah menatap layar terlalu lama, dan gunakan pencahayaan yang cukup saat beraktivitas.',
            ],
            [
                'kode_penyakit' => 'P02',
                'nama_penyakit' => 'Astigmatisme',
                'deskripsi' => 'Astigmatisme adalah kelainan refraksi mata yang menyebabkan penglihatan tampak kabur, berbayang, atau tidak fokus, baik saat melihat objek dekat maupun jauh.',
                'gejala_umum' => 'Tulisan tampak berbayang atau ganda, garis lurus tampak bengkok, penglihatan berubah-ubah, sensitif terhadap cahaya, sakit kepala saat membaca atau fokus, mata cepat lelah atau tegang, mata terasa perih, penglihatan kabur saat melihat dekat, penglihatan kabur saat melihat jauh',
                'saran_penanganan' => 'Disarankan melakukan pemeriksaan mata untuk mengetahui apakah membutuhkan kacamata silinder. Hindari menggunakan kacamata tanpa pemeriksaan yang tepat, kurangi menatap layar terlalu lama tanpa jeda, dan lakukan kontrol ulang apabila penglihatan terasa berubah.',
            ],
            [
                'kode_penyakit' => 'P03',
                'nama_penyakit' => 'Hipermetropi',
                'deskripsi' => 'Hipermetropi atau rabun dekat adalah kelainan mata yang menyebabkan seseorang sulit melihat objek dekat dengan jelas. Kondisi ini sering membuat mata cepat lelah saat membaca atau menggunakan ponsel dalam jarak dekat.',
                'gejala_umum' => 'Penglihatan kabur saat melihat dekat, sakit kepala saat membaca atau fokus, mata cepat lelah atau tegang, mata terasa perih, tulisan tampak berbayang atau ganda, sulit membaca di tempat redup, harus menjauhkan buku atau HP, penglihatan berubah-ubah, sulit fokus berpindah jarak',
                'saran_penanganan' => 'Disarankan melakukan pemeriksaan mata untuk mengetahui apakah membutuhkan kacamata plus. Gunakan jarak baca yang nyaman, hindari membaca di tempat redup, beri jeda istirahat saat membaca atau menggunakan layar, dan periksa ke dokter mata jika keluhan sering disertai sakit kepala.',
            ],
            [
                'kode_penyakit' => 'P04',
                'nama_penyakit' => 'Presbiopi',
                'deskripsi' => 'Presbiopi adalah penurunan kemampuan mata untuk fokus pada objek dekat yang umumnya terjadi karena faktor usia, terutama setelah usia 40 tahun.',
                'gejala_umum' => 'Harus menjauhkan buku atau HP saat membaca, mata lelah saat membaca dekat pada usia di atas 40 tahun, sulit fokus berpindah jarak, penglihatan kabur saat melihat dekat, sakit kepala saat membaca atau fokus, mata cepat lelah atau tegang, sulit membaca di tempat redup, mata terasa perih, sensitif terhadap cahaya',
                'saran_penanganan' => 'Disarankan menggunakan kacamata baca sesuai hasil pemeriksaan. Hindari membeli kacamata baca hanya berdasarkan perkiraan ukuran, gunakan pencahayaan yang baik saat membaca, atur jarak baca dengan nyaman, dan lakukan pemeriksaan mata secara berkala.',
            ],
        ];

        foreach ($penyakits as $p) {
            Penyakit::create($p);
        }

        $gejalas = [
            ['kode_gejala' => 'G01', 'nama_gejala' => 'Penglihatan kabur saat melihat jauh'],
            ['kode_gejala' => 'G02', 'nama_gejala' => 'Penglihatan kabur saat melihat dekat'],
            ['kode_gejala' => 'G03', 'nama_gejala' => 'Tulisan tampak berbayang/ganda'],
            ['kode_gejala' => 'G04', 'nama_gejala' => 'Sakit kepala saat membaca/fokus'],
            ['kode_gejala' => 'G05', 'nama_gejala' => 'Mata cepat lelah atau tegang'],
            ['kode_gejala' => 'G06', 'nama_gejala' => 'Menyipitkan mata saat melihat'],
            ['kode_gejala' => 'G07', 'nama_gejala' => 'Sulit membaca di tempat redup'],
            ['kode_gejala' => 'G08', 'nama_gejala' => 'Harus menjauhkan buku/HP'],
            ['kode_gejala' => 'G09', 'nama_gejala' => 'Garis lurus tampak bengkok'],
            ['kode_gejala' => 'G10', 'nama_gejala' => 'Mata lelah saat membaca dekat usia >40'],
            ['kode_gejala' => 'G11', 'nama_gejala' => 'Sering mendekatkan objek saat melihat'],
            ['kode_gejala' => 'G12', 'nama_gejala' => 'Mata terasa perih'],
            ['kode_gejala' => 'G13', 'nama_gejala' => 'Penglihatan berubah-ubah'],
            ['kode_gejala' => 'G14', 'nama_gejala' => 'Sensitif terhadap cahaya/silau'],
            ['kode_gejala' => 'G15', 'nama_gejala' => 'Kesulitan melihat saat malam hari'],
            ['kode_gejala' => 'G16', 'nama_gejala' => 'Sulit fokus berpindah jarak'],
        ];

        foreach ($gejalas as $g) {
            Gejala::create($g);
        }

        $rules = [
            // Miopi
            ['penyakit_id' => 1, 'gejala_id' => 1, 'cf_value' => 1],
            ['penyakit_id' => 1, 'gejala_id' => 6, 'cf_value' => 1],
            ['penyakit_id' => 1, 'gejala_id' => 11, 'cf_value' => 1],
            ['penyakit_id' => 1, 'gejala_id' => 15, 'cf_value' => 0.8],
            ['penyakit_id' => 1, 'gejala_id' => 4, 'cf_value' => 0.4],
            ['penyakit_id' => 1, 'gejala_id' => 5, 'cf_value' => 0.4],
            ['penyakit_id' => 1, 'gejala_id' => 12, 'cf_value' => 0.4],
            ['penyakit_id' => 1, 'gejala_id' => 14, 'cf_value' => 0.4],

            // Astigmatisme
            ['penyakit_id' => 2, 'gejala_id' => 3, 'cf_value' => 1],
            ['penyakit_id' => 2, 'gejala_id' => 9, 'cf_value' => 1],
            ['penyakit_id' => 2, 'gejala_id' => 13, 'cf_value' => 0.8],
            ['penyakit_id' => 2, 'gejala_id' => 14, 'cf_value' => 0.8],
            ['penyakit_id' => 2, 'gejala_id' => 4, 'cf_value' => 0.6],
            ['penyakit_id' => 2, 'gejala_id' => 5, 'cf_value' => 0.6],
            ['penyakit_id' => 2, 'gejala_id' => 12, 'cf_value' => 0.6],
            ['penyakit_id' => 2, 'gejala_id' => 2, 'cf_value' => 0.4],
            ['penyakit_id' => 2, 'gejala_id' => 1, 'cf_value' => 0.4],

            // Hipermetropi
            ['penyakit_id' => 3, 'gejala_id' => 2, 'cf_value' => 0.8],
            ['penyakit_id' => 3, 'gejala_id' => 4, 'cf_value' => 0.8],
            ['penyakit_id' => 3, 'gejala_id' => 5, 'cf_value' => 0.8],
            ['penyakit_id' => 3, 'gejala_id' => 12, 'cf_value' => 0.8],
            ['penyakit_id' => 3, 'gejala_id' => 3, 'cf_value' => 0.4],
            ['penyakit_id' => 3, 'gejala_id' => 7, 'cf_value' => 0.4],
            ['penyakit_id' => 3, 'gejala_id' => 8, 'cf_value' => 0.4],
            ['penyakit_id' => 3, 'gejala_id' => 13, 'cf_value' => 0.4],
            ['penyakit_id' => 3, 'gejala_id' => 16, 'cf_value' => 0.4],

            // Presbiopi
            ['penyakit_id' => 4, 'gejala_id' => 8, 'cf_value' => 1],
            ['penyakit_id' => 4, 'gejala_id' => 10, 'cf_value' => 1],
            ['penyakit_id' => 4, 'gejala_id' => 16, 'cf_value' => 0.8],
            ['penyakit_id' => 4, 'gejala_id' => 2, 'cf_value' => 0.8],
            ['penyakit_id' => 4, 'gejala_id' => 4, 'cf_value' => 0.4],
            ['penyakit_id' => 4, 'gejala_id' => 5, 'cf_value' => 0.4],
            ['penyakit_id' => 4, 'gejala_id' => 7, 'cf_value' => 0.4],
            ['penyakit_id' => 4, 'gejala_id' => 12, 'cf_value' => 0.4],
            ['penyakit_id' => 4, 'gejala_id' => 14, 'cf_value' => 0.2],
        ];

        foreach ($rules as $r) {
            Rule::create($r);
        }
    }
}