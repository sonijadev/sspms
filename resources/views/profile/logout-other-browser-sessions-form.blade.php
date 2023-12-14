<x-action-section>
    <x-slot name="title">
        {{ __('Sesje aplikacji') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Zarządzaj i wylogowuj swoje aktywne sesje w innych przeglądarkach i urządzeniach.') }}
    </x-slot>

    <x-slot name="content">
        <x-action-message on="loggedOut">
            {{ __('Zrobione.') }}
        </x-action-message>

        <div>
            {{ __('W razie potrzeby możesz wylogować się ze wszystkich pozostałych sesji przeglądarki na wszystkich swoich urządzeniach. Poniżej wymieniono niektóre z Twoich ostatnich sesji; jednakże lista ta może nie być wyczerpująca. Jeśli uważasz, że Twoje konto zostało naruszone, powinieneś także zaktualizować swoje hasło.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-3">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="d-flex">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg fill="none" width="32" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="text-muted">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ms-2">
                            <div>
                                {{ $session->agent->platform() ? $session->agent->platform() : 'Nieznany' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Nieznany' }}
                            </div>

                            <div>
                                <div class="small font-weight-lighter text-muted">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-success font-weight-bold">{{ __('To urządzenie') }}</span>
                                    @else
                                        {{ __('Ostatnio aktywne') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex mt-3">
            <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Wyloguj z pozostałych sesji') }}
            </x-button>
        </div>

        <!-- Log out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                {{ __('Wyloguj z pozostałych sesji') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Wprowadź swoje hasło, aby potwierdzić, że chcesz wylogować się z pozostałych sesji przeglądarki na wszystkich swoich urządzeniach.') }}

                <div class="mt-3 w-md-75" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" placeholder="{{ __('Wprowadź hasło') }}"
                                 x-ref="password"
                                 class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                                 wire:model.defer="password"
                                 wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Anuluj') }}
                </x-secondary-button>

                <x-button class="ms-2" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    <div wire:loading wire:target="logoutOtherBrowserSessions" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Ładowanie ...</span>
                    </div>

                    {{ __('Wyloguj z pozostałych sesji') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>

</x-action-section>


{{-- <x-action-section>
    <x-slot name="title">
        {{ __('Sesje aplikacji') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Zarządzaj i wylogowuj swoje aktywne sesje w innych przeglądarkach i urządzeniach.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('W razie potrzeby możesz wylogować się ze wszystkich pozostałych sesji przeglądarki na wszystkich swoich urządzeniach. Poniżej wymieniono niektóre z Twoich ostatnich sesji; jednakże lista ta może nie być wyczerpująca. Jeśli uważasz, że Twoje konto zostało naruszone, powinieneś także zaktualizować swoje hasło.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg width="32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Nieznany') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Nieznany') }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('To urządzenie') }}</span>
                                    @else
                                        {{ __('Ostatnio aktywne') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Wyloguj z pozostałych sesji') }}
            </x-button>

            <x-action-message class="ml-3" on="loggedOut">
                {{ __('Zrobione.') }}
            </x-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                {{ __('Wyloguj z pozostałych sesji') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Wprowadź swoje hasło, aby potwierdzić, że chcesz wylogować się z pozostałych sesji przeglądarki na wszystkich swoich urządzeniach.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Wprowadź hasło') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Anuluj') }}
                </x-secondary-button>

                <x-button class="ml-3"
                            wire:click="logoutOtherBrowserSessions"
                            wire:loading.attr="disabled">
                    {{ __('Wyloguj z pozostałych sesji') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section> --}}
