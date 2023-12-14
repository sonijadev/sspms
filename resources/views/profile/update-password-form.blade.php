<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Zmiana hasła') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Aby zachować bezpieczeństwo, upewnij się, że Twoje konto używa długiego, losowego i bezpiecznego hasła.') }}
    </x-slot>

    <x-slot name="form">
        <div class="w-md-75">
            <div class="mb-3">
                <x-label for="current_password" value="{{ __('Obecne hasło') }}" />
                <x-input id="current_password" type="password" class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" />
            </div>

            <div class="mb-3">
                <x-label for="password" value="{{ __('Nowe hasło') }}" />
                <x-input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.password" autocomplete="new-password" />
                <x-input-error for="password" />
            </div>

            <div class="mb-3">
                <x-label for="password_confirmation" value="{{ __('Powtórz nowe hasło') }}" />
                <x-input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            <div wire:loading class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Ładowanie ...</span>
            </div>

            {{ __('Zapisz') }}
        </x-button>
    </x-slot>
</x-form-section>



{{-- <x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Zmiana hasła') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Aby zachować bezpieczeństwo, upewnij się, że Twoje konto używa długiego, losowego i bezpiecznego hasła.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Obecne hasło') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Nowe hasło') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Powtórz nowe hasło') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Zapisano.') }}
        </x-action-message>

        <x-button>
            {{ __('Zapisz') }}
        </x-button>
    </x-slot>
</x-form-section> --}}
