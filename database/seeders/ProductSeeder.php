<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $coffee = Category::where('slug', 'coffee')->first();
        $noncoffee = Category::where('slug', 'non-coffee')->first();
        $snack = Category::where('slug', 'snack')->first();

        // COFFEE
        $coffeeProducts = [
            ['Espresso', 18000, 50, 'Kopi pekat untuk energi maksimal.'],
            ['Americano', 20000, 50, 'Espresso + air, ringan tapi nendang.'],
            ['Cappuccino', 25000, 40, 'Perpaduan espresso & foam susu lembut.'],
            ['Latte', 26000, 40, 'Susu lebih dominan, creamy dan smooth.'],
            ['Mocha', 28000, 35, 'Latte + coklat, manis & nikmat.'],
            ['Caramel Latte', 30000, 30, 'Latte dengan rasa caramel.'],
            ['Hazelnut Latte', 30000, 30, 'Latte dengan aroma hazelnut.'],
            ['Vanilla Latte', 30000, 30, 'Latte dengan rasa vanilla.'],
            ['Affogato', 32000, 20, 'Espresso + ice cream vanilla.'],
            ['Cold Brew', 27000, 35, 'Kopi dingin yang segar dan smooth.'],
            ['Iced Americano', 22000, 45, 'Americano dingin favorit semua orang.'],
        ];

        foreach ($coffeeProducts as $p) {
            Product::create([
                'category_id' => $coffee->id,
                'name' => $p[0],
                'slug' => Str::slug($p[0]),
                'price' => $p[1],
                'stock' => $p[2],
                'description' => $p[3],
                'is_active' => true,
            ]);
        }

        // NON-COFFEE
        $nonCoffeeProducts = [
            ['Matcha Latte', 28000, 40, 'Matcha creamy khas Jepang.'],
            ['Chocolate', 25000, 40, 'Coklat hangat/dingin yang rich.'],
            ['Taro Latte', 27000, 35, 'Taro creamy dengan aroma khas.'],
            ['Red Velvet', 28000, 35, 'Minuman merah lembut & manis.'],
            ['Thai Tea', 26000, 45, 'Thai tea manis segar.'],
            ['Lemon Tea', 22000, 50, 'Teh lemon segar untuk siang hari.'],
            ['Peach Tea', 24000, 40, 'Teh dengan rasa peach wangi.'],
            ['Mineral Water', 8000, 100, 'Air mineral dingin.'],
        ];

        foreach ($nonCoffeeProducts as $p) {
            Product::create([
                'category_id' => $noncoffee->id,
                'name' => $p[0],
                'slug' => Str::slug($p[0]),
                'price' => $p[1],
                'stock' => $p[2],
                'description' => $p[3],
                'is_active' => true,
            ]);
        }

        // SNACK
        $snackProducts = [
            ['French Fries', 20000, 50, 'Kentang goreng crispy.'],
            ['Onion Rings', 22000, 40, 'Bawang goreng tepung gurih.'],
            ['Chicken Nugget', 25000, 35, 'Nugget ayam hangat.'],
            ['Toast Chocolate', 23000, 30, 'Roti panggang coklat manis.'],
            ['Toast Cheese', 24000, 30, 'Roti panggang keju gurih.'],
            ['Croissant Butter', 28000, 20, 'Croissant buttery renyah.'],
            ['Brownies', 26000, 25, 'Brownies coklat legit.'],
            ['Donut Sugar', 18000, 30, 'Donat tabur gula.'],
            ['Cookies', 15000, 40, 'Cookies crunchy manis.'],
        ];

        foreach ($snackProducts as $p) {
            Product::create([
                'category_id' => $snack->id,
                'name' => $p[0],
                'slug' => Str::slug($p[0]),
                'price' => $p[1],
                'stock' => $p[2],
                'description' => $p[3],
                'is_active' => true,
            ]);
        }
    }
}
