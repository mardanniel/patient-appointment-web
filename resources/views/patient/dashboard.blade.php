<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-around gap-2">
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
                    <div class="basis-1/4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex flex-col items-center pb-10 px-4 pt-4">
                            <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{ asset('img/default-profile.png') }}" alt="{{ Auth::user()->getFullname() }}"/>
                            <h5 class="mb-1 text-xl font-medium text-center text-gray-900 dark:text-white">{{ Auth::user()->getFullname() }}</h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Patient</span>
                            <div class="flex mt-4 space-x-3 lg:mt-6">
                                <a href="{{ route('patient.profile.index') }}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="basis-3/4 p-4 max-w-lg bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-center">
                        <div class="flex justify-between items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Appointments Overview</h5>
                            <a href="{{ route('patient.appointment.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                View all
                            </a>
                       </div>
                       <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Unsettled Appointments
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $counts['unsettled_appointments'] }}
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Settled Appointments
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $counts['settled_appointments'] }}
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                Total Appointments
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $counts['total_appointments'] }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                       </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white text-center mt-10">Available doctors for appointment</h5>
                    @if (Session::has('error'))
                        <div id="alert-3" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                            <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                                {{ Session::get('error') }}
                            </div>
                            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-collapse-toggle="alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                    @endif
                    <div class="flex justify-center p-5">
                        <div class="flex flex-col justify-center items-center">
                            <label for="expertise" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Expertise</label>
                            <select id="expertise" name="expertise" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose preferred expertise</option>
                                @foreach ($randomExpertise as $key => $expertise)
                                    <option value="{{ $key }}">{{ $expertise }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center" id="spinner">
                        <svg role="status" class="inline mr-2 w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                    </div>
                    <div class="grid grid-cols-4 gap-2 p-10" id="doctor-list"></div>
                    <div class="m-10" id="doctor-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    function retrieve(page, expertise=null){

        $.ajax({
            url: '{{ route('patient.randomDoctor') }}' + '?page=' + page + (expertise ? '&expertise=' + expertise : ''),
            type: 'get',
            dataType: 'json',
            success: function(response){
                displayList(response.doctors.data);
                displayPagination(response.links);
                hideSpinner();
            },
            fail: function(){
                console.log("Retrieving failed!");
            }
        });

    }

    function handleClick(){

        $('#doctor-pagination').on('click','a', function(e){
            e.preventDefault();
            retrieve($(this).text().trim());
        });

    }

    function displayList(doctors){

        $('#doctor-list').empty();

        for(row in doctors){

            $('#doctor-list').append(
                `<div class="max-w-lg bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col items-center pb-10 px-4 pt-4">
                        <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{ asset('img/default-profile.png') }}" alt="${ doctors[row].fname + ' ' + doctors[row].mname + ' ' + doctors[row].lname } Profile"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white text-center">${ doctors[row].fname + ' ' + doctors[row].mname + ' ' + doctors[row].lname }</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">${ doctors[row].degree }</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">${ doctors[row].expertise }</span>
                        <div class="flex mt-4 space-x-3 lg:mt-6">
                            <a href="${ 'appointment/create/' + doctors[row].id }" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Set Appointment</a>
                        </div>
                    </div>
                </div>`
            )
        }
    }

    function displayPagination(pagination){

        $('#doctor-pagination').html(pagination);

    }

    function hideSpinner(){
        $('#spinner').hide();
    }

    function handleExpertiseSelection(){

        $('#expertise').change(function (event) {

            retrieve(1, $(this).val());
        });

    }

    $(document).ready(function () {

        retrieve(1);
        handleClick();
        handleExpertiseSelection();

    });

</script>
