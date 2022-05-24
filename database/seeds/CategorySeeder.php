<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name' => 'Economia'
            ],
            [
                'name' => 'Sport'
            ],
            [
                'name' => 'Politica'
            ],
            [
                'name' => 'Sociale'
            ],
            [
                'name' => 'Curiosità'
            ],
            [
                'name' => 'Cultura'
            ],
            [
                'name' => 'Salute'
            ],
            [
                'name' => 'Ambiente'
            ],
            [
                'name' => 'Attualità'
            ],
            [
                'name' => 'Cinema'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
