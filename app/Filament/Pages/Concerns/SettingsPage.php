<?php

namespace App\Filament\Pages\Concerns;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Arr;

/**
 * Base untuk halaman editor konten. Subclass cukup mendefinisikan formSchema()
 * dengan field yang name-nya = key setting. Nilai array (repeater) disimpan JSON.
 */
abstract class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $view = 'filament.pages.settings-page';

    /** Daftar key setting yang dikelola halaman ini. */
    abstract protected function keys(): array;

    abstract protected function formSchema(): array;

    public function mount(): void
    {
        $all = Setting::map();
        $state = [];

        foreach ($this->keys() as $key) {
            $raw = $all[$key] ?? null;
            if (is_string($raw)) {
                $decoded = json_decode($raw, true);
                $state[$key] = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : $raw;
            } else {
                $state[$key] = $raw;
            }
        }

        $this->form->fill($state);
    }

    public function form(Form $form): Form
    {
        return $form->schema($this->formSchema())->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($this->keys() as $key) {
            $value = Arr::get($state, $key);
            Setting::put($key, is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $value);
        }

        Notification::make()->title('Tersimpan')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')->label('Simpan Perubahan')->submit('save')->keyBindings(['mod+s']),
        ];
    }
}
