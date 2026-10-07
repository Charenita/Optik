<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2D9C9C',
                        secondary: '#6FCF97',
                        softbg: '#F8FAFC',
                        softborder: '#E5E7EB'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-softbg">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-softborder shadow-sm">
        <div class="p-6 text-xl font-bold text-primary border-b border-softborder">
            👁️Bringin Optik
        </div>

        <nav class="p-4 space-y-2 text-gray-600">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                🏠 Dashboard
            </a>

            <a href="{{ route('admin.penyakit') }}"
               class="block px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                💊 Penyakit
            </a>

            <a href="{{ route('admin.gejala') }}"
               class="block px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                📝 Gejala
            </a>

            <a href="{{ route('admin.rules') }}"
               class="block px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                ⚙️ CF Rules
            </a>

            <a href="{{ route('admin.laporan') }}"
               class="block px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                📊 Laporan
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded-lg bg-red-100 text-red-500 hover:bg-red-200">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <div class="flex-1">

        {{-- TOPBAR --}}
        <header class="bg-white border-b border-softborder px-6 py-4 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700">Dashboard Admin</h1>
            <div class="text-gray-600">
                👤 {{ auth()->user()->name }}
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>