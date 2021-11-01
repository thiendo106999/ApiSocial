<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            ['url' => 'article6_1.jfif', 'article_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['url' => 'article6_2.jfif', 'article_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['url' => 'article7.jpg', 'article_id' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
