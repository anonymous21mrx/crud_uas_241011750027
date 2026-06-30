<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - {{ $kuliner->nama_tempat }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-auto mr-3">
                        <span class="text-2xl font-bold text-indigo-600">KulinerKu di Telaga Bestari</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition duration-150">&larr; Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if($kuliner->gambar)
                <img src="{{ Storage::url($kuliner->gambar) }}" alt="{{ $kuliner->nama_tempat }}" class="w-full h-80 object-cover">
            @else
                <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500 text-lg">No Image</div>
            @endif
            
            <div class="p-8">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $kuliner->nama_tempat }}</h2>
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full">{{ $kuliner->jenis_makanan }}</span>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 border-b pb-2">Informasi Tempat</h3>
                        <div class="flex items-start mb-4">
                            <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="text-gray-700 text-base leading-relaxed">{{ $kuliner->alamat }}</p>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-gray-700 text-base font-medium">{{ $kuliner->jam_operasional }}</p>
                        </div>
                    </div>
                    
                    @if($kuliner->menus->count() > 0)
                    <div class="pt-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Daftar Menu</h3>
                        <div class="flex overflow-x-auto space-x-4 pb-4 snap-x hide-scrollbar">
                            @foreach($kuliner->menus as $menu)
                            <div class="flex-none w-64 bg-gray-50 rounded-lg p-4 border border-gray-100 shadow-sm flex flex-col h-full snap-start">
                                @if($menu->gambar)
                                    <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="w-full h-32 object-cover rounded-md mb-3">
                                @endif
                                <div class="flex-grow">
                                    <h4 class="font-bold text-gray-900">{{ $menu->nama_menu }}</h4>
                                    @if($menu->deskripsi)
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $menu->deskripsi }}</p>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <span class="inline-block bg-indigo-100 text-indigo-800 text-sm font-semibold px-2.5 py-1 rounded">
                                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="pt-6 border-t border-gray-100 flex justify-center">
                        <a href="{{ url('/') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-150 font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Daftar Kuliner
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Data Tempat Kuliner. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
