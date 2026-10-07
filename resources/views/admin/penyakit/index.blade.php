@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-700">Kelola Penyakit</h2>

<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h3 class="text-lg font-semibold text-gray-600">Data Penyakit</h3>

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
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Nama Penyakit</th>
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Deskripsi</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($penyakits as $p)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-2 sm:p-3 text-sm sm:text-base">{{ $p->kode_penyakit }}</td>

                    <td class="p-3 font-medium text-gray-700">
                        {{ $p->nama_penyakit }}
                    </td>

                    <td class="p-3 text-gray-600">
                        {{ \Illuminate\Support\Str::limit($p->deskripsi, 50) }}
                    </td>

                    <td class="p-3 text-center space-x-2">

                        <!-- EDIT -->
                        <button 
                            onclick="editPenyakit(
                                {{ $p->id }},
                                '{{ $p->kode_penyakit }}',
                                '{{ $p->nama_penyakit }}',
                                `{{ $p->deskripsi }}`,
                                `{{ $p->gejala_umum }}`,
                                `{{ $p->saran_penanganan }}`
                            )"
                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <form action="{{ route('admin.penyakit.destroy', $p->id) }}" 
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 shadow">
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
<div class="bg-white w-full max-w-md mx-4 rounded-xl shadow-lg p-6 border border-gray-100">

        <h3 class="text-lg font-bold mb-4 text-gray-700">Tambah Penyakit</h3>

        <!-- ERROR VALIDASI -->
        @if ($errors->any())
            <div class="mb-3 p-3 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.penyakit.store') }}" method="POST">
            @csrf

            <input type="text" name="kode_penyakit" placeholder="Kode Penyakit"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required>

            <input type="text" name="nama_penyakit" placeholder="Nama Penyakit"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required>

            <textarea name="deskripsi" rows="2"
                placeholder="Deskripsi"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required></textarea>

            <textarea name="gejala_umum" rows="2"
                placeholder="Gejala Umum"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required></textarea>

            <textarea name="saran_penanganan" rows="2"
                placeholder="Saran Penanganan"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400" required></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('addModal')" 
                    class="bg-gray-400 text-white px-3 py-1 rounded">
                    Batal
                </button>

                <button type="submit"
                    class="bg-teal-500 text-white px-4 py-1 rounded">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
<div class="bg-white w-full max-w-md mx-4 rounded-xl shadow-lg p-6 border border-gray-100">

        <h3 class="text-lg font-bold mb-4 text-gray-700">Edit Penyakit</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="text" id="edit_kode" name="kode_penyakit"
                class="w-full border rounded-lg p-2 mb-3">

            <input type="text" id="edit_nama" name="nama_penyakit"
                class="w-full border rounded-lg p-2 mb-3">

            <textarea id="edit_deskripsi" name="deskripsi" rows="2"
                class="w-full border rounded-lg p-2 mb-3"></textarea>

            <textarea id="edit_gejala" name="gejala_umum" rows="2"
                class="w-full border rounded-lg p-2 mb-3"></textarea>

            <textarea id="edit_saran" name="saran_penanganan" rows="2"
                class="w-full border rounded-lg p-2 mb-3"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('editModal')" 
                    class="bg-gray-400 text-white px-3 py-1 rounded">
                    Batal
                </button>

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

// ✅ FIX EDIT FUNCTION
function editPenyakit(id, kode, nama, deskripsi, gejala, saran) {
    document.getElementById('edit_kode').value = kode;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('edit_gejala').value = gejala;
    document.getElementById('edit_saran').value = saran;

    document.getElementById('editForm').action = '/admin/penyakit/' + id;

    toggleModal('editModal');
}
</script>

@endsection