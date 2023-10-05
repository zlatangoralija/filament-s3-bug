<?php

namespace App\Filament\Resources\PostAttributesResource\Pages;

use App\Filament\Resources\PostAttributesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostAttributes extends ListRecords
{
    protected static string $resource = PostAttributesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
