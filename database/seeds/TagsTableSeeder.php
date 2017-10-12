<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(['id' => 1, 'name' => 'Cheap', 'category' => 'main']);
        DB::table('tags')->insert(['id' => 2, 'name' => 'Healthy', 'category' => 'main']);
        DB::table('tags')->insert(['id' => 3, 'name' => 'Fast', 'category' => 'main']);
        DB::table('tags')->insert(['id' => 4, 'name' => 'Near', 'category' => 'main']);
        DB::table('tags')->insert(['id' => 5, 'name' => 'Huge', 'category' => 'main']);
        DB::table('tags')->insert(['id' => 6, 'name' => 'Fat', 'category' => 'main']);
        DB::table('tags')->insert(['id' => 7, 'name' => 'Pizza', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 8, 'name' => 'Burger', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 9, 'name' => 'Italian', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 10, 'name' => 'American', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 11, 'name' => 'Mexican', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 12, 'name' => 'Moroccan', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 13, 'name' => 'Sushi', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 14, 'name' => 'Sandwiches', 'category' => 'second']);
        DB::table('tags')->insert(['id' => 15, 'name' => 'Kebab', 'category' => 'second']);
    }
}
