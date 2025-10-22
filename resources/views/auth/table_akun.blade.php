@include('include.htmlstart')
@include('include.sidecs')

<div class="w-full sm:ml-64">
  <div class="mt-24 p-3 sm:p-6 flex flex-col min-h-screen w-full gap-6">

    <!-- Header -->
    <div
      class="flex flex-row justify-between items-center rounded-xl bg-gradient-to-tr from-[oklch(97% 0 0)] to-[#22AA62] text-white shadow-md -mt-6 p-6 dark:bg-gradient-to-tr dark:from-[#F97300] dark:to-[#dc6f10]">
      <span class="block text-lg sm:text-xl font-semibold text-zinc-950">Daftar Akun Member</span>
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
    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-[95%] sm:w-[500px] max-h-[80vh] overflow-y-auto relative transform transition-all duration-500 opacity-0 rotate-12 scale-75">
    <h2 class="text-lg font-bold mb-4 border-b pb-2">Detail Member</h2>
    <div id="detailContent" class="grid grid-cols-1 gap-4 text-sm"></div>
    <div class="mt-4 flex justify-end">
      <button onclick="closeModal()"
        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Tutup</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div id="toast"
  class="fixed bottom-5 right-5 px-4 py-2 rounded-lg shadow-md hidden z-50 text-white text-sm"></div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const API_MEMBERS = "{{ api_url('/api/admin/card-members') }}";
  const token = localStorage.getItem("jwt_token_cs");
  const api = axios.create({
    headers: { "Authorization": `Bearer ${token}`, "Accept": "application/json" }
  });

  let members = [];
  let showActive = true;
  let currentPage = 1;
  const perPage = 10;
  let searchName = "";
  let searchDate = "";

  // === TOAST ===
  function showToast(message, type = "success") {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.className = `fixed bottom-5 right-5 px-4 py-2 rounded-lg shadow-md z-50 text-white text-sm ${type === "success" ? "bg-green-600" : "bg-red-600"}`;
    toast.classList.remove("hidden");
    setTimeout(() => toast.classList.add("hidden"), 3000);
  }

  function formatDate(dateStr) {
    if (!dateStr) return "-";
    const d = new Date(dateStr);
    if (isNaN(d)) return "-";
    return d.toLocaleDateString("id-ID", { day: "2-digit", month: "2-digit", year: "numeric" });
  }

  async function fetchMembers() {
    try {
      const res = await api.get(API_MEMBERS);
      members = res.data.data ?? [];
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

    // 🔍 Filter data
    const filtered = members.filter(m => {
      const isActiveMatch = m.MEMBER_IS_ACTIVE == (showActive ? 1 : 0);
      const nameMatch = m.MEMBER_NAME?.toLowerCase().includes(searchName.toLowerCase());
      const dateMatch = !searchDate || (m.MEMBER_DATE_OF_BIRTH && m.MEMBER_DATE_OF_BIRTH.startsWith(searchDate));
      return isActiveMatch && nameMatch && dateMatch;
    });

    const totalPages = Math.ceil(filtered.length / perPage);
    const start = (currentPage - 1) * perPage;
    const paginated = filtered.slice(start, start + perPage);

    if (paginated.length === 0) {
      tbodyDesktop.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">Tidak ada data ${showActive ? "aktif" : "non-aktif"}.</td></tr>`;
      tbodyMobile.innerHTML = `<div class="text-center py-4 text-gray-500 dark:text-gray-400">Tidak ada data ${showActive ? "aktif" : "non-aktif"}.</div>`;
      document.getElementById("pagination").innerHTML = "";
      return;
    }

    paginated.forEach(m => {
      tbodyDesktop.insertAdjacentHTML("beforeend", `
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
          <td class="py-2 px-4">${m.MEMBER_NAME}</td>
          <td class="py-2 px-4">${m.MEMBER_CARD_NO}</td>
          <td class="py-2 px-4">${formatDate(m.MEMBER_ACTIVE_TO)}</td>
          <td class="py-2 px-4 text-center">
            <div class="flex flex-wrap justify-center gap-2">
              <button onclick="showDetail('${m.MEMBER_ID}')"
                class="flex items-center gap-1 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs sm:text-sm">
                Detail
              </button>
              <button onclick="toggleActive('${m.MEMBER_ID}', ${m.MEMBER_IS_ACTIVE})"
                class="flex items-center gap-1 px-3 py-1 ${m.MEMBER_IS_ACTIVE == 1 ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'} text-white rounded text-xs sm:text-sm">
                ${m.MEMBER_IS_ACTIVE == 1 ? 'Nonaktifkan' : 'Aktifkan'}
              </button>
            </div>
          </td>
        </tr>
      `);

      tbodyMobile.insertAdjacentHTML("beforeend", `
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow flex flex-col gap-2">
          <div><span class="font-medium">Nama: </span>${m.MEMBER_NAME}</div>
          <div><span class="font-medium">No Kartu: </span>${m.MEMBER_CARD_NO}</div>
          <div><span class="font-medium">Aktif Sampai: </span>${formatDate(m.MEMBER_ACTIVE_TO)}</div>
          <div class="flex flex-wrap gap-2 mt-2">
            <button onclick="showDetail('${m.MEMBER_ID}')"
              class="flex items-center gap-1 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs sm:text-sm">
              Detail
            </button>
            <button onclick="toggleActive('${m.MEMBER_ID}', ${m.MEMBER_IS_ACTIVE})"
              class="flex items-center gap-1 px-3 py-1 ${m.MEMBER_IS_ACTIVE == 1 ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'} text-white rounded text-xs sm:text-sm">
              ${m.MEMBER_IS_ACTIVE == 1 ? 'Nonaktifkan' : 'Aktifkan'}
            </button>
          </div>
        </div>
      `);
    });

    renderPagination(totalPages);
  }

  function renderPagination(totalPages) {
    const container = document.getElementById("pagination");
    container.innerHTML = "";

    if (totalPages <= 1) return;

    const prevDisabled = currentPage === 1 ? "opacity-50 cursor-not-allowed" : "";
    const nextDisabled = currentPage === totalPages ? "opacity-50 cursor-not-allowed" : "";

    container.innerHTML += `
      <button class="px-3 py-1 rounded border ${prevDisabled}" 
        onclick="if(${currentPage} > 1){ currentPage--; renderTable(); }">←</button>
    `;

    for (let i = 1; i <= totalPages; i++) {
      container.innerHTML += `
        <button class="px-3 py-1 rounded ${i === currentPage ? 'bg-green-600 text-white' : 'bg-gray-200 hover:bg-gray-300'}"
          onclick="currentPage = ${i}; renderTable();">${i}</button>
      `;
    }

    container.innerHTML += `
      <button class="px-3 py-1 rounded border ${nextDisabled}" 
        onclick="if(${currentPage} < ${totalPages}){ currentPage++; renderTable(); }">→</button>
    `;
  }

  // === DETAIL ===
  async function showDetail(id) {
    try {
      const res = await api.get(`${API_MEMBERS}/${id}`);
      const m = res.data.data ?? res.data;
      const detail = {
        "Nama Lengkap": m.MEMBER_NAME,
        "Nomor Kartu": m.MEMBER_CARD_NO,
        "Tempat Lahir": m.MEMBER_PLACE_OF_BIRTH ?? "-",
        "Tanggal Lahir": formatDate(m.MEMBER_DATE_OF_BIRTH),
        "Alamat": m.MEMBER_ADDRESS ?? "-",
        "RT/RW": `${m.MEMBER_RT || "-"} / ${m.MEMBER_RW || "-"}`,
        "Kecamatan": m.MEMBER_KECAMATAN ?? "-",
        "Kota": m.MEMBER_KOTA ?? "-",
        "Kode Pos": m.MEMBER_POST_CODE ?? "-",
        "No. Telepon": m.MEMBER_TELP ?? "-",
        "NPWP": m.MEMBER_NPWP ?? "-"
      };

      let html = `<div class="grid grid-cols-1 gap-4 pb-6">`;
      Object.entries(detail).forEach(([label, value], index, arr) => {
        let borderClass = (index === arr.length - 1) ? '' : 'border-b';
        html += `
          <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start ${borderClass} pb-2">
            <span class="font-medium text-gray-700 dark:text-gray-300">${label}</span>
            <span class="text-gray-900 dark:text-gray-100 mt-1 sm:mt-0 break-words break-all">${value}</span>
          </div>`;
      });
      html += `</div>`;

      document.getElementById("detailContent").innerHTML = html;
      openModal();
    } catch (err) {
      showToast("Gagal ambil detail member", "error");
    }
  }

  async function toggleActive(id, status) {
    try {
      await api.post(`${API_MEMBERS}/${id}/activation`, {
        MEMBER_IS_ACTIVE: status == 1 ? 0 : 1
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

  document.getElementById("detailModal").addEventListener("click", e => {
    if (e.target === e.currentTarget) closeModal();
  });
  document.addEventListener("keydown", e => { if (e.key === "Escape") closeModal(); });

  // === SEARCH EVENT ===
  document.getElementById("searchName").addEventListener("input", (e) => {
    searchName = e.target.value;
    currentPage = 1;
    renderTable();
  });

  document.getElementById("searchDate").addEventListener("change", (e) => {
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

  // === TOGGLE AKTIF/NON AKTIF ===
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

  document.addEventListener("DOMContentLoaded", fetchMembers);
</script>

@include('include.htmlend')
