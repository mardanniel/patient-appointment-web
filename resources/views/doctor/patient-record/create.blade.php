<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Patient Record for Appointment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="flex flex-col items-center justify-center bg-white rounded-lg border shadow-md max-w-full dark:border-gray-700 dark:bg-gray-800 p-5">
                    <img class="object-contain w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset('img/default-profile.png') }}" alt="PatientPicture">
                    <div class="flex flex-col justify-between items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Patient Record for {{ $patient[0]->fname.' '.($patient[0]->mname ?? '').' '.$patient[0]->lname }}</h5>
                    </div>
                </div>

                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('doctor.patient-record.store') }}">
                    @csrf
                    <input type="hidden" name="appointment_id" value="{{ $patient[0]->id }}">
                    <input type="hidden" name="patient_id" value="{{ $patient[0]->patient_id }}">
                    <div class="mt-4">
                        <x-label for="diagnosis" :value="__('Diagnosis')" />
                        <textarea id="diagnosis" name="diagnosis" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type patient diagnosis..." required autofocus>{{ old('diagnosis') }}</textarea>
                    </div>
                    <div class="mt-4">
                        <x-label for="temp" :value="__('Temperature')" />
                        <x-input id="temp" class="block mt-1 w-full" type="number" name="temp" :value="old('temp')" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-label for="bp" :value="__('Blood Pressure')" />
                        <x-input id="bp" class="block mt-1 w-full" type="number" name="bp" :value="old('bp')" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-label for="weight" :value="__('Weight')" />
                        <x-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight')" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-label for="height" :value="__('Height')" />
                        <x-input id="height" class="block mt-1 w-full" type="number" name="height" :value="old('bp')" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-label for="pulse_rate" :value="__('Pulse Rate')" />
                        <x-input id="pulse_rate" class="block mt-1 w-full" type="number" name="pulse_rate" :value="old('pulse_rate')" required autofocus/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Create Patient Record') }}
                        </x-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>