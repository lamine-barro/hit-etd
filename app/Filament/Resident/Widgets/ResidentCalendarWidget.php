<?php

namespace App\Filament\Resident\Widgets;

use App\Models\EspaceOrder;
use App\Models\EventRegistration;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class ResidentCalendarWidget extends FullCalendarWidget
{
    public function fetchEvents(array $fetchInfo): array
    {
        $events = [];
        $user = auth('web')->user();
        
        if (!$user) {
            return $events;
        }

        // Récupérer les réservations d'espaces du résident
        $espaceOrders = EspaceOrder::with(['espaces.espace'])
            ->where('user_id', $user->id)
            ->whereHas('espaces', function ($query) use ($fetchInfo) {
                $query->where('started_at', '>=', $fetchInfo['start'])
                    ->where('started_at', '<=', $fetchInfo['end']);
            })
            ->get();

        foreach ($espaceOrders as $order) {
            foreach ($order->espaces as $item) {
                if ($item->espace && $item->started_at && $item->ended_at) {
                    $events[] = [
                        'id' => 'espace-' . $item->id,
                        'title' => '🏢 ' . $item->espace->name,
                        'start' => $item->started_at->format('c'),
                        'end' => $item->ended_at->format('c'),
                        'color' => match($order->status) {
                            'confirmed' => '#10b981', // green-500
                            'pending' => '#f59e0b',   // amber-500
                            'cancelled' => '#ef4444', // red-500
                            default => '#6b7280'      // gray-500
                        },
                        'extendedProps' => [
                            'type' => 'espace',
                            'status' => $order->status,
                            'reference' => $order->reference,
                            'espace_name' => $item->espace->name,
                            'espace_type' => $item->espace->type,
                            'espace_location' => $item->espace->location,
                            'espace_floor' => $item->espace->floor,
                            'capacity' => $item->espace->number_of_people,
                            'price' => $item->espace->price_per_hour,
                            'notes' => $item->notes,
                            'payment_method' => $order->payment_method,
                            'tooltip' => $this->buildEspaceTooltip($item, $order)
                        ]
                    ];
                }
            }
        }

        // Récupérer les inscriptions aux événements du résident
        $eventRegistrations = EventRegistration::with(['event', 'event.translations'])
            ->where('email', $user->email)
            ->whereHas('event', function ($query) use ($fetchInfo) {
                $query->where('start_date', '>=', $fetchInfo['start'])
                    ->where('start_date', '<=', $fetchInfo['end']);
            })
            ->get();

        foreach ($eventRegistrations as $registration) {
            if ($registration->event) {
                $event = $registration->event;
                $currentLocale = app()->getLocale();
                $translation = $event->translations()
                    ->where('locale', $currentLocale)
                    ->first();
                
                $title = $translation ? $translation->title : $event->slug;
                
                $events[] = [
                    'id' => 'event-' . $registration->id,
                    'title' => '📅 ' . $title,
                    'start' => $event->start_date->format('c'),
                    'end' => $event->end_date ? $event->end_date->format('c') : null,
                    'color' => match($registration->status->value) {
                        'confirmed' => '#3b82f6', // blue-500
                        'pending' => '#f59e0b',   // amber-500
                        'cancelled' => '#ef4444', // red-500
                        default => '#6b7280'      // gray-500
                    },
                    'extendedProps' => [
                        'type' => 'event',
                        'status' => $registration->status->value,
                        'event_title' => $title,
                        'event_location' => $event->getTranslatedAttribute('location') ?: ($event->is_remote ? 'En ligne' : 'Non spécifié'),
                        'event_description' => $event->getTranslatedAttribute('description'),
                        'registration_status' => $registration->status->label(),
                        'payment_status' => $registration->payment_status ? $registration->payment_status->label() : null,
                        'is_paid' => $event->is_paid,
                        'is_remote' => $event->is_remote,
                        'tooltip' => $this->buildEventTooltip($registration, $event, $title)
                    ]
                ];
            }
        }

        return $events;
    }

    private function buildEspaceTooltip($item, $order): string
    {
        $espace = $item->espace;
        $statusColors = [
            'confirmed' => 'text-green-600',
            'pending' => 'text-amber-600',
            'cancelled' => 'text-red-600'
        ];
        
        $statusColor = $statusColors[$order->status] ?? 'text-gray-600';
        
        return sprintf(
            '<div class="p-3 bg-white rounded-lg shadow-lg border max-w-sm">
                <div class="flex items-center mb-2">
                    <span class="text-lg">🏢</span>
                    <h4 class="font-semibold text-gray-900 ml-2">%s</h4>
                </div>
                <div class="space-y-1 text-sm">
                    <p><span class="font-medium">Type:</span> %s</p>
                    <p><span class="font-medium">Localisation:</span> %s</p>
                    <p><span class="font-medium">Étage:</span> %s</p>
                    <p><span class="font-medium">Capacité:</span> %d personne(s)</p>
                    <p><span class="font-medium">Prix/h:</span> %s FCFA</p>
                    <p><span class="font-medium">Référence:</span> %s</p>
                    <p><span class="font-medium">Statut:</span> <span class="%s font-medium">%s</span></p>
                    <p><span class="font-medium">Horaires:</span> %s - %s</p>
                    %s
                </div>
            </div>',
            htmlspecialchars($espace->name),
            htmlspecialchars(\App\Models\Espace::FR_TYPES[$espace->type] ?? $espace->type),
            htmlspecialchars($espace->location ?? 'Non spécifiée'),
            htmlspecialchars(\App\Models\Espace::FR_FLOORS[$espace->floor] ?? $espace->floor ?? 'Non spécifié'),
            $espace->number_of_people ?? 1,
            number_format($espace->price_per_hour, 0, ',', ' '),
            htmlspecialchars($order->reference),
            $statusColor,
            ucfirst($order->status),
            $item->started_at->format('d/m/Y H:i'),
            $item->ended_at->format('d/m/Y H:i'),
            $item->notes ? '<p><span class="font-medium">Notes:</span> ' . htmlspecialchars($item->notes) . '</p>' : ''
        );
    }

    private function buildEventTooltip($registration, $event, $title): string
    {
        $statusColors = [
            'confirmed' => 'text-blue-600',
            'pending' => 'text-amber-600',
            'cancelled' => 'text-red-600'
        ];
        
        $statusColor = $statusColors[$registration->status->value] ?? 'text-gray-600';
        
        return sprintf(
            '<div class="p-3 bg-white rounded-lg shadow-lg border max-w-sm">
                <div class="flex items-center mb-2">
                    <span class="text-lg">📅</span>
                    <h4 class="font-semibold text-gray-900 ml-2">%s</h4>
                </div>
                <div class="space-y-1 text-sm">
                    <p><span class="font-medium">Lieu:</span> %s</p>
                    <p><span class="font-medium">Inscription:</span> <span class="%s font-medium">%s</span></p>
                    <p><span class="font-medium">Horaires:</span> %s - %s</p>
                    %s
                    %s
                    %s
                </div>
            </div>',
            htmlspecialchars($title),
            htmlspecialchars($event->getTranslatedAttribute('location') ?: ($event->is_remote ? 'En ligne' : 'Non spécifié')),
            $statusColor,
            $registration->status->label(),
            $event->start_date->format('d/m/Y H:i'),
            $event->end_date ? $event->end_date->format('d/m/Y H:i') : 'Non spécifié',
            $event->getTranslatedAttribute('description') ? '<p><span class="font-medium">Description:</span> ' . htmlspecialchars(\Str::limit(strip_tags($event->getTranslatedAttribute('description')), 100)) . '</p>' : '',
            $event->is_paid && $registration->payment_status ? '<p><span class="font-medium">Paiement:</span> ' . $registration->payment_status->label() . '</p>' : '',
            $event->is_remote ? '<p><span class="text-blue-600 font-medium">🌐 Événement en ligne</span></p>' : ''
        );
    }

    public function getOptions(): array
    {
        return [
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay'
            ],
            'initialView' => 'dayGridMonth',
            'locale' => app()->getLocale(),
            'firstDay' => 1, // Lundi
            'height' => 'auto',
            'eventMouseEnter' => 'function(info) {
                const tooltip = info.event.extendedProps.tooltip;
                if (tooltip) {
                    const tooltipEl = document.createElement("div");
                    tooltipEl.innerHTML = tooltip;
                    tooltipEl.style.cssText = "position: absolute; z-index: 10000; pointer-events: none;";
                    document.body.appendChild(tooltipEl);
                    
                    const rect = info.el.getBoundingClientRect();
                    tooltipEl.style.left = rect.left + "px";
                    tooltipEl.style.top = (rect.top - 10) + "px";
                    
                    info.el._tooltip = tooltipEl;
                }
            }',
            'eventMouseLeave' => 'function(info) {
                if (info.el._tooltip) {
                    document.body.removeChild(info.el._tooltip);
                    delete info.el._tooltip;
                }
            }',
            'eventDidMount' => 'function(info) {
                info.el.style.cursor = "pointer";
            }'
        ];
    }
} 