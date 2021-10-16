<?php

namespace App\Http\Controllers;

use App\Models\Agriculcultural;
use App\Models\Article;
use App\Models\Image;
use App\Models\KindOfAgricultural;
use App\Models\Product;
use App\Models\Video;
use Carbon\Carbon;

class AddDataController extends Controller
{
    public function addData()
    {
       $this->addKind();
       $this->addPrice();
       $this->addArticle();
       $this->addDataSample();
    }
    public function addKind(){
        $temp = new KindOfAgricultural([
            'name' => 'lúa gạo',
        ]);
        $temp->save();
        $temp = new KindOfAgricultural([
            'name' => 'hoa màu',
        ]);
        $temp->save();
        $temp = new KindOfAgricultural([
            'name' => 'trái cây',
        ]);
        $temp->save();
    }

    public function addPrice(){
        $price = new Agriculcultural([
            'name' => 'Lúa OM',
            'kind' => 1,
            'price' => '20000',
            'province' => 'An giang',
            'date' => '14-10-2021'
        ]);
        $price->save();
        $price = new Agriculcultural([
            'name' => 'Lúa OM1',
            'kind' => 1,
            'price' => '20000',
            'province' => 'An giang',
            'date' => '14-10-2021'
        ]);
        $price->save();
        $price = new Agriculcultural([
            'name' => 'Lúa OM2',
            'kind' => 1,
            'price' => '20000',
            'province' => 'An giang',
            'date' => '14-10-2021'
        ]);
        $price->save();
        $price = new Agriculcultural([
            'name' => 'Lúa OM3',
            'kind' => 1,
            'price' => '20000',
            'province' => 'An giang',
            'date' => '14-10-2021'
        ]);
        $price->save();
    }

    public function addArticle()
    {
        $temp = new Article([
            'user_id' => 1,
            'content' => 'Đây là khu vườn của tôi.',
            'like' => 10,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $temp->save();
        $temp = new Article([
            'user_id' => 2,
            'content' => 'Quy trình chăm sóc lúa làm đòng',
            'like' => 100,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $temp->save();
        $temp = new Article([
            'user_id' => 2,
            'content' => 'Cách bón phân hợp lý trước khi gieo giống',
            'like' => 100,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $temp->save();
        $temp = new Article([
            'user_id' => 2,
            'content' => 'Cách bón phân hợp lý qua các giai đoạn',
            'like' => 100,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $temp->save();
        $video = new Video([
            'url' => 'https://www.youtube.com/watch?v=5Ah6V7ftLmA&t=1s',
            'title' => 'Quy trình chăm sóc lúa làm đòng. Nguồn: Kênh VTC16',
            'article_id' => 2,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $video->save();
        $video = new Video([
            'url' => 'https://www.youtube.com/watch?v=-fNC_y2GROo',
            'title' => 'Cách bón phân hợp lý trước khi gieo giống. Nguồn: HẠT GIỐNG PHÚ NÔNG',
            'article_id' => 3,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $video->save();

        $video = new Video([
            'url' => 'https://www.youtube.com/watch?v=cK5jBog5G98',
            'title' => 'Cách bón phân hợp lý trước khi gieo giống. Nguồn: Nông Nghiệp Mekong',
            'article_id' => 4,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $video->save();

        $image = new Image([
            'url' => 'https://www.homestaygianghia.com/upload/dulich/mit/vuon-mit-dak-nong-12.jpg',
            'article_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $image->save();
        $image = new Image([
            'url' => 'https://cafefcdn.com/thumb_w/650/2020/photo1593500097851-1593500098094-crop-1593500139519812356071.jpg',
            'article_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $image->save();
    }
    public function addDataSample()
    {
        $product = new Product([
            'name' => 'Thanh Long',
            'user_id' => 1,
            'phone_number' => '0909118634',
            'address' => 'Vĩnh Long',
            'image' => 'https://vnn-imgs-a1.vgcloud.vn/cafefcdn.com/203337114487263232/2020/11/9/photo-1-1604877666370206932682.jpg',
            'date' => '16-10-2021',
            'hexta' => 1,
            'kind_id' => 3
        ]);
        $product->save();

        $product = new Product([
            'name' => 'Thanh Long',
            'user_id' => 1,
            'phone_number' => '0909118634',
            'address' => 'Vĩnh Long',
            'image' => 'https://vnn-imgs-a1.vgcloud.vn/cafefcdn.com/203337114487263232/2020/11/9/photo-1-1604877666370206932682.jpg',
            'date' => '16-10-2021',
            'hexta' => 1,
            'kind_id' => 3
        ]);
        $product->save();

        $product = new Product([
            'name' => 'Thanh Long',
            'user_id' => 1,
            'phone_number' => '0909118634',
            'address' => 'Vĩnh Long',
            'image' => 'https://vnn-imgs-a1.vgcloud.vn/cafefcdn.com/203337114487263232/2020/11/9/photo-1-1604877666370206932682.jpg',
            'date' => '16-10-2021',
            'hexta' => 1,
            'kind_id' => 3
        ]);
        $product->save();

        $product = new Product([
            'name' => 'Thanh Long',
            'user_id' => 1,
            'phone_number' => '0909118634',
            'address' => 'Vĩnh Long',
            'image' => 'https://vnn-imgs-a1.vgcloud.vn/cafefcdn.com/203337114487263232/2020/11/9/photo-1-1604877666370206932682.jpg',
            'date' => '16-10-2021',
            'hexta' => 1,
            'kind_id' => 3
        ]);
        $product->save();

        $product = new Product([
            'name' => 'Thanh Long',
            'user_id' => 1,
            'phone_number' => '0909118634',
            'address' => 'Vĩnh Long',
            'image' => 'https://vnn-imgs-a1.vgcloud.vn/cafefcdn.com/203337114487263232/2020/11/9/photo-1-1604877666370206932682.jpg',
            'date' => '16-10-2021',
            'hexta' => 1,
            'kind_id' => 3
        ]);
        $product->save();

    }
}
