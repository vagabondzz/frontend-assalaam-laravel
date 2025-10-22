@include('include.htmlstart')
@include('include.sidecs')

<div class="w-full sm:ml-64">
  <div class="mt-24 p-3 sm:p-6 flex flex-col min-h-screen w-full gap-6">
    
    <!-- Header -->
    <div
      class="flex flex-row justify-between items-center rounded-xl bg-gradient-to-tr from-[oklch(97% 0 0)] to-[#22AA62] text-white shadow-md -mt-6 p-6 dark:bg-gradient-to-tr dark:from-[#F97300] dark:to-[#dc6f10]">
      <span class="block text-lg sm:text-xl font-semibold text-zinc-950">Daftar Akun</span>
    </div>

    <!-- Container Table / Card -->
<div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-2 md:p-0">
  <!-- Desktop Table -->
  <table class="w-full table-auto text-xs sm:text-sm md:text-base hidden md:table">
    <thead class="bg-gray-100 dark:bg-gray-700 dark:text-gray-200">
      <tr>
        <th class="border-b py-3 px-4 text-left">Nomor Card</th>
        <th class="border-b py-3 px-4 text-left">Nama</th>
        <th class="border-b py-3 px-4 text-left">Status Validasi</th>
        <th class="border-b py-3 px-4 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody id="calonTableDesktop" class="dark:text-gray-200"></tbody>
  </table>

  <!-- Mobile Card -->
  <div id="calonTableMobile" class="flex flex-col gap-4 md:hidden"></div>
</div>



