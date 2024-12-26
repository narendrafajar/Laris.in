document.addEventListener('DOMContentLoaded', function () {
    const numericInputs = document.querySelectorAll('.numeric-input');

    numericInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            // Hapus karakter non-numerik
            let rawValue = this.value.replace(/[^0-9]/g, '');

            // Format ke locale Indonesia
            let formattedValue = parseInt(rawValue || 0, 10).toLocaleString('id-ID');

            // Set kembali ke input
            this.value = formattedValue;
        });

        input.addEventListener('blur', function () {
            // Jika input kosong, reset ke nilai awal
            if (!this.value) {
                this.value = '';
            }
        });
    });
});
// Overlay loading
// $(document).ready(function () {
//     // Event klik tombol Simpan
//     $('.submit-btn').click(function () {
//     // Tampilkan overlay
//     $('#loadingOverlay').fadeIn();

//     // Simulasi proses penyimpanan
//     setTimeout(function () {
//         // Sembunyikan overlay setelah proses selesai
//         $('#loadingOverlay').fadeOut();

//         // Anda bisa mengganti ini dengan logika AJAX atau proses penyimpanan
//         alert('Data berhasil disimpan!');
//     }, 3000); // Simulasi waktu proses 3 detik
//     });
// });