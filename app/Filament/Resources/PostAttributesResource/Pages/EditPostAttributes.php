<?php

namespace App\Filament\Resources\PostAttributesResource\Pages;

use App\Filament\Resources\PostAttributesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostAttributes extends EditRecord
{
    protected static string $resource = PostAttributesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
