<?php
namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class MainChart extends ChartWidget
{
    protected static ?string $heading = 'Product Statistics';

    protected function getType(): string
    {
        return 'line'; // Line chart type
    }

    protected function getData(): array
    {
        // Fetch categories and count products in each category
        $categories = Category::withCount('products')->get();

        // Prepare labels and values for the chart
        $categoryLabels = $categories->pluck('Name')->toArray();
        $categoryCounts = $categories->pluck('products_count')->toArray();

        return [
            'labels' => $categoryLabels,
            'datasets' => [
                [
                    'label' => 'Number of Products per Category',
                    'data' => $categoryCounts,
                    'borderColor' => '#07d81a',  // Green
                    'backgroundColor' => 'rgba(7, 216, 26, 0.2)', // Light Green
                    'fill' => true, // Fill the area under the line
                ],
            ],
        ];
    }
}
