<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 m-4 flex flex-col items-center">
                    @if (Session::has('success'))
                        <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                            <svg class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                                {{ Session::get('success') }}
                            </div>
                            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-collapse-toggle="alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                    @endif
                    <div class="flex flex-col items-center bg-white rounded-lg border shadow-md max-w-full dark:border-gray-700 dark:bg-gray-800 p-5">
                        <img class="object-contain w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset('img/default-profile.png') }}" alt="PatientPicture">
                        <div class="flex flex-col justify-between items-center p-4 leading-normal flex-grow">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ Auth::user()->getFullname() }}</h5>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                                            <table class="min-w-full">
                                                <thead class="bg-gray-50 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            Email
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ Auth::user()->email }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead class="bg-gray-50 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            Contact Number
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            +63{{ Auth::user()->contact_num }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead class="bg-gray-50 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            Address
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ Auth::user()->getFullAddress() }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead class="bg-gray-50 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            Gender
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ Auth::user()->gender ? "Female" : "Male" }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead class="bg-gray-50 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            Birthdate
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ date('F d, Y', strtotime(Auth::user()->dob)) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead class="bg-gray-50 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                            Member Since
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ date('F d, Y - h:i a', strtotime(Auth::user()->created_at)) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex mt-4 space-x-3 lg:mt-6">
                                <a href="{{ route('patient.profile.edit', [Auth::id()]) }}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- <div class="relative w-96 h-auto rounded-md pt-24 pb-8 px-4 shadow-md hover:shadow-lg transition flex flex-col items-center">
                                <div class="absolute rounded-full bg-gray-100 w-28 h-28 p-2 z-10 -top-8 shadow-lg hover:shadow-xl transition">
                                    <div class="rounded-full w-full h-full overflow-auto">
                                        <img src="{{asset('img/default-profile.png')}}">
                                    </div>
                                </div>
                                <label class="font-bold text-lg">
                                    {{ Auth::user()->getFullname() }}
                                </label>
                                <label class="font-bold text-sm">
                                    {{ Auth::user()->email }}
                                </label>
                                <label class="font-bold text-xs">
                                    Patient
                                </label>
                                <ul class="hover:shadow py-2 px-1 mt-3 divide-y rounded shadow-sm">
                                    <li class="flex justify-center items-center py-3">
                                        <span class="basis-1/4 font-black dark:text-white">Contact</span>
                                        <span class="basis-3/4 font-semibold dark:text-white">+63{{ Auth::user()->contact_num }}</span>
                                    </li>
                                    <li class="flex justify-center items-center py-3">
                                        <span class="basis-1/4 font-black dark:text-white">Address</span>
                                        <span class="basis-3/4 font-semibold dark:text-white">{{ Auth::user()->getFullAddress() }}</span>
                                    </li>
                                    <li class="flex justify-center py-3">
                                        <span class="basis-1/4 font-black dark:text-white">Gender</span> 
                                        <span class="basis-3/4 font-semibold dark:text-white">{{ Auth::user()->gender ? "Female" : "Male" }}</span>
                                    </li>
                                    <li class="flex justify-center py-3">
                                        <span class="basis-1/4 font-black dark:text-white">Birthdate</span>
                                        <span class="basis-3/4 font-semibold dark:text-white">{{ Auth::user()->dob }}</span>
                                    </li>
                                    <li class="flex justify-center py-3">
                                        <span class="basis-1/4 font-black dark:text-white">Member Since</span>
                                        <span class="basis-3/4 font-semibold dark:text-white">{{ Auth::user()->created_at }}</span>
                                    </li>
                                    <li class="flex justify-center py-3">
                                        <span class="basis-1/4 font-black dark:text-white">Account Status</span>
                                        <span class="basis-3/4 font-semibold dark:text-white">{{ Auth::user()->is_active ? "Active" : "Disabled"}}</span>
                                    </li>
                                </ul>
                                <div class="text-center my-5 p-2 rounded">
                                    <x-nav-link href="{{ route('patient.profile.edit', [Auth::id()]) }}">{{ __('Edit Profile') }}</x-nav-link>
                                </div>
                            </div> --}}
                            <!-- Old Profile -5:55pm March 05 2022 -->
                        {{-- <div class="image overflow-hidden">
                                <img class="h-20 w-20"
                                    src="{{ asset('img/default-profile.png') }}">
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ Auth::user()->getFullname() }}</h1>
                            <h4 class="text-gray-600 font-lg text-semibold leading-6">Patient</h4>
                            <h3 class="text-gray-600 font-lg text-semibold leading-6">{{ Auth::user()->email }}</h3>
                            <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex justify-center items-center py-3">
                                    <span class="basis-1/4">Contact</span>
                                    <span class="basis-3/4">+63{{ Auth::user()->contact_num }}</span>
                                </li>
                                <li class="flex justify-center items-center py-3">
                                    <span class="basis-1/4">Address</span>
                                    <span class="basis-3/4">{{ Auth::user()->getFullAddress() }}</span>
                                </li>
                                <li class="flex justify-center py-3">
                                    <span class="basis-1/4">Gender</span> 
                                    <span class="basis-3/4">{{ Auth::user()->gender ? "Female" : "Male" }}</span>
                                </li>
                                <li class="flex justify-center py-3">
                                    <span class="basis-1/4">Birthdate</span>
                                    <span class="basis-3/4">{{ Auth::user()->dob }}</span>
                                </li>
                                <li class="flex justify-center py-3">
                                    <span class="basis-1/4">Member Since</span>
                                    <span class="basis-3/4">{{ Auth::user()->created_at }}</span>
                                </li>
                                <li class="flex justify-center py-3">
                                    <span class="basis-1/4">Account Status</span>
                                    <span class="basis-3/4">{{ Auth::user()->is_active ? "Active" : "Disabled"}}</span>
                                </li>
                            </ul>
                            <div class="text-center my-5 p-2 bg-slate-200 rounded">
                                <x-nav-link href="{{ route('patient.profile.edit', [Auth::id()]) }}">{{ __('Edit Profile') }}</x-nav-link>
                            </div>
                        </div> --}}