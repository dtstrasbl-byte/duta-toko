<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/products');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $items = [
            [
                'category_slug' => 'roti-manis',
                'name' => 'Roti Cokelat Lumer',
                'slug' => 'roti-cokelat-lumer',
                'description' => 'Roti bertekstur super lembut dengan lelehan cokelat pasta Belgia di dalamnya. Hangat, manis pas, dan lumer di setiap gigitan. Cocok untuk sarapan atau teman minum kopi sore.',
                'price' => 12000,
                'stock' => 30,
                'weight' => '85 gram',
                'flavor' => 'Cokelat Belgia Lumer',
                'is_featured' => true,
                'file_name' => 'roti-cokelat.svg',
                'bg1' => '#451a03',
                'bg2' => '#78350f',
                'icon' => '🍞🍫',
            ],
            [
                'category_slug' => 'roti-manis',
                'name' => 'Roti Sobek Keju Spesial',
                'slug' => 'roti-sobek-keju-spesial',
                'description' => 'Roti sobek lembut dengan isian butter keju cheddar parut melimpah di dalam dan taburan keju panggang keemasan di atasnya. Gurih dan manis berpadu sempurna.',
                'price' => 15000,
                'stock' => 25,
                'weight' => '120 gram',
                'flavor' => 'Keju Cheddar Gurih',
                'is_featured' => true,
                'file_name' => 'roti-keju.svg',
                'bg1' => '#fef3c7',
                'bg2' => '#fde68a',
                'icon' => '🧀🍞',
            ],
            [
                'category_slug' => 'cake-tart',
                'name' => 'Red Velvet Deluxe Cake',
                'slug' => 'red-velvet-deluxe-cake',
                'description' => 'Sponge cake merah beludru yang lembut berpadu harmonis dengan lapisan frosting krim keju autentik dan remahan cake renyah. Pilihan favorit perayaan berharga.',
                'price' => 185000,
                'stock' => 8,
                'weight' => '650 gram (Diameter 18cm)',
                'flavor' => 'Vanilla & Cream Cheese',
                'is_featured' => true,
                'file_name' => 'red-velvet.svg',
                'bg1' => '#881337',
                'bg2' => '#be123c',
                'icon' => '🎂✨',
            ],
            [
                'category_slug' => 'cake-tart',
                'name' => 'Black Forest Classic Tart',
                'slug' => 'black-forest-classic-tart',
                'description' => 'Kue tart klasik legendaris dengan lapisan sponge cokelat pekat, krim segar, selai ceri hitam segar, parutan cokelat melimpah, dan hiasan buah ceri merah maraschino.',
                'price' => 175000,
                'stock' => 6,
                'weight' => '700 gram (Diameter 18cm)',
                'flavor' => 'Dark Chocolate & Ceri Hitam',
                'is_featured' => false,
                'file_name' => 'black-forest.svg',
                'bg1' => '#1c1917',
                'bg2' => '#44403c',
                'icon' => '🍰🍒',
            ],
            [
                'category_slug' => 'pastry-croissant',
                'name' => 'Butter Croissant French Style',
                'slug' => 'butter-croissant-french-style',
                'description' => 'Croissant autentik Prancis dengan ratusan lapisan tipis renyah (flaky) di luar dan sarang lebah (honeycomb) lembut di dalam, menggunakan mentega Prancis berkualitas tinggi.',
                'price' => 22000,
                'stock' => 35,
                'weight' => '75 gram',
                'flavor' => 'Pure French Butter Gurih',
                'is_featured' => true,
                'file_name' => 'croissant.svg',
                'bg1' => '#fffbeb',
                'bg2' => '#fde68a',
                'icon' => '🥐🧈',
            ],
            [
                'category_slug' => 'pastry-croissant',
                'name' => 'Pain au Chocolat',
                'slug' => 'pain-au-chocolat',
                'description' => 'Pastry mentega renyah berbentuk gulungan persegi yang membungkus dua batang stik cokelat hitam couverture pilihan. Disajikan hangat paling nikmat.',
                'price' => 25000,
                'stock' => 20,
                'weight' => '90 gram',
                'flavor' => 'Dark Chocolate Couverture',
                'is_featured' => false,
                'file_name' => 'pain-au-chocolat.svg',
                'bg1' => '#3b1c06',
                'bg2' => '#7c2d12',
                'icon' => '🥐🍫',
            ],
            [
                'category_slug' => 'roti-tawar-sehat',
                'name' => 'Roti Tawar Gandum Utuh Sehat',
                'slug' => 'roti-tawar-gandum-utuh-sehat',
                'description' => 'Roti tawar gandum utuh (whole wheat) kaya serat dan vitamin alami. Tanpa bahan pengawet kimia dan rendah gula. Sangat pas untuk menu diet seimbang dan gaya hidup sehat.',
                'price' => 18000,
                'stock' => 20,
                'weight' => '350 gram (10 slices)',
                'flavor' => 'Gandum Alami Tinggi Serat',
                'is_featured' => true,
                'file_name' => 'roti-gandum.svg',
                'bg1' => '#f5ebd7',
                'bg2' => '#d4b996',
                'icon' => '🌾🍞',
            ],
            [
                'category_slug' => 'roti-tawar-sehat',
                'name' => 'Roti Tawar Susu Hokkaido Lembut',
                'slug' => 'roti-tawar-susu-hokkaido-lembut',
                'description' => 'Roti tawar susu ala Jepang bertekstur kapas selembut awan. Menggunakan susu murni segar yang memberikan aroma wangi manis alami. Lezat dinikmati langsung maupun dipanggang.',
                'price' => 16000,
                'stock' => 18,
                'weight' => '350 gram (10 slices)',
                'flavor' => 'Susu Murni Segar',
                'is_featured' => false,
                'file_name' => 'roti-susu.svg',
                'bg1' => '#eff6ff',
                'bg2' => '#dbeafe',
                'icon' => '🥛🍞',
            ],
            [
                'category_slug' => 'cookies-snack',
                'name' => 'Choco Chip Soft Cookies',
                'slug' => 'choco-chip-soft-cookies',
                'description' => 'Kue kering soft-baked bergaya New York dengan butiran keping cokelat semi-sweet yang berlimpah di seluruh adonan. Renyah di tepian, empuk lumer di tengah.',
                'price' => 35000,
                'stock' => 25,
                'weight' => '200 gram (Isi 6 pcs)',
                'flavor' => 'Choco Chip & Buttermilk',
                'is_featured' => false,
                'file_name' => 'choco-cookies.svg',
                'bg1' => '#fff7ed',
                'bg2' => '#ffedd5',
                'icon' => '🍪✨',
            ],
            [
                'category_slug' => 'cookies-snack',
                'name' => 'Kastengel Keju Edam Asli',
                'slug' => 'kastengel-keju-edam-asli',
                'description' => 'Kastengel premium renyah dibuat menggunakan kombinasi keju edam tua asli Belanda dan cheddar berkualitas. Ditaburi keju parut garing melimpah di setiap batangnya.',
                'price' => 65000,
                'stock' => 15,
                'weight' => '300 gram (Toples)',
                'flavor' => 'Keju Edam Belanda & Cheddar',
                'is_featured' => true,
                'file_name' => 'kastengel.svg',
                'bg1' => '#fefce8',
                'bg2' => '#fef08a',
                'icon' => '🧀✨',
            ],
        ];

        foreach ($items as $item) {
            $cat = Category::where('slug', $item['category_slug'])->first();
            if (!$cat) {
                continue;
            }

            // Create SVG image in storage/public/products
            $imagePath = 'products/' . $item['file_name'];
            $fullPath = storage_path('app/public/' . $imagePath);

            $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 450" width="100%" height="100%">
  <defs>
    <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="' . $item['bg1'] . '" />
      <stop offset="100%" stop-color="' . $item['bg2'] . '" />
    </linearGradient>
  </defs>
  <rect width="600" height="450" fill="url(#bg)" />
  <circle cx="300" cy="180" r="110" fill="#ffffff" opacity="0.2" />
  <circle cx="300" cy="180" r="80" fill="#ffffff" opacity="0.25" />
  
  <text x="300" y="210" font-size="80" text-anchor="middle">' . $item['icon'] . '</text>
  
  <rect x="50" y="315" width="500" height="90" rx="16" fill="#ffffff" opacity="0.95"/>
  <text x="300" y="352" font-family="Arial, sans-serif" font-weight="bold" font-size="22" fill="#1e293b" text-anchor="middle">' . htmlspecialchars($item['name']) . '</text>
  <text x="300" y="382" font-family="Arial, sans-serif" font-weight="bold" font-size="14" fill="#d97706" letter-spacing="1" text-anchor="middle">' . strtoupper($cat->name) . ' • PT DUTA JAYA BAKERY</text>
</svg>';

            File::put($fullPath, $svg);

            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $cat->id,
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image' => $imagePath,
                    'weight' => $item['weight'],
                    'flavor' => $item['flavor'],
                    'is_featured' => $item['is_featured'],
                ]
            );
        }
    }
}
