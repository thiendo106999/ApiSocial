<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use App\Models\Tag;
use App\Models\UserInfo;
use App\Models\Video;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function index()
    {
        return response([
            'alo' => Article::find(1)->images()->get(),
            "image" => Image::find(2)->article()->get(),
            'video' => Video::find(1)->article()->get()
        ]);
    }
    public function getArticles()
    {
        $articles =  Article::all();
        $datas = array();
        foreach ($articles as $article) {
            $data['id'] = $article->id;
            $data['content'] = $article->content;
            $data['like'] = $article->like;
            $data['created_at'] = (string)date('d-m-Y H:i:s ', strtotime($article->created_at));
            $video = Video::where('article_id', $article->id);
            $images = Image::where('article_id', $article->id);
            if ($video != null) {
                $data['video'] = $video->pluck('url')->first();
            }
            if ($images != null) {
                $data['images'] = $images->pluck('url');
            }
            array_push($datas, $data);
        }
        return response(
            $datas
        );
    }

    public function create(Request $request)
    {
        try {
            $access_token = $request->header('access_token');
            $user = UserInfo::query();
            $user = $user->where('access_token', $access_token)->first();
            $article = new Article([
                'user_id' => $user->id,
                'content' => $request['content'],
                'like' => 0
            ]);
            $article->save();

            $tags = explode(' ', $request['tags']);
            foreach ($tags as $name_tag) {
                Log::debug($name_tag);

                $tag = new Tag([
                    'article_id' => $article->id,
                    'name_tag' => $name_tag
                ]);
                $tag->save();
            }
        } catch (Exception $e) {
            Log::debug('message' . $e);
        }

        return response()->json([
            'article_id' => $article->id
        ]);
    }
    public function data()
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
    //php artisan serv --host 192.168.1.5        
}
