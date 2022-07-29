<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="p-6 bg-white flex flex-col items-center gap-5">
        <div class="flex flex-col md:flex-row gap-2">
            <div class="flex flex-col gap-2">
                <div class="bg-white rounded-lg shadow-md border border-gray-600 max-w-full">
                    <div class="grow flex flex-col justify-center items-center pb-10 px-4 pt-4">
                        <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{ asset('img/default-profile.png') }}" alt="{{ Auth::user()->getFullname() }}"/>
                        <h5 class="mb-1 text-xl font-medium text-center text-gray-900 dark:text-white">{{ Auth::user()->getFullname() }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Administrator</span>
                    </div>
                </div>
                <div class="grow flex flex-col justify-center items-center pb-10 px-4 pt-4 bg-white rounded-lg shadow-md border border-gray-600 max-w-full">
                    <h5 class="mb-1 text-4xl font-medium text-center text-gray-900 dark:text-white">{{ $averageAppointmentsPerYear }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Average appointments per year  (Max. year: {{ $appointmentAverageDivisor }})</span>
                </div>
            </div>
            <div class="grow shadow-lg rounded-lg overflow-hidden border border-gray-600" style="position: relative;">
                <div class="p-5 bg-gray-50">Appointments per year</div>
                <canvas class="p-10" id="chartBar"></canvas>
            </div>
        </div>
        <div class="grow shadow-lg rounded-lg overflow-hidden border border-gray-600" style="position: relative;">
            <div class="p-5 bg-gray-50">DOK-ITO Entities Chart</div>
            <canvas class="p-10" id="chartPie"></canvas>
        </div>
        <form action="#" method="post" class="p-4 bg-white rounded-lg shadow-md border border-gray-600">
            <div class="p-4">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select start year</label>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>2022</option>
                    <option>2021</option>
                    <option>2020</option>
                    <option>2019</option>
                </select>
            </div>
            <div class="p-4">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select end year</label>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>2022</option>
                    <option>2021</option>
                    <option>2020</option>
                    <option>2019</option>
                </select>
            </div>
            <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>
                Generate Report 
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 ml-2 -mr-1" fill="currentColor">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M480 352h-133.5l-45.25 45.25C289.2 409.3 273.1 416 256 416s-33.16-6.656-45.25-18.75L165.5 352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456zM233.4 374.6C239.6 380.9 247.8 384 256 384s16.38-3.125 22.62-9.375l128-128c12.49-12.5 12.49-32.75 0-45.25c-12.5-12.5-32.76-12.5-45.25 0L288 274.8V32c0-17.67-14.33-32-32-32C238.3 0 224 14.33 224 32v242.8L150.6 201.4c-12.49-12.5-32.75-12.5-45.25 0c-12.49 12.5-12.49 32.75 0 45.25L233.4 374.6z"/>
                </svg>
            </button>
        </form>
    </div>
    
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var pieData = {!! json_encode($entitiesCount[0], true) !!};
    var barData = {!! json_encode($appointmentsPerYear) !!}.reverse();

    // Pie Chart Data and Config
    const dataPie = {
        labels: ["Patients", "Doctor", "Appointments", "Patient Record", "Doctor Schedules"],
        datasets: [
            {
                data: [
                    pieData.patients_count ?? 0,
                    pieData.doctors_count ?? 0,
                    pieData.appointments_count ?? 0,
                    pieData.patient_diagnosis_count ?? 0,
                    pieData.doctor_schedules_count ?? 0,
                ],
                backgroundColor: [
                    "rgb(133, 105, 241)",
                    "rgb(164, 101, 241)",
                    "rgb(101, 143, 241)",
                    "rgb(181, 90, 241)",
                    "rgb(50, 121, 241)",
                ],
                hoverOffset: 4,
            },
        ],
    };

    const configPie = {
        type: "pie",
        data: dataPie,
        options: {
            responsive: true,
            maintainAspectRatio: true
        },
    };

    const labels = barData.map(x => x['year'].toString());

    // Bar Chart Data and Config
    const dataBar = {
        labels: labels,
        datasets: [
            {
                data: barData.map(x => x['data']),
                backgroundColor: [
                    "rgb(133, 105, 241)",
                    "rgb(164, 101, 241)",
                    "rgb(101, 143, 241)",
                    "rgb(181, 90, 241)",
                    "rgb(50, 121, 241)",
                ],
                hoverOffset: 4,
            },
        ],
    };

    const configBar = {
        type: "bar",
        data: dataBar,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                display: false
                }
            },
        },
    };

    new Chart(document.getElementById("chartPie"), configPie);
    new Chart(document.getElementById("chartBar"), configBar);
</script>