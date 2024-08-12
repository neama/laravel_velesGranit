<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        $this->call(CategoryTableSeeder::class);
        $this->command->info('Таблица категорий загружена данными!');

        $this->call(BrandTableSeeder::class);
        $this->command->info('Таблица брендов загружена данными!');

        $this->call(ProductTableSeeder::class);
        $this->command->info('Таблица товаров загружена данными!');
    }
}
