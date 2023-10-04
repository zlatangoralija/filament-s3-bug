<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class, 'country_id');
    }
    public function post()
    {
        return $this->hasMany(Post::class, 'country_id');
    }
}
