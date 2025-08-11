@include('include.htmlstart')
@include('include.sidebarstart')

<div class=" w-full overflow-y-hidden sm:ml-64">
    <div class="mt-24 p-3 sm:p-2 flex flex-col h-screen w-full gap-6">
        <div
            class="bg-clip-border flex flex-row rounded-xl  bg-gradient-to-tr from-[#026631] to-[#22AA62] text-white shadow-gray-900/20 shadow-lg -mt-6 p-6 dark:bg-gradient-to-tr dark:from-[#F97300] dark:to-[#dc6f10]">
            <span
                class="block text-xl antialiased flex-grow tracking-normal mt-1 justify-start font-sans font-semibold leading-relaxed text-white">
                Data Akun</span>
            <div class="hidden sm:w-72 md:flex items-center relative">
                <form class="w-full sm:w-auto" action="/table-akun" method="GET">
                    @csrf
                    <div class="relative sm:w-[302px] flex items-center">

                        <input type="search" name="search"
                            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari" value="{{ request()->search ? request()->search : '' }}" />
                        <button type="submit"
                            class="text-white absolute end-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                    </div>
                </form>
            </div>
            <a href="/table-akun"
                class="px-4 py-1.5 ml-5 bg-rose-600 dark:bg-rose-600 hover:bg-rose-700 dark:hover:bg-rose-700 text-rose-50 dark:text-rose-50 font-semibold rounded-md text-md hidden md:block">
                Reset
            </a>
        </div>

        <div class="flex space-x-2 md:hidden -mt-2 w-full">
            <div class="flex items-center relative w-full">
                <form class="w-full sm:w-auto" action="/table-akun" method="GET">
                    @csrf
                    <div class="relative sm:w-[302px] flex items-center">

                        <input type="search" name="search"
                            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari" value="{{ request()->search ? request()->search : '' }}" />
                        <button type="submit"
                            class="text-white absolute end-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                    </div>
                </form>
            </div>
            <a href="/table-akun"
                class="px-4 py-1.5 ml-5 bg-rose-600 dark:bg-rose-600 hover:bg-rose-700 dark:hover:bg-rose-700 text-rose-50 dark:text-rose-50 font-semibold rounded-md text-md">
                Reset
            </a>
        </div>

        <table class="w-full min-w-[640px] table-auto dark:text-gray-200">
            <thead>
                <tr>
                    <th class="border-b border-gray-50 dark:border-gray-900 py-2 px-5 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Akun</p>
                    </th>
                    <th class="border-b dark:border-gray-900 py-2 px-5 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Role</p>
                    </th>
                    <th class="border-b dark:border-gray-900 py-2 px-5 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Tgl. Pembuatan</p>
                    </th>
                    <th class="border-b dark:border-gray-900 py-2 px-14 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Aksi
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                @csrf
                <tr>
                    <td class="py-2 px-2 border-b dark:border-gray-900">
                        <div class="flex items-center gap-4">
                            @if ($user['profile_photo'])
                            <img src="{{ asset('storage/files/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                                class="inline-block relative  object-cover object-center w-9 h-9 rounded-full">
                            @else
                            <img src="https://img.icons8.com/3d-fluency/50/person-male--v7.png"
                                class="inline-block relative object-cover object-center w-9 h-9 rounded-full"
                                alt="Default Profile Photo">
                            @endif
                            <div>
                                <p
                                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-semibold">
                                    {{ $user['name'] }}</p>

                                <p class="block antialiased font-sans text-xs font-normal text-blue-gray-500">
                                    {{ $user['email'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-2 px-5 border-b dark:border-gray-900">
                        <p class="block antialiased font-sans text-xs font-semibold text-blue-gray-600">
                            {{ $user['role'] }}</p>
                    </td>

                    <td class="py-2 px-5 border-b dark:border-gray-900">
                        <p class="block antialiased font-sans text-xs font-semibold text-blue-gray-600">
                            {{ $user['created_at'] }}</p>
                    </td>
                    <td class="py-2 px-5 border-b dark:border-gray-900">
                        <div class="flex flex-row gap-2">
                            <div x-data="{ open: false }" class="inline">
                                <!-- Trigger Button -->
                                <button @click="open = true"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Perbarui Password
                                </button>

                                <!-- Modal -->
                                <div x-show="open" x-cloak class="fixed  inset-0 z-50 overflow-y-auto"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                                    <!-- Overlay -->
                                    <div class="fixed inset-0 bg-black opacity-50"></div>

                                    <!-- Modal Content -->
                                    <div class="relative min-h-screen flex items-center justify-center p-4">
                                        <div
                                            class="relative card dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
                                            <div class="p-6">
                                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                                    Perbarui Password
                                                </h3>

                                                <form action="/update-akun/{{ $user['id'] }}" method="POST"
                                                    class="space-y-4">
                                                    @csrf
                                                    @method('PUT')

                                                    <p class="text-gray-900 dark:text-gray-50 font-semibold">
                                                        Nama: {{ $user['name'] }}
                                                    </p>

                                                    <div>
                                                        <label for="password"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                            Password Baru
                                                        </label>
                                                        <input type="password" name="password" id="password"
                                                            placeholder="Masukkan password baru"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                            required />
                                                    </div>

                                                    <div>
                                                        <label for="password_confirmation"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                                                            Password</label>
                                                        <input type="password" name="password_confirmation"
                                                            id="password_confirmation"
                                                            placeholder="Masukkan konfirmasi password"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                            required />
                                                    </div>

                                                    <div class="flex justify-end gap-3">
                                                        <button type="button" @click="open = false"
                                                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Cancel
                                                        </button>
                                                        <button type="submit"
                                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Update Password
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- delete modal --}}
                            <div x-data="{ open: false }" class="inline">
                                <!-- Trigger Button -->
                                <button @click="open = true"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Hapus
                                </button>

                                <!-- Modal -->
                                <div x-show="open" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                                    <!-- Overlay -->
                                    <div class="fixed inset-0 bg-black opacity-50"></div>

                                    <!-- Modal Content -->
                                    <div class="relative min-h-screen flex items-center justify-center p-4">
                                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div
                                                class="relative p-4 text-center card rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <button type="button"
                                                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    @click="open = false">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <p class="mb-4 text-gray-500 dark:text-gray-300">
                                                    Apakah anda yakin akan menghapus akun "{{ $user['name'] }}"?
                                                </p>
                                                <div class="flex justify-center items-center space-x-4">
                                                    <button type="button"
                                                        class="py-2 px-3 text-sm font-medium text-gray-500 rounded-lg border border-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-500 dark:hover:text-gray-50 dark:hover:bg-gray-500 dark:focus:ring-gray-600"
                                                        @click="open = false">
                                                        Tidak, Batalkan
                                                    </button>
                                                    <form action="/delete-akun/{{ $user['id'] }}" method="get">
                                                        @csrf
                                                        <button type="submit"
                                                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                            Ya, Saya Yakin
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end delete modal --}}

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2 px-4 py-2 text-sm ">
        {{ $users->links() }}
    </div>
</div>


@include('include.htmlend')


{{-- cek --}}