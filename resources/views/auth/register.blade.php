@include('include.htmlstart')

{{-- Register New --}}
<div class="font-[sans-serif] min-h-screen w-full flex items-center justify-center bg-gradient-to-tr from-gray-200 to-emerald-100"
    style="background-image: linear-gradient(rgba(99, 99, 99, 0.5), rgba(99, 99, 99, 0.5)), url('{{ asset('https://pas.assalaamhypermarket.co.id/images/bg.jpg') }}'); background-size: cover; background-position: center;">
    <div data-aos="zoom-in"
        class="grid lg:grid-cols-2 gap-4 max-w-5xl w-full p-6 rounded-lg shadow-lg mx-auto sm:mx-4"
        style="background-image: linear-gradient(rgba(255, 255, 255, 0.452), rgba(248, 226, 226, 0.402))">
        <div class="lg:ps-2">
            <a href="beranda"><img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/logoTeks.png') }}" alt="logo"
                    class='w-56' /></a>
            <div class="max-w-lg mt-20 ml-10 max-lg:hidden">
                <h3 class="text-3xl font-bold text-gray-800">Buat akun</h3>
                <p class="text-sm text-gray-800">Buat akun Assalaam Hypermarket, dan dapatkan manfaat optimal
                    dari semua layanan Assalaam Hypermarket</p>
            </div>

            {{-- link sosmed --}}
            <div data-aos="zoom-in" class="hidden sm:block">
                <div class="grid grid-cols-2 mt-2 md:grid-cols-3 gap-3 items-center">
                    <img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/grab.png') }}" class="w-28 mx-auto" />
                    <img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/tokopedia.png') }}" class="w-28 mx-auto" />
                    <img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/wa.png') }}" class="w-30 mx-auto mt-4" />
                    <img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/shopee.png') }}" class="w-28 mx-auto mb-2" />
                    <img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/instagram.png') }}" class="w-28 mx-auto mt-2" />
                    <img src="https://readymadeui.com/facebook-logo.svg" class="w-28 mx-auto" />
                </div>
            </div>
        </div>

        <div data-aos="fade-up"
            class="bg-white rounded-xl px-4 py-4 max-w-md w-full h-max shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] max-lg:mx-auto">
            <form id="registerForm" enctype="multipart/form-data">

                {{-- nama --}}
                <div>
                    <label class="text-gray-800 text-xs mb-2 block">Nama</label>
                    <input name="name" type="text"
                        class="w-full text-xs text-gray-800 border border-gray-300 p-2 mb-2 rounded-md outline-blue-600"
                        placeholder="Masukan Nama" />
                </div>

                {{-- email --}}
                <div>
                    <label class="text-gray-800 text-xs mb-2 block">Email</label>
                    <input name="email" type="email"
                        class="w-full text-xs text-gray-800 border border-gray-300 p-2 mb-2 rounded-md outline-blue-600"
                        placeholder="Masukan email" />
                </div>

                <input type="hidden" value="user" name="role">

                {{-- profil image --}}
                <label for="file" class="block mb-2 text-xs text-gray-800">Foto Profil</label>
                <input type="file" name="file"
                    class="file-input file-input-sm text-xs text-gray-400 border-gray-300 rounded-md mb-2 w-full" />

                {{-- Dropdown Member --}}
                <div x-data="{ open: false }">
                    <a href="" @click.prevent="open = !open" class="flex items-start group text-gray-800 "
                        role="button">
                        <span class="text-sm">Sudah punya Member PAS?</span>
                        <span aria-hidden="true" class="ml-auto">
                            <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </a>

                    <div x-show="open" class="mt-2 space-y-2" x-cloak>
                        <input name="no_member" type="text"
                            class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                            placeholder="Masukan No. Member" />

                        <input type="date" name="tanggal_lahir"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2">
                    </div>

                    <p class="text-blue-500 text-xs mt-1">(Jika sudah punya Kartu Member silahkan klik panah
                        kebawah untuk mengisi No.Member)</p>
                </div>

                {{-- password --}}
                <div class="mt-2">
                    <label class="text-gray-800 text-xs mb-2 block">Password</label>
                    <input name="password" type="password"
                        class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                        placeholder="Masukan password" />
                </div>

                {{-- Confirm Password --}}
                <div class="mt-2">
                    <label class="text-gray-800 text-xs mb-2 block">Konfirmasi password</label>
                    <input name="password_confirmation" type="password"
                        class="w-full text-xs text-gray-800 border border-gray-300 p-2 rounded-md outline-blue-600"
                        placeholder="Masukan ulang password" />
                </div>
    <!-- Wrapper utama dengan Alpine.js -->
