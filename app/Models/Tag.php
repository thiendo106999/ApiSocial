<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['article_id', 'name_tag'];
    public function article()
    {
        return $this->belongsTo(Article::class, 'id');
    }}
