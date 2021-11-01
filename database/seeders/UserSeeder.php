<?php

namespace Database\Seeders;

use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Prophecy\Call\Call;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_infos')->insert([
            ['name' => 'Nguyễn Văn An', 'address' => 'Long An', 'job' => 'Kỹ sư nông nghiệp', 'year_of_birth' => '1988', 'access_token' => 'mciYBoSReiTsoTMmZCrAup9U5Ym1', 'avatar' => 'mciYBoSReiTsoTMmZCrAup9U5Ym1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Vựa lúa Long An', 'address' => 'Long An', 'job' => 'Kinh Doanh', 'year_of_birth' => '1988', 'access_token' => 'Jp8Uja1B2BTDrIAZieYp9x9V6uF2', 'avatar' => 'mciYBoSReiTsoTMmZCrAup9U5Ym1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Vựa mít Long An', 'address' => 'Long An', 'job' => 'Kinh Doanh', 'year_of_birth' => '1988', 'access_token' => 'Cre17XTplNhM9t8VNiihYYL5gjU2', 'avatar' => 'mciYBoSReiTsoTMmZCrAup9U5Ym1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