<!-- Bungkus seluruh komponen dengan Alpine -->
<div x-data="{ open: false }">

    <form id="registerForm" enctype="multipart/form-data">
        {{-- Terms --}}
        <div class="flex items-center mt-2">
            <input name="terms" id="terms" value="accepted" type="checkbox"
                class="h-4 w-4 shrink-0 border-gray-300 rounded" />
            <label for="terms" class="ml-3 block text-sm text-gray-800">
                Saya menyetujui
                <a href="#" @click.prevent="open = true"
                   class="text-blue-500 font-semibold hover:underline ml-1">
                   Syarat dan Ketentuan
                </a>
            </label>
        </div>

        {{-- Area Notifikasi --}}
        <div id="notif-area" class="mt-3 hidden">
            <p id="notif-text"
               class="text-xs text-center font-semibold py-2 rounded-md transition-all duration-300"></p>
        </div>

        {{-- Tombol --}}
        <div class="mt-2 bg-amber-500 rounded-md hover:bg-amber-600 focus:outline-none">
            <button type="submit"   
                class="w-full block text-center shadow-xl py-3 px-6 text-sm font-semibold text-white">
                Buat Akun
            </button>
        </div>

        <p class="text-sm mt-4 text-center text-gray-800">
            Sudah punya akun?
            <a href="login" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">
                Login disini
            </a>
        </p>
    </form>

    <!-- 🧱 Modal DILUAR FORM (tidak trigger submit) -->
    <div x-show="open"
         x-transition.opacity
         class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
         x-cloak>
      <div @click.away="open = false"
           class="bg-white rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/2 p-6 overflow-y-auto max-h-[80vh]">
        <h2 class="text-xl font-semibold mb-2 text-gray-800">Syarat & Ketentuan</h2>

        <div class="text-sm text-gray-700 space-y-2">
          <p>1. Pengguna wajib mengisi data dengan benar dan sesuai identitas asli.</p>
          <p>2. Data pribadi akan digunakan sesuai kebijakan privasi Assalaam Hypermarket.</p>
          <p>3. Pengguna bertanggung jawab atas keamanan akun dan kata sandinya.</p>
          <p>4. Pelanggaran terhadap ketentuan dapat mengakibatkan penonaktifan akun.</p>
          <p>5. Assalaam Hypermarket berhak memperbarui ketentuan sewaktu-waktu.</p>
        </div>

        <div class="mt-4 text-right">
          <!-- 🧠 Gunakan type="button" agar tidak ikut submit -->
          <button type="button" @click="open = false"
                  class="bg-amber-500 text-white px-4 py-2 rounded-md hover:bg-amber-600">
            Tutup
          </button>
        </div>
      </div>
    </div>
</div>




@include('include.htmlend')

<!-- Script Register -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
    const notifArea = document.getElementById("notif-area");
    const notifText = document.getElementById("notif-text");
    const submitBtn = form.querySelector("button[type='submit']");
    const API_URL = "{{ api_url('/api/auth/register') }}";

    function showNotif(text, color) {
        notifText.textContent = text;
        notifArea.classList.remove("hidden");
        notifText.className = `text-xs text-center font-semibold py-2 rounded-md ${color}`;
        setTimeout(() => notifArea.classList.add("hidden"), 5000);
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        // Disable tombol & tampilkan spinner
        submitBtn.disabled = true;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <div class="flex items-center justify-center gap-2">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                Sedang diproses...
            </div>
        `;

        const formData = new FormData(form);

        // Sesuaikan field
        if (formData.has("no_member")) {
            formData.append("member_card_no", formData.get("no_member"));
            formData.delete("no_member");
        }
        if (formData.has("tanggal_lahir")) {
            formData.append("date_of_birth", formData.get("tanggal_lahir"));
            formData.delete("tanggal_lahir");
        }

        try {
            const res = await fetch(API_URL, { method: "POST", body: formData });
            const data = await res.json();

            // Validasi gagal
            if (res.status === 422) {
                let msg = "Periksa kembali input Anda.";
                if (data.errors) {
                    if (data.errors.member_card_no || data.errors.date_of_birth) {
                        msg = "Data yang Anda masukkan salah.";
                    } else {
                        msg = Object.values(data.errors).flat().join(" ");
                    }
                }
                showNotif(msg, "bg-red-100 text-red-600");
            } 
            // Member sudah punya akun
            else if (res.status === 409) {
                showNotif(data.message || "Member ini sudah memiliki akun.", "bg-red-100 text-red-600");
            } 
            // Error server
            else if (res.status >= 500) {
                showNotif("Terjadi kesalahan server. Coba lagi nanti.", "bg-red-100 text-red-600");
            } 
            // Sukses
            else if (res.ok && data.success) {
                showNotif("Registrasi berhasil! Mengalihkan ke halaman login...", "bg-green-100 text-green-600");
                setTimeout(() => window.location.href = "/login", 2000);
            } 
            // Gagal lain
            else {
                showNotif(data.message || "Registrasi gagal.", "bg-red-100 text-red-600");
            }

        } catch (err) {
            console.error(err);
            showNotif("Gagal terhubung ke server. Pastikan backend aktif.", "bg-red-100 text-red-600");
        } finally {
            // Kembalikan tombol normal
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
});
</script>

<script>AOS.init();</script>
<!-- End Script Register -->
 @include('include.htmlend') 