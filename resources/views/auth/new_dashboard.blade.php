@include('include.htmlstart')
@include('include.sidemember')
@include('include.sayhi')
<!-- ======= BELUM VERIFIKASI EMAIL ======= -->

  
<!-- ======= BELUM MEMBER ======= -->
<div id="noMemberNotice" 
     class="hidden w-full sm:ml-64 min-h-screen flex items-center justify-center 
            bg-gray-50 dark:bg-gray-950 px-4 transition-colors">
  <div class="max-w-md w-full bg-green-50 border border-green-300 text-green-800 
              dark:bg-green-900 dark:text-green-100 dark:border-green-700 
              p-6 rounded-2xl shadow-lg text-center">
    <div class="flex justify-center mb-4">
      <ion-icon name="alert-circle-outline" class="text-4xl text-green-500"></ion-icon>
    </div>
    <h2 class="text-xl font-bold mb-2">Kamu Belum Menjadi Member ☕</h2>
    <p class="text-sm mb-5">
      Silakan isi formulir pendaftaran member untuk mendapatkan berbagai keuntungan spesial!
    </p>
    <a href="/form-member"
       class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm font-medium 
              px-5 py-2 rounded-lg transition-all shadow">
      Isi Formulir Member
    </a>
  </div>
</div>

<!-- ======= PENDING MEMBER ======= -->
<div id="pendingMemberNotice" 
     class="hidden w-full sm:ml-64 min-h-screen flex items-center justify-center 
            bg-gray-50 dark:bg-gray-950 px-4 transition-colors">
  <div class="max-w-md w-full bg-green-50 border border-green-300 text-green-800 
              dark:bg-green-900 dark:text-green-100 dark:border-green-700 
              p-6 rounded-2xl shadow-lg text-center">
    <div class="flex justify-center mb-4">
  <ion-icon name="time-outline" class="text-4xl text-green-500 spin-clock"></ion-icon>
</div>

    <h2 class="text-xl font-bold mb-2">Member Kamu Masih Menunggu Validasi Nih!</h2>
    <p class="text-sm mb-5">Mohon menunggu atau bisa hubungi pihak CS ya ☕</p>

    <div class="bg-white dark:bg-900 text-left p-4 rounded-lg border border-gray-200 
                dark:border-gray-700 shadow-inner">
      <h3 class="font-semibold mb-2 text-gray-700 dark:text-gray-100">Informasi Member</h3>
      <p class="text-sm"><strong>Status:</strong> <span id="pendingStatus" class="text-yellow-600 font-bold "></span></p>
      <p class="text-sm"><strong>Nama:</strong> <span id="pendingName"></span></p>
      <p class="text-sm"><strong>Email:</strong> <span id="pendingEmail"></span></p>
    </div>
  </div>
</div>
<style>
/* Animasi jam berputar */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.spin-clock {
  animation: spin 2s linear infinite;
  transform-origin: center;
}
</style>



<!-- ======= MEMBER DASHBOARD ======= -->
<div id="dashboardContent"  class="hidden w-full sm:ml-64 overflow-auto bg-gray-50 dark:bg-gray-950 min-h-screen transition-colors">
<div class="mt-24 px-4 sm:px-6 md:px-8 ">
<div id="unverifiedEmailNotice" 
     class="hidden relative shadow-md flex flex-col justify-center 
             bg-white dark:bg-gray-950 
             text-gray-700 dark:text-gray-100 
             overflow-hidden rounded-xl 
             border border-gray-300 dark:border-gray-700 
             p-4 sm:p-6 transition-colors ">
  <div class="flex justify-center ">
    <ion-icon name="mail-unread-outline" class="text-4xl text-yellow-500"></ion-icon>
  </div>
  <h2 class="text-xl font-bold mb-2">Email Belum Terverifikasi</h2>
  <p class="text-sm mb-3">
    Silakan periksa kotak masuk email kamu untuk melakukan verifikasi akun sebelum mengakses dashboard member.
  </p>
  <button id="resendVerifyBtn"
     class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium 
            px-5 py-2 rounded-lg transition-all shadow">
    Kirim Ulang Email Verifikasi
  </button>
