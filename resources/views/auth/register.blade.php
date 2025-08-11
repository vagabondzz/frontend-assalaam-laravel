@include('include.htmlstart')
{{-- register New --}}
<div class="font-[sans-serif] min-h-screen w-full flex items-center justify-center bg-gradient-to-tr from-gray-200 to-emerald-100"
    style="background-image: linear-gradient(rgba(99, 99, 99, 0.5), rgba(99, 99, 99, 0.5)), url('{{ asset('images/bg.jpg') }}'); background-size: cover; background-position: center;">
    <div data-aos="zoom-in"
        class="grid lg:grid-cols-2 gap-4 max-w-5xl w-full p-6 rounded-lg shadow-lg mx-auto sm:mx-4 "   style="background-image: linear-gradient(rgba(255, 255, 255, 0.452), rgba(248, 226, 226, 0.402))">
        <div class="lg:ps-2">
            <a href="beranda"><img src="{{ asset('images/logoTeks.png') }}" alt="logo" class='w-56' />
            </a>
            <div class="max-w-lg mt-20 ml-10 max-lg:hidden">
                <h3 class="text-3xl font-bold text-gray-800">Buat akun</h3>

                <p class="text-sm text-gray-800">Buat akun Assalaam Hypermarket, dan dapatkan manfaat optimal
                    dari semua layanan Assalaam Hypermarket</p>
            </div>


            {{-- link sosmed --}}
            <div data-aos="zoom-in" class="hidden sm:block">
                <div class="grid grid-cols-2 mt-2 md:grid-cols-3 gap-3 items-center">
                    <img src="{{ asset('images/grab.png') }}" class="w-28 mx-auto" />
                    <img src="{{ asset('images/tokopedia.png') }}" class="w-28 mx-auto" />
                    <img src="{{ asset('images/wa.png') }}" class="w-30 mx-auto mt-4" />
                    <img src="{{ asset('images/shopee.png') }}" class="w-28 mx-auto mb-2" />
                    <img src="{{ asset('images/instagram.png') }}" class="w-28 mx-auto mt-2" />
                    <img src="https://readymadeui.com/facebook-logo.svg" class="w-28 mx-auto" />
                </div>
            </div>

            {{-- link sosmed --}}
        </div>

        <div data-aos="fade-up"
            class="bg-white rounded-xl  px-4 py-4 max-w-md w-full h-max shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] max-lg:mx-auto">
            <form action="{{ route('register.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <h3 class="text-2xl font-extrabold text-gray-800">Sign in</h3>
                </div>
                {{-- alert --}}
                @if (session('failed'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Errors!</strong>
                        <span class="block sm:inline">
                            {{ session('failed') }}
                        </span>
                    </div>
                @endif
                {{-- alert --}}
                {{-- nama --}}
                <div>
                    <label class="text-gray-800 text-xs mb-2 block">Nama</label>
                    <div class="relative mb-2 flex items-center">
                        <input name="name" type="text" value="{{ old('name') }}"
                            class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                            placeholder="Masukan Nama" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                            class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                            <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                            <path
                                d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                data-original="#000000"></path>
                        </svg>
                    </div>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    {{-- nama --}}
                    {{-- email --}}
                    <div>
                        <label class="text-gray-800 text-xs mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="email" value="{{ old('email') }}"
                                class="w-full text-xs text-gray-800 border border-gray-300 p-2 mb-2 rounded-md outline-blue-600"
                                placeholder="Masukan email" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1 0.9 2 2 2h16c1.1 0 2-0.9 2-2V6c0-1.1-0.9-2-2-2zm0 2v2l-8 5-8-5V6h16zm-8 7 8-5v8H4v-8l8 5z" />
                            </svg>
                        </div>

                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="hidden">
                        <input type="text" value="user" name="role">
                    </div>
                    {{-- email --}}

                    {{-- profil image --}}
                    <label for="file" class="block mb-2 text-xs text-gray-800">Foto Profil</label>
                    <div class="relative text-xs mb-2 flex items-center">
                        <input type="file" name="file" value="{{ old('file') }}"
                            class="file-input file-input-sm text-xs text-gray-400 border-gray-300 rounded-md focus:outline-blue-600 file-input-bordered w-full" />
                    </div>

                    {{-- profil image --}}

                    {{-- Dropdown --}}

                    {{-- dropdown --}}
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->

                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-start group text-gray-800 "
                            :class="{
                                ' text-gray-800 ': open
                            }"
                            role="button" aria-haspopup="true" :aria-expanded="(open) ? 'true' : 'false'"
                            aria-expanded="true">
                            <span class="text-sm"> Sudah punya Member PAS? </span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform rotate-180"
                                    :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </span>
                        </a>

                        <div x-show="open" class="mt-2 space-y-2 " role="menu" aria-label="Authentication">

                            <div class="relative mb-2 flex items-center">
                                <input name="no_member" type="text" value="{{ old('no_member') }}"
                                    class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                                    placeholder="Masukan No. Member" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                    <path
                                        d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                        data-original="#000000"></path>
                                </svg>
                                @error('no_member')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="relative w-full">
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full pe-4">
                                @error('tanggal_lahir')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="text-blue-500">
                            <p class="text-xs">(Jika sudah punya Kartu Member silahkan klik panah kebawah untuk mengisi
                                No.Member)</p>
                        </div>
                    </div>
                    {{-- password --}}
                    <div class="mt-2">
                        <label class="text-gray-800 text-xs mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input name="password" type="password"
                                class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                                placeholder="Masukan password" />

                          
                        </div>
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- password --}}
                    {{-- Confirm Pasword --}}
                    <div class="mt-2">
                        <label class="text-gray-800 text-xs mb-2 block">Konfirmasi password</label>
                        <div class="relative flex items-center">
                            <input name="password_confirmation" type="password"
                                class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                                placeholder="Masukan ulang password" />

                           
                        </div>
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Confirm Pasword --}}

                    {{-- Terms --}}
                    <div class="flex items-center mt-2">
                        <input name="terms" id="terms" value="accepted" {{ old('terms') ? 'checked' : '' }}
                            type="checkbox" class="h-4 w-4 shrink-0 border-gray-300 rounded" />
                        <label for="terms" class="ml-3 block text-sm text-gray-800">
                            Saya menyetujui <a href="#"
                                class="text-blue-500 font-semibold hover:underline ml-1">Syarat dan Ketentuan</a>
                        </label>
                    </div>
                    {{-- Terms --}}
                    <div class="mt-2 bg-amber-500 rounded-md hover:bg-amber-600 focus:outline-none">
                        <button type="submit" class="w-full shadow-xl py-3 px-6 text-sm font-semibold text-white ">
                            Buat Akun
                        </button>
                    </div>
                    <p class="text-sm mt-4 text-center text-gray-800">Sudah punya akun? <a
                            href="{{ route('login') }}"
                            class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Login
                            disini</a>
                    </p>
            </form>
        </div>
    </div>
</div>
{{-- register New --}}
@include('include.htmlend')

<!--JAVASCRIPT -->
<script>
    // Animasi sederhana untuk elemen dengan ID 'animateMe'
    gsap.from("#animateMe", {
        duration: 1,
        opacity: 0,
        y: -50
    });
</script>
<script>
    AOS.init();
</script>
<!--JAVASCRIPT -->
