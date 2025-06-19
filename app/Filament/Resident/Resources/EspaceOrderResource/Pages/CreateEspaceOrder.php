<?php

namespace App\Filament\Resident\Resources\EspaceOrderResource\Pages;

use App\Filament\Resident\Resources\EspaceOrderResource;
use App\Models\Espace;
use App\Models\EspaceOrder;
use App\Services\UtilityService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEspaceOrder extends CreateRecord
{
    protected static string $resource = EspaceOrderResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data = $this->mutateFormDataBeforeCreate($data);

        $items = $data['espaces'] ?? [];
        $espaces = [];
        $payroll_amount = 0;

        $order_data = [
            'user_id' => auth('web')->id(),
            'reference' => UtilityService::generateReference('O', 5),
            'order_date' => now(),
            'status' => 'pending',
            'total_amount' => collect($espaces)->sum('price'),
            'notes' => $data['notes'] ?? '',
            'payment_method' => $data['payment_method'] ?? 'cash',
            'started_at' => $data['started_at'] ?? now(),
            'ended_at' => $data['started_at'],
        ];

        $order = EspaceOrder::create($order_data);

        foreach ($items as $item) {
            if (! isset($item['espace_id'])) {
                continue;
            }
            $espace = Espace::find($item['espace_id']);
            $order->items()->create([
                'espace_id' => $espace->id,
                'espace_order_id' => $order->id,
                'price' => $espace->price,
                'total_amount' => $item['quantity'] ?? 0,
                'quantity' => $item['quantity'] ?? 1,
            ]);
        }

        return $order;
    }
}
