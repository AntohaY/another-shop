<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'category_name' => "Costumes",
                'created_at' => new DateTime,
                'updated_at' => null,
            ],
            [
                'category_name' => "Shoes",
                'created_at' => new DateTime,
                'updated_at' => null,
            ]

        ];

        DB::table('categories')->insert($categories);
    }
}
