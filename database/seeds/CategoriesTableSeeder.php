<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(array(
            array(
              'name' => 'JavaScript',
            ),
            array(
              'name' => 'Web Design',
            ),
            array(
              'name' => 'HTML',
            ),
            array(
              'name' => 'CSS',
            ),
            array(
              'name' => 'Tutorials',
            ),
            array(
              'name' => 'Freebies',
            ),
          ));
    }
}
