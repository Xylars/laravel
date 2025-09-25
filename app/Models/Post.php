<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function category() {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id','category_id');
    }
    public function tag() {
        return $this->belongsToMany(Tag::class,'post_tag', 'post_id', 'tag_id');
    }
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
}
