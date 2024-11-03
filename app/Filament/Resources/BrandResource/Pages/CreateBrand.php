<?php

namespace App\Filament\Resources\BrandResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\BrandResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;


    protected function getRedirectUrl(): string
    {
        // Redirects to the index (list) page of the resource
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification{
        return Notification::make()
              ->success()
              ->title("Brand created !")
              ->body("the brand has been created successfully");
    }

}
