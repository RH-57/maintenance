<?php

namespace App\Filament\Resources\ChecklistTemplates\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChecklistTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Template Information')
                    ->schema([

                        TextInput::make('name')
                            ->label('Template Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('frequency_days')
                            ->label('Frequency (Days)')
                            ->numeric()
                            ->placeholder('Example: 7'),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

                Section::make('Checklist Items')
                    ->schema([

                        Repeater::make('items')
                            ->relationship()
                            ->schema([

                                TextInput::make('item')
                                    ->label('Checklist Item')
                                    ->required(),

                                TextInput::make('standard')
                                    ->label('Standard')
                                    ->placeholder('Example: Normal / < 80°C'),

                                TextInput::make('order')
                                    ->numeric()
                                    ->default(1),

                            ])
                            ->columns(3)
                            ->addActionLabel('Add Checklist Item')
                            ->reorderable()
                            ->collapsible()
                            ->cloneable(),

                    ])

            ]);
    }
}
