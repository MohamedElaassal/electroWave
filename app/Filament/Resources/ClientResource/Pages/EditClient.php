<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ClientResource;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification{
        return Notification::make()
              ->warning()
              ->title("Client Updated !")
              ->body("the client has been Updated successfully");
    }
}
