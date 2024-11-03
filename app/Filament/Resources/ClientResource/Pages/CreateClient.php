<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\ClientResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;


    protected function getRedirectUrl(): string
    {
        // Redirects to the index (list) page of the resource
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification{
        return Notification::make()
              ->success()
              ->title("Client created !")
              ->body("the client has been created successfully");
    }



}
