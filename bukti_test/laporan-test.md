# Laporan Testing & Debugging

**Proyek:** Data Karakter Mobile Legends (XML → HTML Table)

## 1. Ruang Lingkup Pengujian

Pengujian dilakukan terhadap alur berikut:

`karakter.xml` → `script.js` (`fetch` + `DOMParser`) → render ke `<table>` di `index.html`

Pengujian dilakukan menggunakan Live Server pada browser Chrome.

## 2. Checklist Pengujian

| No. | Item yang Diuji | Hasil |
|---:|---|---|
| 1 | File `karakter.xml` valid (well-formed, tidak ada tag rusak/bentrok) | Lolos |
| 2 | Jumlah data ≥ 10 | Lolos — 10 karakter |
| 3 | Semua kolom tabel (No, Nama, Role, Tipe Serangan, Lane, Tingkat Kesulitan, Skill, Profil) terisi untuk setiap baris | Lolos |
| 4 | Fetch `karakter.xml` berhasil tanpa error di Console | Lolos |
| 5 | Badge warna tingkat kesulitan (Mudah/Sedang/Sulit/Sangat Sulit) tampil sesuai kelasnya | Lolos |
| 6 | Penomoran baris (No.) urut otomatis | Lolos |
| 7 | Simulasi error handling: nama file XML diubah atau sengaja dibuat salah | Lolos |
| 8 | Tampilan responsif pada lebar layar yang berbeda | Lolos |
| 9 | Konsistensi data antara isi XML dan data yang tampil di tabel (spot-check 5 baris acak) | Lolos |

## 3. Temuan & Perbaikan

Tidak ditemukan bug kritis pada saat pengujian akhir. Skenario error (file XML hilang atau typo nama file) sudah ditangani dengan baik melalui blok `try...catch` di `script.js`, sehingga tabel menampilkan pesan error yang jelas alih-alih layar kosong atau error di Console saja.

## 4. Bukti Pengujian

Screenshot proses dan hasil pengujian tersimpan di folder berikut:

- `bukti_test/Screenshot_xml/` — validasi struktur dan isi file XML
- `bukti_test/Screenshot_Final/` — hasil akhir tabel di browser

## 5. Kesimpulan

Aplikasi berjalan sesuai spesifikasi tugas: data dari `karakter.xml` (19 entri) berhasil dibaca dan ditampilkan seluruhnya ke tabel HTML tanpa error, lengkap dengan penanganan kegagalan pemuatan data. Aplikasi siap untuk didokumentasikan dalam laporan akhir.
