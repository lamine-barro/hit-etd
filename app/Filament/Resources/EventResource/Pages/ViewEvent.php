<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Enums\Currency;
use App\Enums\EventStatus;
use App\Enums\EventType;
use App\Enums\LanguageEnum;
use App\Filament\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\App;
use Illuminate\Support\HtmlString;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;

    /**
     * Langue actuellement sélectionnée pour l'affichage
     */
    public ?string $currentLocale = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('publish')
                ->label('Publier')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (Event $record) => $record->status === EventStatus::DRAFT->value)
                ->action(function () {
                    $this->record->status = EventStatus::PUBLISHED;
                    $this->record->save();
                    $this->refreshFormData(['status', 'published_at']);
                    Notification::make()
                        ->title('Événement publié')
                        ->success()
                        ->send();

                    return true;
                }),
            Actions\Action::make('unpublish')
                ->label('Dépublier')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('gray')
                ->visible(fn (Event $record) => $record->status === EventStatus::PUBLISHED->value)
                ->action(function () {
                    $this->record->status = EventStatus::DRAFT;
                    $this->record->save();
                    $this->refreshFormData(['status']);
                    Notification::make()
                        ->title('Événement dépublié')
                        ->success()
                        ->send();

                    return true;
                }),
        ];
    }

    /**
     * Méthode appelée avant le rendu de la page
     */
    protected function beforeMount(): void
    {
        // Définir la langue actuelle si elle n'est pas déjà définie
        if (! $this->currentLocale) {
            $this->currentLocale = $this->record->default_locale ?? App::getLocale();
        }
    }

    /**
     * Action pour changer la langue d'affichage
     */
    public function changeLanguage(string $locale): void
    {
        $this->currentLocale = $locale;
    }

    /**
     * Récupère le contenu traduit pour l'affichage
     */
    protected function getTranslatedContent(string $field): string
    {
        $event = $this->record;
        $locale = $this->currentLocale;

        // Si aucune traduction n'est définie, utiliser la langue par défaut
        if (! $locale) {
            $locale = $event->default_locale ?? App::getLocale();
        }

        // Récupérer la traduction pour la langue sélectionnée
        $translation = $event->translations()->where('locale', $locale)->first();

        // Si la traduction existe et que le champ est rempli, l'utiliser
        if ($translation && ! empty($translation->{$field})) {
            return $translation->{$field};
        }

        // Sinon, utiliser le champ de l'événement principal
        return $event->{$field} ?? '';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        // Récupérer la langue actuelle
        $currentLocale = app()->getLocale();

        // Récupérer toutes les langues disponibles
        $availableLocales = LanguageEnum::toArray();

        return $infolist
            ->schema([
                Section::make('Informations générales')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('default_locale')
                                    ->label('Langue principale')
                                    ->formatStateUsing(function ($state) {
                                        // Convertir le code de langue en nom complet
                                        if ($state instanceof LanguageEnum) {
                                            return $state->label();
                                        }

                                        return LanguageEnum::fromLocale($state)?->label() ?? $state;
                                    })
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('type')
                                    ->label('Type d\'événement')
                                    ->formatStateUsing(fn (string $state): string => EventType::from($state)->label())
                                    ->badge()
                                    ->icon(fn (string $state): string => EventType::from($state)->icon())
                                    ->color(fn (string $state): string => match ($state) {
                                        EventType::CONFERENCE->value => 'primary',
                                        EventType::WORKSHOP->value => 'warning',
                                        EventType::WEBINAR->value => 'info',
                                        EventType::MEETUP->value => 'success',
                                        EventType::TRAINING->value => 'danger',
                                        EventType::HACKATHON->value => 'purple',
                                        default => 'gray',
                                    }),

                                TextEntry::make('status')
                                    ->label('Statut')
                                    ->badge()
                                    ->formatStateUsing(function ($state): string {
                                        if ($state instanceof EventStatus) {
                                            return $state->label();
                                        }

                                        return EventStatus::from($state)->label();
                                    })
                                    ->icon(function ($state): string {
                                        if ($state instanceof EventStatus) {
                                            return $state->icon();
                                        }

                                        return EventStatus::from($state)->icon();
                                    })
                                    ->color(function ($state): string {
                                        $statusValue = $state instanceof EventStatus ? $state->value : $state;

                                        return match ($statusValue) {
                                            EventStatus::PUBLISHED->value => 'success',
                                            EventStatus::DRAFT->value => 'gray',
                                            EventStatus::CANCELLED->value => 'danger',
                                            default => 'gray',
                                        };
                                    }),
                            ]),
                    ]),

                // Onglets pour chaque langue disponible
                \Filament\Infolists\Components\Tabs::make('Langues')
                    ->columns(1)
                    ->columnSpanFull()
                    ->tabs([
                        // Créer un onglet pour chaque langue disponible
                        ...collect($availableLocales)->map(function ($label, $locale) {
                            return \Filament\Infolists\Components\Tabs\Tab::make($label)
                                ->icon('heroicon-o-language')
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            TextEntry::make('translations_title')
                                                ->label('Titre')
                                                ->state(function (Event $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son titre
                                                    if ($translationModel && ! empty($translationModel->title)) {
                                                        return $translationModel->title;
                                                    }

                                                    // Sinon, utiliser le titre par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->title;
                                                    }

                                                    return 'Non traduit';
                                                }),

                                            TextEntry::make('translations_slug')
                                                ->label('Slug')
                                                ->state(function (Event $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son slug
                                                    if ($translationModel && ! empty($translationModel->slug)) {
                                                        return $translationModel->slug;
                                                    }

                                                    // Sinon, utiliser le slug par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->slug;
                                                    }

                                                    return 'Non traduit';
                                                }),

                                            TextEntry::make('translations_location')
                                                ->label('Lieu')
                                                ->state(function (Event $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser son lieu
                                                    if ($translationModel && ! empty($translationModel->location)) {
                                                        return $translationModel->location;
                                                    }

                                                    // Sinon, utiliser le lieu par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->location;
                                                    }

                                                    return 'Non traduit';
                                                }),

                                            TextEntry::make('translations_description')
                                                ->label('Description')
                                                ->state(function (Event $record) use ($locale) {
                                                    // Récupérer la traduction pour cette langue
                                                    $translationModel = $record->translations()
                                                        ->where('locale', $locale)
                                                        ->first();

                                                    // Si on a une traduction, utiliser sa description
                                                    if ($translationModel && ! empty($translationModel->description)) {
                                                        return $translationModel->description;
                                                    }

                                                    // Sinon, utiliser la description par défaut si c'est la langue par défaut
                                                    if ($locale === $record->default_locale) {
                                                        return $record->description;
                                                    }

                                                    return 'Non traduit';
                                                })
                                                ->html()
                                                ->columnSpanFull(),
                                        ]),
                                ]);
                        })->toArray(),
                    ]),

                Split::make([
                    Grid::make(2)
                        ->schema([
                            Section::make()
                                ->schema([
                                    ImageEntry::make('illustration')
                                        ->label('')
                                        ->height(300)
                                        ->extraImgAttributes(['class' => 'object-cover w-full rounded-xl']),

                                    TextEntry::make('title')
                                        ->label('')
                                        ->formatStateUsing(fn () => $this->getTranslatedContent('title'))
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->columnSpanFull(),

                                    Grid::make(2)
                                        ->schema([
                                            TextEntry::make('type')
                                                ->label('Type d\'événement')
                                                ->formatStateUsing(fn (string $state): string => EventType::from($state)->label())
                                                ->icon(fn (string $state): string => EventType::from($state)->icon())
                                                ->badge()
                                                ->color(fn (string $state): string => match ($state) {
                                                    EventType::CONFERENCE->value => 'primary',
                                                    EventType::WORKSHOP->value => 'warning',
                                                    EventType::WEBINAR->value => 'info',
                                                    EventType::MEETUP->value => 'success',
                                                    EventType::TRAINING->value => 'danger',
                                                    EventType::HACKATHON->value => 'purple',
                                                    default => 'gray',
                                                }),

                                            TextEntry::make('status')
                                                ->label('Statut')
                                                ->formatStateUsing(function ($state): string {
                                                    if ($state instanceof EventStatus) {
                                                        return $state->label();
                                                    }

                                                    return EventStatus::from($state)->label();
                                                })
                                                ->icon(function ($state): string {
                                                    if ($state instanceof EventStatus) {
                                                        return $state->icon();
                                                    }

                                                    return EventStatus::from($state)->icon();
                                                })
                                                ->badge()
                                                ->color(function ($state): string {
                                                    $statusValue = $state instanceof EventStatus ? $state->value : $state;

                                                    return match ($statusValue) {
                                                        EventStatus::PUBLISHED->value => 'success',
                                                        EventStatus::DRAFT->value => 'gray',
                                                        EventStatus::CANCELLED->value => 'danger',
                                                        default => 'gray',
                                                    };
                                                }),
                                        ]),
                                ]),
                        ])
                        ->columnSpan(['lg' => 1]),

                    Grid::make(1)
                        ->schema([

                            \Filament\Infolists\Components\Tabs::make('Détails')
                                ->tabs([
                                    \Filament\Infolists\Components\Tabs\Tab::make('Informations pratiques')
                                        ->icon('heroicon-o-information-circle')
                                        ->schema([
                                            Group::make([
                                                TextEntry::make('start_date')
                                                    ->label('Date de début')
                                                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y H:i')),

                                                TextEntry::make('end_date')
                                                    ->label('Date de fin')
                                                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('d/m/Y H:i') : 'Non définie'),
                                            ])->columns(2),

                                            Group::make([
                                                TextEntry::make('is_remote')
                                                    ->label('Format')
                                                    ->formatStateUsing(fn (bool $state): string => $state ? 'En ligne' : 'Présentiel'),

                                                TextEntry::make('external_link')
                                                    ->label('Lien externe')
                                                    ->formatStateUsing(fn ($state, Event $record) => $record->external_link ? new HtmlString('<a href="'.$record->external_link.'" target="_blank" class="text-primary-600 hover:underline">'.$record->external_link.'</a>') : 'Non disponible')
                                                    ->visible(fn (Event $record): bool => $record->is_remote),
                                            ])->columns(2),

                                            Group::make([
                                                TextEntry::make('duration')
                                                    ->label('Durée')
                                                    ->state(function (Event $record): string {
                                                        if (! $record->end_date) {
                                                            return 'Non définie';
                                                        }

                                                        $start = Carbon::parse($record->start_date);
                                                        $end = Carbon::parse($record->end_date);
                                                        $diffInHours = $start->diffInHours($end);

                                                        if ($diffInHours < 24) {
                                                            return $diffInHours.' heure'.($diffInHours > 1 ? 's' : '');
                                                        } else {
                                                            $diffInDays = $start->diffInDays($end);

                                                            return $diffInDays.' jour'.($diffInDays > 1 ? 's' : '');
                                                        }
                                                    })
                                                    ->icon('heroicon-o-clock'),

                                                TextEntry::make('max_participants')
                                                    ->label('Nombre maximum de participants'),

                                                TextEntry::make('registration_end_date')
                                                    ->label('Date limite d\'inscription')
                                                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d/m/Y H:i')),

                                                TextEntry::make('registrations_count')
                                                    ->label('Nombre d\'inscrits')
                                                    ->state(function (Event $record): string {
                                                        $count = $record->registrations()->count();

                                                        return $count.' / '.$record->max_participants;
                                                    }),

                                                TextEntry::make('remaining_spots')
                                                    ->label('Places restantes')
                                                    ->state(function (Event $record): string {
                                                        $count = $record->registrations()->count();
                                                        $remaining = $record->max_participants - $count;

                                                        return $remaining > 0 ? $remaining : 'Complet';
                                                    })
                                                    ->color(function (Event $record): string {
                                                        $count = $record->registrations()->count();
                                                        $remaining = $record->max_participants - $count;

                                                        return $remaining > 0 ? 'success' : 'danger';
                                                    }),

                                                TextEntry::make('is_paid')
                                                    ->label('Type d\'événement')
                                                    ->formatStateUsing(fn (bool $state): string => $state ? 'Payant' : 'Gratuit')
                                                    ->color(fn (bool $state): string => $state ? 'warning' : 'success'),

                                                TextEntry::make('price')
                                                    ->label('Prix standard')
                                                    ->formatStateUsing(function ($state, Event $record) {
                                                        if (! $record->is_paid) {
                                                            return 'Gratuit';
                                                        }

                                                        return number_format($state, 0, ',', ' ').' '.Currency::from($record->currency)->symbol();
                                                    })
                                                    ->visible(fn (Event $record): bool => $record->is_paid),
                                            ])->columns(2),

                                        ]),

                                    \Filament\Infolists\Components\Tabs\Tab::make('Métadonnées')
                                        ->icon('heroicon-o-information-circle')
                                        ->schema([
                                            Group::make([
                                                TextEntry::make('created_by')
                                                    ->columnSpanFull()
                                                    ->label('Créé par')
                                                    ->formatStateUsing(function ($state, Event $record) {
                                                        if (! $record->createdBy) {
                                                            return 'Non spécifié';
                                                        }

                                                        return $record->createdBy->first_name.' '.$record->createdBy->last_name;
                                                    })
                                                    ->icon('heroicon-o-user'),

                                                TextEntry::make('created_at')
                                                    ->label('Créé le')
                                                    ->dateTime('d/m/Y H:i'),
                                                TextEntry::make('updated_at')
                                                    ->label('Dernière mise à jour')
                                                    ->dateTime('d/m/Y H:i'),
                                            ])->columns(2),
                                        ]),
                                ]),
                        ])
                        ->columnSpan(['lg' => 2]),
                ])->columnSpanFull()
                    ->from('lg'),

            ]);
    }
}
