<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Starter',
                'image' => 'image_ek5.png',
                'description' => 'This is a section of your menu. Give your section a brief description',
                'menus' => [
                    [
                        'name' => 'Grilled Okra and Tomatoes',
                        'price' => '20',
                        'description' => 'Tempor id quis elit est pariatur .'
                    ],
                    [
                        'name' => 'Cucumber Salad',
                        'price' => '18',
                        'description' => 'Tempor id quis elit est pariatur .'
                    ],
                    [
                        'name' => 'Basil Pancakes',
                        'price' => '12',
                        'description' => 'Tempor id quis elit est pariatur qui .'
                    ]
                ]
            ],
            [
                'name' => 'Mains',
                'image' => 'image_ek6.png',
                'description' => 'This is a section of your menu. Give your section a brief description',
                'menus' => [
                    [
                        'name' => 'Deap Sea Snow White Cod Fillet',
                        'price' => '20',
                        'description' => 'Tempor id quis elit est pariatur .'
                    ],
                    [
                        'name' => 'Steak With Resemary Butter',
                        'price' => '22',
                        'description' => 'Tempor id quis elit est pariatur .'
                    ],
                    [
                        'name' => 'Steak With Grilled Kimchi',
                        'price' => '12',
                        'description' => 'Tempor id quis elit est pariatur qui .'
                    ]
                ]
            ],
            [
                'name' => 'Pastries & Drinks',
                'image' => 'image_ek7.png',
                'description' => 'This is a section of your menu. Give your section a brief description',
                'menus' => [
                    [
                        'name' => 'Wine Pairing',
                        'price' => '158',
                        'description' => 'Tempor id quis elit est pariatur .'
                    ],
                    [
                        'name' => 'Natural Wine Pairing',
                        'price' => '170',
                        'description' => 'Tempor id quis elit est pariatur .'
                    ],
                    [
                        'name' => 'Whisky Flyer',
                        'price' => '70',
                        'description' => 'Tempor id quis elit est pariatur qui .'
                    ]
                ]
            ]
        ];

        foreach($categories as $categorie){
            $category = Categorie::create([
                'name' => $categorie['name'],
                'image' => $categorie['image'],
                'description' => $categorie['description'],
            ]); 

            foreach($categorie['menus'] as $menu){
                $category->menus()->create([
                    'name' => $menu['name'],
                    'price' => $menu['price'],
                    'description' => $menu['description']
                ]);
            }
        }
    }
}
