 // Fungsi untuk membuka modal
 function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Pindah dari Login ke Registrasi
function switchToRegister() {
    closeModal('loginModal');
    openModal('registerModal');
}

// Pindah dari Registrasi ke Login
function switchToLogin() {
    closeModal('registerModal');
    openModal('loginModal');
}
