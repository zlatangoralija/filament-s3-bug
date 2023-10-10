<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'path',
        'featured',
    ];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
