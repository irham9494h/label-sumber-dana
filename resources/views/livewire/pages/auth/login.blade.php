<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        if (Cache::has('tahun')) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } else {
            redirect()->route('tahun.pilih-tahun');
        }
    }
}; ?>

<div>
    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-mary-input label="Name" wire:model="name" />
            {{--
            <x-input label="Name" wire:model="form.email" type="email" name="email" placeholder="your name" /> --}}
            {{--
            <x-input label="Email" wire:model="form.email" type="email" name="email" placeholder="your name" /> --}}
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{--
            <x-inputs.password label="Password" wire:model="form.password" name="password" /> --}}
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-mary-button label="Up" tooltip="Mary" type="submit" />
        </div>
    </form>
</div>