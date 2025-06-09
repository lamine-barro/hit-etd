<?php

namespace App\Filament\Resident\Resources\EspaceOrderResource\Pages;

use App\Filament\Resident\Resources\EspaceOrderResource;
use Filament\Resources\Pages\Page;

class EspaceCalendar extends Page
{
    protected static string $resource = EspaceOrderResource::class;

    protected static string $view = 'filament.resident.resources.espace-order-resource.pages.espace-calendar';
}
