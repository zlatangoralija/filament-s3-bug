<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'type_id',
        'title',
        'description',
        'country_id',
        'city',
        'address',
        'zip_code',
        'latitude',
        'longitude',
        'active',
        'status',
        'price',
        'price_negotiable',
        'attributes',
        'available_from',
        'available_until',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_renewed_on',
    ];

    protected $appends = [
        'featured_image',
        'additional_images',
    ];

    protected $casts = [
        'attachments' => 'array'
    ];

    protected function featuredImage(): Attribute{
        return Attribute::make(
            get: fn () => $this->getFeaturedImage(),
        );
    }

    protected function additionalImages(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getAdditionalImages(),
        );
    }

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

    public function getFeaturedImage(){
        $featuredImage = $this->images()->where('featured', true)->first();
        if($featuredImage){
            return Storage::disk('s3')->url($featuredImage->path);
        }

        return null;
    }

    public function getAdditionalImages(){
        $images = $this->images()->where('featured', false)->get();
        $additionalImages = [];

        foreach ($images as $image){
            $additionalImages[] = Storage::disk('s3')->url($image->path);
        }

        return $additionalImages;
    }
}
