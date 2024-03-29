<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['url', 'title', 'article_id'];
    
   
    public function article()
    {
        return $this->belongsTo(Article::class, 'id');
    }
}
