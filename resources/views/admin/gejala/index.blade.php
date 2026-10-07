@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-700">Kelola Gejala</h2>

<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">        
        <h3 class="text-lg font-semibold text-gray-600">Data Gejala</h3>

        <button onclick="toggleModal('addModal')" 
            class="bg-teal-500 text-white px-4 py-2 rounded-lg shadow hover:bg-teal-600 transition">
            + Tambah
        </button>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-teal-50 text-gray-700">
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Kode</th>
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Nama Gejala</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gejalas as $g)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-2 sm:p-3 text-sm sm:text-base">{{ $g->kode_gejala }}</td>
                    <td class="p-2 sm:p-3 text-sm sm:text-base">{{ $g->nama_gejala }}</td>
                    <td class="p-2 sm:p-3 text-center space-y-1 sm:space-y-0 sm:space-x-2">

                        <!-- EDIT -->
                        <button 
                            onclick="editGejala({{ $g->id }}, '{{ $g->kode_gejala }}', '{{ $g->nama_gejala }}')" 
                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow text-xs sm:text-sm">
                            Edit
                        </button>

                        <!-- HAPUS -->
                        <form action="{{ route('admin.gejala.destroy', $g->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data?')" 
                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 shadow text-xs sm:text-sm">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="addModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md mx-4">
        <h3 class="font-bold mb-4 text-lg">Tambah Gejala</h3>

        <form action="{{ route('admin.gejala.store') }}" method="POST">
            @csrf
            <input type="text" name="kode_gejala" placeholder="Kode"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required>

            <input type="text" name="nama_gejala" placeholder="Nama Gejala"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('addModal')" 
                    class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>

                <button class="bg-teal-500 text-white px-4 py-1 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl shadow-lg w-96">
        <h3 class="font-bold mb-4 text-lg">Edit Gejala</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="text" id="edit_kode" name="kode_gejala"
                class="w-full border rounded-lg p-2 mb-3">

            <input type="text" id="edit_nama" name="nama_gejala"
                class="w-full border rounded-lg p-2 mb-3">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('editModal')" 
                    class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>

                <button class="bg-blue-500 text-white px-4 py-1 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleModal(id) {
    document.getElementById(id).classList.toggle('hidden');
}

function editGejala(id, kode, nama) {
    document.getElementById('edit_kode').value = kode;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('editForm').action = '/admin/gejala/' + id;
    toggleModal('editModal');
}
</script>

@endsection