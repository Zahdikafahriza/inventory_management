<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-medium text-brand-600">Konfirmasi keamanan</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">Verifikasi password</h2>
        <p class="mt-2 text-sm leading-6 text-slate-500">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>