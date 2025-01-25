
  document.addEventListener("DOMContentLoaded", function () {
    const tanggalInput = document.getElementById("filter_tanggal");
    if (tanggalInput) {
      function setTodayDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        return `${year}-${month}-${day}`;
      }
      if (!tanggalInput.value) {
        tanggalInput.value = setTodayDate();
      }
    }
  });

