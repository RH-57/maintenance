<?php

namespace App\Filament\Resources\Equipment\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class EquipmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('code')
                            ->label('Equipment Code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),

                        TextInput::make('name')
                            ->label('Equipment Name')
                            ->required()
                            ->maxLength(255),

                        Select::make('location_id')
                            ->label('Location')
                            ->relationship('location', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'maintenance' => 'Maintenance',
                                'broken' => 'Broken',
                                'retired' => 'Retired',
                            ])
                            ->required(),

                        TextInput::make('brand')
                            ->maxLength(255),

                        TextInput::make('model')
                            ->maxLength(255),

                        TextInput::make('serial_number')
                            ->label('Serial Number')
                            ->maxLength(255),

                        DatePicker::make('purchase_date')
                            ->label('Purchase Date')
                            ->native(false),

                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
            ]);
    }
}
