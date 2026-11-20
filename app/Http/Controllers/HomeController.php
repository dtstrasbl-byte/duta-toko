<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman Beranda Publik PT Duta Jaya Bakery.
     */
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->take(6)
            ->get();

        $categories = Category::withCount('products')
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('featuredProducts', 'categories', 'recentProducts'));
    }

    /**
     * Halaman Profil & Tentang Kami PT Duta Jaya Bakery.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Halaman Kontak & Alamat Duta Bakery.
     */
    public function contact()
    {
        return view('contact');
    }
}
