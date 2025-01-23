<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Closure;
use Filament\Resources\RelationManagers\RelationManager;  // Fixed import
use Filament\Tables\Actions\Action;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id')  // Changed from product_id to id
                    ->label('Product')
                    ->options(function () {
                        return Product::query()
                            ->whereNull('client_id')  // Only products not assigned to any client
                            ->get()
                            ->pluck('Name', 'id');
                    })
                    ->required()
                    ->searchable()
                    ->disabled(fn ($record) => $record !== null) // Disable in edit mode
                    ->live(),  // Add this to make it reactive

                Select::make('payment_type')
                    ->label('Payment Type')
                    ->options([
                        'paid_at_once' => 'Paid at Once',
                        'partial_payment' => 'Partial Payment',
                    ])
                    ->reactive()
                    ->required()
                    ->disabled(fn ($record) => $record !== null) // Disable in edit mode
                    ->live(),  // Add this to make it reactive

                TextInput::make('amount_paid')
                    ->label('Amount Paid')
                    ->prefix('MAD')
                    ->numeric()
                    ->minValue(0.01)
                    ->placeholder('Enter amount paid')
                    ->requiredWith('payment_type')
                    ->visible(fn ($get) => $get('payment_type') === 'partial_payment')
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $product = Product::find($get('id'));
                            if ($product && $value > $product->Price) {
                                $fail("The amount paid cannot exceed the product's price ({$product->Price} MAD).");
                            }
                        }
                    ]),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $product = Product::findOrFail($data['id']);

        return [
            'id' => $data['id'],
            'Name' => $product->Name,
            'Price' => $product->Price,
            'IsNew' => $product->IsNew,
            'brand_id' => $product->brand_id,
            'img' => $product->img,
            'category_id' => $product->category_id,
            'client_id' => $this->ownerRecord->id,
            'payment_type' => $data['payment_type'],
            'amount_paid' => $data['amount_paid'] ?? 0,
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Name')
            ->columns([
                Tables\Columns\TextColumn::make('Name'),
                Tables\Columns\TextColumn::make('Price')
                    ->money('MAD'),
                Tables\Columns\TextColumn::make('payment_type'),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->money('MAD')
                    ->formatStateUsing(fn ($record) =>
                        $record->payment_type === 'paid_at_once'
                            ? $record->Price
                            : $record->amount_paid
                    ),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data): Model {  // Fixed return type hint
                        $product = Product::findOrFail($data['id']);

                        // Validate amount doesn't exceed price
                        if (isset($data['amount_paid']) && $data['amount_paid'] > $product->Price) {
                            Notification::make()
                                ->danger()
                                ->title('Invalid Amount')
                                ->body("The amount paid cannot exceed the product's price ({$product->Price} MAD).")
                                ->send();

                            return $product;
                        }

                        $amount_paid = $data['payment_type'] === 'paid_at_once'
                            ? $product->Price
                            : ($data['amount_paid'] ?? 0);

                        $product->update([
                            'client_id' => $this->ownerRecord->id,
                            'payment_type' => $data['payment_type'],
                            'amount_paid' => $amount_paid,
                        ]);
                        return $product;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->label('Remove')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->action(function (Product $record) {
                        $record->update([
                            'client_id' => null,
                            'amount_paid' => null,
                            'payment_type' => null,
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Product Removed')
                            ->body('The product has been removed from this client.')
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('delete')
                        ->label('Remove Selected')
                        ->color('danger')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                $record->update([
                                    'client_id' => null,
                                    'amount_paid' => null,
                                    'payment_type' => null,
                                ]);
                            });

                            Notification::make()
                                ->success()
                                ->title('Products Removed')
                                ->body('The selected products have been removed from this client.')
                                ->send();
                        }),
                ]),
            ]);
    }
}
