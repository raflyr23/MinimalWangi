<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex justify-center mb-4">
                <x-authentication-card-logo />
            </div>
        </x-slot>

        <x-validation-errors class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg" />

        <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <x-label for="name" value="{{ __('Name') }}" class="text-gray-700 font-semibold" />
                <x-input id="name" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold" />
                <x-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mb-4">
                <x-label for="no_telp" value="{{ __('No Telp') }}" class="text-gray-700 font-semibold" />
                <x-input id="no_telp" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="number" name="no_telp" :value="old('no_telp')" required autocomplete="username" />
            </div>

            <div class="mb-4">
                <x-label for="alamat" value="{{ __('Alamat') }}" class="text-gray-700 font-semibold" />
                <x-input id="alamat" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="text" name="alamat" :value="old('alamat')" required autocomplete="username" />
            </div>

            <div class="mb-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                <x-input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-700 font-semibold" />
                <x-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" required />
                            <div class="ml-2 text-sm text-gray-600">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-indigo-600 hover:underline">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-indigo-600 hover:underline">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <a class="text-sm text-gray-600 hover:text-indigo-600" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
