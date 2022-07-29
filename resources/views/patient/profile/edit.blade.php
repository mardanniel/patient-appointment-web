<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('patient.profile.update', [Auth::id()]) }}">
                        @method('PUT')
                        @csrf
                        <div class="mt-4">
                            <x-label for="fname" :value="__('First Name')" />
                            <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="__(Auth::user()->fname)" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="mname" :value="__('Middle Name')" />
                            <x-input id="mname" class="block mt-1 w-full" type="text" name="mname" :value="__(Auth::user()->mname)" autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="lname" :value="__('Last Name')" />
                            <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="__(Auth::user()->lname)" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="gender" :value="__('Gender')" />
                            <div class="flex flex-col container">
                                <div class="flex">
                                    <x-input id="genderM" class="mr-1" type="radio" name="gender" :value="0" :checked="Auth::user()->gender == 0 ? true : false" autofocus />
                                    <x-label for="genderM" :value="__('Male')" />
                                </div>
                                <div class="flex">
                                    <x-input id="genderF" class="mr-1" type="radio" name="gender" :value="1" :checked="Auth::user()->gender == 1 ? true : false" autofocus />
                                    <x-label for="genderF" :value="__('Female')" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-label for="dob" :value="__('Date of Birth')" />
                            <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="__(Auth::user()->dob)" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="contact" :value="__('Contact Number')" />
                            <div class="flex items-center">
                                <span class="mr-1 mt-1">+63</span>
                                <x-input id="contact" class="block mt-1 w-full" type="tel" name="contact_num" :value="__(Auth::user()->contact_num)" placeholder="9123456789" pattern="[0-9]{10}" maxlength="10" required autofocus />
                            </div>
                        </div>
                        <div class="mt-4 flex-col">
                            <x-label :value="__('Address')" />
                            <div class="flex items-center mt-2">
                                <span class="mr-4">Street</span>
                                <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="__(Auth::user()->street)" required autofocus />
                            </div>
                            <div class="flex items-center mt-2">
                                <span class="mr-4">Barangay</span>
                                <x-input id="barangay" class="block mt-1 w-full" type="text" name="barangay" :value="__(Auth::user()->barangay)" required autofocus />
                            </div>
                            <div class="flex items-center mt-2">
                                <span class="mr-4">City</span>
                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="__(Auth::user()->city)" required autofocus />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update Profile') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


