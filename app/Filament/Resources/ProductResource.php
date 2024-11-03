<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\Widgets\ProductNameOverview;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $recordTitleAttribute = 'Name';

    protected static ?string $navigationGroup = 'Products management';





    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => $record->category->Name,
            'Price' => $record->Price .' MAD'
        ];
    }

    public static function getNavigationBadge(): ?string{
        return Static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // First section for Name, Brand, and Category
                Grid::make(2) // Create a grid with 2 columns
                ->schema([

                    // First section on the left
                    Section::make('Product Information')
                        ->schema([
                            TextInput::make('Name')
                                ->required()
                                ->label('Product Name'),


                                TextInput::make('Price')
                                ->numeric()
                                ->required()
                                ->prefix('€')
                                ->label('Product Price'),

                        ])
                        ->columnSpan(1), // Span the left column

                    // Second section on the right
                    Section::make('Pricing')
                        ->schema([
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
                            ->label('Category Name') ,

                            FileUpload::make('slug')
                                    ->disk('public')
                                    ->directory('brands'),
                                    Checkbox::make('Available'),
                              ])
                        ])
                        ->columnSpan(1),
                ]),
                // Third section for Image Upload
                Section::make('Images')
                    ->schema([
                        FileUpload::make('img')
                            ->label('Product Image')
                            ->disk('public')
                            ->directory('products')
                            ->required(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')->searchable(),
                ImageColumn::make('img')
                    ->disk('public')
                    ->label('Product Image'),
                TextColumn::make('brand.Name')->searchable()->label('Brand'),
                TextColumn::make('category.Name')->searchable()->label('Category'),
                TextColumn::make('Price')->label('Price')->prefix('MAD'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                ->label('View Details')
                ->action(fn (Product $record, Tables\Actions\Action $action) => $action->openModal())
                ->modalHeading('Product Details')
                ->modalContent(function (Product $record) {
                    return view('filament.product-details', ['product' => $record]);
                }),
                Tables\Actions\DeleteAction::make()
                ->successNotificationTitle("the Product has been deleted successfully")

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
            RelationManagers\DetailRelationManager::class
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
