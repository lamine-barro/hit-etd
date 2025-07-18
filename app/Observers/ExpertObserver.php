<?php

namespace App\Observers;

use App\Models\Audience;
use App\Models\Expert;

class ExpertObserver
{
    /**
     * Handle the Expert "saved" event.
     */
    public function saved(Expert $expert): void
    {
        // Ne créer une audience que si l'email existe
        if ($expert->email) {
            Audience::updateOrCreate(
                ['email' => $expert->email],
                [
                    'name' => $expert->full_name,
                    'whatsapp' => $expert->phone,
                    'type' => 'expert',
                ]
            );
        }
    }

    /**
     * Handle the Expert "created" event.
     */
    public function created(Expert $expert): void
    {
        //
    }

    /**
     * Handle the Expert "updated" event.
     */
    public function updated(Expert $expert): void
    {
        //
    }

    /**
     * Handle the Expert "deleted" event.
     */
    public function deleted(Expert $expert): void
    {
        //
    }

    /**
     * Handle the Expert "restored" event.
     */
    public function restored(Expert $expert): void
    {
        //
    }

    /**
     * Handle the Expert "force deleted" event.
     */
    public function forceDeleted(Expert $expert): void
    {
        //
    }
}
