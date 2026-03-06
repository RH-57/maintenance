<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use App\Models\ChecklistItem;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class MaintenanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Maintenance Information')
                    ->schema([

                        Select::make('equipment_id')
                            ->relationship('equipment', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        Select::make('location_id')
                            ->relationship('location', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        Select::make('checklist_template_id')
                            ->relationship('template', 'name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {

                                if (!$state) {
                                    $set('checklists', []);
                                    return;
                                }

                                $items = ChecklistItem::where('checklist_template_id', $state)
                                    ->orderBy('order')
                                    ->get();

                                $data = [];

                                foreach ($items as $item) {
                                    $data[] = [
                                        'checklist_item_id' => $item->id,
                                        'item_name' => $item->item,
                                        'result' => null,
                                        'remark' => null,
                                    ];
                                }

                                $set('checklists', $data);
                            }),

                        DatePicker::make('maintenance_date')
                            ->default(now())
                            ->required(),

                        Hidden::make('user_id')
                            ->default(Auth::id()),

                    ])
                    ->columns(2),

                Section::make('Checklist Result')
                    ->schema([

                        Repeater::make('checklists')
                            ->relationship()
                            ->schema([

                                Hidden::make('checklist_item_id')
                                    ->required(),

                                TextInput::make('item_name')
                                    ->label('Checklist')
                                    ->disabled()
                                    ->dehydrated(false),

                                Radio::make('result')
                                    ->label('Result')
                                    ->options([
                                        'OK' => 'OK',
                                        'NG' => 'Problem',
                                        'NA' => 'N/A',
                                    ])
                                    ->inline()
                                    ->live(false)
                                    ->required(),

                                Textarea::make('remark')
                                    ->label('Remark')
                                    ->rows(2),

                            ])
                            ->columns(3) // ⬅️ ini yang membuat menyamping
                            ->addable(false)
                            ->reorderable(false)
                            ->columnSpanFull(),

                    ]),

                Section::make('Notes')
                    ->schema([

                        Textarea::make('notes')
                            ->rows(3)

                    ])
            ]);
    }
}
