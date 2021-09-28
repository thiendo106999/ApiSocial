<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [ 'user_id', 'content', 'like'];

    public function images() {
        return $this->hasOne('App\Image');
    }
    public function video() {
        return $this->hasOne('App\Video');
    }
}
