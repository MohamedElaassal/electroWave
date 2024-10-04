<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;


    protected function getRedirectUrl(): string
    {
        // Redirects to the index (list) page of the resource
        return $this->getResource()::getUrl('index');
    }

}
