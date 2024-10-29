<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('Name')
                ->searchable() // Enables real-time searching
                ->options([
                    'PC' => 'PC',
                    'Phone' => 'Phone',
                    'NIC' => 'NIC',
                    'Keyboard' => 'Keyboard',
                    'Monitor' => 'Monitor',
                    'Laptop' => 'Laptop',
                    'Tablet' => 'Tablet',
                    'Smartwatch' => 'Smartwatch',
                    'Router' => 'Router',
                    'Headphones' => 'Headphones',
                    'Speakers' => 'Speakers',
                    'Mouse' => 'Mouse',
                    'Printer' => 'Printer',
                    'Camera' => 'Camera',
                    'Charger' => 'Charger',
                    'Power Bank' => 'Power Bank',
                    'Graphics Card' => 'Graphics Card',
                    'Motherboard' => 'Motherboard',
                    'SSD' => 'SSD',
                    'HDD' => 'HDD',
                ])
                ->placeholder('Select or type a category')
                ->label('Electronic Category'),

            Checkbox::make('Available'),
            FileUpload::make('slug')
            ->disk('public')
            ->directory('categories')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')
                ->searchable(),

                ImageColumn::make('slug')
                ->disk('public') // Ensure it's retrieving from the correct disk
                ->label('Image'),

              ToggleColumn::make('available')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
