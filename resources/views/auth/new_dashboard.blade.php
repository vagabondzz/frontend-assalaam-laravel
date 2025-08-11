@include('include.htmlstart')
@include('include.sidebarstart')
@include('include.sayhi')
<div class=" w-full sm:ml-64 overflow-auto">
    {{-- card --}}
    <div class="mt-16 px-4 pt-4 grid sm:grid-rows-1 grid-flow-col gap-2">
        <div class="col-span-1 sm:row-span-2 ">
            <div class="col-span-1 block sm:hidden mb-2 sm:row-span-2">
                <div class="text-sm font-bold flex flex-col items-center absolute left-[192px] mt-[98px] ">
                    @if (Auth::user()->member)
                        @if ($is_member_active)
                            <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                            <span class="mt-2">{{ Auth::user()->member->no_member }}</span>
                            <p class="">
                                MEMBER AKTIF
                            </p>
                        @else
                            <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                            <span>{{ Auth::user()->member->no_member }}</span>
                            <p class="text-rose-500">
                                MEMBER TIDAK AKTIF
                            </p>
                        @endif
                    @endif
                </div>
                <a href="#" onclick="my_modal_2.showModal()">
                    <img src="{{ asset('images/cardHp.png') }}" class="shadow-md rounded-3xl bg-lime-400" alt=""
                        srcset="">
                </a>
                <dialog id="my_modal_2" class="modal">
                    <div class="modal-box overflow-hidden p-0 bg-red-400/0">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                        <img src="{{ asset('images/cardHp.png') }}" class="shadow-md rounded-3xl bg-lime-400"
                            alt="" srcset="">
                        <div class="text-sm font-bold relative flex flex-col items-center -right-[85px] -top-[128px] ">
                            @if (Auth::user()->member)
                                @if ($is_member_active)
                                    <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                                    <span>{{ Auth::user()->member->no_member }}</span>
                                    <p class="">
                                        MEMBER AKTIF
                                    </p>
                                @else
                                    <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                                    <span>{{ Auth::user()->member->no_member }}</span>
                                    <p class="text-rose-500 ">
                                        MEMBER TIDAK AKTIF
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>
                </dialog>
            </div>
            <div
                class="relative shadow-md shadow-gray-900 flex flex-row items-center card dark:bg-gray-700 text-gray-700 overflow-hidden rounded-xl border-2 border-gray-200 dark:border-gray-600">
                <!-- Teks Selamat Datang -->
                <div class="relative flex flex-row m-3 " x-data="welcomeCard()" x-init="init()">
                    <div class="flex flex-col m-2">
                        <div class="relative" x-data="tanggalSekarang()" x-init="init()">
                            @include('include.tanggal')
                            <p class=" text-gray-600 text-lg sm:text-2xl dark:text-gray-300" x-text="tanggal"></p>
                        </div>
                        <div class=" flex flex-row text-gray-700  dark:text-gray-200">
                            <span class="text-lg sm:text-xl font-bold" x-text="`${greeting}`">
                            </span>
                            <p class="text-lg font-bold sm:text-xl -ml-2"> &nbsp {{ Auth::user()->name }}!</p>
                        </div>
                    </div>
                </div>
                <!-- Elemen Dekoratif -->
                <div class="absolute inset-0">
                    <!-- Lingkaran Dekoratif -->
                    <div class="absolute w-20 h-20 bg-green-500 rounded-full opacity-10 -top-8 -left-8"></div>
                    <div class="absolute w-16 h-16 bg-green-400 rounded-full opacity-10 top-20 -right-6"></div>
                </div>
            </div>

            <div class="grid gap-2 mt-2 sm:grid-cols-2">
                <div
                    class="relative shadow-md shadow-gray-900 flex flex-row items-center justify-between card dark:bg-gray-700 text-gray-700 overflow-hidden p-8 rounded-xl border-2 border-gray-200 dark:border-gray-600">
                    <!-- Decorative Element -->
                    <div class="absolute w-20 h-20 bg-green-500 rounded-full opacity-10 -top-8 -left-8"></div>
                    <div class="absolute w-16 h-16 bg-green-400 rounded-full opacity-10 top-14 -right-6"></div>
                    <!-- Text Content -->
                    <div class="relative">
                        <h5 class="text-xs font-bold text-gray-800 dark:text-white uppercase">Total Belanja</h5>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">
                            @currency($trans_total)
                        </p>

                    </div>
                    <!-- SVG Icon on the Right -->
                    <div class="text-green-500">
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div
                    class="relative shadow-md shadow-gray-900 flex flex-row items-center justify-between card dark:bg-gray-700 text-gray-700 overflow-hidden p-6 rounded-xl border-2 border-gray-200 dark:border-gray-600">
                    <!-- Decorative Element -->
                    <div class="absolute w-20 h-20 bg-green-500 rounded-full opacity-10 -top-8 -left-8"></div>
                    <div class="absolute w-16 h-16 bg-green-400 rounded-full opacity-10 top-14 -right-6"></div>
                    <!-- Text Content -->
                    <div class="relative">
                        <h5 class="text-xs font-bold text-gray-800 dark:text-white uppercase">Total Poin</h5>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{ $total_poin }}
                        </p>

                    </div>
                    <!-- SVG Icon on the Right -->
                    <div class="text-green-500">
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        {{-- cek --}}
        <div class=" hidden sm:block box-content">
            <a href="#" onclick="my_modal_1.showModal()">
                <img src="{{ asset('images/card2.png') }}" class="shadow-md rounded-3xl h-60 w-full bg-lime-400 "
                    alt="" srcset="">
                <div class="text-base font-bold relative flex flex-col items-center -right-[110px] -top-[135px]">
                    @if (Auth::user()->member)
                        @if ($is_member_active)
                            <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                            <span>{{ Auth::user()->member->no_member }}</span>
                            <p class="text-green-500">
                                MEMBER AKTIF
                            </p>
                        @else
                            <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                            <span>{{ Auth::user()->member->no_member }}</span>
                            <p class="text-rose-500">
                                MEMBER TIDAK AKTIF
                            </p>
                        @endif
                    @endif
                </div>
            </a>
            <dialog id="my_modal_1" class="modal rounded-3xl">
                <div class="modal-lg overflow-hidden h-auto w-auto">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute my-2 ml-[522px]">✕</button>
                    </form>
                    <img src="{{ asset('images/card2.png') }}" class=" w-full h-full object-cover " alt=""
                        srcset="">
                    <div class="text-xl font-bold relative flex flex-col items-center -right-[145px] -top-[170px]">
                        @if (Auth::user()->member)
                            @if ($is_member_active)
                                <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                                <span class="tracking-widest">{{ Auth::user()->member->no_member }}</span>
                                <p class="text-green-500 ">
                                    MEMBER AKTIF
                                </p>
                            @else
                                <p class="text-white p-2 mb-2">{!! DNS1D::getBarcodeHTML(Auth::user()->member->no_member, 'C128') !!}</p>
                                <span>{{ Auth::user()->member->no_member }}</span>
                                <p class="text-rose-500">
                                    MEMBER TIDAK AKTIF
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            </dialog>
        </div>
        {{-- cek --}}
    </div>
    {{-- card --}}
    <div
        class="hidden sm:block  h-1 -mt-24 mx-5 bg-gradient-to-r from-green-500 to-yellow-300 dark:from-orange-300 dark:to-yellow-700 shadow-md rounded-full animate-pulse">
    </div>
    <div
        class="block sm:hidden h-1 mt-2 mx-5 bg-gradient-to-r from-green-500 to-yellow-300 dark:from-orange-300 dark:to-yellow-700 shadow-md rounded-full animate-pulse">
    </div>
    {{-- table --}}
    <div
        class="p-2 mx-4 my-2 sm:my-4 relative flex flex-col overflow-auto rounded-xl bg-gray-50 text-gray-700 dark:bg-gray-700 dark:text-gray-200 shadow-md">
        <h2
            class="text-center text-md font-bold text-gray-800 dark:text-gray-200 border-b dark:border-gray-900 pb-3 pt-1">
            RIWAYAT TRANSAKSI
        </h2>
        <table class="w-full min-w-[640px] table-auto ">
            <thead>
                <tr>
                    <th class="border-b dark:border-gray-900 py-2 px-7 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            No. Transaksi</p>
                    </th>
                    <th class="border-b dark:border-gray-900 py-2 px-8 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Tanggal Transaksi</p>
                    </th>
                    <th class="border-b dark:border-gray-900 py-2 px-2 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Total Transaksi</p>
                    </th>
                    <th class="border-b dark:border-gray-900 py-2 px-4 text-left">
                        <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                            Poin</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td class="py-2 px-5 border-b dark:border-gray-900">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="block antialiased font-sans text-xs font-normal">
                                        {{ $transaction->trans_no }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 px-5 border-b dark:border-gray-900">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="block antialiased font-sans text-xs font-normal">
                                        {{-- {{ $transaction->trans_date }} --}}
                                        @dayDate($transaction->trans_date)
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 px-5 border-b dark:border-gray-900">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="block antialiased font-sans text-xs font-normal text-blue-gray-500">
                                        @currency($transaction->trans_total_transaction)
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 px-5 border-b dark:border-gray-900">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p
                                        class="block antialiased font-sans text-xs font-bold text-gray-800 bg-green-200 rounded-md p-1">
                                        {{ $transaction->trans_poin_pas }}
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-xl py-3 font-bold">
                            Belum ada riwayat transaksi.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="mt-2 px-4 py-2 text-sm ">
            @if (!$transactions->isEmpty())
                {{ $transactions->links() }}
            @endif
        </div>
    </div>
    {{-- table --}}

    {{-- chart --}}
    <div class="m-4  card dark:bg-gray-700 dark:text-gray-200 shadow-md">
        <div class="card-body -mt-4 ">
            <div
                class="card-title flex flex-col dark:bg-gradient-to-b dark:from-green-600 dark:to-lime-500 rounded-lg">
                <p class="">Grafik Belanja Tahunan</p>
                <p class="mb-2">{{ \Carbon\Carbon::now()->format('Y') }}
                </p>
            </div>

            <div id="chart" class="-mt-4 -m-4">
                <div
                    class="dark:absolute dark:w-[42px] dark:h-[450px] dark:bg-white dark:rounded-t-lg dark:top-[110px] dark:left-[21px] ">
                </div>
                <div
                    class="dark:absolute dark:h-8 dark:w-[320px] sm:dark:w-[940px] dark:bg-white dark:rounded-bl-lg dark:rounded-r-lg dark:bottom-[30px] dark:left-[21px] ">
                </div>
                {!! $chart->container() !!}
                {!! $chart->script() !!}
            </div>
        </div>
    </div>
    {{-- chart --}}







</div>
@include('include.htmlend')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
