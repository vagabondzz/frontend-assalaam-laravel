@include('include.htmlstart')
@include('include.sidecs')

<div class="w-full sm:ml-64">
  <div class="mt-24 p-3 sm:p-6 flex flex-col min-h-screen w-full gap-6">

    <!-- Header -->
    <div
      class="flex flex-row justify-between items-center rounded-xl bg-gradient-to-tr from-[oklch(97% 0 0)] to-[#22AA62] text-white shadow-md -mt-6 p-6 dark:bg-gradient-to-tr dark:from-[#F97300] dark:to-[#dc6f10]">
      <span class="block text-lg sm:text-xl font-semibold text-zinc-950">Daftar Member</span>
    </div>

    <!-- Toggle Filter -->
    <div class="flex justify-center gap-3">
      <button id="btnActive"
        class="px-4 py-2 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 transition-all shadow active:ring-2 active:ring-green-400">
        Akun Aktif
      </button>
      <button id="btnInactive"
        class="px-4 py-2 rounded-lg bg-gray-300 text-gray-800 font-semibold hover:bg-red-600 hover:text-white transition-all shadow">
        Akun Non-Aktif
      </button>
    </div>

    
    <!-- 🔍 Search -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
      <div class="flex flex-wrap gap-2 w-full sm:w-auto">
        <input id="searchName" type="text" placeholder="Cari nama member..."
          class="px-4 py-2 border rounded-lg w-full sm:w-64 focus:ring-2 focus:ring-green-400 outline-none">
        <input id="searchDate" type="date"
          class="px-4 py-2 border rounded-lg w-full sm:w-48 focus:ring-2 focus:ring-green-400 outline-none">
      </div>
      <button id="btnClearSearch"
        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-all">
        Reset
      </button>
    </div>

    
    <!-- Container Table / Card -->
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-2 md:p-0">
      <table class="w-full table-auto text-xs sm:text-sm md:text-base hidden md:table">
        <thead id="tableHead"
          class="bg-green-100 dark:bg-green-800 dark:text-gray-200 transition-colors duration-300">
          <tr>
            <th class="border-b py-3 px-4 text-left">Nama</th>
            <th class="border-b py-3 px-4 text-left">No Kartu</th>
            <th class="border-b py-3 px-4 text-left">Aktif Sampai</th>
            <th class="border-b py-3 px-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="userTableDesktop" class="dark:text-gray-200"></tbody>
      </table>

      <!-- Card Mobile -->
      <div id="userTableMobile" class="flex flex-col gap-4 md:hidden"></div>

      <!-- Pagination -->
      <div id="pagination" class="flex justify-center items-center gap-2 mt-6 mb-4"></div>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div id="detailModal"
  class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-500 opacity-0">
  <div id="detailBox"
    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-[95%] sm:w-[500px] max-h-[80vh] overflow-hidden relative transform transition-all duration-500 opacity-0 rotate-12 scale-75 flex flex-col">
    
    <!-- Header -->
    <h2 class="text-lg font-bold p-6 border-b">Detail Member</h2>
    
    <!-- Konten Scrollable -->
    <div id="detailContent" class="flex-1 overflow-y-auto p-6 grid grid-cols-1 gap-4 text-sm"></div>

    <!-- Footer tetap -->
    <div id="detailFooter" class="flex justify-end gap-3 p-4 border-t bg-white dark:bg-gray-800">
      <!-- tombol akan diisi dari JS -->
    </div>
  </div>
</div>


<!-- Toast -->
<div id="toast"
  class="fixed bottom-5 right-5 px-4 py-2 rounded-lg shadow-md hidden z-50 text-white text-sm"></div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const API_MEMBERS = "{{ api_url('/api/admin/card-members') }}";
  const API_EDIT = "{{ api_url('/api/member/profile-update') }}";
  const token = localStorage.getItem("jwt_token_cs");

  const api = axios.create({
    headers: {
      "Authorization": `Bearer ${token}`,
      "Accept": "application/json"
    }
  });

  let members = [];
  let showActive = true;
  let currentPage = 1;
  const perPage = 5;
  let searchName = "";
  let searchDate = "";

  // === TOAST ===
  function showToast(message, type = "success") {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.className = `
      fixed bottom-5 right-5 px-4 py-2 rounded-lg shadow-md z-50 text-white text-sm
      ${type === "success" ? "bg-green-600" : "bg-red-600"}
    `;
    toast.classList.remove("hidden");
    setTimeout(() => toast.classList.add("hidden"), 3000);
  }

  function formatDate(dateStr) {
    if (!dateStr) return "-";
    const d = new Date(dateStr);
    return isNaN(d)
      ? "-"
      : d.toLocaleDateString("id-ID", { day: "2-digit", month: "2-digit", year: "numeric" });
  }

  // === FETCH DATA ===
  async function fetchMembers() {
    try {
      const res = await api.get(API_MEMBERS);
      const data = res.data.data ?? [];

      // Filter: hanya users yang punya nomor member
      members = data
        .filter(m => m.MEMBER_CARD_NO && m.MEMBER_CARD_NO.trim() !== "")
        .map(m => ({
          ...m,
          MEMBER_IS_ACTIVE: m.MEMBER_IS_ACTIVE ?? 0
        }));

      currentPage = 1;
      renderTable();
    } catch (err) {
      console.error("Gagal ambil data:", err);
      showToast("Token invalid / data gagal dimuat", "error");
    }
  }

  // === RENDER TABLE + FILTER ===
