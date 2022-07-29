<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Details with '.$appointment[0]->fname.' '.($appointment[0]->mname ?? '').' '.$appointment[0]->lname) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col items-center bg-white rounded-lg border shadow-md max-w-full dark:border-gray-700 dark:bg-gray-800 p-5">
                    <img class="object-contain w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset('img/default-profile.png') }}" alt="PatientPicture">
                    <div class="flex flex-col justify-between items-center p-4 leading-normal flex-grow">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $appointment[0]->fname.' '.($appointment[0]->mname ?? '').' '.$appointment[0]->lname }}</h5>
                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Concern</span>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 p-2">{{ $appointment[0]->concern }}</p>
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">Schedule</span>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 p-2">{{ date('F d, Y - H:i a', strtotime($appointment[0]->sched_at)) }}</p>
                        <div class="flex mt-4 space-x-3 lg:mt-6">
                            <a href="{{ route('doctor.patient-record.create', [$appointment[0]->id]) }}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Patient Record</a>
                            <a href="{{ route('doctor.appointments') }}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>