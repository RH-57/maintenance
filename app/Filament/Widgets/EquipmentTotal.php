<?php

namespace App\Filament\Widgets;

use App\Models\Equipment;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EquipmentTotal extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Equipment', Equipment::count())
                ->icon(Heroicon::OutlinedRectangleStack)
                ->color('success'),
        ];
    }
}
