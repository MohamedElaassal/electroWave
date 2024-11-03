<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Brand;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BrandResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BrandResource\RelationManagers;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $recordTitleAttribute = 'Name';

    protected static ?string $navigationGroup = 'Product specifications';



    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Select::make('Name')
            ->searchable() // This enables real-time searching
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
            ->placeholder('Select or type a brand')
            ->label('Brand'),

            Checkbox::make('Available'),
            FileUpload::make('slug')
            ->disk('public')
            ->directory('brands')
            ->visibility('public')
    ->imageResizeMode('cover')
    ->imageCropAspectRatio('16:9')
    ->imageResizeTargetWidth('1920')
    ->imageResizeTargetHeight('1080')

        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Name')
                ->searchable(),

                ImageColumn::make('slug')
                ->disk('public')
                ->label('Brand Image'),

                ToggleColumn::make('available')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                ->successNotificationTitle("the brand has been deleted successfully")
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
