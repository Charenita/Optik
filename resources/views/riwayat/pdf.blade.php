<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Diagnosa</title>

    <style>
        @page {
            size: A4;
            margin: 16px 22px;
        }

        body {
            font-family: sans-serif;
            color: #333;
            font-size: 10.5px;
            line-height: 1.32;
            margin: 0;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #14b8a6;
            padding-bottom: 6px;
            margin-bottom: 9px;
        }

        .clinic-name {
            font-size: 19px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #0f766e;
        }

        .clinic-info {
            font-size: 9.5px;
            color: #555;
            line-height: 1.3;
        }

        .title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin: 9px 0;
            color: #0f766e;
        }

        .box {
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            border-radius: 7px;
            background: #f9fafb;
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        .label {
            font-size: 9.5px;
            color: #6b7280;
            margin-bottom: 1px;
        }

        .value {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 4px;
            color: #0f766e;
            font-size: 11.5px;
        }

        .cf-badge {
            display: inline-block;
            background: #ccfbf1;
            color: #0f766e;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10.5px;
            font-weight: bold;
        }

        ul {
            margin: 0;
            padding-left: 16px;
        }

        li {
            margin-bottom: 1px;
        }

        p {
            margin: 0;
            text-align: justify;
        }

        .footer-note {
            margin-top: 8px;
            font-size: 9.5px;
            color: #b91c1c;
            font-style: italic;
            line-height: 1.25;
            text-align: justify;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="clinic-name">Bringin Optik</div>
        <div class="clinic-info">
            Jl. Anggajaya 2 No.230, Sanggrahan, Condongcatur, Kec. Depok,
            Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283<br>
            Telp: 08122729969
        </div>
    </div>

    <!-- JUDUL -->
    <div class="title">LAPORAN HASIL DIAGNOSA</div>

    <!-- DATA UTAMA -->
    <div class="box">
        <div class="label">Nama Pengguna</div>
        <div class="value">{{ $diagnosa->user->name }}</div>

        <div class="label">Tanggal Diagnosa</div>
        <div class="value">{{ $diagnosa->created_at->format('d M Y H:i') }}</div>

        <div class="label">Hasil Diagnosa</div>
        <div class="value" style="color:#0f766e;">
            {{ $diagnosa->penyakit->nama_penyakit }}
        </div>

        <div class="label">Tingkat Keyakinan</div>
        <div class="value">
            <span class="cf-badge">
                {{ number_format($diagnosa->cf_result * 100, 2) }}%
            </span>
        </div>
    </div>

    <!-- GEJALA -->
    <div class="box">
        <div class="section-title">Gejala yang Dipilih</div>

        @if($gejalas->isEmpty())
            <p>- Tidak ada gejala dipilih</p>
        @else
            <ul>
                @foreach($gejalas as $g)
                    <li>{{ $g->nama_gejala }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- DESKRIPSI -->
    <div class="box">
        <div class="section-title">Deskripsi Kelainan Mata</div>
        <p>
            {{ $diagnosa->penyakit->deskripsi }}
        </p>
    </div>

    <!-- SARAN -->
    <div class="box">
        <div class="section-title">Saran Penanganan</div>
        <p>
            {{ $diagnosa->penyakit->saran_penanganan }}
        </p>
    </div>

    <!-- CATATAN -->
    <div class="footer-note">
        *Hasil diagnosa ini bersifat prediksi awal dan bukan pengganti pemeriksaan medis.
        Disarankan melakukan pemeriksaan lebih lanjut ke dokter spesialis mata atau tenaga kesehatan terkait
        untuk memperoleh diagnosis dan penanganan yang lebih akurat.
    </div>

</body>
</html>