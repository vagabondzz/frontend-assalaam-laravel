@include('include.htmlstart')
@include('include.sideCS')

<div class=" w-full sm:ml-64">
    <div class="min-h-screen py-12 mt-10 px-4 sm:px-4 lg:px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Form Header -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Registrasi Member</h2>
                <p class="text-gray-600 dark:text-gray-400">Silakan isi semua informasi yang diperlukan di bawah ini</p>
            </div>

            <!-- Main Form Card -->
            <div class="card dark:bg-gray-700 rounded-2xl shadow-xl overflow-hidden">
                <!-- Progress Bar -->
                <div class="w-full bg-green-50 h-2">
                    <div
                        class="w-full h-full bg-gradient-to-r from-green-500 dark:from-[#F97300]  to-green-500/20 dark:to-[#F97300]/40">
                    </div>
                </div>

                 <form x-data="form" class="p-8" autocomplete="off" autocapitalize="off" spellcheck="false">
    @csrf

    <!-- SECTION 1: PERSONAL AKUN -->
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
            <span class="bg-green-500 dark:bg-[#F97300] text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">1</span>
            Personal Akun
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Email -->
            <div class="relative group">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <div class="relative">
                    <input type="email" name="email" id="email" placeholder="Masukan Email" autocomplete="off" autocorrect="off" autocapitalize="none"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                </div>
            </div>

            <!-- Password -->
            <div class="relative group">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Masukan Password" autocomplete="new-password"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="relative group">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password"
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 2: PERSONAL INFORMATION -->
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
            <span class="bg-green-500 dark:bg-[#F97300] text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">2</span>
            Personal Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Nama -->
            <input type="text" name="MEMBER_NAME" id="MEMBER_NAME" placeholder="Masukan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">

            <!-- Tanggal Lahir -->
            <input type="date" name="MEMBER_DATE_OF_BIRTH" id="MEMBER_DATE_OF_BIRTH" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">

            <!-- Tempat Lahir -->
            <input type="text" name="MEMBER_PLACE_OF_BIRTH" id="MEMBER_PLACE_OF_BIRTH" placeholder="Masukan Tempat Lahir" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-4 gap-6">
            <!-- No Identitas -->
            <input type="text" name="MEMBER_KTP_NO" id="MEMBER_KTP_NO" placeholder="Masukan No. Identitas" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">

            <!-- Status -->
            <select name="MEMBER_IS_MARRIED" id="MEMBER_IS_MARRIED" class="w-full select rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                <option value="">Pilih Status</option>
                <option value="0">Lajang</option>
                <option value="1">Menikah</option>
            </select>

            <!-- Agama -->
            <select name="REF$AGAMA_ID" id="REF$AGAMA_ID" class="w-full select rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                <option selected disabled>Pilih Agama</option>
                <option value="1">Islam</option>
                <option value="2">Kristen</option>
                <option value="3">Katolik</option>
                <option value="4">Budha</option>
                <option value="5">Hindu</option>
                <option value="6">Konghucu</option>
                <option value="7">Lain-lain</option>
            </select>

            <!-- Kewarganegaraan -->
            <select name="MEMBER_IS_WNI" id="MEMBER_IS_WNI" class="w-full select rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                <option selected disabled>Pilih Kewarganegaraan</option>
                <option value="1">WNI (Warga Negara Indonesia)</option>
                <option value="0">WNA (Warga Negara Asing)</option>
            </select>
        </div>
    </div>

    <!-- SECTION 3: KONTAK INFORMASI -->
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
            <span class="bg-green-400 dark:bg-[#EF6C00] text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">3</span>
            Kontak Informasi
        </h3>

        <div class="space-y-6">
            <input type="text" id="MEMBER_ADDRESS" name="MEMBER_ADDRESS" placeholder="Masukan Alamat Lengkap" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">

            <!-- RT / RW -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <input type="text" id="MEMBER_RT" name="MEMBER_RT" placeholder="Masukan RT" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                <input type="text" id="MEMBER_RW" name="MEMBER_RW" placeholder="Masukan RW" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
                <input type="text" id="MEMBER_KELURAHAN" name="MEMBER_KELURAHAN" placeholder="Masukan Kelurahan" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
            </div>

            <input type="text" id="MEMBER_KECAMATAN" name="MEMBER_KECAMATAN" placeholder="Masukan Kecamatan" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
            <input type="text" id="MEMBER_KOTA" name="MEMBER_KOTA" placeholder="Masukan Kota" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
            <input type="text" id="MEMBER_POST_CODE" name="MEMBER_POST_CODE" placeholder="Masukan Kode Pos" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
        </div>
    </div>

    <!-- SECTION 4: INFORMASI TAMBAHAN -->
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
            <span class="bg-green-400/90 dark:bg-[#FFA726] text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">4</span>
            Informasi Tambahan
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <input type="tel" id="MEMBER_TELP" name="MEMBER_TELP" placeholder="Masukan No. HP" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
            <input
  type="number"
  id="MEMBER_JML_TANGGUNGAN"
  name="MEMBER_JML_TANGGUNGAN"
  placeholder="Masukan Jumlah Tanggungan"
  min="0"
  step="1"
  class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">

            <input type="text" id="MEMBER_PENDAPATAN" name="MEMBER_PENDAPATAN" placeholder="Masukan Pendapatan Perbulan" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
        </div>
        <div class="space-y-6 mt-6">
            <!-- NPWP -->

        <input type="text" id="MEMBER_NPWP" name="MEMBER_NPWP" placeholder="Masukan No. NPWP" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-green-500 focus:ring focus:ring-green-200 transition-all duration-200 outline-none dark:bg-gray-800 dark:border-gray-400/50 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#F97300] dark:focus:border-[#F97300]">
    </div>         
    </div>         

    <!-- SUBMIT -->
    <div class="flex flex-wrap justify-end gap-4 pt-6 border-t border-gray-100">
        <button type="submit" class="px-8 py-3 font-semibold rounded-lg bg-green-600 dark:bg-[#F97300] text-white hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition-all duration-200">
            Registrasi
        </button>
    </div>
</form>
            </div>

            <!-- Bottom Info -->
            <div class="mt-8 text-center text-gray-500 text-sm">
                Butuh bantuan? Hubungi <a target="_blank" href="https://wa.me/6281226048447"
                    class="text-blue-500 font-semibold hover:underline">Customer Service</a> di
                Assalaam Hypermarket
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const token = localStorage.getItem("jwt_token_cs");
    const API_URL = "{{ api_url('/api/auth/cs/add-user-member') }}";

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const res = await axios.post(API_URL, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "Authorization": token ? `Bearer ${token}` : ""
                },
            });

            if (res.data.success) {
                Swal.fire({
                    text: "Registrasi berhasil. Akun kamu menunggu verifikasi CS.",
                    timer: 2500,
                    showConfirmButton: false,
                });
                form.reset();
            } else {
                Swal.fire({
                    text: res.data.message || "Terjadi kesalahan pada registrasi.",
                    timer: 2500,
                    showConfirmButton: false,
                });
            }
        } catch (err) {
            console.error(err);
            let msg = "";

            if (err.response) {
                msg =
                    err.response.data?.message ||
                    (Object.values(err.response.data?.errors || {})[0]?.[0]) ||
                    msg;
            }

            Swal.fire({
                text: msg || "Registrasi gagal. Silakan coba lagi.",
                timer: 2500,
                showConfirmButton: false,
            });
        }
    });
    document.getElementById('MEMBER_JML_TANGGUNGAN').addEventListener('input', (e) => {
  if (e.target.value < 0) e.target.value = 0;
});
});
</script>

@include('include.htmlend')
