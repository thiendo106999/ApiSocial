<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [ 'user_id', 'content', 'like'];

    public function images() {
        return $this->hasOne(Image::class, 'article_id');
    }
    public function video() {
        return $this->hasOne(Video::class, 'article_id');
    }
    public function auth() {
        return $this->belongsTo(UserInfo::class, 'id');
    }
}
