<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Roti Manis',
                'slug' => 'roti-manis',
                'description' => 'Aneka roti manis lembut dengan isian cokelat, keju, srikaya, dan selai pilihan berkualitas tinggi.',
                'icon' => 'bi-heart-fill',
            ],
            [
                'name' => 'Cake & Tart',
                'slug' => 'cake-tart',
                'description' => 'Kue bolu dan kue tart cantik untuk perayaan ulang tahun, pesta, dan momen spesial keluarga.',
                'icon' => 'bi-cake2-fill',
            ],
            [
                'name' => 'Pastry & Croissant',
                'slug' => 'pastry-croissant',
                'description' => 'Pastry khas Prancis berlapis renyah dengan aroma mentega premium yang harum dan lezat.',
                'icon' => 'bi-fire',
            ],
            [
                'name' => 'Roti Tawar & Sehat',
                'slug' => 'roti-tawar-sehat',
                'description' => 'Roti tawar gandum utuh dan roti susu segar tinggi serat, sehat tanpa bahan pengawet kimia.',
                'icon' => 'bi-shield-check',
            ],
            [
                'name' => 'Cookies & Snack',
                'slug' => 'cookies-snack',
                'description' => 'Kue kering renyah dan camilan gurih istimewa untuk teman minum teh atau hantaran.',
                'icon' => 'bi-star-fill',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
