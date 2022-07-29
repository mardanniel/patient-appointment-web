<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Schedule') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('doctor.schedule.store') }}">
                    @csrf
                    <div class="mt-4">
                        <x-label for="sched_day" :value="__('Select day of the week')" />
                        <x-select id="sched_day" class="block mt-1 w-full" type="text" name="sched_day" :value="old('sched_day')" required autofocus>
                            <option disabled >Select day</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="sched_time_start" :value="__('Time start')" />
                        <x-input id="sched_time_start" class="block mt-1 w-full" type="time" name="sched_time_start" :value="old('sched_time_start')" required autofocus />
                    </div>
                    <div class="mt-4">
                        <x-label for="sched_time_end" :value="__('Time end')" />
                        <x-input id="sched_time_end" class="block mt-1 w-full" type="time" name="sched_time_end" :value="old('sched_time_end')" required autofocus />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Create Schedule') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>