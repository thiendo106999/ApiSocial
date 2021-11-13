<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function getPersonalPage(Request $request)
    {
        $user = UserInfo::where('access_token', $request['access_token'])
            ->select('id', 'name', 'job', 'address', 'avatar', 'year_of_birth', 'list_id_articles')
            ->get()
            ->first();
        $listArticles = [];
        $query = Article::leftJoin('user_infos', 'articles.user_id', 'user_infos.id')
            ->leftJoin('videos', 'articles.id', 'videos.id')
            ->where('user_id', $user['id']);
        if ($user['list_id_articles'] != null) {
            $listArticles = explode(',', $user['list_id_articles']);
            $query->orWhereIn('articles.id', $listArticles);
        }
        $user_old = UserInfo::where('access_token', $request->access_token)->select('id', 'articles_like')->first();
        $artile_like = explode(',', $user_old['articles_like']);

        $articles = $query
            ->orderBy('created_at')
            ->select(
                'articles.id as id',
                'articles.content as content',
                'user_infos.access_token',
                'user_infos.avatar',
                'like',
                'user_infos.name as user_name',
                'media_id',
                'articles.created_at',
                'videos.url as url',
            )->get();

            $datas = array();
            foreach ($articles as $article) {
                $data['id'] = $article['id'];
                $data['access_token'] = $article['access_token'];
                $data['user_name'] = $article['user_name'];
                $data['avatar'] = $article['avatar'];
                $data['content'] = $article['content'];
                $data['like'] = $article['like'];
                $data['created_at'] = (string)date('d-m-Y H:i:s ', strtotime($article['created_at']));
                $data['video'] = $article['url'];
                $data['images'] = $article['media_id'];

                $like = array_search($article['id'], $artile_like); 

                if ($like !== false) {
                    $data['liked'] = true;
                } else {
                    $data['liked'] = false;
                }
                array_push($datas, $data);
            }

        return response()->json([
            'user_name' => $user['name'],
            'avatar' => $user['avatar'],
            'articles' => $datas
        ]);
    }

    public function getArticles(Request $request)
    {
        try {
            $query = Tag::query();
            if (!empty($request['tags'])) {
                $tags = explode(' ', $request['tags']);
                foreach ($tags as $tag) {
                    $query->orWhere('name_tag', $tag);
                }
            }
            $article_ids = $query->distinct()->get('article_id')->toArray();
            $articles = Article::leftJoin('user_infos', 'articles.user_id', 'user_infos.id')
                ->leftJoin('videos', 'articles.id', 'videos.id')
                ->whereIn('articles.id', $article_ids)
                ->orderBy('created_at')
                ->select(
                    'articles.id as id',
                    'articles.content as content',
                    'user_infos.access_token',
                    'user_infos.avatar',
                    'like',
                    'user_infos.name as user_name',
                    'media_id',
                    'articles.created_at',
                    'videos.url as url',
                )->get();
            $user_old = UserInfo::where('access_token', $request->access_token)->select('id', 'articles_like')->first();
            $listArticles = explode(',', $user_old['articles_like']);

            $datas = array();
            foreach ($articles as $article) {
                $data['id'] = $article['id'];
                $data['access_token'] = $article['access_token'];
                $data['user_name'] = $article['user_name'];
                $data['avatar'] = $article['avatar'];
                $data['content'] = $article['content'];
                $data['like'] = $article['like'];
                $data['created_at'] = (string)date('d-m-Y H:i:s ', strtotime($article['created_at']));
                $data['video'] = $article['url'];
                $data['images'] = $article['media_id'];

                $like = array_search($article['id'], $listArticles); 

                if ($like !== false) {
                    $data['liked'] = true;
                } else {
                    $data['liked'] = false;
                }
                
                array_push($datas, $data);
            }
            Log::debug($datas);
        } catch (Exception $e) {
            Log::debug('Get acticles: ' . $e);
        }

        return response(
            $datas
        );
    }
    public function create(Request $request)
    {
        try {
            Log::debug($request['media_id']);
            $access_token = $request->header('access_token');
            $user = UserInfo::query();
            $user = $user->where('access_token', $access_token)->first();
            $article = new Article([
                'user_id' => $user->id,
                'content' => $request['content'],
                'like' => 0,
                'media_id' => $request['media_id']
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

    public function share(Request $request)
    {
        $user_old = UserInfo::where('access_token', $request['access_token'])->select('id', 'list_id_articles')->first();
        Log::debug($user_old);
        $listArticles = explode(',', $user_old['list_id_articles']);
        Log::debug($listArticles);
        if ($user_old['list_id_articles'] === '') {
            $user = UserInfo::find(intval($user_old->id));
            $user->list_id_articles = $request['article_id'];
            $user->save();
        } elseif (!in_array( $request['article_id'], $listArticles)) {
            $user = UserInfo::find(intval($user_old->id));
            $user->list_id_articles = $user_old['list_id_articles'] . ',' . $request['article_id'];
            $user->save();
        };
    }

    public function like(Request $request)
    {
        $user_old = UserInfo::where('access_token', $request['access_token'])->select('id', 'articles_like')->first();
        Log::debug($user_old);
        $listArticles = explode(',', $user_old['articles_like']);
        
        $like = array_search($request['article_id'], $listArticles); 
        $user = UserInfo::find(intval($user_old->id));
        $article = Article::find(intval($request['article_id']));

        if ($like === false) {
            if ($user_old['articles_like'] === '') {
                $user->articles_like = $request['article_id'];
            } elseif (!in_array( $request['article_id'], $listArticles)) {
                $user->articles_like = $user_old['articles_like'] . ',' . $request['article_id'];
            };
            $article->like++;
        } else {
            unset($listArticles[$like]);
            $user->articles_like = implode(",", $listArticles);
            if ($article->like != 0 )
                $article->like--;
        }
        $user->save();
        $article->save();
    }

    //php artisan serv --host 192.168.1.5        
}
