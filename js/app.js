document.addEventListener("DOMContentLoaded", function () {

  function showConfirmation(title, text, confirmButtonText) {
    const config = {
      title: title,
      text: text,
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#2F4858",
      cancelButtonColor: "#6c757d",
      confirmButtonText: confirmButtonText,
      cancelButtonText: "Batal",
      width: "400px",
      customClass: {
        popup: "swal-custom-popup",
        title: "swal-custom-title",
        confirmButton: "swal-custom-confirm-button",
        cancelButton: "swal-custom-confirm-button",
      },
    };
    if (confirmButtonText === "Ya, hapus!") {
        config.icon = "warning";
        config.confirmButtonColor = "#d33";
    }
    return Swal.fire(config);
  }

  // --- Sidebar Toggle ---
  const menuToggle = document.getElementById("menu-toggle");
  if (menuToggle) {
    menuToggle.addEventListener("click", () => document.getElementById("wrapper").classList.toggle("toggled"));
  }

  // --- Konfirmasi Hapus Data ---
  document.querySelectorAll(".delete-button").forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault();
      const deleteUrl = this.href;
      showConfirmation("Apakah Anda yakin?", "Data yang dihapus tidak dapat dikembalikan!", "Ya, hapus!")
        .then((result) => {
          if (result.isConfirmed) {
            window.location.href = deleteUrl;
          }
        });
    });
  });

  // --- Konfirmasi Simpan/Update Data ---
  const siswaForm = document.getElementById("siswa-form");
  if (siswaForm) {
    siswaForm.addEventListener("submit", function (event) {
      event.preventDefault();
      showConfirmation("Simpan Perubahan?", "Pastikan semua data yang Anda masukkan sudah benar.", "Ya, simpan!")
        .then((result) => {
          if (result.isConfirmed) this.submit();
        });
    });
  }

  // --- Konfirmasi Login ---
  const loginForm = document.getElementById("login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();
      showConfirmation("Konfirmasi Login", "Apakah Anda ingin melanjutkan untuk login?", "Ya, lanjutkan!")
        .then((result) => {
          if (result.isConfirmed) this.submit();
        });
    });
  }

  // --- Konfirmasi Register ---
  const registerForm = document.getElementById("register-form");
  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      event.preventDefault();
      showConfirmation("Konfirmasi Pendaftaran", "Apakah data yang Anda masukkan sudah benar?", "Ya, daftarkan!")
        .then((result) => {
          if (result.isConfirmed) this.submit();
        });
    });
  }

  const logoutButton = document.querySelector(".logout-button");

// --- Konfirmasi Logout ---
  if (logoutButton) {
    logoutButton.addEventListener("click", function (event) {
      event.preventDefault();

      const logoutUrl = this.href;

      showConfirmation(
        "Konfirmasi Logout",
        "Apakah Anda yakin ingin keluar dari sesi ini?",
        "Ya, keluar!"
      ).then((result) => {
        if (result.isConfirmed) {
          window.location.href = logoutUrl;
        }
      });
    });
  }

  // --- Live Preview Foto ---
  const fotoInput = document.getElementById('fotoInput');
  const fotoPreview = document.getElementById('fotoPreview');
  if (fotoInput && fotoPreview) {
      fotoInput.addEventListener('change', function() {
          const file = this.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = (e) => fotoPreview.src = e.target.result;
              reader.readAsDataURL(file);
          }
      });
  }

});