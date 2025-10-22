@include('include.htmlstart')

<div class="font-[sans-serif] min-h-screen w-full flex items-center justify-center px-4"
    style="background-image: linear-gradient(rgba(68,68,68,0.5),rgba(68,68,68,0.5)), url('{{ asset('https://pas.assalaamhypermarket.co.id/images/bg.jpg') }}'); background-size: cover; background-position: center;">
    <div data-aos="zoom-in"
        style="background-image: linear-gradient(rgba(255,255,255,0.452), rgba(248,226,226,0.402))"
        class="grid lg:grid-cols-2 gap-4 max-w-5xl w-full p-6 md:p-12 rounded-lg shadow-2xl mx-auto sm:mx-4 md:mx-32">

        <!-- KIRI -->
        <div class="flex flex-col items-center md:items-start justify-center">
            <a href="/" class="mb-4 mx-auto md:ml-6">
                <img src="{{ asset('https://pas.assalaamhypermarket.co.id/images/logoTeks.png') }}" alt="logo" class="w-56 md:w-72" />
            </a>
            <div class="max-w-lg mt-12 ml-8 max-lg:hidden">
                <h3 class="text-3xl font-bold text-gray-800">LOGIN</h3>
                <p class="text-sm font-medium mt-2 text-gray-700">Silahkan login dengan akun yang sudah diregistrasi. Nikmati layanan yang ada di Assalaam Hypermarket.</p>
            </div>
        </div>

        <!-- KANAN -->
        <div id="loginBox" data-aos="fade-up"
            class="bg-white/90 backdrop-blur-md rounded-xl p-6 lg:p-10 max-w-md w-full h-max shadow-lg mx-auto transition-all">
            <form id="loginForm" class="space-y-4">
                @csrf
                <div>
                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Email</label>
                    <input id="email" name="email" type="email" required autocomplete="username"
                        class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                        placeholder="Masukkan Email" />
                </div>

                <!-- 🔹 PASSWORD dengan ikon mata -->
                <div class="relative">
  <label class="text-gray-700 text-sm mb-2 block font-semibold">Password</label>

  <!-- Input Password -->
  <input
    id="password"
    name="password"
    type="password"
    required
    autocomplete="current-password"
    placeholder="Masukkan Password"
    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 pr-10 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
  />

  <!-- Tombol Toggle Mata -->
  <button
    type="button"
    id="togglePassword"
    class="absolute right-3 top-9 text-gray-500 hover:text-amber-500 transition"
    tabindex="-1"
  >
    <!-- Ikon Mata (default: tertutup) -->
    <svg
      id="eyeIcon"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="w-5 h-5"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
      />
      <circle cx="12" cy="12" r="3" />
    </svg>
  </button>
</div>

                <p id="errorMsg" class="text-red-600 text-sm font-medium hidden"></p>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" class="h-4 w-4 text-amber-600 border-gray-300 rounded">
                        <label for="remember" class="ml-2 text-sm text-gray-800">Ingat saya (Email saja)</label>
                    </div>
                    <button type="button" id="forgotBtn"
                        class="text-sm font-medium text-amber-600 hover:underline hover:text-amber-700 transition">Lupa password?</button>
                </div>

                <div class="mt-6">
                    <button type="submit" id="btnLogin"
                        class="w-full bg-amber-500 shadow-md py-3 px-6 text-sm font-semibold rounded-md text-white hover:bg-amber-600 active:bg-amber-700 focus:outline-none flex items-center justify-center gap-2">
                        <span id="btnText">Masuk</span>
                        <svg id="spinner" class="animate-spin h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 Popup Lupa Password -->
<div id="forgotModal"
    class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white/95 backdrop-blur-md p-6 rounded-2xl shadow-2xl w-96 relative animate-fadeIn">
        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center border-b pb-2">Lupa Password</h3>
        <form id="forgotForm" class="space-y-4">
            <div>
                <label class="text-sm text-gray-700 font-medium">Email</label>
                <input id="forgotEmail" type="email" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none"
                    placeholder="Masukkan email Anda" />
            </div>
            <div>
                <label class="text-sm text-gray-700 font-medium">Nomor Member</label>
                <input id="forgotMember" type="text" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none"
                    placeholder="Masukkan nomor member Anda" />
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t">
                <button type="button" id="closeModal"
                    class="px-4 py-2 text-sm rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 transition">Batal</button>
                <button type="submit"
                    class="px-4 py-2 text-sm rounded-md bg-amber-500 hover:bg-amber-600 text-white shadow-md transition">Kirim</button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>

