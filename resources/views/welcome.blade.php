<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tempat Kuliner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-auto mr-3">
                    <h1 class="text-2xl font-bold text-indigo-600">KulinerKu di Telaga Bestari</h1>
                    
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('admin.tempat-kuliner.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition duration-150">Dashboard Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-150 font-medium">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-indigo-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Temukan Kuliner Favoritmu!</h2>
            <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto">Jelajahi berbagai pilihan tempat kuliner menarik dengan beragam jenis makanan yang siap memanjakan lidah Anda.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h3 class="text-3xl font-bold text-gray-900 mb-8 text-center">Daftar Tempat Kuliner</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($tempatKuliners as $kuliner)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition duration-300 flex flex-col">
                    @if($kuliner->gambar)
                        <img src="{{ Storage::url($kuliner->gambar) }}" alt="{{ $kuliner->nama_tempat }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                    @endif
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-xl font-bold text-gray-900">{{ $kuliner->nama_tempat }}</h4>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $kuliner->jenis_makanan }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            <svg class="w-4 h-4 inline-block mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $kuliner->alamat }}
                        </p>
                        <div class="border-t border-gray-100 pt-4 mt-auto">
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $kuliner->jam_operasional }}
                            </div>
                            <a href="{{ route('tempat-kuliner.show', $kuliner->id) }}" class="block w-full text-center bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-semibold transition duration-300 shadow-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada data tempat kuliner.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Data Tempat Kuliner. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