function renderTable() {
  const tbodyDesktop = document.getElementById("userTableDesktop");
  const tbodyMobile = document.getElementById("userTableMobile");
  const head = document.getElementById("tableHead");
  tbodyDesktop.innerHTML = "";
  tbodyMobile.innerHTML = "";

  head.className = showActive
    ? "bg-green-100 dark:bg-green-800 dark:text-gray-200"
    : "bg-red-100 dark:bg-red-800 dark:text-gray-200";

  const keyword = searchName.toLowerCase();
  const filtered = members.filter(m => {
    const isActive = Number(m.MEMBER_IS_ACTIVE) === 1;
    const matchActive = showActive ? isActive : !isActive;

    // 🔍 Pencarian gabungan: No Member, Nama, Alamat
    const matchKeyword =
      (m.MEMBER_CARD_NO ?? "").toLowerCase().includes(keyword) ||
      (m.MEMBER_NAME ?? "").toLowerCase().includes(keyword) ||
      (m.MEMBER_ADDRESS ?? "").toLowerCase().includes(keyword);

    const matchDate =
      !searchDate || (m.MEMBER_DATE_OF_BIRTH && m.MEMBER_DATE_OF_BIRTH.startsWith(searchDate));

    return matchActive && matchKeyword && matchDate;
  });

  const totalPages = Math.ceil(filtered.length / perPage);
  const start = (currentPage - 1) * perPage;
  const paginated = filtered.slice(start, start + perPage);

  if (paginated.length === 0) {
    const msg = `Tidak ada data ${showActive ? "aktif" : "non-aktif"}.`;
    tbodyDesktop.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-gray-500">${msg}</td></tr>`;
    tbodyMobile.innerHTML = `<div class="text-center py-4 text-gray-500">${msg}</div>`;
    document.getElementById("pagination").innerHTML = "";
    return;
  }

  paginated.forEach(m => {
    const btnText = m.MEMBER_IS_ACTIVE == 1 ? "Nonaktifkan" : "Aktifkan";
    const btnColor = m.MEMBER_IS_ACTIVE == 1 ? "bg-red-600 hover:bg-red-700" : "bg-green-600 hover:bg-green-700";

      // Desktop
      tbodyDesktop.insertAdjacentHTML("beforeend", `
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
          <td class="py-2 px-4">${m.MEMBER_NAME ?? "-"}</td>
          <td class="py-2 px-4">${m.MEMBER_CARD_NO ?? "-"}</td>
          <td class="py-2 px-4">${formatDate(m.MEMBER_ACTIVE_TO)}</td>
          <td class="py-2 px-4 text-center">
            <div class="flex flex-wrap justify-center gap-2">
              <button onclick="showDetail('${m.MEMBER_ID}')"
                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs sm:text-sm">
                Detail
              </button>
              <button onclick="toggleActive('${m.MEMBER_ID}', ${m.MEMBER_IS_ACTIVE})"
                class="px-3 py-1 ${btnColor} text-white rounded text-xs sm:text-sm">
                ${btnText}
              </button>
            </div>
          </td>
        </tr>
      `);

      // Mobile
      tbodyMobile.insertAdjacentHTML("beforeend", `
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow flex flex-col gap-2">
          <div><span class="font-medium">Nama: </span>${m.MEMBER_NAME}</div>
          <div><span class="font-medium">No Kartu: </span>${m.MEMBER_CARD_NO}</div>
          <div><span class="font-medium">Aktif Sampai: </span>${formatDate(m.MEMBER_ACTIVE_TO)}</div>
          <div class="flex flex-wrap gap-2 mt-2">
            <button onclick="showDetail('${m.MEMBER_ID}')"
              class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs sm:text-sm">
              Detail
            </button>
            <button onclick="toggleActive('${m.MEMBER_ID}', ${m.MEMBER_IS_ACTIVE})"
              class="px-3 py-1 ${btnColor} text-white rounded text-xs sm:text-sm">
              ${btnText}
            </button>
          </div>
        </div>
      `);
    });

    renderPagination(totalPages);
  }

  // === PAGINATION ===
  function renderPagination(totalPages) {
    const container = document.getElementById("pagination");
    container.innerHTML = "";
    if (totalPages <= 1) return;

    const prevDisabled = currentPage === 1 ? "opacity-50 cursor-not-allowed" : "";
    const nextDisabled = currentPage === totalPages ? "opacity-50 cursor-not-allowed" : "";

    container.innerHTML += `
      <button class="px-3 py-1 rounded border ${prevDisabled}"
        onclick="if(currentPage > 1){ currentPage--; renderTable(); }">←</button>
    `;

    for (let i = 1; i <= totalPages; i++) {
      container.innerHTML += `
        <button class="px-3 py-1 rounded ${i === currentPage ? 'bg-green-600 text-white' : 'bg-gray-200 hover:bg-gray-300'}"
          onclick="currentPage = ${i}; renderTable();">${i}</button>
      `;
    }

    container.innerHTML += `
      <button class="px-3 py-1 rounded border ${nextDisabled}"
        onclick="if(currentPage < ${totalPages}){ currentPage++; renderTable(); }">→</button>
    `;
  }

  // === DETAIL MEMBER ===
