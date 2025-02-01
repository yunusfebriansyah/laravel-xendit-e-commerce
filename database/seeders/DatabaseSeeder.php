<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::insert([
            [
                'name' => 'Admin BelanjaRia',
                'email' => 'admin@dc.id',
                'password' => bcrypt('admin'),
                'address' => 'IKN',
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User Belanja',
                'email' => 'user@dc.id',
                'password' => bcrypt('password'),
                'address' => 'Lampung',
                'role' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Category::insert([
            [
                'name' => 'Komputer & Laptop',
                'slug' => Str::slug('Komputer & Laptop'),
                'path' => 'M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Olahraga',
                'slug' => Str::slug('Olahraga'),
                'path' => 'M4.37 7.657c2.063.528 2.396 2.806 3.202 3.87 1.07 1.413 2.075 1.228 3.192 2.644 1.805 2.289 1.312 5.705 1.312 6.705M20 15h-1a4 4 0 0 0-4 4v1M8.587 3.992c0 .822.112 1.886 1.515 2.58 1.402.693 2.918.351 2.918 2.334 0 .276 0 2.008 1.972 2.008 2.026.031 2.026-1.678 2.026-2.008 0-.65.527-.9 1.177-.9H20M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pakaian',
                'slug' => Str::slug('Pakaian'),
                'path' => 'M4 6h16M4 6a4 4 0 0 0 4-4M20 6a4 4 0 0 1-4-4M4 6v12a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V6',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Kecantikan',
                'slug' => Str::slug('Kecantikan'),
                'path' => 'M9 12l2 2-2 2m2-2h8m4 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Elektronik',
                'slug' => Str::slug('Elektronik'),
                'path' => 'M8 10h8m-4 4h4m1-11H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hobi',
                'slug' => Str::slug('Hobi'),
                'path' => 'M3 5h18M9 3v2m6-2v2m2 14h-4m-4 0H5a2 2 0 0 1-2-2V7h18v10a2 2 0 0 1-2 2h-3Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Mainan Anak',
                'slug' => Str::slug('Mainan Anak'),
                'path' => 'M12 2a5 5 0 0 1 5 5v4a5 5 0 0 1-10 0V7a5 5 0 0 1 5-5Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Makanan & Minuman',
                'slug' => Str::slug('Makanan & Minuman'),
                'path' => 'M7 4h10l1 6H6l1-6ZM5 10h14v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Buku & Alat Tulis',
                'slug' => Str::slug('Buku & Alat Tulis'),
                'path' => 'M12 2l8 8-8 8-8-8 8-8ZM4 12h16',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Peralatan Rumah Tangga',
                'slug' => Str::slug('Peralatan Rumah Tangga'),
                'path' => 'M4 4h16v6H4V4ZM4 16h16v2H4v-2Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Mobil & Motor',
                'slug' => Str::slug('Mobil & Motor'),
                'path' => 'M4 10h16l2 6H2l2-6ZM4 16h16v4H4v-4Z',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Kesehatan',
                'slug' => Str::slug('Kesehatan'),
                'path' => 'M12 4a8 8 0 1 0 8 8 8 8 0 0 0-8-8Zm0 4v8m-4-4h8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        Product::insert([
            [
                'category_id' => 1,
                'photo' => 'product-photos/mouse-wireless-logitech-m170.png',
                'name' => 'Mouse Wireless Logitech M170',
                'slug' => 'mouse-wireless-logitech-m170',
                'price' => 150000,
                'description' => 'Mouse wireless dengan desain minimalis dan nyaman digunakan, dilengkapi teknologi wireless 2.4GHz.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'photo' => 'product-photos/flashdisk-sandisk-32gb.webp',
                'name' => 'Flashdisk Sandisk 32GB',
                'slug' => 'flashdisk-sandisk-32gb',
                'price' => 80000,
                'description' => 'Flashdisk berkapasitas 32GB yang cepat dan aman untuk menyimpan data.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Olahraga
            [
                'category_id' => 2,
                'photo' => 'product-photos/skipping-rope-pro.webp',
                'name' => 'Skipping Rope Pro',
                'slug' => 'skipping-rope-pro',
                'price' => 75000,
                'description' => 'Tali skipping berkualitas tinggi untuk latihan kebugaran dan cardio.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'photo' => 'product-photos/matras-yoga-anti-slip.png',
                'name' => 'Matras Yoga Anti Slip',
                'slug' => 'matras-yoga-anti-slip',
                'price' => 95000,
                'description' => 'Matras yoga yang nyaman dan anti slip, cocok untuk berbagai pose yoga.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Pakaian
            [
                'category_id' => 3,
                'photo' => 'product-photos/kaos-polos-cotton-combed.webp',
                'name' => 'Kaos Polos Cotton Combed',
                'slug' => 'kaos-polos-cotton-combed',
                'price' => 50000,
                'description' => 'Kaos polos berbahan cotton combed, nyaman untuk digunakan sehari-hari.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'photo' => 'product-photos/topi-snapback-hitam.webp',
                'name' => 'Topi Snapback Hitam',
                'slug' => 'topi-snapback-hitam',
                'price' => 70000,
                'description' => 'Topi snapback dengan desain simple, cocok untuk aktivitas luar ruangan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Kecantikan
            [
                'category_id' => 4,
                'photo' => 'product-photos/lip-balm-aloe-vera.jpg',
                'name' => 'Lip Balm Aloe Vera',
                'slug' => 'lip-balm-aloe-vera',
                'price' => 40000,
                'description' => 'Lip balm berbahan aloe vera untuk melembapkan bibir sepanjang hari.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4,
                'photo' => 'product-photos/masker-wajah-green-tea.webp',
                'name' => 'Masker Wajah Green Tea',
                'slug' => 'masker-wajah-green-tea',
                'price' => 60000,
                'description' => 'Masker wajah berbahan green tea untuk menyegarkan kulit.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Elektronik
            [
                'category_id' => 5,
                'photo' => 'product-photos/headset-bluetooth-remax.webp',
                'name' => 'Headset Bluetooth Remax',
                'slug' => 'headset-bluetooth-remax',
                'price' => 200000,
                'description' => 'Headset bluetooth dengan kualitas suara jernih dan nyaman digunakan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 5,
                'photo' => 'product-photos/lampu-led-usb.jpg',
                'name' => 'Lampu LED USB',
                'slug' => 'lampu-led-usb',
                'price' => 35000,
                'description' => 'Lampu LED yang hemat energi, mudah digunakan dengan konektor USB.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Hobi
            [
                'category_id' => 6,
                'photo' => 'product-photos/cat-air-watercolor-set.png',
                'name' => 'Cat Air Watercolor Set',
                'slug' => 'cat-air-watercolor-set',
                'price' => 85000,
                'description' => 'Set cat air berkualitas tinggi untuk menggambar dan melukis.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 6,
                'photo' => 'product-photos/brush-pen-kaligrafi.jpeg',
                'name' => 'Brush Pen Kaligrafi',
                'slug' => 'brush-pen-kaligrafi',
                'price' => 75000,
                'description' => 'Brush pen yang cocok untuk seni kaligrafi dan lettering.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Mainan Anak
            [
                'category_id' => 7,
                'photo' => 'product-photos/puzzle-kayu-anak.jpg',
                'name' => 'Puzzle Kayu Anak',
                'slug' => 'puzzle-kayu-anak',
                'price' => 65000,
                'description' => 'Puzzle edukatif dari kayu yang aman untuk anak-anak.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 7,
                'photo' => 'product-photos/balok-bangunan-mini.webp',
                'name' => 'Balok Bangunan Mini',
                'slug' => 'balok-bangunan-mini',
                'price' => 90000,
                'description' => 'Mainan balok untuk melatih kreativitas dan motorik anak.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Makanan & Minuman
            [
                'category_id' => 8,
                'photo' => 'product-photos/cokelat-batang-premium.jpg',
                'name' => 'Cokelat Batang Premium',
                'slug' => 'cokelat-batang-premium',
                'price' => 40000,
                'description' => 'Cokelat batang premium dengan rasa lezat dan creamy.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 8,
                'photo' => 'product-photos/kopi-bubuk-arabika-200gr.jpeg',
                'name' => 'Kopi Bubuk Arabika 200gr',
                'slug' => 'kopi-bubuk-arabika-200gr',
                'price' => 75000,
                'description' => 'Kopi bubuk arabika murni dengan aroma khas dan rasa nikmat.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Buku & Alat Tulis
            [
                'category_id' => 9,
                'photo' => 'product-photos/notebook-spiral-a5.webp',
                'name' => 'Notebook Spiral A5',
                'slug' => 'notebook-spiral-a5',
                'price' => 50000,
                'description' => 'Notebook spiral ukuran A5, ideal untuk mencatat atau menggambar.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 9,
                'photo' => 'product-photos/pulpen-gel-warna-hitam.jpg',
                'name' => 'Pulpen Gel Warna Hitam',
                'slug' => 'pulpen-gel-warna-hitam',
                'price' => 25000,
                'description' => 'Pulpen gel dengan tinta hitam yang halus dan nyaman untuk menulis.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Peralatan Rumah Tangga
            [
                'category_id' => 10,
                'photo' => 'product-photos/sapu-lantai-anti-debu.webp',
                'name' => 'Sapu Lantai Anti Debu',
                'slug' => 'sapu-lantai-anti-debu',
                'price' => 70000,
                'description' => 'Sapu lantai dengan bulu lembut untuk membersihkan tanpa meninggalkan debu.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 10,
                'photo' => 'product-photos/kain-lap-microfiber.webp',
                'name' => 'Kain Lap Microfiber',
                'slug' => 'kain-lap-microfiber',
                'price' => 50000,
                'description' => 'Kain lap berbahan microfiber, efektif untuk membersihkan berbagai permukaan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Mobil & Motor
            [
                'category_id' => 11,
                'photo' => 'product-photos/pengharum-mobil-aroma-vanilla.webp',
                'name' => 'Pengharum Mobil Aroma Vanilla',
                'slug' => 'pengharum-mobil-aroma-vanilla',
                'price' => 35000,
                'description' => 'Pengharum mobil dengan aroma vanilla yang segar dan tahan lama.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 11,
                'photo' => 'product-photos/sarung-jok-motor-waterproof.webp',
                'name' => 'Sarung Jok Motor Waterproof',
                'slug' => 'sarung-jok-motor-waterproof',
                'price' => 85000,
                'description' => 'Sarung jok motor anti air untuk melindungi jok dari hujan dan debu.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Kesehatan
            [
                'category_id' => 12,
                'photo' => 'product-photos/termometer-digital.webp',
                'name' => 'Termometer Digital',
                'slug' => 'termometer-digital',
                'price' => 90000,
                'description' => 'Termometer digital dengan hasil pengukuran cepat dan akurat.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 12,
                'photo' => 'product-photos/masker-kesehatan-3-ply.jpg',
                'name' => 'Masker Kesehatan 3 Ply',
                'slug' => 'masker-kesehatan-3-ply',
                'price' => 50000,
                'description' => 'Masker kesehatan 3 ply untuk perlindungan dari debu dan bakteri.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Cart::insert([
            [
                'user_id' => 2,
                'product_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);


    }
}
