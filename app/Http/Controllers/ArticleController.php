<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use App\Models\Tag;
use App\Models\UserInfo;
use App\Models\Video;
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
                Log::debug(1);
                $data['video'] = $video->pluck('url')->first();
            }
            if ($images != null) {
                $data['images'] = $images->pluck('url');
            }
            array_push($datas, $data);
            
        }
        Log::debug($datas);
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
  
    //php artisan serv --host 192.168.1.5        
}