</div>
</div>
  <div class="mt-6 px-4 sm:px-6 md:px-8">
  <div class="grid sm:grid-cols-1 gap-4">
    <!-- ===== Greeting Card ===== -->
    <div
      class="relative shadow-md flex flex-col justify-center 
             bg-white dark:bg-gray-950 
             text-gray-700 dark:text-gray-100 
             overflow-hidden rounded-xl 
             border border-gray-300 dark:border-gray-700 
             p-4 sm:p-6 transition-colors"
    >
      <!-- Tanggal -->
      <p class="text-gray-600 text-base sm:text-lg md:text-xl dark:text-gray-400 mb-2" id="tanggalSekarang"></p>

      <!-- Greeting Text -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:flex-wrap gap-1 sm:gap-3">
  <div class="flex flex-wrap items-center gap-x-1 sm:gap-x-2">
    <!-- Greeting -->
    <span class="text-base sm:text-xl font-bold" id="greeting"></span>

    <!-- Nama User -->
    <p class="text-base sm:text-xl font-bold" id="userName"></p>

    <!-- Nomor Member -->
    <p
      id="noMember"
      class="text-sm sm:text-lg font-medium text-gray-600 dark:text-gray-400 
             mt-1 sm:mt-0 sm:ml-3"
    ></p>
  </div>


        <p class="text-base sm:text-lg font-medium ml-1 leading-snug">
          Silakan menikmati belanja di
          <span class="font-medium">
            Assalaam Hypermarket!
          </span>
        </p>
      </div>
    </div>
  </div>



    {{-- ================= 3 CARD INFO ================= --}}
    <div class="grid gap-4 mt-4 sm:grid-cols-3">
      <!-- Total Belanja -->
      <div
        class="relative shadow-md flex flex-row items-center justify-between 
               bg-white dark:bg-gray-950 
               text-gray-900 dark:text-gray-100 
               border border-gray-300 dark:!border-gray-700 
               p-6 rounded-xl transition-colors">
        <div>
          <h5 class="text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Total Belanja</h5>
          <p class="text-2xl font-bold" id="totalBelanja">Rp 0</p>
        </div>
        <ion-icon name="bag-handle-sharp" class="text-4xl opacity-80"></ion-icon>
      </div>

      <!-- Total Poin -->
      <div
        class="relative shadow-md flex flex-row items-center justify-between 
               bg-white dark:bg-gray-950 
               text-gray-900 dark:text-gray-100 
               border border-gray-300 dark:!border-gray-700 
               p-6 rounded-xl transition-colors">
        <div>
          <h5 class="text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Total Poin</h5>
          <p class="text-2xl font-bold" id="totalPoin">0</p>
        </div>
        <ion-icon name="star-outline" class="text-4xl opacity-80"></ion-icon>
      </div>

      <!-- Total Kupon -->
      <div
        class="relative shadow-md flex flex-row items-center justify-between 
               bg-white dark:bg-gray-950 
               text-gray-900 dark:text-gray-100 
               border border-gray-300 dark:!border-gray-700 
               p-6 rounded-xl transition-colors">
        <div>
          <h5 class="text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Total Kupon</h5>
          <p class="text-2xl font-bold" id="totalKupon">0</p>
        </div>
        <ion-icon name="pricetag-outline" class="text-4xl opacity-80"></ion-icon>
      </div>
    </div>
  </div>

<!-- ===== GRID: Barcode + Grafik ===== -->
<div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-4 mt-6 px-4 sm:px-6 md:px-8">

  
  
<div class="">

    
  <!-- Container tampilan -->
  <div id="displayArea"
       class="flex justify-center items-center w-full sm:w-[390px] min-h-[300px]
              bg-white dark:bg-gray-900 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-4 transition">
    <p class="text-gray-400">Pilih tampilan di bawah...</p>
  </div>

  <!-- Tombol pilihan -->
  <div class="flex justify-center mt-6 space-x-3 flex-wrap">
    <button id="btnBarcode"
            class="btn-choice bg-orange-500 hover:bg-orange-600 text-white">
      <i class="fa-solid fa-barcode mr-2"></i> Barcode
    </button>
    <button id="btnQR"
            class="btn-choice bg-green-500 hover:bg-green-600 text-white">
      <i class="fa-solid fa-qrcode mr-2"></i> QR Code
    </button>
    <button id="btnKartu"
            class="btn-choice bg-blue-500 hover:bg-blue-600 text-white">
      <i class="fa-solid fa-id-card mr-2"></i> Kartu PAS
    </button>
  </div>
