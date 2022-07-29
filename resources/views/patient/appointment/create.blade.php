<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Appointment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col items-center pb-10 px-4 pt-4">
                        <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{ asset('img/default-profile.png') }}" alt="{{ $doctor->fname .' '. $doctor->mname .' '. $doctor->lname }} Profile"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white text-center">{{ $doctor->fname .' '. $doctor->mname .' '. $doctor->lname }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $doctor->degree }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $doctor->expertise }}</span>
                    </div>
                </div>
                <ol class="justify-center xl:flex p-5">
                    @foreach ($doctor->schedule as $ds_key => $ds_val)
                        <li class="relative mb-6 sm:mb-0">
                            <div class="flex items-center">
                                <div class="flex z-10 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                    <svg class="w-3 h-3 text-blue-600 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                            </div>
                            <div class="mt-3 sm:pr-8">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $ds_key }} Schedule</h3>
                                <div class="flex flex-col">
                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                                            <div class="overflow-hidden shadow-md sm:rounded-lg">
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
                                                        @foreach ($ds_val as $time)
                                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                    {{  date( 'g:i A', strtotime( $time->sched_time_start )) }}
                                                                </td>
                                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                                    {{ date( 'g:i A', strtotime( $time->sched_time_end )) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('patient.appointment.store') }}">
                        @csrf
                        <input type="hidden" value="{{ $doctor->id }}" name="doctor_id">
                        <div class="mt-4">
                            <x-label for="sched_at" :value="__('Date of appointment:')" />
                            <x-input type="datetime-local" class="block mt-1 w-full" name="sched_at" :value="old('sched_at')" required autofocus />
                        </div>
                        <div class="mt-4">
                            <label for="concern" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Concern about the appointment:</label>
                            <textarea id="concern" rows="4" name="concern" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."  required autofocus>{!! old('concern') !!}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create Appointment') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>