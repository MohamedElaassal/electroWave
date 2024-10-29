<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                ->label('Product Name')
                ->options(
                    Product::query()
                        ->pluck('Name', 'Name')
                        ->toArray()
                )
                ->searchable(),
                Select::make('payment_type')
                ->label('Payment Type')
                ->options([
                    'paid_at_once' => 'Paid at Once',
                    'partial_payment' => 'Partial Payment',
                ])
                ->reactive() // Allows dynamic updates
                ->required(),

            TextInput::make('amount_paid')
                ->label('Amount Paid')
                ->prefix('MAD')
                ->numeric()
                ->minValue(0.01)
                ->placeholder('Enter amount paid')
                ->requiredWith('payment_type') // Require amount only if payment_type is 'partial_payment'
                ->visible(fn ($get) => $get('payment_type') === 'partial_payment'), // Conditionally display
        ]);


    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Name')
            ->columns([
                Tables\Columns\TextColumn::make('Name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
