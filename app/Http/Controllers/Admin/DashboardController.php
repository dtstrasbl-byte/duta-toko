<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Dashboard statistik admin.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStock = Product::sum('stock');
        $featuredCount = Product::where('is_featured', true)->count();
        $lowStockProducts = Product::where('stock', '<', 10)->get();
        $latestProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'featuredCount',
            'lowStockProducts',
            'latestProducts'
        ));
    }
}
