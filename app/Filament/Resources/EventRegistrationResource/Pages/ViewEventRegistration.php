<?php

namespace App\Filament\Resources\EventRegistrationResource\Pages;

use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
use App\Filament\Resources\EventRegistrationResource;
use App\Models\EventRegistration;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\App;

class ViewEventRegistration extends ViewRecord
{
    protected static string $resource = EventRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Supprimer')
                ->modalHeading('Supprimer l\'inscription')
                ->modalDescription('Êtes-vous sûr de vouloir supprimer cette inscription ? Cette action est irréversible.')
                ->modalSubmitActionLabel('Oui, supprimer'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        $currentLocale = App::getLocale();

        return $infolist
            ->schema([
                InfolistSection::make('Informations du participant')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('uuid')
                                    ->label('Identifiant unique'),
                                TextEntry::make('name')
                                    ->label('Nom complet'),
                                TextEntry::make('email')
                                    ->label('Email')
                                    ->icon('heroicon-o-envelope'),
                                TextEntry::make('whatsapp')
                                    ->label('WhatsApp')
                                    ->icon('heroicon-o-phone'),
                                TextEntry::make('position')
                                    ->label('Fonction/Position'),
                                TextEntry::make('organization')
                                    ->label('Organisation'),
                                TextEntry::make('country')
                                    ->label('Pays')
                                    ->icon('heroicon-o-globe-alt'),
                                TextEntry::make('actor_type')
                                    ->label('Type d\'acteur'),
                            ]),
                    ]),

                InfolistSection::make('Informations de l\'événement')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextEntry::make('event')
                                    ->label('Événement')
                                    ->formatStateUsing(function (EventRegistration $record) use ($currentLocale) {
                                        if (! $record->event) {
                                            return 'Non spécifié';
                                        }

                                        // Récupérer la traduction dans la langue actuelle
                                        $translation = $record->event->translations()
                                            ->where('locale', $currentLocale)
                                            ->first();

                                        if ($translation && $translation->title) {
                                            return $translation->title;
                                        }

                                        // Essayer avec la langue par défaut si aucune traduction n'est trouvée
                                        $defaultTranslation = $record->event->translations()
                                            ->where('locale', $record->event->default_locale)
                                            ->first();

                                        if ($defaultTranslation && $defaultTranslation->title) {
                                            return $defaultTranslation->title;
                                        }

                                        return '[Titre non traduit]';
                                    })
                                    ->icon('heroicon-o-calendar'),

                                Group::make([
                                    TextEntry::make('event.start_date')
                                        ->label('Date de début')
                                        ->dateTime('d/m/Y H:i')
                                        ->icon('heroicon-o-clock'),
                                    TextEntry::make('event.end_date')
                                        ->label('Date de fin')
                                        ->dateTime('d/m/Y H:i')
                                        ->icon('heroicon-o-clock'),
                                ])->columns(2),

                                TextEntry::make('event')
                                    ->label('Lieu')
                                    ->formatStateUsing(function (EventRegistration $record) use ($currentLocale) {
                                        if (! $record->event) {
                                            return 'Non spécifié';
                                        }

                                        // Récupérer la traduction dans la langue actuelle
                                        $translation = $record->event->translations()
                                            ->where('locale', $currentLocale)
                                            ->first();

                                        if ($translation && $translation->location) {
                                            return $translation->location;
                                        }

                                        // Essayer avec la langue par défaut si aucune traduction n'est trouvée
                                        $defaultTranslation = $record->event->translations()
                                            ->where('locale', $record->event->default_locale)
                                            ->first();

                                        if ($defaultTranslation && $defaultTranslation->location) {
                                            return $defaultTranslation->location;
                                        }

                                        return '[Lieu non traduit]';
                                    })
                                    ->icon('heroicon-o-map-pin'),

                                TextEntry::make('event.is_remote')
                                    ->label('Format')
                                    ->formatStateUsing(fn ($state) => $state ? 'En ligne' : 'Présentiel')
                                    ->icon(fn ($state) => $state ? 'heroicon-o-computer-desktop' : 'heroicon-o-building-office-2'),

                                TextEntry::make('event.is_paid')
                                    ->label('Tarification')
                                    ->formatStateUsing(function (EventRegistration $record) {
                                        if (! $record->event) {
                                            return 'Non spécifié';
                                        }

                                        if (! $record->event->is_paid) {
                                            return 'Gratuit';
                                        }

                                        return $record->event->price.' '.$record->event->currency;
                                    })
                                    ->icon('heroicon-o-currency-dollar'),
                            ]),
                    ])
                    ->collapsible(),

                InfolistSection::make('Statut de l\'inscription')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('status')
                                    ->label('Statut')
                                    ->badge()
                                    ->color(fn (RegistrationStatus $state): string => $state->color())
                                    ->formatStateUsing(fn (RegistrationStatus $state): string => $state->label())
                                    ->icon(fn (RegistrationStatus $state): string => $state->icon()),
                                TextEntry::make('payment_status')
                                    ->label('Statut du paiement')
                                    ->badge()
                                    ->color(fn (PaymentStatus $state): string => $state->color())
                                    ->formatStateUsing(fn (PaymentStatus $state): string => $state->label())
                                    ->icon(fn (PaymentStatus $state): string => $state->icon()),
                                TextEntry::make('amount_paid')
                                    ->label('Montant payé')
                                    ->money('XOF'),
                                TextEntry::make('payment_reference')
                                    ->label('Référence de paiement'),
                            ]),
                    ]),

                InfolistSection::make('Informations système')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Date d\'inscription')
                                    ->dateTime('d/m/Y H:i'),
                                TextEntry::make('updated_at')
                                    ->label('Dernière mise à jour')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                    ])
                    ->collapsed(),
            ]);
    }
}
