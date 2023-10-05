<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function postType()
    {
        return $this->belongsTo(PostType::class, 'type_id');
    }
    public function postImages()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }
    public function postAttachments()
    {
        return $this->hasMany(PostAttachment::class, 'post_id');
    }
}
