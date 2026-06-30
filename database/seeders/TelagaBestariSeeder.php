<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\TempatKuliner;
use App\Models\Menu;

class TelagaBestariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::truncate();
        TempatKuliner::query()->delete();
        
        $downloadImage = function($keyword, $folder, $seedText) {
            try {
                // Gunakan Picsum karena sangat stabil dan cepat untuk gambar random (berdasarkan seed agar konsisten namun unik)
                $seed = md5($seedText . rand(1, 1000));
                $url = "https://picsum.photos/seed/{$seed}/800/600";
                
                $ctx = stream_context_create(['http' => ['timeout' => 8]]);
                $contents = @file_get_contents($url, false, $ctx);
                
                if (!$contents) {
                    // Fallback jika picsum gagal
                    $url = "https://placehold.co/800x600/png?text=" . urlencode(substr($seedText, 0, 20));
                    $contents = @file_get_contents($url, false, $ctx);
                }
                
                if ($contents) {
                    $filename = $folder . '/' . Str::random(10) . '.jpg';
                    Storage::disk('public')->put($filename, $contents);
                    return $filename;
                }
            } catch (\Exception $e) {}
            return null;
        };

        $data = [
            [
                'nama' => 'Waroeng Sunda Telaga Bestari',
                'jenis' => 'Masakan Nusantara / Sunda',
                'alamat' => 'Kawasan Telaga Bestari, Balaraja',
                'jam' => '10:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Nasi Liwet Komplit', 'harga' => 45000, 'deskripsi' => 'Nasi liwet dengan lauk ayam kampung, tahu, tempe.'],
                    ['nama_menu' => 'Gurame Bakar Kecap', 'harga' => 75000, 'deskripsi' => 'Ikan gurame bakar segar dengan olesan bumbu kecap.'],
                    ['nama_menu' => 'Karedok', 'harga' => 20000, 'deskripsi' => 'Sayuran mentah segar dengan bumbu kacang khas Sunda.'],
                ]
            ],
            [
                'nama' => "McDonald's Telaga Bestari",
                'jenis' => 'Cepat Saji',
                'alamat' => 'Jl. Tol Jakarta - Merak KM 42',
                'jam' => '24 Jam',
                'menus' => [
                    ['nama_menu' => 'Big Mac', 'harga' => 41000, 'deskripsi' => 'Burger ikonik McD dengan dua lapis daging sapi.'],
                    ['nama_menu' => 'PaNas Spesial', 'harga' => 38000, 'deskripsi' => 'Ayam krispi McD dengan nasi hangat.'],
                ]
            ],
            [
                'nama' => 'Kampoeng Kalapa',
                'jenis' => 'Lesehan / Sunda',
                'alamat' => 'Sebelah Perumahan Telaga Bestari',
                'jam' => '10:00 - 21:00',
                'menus' => [
                    ['nama_menu' => 'Ikan Gurame Asam Manis', 'harga' => 80000, 'deskripsi' => 'Gurame goreng dengan saus asam manis lezat.'],
                    ['nama_menu' => 'Ayam Bakar Madu', 'harga' => 35000, 'deskripsi' => 'Ayam bakar dengan baluran madu manis gurih.'],
                ]
            ],
            [
                'nama' => 'Bakso Kampungqu',
                'jenis' => 'Bakso / Mie',
                'alamat' => 'Ruko Telaga Bestari',
                'jam' => '10:00 - 21:00',
                'menus' => [
                    ['nama_menu' => 'Bakso Urat Besar', 'harga' => 25000, 'deskripsi' => 'Bakso urat sapi asli tanpa micin berlebihan.'],
                    ['nama_menu' => 'Mie Ayam Bakso', 'harga' => 22000, 'deskripsi' => 'Mie ayam pangsit ditambah dua bakso kecil.'],
                ]
            ],
            [
                'nama' => 'Ikilo Sushi Telaga Bestari',
                'jenis' => 'Jepang / Sushi',
                'alamat' => 'Ruko Premium Telaga Bestari',
                'jam' => '11:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Salmon Mentai Roll', 'harga' => 35000, 'deskripsi' => 'Sushi roll dengan topping salmon dan saus mentai bakar.'],
                    ['nama_menu' => 'Chicken Katsu Don', 'harga' => 28000, 'deskripsi' => 'Nasi bowl dengan chicken katsu dan telur.'],
                ]
            ],
            [
                'nama' => 'Warung Rica-Rica',
                'jenis' => 'Masakan Pedas',
                'alamat' => 'Area Ruko Telaga Bestari',
                'jam' => '10:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Rica Ayam Kampung', 'harga' => 35000, 'deskripsi' => 'Ayam kampung dimasak dengan bumbu rica super pedas.'],
                    ['nama_menu' => 'Bebek Rica', 'harga' => 40000, 'deskripsi' => 'Bebek goreng empuk dengan sambal rica melimpah.'],
                ]
            ],
            [
                'nama' => 'Arena Jajan Talaga Bestari',
                'jenis' => 'Pujasera / Foodcourt',
                'alamat' => 'Pusat Telaga Bestari',
                'jam' => '16:00 - 23:00',
                'menus' => [
                    ['nama_menu' => 'Nasi Goreng Gila', 'harga' => 25000, 'deskripsi' => 'Nasi goreng dengan campuran sosis, bakso, dan telur.'],
                    ['nama_menu' => 'Sate Taichan', 'harga' => 25000, 'deskripsi' => 'Sate ayam tanpa bumbu kacang dengan sambal pedas.'],
                ]
            ],
            [
                'nama' => 'Malacca Corner',
                'jenis' => 'Kafe / Melayu',
                'alamat' => 'Ruko Portobello, Telaga Bestari',
                'jam' => '09:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Nasi Lemak', 'harga' => 30000, 'deskripsi' => 'Nasi gurih dengan lauk ayam goreng dan sambal ikan bilis.'],
                    ['nama_menu' => 'Teh Tarik', 'harga' => 15000, 'deskripsi' => 'Teh susu klasik yang ditarik hingga berbusa.'],
                ]
            ],
            [
                'nama' => 'Coffee Kesayangan',
                'jenis' => 'Kafe / Kopi',
                'alamat' => 'Ruko D Cativa, Telaga Bestari',
                'jam' => '08:00 - 23:00',
                'menus' => [
                    ['nama_menu' => 'Kopi Susu Aren', 'harga' => 20000, 'deskripsi' => 'Es kopi susu dengan gula aren murni.'],
                    ['nama_menu' => 'Croffle Original', 'harga' => 25000, 'deskripsi' => 'Croissant waffle renyah dengan sirup maple.'],
                ]
            ],
            [
                'nama' => 'Jungle Walk Foodcourt',
                'jenis' => 'Pujasera',
                'alamat' => 'Kawasan Telaga Bestari',
                'jam' => '15:00 - 23:00',
                'menus' => [
                    ['nama_menu' => 'Dimsum Campur', 'harga' => 20000, 'deskripsi' => 'Satu porsi dimsum berisi siomay, hakau, dan lumpia.'],
                    ['nama_menu' => 'Es Campur', 'harga' => 15000, 'deskripsi' => 'Es serut dengan sirup, susu, jelly, dan buah.'],
                ]
            ],
            [
                'nama' => 'KFC Telaga Bestari',
                'jenis' => 'Cepat Saji',
                'alamat' => 'Kawasan Niaga Telaga Bestari',
                'jam' => '09:00 - 23:00',
                'menus' => [
                    ['nama_menu' => 'Super Besar 1', 'harga' => 36000, 'deskripsi' => '1 Potong Ayam besar, 1 Nasi, dan 1 Coca Cola.'],
                    ['nama_menu' => 'Mocha Float', 'harga' => 15000, 'deskripsi' => 'Minuman mocha dingin dengan es krim float.'],
                ]
            ],
            [
                'nama' => 'Mie Gacoan Telaga Bestari',
                'jenis' => 'Mie Pedas',
                'alamat' => 'Ruko Telaga Bestari (Dekat Tol)',
                'jam' => '09:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Mie Gacoan Level 3', 'harga' => 10000, 'deskripsi' => 'Mie pedas manis dengan pangsit goreng.'],
                    ['nama_menu' => 'Udang Keju', 'harga' => 9000, 'deskripsi' => 'Dimsum udang isi keju leleh yang digoreng renyah.'],
                ]
            ],
            [
                'nama' => 'Kopi Kenangan',
                'jenis' => 'Kafe / Kopi',
                'alamat' => 'Ruko Lion City, Telaga Bestari',
                'jam' => '08:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Kopi Kenangan Mantan', 'harga' => 18000, 'deskripsi' => 'Kopi susu gula aren andalan Kopi Kenangan.'],
                    ['nama_menu' => 'Roti Coklat', 'harga' => 12000, 'deskripsi' => 'Roti jadul dengan isian coklat manis.'],
                ]
            ],
            [
                'nama' => 'Sambal Bakar Telaga Bestari',
                'jenis' => 'Masakan Pedas',
                'alamat' => 'Depan Gerbang Telaga Bestari',
                'jam' => '11:00 - 23:00',
                'menus' => [
                    ['nama_menu' => 'Ayam Bakar Sambal Gami', 'harga' => 28000, 'deskripsi' => 'Ayam yang disajikan di atas cobek panas dengan sambal mendidih.'],
                    ['nama_menu' => 'Cah Kangkung', 'harga' => 15000, 'deskripsi' => 'Kangkung tumis terasi pedas.'],
                ]
            ],
            [
                'nama' => 'Bebek Kaleyo Balaraja',
                'jenis' => 'Masakan Nusantara',
                'alamat' => 'Jl. Raya Serang (Dekat Pintu Tol Balaraja Timur)',
                'jam' => '10:00 - 22:00',
                'menus' => [
                    ['nama_menu' => 'Bebek Goreng Kremes', 'harga' => 38000, 'deskripsi' => 'Bebek goreng empuk dengan taburan kremesan gurih.'],
                    ['nama_menu' => 'Bebek Cabe Ijo', 'harga' => 39000, 'deskripsi' => 'Bebek empuk dengan lumuran sambal cabe ijo khas Kaleyo.'],
                ]
            ]
        ];

        foreach ($data as $tempat) {
            echo "Memproses: " . $tempat['nama'] . "\n";
            // Gunakan nama tempat sebagai seed untuk konsistensi/keunikan
            $gambarTempat = $downloadImage('restaurant', 'tempat_kuliners', $tempat['nama']);
            
            $tk = TempatKuliner::create([
                'nama_tempat' => $tempat['nama'],
                'jenis_makanan' => $tempat['jenis'],
                'alamat' => $tempat['alamat'],
                'jam_operasional' => $tempat['jam'],
                'gambar' => $gambarTempat,
            ]);

            foreach ($tempat['menus'] as $menuItem) {
                echo "  - Memproses menu: " . $menuItem['nama_menu'] . "\n";
                $gambarMenu = $downloadImage('food', 'menus', $menuItem['nama_menu']);
                
                $tk->menus()->create([
                    'nama_menu' => $menuItem['nama_menu'],
                    'harga' => $menuItem['harga'],
                    'deskripsi' => $menuItem['deskripsi'],
                    'gambar' => $gambarMenu,
                ]);
            }
        }
        
        echo "Seeding selesai!\n";
    }
}
