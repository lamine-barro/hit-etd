<?php

use Illuminate\Support\Facades\Schedule;

Schedule::job(new \App\Jobs\UpdateEspaceStatusJob)
    ->daily()
    ->when(function () {
        return now()->minute % 5 === 0; // Run every 5 minutes
    })
    ->name('update-espace-status')
    ->withoutOverlapping();
