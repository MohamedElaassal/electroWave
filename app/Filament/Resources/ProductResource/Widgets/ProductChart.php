<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Product;
use App\Models\Category;

class ProductChart extends ChartWidget
{
    protected static ?string $heading = 'Products by Category';

    /**
     * Chart type: Line chart.
     */
    protected function getType(): string
    {
        return 'line';
    }

    /**
     * Get data for the chart.
     */
    protected function getData(): array
    {
        // Fetch data for the chart
        $categories = Category::withCount('products')->get();

        // Prepare labels and values for the chart
        $labels = $categories->pluck('Name')->toArray();
        $values = $categories->pluck('products_count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Products',
                    'data' => $values,
                    'borderColor' => '#07d81a',
                    'backgroundColor' => 'rgba(7, 216, 26, 0.2)',
                ],
            ],
        ];
    }
}
