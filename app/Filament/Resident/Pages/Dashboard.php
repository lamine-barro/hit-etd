<?php

namespace App\Filament\Resident\Pages;

use App\Filament\Resident\Widgets\ResidentCalendarWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';

    protected static ?int $navigationSort = -2;

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            ResidentCalendarWidget::class,
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('Calendrier');
    }
}
