<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
             TextInput::make('Name'),
             TextInput::make('Price')
             ->numeric()
                ->prefix('€'),

                Select::make('brand_id')
                ->relationship('Brand', 'Name')
                  ->searchable()
                  ->preload()
                  ->createOptionForm([
                   Select::make('Name')
                   ->searchable()
                   ->options([
                    'Apple' => 'Apple',
                    'Samsung' => 'Samsung',
                    'Sony' => 'Sony',
                    'LG' => 'LG',
                    'Microsoft' => 'Microsoft',
                    'Dell' => 'Dell',
                    'HP' => 'HP',
                    'Lenovo' => 'Lenovo',
                    'Asus' => 'Asus',
                    'Acer' => 'Acer',
                    'Huawei' => 'Huawei',
                    'Xiaomi' => 'Xiaomi',
                    'OnePlus' => 'OnePlus',
                    'Google' => 'Google',
                    'Nokia' => 'Nokia',
                    'Panasonic' => 'Panasonic',
                    'Philips' => 'Philips',
                    'Toshiba' => 'Toshiba',
                    'Intel' => 'Intel',
                    'AMD' => 'AMD',
                    'Nvidia' => 'Nvidia',
                ])
                   ->placeholder('Select a category')
                   ->label('Brand Name'),

                        FileUpload::make('slug')
                        ->disk('public')
                        ->directory('brands'),
                        Checkbox::make('Available'),
                        ])
                        ->required(),



             Select::make('category_id')
             ->relationship('Category', 'Name')
               ->searchable()
               ->preload()
               ->createOptionForm([
                Select::make('Name')
                ->searchable()
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
                ->label('Category Name'),
            FileUpload::make('slug'),
            Checkbox::make('Available')
          ])
            ->required(),





               FileUpload::make('img')
                 ->label('Slug')
                 ->required()
                 ->disk('public')
                 ->directory('categories'),

                  Checkbox::make('Available')
                   ->label('Available')
                   ->required(),

]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name'),
                ImageColumn::make('img')
                ->disk('public') // Ensure it's retrieving from the correct disk
                ->label('Category Image'),
                TextColumn::make('brand.Name'),
                TextColumn::make('Category.Name'),
              ToggleColumn::make('available')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
