<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DOK-ITO</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
    <body>
      <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-orange-400">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="https://flowbite.com" class="flex items-center">
            <img src="{{ asset('img/dok-ito-img.png') }}" class="mr-3 h-6 sm:h-9" alt="DOK-ITO" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">DOK-ITO</span>
        </a>
        <div class="flex items-center md:order-2">
            @guest
            <button type="button" class="flex mr-3 text-sm bg-orange-50 rounded-full md:mr-3 focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false" type="button" data-dropdown-toggle="login-dropdown">
              <span class="sr-only">Open user menu</span>
              <span class="block text-sm text-orange-400 m-2">Login</span>
            </button>
            <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow " id="login-dropdown">
              <ul class="py-1" aria-labelledby="dropdown">
                <li>
                  <a href="{{ route('patient.login') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Patient</a>
                </li>
                <li>
                  <a href="{{ route('doctor.login') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Doctor</a>
                </li>
                <li>
                  <a href="{{ route('admin.login') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Administrator</a>
                </li>
              </ul>
            </div>
            <button type="button" class="flex mr-3 text-sm bg-orange-50 rounded-full md:mr-3 focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false" type="button" data-dropdown-toggle="register-dropdown">
              <span class="sr-only">Open user menu</span>
              <span class="block text-sm text-orange-400 m-2">Register</span>
            </button>
            <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow " id="register-dropdown">
              <ul class="py-1" aria-labelledby="dropdown">
                <li>
                  <a href="{{ route('patient.register') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Patient</a>
                </li>
              </ul>
            </div>
            @endguest
            @auth
            <button type="button" class="flex mr-3 text-sm text-orange-400 bg-orange-50 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false" type="button" data-dropdown-toggle="dropdown">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="{{ asset('img/default-profile.png') }}" alt="user photo">
            </button>
            <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow " id="dropdown">
              <div class="py-3 px-4">
                <span class="block text-sm text-orange-400 dark:text-white">{{ Auth::user()->getFullname() }}</span>
                <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
              </div>
              @auth('patient')
                <ul class="py-1" aria-labelledby="dropdown">
                  <li>
                    <a href="{{ route('patient.dashboard') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Dashboard</a>
                  </li>
                  <li>
                    <a href="{{ route('patient.profile.index') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Profile</a>
                  </li>
                  <li>
                    <a href="{{ route('patient.appointment.index') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Appointments</a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')"
                          onclick="event.preventDefault();
                          this.closest('form').submit();"" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">
                          Logout
                        </a>
                    </form>
                  </li>
                </ul>
              @endauth
              @auth('doctor')
                <ul class="py-1" aria-labelledby="dropdown">
                  <li>
                    <a href="{{ route('doctor.appointments') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Dashboard</a>
                  </li>
                  <li>
                    <a href="{{ route('doctor.schedules') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Profile</a>
                  </li>
                  <li>
                    <a href="{{ route('doctor.patient-records') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Appointments</a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')"
                          onclick="event.preventDefault();
                          this.closest('form').submit();"" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">
                          Logout
                        </a>
                    </form>
                  </li>
                </ul>
              @endauth
              @auth
                <ul class="py-1" aria-labelledby="dropdown">
                  <li>
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Dashboard</a>
                  </li>
                  <li>
                    <a href="{{ route('admin.patients-list') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Profile</a>
                  </li>
                  <li>
                    <a href="{{ route('admin.doctors-list') }}" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">Appointments</a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')"
                          onclick="event.preventDefault();
                          this.closest('form').submit();"" class="block py-2 px-4 text-sm text-orange-400 hover:bg-gray-100 ">
                          Logout
                        </a>
                    </form>
                  </li>
                </ul>
              @endauth
            </div>
            @endauth
            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 " aria-controls="mobile-menu-2" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
              <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
          <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
            <li>
              <a href="#home" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0">Home</a>
            </li>
            <li>
              <a href="#about" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0">About</a>
            </li>
            <li>
              <a href="#services" class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0">Services</a>
            </li>
          </ul>
        </div>
        </div>
      </nav>
      <section id="home" class="relative min-h-screen">
        <div id="indicators-carousel" class="relative z-0" data-carousel="static">
          <div class="overflow-hidden relative min-h-screen">
              <div id="carousel-item-1" class="hidden duration-700 ease-in-out" data-carousel-item="active">
                  <img src="{{ asset('img/dok-ito-bg-img.png') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
              </div>
              <div id="carousel-item-2" class="hidden duration-700 ease-in-out" data-carousel-item>
                  <img src="{{ asset('img/national-cancer-institute-L8tWZT4CcVQ-unsplash.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
              </div>
              <div id="carousel-item-3" class="hidden duration-700 ease-in-out" data-carousel-item>
                  <img src="{{ asset('img/national-cancer-institute-NFvdKIhxYlU-unsplash.jpg') }}" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
              </div>
          </div>
        </div>
        <div class="absolute z-10 top-0 left-0 container flex flex-col h-full justify-center items-center">
          <div class="bg-white p-4 max-w-max rounded">
            <p class="text-orange-400 text-4xl font-bold italic">
              "We help, with care"
            </p>
          </div>
          <div class="bg-white p-4 max-w-max mt-3 rounded">
            <p class="text-orange-400 text-xl font-bold italic">
              We provide appointment and consultation services for your health needs.
            </p>
          </div>
        </div>
      </section>
      <section id="about" class="min-h-screen bg-orange-200 flex justify-around items-center p-4">
        <div class="flex flex-col items-center text-orange-400 ">
          <h1 class="bg-white text-4xl font-bold p-4 shadow-lg">
            We are DOK-ITO
          </h1>
          <p class="bg-white mt-3 p-4 shadow-lg">
            In DOK-ITO, we provide a variety of doctors which will assist your consultation needs.
          </p>
        </div>
        <div class="p-4 bg-white shadow-lg">
          <img src="{{ asset('img/humberto-chavez-FVh_yqLR9eA-unsplash.jpg') }}" class="h-80 w-auto" alt="A doctor's picture">
        </div>
      </section>
      <section id="services" class="min-h-screen flex justify-center items-center gap-4">
        <div class="max-w-sm bg-white rounded-lg shadow-lg dark:bg-orange-400 dark:border-gray-700 flex flex-col">
          <svg class="h-48 w-auto p-6 hover:p-8 rounded-t-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path fill="white" d="M352 128C352 198.7 294.7 256 223.1 256C153.3 256 95.1 198.7 95.1 128C95.1 57.31 153.3 0 223.1 0C294.7 0 352 57.31 352 128zM287.1 362C260.4 369.1 239.1 394.2 239.1 424V448C239.1 452.2 241.7 456.3 244.7 459.3L260.7 475.3C266.9 481.6 277.1 481.6 283.3 475.3C289.6 469.1 289.6 458.9 283.3 452.7L271.1 441.4V424C271.1 406.3 286.3 392 303.1 392C321.7 392 336 406.3 336 424V441.4L324.7 452.7C318.4 458.9 318.4 469.1 324.7 475.3C330.9 481.6 341.1 481.6 347.3 475.3L363.3 459.3C366.3 456.3 368 452.2 368 448V424C368 394.2 347.6 369.1 320 362V308.8C393.5 326.7 448 392.1 448 472V480C448 497.7 433.7 512 416 512H32C14.33 512 0 497.7 0 480V472C0 393 54.53 326.7 128 308.8V370.3C104.9 377.2 88 398.6 88 424C88 454.9 113.1 480 144 480C174.9 480 200 454.9 200 424C200 398.6 183.1 377.2 160 370.3V304.2C162.7 304.1 165.3 304 168 304H280C282.7 304 285.3 304.1 288 304.2L287.1 362zM167.1 424C167.1 437.3 157.3 448 143.1 448C130.7 448 119.1 437.3 119.1 424C119.1 410.7 130.7 400 143.1 400C157.3 400 167.1 410.7 167.1 424z"/>
          </svg>
          <div class="px-5 pb-5">
            <h5 class="text-xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Set an appointment for consultation</h5>
          </div>
        </div>
        <div class="max-w-sm bg-white rounded-lg shadow-lg dark:bg-orange-400 dark:border-gray-700 flex flex-col">
          <svg class="h-48 w-auto p-6 hover:p-8 rounded-t-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path fill="white" d="M96 32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32zM448 464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192H448V464zM200 272V328H144C130.7 328 120 338.7 120 352C120 365.3 130.7 376 144 376H200V432C200 445.3 210.7 456 224 456C237.3 456 248 445.3 248 432V376H304C317.3 376 328 365.3 328 352C328 338.7 317.3 328 304 328H248V272C248 258.7 237.3 248 224 248C210.7 248 200 258.7 200 272z"/>
          </svg>
          <div class="px-5 pb-5">
            <h5 class="text-xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Choose a doctor on their own specialized field for consultation</h5>
          </div>
        </div>
        <div class="max-w-sm bg-white rounded-lg shadow-lg dark:bg-orange-400 dark:border-gray-700 flex flex-col">
          <svg class="h-48 w-auto p-6 hover:p-8 rounded-t-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path fill="white" d="M336 64h-53.88C268.9 26.8 233.7 0 192 0S115.1 26.8 101.9 64H48C21.5 64 0 85.48 0 112v352C0 490.5 21.5 512 48 512h288c26.5 0 48-21.48 48-48v-352C384 85.48 362.5 64 336 64zM96 392c-13.25 0-24-10.75-24-24S82.75 344 96 344s24 10.75 24 24S109.3 392 96 392zM96 296c-13.25 0-24-10.75-24-24S82.75 248 96 248S120 258.8 120 272S109.3 296 96 296zM192 64c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S160 113.7 160 96C160 78.33 174.3 64 192 64zM304 384h-128C167.2 384 160 376.8 160 368C160 359.2 167.2 352 176 352h128c8.801 0 16 7.199 16 16C320 376.8 312.8 384 304 384zM304 288h-128C167.2 288 160 280.8 160 272C160 263.2 167.2 256 176 256h128C312.8 256 320 263.2 320 272C320 280.8 312.8 288 304 288z"/>
          </svg>
          <div class="px-5 pb-5">
            <h5 class="text-xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">View appointments that you made</h5>
          </div>
        </div>
      </section>
      <section id="footer" class="min-h-screen bg-orange-200 flex flex-col justify-center items-center p-4">
        <div class="flex flex-col items-center text-orange-400 mb-5">
          <h1 class="bg-white text-4xl font-bold p-4">
            Believe us, we will take care of you.
          </h1>
        </div>
        <a href="{{ route('patient.register') }}" class="text-orange-400 bg-white hover:bg-white focus:ring-4 focus:outline-none focus:ring-white font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-white dark:hover:bg-white dark:focus:ring-white">Sign Up</a>
      </section>
      <footer class="p-4 bg-white shadow md:px-6 md:py-8 dark:bg-orange-400">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('index') }}" class="flex items-center mb-4 sm:mb-0">
              <img src="{{ asset('img/dok-ito-img.png') }}" class="mr-3 h-8" alt="DOK-ITO" />
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">DOK-ITO</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm text-white sm:mb-0">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-white sm:text-center">© 2022 <a href="{{ route('index') }}" class="hover:underline">DOK-ITO™</a>. All Rights Reserved.
        </span>
      </footer>
      <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
      <script>
        const items = [
            {
                position: 0,
                el: document.getElementById('carousel-item-1')
            },
            {
                position: 1,
                el: document.getElementById('carousel-item-2')
            },
            {
                position: 2,
                el: document.getElementById('carousel-item-3')
            },
        ];

        const options = {
            activeItemPosition: 1,
            interval: 3000,
        };
        const carousel = new Carousel(items, options);
        carousel.cycle()
      </script>
      
    </body>
</html>
