@include('include.htmlstart')
<section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
        <section class="relative flex h-32 items-end bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6">
            <img alt="" src="{{ asset('images/assalamBg.png') }}"
                class="absolute inset-0 h-full w-full object-cover opacity-80" />

            <div class="hidden lg:relative lg:block lg:p-12">
                <a class=" text-white" href="{{ route('dashboard') }}">
                    <img alt="" src="{{ asset('images/logo.png') }}" class="h-12" />
                </a>

                <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
                    Selamat Datang di Assalam Hypermarket
                </h2>
            </div>
        </section>

        <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
            <div class="max-w-xl lg:max-w-3xl">
                <div class="relative -mt-16 block lg:hidden">
                    <a class="inline-flex size-16 items-center justify-center rounded-full bg-white text-blue-600 sm:size-20"
                        href="#">
                        <span class="sr-only">Home</span>
                        <img alt="" src="{{ asset('images/logo.png') }}"
                            class="h-14 ml-1 sm:h-16 sm:ml-1.5 sm:mb-1" />
                    </a>

                    <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Selamat Datang di Assalam Hypermarket
                    </h1>
                </div>

                <form action="{{ route('register.save') }}" x-data="{ showInput: false }" method="POST"
                    class="mt-2 grid grid-cols-6 gap-6" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="is_admin" value="1">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nama
                        </label>
                        <input type="text" id="name" name="name" placeholder="Nama lengkap"
                            class="input mt-2 focus:outline-blue-600 border-2 border-gray-700 rounded-md input-bordered w-full max-w-xs" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block text-sm font-medium  text-gray-700"> Email </label>
                        <input type="email" placeholder="Masukan Email" id="email" name="email"
                            class="input mt-2 focus:outline-blue-600 border-2 border-gray-700 rounded-md input-bordered w-full max-w-xs" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="role" class="block text-sm font-medium text-gray-700">
                            Role
                        </label>
                        <select name="role" id="role" x-on:change="showInput = ($event.target.value === 'user')"
                            class="input focus:outline-blue-600 mt-2 input-bordered border-2 border-gray-700 rounded-md max-w-xs w-full ">
                            <option selected disabled>~Pilih Role~</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>


                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="file" class="block mt-2 text-sm font-medium text-gray-700">
                            Foto Profil
                        </label>
                        <input type="file" name="file"
                            class="file-input text-gray-400 border-2 border-gray-700 rounded-md  focus:outline-blue-600 file-input-bordered w-full max-w-xs" />
                    </div>

                    <div x-show="showInput" class="col-span-6 sm:col-span-3">
                        <label for="member" class="block text-sm font-medium text-gray-700">
                            Masukan No. Member
                        </label>
                        <input type="text" id="member" name="no_member" placeholder="No Member"
                            class="input mt-2 focus:outline-blue-600 border-2 border-gray-700 rounded-md input-bordered w-full max-w-xs" />
                    </div>
                    <div x-show="showInput" class="col-span-6 sm:col-span-3">
                        <label for="date" class="block text-sm font-medium  text-gray-700"> Tanggal Lahir
                        </label>
                        <input type="date" id="date" name="tanggal_lahir"
                            class="input mt-2 focus:outline-blue-600 border-2 border-gray-700 rounded-md input-bordered w-full max-w-xs" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>

                        <input type="password" id="password" name="password" placeholder="Masukan Password"
                            class="input focus:outline-blue-600 border-2 border-gray-700 rounded-md mt-2 input-bordered w-full max-w-xs" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="PasswordConfirmation"
                            class="block focus:outline-blue-600 text-sm font-medium text-gray-700">
                            Password Confirmation
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            class="input mt-2 border-2 border-gray-700 rounded-md input-bordered w-full max-w-xs" />
                    </div>
                    <div class="col-span-6">
                        <div class="flex items-center mt-2">
                        <input name="terms" id="terms" value="accepted" {{ old('terms') ? 'checked' : '' }}
                            type="checkbox" class="h-4 w-4 shrink-0 border-gray-300 rounded" />
                        <label for="terms" class="ml-3 block text-sm text-gray-800">
                            Saya menyetujui <a href="#"
                                class="text-blue-500 font-semibold hover:underline ml-1">Syarat dan Ketentuan</a>
                        </label>
                    </div>
                    </div>
                    <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                        <button type="submit"
                            class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-blue-800 hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                            Buat akun
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</section>
@include('include.htmlend')
