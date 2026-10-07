<!DOCTYPE html>
<html>
<head>
    <title>Laporan Harian</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align:center; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { border:1px solid #000; padding:8px; font-size:12px; }
        th { background:#eee; }
    </style>
</head>
<body>

<h2>LAPORAN HARIAN DIAGNOSA</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Penyakit</th>
            <th>CF</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diagnosas as $i => $d)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $d->user->name }}</td>
            <td>{{ $d->penyakit->nama_penyakit }}</td>
            <td>{{ number_format($d->cf_result,2) }}</td>
            <td>{{ $d->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>