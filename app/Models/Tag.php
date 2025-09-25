<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    public function post() {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
    protected $fillable = [
        "name",
    ];
}
