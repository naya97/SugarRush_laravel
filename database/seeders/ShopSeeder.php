<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        Shop::create([
            'name'=>'lee',
            'description'=>'we have all delicious chocolate you want',
            'location'=>'Mazzah',
            'image'=>'/storage/images/shops/lee.jpg',
        ]);

        Shop::create([
            'name'=>'Dessert House',
            'description'=>'ordering cake from home',
            'location'=>'Dowelaa',
            'image'=>'/storage/images/shops/DessertHouse.jpg',
        ]);

        Shop::create([
            'name'=>'Candy Land',
            'description'=>'be happy with our candies',
            'location'=>'Bab Tomah',
            'image'=>'/storage/images/shops/CandyLand.jpg',
        ]);

        Shop::create([
            'name'=>'Big Bite',
            'description'=>'take a big bite from our buscuits',
            'location'=>'Baramkah',
            'image'=>'/storage/images/shops/BigBite.jpg',
        ]);
    
    }
}