</div>

<!-- Modal Pop-up -->
<div id="popupModal"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div id="popupContent"
       class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden transition transform scale-100">
  </div>
</div>

<!-- Styles for buttons -->
<style>
.btn-choice {
  @apply px-5 py-2 rounded-lg font-semibold transition-all shadow-md 
         hover:shadow-lg hover:scale-105 focus:ring-2 focus:ring-offset-2;
}
</style>

 <!-- ===== Grafik Belanja ===== -->
<div
  class="bg-white dark:bg-gray-950 rounded-xl shadow-md
         border border-gray-300 dark:border-gray-700
         p-4 sm:p-6 transition-colors
         w-full h-[320px] sm:h-[350px]"
>
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
    <div>
      <h3 id="chartTitle" class="text-lg font-semibold text-gray-800 dark:text-gray-100">
        Grafik Transaksi Tahun <span id="tahunSekarang"></span>
      </h3>
      <p class="text-sm text-gray-500 dark:text-gray-400" id="chartDescription">
        Total belanja & poin kamu selama tahun berjalan
      </p>
    </div>
  </div>

  <div
    id="chart"
    class="w-full h-[250px] sm:h-[300px] overflow-x-auto overflow-y-hidden"
  >
    <div id="chart-inner" class="min-w-[320px] sm:min-w-full"></div>
  </div>
</div>
</div>

<!-- ===== TABEL TRANSAKSI (DESKTOP / TABLET) ===== -->
<div
  class="p-4 sm:px-6 md:px-8 my-6 relative flex flex-col 
         rounded-xl bg-white dark:bg-gray-950 
         shadow-md border border-gray-300 dark:border-gray-700 
         transition-colors
         w-full max-w-[1200px] mx-auto
         hidden md:block"> <!-- ⬅️ ubah sm:block jadi md:block -->

  <h2 class="text-center text-lg font-semibold text-gray-800 dark:text-gray-100 
             border-b border-gray-300 dark:border-gray-700 pb-3">
    Riwayat Transaksi
  </h2>

  <div class="overflow-x-auto mt-3 w-full">
    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-100">
      <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">
        <tr>
          <th class="px-6 py-3">No.</th>
          <th class="px-6 py-3">No. Transaksi</th>
          <th class="px-6 py-3">Tanggal</th>
          <th class="px-6 py-3">Total</th>
          <th class="px-6 py-3">Poin</th>
          <th class="px-6 py-3">Kupon</th>
        </tr>
      </thead>
      <tbody id="transactionBody" class="divide-y divide-gray-200 dark:divide-gray-700">
        <tr>
          <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">Loading...</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="flex justify-center mt-3">
    <button id="lihatSemuaBtn" class="text-blue-600 dark:text-blue-400 underline">
      Lihat Semua
    </button>
  </div>
</div>


  

  {{-- ================= TRANSAKSI MOBILE ================= --}}
<div
  class="p-4 sm:px-6 md:px-8 my-4 block md:hidden 
         bg-white dark:bg-gray-950 
         rounded-xl shadow-md border border-gray-300 dark:!border-gray-700 transition-colors w-full">
    <h2 class="text-center text-lg font-semibold text-gray-800 dark:text-gray-100 border-b border-gray-300 dark:!border-gray-700 pb-3">
      Riwayat Transaksi
    </h2>
    <div id="transactionListMobile" class="mt-3 space-y-3">
      <p class="text-center text-gray-500 dark:text-gray-400">Loading...</p>
    </div>
    <div class="flex justify-center mt-3">
      <button id="lihatSemuaBtnMobile" class="text-blue-600 dark:text-blue-400 underline">Lihat Semua</button>
    </div>
  </div>

 
</div>

