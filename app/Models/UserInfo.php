<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = ['name', 'job', 'address', 'year_of_birth', 'access_token'];
    use HasFactory;
}
