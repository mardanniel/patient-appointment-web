<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin\'s Doctor Registration Form') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12">
                
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('admin.doctor.store') }}">
                    @csrf
                    <!-- First Name -->
                    <div class="mt-4">
                        <x-label for="fname" :value="__('First Name')" />
                        <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus />
                    </div>

                    <!-- Middle Name -->
                    <div class="mt-4">
                        <x-label for="mname" :value="__('Middle Name (optional)')" />
                        <x-input id="mname" class="block mt-1 w-full" type="text" name="mname" :value="old('mname')" autofocus />
                    </div>

                    <!-- Last Name -->
                    <div class="mt-4">
                        <x-label for="lname" :value="__('Last Name')" />
                        <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
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

                    <!-- Degree -->
                    <div class="mt-4">
                        <x-label for="degree" :value="__('Degree')" />
                        <x-input id="degree" class="block mt-1 w-full" type="text" name="degree" :value="old('degree')" autofocus />
                    </div>

                    <!-- Expertise -->
                    <div class="mt-4">
                        <x-label for="expertise" :value="__('Expertise')" />
                        <x-input id="expertise" class="block mt-1 w-full" type="text" name="expertise" :value="old('expertise')" required autofocus />
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
                        <x-button class="ml-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
