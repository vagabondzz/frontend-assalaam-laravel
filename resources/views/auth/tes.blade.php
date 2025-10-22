<script type="module">
import axios from "axios";
import Swal from "sweetalert2";

const token = localStorage.getItem("jwt_token_cs");
const API_URL = import.meta.env.VITE_API_URL || "http://127.0.0.1:8001/api";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("registerForm");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    try {
      const res = await axios.post(`${API_URL}/auth/adduser`, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
          "Authorization": `Bearer ${token}`,
        },
      });

      if (res.data.success) {
        Swal.fire({
          icon: "success",
          title: "Registrasi Berhasil",
          text: "Akun kamu berhasil dibuat dan menunggu verifikasi CS.",
        });
        form.reset();
      } else {
        Swal.fire({
          icon: "warning",
          title: "Gagal",
          text: res.data.message || "Terjadi kesalahan pada registrasi.",
        });
      }
    } catch (err) {
      console.error(err);
      const msg =
        err.response?.data?.message ||
        Object.values(err.response?.data?.errors || {})[0]?.[0] ||
        "Terjadi kesalahan.";
      Swal.fire({
        icon: "error",
        title: "Registrasi Gagal",
        text: msg,
      });
    }
  });
});
</script>

@include('include.htmlend')
