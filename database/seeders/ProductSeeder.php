<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* As a sample we will only insert 5 records to use them in our projects */

        $faker = Faker::create();

        DB::table('products')->insert([

            [
                'name' => 'product one',
                'price' => '2000.55',
                'quantity'=>'5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'category_id' => $faker->numberBetween(1,100)
            ],
            [
                'name' => 'product two',
                'price' => '18000',
                'quantity'=>'15',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'category_id' => $faker->numberBetween(1,100)
            ],
            [
                'name' => 'product three',
                'price' => '3000.83',
                'quantity'=>'10',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'category_id' => $faker->numberBetween(1,100)
            ],
            [
                'name' => 'product Four',
                'price' => '4350.83',
                'quantity'=>'6',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'category_id' => $faker->numberBetween(1,100)
            ],
            [
                'name' => 'product Five',
                'price' => '1000.71',
                'quantity'=>'4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'category_id' => $faker->numberBetween(1,100)
            ]

        ]);


    }
}
