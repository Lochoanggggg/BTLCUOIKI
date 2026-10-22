<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ClothingShopSeeder extends Seeder
{
    public function run(): void
    {
        // Demo accounts. Change these passwords before deploying publicly.
        User::updateOrCreate(
            ['email' => 'owner@shop.test'],
            [
                'name' => 'Chủ shop',
                'password' => Hash::make('Owner@12345'),
                'phone' => '0900000001',
                'address' => 'Hà Nội',
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@shop.test'],
            [
                'name' => 'Khách hàng mẫu',
                'password' => Hash::make('Customer@12345'),
                'phone' => '0900000002',
                'address' => 'Hà Nội',
                'role' => 'customer',
            ]
        );

        $categories = [
            ['name' => 'Áo thun', 'slug' => 'ao-thun', 'description' => 'Áo thun nam nữ'],
            ['name' => 'Áo sơ mi', 'slug' => 'ao-so-mi', 'description' => 'Áo sơ mi thường ngày và công sở'],
            ['name' => 'Quần jeans', 'slug' => 'quan-jeans', 'description' => 'Quần jeans nhiều kiểu dáng'],
            ['name' => 'Áo khoác', 'slug' => 'ao-khoac', 'description' => 'Áo khoác theo mùa'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']],
                $category + ['status' => true, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        $brands = [
            ['name' => 'Basic Wear', 'slug' => 'basic-wear', 'description' => 'Thời trang cơ bản'],
            ['name' => 'Urban Style', 'slug' => 'urban-style', 'description' => 'Phong cách đường phố'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->updateOrInsert(
                ['slug' => $brand['slug']],
                $brand + ['created_at' => now(), 'updated_at' => now()]
            );
        }

        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size) {
            DB::table('sizes')->updateOrInsert(
                ['name' => $size],
                ['name' => $size, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        $colors = [
            ['name' => 'Đen', 'hex_code' => '#000000'],
            ['name' => 'Trắng', 'hex_code' => '#FFFFFF'],
            ['name' => 'Xanh navy', 'hex_code' => '#000080'],
            ['name' => 'Be', 'hex_code' => '#DCC7A1'],
        ];

        foreach ($colors as $color) {
            DB::table('colors')->updateOrInsert(
                ['name' => $color['name']],
                $color + ['created_at' => now(), 'updated_at' => now()]
            );
        }

        $categoryIds = DB::table('categories')->pluck('id', 'slug');
        $brandIds = DB::table('brands')->pluck('id', 'slug');
        $sizeIds = DB::table('sizes')->pluck('id', 'name');
        $colorIds = DB::table('colors')->pluck('id', 'name');

        $products = [
            [
                'name' => 'Áo thun basic cotton',
                'slug' => 'ao-thun-basic-cotton',
                'category_id' => $categoryIds['ao-thun'],
                'brand_id' => $brandIds['basic-wear'],
                'description' => 'Áo thun cotton mặc hằng ngày.',
                'price' => 159000,
                'sale_price' => 129000,
            ],
            [
                'name' => 'Áo sơ mi Oxford',
                'slug' => 'ao-so-mi-oxford',
                'category_id' => $categoryIds['ao-so-mi'],
                'brand_id' => $brandIds['urban-style'],
                'description' => 'Áo sơ mi phong cách tối giản.',
                'price' => 299000,
                'sale_price' => null,
            ],
            [
                'name' => 'Quần jeans straight',
                'slug' => 'quan-jeans-straight',
                'category_id' => $categoryIds['quan-jeans'],
                'brand_id' => $brandIds['urban-style'],
                'description' => 'Quần jeans dáng straight dễ phối đồ.',
                'price' => 399000,
                'sale_price' => 349000,
            ],
        ];

        foreach ($products as $productData) {
            DB::table('products')->updateOrInsert(
                ['slug' => $productData['slug']],
                $productData + [
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $productIds = DB::table('products')->pluck('id', 'slug');

        $variants = [
            ['product_slug' => 'ao-thun-basic-cotton', 'size' => 'M', 'color' => 'Đen', 'sku' => 'ATBC-M-DEN', 'stock' => 20],
            ['product_slug' => 'ao-thun-basic-cotton', 'size' => 'L', 'color' => 'Đen', 'sku' => 'ATBC-L-DEN', 'stock' => 15],
            ['product_slug' => 'ao-thun-basic-cotton', 'size' => 'M', 'color' => 'Trắng', 'sku' => 'ATBC-M-TRANG', 'stock' => 18],
            ['product_slug' => 'ao-so-mi-oxford', 'size' => 'M', 'color' => 'Trắng', 'sku' => 'ASM-M-TRANG', 'stock' => 10],
            ['product_slug' => 'ao-so-mi-oxford', 'size' => 'L', 'color' => 'Xanh navy', 'sku' => 'ASM-L-NAVY', 'stock' => 8],
            ['product_slug' => 'quan-jeans-straight', 'size' => 'L', 'color' => 'Đen', 'sku' => 'QJ-L-DEN', 'stock' => 12],
        ];

        foreach ($variants as $variant) {
            DB::table('product_variants')->updateOrInsert(
                ['sku' => $variant['sku']],
                [
                    'product_id' => $productIds[$variant['product_slug']],
                    'size_id' => $sizeIds[$variant['size']],
                    'color_id' => $colorIds[$variant['color']],
                    'sku' => $variant['sku'],
                    'stock' => $variant['stock'],
                    'price' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
