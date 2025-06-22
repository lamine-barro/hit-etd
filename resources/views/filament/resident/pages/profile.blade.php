<x-filament-panels::page>
    <div>
        <form wire:submit="save">
            <div class="mb-4">
                {{ $this->form }}
            </div>
            <div>
                <x-filament::button type="submit">
                    Enregistrer
                </x-filament::button>
            </div>
        </form>

        <x-filament-actions::modals />
    </div>
</x-filament-panels::page>
