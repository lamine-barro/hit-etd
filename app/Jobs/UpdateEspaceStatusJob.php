<?php

namespace App\Jobs;

use App\Models\EspaceOrderItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateEspaceStatusJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $espace_order_items = EspaceOrderItem::where('status', EspaceOrderItem::STATUS_CONFIRMED)
            ->where('ended_at', '<=', now())
            ->get();

        foreach ($espace_order_items as $item) {
            $item->espace->update(['status' => \App\Models\Espace::STATUS_AVAILABLE]);
        }
    }
}
