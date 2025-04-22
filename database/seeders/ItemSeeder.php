<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => 'Laptop',
            'description' => 'High-performance laptop for gaming and work.',
            'price_per_day' => 150000,
            'stock' => 10,
            'category_id' => 1,
            'image' => 'storage/app/public/images/01JS16QAFQWYGTZFBW7D90PGMW.jpg',
            'fungsi' => 'Laptop untuk gaming dan kerja',
        ]);
    }
}