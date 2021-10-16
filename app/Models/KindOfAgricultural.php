<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KindOfAgricultural extends Model
{
    protected $table = 'type_of_agricultural_products';
    protected $fillable = ['name'];
    use HasFactory;
}
