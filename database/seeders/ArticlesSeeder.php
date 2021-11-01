<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            ['content' => 'Kỹ thuật chăm sóc lúa giai đoạn ra đòng Nguồn: vtc16', 'like' => 0, 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'Hướng dẫn cách nhận biết lúa đang làm đòng _ VTC16-(480p) Nguồn: vtc16', 'like' => 0, 'user_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'Kinh nghiệm, kỹ thuật trồng và chăm sóc mít Thái Lan đạt hiệu quả cao. Nguồn: Bạn của Nhà Nông', 'like' => 0, 'user_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'Tỉa cành, BÓN PHÂN Mít để làm trái để nuôi cây PHÁT TRIỂN MẠNH - KỸ THUẬT TRỒNG MÍT. Nguồn: Siêu thị cây giống', 'like' => 0, 'user_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'Xử lý ra hoa NGHỊCH VỤ MÍT THÁI SIÊU SỚM | Cắt tỉa cành kích thích Mầm Hoa. Nguồn: Giải pháp cây trồng FuGo', 'like' => 0, 'user_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'Ruộng lúa ', 'like' => 0, 'user_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['content' => 'Giống lúa mới ', 'like' => 0, 'user_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