{{-- ================= MODAL LIHAT SEMUA TRANSAKSI ================= --}}
<div id="modalAllTransactions"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-all"
     onclick="if(event.target.id==='modalAllTransactions'){this.classList.add('hidden');}">
  <div class="relative bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-700 rounded-xl shadow-xl w-11/12 md:w-3/4 lg:w-1/2 max-h-[80vh] overflow-y-auto">
    <div class="flex justify-between items-center border-b border-gray-300 dark:border-gray-700 p-4">
      <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Semua Transaksi</h3>
      <button id="closeModalBtn" class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-300 text-xl font-bold">&times;</button>
    </div>
    <div id="allTransactionsList" class="p-4 space-y-3 text-gray-700 dark:text-gray-100">
      <p class="text-center text-gray-500 dark:text-gray-400">Memuat data...</p>
    </div>
  </div>
</div>


<!-- ===== DEPENDENCIES ===== -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!-- ===== MAIN SCRIPT ===== -->
<script>
document.addEventListener("DOMContentLoaded", async () => {
  const token = localStorage.getItem("jwt_token_user");
  const api = {
    dashboard: "{{ api_url('/api/auth/dashboard') }}",
    barcode: "{{ api_url('/api/auth/barcode') }}",
    qr: "{{ api_url('/api/auth/qr') }}",
    resend: "{{ api_url('/api/email/resend') }}",
  };
  const authHeaders = { headers: { Authorization: `Bearer ${token}` } };

  const el = {
    displayArea: document.getElementById("displayArea"),
    popupModal: document.getElementById("popupModal"),
    popupContent: document.getElementById("popupContent"),
    btnBarcode: document.getElementById("btnBarcode"),
    btnQR: document.getElementById("btnQR"),
    btnKartu: document.getElementById("btnKartu"),
    greeting: document.getElementById("greeting"),
    dashboardContent: document.getElementById("dashboardContent"),
    noMemberNotice: document.getElementById("noMemberNotice"),
    pendingNotice: document.getElementById("pendingMemberNotice"),
    unverifiedNotice: document.getElementById("unverifiedEmailNotice"),
  };

  el.btnBarcode?.addEventListener("click", loadBarcode);
  el.btnQR?.addEventListener("click", loadQR);
  el.btnKartu?.addEventListener("click", loadKartuPas);
  el.popupModal?.addEventListener("click", (e) => {
    if (e.target === el.popupModal) el.popupModal.classList.add("hidden");
  });

  const formatRupiah = (val) =>
    new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      notation: "compact",
      maximumFractionDigits: 1,
    }).format(Number(val) || 0);

  if (el.greeting) {
    const hour = new Date().getHours();
    el.greeting.textContent =
      hour < 5
        ? "Selamat Dini Hari 🌙"
        : hour < 12
        ? "Selamat Pagi ☀️"
        : hour < 15
        ? "Selamat Siang 🌤️"
        : hour < 18
        ? "Selamat Sore 🌇"
        : "Selamat Malam 🌌";
  }

  async function loadBarcode() { 
    el.displayArea.innerHTML = `<p class="text-gray-400">Memuat barcode...</p>`;
    try {
      const { data } = await axios.get(api.barcode, { ...authHeaders });
      if (!data?.barcode) throw new Error();
      const barcode = data.barcode;

      el.displayArea.innerHTML = `<img src="${barcode}" class="max-w-[200px] mx-auto" alt="Barcode"/>`;
      el.popupContent.innerHTML = `
        <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-lg">
          <img src="${barcode}" alt="Barcode Besar" class="w-[350px] h-auto object-contain"/>
        </div>`;
      el.popupModal.classList.remove("hidden");
    } catch {
      el.displayArea.textContent = "Gagal memuat barcode";
    }
  }
  async function loadQR() {
    el.displayArea.innerHTML = `<p class="text-gray-400">Memuat QR...</p>`;
    try {
      const { data } = await axios.get(api.qr, { ...authHeaders, responseType: "text" });
      if (!data) throw new Error();

      el.displayArea.innerHTML = data;
      el.popupContent.innerHTML = `
        <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-lg flex justify-center">
          ${data}
        </div>`;
      el.popupModal.classList.remove("hidden");
    } catch {
      el.displayArea.textContent = "Gagal memuat QR";
    }}
  async function loadKartuPas() {  el.displayArea.innerHTML = `<p class="text-gray-400">Memuat Kartu PAS...</p>`;
    try {
      const [memberRes, barcodeRes] = await Promise.all([
        axios.get(api.dashboard, authHeaders),
        axios.get(api.barcode, authHeaders),
      ]);

      const member = memberRes.data?.member;
      const barcode = barcodeRes.data?.barcode;
      if (!member || !barcode) throw new Error();

      const firstName = member.name?.split(" ")[0] || "";

      const cardSmall = `
        <div class="relative w-full max-w-[340px] aspect-[5/3] bg-cover bg-center rounded-xl shadow-md overflow-hidden mx-auto"
             style="background-image: url('/images/kartu_pas_template.png');">
          <div class="absolute bottom-[36px] sm:bottom-[44px] left-[72%] sm:left-[76%] transform -translate-x-1/2 
                      text-[5vw] sm:text-[2vw] md:text-lg font-bold text-green-900 drop-shadow-md whitespace-nowrap">
            ${firstName}
          </div>
          <div class="absolute bottom-[10px] sm:bottom-[11px] right-[13%] sm:right-[6%]
                      w-[30%] h-[16%] sm:w-[35%] sm:h-[20%]
                      bg-white/80 flex items-center justify-center rounded-md p-1">
            <img src="${barcode}" class="w-full h-auto object-contain"/>
          </div>
        </div>`;

      const cardLarge = `
        <div class="relative w-[90vw] max-w-[650px] aspect-[5/3] bg-cover bg-center rounded-xl overflow-hidden mx-auto"
             style="background-image: url('/images/kartu_pas_template.png');">
          <div class="absolute sm:bottom-[25%] sm:left-[76%] bottom-[65px] left-[72%] transform -translate-x-1/2 
                      text-xl sm:text-2xl md:text-3xl font-bold text-green-900 drop-shadow-md whitespace-nowrap">
            ${firstName}
          </div>
          <div class="absolute sm:bottom-[6%] sm:right-[6%] bottom-[19px] right-[13%] sm:w-[35%] sm:h-[20%] w-[30%] h-[16%] 
                      bg-white/80 flex items-center justify-center rounded-md p-2">
            <img src="${barcode}" class="w-full h-auto object-contain"/>
          </div>
        </div>`;

      el.displayArea.innerHTML = cardSmall;
      el.popupContent.innerHTML = cardLarge;
      el.popupModal.classList.remove("hidden");
    } catch {
      el.displayArea.textContent = "Gagal memuat Kartu PAS";
    }
  }

  // ===== FETCH DASHBOARD =====
  try {
    const { data } = await axios.get(api.dashboard, authHeaders);
    const d = data || {};
    const user = d.user || {};
    const member = d.member || null;
    const trx = Array.isArray(d.transactions) ? d.transactions : [];

    [el.dashboardContent, el.noMemberNotice, el.pendingNotice].forEach((x) =>
      x?.classList.add("hidden")
    );

    if (!member || !member.status || member.status === "Belum menjadi member") {
      el.noMemberNotice?.classList.remove("hidden");
      return;
    }

    // ===== FITUR KUNCI OTOMATIS =====
    const lockedSections = [
      "#btnBarcode",
      "#btnQR",
      "#btnKartu",
  
    ];

    function lockAllFeatures() {
      lockedSections.forEach((sel) => {
        const elx = document.querySelector(sel);
        if (!elx) return;
        elx.classList.add("opacity-40", "pointer-events-none", "select-none");
        if (elx.tagName === "TABLE" || elx.tagName === "DIV") {
          elx.innerHTML = `
            <div class="p-4 text-center text-gray-500 border rounded-lg bg-gray-50 dark:bg-gray-800">
              🔒 Fitur ini dikunci. Verifikasi email Anda untuk membuka akses.
            </div>`;
        }
      });
    }

    function unlockAllFeatures() {
      lockedSections.forEach((sel) => {
        const elx = document.querySelector(sel);
        if (!elx) return;
        elx.classList.remove("opacity-40", "pointer-events-none", "select-none");
      });
    }

    // Cek status verifikasi email
    if (!user.email_verified_at) {
      el.unverifiedNotice?.classList.remove("hidden");
      lockAllFeatures();
    } else {
      el.unverifiedNotice?.classList.add("hidden");
      unlockAllFeatures();
    }
    // ===== END FITUR KUNCI OTOMATIS =====

    if (member.status === "Pending") {
      el.pendingNotice?.classList.remove("hidden");
      document.getElementById("pendingStatus").textContent = member.status;
      document.getElementById("pendingName").textContent = member.name || "-";
      document.getElementById("pendingEmail").textContent = member.email || "-";
      return;
    }

    if (member.status === "Aktif")
      el.dashboardContent?.classList.remove("hidden");

    const currentYear = new Date().getFullYear();
    const trxTahunBerjalan = trx.filter((t) => {
      let tanggal = t.created_at || t.date;
      if (!tanggal) return false;
      if (/^\d{2}-\d{2}-\d{4}$/.test(tanggal)) {
        const [day, month, year] = tanggal.split("-");
        tanggal = `${year}-${month}-${day}`;
      }
      const year = new Date(tanggal).getFullYear();
      return year === currentYear;
    });

    const totalPoin = trxTahunBerjalan.reduce(
      (s, t) => s + (parseFloat(t.point) || 0),
      0
    );
    const totalKupon = trxTahunBerjalan.reduce(
      (s, t) => s + (parseFloat(t.coupon) || 0),
      0
    );

    document.getElementById("userName").textContent = member.name
      ? " " + member.name + "!"
      : "";
    document.getElementById("noMember").textContent = member.no_member
      ? "Dengan Nomor Member: " + member.no_member
      : "Belum menjadi member";
    document.getElementById("totalBelanja").textContent = formatRupiah(
      trxTahunBerjalan.reduce((s, t) => s + (parseFloat(t.amount) || 0), 0)
    );
    document.getElementById("totalPoin").textContent = totalPoin;
    document.getElementById("totalKupon").textContent = totalKupon;

    renderTransactionsDesktop(trx);
    renderTransactionsMobile(trx);
    renderAllTransactions(trx);
    renderChart(trx);
  } catch (err) {
    console.error("Error dashboard:", err);
    if (err.response?.status === 401) {
      localStorage.removeItem("jwt_token_user");
      window.location.href = "/login";
    }
  }

  // ...fungsi renderTransactionsDesktop/Mobile/All/chart/resendModal tetap sama...

  

  // ====== RENDER TRANSAKSI ======
  function renderTransactionsDesktop(trx) {
    const tbody = document.getElementById("transactionBody");
    if (!tbody) return;
    tbody.innerHTML = trx.length
      ? trx
          .slice(0, 3)
          .map(
            (t, i) => `
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
          <td class="px-6 py-3">${i + 1}</td>
          <td class="px-6 py-3">${t.id}</td>
          <td class="px-6 py-3">${t.date}</td>
          <td class="px-6 py-3">${formatRupiah(t.amount)}</td>
          <td class="px-6 py-3">${t.point}</td>
          <td class="px-6 py-3">${t.coupon}</td>
        </tr>`
          )
          .join("")
      : `<tr><td colspan="6" class="text-center py-4 text-gray-500">Belum ada transaksi</td></tr>`;
  }

  function renderTransactionsMobile(trx) {
    const container = document.getElementById("transactionListMobile");
    if (!container) return;
    container.innerHTML = trx.length
      ? trx
          .slice(0, 3)
          .map(
            (t, i) => `
        <div class="p-3 border rounded-lg bg-gray-50 dark:bg-gray-700 shadow-sm">
          <p><b>No:</b> ${i + 1}</p>
          <p><b>No. Transaksi:</b> ${t.id}</p>
          <p><b>Tanggal:</b> ${t.date}</p>
          <p><b>Total:</b> ${formatRupiah(t.amount)}</p>
          <p><b>Poin:</b> ${t.point}</p>
          <p><b>Kupon:</b> ${t.coupon}</p>
        </div>`
          )
          .join("")
      : `<p class="text-center text-gray-500">Belum ada transaksi</p>`;
  }

  function renderAllTransactions(trx) {
    const container = document.getElementById("allTransactionsList");
    if (!container) return;
    container.innerHTML = trx.length
      ? trx
          .map(
            (t, i) => `
        <div class="p-3 border rounded-lg bg-gray-50 dark:bg-gray-700 shadow-sm">
          <p><b>No:</b> ${i + 1}</p>
          <p><b>No. Transaksi:</b> ${t.id}</p>
          <p><b>Tanggal:</b> ${t.date}</p>
          <p><b>Total:</b> ${formatRupiah(t.amount)}</p>
          <p><b>Poin:</b> ${t.point}</p>
          <p><b>Kupon:</b> ${t.coupon}</p>
        </div>`
          )
          .join("")
      : `<p class="text-center text-gray-500">Tidak ada transaksi</p>`;
  }

  function renderChart(trx) {
  if (!trx.length) return;

  const year = new Date().getFullYear();
  document.getElementById("tahunSekarang").textContent = year;

  const parseDate = (str) => {
    const [day, month, year] = str.split("-");
    return new Date(`${year}-${month}-${day}`);
  };

  const filtered = trx.filter((t) => {
    const d = parseDate(t.date);
    return d.getFullYear() === year;
  });

  if (!filtered.length) return;

  const monthMap = {};
  const monthNames = [
    "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
    "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
  ];

  filtered.forEach((t) => {
    const d = parseDate(t.date);
    const month = monthNames[d.getMonth()];
    if (!monthMap[month]) monthMap[month] = { amount: 0, point: 0 };
    monthMap[month].amount += parseFloat(t.amount) || 0;
    monthMap[month].point += parseFloat(t.point) || 0;
  });

  const categories = Object.keys(monthMap);
  const values = categories.map((m) => monthMap[m].amount);
  const points = categories.map((m) => monthMap[m].point);

  const options = {
    chart: {
      type: "bar",
      height: 300,
      toolbar: { show: false },
      animations: { enabled: true },
      fontFamily: "Inter, sans-serif",
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        borderRadius: 6,
      },
    },
    dataLabels: { enabled: false },
    fill: {
      opacity: 0.9,
      gradient: {
        shade: "light",
        type: "vertical",
        opacityFrom: 0.9,
        opacityTo: 0.5,
        stops: [0, 90, 100],
      },
    },
    stroke: { show: false },
    colors: ["#4f46e5", "#10b981"],
    series: [
      { name: "Belanja (Rp)", data: values },
      { name: "Poin", data: points },
    ],
    xaxis: {
      categories,
      labels: { rotate: -45 },
      axisBorder: { show: false },
      axisTicks: { show: false },
    },
    yaxis: {
      labels: { formatter: (val) => formatRupiah(val) },
    },
    grid: {
      borderColor: "#e5e7eb",
      strokeDashArray: 4,
      yaxis: { lines: { show: true } },
    },
    tooltip: {
      shared: true,
      intersect: false,
      y: {
        formatter: (val, { seriesIndex }) =>
          seriesIndex === 0 ? formatRupiah(val) : val + " poin",
      },
    },
    legend: {
      position: "top",
      labels: { colors: "#4b5563" },
    },
  };

  const chartContainer = document.querySelector("#chart");
  if (chartContainer) {
    chartContainer.innerHTML = "";
    new ApexCharts(chartContainer, options).render();
  }
}



  // ====== RESEND EMAIL VERIFIKASI ======
  document.getElementById("resendVerifyBtn")?.addEventListener("click", async () => {
    try {
      const res = await axios.post(api.resend, {}, authHeaders);
      alert(res.data.message || "Email verifikasi telah dikirim ulang. Silakan cek inbox.");
    } catch {
      alert("Gagal mengirim ulang email verifikasi. Coba lagi nanti.");
    }
  });

  // ====== MODAL SEMUA TRANSAKSI (tidak diubah) ======
  const modalWrapper = document.getElementById("modalAllTransactions");
  document.getElementById("lihatSemuaBtn")?.addEventListener("click", () => modalWrapper.classList.remove("hidden"));
  document.getElementById("lihatSemuaBtnMobile")?.addEventListener("click", () => modalWrapper.classList.remove("hidden"));
  document.getElementById("closeModalBtn")?.addEventListener("click", () => modalWrapper.classList.add("hidden"));
});
</script>
