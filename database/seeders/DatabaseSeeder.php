<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => config('site.admin_email')],
            ['name' => 'Admin', 'password' => config('site.admin_password')]
        );

        if (Product::count() === 0) {
            foreach (config('site.products') as $i => $p) {
                Product::create([
                    'name'        => $p['name'],
                    'line1'       => $p['line1'],
                    'line2'       => $p['line2'],
                    'description' => $p['text'],
                    'image'       => 'images/products/' . $p['image'],
                    'sort_order'  => $i + 1,
                    'is_active'   => true,
                ]);
            }
        }
    }
}