<!-- 🔹 Script Login + Lupa Password -->
<<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = name + "=" + encodeURIComponent(value) + ";expires=" + d.toUTCString() + ";path=/";
}
function getCookie(name) {
    const cname = name + "=";
    const decoded = decodeURIComponent(document.cookie);
    for (let c of decoded.split(';')) {
        c = c.trim();
        if (c.indexOf(cname) === 0) return c.substring(cname.length);
    }
    return "";
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    const btnLogin = document.getElementById("btnLogin");
    const btnText = document.getElementById("btnText");
    const spinner = document.getElementById("spinner");
    const errorMsg = document.getElementById("errorMsg");
    const remember = document.getElementById("remember");
    const forgotBtn = document.getElementById("forgotBtn");
    const forgotModal = document.getElementById("forgotModal");
    const closeModal = document.getElementById("closeModal");
    const forgotForm = document.getElementById("forgotForm");
    const forgotEmail = document.getElementById("forgotEmail");
    const forgotMember = document.getElementById("forgotMember");
    const apiLogin = "{{ api_url('/api/auth/login') }}";
    const apiForgot   = "{{ api_url('/api/auth/forgot-password') }}";
     

    /* ===============================
       👁️ Toggle Show/Hide Password
    =============================== */
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    const eyeOpen = `
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.458 12C3.732 7.943 7.523 5 12 5
                 c4.478 0 8.268 2.943 9.542 7
                 -1.274 4.057-5.064 7-9.542 7
                 -4.477 0-8.268-2.943-9.542-7z" />
        <circle cx="12" cy="12" r="3" />
    `;

    const eyeClosed = `
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.98 8.223A10.477 10.477 0 001.5 12
                 C2.772 16.057 6.563 19 11.04 19
                 c1.758 0 3.44-.463 4.9-1.275
                 m2.63-2.022A10.451 10.451 0 0020.5 12
                 c-1.273-4.057-5.063-7-9.541-7
                 -1.741 0-3.389.416-4.86 1.157M15 12
                 a3 3 0 11-6 0 3 3 0 016 0z" />
    `;

    const showPassword = () => {
        passwordInput.type = "text";
        eyeIcon.innerHTML = eyeOpen;
    };

    const hidePassword = () => {
        passwordInput.type = "password";
        eyeIcon.innerHTML = eyeClosed;
    };

    // Desktop events
    togglePassword.addEventListener("mousedown", showPassword);
    togglePassword.addEventListener("mouseup", hidePassword);
    togglePassword.addEventListener("mouseleave", hidePassword);

    // Mobile events
    togglePassword.addEventListener("touchstart", (e) => {
        e.preventDefault();
        showPassword();
    });
    togglePassword.addEventListener("touchend", hidePassword);

    /* ===============================
       🧠 Remember Email (Cookie)
    =============================== */
    const savedEmail = getCookie("remember_email");
    if (savedEmail) {
        document.getElementById("email").value = savedEmail;
        remember.checked = true;
    }

    /* ===============================
       🔐 Handle Login
    =============================== */
    async function handleLogin(email, password) {
        try {
            const res = await axios.post(apiLogin, { email, password });
            const data = res.data;

            if (data.access_token && data.user) {
    
                if (data.user.role === "admin") {
                    localStorage.setItem("jwt_token_admin", data.access_token);
                    localStorage.setItem("user_admin", JSON.stringify(data.user));
                    window.location.href = "/dashboard";
                } else if (data.user.role === "cs") {
                    localStorage.setItem("jwt_token_cs", data.access_token);
                    localStorage.setItem("user_cs", JSON.stringify(data.user));
                    window.location.href = "/dashboardCS";
                } else {
                    localStorage.setItem("jwt_token_user", data.access_token);
                    localStorage.setItem("user_user", JSON.stringify(data.user));
                    window.location.href = "/new-dashboard";
                }

                // Simpan / hapus cookie email
                remember.checked
                    ? setCookie("remember_email", email, 30)
                    : setCookie("remember_email", "", -1);
            } else {
                errorMsg.textContent = data.message || "Login gagal, periksa email/password.";
                errorMsg.classList.remove("hidden");
            }
        } catch (err) {
            errorMsg.textContent = err.response?.data?.message || "Terjadi kesalahan server.";
            errorMsg.classList.remove("hidden");
        } finally {
            btnLogin.disabled = false;
            btnText.textContent = "Masuk";
            spinner.classList.add("hidden");
        }
    }

    /* ===============================
       📧 Lupa Password
    =============================== */
    async function handleForgotPassword(email, member_id) {
        try {
            const res = await axios.post(apiForgot, { email, member_id });
            const data = res.data;
            if (data.success) {
                forgotEmail.value = "";
                forgotMember.value = "";
                forgotModal.classList.add("hidden");
                alert("✅ Password baru telah dikirim ke email Anda.");
            } else {
                alert("⚠️ " + (data.message || "Email atau nomor member tidak cocok."));
            }
        } catch (err) {
            alert("❌ " + (err.response?.data?.message || "Terjadi kesalahan saat reset password."));
        }
    }

    /* ===============================
       🧾 Event Listener
    =============================== */
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        errorMsg.classList.add("hidden");

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        btnLogin.disabled = true;
        btnText.textContent = "Loading...";
        spinner.classList.remove("hidden");

        handleLogin(email, password);
    });

    forgotBtn.addEventListener("click", () => forgotModal.classList.remove("hidden"));
    closeModal.addEventListener("click", () => forgotModal.classList.add("hidden"));
    forgotForm.addEventListener("submit", (e) => {
        e.preventDefault();
        handleForgotPassword(forgotEmail.value, forgotMember.value);
    });
});
</script>

@include('include.htmlend')
