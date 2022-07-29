<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('patient.register') }}">
            @csrf

            <!-- FName -->
            <div class="mt-4">
                <x-label for="fname" :value="__('First Name')" />
                <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus />
            </div>

            <!-- MName -->
            <div class="mt-4">
                <x-label for="mname" :value="__('Middle Name (optional)')" />
                <x-input id="mname" class="block mt-1 w-full" type="text" name="mname" :value="old('mname')" autofocus />
            </div>

            <!-- LName -->
            <div class="mt-4">
                <x-label for="lname" :value="__('Last Name')" />
                <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />
                <div class="flex flex-col container">
                    <div class="flex">
                        <x-input id="genderM" class="mr-1" type="radio" name="gender" :value="0" autofocus />
                        <x-label for="genderM" :value="__('Male')" />
                    </div>
                    <div class="flex">
                        <x-input id="genderF" class="mr-1" type="radio" name="gender" :value="1" autofocus />
                        <x-label for="genderF" :value="__('Female')" />
                    </div>
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-label for="dob" :value="__('Date of Birth')" />
                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Contact Number -->
            <div class="mt-4">
                <x-label for="contact" :value="__('Contact Number')" />
                <div class="flex items-center">
                    <span class="mr-1 mt-1">+63</span>
                    <x-input id="contact" class="block mt-1 w-full" type="tel" name="contact_num" :value="old('contact_num')" placeholder="9123456789" pattern="[0-9]{10}" maxlength="10" required autofocus />
                </div>
            </div>

            <!-- Address -->
            <div class="mt-4 flex-col">
                <x-label :value="__('Address')" />
                <div class="flex items-center mt-2">
                    <span class="mr-4">Street</span>
                    <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required autofocus />
                </div>
                <div class="flex items-center mt-2">
                    <span class="mr-4">Barangay</span>
                    <x-input id="barangay" class="block mt-1 w-full" type="text" name="barangay" :value="old('barangay')" required autofocus />
                </div>
                <div class="flex items-center mt-2">
                    <span class="mr-4">City</span>
                    <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus />
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('patient.login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
