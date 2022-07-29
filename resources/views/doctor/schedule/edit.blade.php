<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('Your schedule for '.["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][$doctor_sched->sched_day]) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('doctor.schedule.update') }}" class="overflow-hidden shadow-md sm:rounded-lg">
                                @csrf
                                @method('PATCH')
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Time Start
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Time End
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <input type="hidden" name="id" value="{{ $doctor_sched->id }}" required>
                                                <input type="hidden" name="sched_day" value="{{ $doctor_sched->sched_day }}" required>
                                                <x-input id="sched_time_start" class="block mt-1 w-full" type="time" name="sched_time_start" :value="__($doctor_sched->sched_time_start)" required autofocus />
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <x-input id="sched_time_end" class="block mt-1 w-full" type="time" name="sched_time_end" :value="__($doctor_sched->sched_time_end)" required autofocus />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="min-w-full text-center my-2">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Schedule</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>