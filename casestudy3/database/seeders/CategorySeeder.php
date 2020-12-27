<?php

namespace Database\Seeders;

use App\Models\Categories;
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
        $category = new Categories();
        $category->name = "Xã Hội";
        $category->save();
        $category = new Categories();
        $category->name = "Thế Giới";
        $category->save();
        $category = new Categories();
        $category->name = "Kinh Doanh";
        $category->save();

    }
}