<!-- Modal Detail -->
<div id="detailModal"
  class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300 opacity-0">
  <div id="detailBox"
    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-[95%] sm:w-[500px] max-h-[80vh] overflow-y-auto relative transform transition-all duration-500 opacity-0 scale-75">
    <h2 class="text-lg font-bold mb-4">Detail Member</h2>
    <div id="detailContent" class="space-y-2 text-sm"></div>
    <div class="mt-4 flex justify-end">
      <button type="button" onclick="closeModal()"
        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Tutup</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div id="toast"
  class="fixed bottom-5 right-5 px-4 py-2 rounded-lg shadow-md hidden z-50 text-white text-sm">
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const API_URL = "{{ api_url('/api/admin/card-guest') }}";
  const getToken = () => localStorage.getItem("jwt_token_cs");
  let guests = [];
  let detailMember = null;
  let theme = localStorage.getItem("theme") || "light";

  // 🔹 Toast
  function showToast(message, type = "success") {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.className =
      `fixed bottom-5 right-5 px-4 py-2 rounded-lg shadow-md z-50 text-white text-sm ${type === "success" ? "bg-green-600" : "bg-red-600"}`;
    toast.classList.remove("hidden");
    setTimeout(() => toast.classList.add("hidden"), 3000);
  }

  // 🔹 Date format
  function formatDate(date) {
    if (!date) return "-";
    return new Date(date).toLocaleDateString("id-ID", {
      day: "2-digit", month: "short", year: "numeric"
    });
  }

  function getValidText(val) {
    return Number(val) === 1 ? "Valid" : "Belum Valid";
  }

  // 🔹 Fetch calon member
  async function fetchGuests() {
    try {
      const token = getToken();
      if (!token) return window.location.href = "/login";

      const res = await axios.get(API_URL, {
        headers: { Authorization: `Bearer ${token}` }
      });

      guests = (res.data.data ?? res.data).map((g) => ({
        MEMBER_ID: g.MEMBER_ID,
        MEMBER_NAME: g.MEMBER_NAME,
        MEMBER_CARD_NO: g.MEMBER_CARD_NO || "",
        MEMBER_IS_VALID: g.MEMBER_IS_VALID,
        MEMBER_TYPE: g.MEMBER_TYPE || "",
        selectedType: g.MEMBER_TYPE || "PAS", // default kalau belum ada
        MEMBER_PLACE_OF_BIRTH: g.MEMBER_PLACE_OF_BIRTH || "-",
        MEMBER_DATE_OF_BIRTH: g.MEMBER_DATE_OF_BIRTH || null,
        MEMBER_KTP_NO: g.MEMBER_KTP_NO || "-",
        MEMBER_ADDRESS: g.MEMBER_ADDRESS || "-",
        MEMBER_KELURAHAN: g.MEMBER_KELURAHAN || "-",
        MEMBER_KECAMATAN: g.MEMBER_KECAMATAN || "-", 
        MEMBER_KOTA: g.MEMBER_KOTA || "-", 
        MEMBER_RT: g.MEMBER_RT || "-", 
        MEMBER_RW: g.MEMBER_RW || "-", 
        MEMBER_POST_CODE: g.MEMBER_POST_CODE || "-", 
        MEMBER_JML_TANGGUNGAN: g.MEMBER_JML_TANGGUNGAN || "-", 
        MEMBER_PENDAPATAN: g.MEMBER_PENDAPATAN || "-", 
        MEMBER_TELP: g.MEMBER_TELP || "-", 
        MEMBER_NPWP: g.MEMBER_NPWP || "-",
      }));

      renderGuests();
    } catch (err) {
      console.error("Gagal ambil data:", err);
      document.getElementById("calonTable").innerHTML =
        `<tr><td colspan="4" class="text-center py-4 text-red-500">Gagal ambil data</td></tr>`;
    }
  }

  // 🔹 Render table
 function renderGuests() {
  const tbodyDesktop = document.getElementById("calonTableDesktop");
  const tbodyMobile = document.getElementById("calonTableMobile");
  tbodyDesktop.innerHTML = "";
  tbodyMobile.innerHTML = "";

  if (guests.length === 0) {
    tbodyDesktop.innerHTML = `<tr><td colspan="4" class="text-center py-4">Tidak ada data</td></tr>`;
    tbodyMobile.innerHTML = `<div class="text-center py-4">Tidak ada data</div>`;
    return;
  }

  guests.forEach((g, i) => {
    // Desktop
    tbodyDesktop.insertAdjacentHTML("beforeend", `
      <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
        <td class="py-2 px-4">${g.MEMBER_CARD_NO || '-'}</td>
        <td class="py-2 px-4">${g.MEMBER_NAME || '-'}</td>
        <td class="py-2 px-4">${getValidText(g.MEMBER_IS_VALID)}</td>
        <td class="py-2 px-4 text-center">
          <div class="flex flex-col sm:flex-row justify-center gap-2">
            ${(g.MEMBER_IS_VALID == 0 || g.MEMBER_IS_VALID == null) ? `
              <button type="button" onclick="validateMember(${i})"
                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-xs sm:text-sm">
                Validasi (PAS)
              </button>
            ` : `<span class="text-xs px-2 py-1 rounded bg-green-600 text-white">${g.MEMBER_TYPE || '-'}</span>`}

            <button type="button" onclick="showDetail(${i})"
              class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs sm:text-sm">Detail</button>
          </div>
        </td>
      </tr>
    `);

    // Mobile
    tbodyMobile.insertAdjacentHTML("beforeend", `
      <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow flex flex-col gap-2">
        <div><span class="font-medium">Nomor Card: </span>${g.MEMBER_CARD_NO || '-'}</div>
        <div><span class="font-medium">Nama: </span>${g.MEMBER_NAME || '-'}</div>
        <div><span class="font-medium">Status: </span>${getValidText(g.MEMBER_IS_VALID)}</div>
        <div class="flex flex-wrap gap-2 mt-2">
          ${(g.MEMBER_IS_VALID == 0 || g.MEMBER_IS_VALID == null) ? `
            <button type="button" onclick="validateMember(${i})"
              class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-xs sm:text-sm">
              Validasi (PAS)
            </button>
          ` : `<span class="text-xs px-2 py-1 rounded bg-green-600 text-white">${g.MEMBER_TYPE || '-'}</span>`}

          <button type="button" onclick="showDetail(${i})"
            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs sm:text-sm">Detail</button>
        </div>
      </div>
    `);
  });
}


  // 🔹 Validasi member
  // 🔹 Validasi member
