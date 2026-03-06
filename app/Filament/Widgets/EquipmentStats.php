<?php

namespace App\Filament\Widgets;

use App\Models\Equipment;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EquipmentStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active', Equipment::where('status', 'active')->count())
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success'),

            Stat::make('Maintenance', Equipment::where('status', 'maintenance')->count())
                ->icon(Heroicon::OutlinedWrenchScrewdriver)
                ->color('warning'),

            Stat::make('Broken', Equipment::where('status', 'broken')->count())
                ->icon(Heroicon::OutlinedExclamationTriangle)
                ->color('danger'),

            Stat::make('Retired', Equipment::where('status', 'retired')->count())
                ->icon(Heroicon::OutlinedArchiveBox)
                ->color('gray'),
        ];
    }
}
