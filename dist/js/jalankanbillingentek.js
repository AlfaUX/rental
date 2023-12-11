// Fungsi untuk menjalankan skrip PHP di server menggunakan AJAX
function runCheckExpiredSessions() {
  // Buat objek XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Atur metode dan URL untuk request
  xhr.open("GET", "run_check_expired_sessions.php", true);

  // Atur callback untuk menangani response dari server
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Response berhasil diterima, lakukan sesuatu (jika diperlukan)
        console.log(xhr.responseText);
      } else {
        // Terjadi kesalahan dalam request, lakukan sesuatu (jika diperlukan)
        console.error("Terjadi kesalahan dalam request: " + xhr.status);
      }
    }
  };

  // Kirim request ke server
  xhr.send();
}

// Panggil fungsi untuk menjalankan skrip PHP
runCheckExpiredSessions();
