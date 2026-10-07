@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6 text-gray-700">Kelola CF Rules</h2>

<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h3 class="text-lg font-semibold text-gray-600">Data Rules</h3>

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
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Penyakit</th>
                    <th class="p-2 sm:p-3 text-left text-sm sm:text-base">Gejala</th>
                    <th class="p-3 text-center">CF</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rules as $r)
                <tr class="border-b hover:bg-gray-50 transition">
                    
                    <td class="p-2 sm:p-3 text-sm sm:text-base">
                        {{ $r->penyakit->nama_penyakit }}
                    </td>

                    <td class="p-2 sm:p-3 text-sm sm:text-base">
                        {{ $r->gejala->nama_gejala }}
                    </td>

                    <td class="p-3 text-center font-semibold text-teal-600">
                        {{ $r->cf_value }}
                    </td>

                    <td class="p-2 sm:p-3 text-center space-y-1 sm:space-y-0 sm:space-x-2">
                        
                        <!-- EDIT -->
                        <button 
                            onclick="editRule({{ $r->id }}, {{ $r->cf_value }})"
                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 shadow text-xs sm:text-sm">
                            Edit
                        </button>

                        <!-- HAPUS -->
                        <form action="{{ route('admin.rules.destroy', $r->id) }}" method="POST" class="inline">
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
    <div class="bg-white p-6 w-full max-w-md mx-4 rounded-xl shadow-lg border border-gray-100">

        <h3 class="font-bold mb-4 text-lg text-gray-700">Tambah Rule</h3>

        <form action="{{ route('admin.rules.store') }}" method="POST">
            @csrf

            <select name="penyakit_id" 
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400">
                @foreach($penyakits as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_penyakit }}</option>
                @endforeach
            </select>

            <select name="gejala_id" 
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400">
                @foreach($gejalas as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_gejala }}</option>
                @endforeach
            </select>

            <input type="number" step="0.01" name="cf_value" placeholder="CF (0 - 1)"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="toggleModal('addModal')" 
                    class="bg-gray-400 text-white px-3 py-1 rounded">
                    Batal
                </button>

                <button class="bg-teal-500 text-white px-4 py-1 rounded">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
    <div class="bg-white p-6 w-96 rounded-xl shadow-lg border border-gray-100">

        <h3 class="font-bold mb-4 text-lg text-gray-700">Edit Rule</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="number" step="0.01" id="edit_cf" name="cf_value"
                class="w-full border rounded-lg p-2 mb-3 focus:ring-2 focus:ring-teal-400">

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

function editRule(id, cf) {
    document.getElementById('edit_cf').value = cf;
    document.getElementById('editForm').action = '/admin/rules/' + id;
    toggleModal('editModal');
}
</script>

@endsection