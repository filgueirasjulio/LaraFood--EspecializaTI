<?php

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::all()->each(function($company){
            $company->categories()->saveMany(
                factory(Category::class, 3)->make()  
            );
        });
    }
}
