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
        DB::table('tags')->insert(['id' => 1, 'name' => 'Cheap', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 2, 'name' => 'Healthy', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 3, 'name' => 'Fast', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 4, 'name' => 'Near', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 5, 'name' => 'Pizza', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 6, 'name' => 'Kebab', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 7, 'name' => 'French', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 8, 'name' => 'Burger', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 9, 'name' => 'Italian', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 10, 'name' => 'American', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 11, 'name' => 'Mexican', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 12, 'name' => 'Moroccan', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 13, 'name' => 'Sushi', 'color' => 'vert']);
        DB::table('tags')->insert(['id' => 14, 'name' => 'Sandwiches', 'color' => 'vert']);
    }
}
