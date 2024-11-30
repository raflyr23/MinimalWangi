<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex justify-center mb-4">
                <x-authentication-card-logo />
            </div>
        </x-slot>

        <x-validation-errors class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg" />

        @if(session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold" />
                <x-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mb-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                <x-input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-center">
                <x-button class="w-full py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
