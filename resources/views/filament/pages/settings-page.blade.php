<x-filament-panels::page>
    <form wire:submit="save" class="fi-form grid gap-y-6">
        {{ $this->form }}

        <div class="flex justify-start gap-3">
            @foreach ($this->getFormActions() as $action)
                {{ $action }}
            @endforeach
        </div>
    </form>
</x-filament-panels::page>
