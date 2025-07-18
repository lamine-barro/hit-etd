<?php

namespace App\Observers;

use App\Models\Audience;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "saved" event.
     */
    public function saved(User $user): void
    {
        // Ne créer une audience que si l'email existe
        if ($user->email) {
            Audience::updateOrCreate(
                ['email' => $user->email],
                [
                    'name' => $user->name,
                    'whatsapp' => $user->phone,
                    'type' => 'resident',
                ]
            );
        }
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