async function showDetail(id) {
  try {
    const res = await api.get(`${API_MEMBERS}/${id}`);
    const m = res.data.data ?? res.data;

    const detail = {
      USER_EMAIL: m.USER_EMAIL ?? "",
      MEMBER_NAME: m.MEMBER_NAME ?? "",
      MEMBER_CARD_NO: m.MEMBER_CARD_NO ?? "",
      MEMBER_PLACE_OF_BIRTH: m.MEMBER_PLACE_OF_BIRTH ?? "",
      MEMBER_DATE_OF_BIRTH: m.MEMBER_DATE_OF_BIRTH ?? "",
      MEMBER_ADDRESS: m.MEMBER_ADDRESS ?? "",
      MEMBER_RT: m.MEMBER_RT ?? "",
      MEMBER_RW: m.MEMBER_RW ?? "",
      MEMBER_KECAMATAN: m.MEMBER_KECAMATAN ?? "",
      MEMBER_KOTA: m.MEMBER_KOTA ?? "",
      MEMBER_POST_CODE: m.MEMBER_POST_CODE ?? "",
      MEMBER_TELP: m.MEMBER_TELP ?? "",
      MEMBER_NPWP: m.MEMBER_NPWP ?? ""
    };

    // Konten form
    let html = `
      <form id="editForm" class="grid grid-cols-1 gap-4 pb-6" enctype="multipart/form-data">
    `;

   for (const [key, value] of Object.entries(detail)) {
  // Label lebih manusiawi (capitalized)
  const label = key
    .replace("MEMBER_", "")
    .replace(/^USER_/, "")
    .replaceAll("_", " ")
    .toLowerCase()
    .replace(/\b\w/g, c => c.toUpperCase()); // kapital di awal setiap kata

  const readonly = key === "USER_EMAIL" || key === "MEMBER_CARD_NO" ? "readonly" : "";

  // Escape karakter berbahaya biar gak rusak HTML (contoh: tanda kutip di data)
  const safeValue = (value ?? "").toString().replace(/"/g, "&quot;").replace(/</g, "&lt;").replace(/>/g, "&gt;");

  html += `
    <div class="flex flex-col">
      <label class="font-medium text-gray-700 dark:text-gray-300 mb-1">${label}</label>
      <input name="${key}" value="${safeValue}" ${readonly}
        class="border rounded-md px-2 py-1 focus:ring-2 focus:ring-green-400 outline-none
        text-gray-900 dark:text-gray-100 dark:bg-gray-700
        ${readonly ? 'bg-gray-100 dark:bg-gray-600 cursor-not-allowed' : ''}"/>
    </div>
  `;
}

html += `</form>`;
document.getElementById("detailContent").innerHTML = html;

// Footer tombol (selalu terlihat)
document.getElementById("detailFooter").innerHTML = `
  <div class="flex justify-end gap-3 p-4 border-t bg-white dark:bg-gray-800">
    <button type="button" onclick="closeModal()" 
      class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Tutup</button>
    <button type="submit" form="editForm"
      class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
  </div>
`;

// Reset scroll isi modal ke atas (agar selalu mulai dari atas)
const contentEl = document.getElementById("detailContent");
contentEl.scrollTop = 0;
requestAnimationFrame(() => { contentEl.scrollTop = 0; });


// Buka modal
openModal();


    const formEl = document.getElementById("editForm");
    formEl.addEventListener("submit", async (e) => {
      e.preventDefault();
      const fd = new FormData(formEl);
      fd.append("MEMBER_ID", m.MEMBER_ID);
      fd.append("_method", "PUT");

      try {
        const res = await axios.post(API_EDIT, fd, {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
            "Content-Type": "multipart/form-data",
          },
        });

        const idx = members.findIndex((x) => x.MEMBER_ID === m.MEMBER_ID);
        if (idx !== -1) members[idx] = res.data.data ?? members[idx];

        showToast(res.data.message || "Profil berhasil diperbarui!", "success");
        closeModal();
        renderTable();
      } catch (err) {
        const msg = err.response?.data?.message || "Gagal memperbarui profil!";
        showToast(msg, "error");
      }
    });

  } catch (err) {
    showToast("Gagal ambil detail member", "error");
    console.error(err);
  }
}





  // === AKTIF/NONAKTIFKAN MEMBER ===
  async function toggleActive(id, status) {
    try {
      await api.post(`${API_MEMBERS}/${id}/activation`, { 
            headers: {
              Authorization: `Bearer ${token}`,
              Accept: "application/json",
              "Content-Type": "multipart/form-data",
            },MEMBER_IS_ACTIVE: status == 1 ? 0 : 1
      });
      showToast("Status berhasil diperbarui!");
      await fetchMembers();
    } catch {
      showToast("Gagal update status", "error");
    }
  }

  // === MODAL ===
  function openModal() {
    const modal = document.getElementById("detailModal");
    const box = document.getElementById("detailBox");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    setTimeout(() => {
      modal.classList.remove("opacity-0");
      box.classList.remove("opacity-0", "rotate-12", "scale-75");
      box.classList.add("rotate-0", "scale-100");
    }, 10);
  }

  function closeModal() {
    const modal = document.getElementById("detailModal");
    const box = document.getElementById("detailBox");
    modal.classList.add("opacity-0");
    box.classList.add("opacity-0", "rotate-12", "scale-75");
    box.classList.remove("rotate-0", "scale-100");
    setTimeout(() => {
      modal.classList.add("hidden");
      modal.classList.remove("flex");
    }, 500);
  }

  document.addEventListener("keydown", e => { if (e.key === "Escape") closeModal(); });

  // === SEARCH & FILTER ===
