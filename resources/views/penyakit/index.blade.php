@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- HEADER -->
    <div class="mb-10 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
            Daftar Kelainan Mata
        </h2>
        <p class="text-gray-500 mt-2 text-sm md:text-base">
            Informasi singkat mengenai kelainan mata yang dapat dideteksi oleh sistem ini.
        </p>
    </div>

    @php
        $kelainans = [
            [
                'nama_penyakit' => 'Miopi',
                'deskripsi' => 'Miopi atau rabun jauh adalah kondisi dimana mata sulit melihat objek yang jauh dengan jelas.',
                'gejala_umum' => 'Penglihatan kabur saat melihat jauh, menyipitkan mata, sering mendekatkan objek, kesulitan melihat malam hari, sakit kepala saat fokus, mata cepat lelah, mata perih, sensitif cahaya',
                'saran_penanganan' => 'Periksa mata secara rutin dan gunakan kacamata sesuai ukuran. Istirahatkan mata setelah lama melihat layar dan gunakan pencahayaan yang cukup.'
            ],
            [
                'nama_penyakit' => 'Astigmatisme',
                'deskripsi' => 'Astigmatisme menyebabkan penglihatan tampak kabur atau berbayang karena bentuk kornea tidak sempurna.',
                'gejala_umum' => 'Tulisan berbayang, garis lurus tampak bengkok, penglihatan berubah, silau, sakit kepala, mata cepat lelah, mata perih, penglihatan kabur dekat dan jauh',
                'saran_penanganan' => 'Gunakan kacamata silinder sesuai hasil pemeriksaan. Hindari memaksakan mata dan lakukan kontrol mata secara berkala.'
            ],
            [
                'nama_penyakit' => 'Hipermetropi',
                'deskripsi' => 'Hipermetropi atau rabun dekat adalah kondisi dimana mata sulit melihat objek dekat.',
                'gejala_umum' => 'Kabur saat melihat dekat, sakit kepala saat membaca, mata lelah, mata perih, tulisan berbayang, sulit membaca redup, harus menjauhkan objek, fokus terganggu',
                'saran_penanganan' => 'Gunakan kacamata plus sesuai anjuran. Atur jarak baca dan hindari membaca di tempat gelap.'
            ],
            [
                'nama_penyakit' => 'Presbiopi',
                'deskripsi' => 'Presbiopi adalah penurunan kemampuan fokus dekat akibat faktor usia, biasanya di atas 40 tahun.',
                'gejala_umum' => 'Harus menjauhkan buku, mata lelah saat membaca, sulit fokus, kabur dekat, sakit kepala, mata lelah, sulit membaca redup, mata perih, silau',
                'saran_penanganan' => 'Gunakan kacamata baca sesuai kebutuhan. Lakukan pemeriksaan rutin dan gunakan pencahayaan yang baik saat membaca.'
            ],
        ];

        $icons = [
            'Miopi' => '🔭',
            'Astigmatisme' => '👁️‍🗨️',
            'Hipermetropi' => '📖',
            'Presbiopi' => '👓'
        ];
    @endphp

    <div class="space-y-8">

        @foreach($kelainans as $index => $penyakit)
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 border border-gray-100
                    transition hover:shadow-lg">

            <!-- TITLE -->
            <div class="flex items-center gap-3 mb-4">

                <div class="w-10 h-10 flex items-center justify-center 
                            bg-teal-100 text-teal-600 rounded-lg text-lg">
                    {{ $icons[$penyakit['nama_penyakit']] ?? '👁️' }}
                </div>

                <h3 class="text-lg md:text-xl font-semibold text-gray-800">
                    {{ $penyakit['nama_penyakit'] }}
                </h3>
            </div>

            <!-- DESKRIPSI -->
            <p class="text-gray-600 mb-4 leading-relaxed text-sm md:text-base">
                {{ $penyakit['deskripsi'] }}
            </p>

            <!-- GEJALA -->
            <div class="mb-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">
                    Gejala Umum:
                </h4>

                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $penyakit['gejala_umum']) as $g)
                        <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs md:text-sm">
                            {{ trim($g) }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- SARAN -->
            <div class="bg-teal-50 border border-teal-100 rounded-xl p-4">
                <h4 class="text-sm font-semibold text-teal-700 mb-1">
                    Saran Penanganan:
                </h4>

                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    {{ $penyakit['saran_penanganan'] }}
                </p>
            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection