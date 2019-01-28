<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => "Red tuxedo",
                'description' => 'Red tuxedo',
                'category_name' => "Costumes",
                'units' => 21,
                'price' => 2001.10,
                'image' => 'http://www.pngmart.com/files/6/Tuxedo-PNG-Free-Download.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Black tuxedo",
                'description' => 'Black tuxedo to wear at official parties.',
                'category_name' => "Costumes",
                'units' => 400,
                'price' => 1600.21,
                'image' => 'http://pluspng.com/img-png/suit-hd-png-suit-transparent-png-sticker-3080.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Green sneakers",
                'description' => 'Very good and comfortable green sneakers.',
                'category_name' => "Shoes",
                'units' => 37,
                'price' => 378.00,
                'image' => 'https://i.pinimg.com/236x/9d/79/76/9d797678ee8ae98b39294162ebc941ee--sneakers-shoes-nike-shoes.jpg',
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'name' => 'Black boots',
                'description' => 'Very nice and comfortable black boots.',
                'category_name' => "Shoes",
                'units' => 10,
                'price' => 21.10,
                'image' => 'http://www.stickpng.com/assets/images/580b57fbd9996e24bc43beda.png',
                'created_at' => new DateTime,
                'updated_at' => null,
            ]
        ];

        DB::table('products')->insert($products);
    }
}
