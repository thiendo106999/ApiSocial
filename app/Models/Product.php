<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'user_id', 'kind_id', 'phone_number', 'address', 'image', 'date', 'hexta'];
    use HasFactory;

    public function auth() {
        return $this->belongsTo(UserInfo::class, 'id');
    } 
}
