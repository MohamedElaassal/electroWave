<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientResource\RelationManagers;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $recordTitleAttribute = 'Name';

    protected static ?string $navigationGroup = 'Clients management';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Name')
                ->required()
                ->label('Client Name'),

            TextInput::make('Phone')
                ->required()
                ->label('Phone Number')
                ->tel(),

            TextInput::make('Email')
                ->required()
                ->email()
                ->label('Email Address'),

            FileUpload::make('img')
                ->label('Client Image')
                ->image()
                ->directory('clients')
                ->visibility('public')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')
                    ->sortable()
                    ->searchable()
                    ->label('Client Name'),

                TextColumn::make('Phone')
                    ->label('Phone Number')
                    ->searchable(),

                TextColumn::make('Email')
                    ->label('Email Address')
                    ->searchable(),

                ImageColumn::make('img')
                    ->label('Client Image')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                ->successNotificationTitle("Client deleted successfully")
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
