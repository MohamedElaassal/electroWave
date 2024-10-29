<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailRelationManager extends RelationManager
{
    protected static string $relationship = 'detail';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema($this->getDetailFields())
        ]);
    }

    protected function getDetailFields(): array
    {
        $product = $this->ownerRecord;

        return match ($product->category->Name) {
            'PC' => [
                Forms\Components\Grid::make(2) // Create a grid with 2 columns
                    ->schema([
                        Forms\Components\TextInput::make('data.cpu')
                            ->label('CPU'),
                        Forms\Components\TextInput::make('data.ram')
                            ->label('RAM'),
                        Forms\Components\TextInput::make('data.storage')
                            ->label('Storage'),
                        Forms\Components\TextInput::make('data.gpu')
                            ->label('GPU'),
                        Forms\Components\TextInput::make('data.motherboard')
                            ->label('Motherboard'),
                        Forms\Components\TextInput::make('data.power_supply')
                            ->label('Power Supply'),
                    ]),
            ],
            'Phone' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.os')
                            ->label('Operating System'),
                        Forms\Components\TextInput::make('data.camera')
                            ->label('Camera'),
                        Forms\Components\TextInput::make('data.battery')
                            ->label('Battery'),
                    ]),
            ],
            'NIC' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.network_type')
                            ->label('Network Type'),
                    ]),
            ],
            'Keyboard' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.form_factor')
                            ->label('Form Factor'),
                    ]),
            ],
            'Monitor' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.resolution')
                            ->label('Resolution'),
                    ]),
            ],
            'Laptop' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.screen_size')
                            ->label('Screen Size'),
                        Forms\Components\TextInput::make('data.ram')
                            ->label('RAM'),
                        Forms\Components\TextInput::make('data.storage')
                            ->label('Storage'),
                    ]),
            ],
            'Tablet' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.screen_size')
                            ->label('Screen Size'),
                        Forms\Components\TextInput::make('data.battery_capacity')
                            ->label('Battery Capacity'),
                    ]),
            ],
            'Smartwatch' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.weight')
                            ->label('Weight'),
                    ]),
            ],
            'Router' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.ports')
                            ->label('Ports'),
                    ]),
            ],
            'Headphones' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.impedance')
                            ->label('Impedance'),
                    ]),
            ],
            'Speakers' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.power_rating')
                            ->label('Power Rating'),
                    ]),
            ],
            'Mouse' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.dpi')
                            ->label('DPI'),
                    ]),
            ],
            'Printer' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.print_speed')
                            ->label('Print Speed'),
                    ]),
            ],
            'Camera' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.lens')
                            ->label('Lens'),
                    ]),
            ],
            'Charger' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.voltage')
                            ->label('Voltage'),
                    ]),
            ],
            'Power Bank' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.capacity')
                            ->label('Capacity'),
                    ]),
            ],
            'Graphics Card' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.memory')
                            ->label('Memory'),
                    ]),
            ],
            'Motherboard' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.form_factor')
                            ->label('Form Factor'),
                    ]),
            ],
            'SSD' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.read_speed')
                            ->label('Read Speed'),
                    ]),
            ],
            'HDD' => [
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('data.write_speed')
                            ->label('Write Speed'),
                    ]),
            ],
            default => [],
        };
    }


    public function table(Table $table): Table
{
    $product = $this->ownerRecord;

    return $table
        ->columns($this->getDetailColumns($product->category->Name))
        ->filters([
            // You can add filters if needed.
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

protected function getDetailColumns($category): array
{
    return match ($category) {
        'PC' => [
            Tables\Columns\TextColumn::make('data.cpu')->label('CPU'),
            Tables\Columns\TextColumn::make('data.ram')->label('RAM'),
            Tables\Columns\TextColumn::make('data.storage')->label('Storage'),
            Tables\Columns\TextColumn::make('data.gpu')->label('GPU'),
            Tables\Columns\TextColumn::make('data.motherboard')->label('Motherboard'),
            Tables\Columns\TextColumn::make('data.power_supply')->label('Power Supply'),
        ],
        'Phone' => [
            Tables\Columns\TextColumn::make('data.os')->label('Operating System'),
            Tables\Columns\TextColumn::make('data.camera')->label('Camera'),
            Tables\Columns\TextColumn::make('data.battery')->label('Battery'),
        ],
        'NIC' => [
            Tables\Columns\TextColumn::make('data.network_type')->label('Network Type'),
        ],
        'Keyboard' => [
            Tables\Columns\TextColumn::make('data.form_factor')->label('Form Factor'),
        ],
        'Monitor' => [
            Tables\Columns\TextColumn::make('data.resolution')->label('Resolution'),
        ],
        'Laptop' => [
            Tables\Columns\TextColumn::make('data.screen_size')->label('Screen Size'),
            Tables\Columns\TextColumn::make('data.ram')->label('RAM'),
            Tables\Columns\TextColumn::make('data.storage')->label('Storage'),
        ],
        'Tablet' => [
            Tables\Columns\TextColumn::make('data.screen_size')->label('Screen Size'),
            Tables\Columns\TextColumn::make('data.battery_capacity')->label('Battery Capacity'),
        ],
        'Smartwatch' => [
            Tables\Columns\TextColumn::make('data.weight')->label('Weight'),
        ],
        'Router' => [
            Tables\Columns\TextColumn::make('data.ports')->label('Ports'),
        ],
        'Headphones' => [
            Tables\Columns\TextColumn::make('data.impedance')->label('Impedance'),
        ],
        'Speakers' => [
            Tables\Columns\TextColumn::make('data.power_rating')->label('Power Rating'),
        ],
        'Mouse' => [
            Tables\Columns\TextColumn::make('data.dpi')->label('DPI'),
        ],
        'Printer' => [
            Tables\Columns\TextColumn::make('data.print_speed')->label('Print Speed'),
        ],
        'Camera' => [
            Tables\Columns\TextColumn::make('data.lens')->label('Lens'),
        ],
        'Charger' => [
            Tables\Columns\TextColumn::make('data.voltage')->label('Voltage'),
        ],
        'Power Bank' => [
            Tables\Columns\TextColumn::make('data.capacity')->label('Capacity'),
        ],
        'Graphics Card' => [
            Tables\Columns\TextColumn::make('data.memory')->label('Memory'),
        ],
        'Motherboard' => [
            Tables\Columns\TextColumn::make('data.form_factor')->label('Form Factor'),
        ],
        'SSD' => [
            Tables\Columns\TextColumn::make('data.read_speed')->label('Read Speed'),
        ],
        'HDD' => [
            Tables\Columns\TextColumn::make('data.write_speed')->label('Write Speed'),
        ],
        default => [],
    };
}
}
