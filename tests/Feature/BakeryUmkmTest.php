<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BakeryUmkmTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test Halaman Beranda Publik PT Duta Jaya Bakery.
     */
    public function test_home_page_displays_company_name_and_description(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('PT Duta Jaya Bakery');
        $response->assertSee('Duta Bakery');
        $response->assertSee('Duta Bakery merupakan usaha UMKM yang bergerak di bidang kuliner');
    }

    /**
     * Test Relasi Eloquent antarmodel Category dan Product.
     */
    public function test_eloquent_relationship_between_category_and_product(): void
    {
        $category = Category::where('slug', 'roti-manis')->first();
        $this->assertNotNull($category);
        $this->assertTrue($category->products()->count() > 0);

        $product = $category->products()->first();
        $this->assertEquals($category->id, $product->category->id);
    }

    /**
     * Test Halaman Katalog Publik dan Pencarian.
     */
    public function test_public_catalog_and_filtering(): void
    {
        $response = $this->get('/katalog');
        $response->assertStatus(200);
        $response->assertSee('Katalog Produk');

        // Test filter kategori
        $filteredResponse = $this->get('/katalog?category=roti-manis');
        $filteredResponse->assertStatus(200);

        // Test pencarian
        $searchResponse = $this->get('/katalog?search=Cokelat');
        $searchResponse->assertStatus(200);
    }

    /**
     * Test Halaman Detail Produk Publik.
     */
    public function test_product_detail_page(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->get('/produk/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->formatted_price);
    }

    /**
     * Test Halaman Tentang Kami dan Kontak.
     */
    public function test_about_and_contact_pages(): void
    {
        $aboutResponse = $this->get('/tentang-kami');
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee('PT Duta Jaya Bakery');
        $aboutResponse->assertSee('Duta Satria Sabil');

        $contactResponse = $this->get('/kontak');
        $contactResponse->assertStatus(200);
        $contactResponse->assertSee('Kontak & Lokasi');
    }

    /**
     * Test Login Page ditampilkan.
     */
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Admin Panel');
    }

    /**
     * Test Admin harus login untuk akses dashboard.
     */
    public function test_admin_routes_require_authentication(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test Login berhasil dengan kredensial benar.
     */
    public function test_admin_can_login_with_correct_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email'    => 'admin@dutabakery.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    /**
     * Test Login gagal dengan password salah.
     */
    public function test_admin_cannot_login_with_wrong_password(): void
    {
        $response = $this->post('/admin/login', [
            'email'    => 'admin@dutabakery.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test Dashboard Admin (harus login).
     */
    public function test_admin_dashboard(): void
    {
        $admin = User::where('email', 'admin@dutabakery.com')->first();

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Total Produk');
        $response->assertSee('Kategori');
    }

    /**
     * Test CRUD Admin: Tambah Produk Baru dengan Validasi & Upload Gambar.
     */
    public function test_admin_can_store_product_with_image_upload(): void
    {
        Storage::fake('public');

        $admin = User::where('email', 'admin@dutabakery.com')->first();
        $category = Category::first();
        $file = UploadedFile::fake()->create('croissant-baru.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Croissant Keju Almond',
            'description' => 'Croissant renyah berlapis dengan taburan kacang almond panggang dan isian keju lumer.',
            'price' => 28000,
            'stock' => 15,
            'weight' => '110 gram',
            'flavor' => 'Keju Almond Gurih',
            'is_featured' => 1,
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'name' => 'Croissant Keju Almond',
            'price' => 28000,
        ]);

        $product = Product::where('name', 'Croissant Keju Almond')->first();
        $this->assertNotNull($product->image);
        Storage::disk('public')->assertExists($product->image);
    }

    /**
     * Test Validasi Server-Side: Minimal 3 Aturan (required, max, numeric/integer).
     */
    public function test_server_side_validation_fails_when_inputs_invalid(): void
    {
        $admin = User::where('email', 'admin@dutabakery.com')->first();

        // 1. Uji required
        $response = $this->actingAs($admin)->post(route('admin.products.store'), []);
        $response->assertSessionHasErrors(['name', 'category_id', 'price', 'stock', 'description']);

        // 2. Uji tipe data & batas minimum
        $responseInvalid = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Roti Test',
            'category_id' => 9999, // tidak ada di database
            'price' => -500, // negatif
            'stock' => 'bukan-angka', // bukan integer
            'description' => 'deskripsi',
        ]);
        $responseInvalid->assertSessionHasErrors(['category_id', 'price', 'stock']);

        // 3. Uji batas maksimal karakter
        $longName = str_repeat('A', 200); // max 150
        $responseMax = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => $longName,
            'category_id' => Category::first()->id,
            'price' => 10000,
            'stock' => 5,
            'description' => 'deskripsi',
        ]);
        $responseMax->assertSessionHasErrors(['name']);
    }

    /**
     * Test Admin Update Produk.
     */
    public function test_admin_can_update_product(): void
    {
        $admin = User::where('email', 'admin@dutabakery.com')->first();
        $product = Product::first();

        $response = $this->actingAs($admin)->put(route('admin.products.update', $product->id), [
            'category_id' => $product->category_id,
            'name' => $product->name . ' Updated',
            'description' => 'Deskripsi produk baru yang telah diperbarui oleh admin.',
            'price' => 20000,
            'stock' => 50,
            'weight' => '150 gram',
            'flavor' => 'Updated Flavor',
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name . ' Updated',
            'price' => 20000,
        ]);
    }

    /**
     * Test Admin Delete Produk.
     */
    public function test_admin_can_delete_product(): void
    {
        $admin = User::where('email', 'admin@dutabakery.com')->first();
        $category = Category::first();
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Produk Untuk Dihapus',
            'slug' => 'produk-untuk-dihapus',
            'description' => 'Produk uji coba penghapusan.',
            'price' => 10000,
            'stock' => 5,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.products.destroy', $product->id));
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test Admin Logout.
     */
    public function test_admin_can_logout(): void
    {
        $admin = User::where('email', 'admin@dutabakery.com')->first();

        $response = $this->actingAs($admin)->post(route('admin.logout'));
        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
