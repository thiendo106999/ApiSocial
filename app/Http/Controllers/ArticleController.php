<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {

        
 
        return response(
            'alo'
        );
    }

    public function data()
    {
       $temp = new Article([
            'user_id' => 1,
            'content' => 'Đây là khu vườn của tôi.',
            'like' => 10
        ]);
        $temp->save();
        $temp = new Article([
            'user_id' => 2,
            'content' => 'Quy trình chăm sóc lúa làm đòng',
            'like' => 100
        ]);
        $temp->save();
        $temp = new Article([
            'user_id' => 2,
            'content' => 'Cách bón phân hợp lý trước khi gieo giống',
            'like' => 100
        ]);
        $temp->save();
        $temp = new Article([
            'user_id' => 2,
            'content' => 'Cách bón phân hợp lý qua các giai đoạn',
            'like' => 100
        ]);
        $temp->save();
        $video = new Video([
            'url' => 'https://www.youtube.com/watch?v=5Ah6V7ftLmA&t=1s', 
            'title' => 'Quy trình chăm sóc lúa làm đòng. Nguồn: Kênh VTC16', 
            'article_id' => 2
        ]);
        $video->save();
        $video = new Video([
            'url' => 'https://www.youtube.com/watch?v=-fNC_y2GROo', 
            'title' => 'Cách bón phân hợp lý trước khi gieo giống. Nguồn: HẠT GIỐNG PHÚ NÔNG', 
            'article_id' => 2
        ]);
        $video->save();

        $video = new Video([
            'url' => 'https://www.youtube.com/watch?v=cK5jBog5G98', 
            'title' => 'Cách bón phân hợp lý trước khi gieo giống. Nguồn: Nông Nghiệp Mekong', 
            'article_id' => 2
        ]);
        $video->save();

        $image = new Image([
            'url' => 'https://www.homestaygianghia.com/upload/dulich/mit/vuon-mit-dak-nong-12.jpg', 
            'article_id' => 1
        ]);
        $image->save();
        $image = new Image([
            'url' => 'https://cafefcdn.com/thumb_w/650/2020/photo1593500097851-1593500098094-crop-1593500139519812356071.jpg', 
            'article_id' => 1
        ]);
        $image->save();
    }
}
