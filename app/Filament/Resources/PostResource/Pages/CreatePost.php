<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\PostImage;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = Auth::id();
        $record = static::getModel()::create($data);

        if(isset($data['featured_image'])){
            PostImage::create([
                'post_id' => $record->id,
                'path' => $data['featured_image'],
                'featured' => true,
            ]);
        }

        if(isset($data['additional_images'])){
            foreach ($data['additional_images'] as $additionalImage){
                PostImage::create([
                    'post_id' => $record->id,
                    'path' => $additionalImage,
                    'featured' => false,
                ]);
            }
        }

        return $record;
    }
}
