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

        $order_data = [
            'user_id' => auth('web')->id(),
            'reference' => UtilityService::generateReference('O', 5),
            'order_date' => now(),
            'status' => 'pending',
            'total_amount' => 0,
            'notes' => $data['notes'] ?? '',
            'payment_method' => $data['payment_method'] ?? 'cash',
        ];

        $order = EspaceOrder::create($order_data);
        $payroll_amount = 0;

        foreach ($items as $item) {
            if (! isset($item['espace_id'])) {
                continue;
            }
            $espace = Espace::find($item['espace_id']);
            $payroll_amount += $espace->price ?? 0;
            $order->espaces()->create([
                'espace_id' => $espace->id,
                'espace_order_id' => $order->id,
                'price' => $espace->price,
                'total_amount' => $item['quantity'] ?? 0,
                'quantity' => $item['quantity'] ?? 1,
                'started_at' => $item['started_at'] ?? now(),
                'ended_at' => $item['ended_at'],
                'notes' => $item['notes'] ?? '',
            ]);
        }

        // Update the total amount of the order for avoiding recomputing it later
        $order->total_amount = $payroll_amount;
        $order->save();

        return $order;
    }
}
