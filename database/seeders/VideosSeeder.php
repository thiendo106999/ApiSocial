<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            ['url' => 'article1.mp4', 'article_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['url' => 'article2.mp4', 'article_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['url' => 'article3.mp4', 'article_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['url' => 'article4.mp4', 'article_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['url' => 'article5.mp4', 'article_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
