<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            ['article_id' => 1, 'name_tag' => '#luagao', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 1, 'name_tag' => '#phanbon', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 2, 'name_tag' => '#luagao', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 3, 'name_tag' => '#traicay', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 4, 'name_tag' => '#traicay', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 5, 'name_tag' => '#traicay', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 6, 'name_tag' => '#traicay', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['article_id' => 7, 'name_tag' => '#luagao', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
