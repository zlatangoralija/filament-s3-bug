<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'currency_code',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'country_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'country_id');
    }
}
