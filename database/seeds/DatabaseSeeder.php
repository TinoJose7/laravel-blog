<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $categories = factory(App\Models\Category::class, 10)->create();

        $categories->each(function ($category) {
            $category
            ->posts()
            ->saveMany(
                factory(App\Models\Post::class, 3)->make()
            );
        });
    }
}
