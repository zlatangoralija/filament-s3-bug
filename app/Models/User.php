<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'phone',
        'company',
        'preferred_language',
        'privacy',
        'country_id',
        'email',
        'password',
        'group',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->group == self::$_GROUP_ADMIN;
    }

    /**
     * Get the user's full name - used for Filament.
     */
    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's full name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFilamentName(),
        );
    }

    public static $_GROUP_ADMIN = 1;
    public static $_GROUP_INDIVIDUAL = 2;
    public static $_GROUP_COMPANY = 3;

    public static function getGroups(){
        return [
            self::$_GROUP_ADMIN => 'Admin',
            self::$_GROUP_INDIVIDUAL => 'Individual',
            self::$_GROUP_COMPANY => 'Company',
        ];
    }

    public function getGroup(){
        return self::getGroups()[$this->group];
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
