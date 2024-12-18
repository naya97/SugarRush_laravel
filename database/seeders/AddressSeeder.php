<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $root1 = Address::create([
            'parent_id' => null,
            'region' => 'Damascus',
        ]);
        $root2 = Address::create([
            'parent_id' => null,
            'region' => 'Lattakia',
        ]);
        $root3 = Address::create([
            'parent_id' => null,
            'region' => 'Homs',
        ]);

        Address::create([
            'parent_id' => $root1->id,
            'region' => 'Mazzah',
        ]);
        Address::create([
            'parent_id' => $root1->id,
            'region' => 'Dowelaa',
        ]);
        Address::create([
            'parent_id' => $root1->id,
            'region' => 'BabTooma',
        ]);
        Address::create([
            'parent_id' => $root1->id,
            'region' => 'Baramkeh',
        ]);
        Address::create([
            'parent_id' => $root1->id,
            'region' => 'Dommar',
        ]);

        Address::create([
            'parent_id' => $root2->id,
            'region' => 'Kornesh',
        ]);
        Address::create([
            'parent_id' => $root2->id,
            'region' => 'Dawwar Al_ziraa',
        ]);
        Address::create([
            'parent_id' => $root2->id,
            'region' => ' Jblah',
        ]);

        Address::create([
            'parent_id' => $root3->id,
            'region' => 'Wady Al Thahab',
        ]);
        Address::create([
            'parent_id' => $root3->id,
            'region' => 'Al Khalideiah',
        ]);
        Address::create([
            'parent_id' => $root3->id,
            'region' => 'Sadad',
        ]);
        Address::create([
            'parent_id' => $root3->id,
            'region' => 'Sheen',
        ]);
    }
}
