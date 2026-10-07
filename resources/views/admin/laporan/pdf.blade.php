<!DOCTYPE html>
<html>
<head>
    <title>Laporan Diagnosa</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            line-height: 1.6;
        }

.header {
    text-align: center;
    border-bottom: 3px solid #14b8a6;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

        .clinic-name {
            font-size: 20px;
            font-weight: bold;
            color: #0f766e;
        }

        .clinic-info {
            font-size: 12px;
            color: #555;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
            color: #0f766e;
        }

        .box {
            border: 1px solid #e5e7eb;
            padding: 15px;
            border-radius: 8px;
            background: #f9fafb;
            margin-bottom: 20px;
        }

        .label {
            font-size: 12px;
            color: #6b7280;
        }

        .value {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #0f766e;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 12px;
            color: #b91c1c;
            font-style: italic;
        }

        .cf-badge {
            display: inline-block;
            background: #ccfbf1;
            color: #0f766e;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
        }
        .clinic-name {
    font-size: 22px;
    font-weight: bold;
    letter-spacing: 1px;
}
    </style>
</head>
<body>

    <!-- HEADER / COP SURAT -->
<div class="header">
    <div class="clinic-name">Bringin Optik</div>
    
    <div class="clinic-info">
        Jl. Anggajaya 2 No.230, Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283<br>
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

        <div class="label">Nilai Kepastian (CF)</div>
        <div class="value">
            <span class="cf-badge">
                {{ number_format($diagnosa->cf_result, 2) }}
            </span>
        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="box">
        <div class="section-title">Deskripsi Penyakit</div>
        <p style="text-align: justify;">
            {{ $diagnosa->penyakit->deskripsi }}
        </p>
    </div>

    <!-- SARAN -->
    <div class="box">
        <div class="section-title">Saran Penanganan</div>
        <p style="text-align: justify;">
            {{ $diagnosa->penyakit->saran_penanganan }}
        </p>
    </div>

    <!-- CATATAN -->
    <div class="footer-note">
        *Hasil diagnosa ini bersifat prediksi awal. Disarankan untuk melakukan 
        konsultasi lebih lanjut dengan dokter spesialis mata guna mendapatkan 
        diagnosis yang lebih akurat dan penanganan yang tepat.
    </div>

</body>
</html>