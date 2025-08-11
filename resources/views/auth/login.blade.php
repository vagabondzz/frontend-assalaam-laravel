@include('include.htmlstart')

<div class="font-[sans-serif] min-h-screen w-full flex items-center justify-center px-4"
    style="background-image: linear-gradient(rgba(68, 68, 68, 0.5), rgba(68, 68, 68, 0.5)), url('{{ asset('images/bg.jpg') }}'); background-size: cover; background-position: center;">
    <div data-aos="zoom-in"
        style="background-image: linear-gradient(rgba(255, 255, 255, 0.452), rgba(248, 226, 226, 0.402))"
        class="grid lg:grid-cols-2 gap-4 max-w-5xl w-full p-6 md:p-12  rounded-lg shadow-xl mx-auto sm:mx-4 md:mx-32">
        <!-- Kolom Kiri: Informasi Login -->
        <div
            class="flex flex-col items-center md:items-center md:justify-center justify-start lg:items-start lg:justify-start">
            <a href="/" class="mb-4 mx-auto md:ml-6">
                <img src="{{ asset('images/logoTeks.png') }}" alt="logo" class="w-56 md:w-72" />
            </a>
            <div class="max-w-lg mt-12 ml-8 max-lg:hidden justify-center">
                <h3 class="text-2xl font-bold text-gray-800 ">LOGIN</h3>
                <p class="text-sm font-medium mt-2 text-gray-800">Silahkan Login dengan akun yang sudah
                    diregistrasi. Nikmati layanan yang ada di Assalaam Hypermarket</p>
            </div>
        </div>

        <!-- Kolom Kanan: Form Login -->
        <div data-aos="fade-up "
            class="bg-gray-50 rounded-xl p-6 lg:p-12 max-w-md w-full h-max shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] mx-auto">
            <form action="{{ route('login.action') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="mb-8">
                    <h3 class="text-3xl font-extrabold text-gray-800">Sign in</h3>
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
                @endif
                <div>
                    <label class="text-gray-800 text-sm mb-2 block">Email</label>
                    <div class="relative flex items-center">
                        <input name="email" type="email" required
                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                            placeholder="Masukan Email" />
                    </div>
                </div>
                <div class="mt-4">
                    <label class="text-gray-800 text-sm mb-2 block">Password</label>
                    <div class="relative flex items-center">
                        <input id="password" name="password" type="password" required
                            class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                            placeholder="Masukan Password" />
                    </div>
                </div>

                <script>
                    // JavaScript untuk toggle password visibility
                    const togglePassword = document.querySelector('#togglePassword');
                    const passwordInput = document.querySelector('#password');
                    const eyeIcon = document.querySelector('#eyeIcon');

                    togglePassword.addEventListener('click', function() {
                        // Toggle the type attribute
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        // Toggle the eye icon
                        eyeIcon.classList.toggle('fa-eye'); // mengganti ikon mata menjadi tertutup
                        eyeIcon.classList.toggle('fa-eye-slash'); // mengganti ikon mata menjadi terbuka
                    });
                </script>

                <div class="mt-4 text-right">
                    {{-- <a href="javascript:void(0);" class="text-amber-600 text-sm font-semibold hover:underline">Lupa
                        password?</a> --}}
                    <div x-data="{ open: false }" class="inline">
                        <!-- Trigger Button -->
                        <a @click="open = true"
                            class="text-amber-600 cursor-pointer text-sm font-semibold hover:underline">
                            Lupa
                            password?
                        </a>

                        <!-- Modal -->
                        <div x-show="open" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
                            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                            <!-- Overlay -->
                            <div class="fixed inset-0 bg-black opacity-50"></div>

                            <!-- Modal Content -->
                            <div class="relative min-h-screen flex items-center justify-center p-4">
                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative p-6 text-center rounded-t-lg shadow bg-amber-500 sm:p-5">
                                        <button type="button"
                                            class="text-gray-50 absolute top-1.5 right-2.5 bg-transparent hover:bg-white hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-gray-100"
                                            @click="open = false">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>

                                    </div>
                                    <div class=" p-6 bg-white text-left border border-gray-200 rounded-b-lg shadow ">
                                        <svg fill="#00d13f" class="absolute right-5 top-14" height="70px" width="70px"
                                            version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="-30.8 -30.8 369.60 369.60" xml:space="preserve" stroke="#00d13f"
                                            stroke-width="0.0030800000000000003"
                                            transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                                stroke="#CCCCCC" stroke-width="1.848"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="XMLID_468_">
                                                    <path id="XMLID_469_"
                                                        d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156 c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687 c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887 c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153 c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348 c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802 c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922 c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0 c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458 C233.168,179.508,230.845,178.393,227.904,176.981z">
                                                    </path>
                                                    <path id="XMLID_470_"
                                                        d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716 c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396 c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188 l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677 c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867 C276.546,215.678,222.799,268.994,156.734,268.994z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                        <a href="#">
                                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 ">
                                                Butuh bantuan?</h5>
                                        </a>
                                        <p class="mb-3 font-normal text-gray-500 ">Silahkan menghubungi Customer
                                            Services Assalaam Hypermarket</p>
                                        <a target="_blank" href="https://wa.me/6281226048447"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-amber-400 rounded-lg hover:bg-amber-500 focus:ring-4 focus:outline-none focus:ring-amber-300">
                                            Hubungi
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 bg-amber-500 rounded-md">
                    <button type="submit"
                        class="w-full shadow-xl py-3 px-6 text-sm font-semibold rounded-md text-white  hover:bg-amber-600 focus:outline-none">
                        Masuk
                    </button>
                </div>
                <p class="text-sm mt-8 text-center text-gray-800">Belum punya akun? <a href="{{ route('register') }}"
                        class="text-amber-600 font-bold hover:underline ml-1 whitespace-nowrap">Daftar
                        sekarang</a>
                </p>
            </form>
        </div>
    </div>
</div>



@include('include.htmlend')