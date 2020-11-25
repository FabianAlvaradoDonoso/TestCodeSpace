<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Supplier;
use App\Warehouse;
use App\Product;
use App\Career;
use App\CareerCourse;
use App\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create();
        factory(Supplier::class, 10)->create();
        factory(Warehouse::class, 2)->create();
        factory(Product::class, 100)->create();

        factory(Course::class, 15)->create();
        
        for ($i=0; $i < 10; $i++) {
            DB::table('careers')->insert([
                'name' => 'Ingenieria '.Str::random(10),
                'code' => '210'.mt_rand(10,99),
                ]);
            }
        
        for ($i=0; $i < 10; $i++) {
        DB::table('career_course')->insert([
            'career_id' => mt_rand(1, 10),
            'course_id' => mt_rand(1,15),
            ]);
        }       
    }
}