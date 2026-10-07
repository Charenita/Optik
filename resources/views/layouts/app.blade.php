<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Diagnosa Mata</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">

                <!-- LOGO -->
                <div class="text-xl font-bold text-teal-600 flex items-center gap-2">
                    <i class="fa-solid fa-eye"></i>
                    <a href="/">Bringin Optik</a>
                </div>

                <!-- BUTTON MOBILE -->
                <button onclick="toggleMenu()" class="md:hidden text-gray-700 text-xl">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- MENU DESKTOP -->
                <div class="hidden md:flex items-center space-x-5 text-sm font-medium">
                    <a href="/" class="hover:text-teal-600">Home</a>
                    <a href="/diagnosa" class="hover:text-teal-600">Diagnosa</a>
                    <a href="/penyakit" class="hover:text-teal-600">Penyakit</a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/dashboard" class="hover:text-teal-600">Admin</a>
                        @endif

                        <a href="/riwayat" class="hover:text-teal-600">Riwayat</a>

                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="hover:text-teal-600">Login</a>
                        <a href="/registrasi" class="bg-teal-500 text-white px-3 py-1 rounded-lg hover:bg-teal-600">
                            Registrasi
                        </a>
                    @endauth
                </div>
            </div>

            <!-- MENU MOBILE -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3 text-sm font-medium">
                    <a href="/" class="hover:text-teal-600">Home</a>
                    <a href="/diagnosa" class="hover:text-teal-600">Diagnosa</a>
                    <a href="/penyakit" class="hover:text-teal-600">Penyakit</a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/dashboard" class="hover:text-teal-600">Admin</a>
                        @endif

                        <a href="/riwayat" class="hover:text-teal-600">Riwayat</a>

                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="text-red-500 text-left">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="hover:text-teal-600">Login</a>
                        <a href="/registrasi" class="bg-teal-500 text-white px-3 py-1 rounded-lg text-center">
                            Registrasi
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-1 py-6 sm:py-8">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-gray-600">

            <div class="font-semibold text-teal-600 mb-2 text-base flex justify-center items-center gap-2">
                <i class="fa-solid fa-eye"></i> 
            </div>

<div class="text-center mt-6">

    <div class="flex justify-center items-center gap-2 text-sm text-gray-600 mb-2">
        <span>📍</span>
        <a href="https://www.google.com/maps?q=Jl.+Anggajaya+2+No.230,+Sanggrahan,+Condongcatur,+Depok,+Sleman,+Yogyakarta+55283"
           target="_blank"
           class="hover:text-teal-600 transition">

            Jl. Anggajaya 2 No.230, Sanggrahan, Condongcatur,
            Kec. Depok, Kabupaten Sleman, DIY 55283

        </a>
    </div>

    <div class="flex justify-center items-center gap-2 text-sm text-gray-600">
        <span>📞</span>
        <span>08122729969</span>
    </div>

</div>
            <p class="text-gray-400 mt-3 text-xs">
                © {{ date('Y') }}  Diagnosa Kelainan Mata
            </p>

        </div>
    </footer>

    <!-- SCRIPT -->
    <script>
        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

    @stack('scripts')

</body>
</html>