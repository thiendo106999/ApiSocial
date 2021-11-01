<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        (new UserSeeder())->run();
        (new ArticlesSeeder())->run();
        (new KindProductSeeder())->run();
        (new TagsSeeder())->run();
        (new ImagesSeeder())->run();
        (new VideosSeeder())->run();
        (new ProductsSeeder())->run();
    }
}
