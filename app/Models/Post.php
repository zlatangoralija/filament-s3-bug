<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public static $_STATUS_INACTIVE = 0;
    public static $_STATUS_ACTIVE = 1;

    public static function getStatuses(){
        return [
            self::$_STATUS_INACTIVE => 'Inactive',
            self::$_STATUS_ACTIVE => 'Active',
        ];
    }

    public function getStatus(){
        return self::getStatuses()[$this->status];
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function type(){
        return $this->belongsTo(PostType::class, 'type_id');
    }

    public function images(){
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function attachments(){
        return $this->hasMany(PostAttachment::class, 'post_id');
    }
}
