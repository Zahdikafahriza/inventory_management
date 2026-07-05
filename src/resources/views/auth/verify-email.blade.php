<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-medium text-brand-600">Verifikasi email</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">Aktifkan akun Anda</h2>
        <p class="mt-2 text-sm leading-6 text-slate-500">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm font-medium text-slate-500 transition hover:text-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-100">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>