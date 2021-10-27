<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\UserInfo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->file->storeAs('/public', $request['file_name']);
        $path = storage_path('app\public\\' .  $request['file_name']);
        if (!File::exists($path)) {
            abort(404);
        }
        $type = File::mimeType($path);
        if (strpos($type, 'image') !== false) {
            $image = new Image([
                'url' => $request['file_name'],
                'article_id' => $request['article_id']
            ]);
            $image->save();
        } elseif (strpos($type, 'video') !== false) {
            $video = new Video([
                'url' => $request['file_name'],
                'article_id' => $request['article_id']
            ]);
            $video->save();
        }

        return response()->json([
            "message" => "File successfully uploaded",
        ]);
    }
    public function uploadAvatar(Request $request)
    {
        $request->file->storeAs('/public', $request['file_name']);
        $path = storage_path('app\public\\' .  $request['file_name']);
        if (!File::exists($path)) {
            abort(404);
        }

        UserInfo::where('access_token', $request['access_token'])
                ->update(['avatar' => $request['file_name']]);    

        return response()->json([
            "message" => "File successfully uploaded",
        ]);
    }
    public function getImage(Request $request)
    {
        $path = storage_path('app\public\\' . $request->filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