async function validateMember(index) {
  const g = guests[index];

  // langsung set default PAS
  const selectedType = "PAS";

  try {
    const token = getToken();
    if (!token) return window.location.href = "/login";

    const res = await axios.post(`${API_URL}/${g.MEMBER_ID}/activate`,
      { member_type: selectedType },
      { headers: { Authorization: `Bearer ${token}` } }
    );

    g.MEMBER_IS_VALID = 1;
    g.MEMBER_TYPE = selectedType;
    g.MEMBER_CARD_NO = res.data?.member_card_no || g.MEMBER_CARD_NO;

    showToast(res.data?.message || "✅ Member berhasil divalidasi sebagai PAS!", "success");
    renderGuests();
  } catch (err) {
    console.error("Error validasi:", err);
    showToast(err.response?.data?.message || "❌ Gagal validasi member", "error");
  }
}


  // 🔹 Detail Modal
  function showDetail(index) {
    detailMember = guests[index];
    const g = detailMember;

    const detail = {
      "Nama": g.MEMBER_NAME,
      "Nomor Kartu": g.MEMBER_CARD_NO,
      "Status": getValidText(g.MEMBER_IS_VALID),
      "Tempat Lahir": g.MEMBER_PLACE_OF_BIRTH,
      "Tanggal Lahir": formatDate(g.MEMBER_DATE_OF_BIRTH),
      "Alamat": g.MEMBER_ADDRESS,
      "RT/RW": `${g.MEMBER_RT} / ${g.MEMBER_RW}`,
      "Kelurahan": g.MEMBER_KELURAHAN,
      "Kecamatan": g.MEMBER_KECAMATAN,
      "Kota": g.MEMBER_KOTA,
      "Kode Pos": g.MEMBER_POST_CODE,
      "No. Telepon": g.MEMBER_TELP,
      "NPWP": g.MEMBER_NPWP,
      "Jumlah Tanggungan": g.MEMBER_JML_TANGGUNGAN,
      "Pendapatan": g.MEMBER_PENDAPATAN,
    };

    let html = `<div class="space-y-4 px-2">`;
    for (const [label, value] of Object.entries(detail)) {
      html += `
        <div class="border-b pb-2">
          <span class="font-medium text-gray-700 dark:text-gray-300 block">${label}</span>
          <span class="text-gray-900 dark:text-gray-100 block break-words">${value}</span>
        </div>`;
    }
    html += `</div>`;

    document.getElementById("detailContent").innerHTML = html;
    openModal();
  }

 function openModal() {
  const modal = document.getElementById("detailModal");
  const box = document.getElementById("detailBox");

  // Tampilkan modal
  modal.classList.remove("hidden");
  modal.classList.add("flex");

  // Pastikan klik di dalam box tidak menutup modal
  box.addEventListener("click", (e) => e.stopPropagation());

  // Animasi muncul
  setTimeout(() => {
    modal.classList.remove("opacity-0");
    box.classList.remove("opacity-0", "scale-75");
    box.classList.add("scale-100");
  }, 10);

  // Tutup modal jika klik di luar box
  modal.addEventListener("click", function handleOutsideClick(e) {
    if (!box.contains(e.target)) {
      closeModal();
      modal.removeEventListener("click", handleOutsideClick);
    }
  });
}


  function closeModal() {
    const modal = document.getElementById("detailModal");
    const box = document.getElementById("detailBox");
    modal.classList.add("opacity-0");
    box.classList.add("opacity-0", "scale-75");
    setTimeout(() => {
      modal.classList.add("hidden");
      modal.classList.remove("flex");
    }, 300);
  }

  // 🔹 Theme
  function toggleTheme() {
    theme = theme === "light" ? "dark" : "light";
    localStorage.setItem("theme", theme);
    updateThemeClass();
  }

  function updateThemeClass() {
    const el = document.querySelector(".admin-container");
    if (!el) return;
    el.classList.toggle("dark", theme === "dark");
    el.classList.toggle("light", theme === "light");
  }

  // 🔹 Logout
  function logout() {
    localStorage.removeItem("token");
    window.location.href = "/login";
  }

  // 🔹 Axios interceptor
  axios.interceptors.response.use(
    response => response,
    error => {
      if (error.response && error.response.status === 401) {
        logout();
      }
      return Promise.reject(error);
    }
  );

  document.addEventListener("DOMContentLoaded", () => {
    fetchGuests();
    updateThemeClass();
    
  });
</script>

@include('include.htmlend')
