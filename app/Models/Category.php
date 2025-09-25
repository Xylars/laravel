<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function post()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
    protected $fillable = [
        'name',
        'description'
    ];
}
