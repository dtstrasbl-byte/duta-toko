<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'weight',
        'flavor',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot the model. Automatically create slug if not provided.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(4);
            }
        });
    }

    /**
     * Relasi Eloquent: Produk dimiliki oleh satu Kategori (many-to-one).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Format harga Rupiah.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * URL Gambar produk, fallback ke placeholder jika belum ada gambar.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('images/default-bakery.svg');
    }


}
