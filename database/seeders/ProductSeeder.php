<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        /* Lee '1'
         */
        //1
        Product::create([
            'name' => 'Box Chocolate',
            'description' => 'A box full of delicious flavors containing 25 pieces',
            'image' => '/storage/images/products/Lee/BoxChocolate.jpg',
            'price' => 75000,
            'totalQuantity' => 35,
            'shop_id' => 1,
        ]);
        //2
        Product::create([
            'name' => 'Brown Chocolate',
            'description' => 'Crunchy chocolate rich with hazelnuts,1 piece',
            'image' => '/storage/images/products/Lee/brownChocolate.jpg',
            'price' => 15000,
            'totalQuantity' => 40,
            'shop_id' => 1,
        ]);
        //3
        Product::create([
            'name' => 'Dark Chocolate',
            'description' => 'Real bitter cocoa chocolate,1 piece',
            'image' => '/storage/images/products/Lee/DarkChocolate.jpg',
            'price' => 30000,
            'totalQuantity' => 40,
            'shop_id' => 1,
        ]);
        //4
        Product::create([
            'name' => 'White Chocolate',
            'description' => 'Sweet vanilla chocolate is rich in great taste, 1 piece',
            'image' => '/storage/images/products/Lee/WhiteChocolate.jpg',
            'price' => 15000,
            'totalQuantity' => 30,
            'shop_id' => 1,
        ]);
        //5
        Product::create([
            'name' => 'Petit Chocolate',
            'description' => 'Small brown chocolate pieces stuffed with raisins,30 pieces per packet',
            'image' => '/storage/images/products/Lee/petitChocolate.jpg',
            'price' => 25000,
            'totalQuantity' => 30,
            'shop_id' => 1,
        ]);
        /* Dessert House Shop '2'
         */
        Product::create([
            'name'=>'Angel Cake',
            'description'=>'Light, fluffy, and heavenly. Perfect for any occasion. Ethereal sweetness in every bite.',
            'image'=>'/storage/images/products/DessertHouse/AngelCake.jpg',
            'price'=>60000,
            'totalQuantity'=>15,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Apple Pie',
            'description'=>'A classic dessert with sweet apples, warm spices, and a flaky crust. Delicious and comforting with every bite.',
            'image'=>'/storage/images/products/DessertHouse/ApplePie.jpg',
            'price'=>50000,
            'totalQuantity'=>12,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Banana Cake',
            'description'=>'A delicious and moist cake made with ripe bananas and topped with crunchy walnuts for an extra nutty flavor.',
            'image'=>'/storage/images/products/DessertHouse/BananaCake.jpg',
            'price'=>35000,
            'totalQuantity'=>20,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Batik Cake',
            'description'=>'A rich chocolate cake with layers of biscuit crumbs and a glossy chocolate glaze.',
            'image'=>'/storage/images/products/DessertHouse/BatikCake.jpg',
            'price'=>25000,
            'totalQuantity'=>50,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Battenberg Cake',
            'description'=>'British checkerboard sponge cake with marzipan.',
            'image'=>'/storage/images/products/DessertHouse/BattenbergCake.jpg',
            'price'=>5000,
            'totalQuantity'=>100,
            'shop_id'=>2,
        ]);
        

        Product::create([
            'name'=>'BirthDay Cake',
            'description'=>' A decadent cake covered in white chocolate and decorated with the word "Happy Birthday" written on top.',
            'image'=>'/storage/images/products/DessertHouse/BirthDayCake.jpg',
            'price'=>100000,
            'totalQuantity'=>10,
            'shop_id'=>2,
        ]);
        Product::create([
            'name'=>'Brownie',
            'description'=>'A rich, chocolate dessert with a dense texture and a rich flavor.',
            'image'=>'/storage/images/products/DessertHouse/Brownie.jpg',
            'price'=>20000,
            'totalQuantity'=>20,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Cheese Cake',
            'description'=>'Cheesecake covered in chocolate and filled with cream guarantees a delicious and rich taste.',
            'image'=>'/storage/images/products/DessertHouse/Cheesecake.jpg',
            'price'=>30000,
            'totalQuantity'=>12,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Cup Cake',
            'description'=>'Oreo cupcake: moist chocolate cupcake with creamy Oreo frosting topped with mini Oreo.',
            'image'=>'/storage/images/products/DessertHouse/Cupcake.jpg',
            'price'=>15000,
            'totalQuantity'=>30,
            'shop_id'=>2,
        ]);

        Product::create([
            'name'=>'Donut',
            'description'=>'Fluffy donuts dipped in rich chocolate glaze for a decadent treat.',
            'image'=>'/storage/images/products/DessertHouse/Donut.jpg',
            'price'=>20000,
            'totalQuantity'=>25,
            'shop_id'=>2,
        ]);
        /* Candy Land Shop '3'
         */
        //1
        Product::create([
            'name' => 'Bears',
            'description' => 'sweet and sour jelly with nice shape of bears ,30 pieces per packet',
            'image' => '/storage/images/products/CandyLand/bears.jpg',
            'price' => 20000,
            'totalQuantity' => 20,
            'shop_id' => 3,
        ]);
        //2
        Product::create([
            'name' => 'Chef',
            'description' => 'Egg-shaped jelly with a sweet and sour taste,20 pieces per packet',
            'image' => '/storage/images/products/CandyLand/BatticuoriBiscuit.jpg',
            'price' => 10000,
            'totalQuantity' => 12,
            'shop_id' => 3,
        ]);
        //3
        Product::create([
            'name' => 'Cola',
            'description' => 'Kids and grown-ups love it so .. ,30 pieces per packet',
            'image' => '/storage/images/products/CandyLand/cola.jpg',
            'price' => 20000,
            'totalQuantity' => 45,
            'shop_id' => 3,
        ]);
        //4
        Product::create([
            'name' => 'IceCreamGello',
            'description' => 'Delicious icecream sweet candy ,10 pieces per packet',
            'image' => '/storage/images/products/CandyLand/IceCrime.jpg',
            'price' => 15000,
            'totalQuantity' => 15,
            'shop_id' => 3,
        ]);
        //5
        Product::create([
            'name' => 'Minions',
            'description' => 'Sweet and sour candies with minions funny shape ,30 pieces per packet',
            'image' => '/storage/images/products/CandyLand/minions.jpg',
            'price' => 25000,
            'totalQuantity' => 13,
            'shop_id' => 3,
        ]);
        //6
        Product::create([
            'name' => 'Skittles',
            'description' => 'Sweet, crunchy candies in different colors,40 pieces per packet',
            'image' => '/storage/images/products/CandyLand/Skittles.jpg',
            'price' => 30000,
            'totalQuantity' => 25,
            'shop_id' => 3,
        ]);
        //7
        Product::create([
            'name' => 'TeethGello',
            'description' => 'sweet candies with funny shape,15 pieces per packet',
            'image' => '/storage/images/products/CandyLand/teeth.jpg',
            'price' => 15000,
            
            'totalQuantity' => 10,
            'shop_id' => 3,
        ]);
        //8
        Product::create([
            'name' => 'The Smurfs',
            'description' => 'sour blue candies with nice shape ,25 pieces per packet',
            'image' => '/storage/images/products/CandyLand/TheSmurfs.jpg',
            'price' => 15000,
            'totalQuantity' => 20,
            'shop_id' => 3,
        ]);
        //9
        Product::create([
            'name' => 'Trolli Strawberry Puffs',
            'description' => 'Jelly pieces with delicious strawberry flavor,25 pieces per packet',
            'image' => '/storage/images/products/CandyLand/TrolliStrawberryPuffs.jpg',
            'price' => 25000,
            'totalQuantity' => 15,
            'shop_id' => 3,
        ]);
        //10
        Product::create([
            'name' => 'Unicorn',
            'description' => 'sweet and sour jello ,25 pieces per packet',
            'image' => '/storage/images/products/CandyLand/unicorn.jpg',
            'price' => 20000,
            'totalQuantity' => 10,
            'shop_id' => 3,
        ]);
        /* Big Bite '4'
         */
        //1
        Product::create([
            'name' => 'Batticuori',
            'description' => 'Biscuits stuffed with dates,5 pieces per packet',
            'image' => '/storage/images/products/BigBite/BatticuoriBiscuit.jpg',
            'price' => 10000,
            'totalQuantity' => 20,
            'shop_id' => 4,
        ]);
        //2
        Product::create([
            'name' => 'Chocolate Cookie',
            'description' => 'Biscuits filled and decorated with chocolate pieces, 2 pieces per packet',
            'image' => '/storage/images/products/BigBite/chocolateCookiesBuiscit.jpg',
            'price' => 15000,
            'totalQuantity' => 20,
            'shop_id' => 4,
        ]);
        //3
        Product::create([
            'name' => 'White Cookie',
            'description' => 'Biscuits filled with milk cream and decorated with chocolate pieces, 2 pieces per packet',
            'image' => '/storage/images/products/BigBite/BatticuoriBiscuit.jpg',
            'price' => 15000,
            'totalQuantity' => 20,
            'shop_id' => 4,
        ]);
        //4
        Product::create([
            'name' => 'Custard Cream',
            'description' => 'Two pieces of criy biscuits filled with custard,2 pieces per packet',
            'image' => '/storage/images/products/BigBite/BatticuoriBiscuit.jpg',
            'price' => 10000,
            'totalQuantity' => 20,
            'shop_id' => 4,
        ]);
        //5
        Product::create([
            'name' => 'Fork Biscuit',
            'description' => 'Crunchy vanilla flavored butter cookies,3 pieces per packet',
            'image' => '/storage/images/products/BigBite/ForkBiscuit.jpg',
            'price' => 5000,
            'totalQuantity' => 20,
            'shop_id' => 4,
        ]);
        //6
        Product::create([
            'name' => 'French Butter Biscuit',
            'description' => 'Light, crunchy tea biscuits that melt in your mouth,12 pieces per packet',
            'image' => '/storage/images/products/BigBite/FrenchButterCookiesBiscuits.jpg',
            'price' => 6000,
            'totalQuantity' => 15,
            'shop_id' => 4,
        ]);
        //7
        Product::create([
            'name' => 'Palmier',
            'description' => 'Light, crunchy, salty biscuits,10 pieces per packet',
            'image' => '/storage/images/products/BigBite/palmier.jpg',
            'price' => 10000,
            'totalQuantity' => 20,
            'shop_id' => 4,
        ]);
        //8
        Product::create([
            'name' => 'Lunnetes',
            'description' => 'Sweet biscuits stuffed with strawberry jam and decorated with powdered sugar,4 pieces per packet',
            'image' => '/storage/images/products/BigBite/lunnetesBiscuit.jpg',
            'price' => 20000,
            'totalQuantity' => 15,
            'shop_id' => 4,
        ]);
        //9
        Product::create([
            'name' => 'Madelene',
            'description' => 'Crispy butter cookies filled with chocolate,7 pieces per packet',
            'image' => '/storage/images/products/BigBite/MadeleinesBuiscit.jpg',
            'price' => 10000,
            'totalQuantity' => 15,
            'shop_id' => 4,
        ]);
        //10
        Product::create([
            'name' => 'Mittai',
            'description' => 'Light, crunchy biscuits with pistachio and caramel,2 pieces per packet',
            'image' => '/storage/images/products/BigBite/MittaiBarBiscuit.jpg',
            'price' => 6000,
            'totalQuantity' => 15,
            'shop_id' => 4,
        ]);
    }
}