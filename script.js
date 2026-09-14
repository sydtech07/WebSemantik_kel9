// ============================================================
// script.js — Bagian 3: Menampilkan data XML ke tabel HTML
// Tugas Kelompok 9 — Web Semantik
// ============================================================

// 1. Ambil referensi elemen tbody tempat data akan dimasukkan
const tableBody = document.getElementById("table-body");

// 2. Fungsi bantu: mengubah teks "tingkat_kesulitan" jadi class badge CSS
//    Contoh: "Sangat Sulit" -> "badge-sangatsulit"
function getBadgeClass(tingkat) {
  const key = tingkat.toLowerCase().replace(/\s+/g, "");
  return `badge badge-${key}`;
}

// 3. Fungsi utama: mengambil file XML lalu menampilkannya ke tabel
async function loadKarakterData() {
  try {
    // fetch() mengambil file karakter.xml dari server/lokal
    const response = await fetch("karakter.xml");

    if (!response.ok) {
      throw new Error(`Gagal memuat file XML (status: ${response.status})`);
    }

    // Ambil isi file sebagai teks mentah
    const xmlText = await response.text();

    // 4. Parsing teks XML menjadi objek Document yang bisa "dijelajahi"
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlText, "application/xml");

    // Cek apakah ada error parsing (misalnya XML tidak valid)
    const parserError = xmlDoc.querySelector("parsererror");
    if (parserError) {
      throw new Error("File XML tidak valid / gagal di-parse.");
    }

    // 5. Ambil semua elemen <karakter>
    const karakterList = xmlDoc.getElementsByTagName("karakter");

    // 6. Kosongkan tbody (hapus baris "Memuat data...")
    tableBody.innerHTML = "";

    // 7. Looping setiap <karakter>, ambil isi tiap tag anaknya,
    //    lalu bentuk jadi satu baris <tr> pada tabel
    Array.from(karakterList).forEach((karakter, index) => {
      const nama = karakter.getElementsByTagName("nama")[0].textContent;
      const role = karakter.getElementsByTagName("role")[0].textContent;
      const skill = karakter.getElementsByTagName("skill")[0].textContent;
      const tingkat = karakter.getElementsByTagName("tingkat_kesulitan")[0].textContent;
      const tipeSerangan = karakter.getElementsByTagName("tipe_serangan")[0].textContent;
      const lane = karakter.getElementsByTagName("lane")[0].textContent;
      const profil = karakter.getElementsByTagName("profil")[0].textContent;

      // Buat baris tabel baru
      const row = document.createElement("tr");

      row.innerHTML = `
        <td>${index + 1}</td>
        <td>${nama}</td>
        <td>${role}</td>
        <td>${tipeSerangan}</td>
        <td>${lane}</td>
        <td><span class="${getBadgeClass(tingkat)}">${tingkat}</span></td>
        <td>${skill}</td>
        <td>${profil}</td>
      `;

      // Masukkan baris ke dalam tbody
      tableBody.appendChild(row);
    });

  } catch (error) {
    // 8. Jika terjadi error (file tidak ditemukan, XML rusak, dll),
    //    tampilkan pesan error di tabel supaya mudah di-debug
    console.error("Terjadi kesalahan:", error);
    tableBody.innerHTML = `
      <tr>
        <td colspan="8" style="text-align:center; color:#ff8080;">
          Gagal memuat data: ${error.message}
        </td>
      </tr>
    `;
  }
}

// 9. Jalankan fungsi setelah halaman selesai dimuat
document.addEventListener("DOMContentLoaded", loadKarakterData);