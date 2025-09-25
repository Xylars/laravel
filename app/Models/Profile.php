<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }
    protected $fillable = [
        'bio',
        'avatar'
    ];
}
