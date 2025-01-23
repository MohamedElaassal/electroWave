<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Client;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MainOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::query()->count())
                ->description('📈 Monthly Growth: +' . $this->calculateMonthlyGrowth(Product::class))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->generateChartData(Product::class))
                ->color('success'),

            Stat::make('Total Clients', Client::query()->count())
                ->description('👥 Monthly Growth: +' . $this->calculateMonthlyGrowth(Client::class))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->generateChartData(Client::class))
                ->color('warning'),
        ];
    }

    protected function calculateMonthlyGrowth(string $modelClass): int
    {
        $currentMonthCount = $modelClass::whereMonth('created_at', now()->month)->count();
        $previousMonthCount = $modelClass::whereMonth('created_at', now()->subMonth()->month)->count();

        return $currentMonthCount - $previousMonthCount;
    }

    protected function generateChartData(string $modelClass): array
    {
        return $modelClass::selectRaw('WEEK(created_at) as week, COUNT(*) as count')
            ->groupBy('week')
            ->orderBy('week')
            ->pluck('count')
            ->toArray();
    }
}
