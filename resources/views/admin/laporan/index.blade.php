@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-700">Laporan Diagnosa</h2>

<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-3">
        <h3 class="text-lg font-semibold text-gray-600">Data Diagnosa</h3>

        <!-- CETAK PDF HARIAN -->
        <a href="{{ route('admin.laporan.harian.pdf', request()->all()) }}"
            class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition text-sm">
            Cetak Laporan
        </a>
    </div>

    <!-- NOTIF -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- FILTER -->
    <form method="GET" class="flex flex-col sm:flex-row flex-wrap gap-3 mb-6">

        <input type="text" name="search" placeholder="Cari user..."
            value="{{ request('search') }}"
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-400 w-full sm:w-auto">

        <input type="date" name="from"
            value="{{ request('from') }}"
            class="border rounded-lg px-3 py-2 w-full sm:w-auto">

        <input type="date" name="to"
            value="{{ request('to') }}"
            class="border rounded-lg px-3 py-2 w-full sm:w-auto">

        <button class="bg-teal-500 text-white px-4 py-2 rounded-lg hover:bg-teal-600 shadow w-full sm:w-auto">
            Filter
        </button>

    </form>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">

            <thead>
                <tr class="bg-teal-50 text-gray-700">
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">User</th>
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Penyakit</th>
                    <th class="p-2 sm:p-3 text-center text-sm sm:text-base">CF</th>
                    <th class="p-2 sm:p-3 text-center text-sm sm:text-base">Tanggal</th>
                    <th class="p-2 sm:p-3 text-center text-sm sm:text-base">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($diagnosas as $d)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-2 sm:p-3 text-sm sm:text-base">{{ $d->user->name }}</td>
                    <td class="p-2 sm:p-3 text-sm sm:text-base">{{ $d->penyakit->nama_penyakit }}</td>

                    <td class="p-2 sm:p-3 text-center">
                        <span class="bg-teal-100 text-teal-700 px-2 sm:px-3 py-1 rounded-lg text-xs sm:text-sm">
                            {{ number_format($d->cf_result, 2) }}
                        </span>
                    </td>

                    <td class="p-2 sm:p-3 text-center text-gray-500 text-xs sm:text-sm">
                        {{ $d->created_at->format('d M Y H:i') }}
                    </td>

                    <!-- AKSI -->
                    <td class="p-2 sm:p-3 text-center flex justify-center gap-2">

                        <!-- DETAIL -->
                        <a href="{{ route('admin.laporan.detail', $d->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow text-xs sm:text-sm">
                            Detail
                        </a>

                        <!-- HAPUS -->
                        <form action="{{ route('admin.laporan.delete', $d->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 shadow text-xs sm:text-sm">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-400 text-sm">
                        Belum ada data
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection