@include('include.htmlstart')
@include('include.sidemember')

<style>
    body { overflow-x: hidden; }
    .sidebar { min-width: 250px; max-width: 250px; }
    @media (max-width: 991px) {
        .sidebar { position: fixed; z-index: 1050; height: 100vh; left: -250px; transition: left 0.3s; }
        .sidebar.active { left: 0; }
    }
    #photoPreview {
        width: 120px;
        height: 120px;
        border-radius: 9999px;
        object-fit: cover;
        display: none;
        border: 2px solid #ccc;
        margin-left: 1rem;
    }
</style>

<div class="w-full sm:ml-64 bg-gray-50 dark:bg-gray-950 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                Registrasi PAS Member
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Silakan isi semua informasi yang diperlukan di bawah ini
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transition-all duration-200">
            <div class="w-full bg-green-50 h-2">
                <div class="w-full h-full bg-gradient-to-r from-green-500 dark:from-[#F97300] to-green-500/20 dark:to-[#F97300]/40"></div>
            </div>

            <form id="memberForm" enctype="multipart/form-data" class="p-8 space-y-10">
                @csrf

                <!-- Section 1 -->
                <div>
                    <h5 class="text-xl font-semibold text-green-600 dark:text-[#F97300] mb-4">
                        1. Personal Information
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap<span class="text-red-500">*</span></label>
                            <input type="text" id="MEMBER_NAME" name="MEMBER_NAME" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir<span class="text-red-500">*</span></label>
                            <input type="date" name="MEMBER_DATE_OF_BIRTH" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tempat Lahir<span class="text-red-500">*</span></label>
                            <input type="text" name="MEMBER_PLACE_OF_BIRTH" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Identitas (KTP)<span class="text-red-500">*</span></label>
                            <input type="text" name="MEMBER_KTP_NO" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin<span class="text-red-500">*</span></label>
                            <select name="MEMBER_SEX" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                <option value="">Pilih</option>
                                <option value="1">Laki-laki</option>
                                <option value="0">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status<span class="text-red-500">*</span></label>
                            <select name="MEMBER_IS_MARRIED" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                <option value="">Pilih</option>
                                <option value="1">Menikah</option>
                                <option value="0">Belum Menikah</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agama<span class="text-red-500">*</span></label>
                            <select name="REF$AGAMA_ID" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                <option value="">Pilih Agama</option>
                                <option value="1">Islam</option>
                                <option value="2">Kristen Protestan</option>
                                <option value="3">Katolik</option>
                                <option value="4">Hindu</option>
                                <option value="5">Buddha</option>
                                <option value="6">Konghucu</option>
                                <option value="7">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kewarganegaraan<span class="text-red-500">*</span></label>
                            <select name="MEMBER_IS_WNI" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                <option value="">Pilih</option>
                                <option value="1">WNI</option>
                                <option value="0">WNA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div>
                    <h5 class="text-xl font-semibold text-green-600 dark:text-[#F97300] mb-4">
                        2. Kontak Informasi
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap<span class="text-red-500">*</span></label>
                            <textarea name="MEMBER_ADDRESS" rows="2" required
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"></textarea>
                        </div>

                        @foreach (['RT','RW','KELURAHAN','KECAMATAN','KOTA','POST_CODE','TELP'] as $field)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ str_replace('_',' ',$field) }}@if($field=='TELP')<span class="text-red-500">*</span>@endif</label>
                            <input type="text" name="MEMBER_{{ $field }}" {{ $field == 'TELP' ? 'required' : '' }}
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section 3 -->
                <div>
                    <h5 class="text-xl font-semibold text-green-600 dark:text-[#F97300] mb-4">
                        3. Informasi Tambahan
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                        @foreach ([['Jumlah Tanggungan','MEMBER_JML_TANGGUNGAN','number'],['Pendapatan','MEMBER_PENDAPATAN','number'],['NPWP','MEMBER_NPWP','text']] as [$label,$name,$type])
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
                            <input type="{{ $type }}" name="{{ $name }}"
                                class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        </div>
                        @endforeach

                        <!-- FOTO PROFIL -->
                        <div class="flex items-center">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto Profil<span class="text-red-500">*</span></label>
                                <input type="file" id="profilePhoto" name="profile_photo" accept="image/*" required
                                    class="mt-1 w-full px-4 py-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 
                                    focus:border-green-500 dark:focus:border-[#F97300] focus:ring-2 focus:ring-green-200 
                                    dark:focus:ring-[#F97300]/30 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 
                                    file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold 
                                    file:bg-green-100 dark:file:bg-[#F97300]/20 file:text-green-700 dark:file:text-[#F97300] 
                                    hover:file:bg-green-200 dark:hover:file:bg-[#F97300]/40">
                                <p id="sizeWarning" class="text-red-500 text-sm mt-2 hidden"></p>
                            </div>
                            <img id="photoPreview" src="#" alt="Preview Foto">
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit"
                        class="mt-6 bg-green-500 dark:bg-[#F97300] hover:bg-green-600 dark:hover:bg-[#F97300]/80 text-white font-semibold px-8 py-3 rounded-xl shadow-md transition-all duration-200">
                        Registrasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('toggleSidebar')?.addEventListener('click', () => {
    document.querySelector('.sidebar').classList.toggle('active');
});

const photoInput = document.getElementById('profilePhoto');
const photoPreview = document.getElementById('photoPreview');
const sizeWarning = document.getElementById('sizeWarning');
let compressedFile = null;
const apiDashboard = "{{ api_url('/api/auth/dashboard') }}";
const apiSend   = "{{ api_url('/api/guest/send') }}";

photoInput.addEventListener('change', async (e) => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
        photoPreview.src = ev.target.result;
        photoPreview.style.display = 'block';
    };
    reader.readAsDataURL(file);

    if (file.size > 200 * 1024) {
        sizeWarning.classList.remove('hidden');
        sizeWarning.innerHTML = `Ukuran foto melebihi 200KB. <button id="compressBtn" class="text-blue-500 underline">Lanjut</button> atau <button id="replaceBtn" class="text-blue-500 underline">Ganti Foto</button>`;
        document.getElementById('compressBtn').onclick = async () => {
            compressedFile = await compressImage(file);
            sizeWarning.textContent = "Foto dikompres otomatis menjadi ≤200KB.";
        };
        document.getElementById('replaceBtn').onclick = () => {
            photoInput.value = "";
            photoPreview.src = "";
            photoPreview.style.display = "none";
            sizeWarning.classList.add('hidden');
        };
    } else {
        sizeWarning.classList.add('hidden');
        compressedFile = file;
    }
});

async function compressImage(file) {
    return new Promise((resolve) => {
        const img = new Image();
        const reader = new FileReader();
        reader.onload = (e) => img.src = e.target.result;
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const ratio = Math.sqrt(200 * 1024 / file.size);
            canvas.width = img.width * ratio;
            canvas.height = img.height * ratio;
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            canvas.toBlob((blob) => {
                resolve(new File([blob], file.name, { type: 'image/jpeg' }));
            }, 'image/jpeg', 0.8);
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener("DOMContentLoaded", async () => {
    const token = localStorage.getItem("jwt_token_user");
    try {
        const res = await axios.get(apiDashboard, {
            headers: { Authorization: `Bearer ${token}` }
        });
        if (res.data.user?.name) document.getElementById("MEMBER_NAME").value = res.data.user.name;
    } catch (err) {
        console.error("Gagal ambil data user:", err.response?.data || err.message);
    }

    document.getElementById("memberForm").addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        if (compressedFile) {
            formData.set("profile_photo", compressedFile, compressedFile.name);
        }

        try {
            await axios.post(apiSend, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "Authorization": `Bearer ${token}`
                }
            });
            alert("Pendaftaran berhasil!");
            window.location.href = "/new-dashboard";
        } catch (err) {
            console.error("Error submit:", err.response?.data || err.message);
            alert("Terjadi kesalahan saat mengirim data.");
        }
    });
});
</script>

@include('include.htmlend')