document.getElementById("searchName").addEventListener("input", e => {
  searchName = e.target.value;
  currentPage = 1;
  renderTable();
});

document.getElementById("searchDate").addEventListener("change", e => {
  searchDate = e.target.value;
  currentPage = 1;
  renderTable();
});

document.getElementById("btnClearSearch").addEventListener("click", () => {
  searchName = "";
  searchDate = "";
  document.getElementById("searchName").value = "";
  document.getElementById("searchDate").value = "";
  renderTable();
});


  // === TOGGLE TAMPILAN AKTIF/NONAKTIF ===
  document.getElementById("btnActive").addEventListener("click", () => {
    showActive = true;
    currentPage = 1;
    document.getElementById("btnActive").classList.replace("bg-gray-300", "bg-green-600");
    document.getElementById("btnActive").classList.replace("text-gray-800", "text-white");
    document.getElementById("btnInactive").classList.replace("bg-red-600", "bg-gray-300");
    document.getElementById("btnInactive").classList.replace("text-white", "text-gray-800");
    renderTable();
  });

  document.getElementById("btnInactive").addEventListener("click", () => {
    showActive = false;
    currentPage = 1;
    document.getElementById("btnInactive").classList.replace("bg-gray-300", "bg-red-600");
    document.getElementById("btnInactive").classList.replace("text-gray-800", "text-white");
    document.getElementById("btnActive").classList.replace("bg-green-600", "bg-gray-300");
    document.getElementById("btnActive").classList.replace("text-white", "text-gray-800");
    renderTable();
  });

  // === INIT ===
  document.addEventListener("DOMContentLoaded", fetchMembers);
</script>


@include('include.htmlend')
