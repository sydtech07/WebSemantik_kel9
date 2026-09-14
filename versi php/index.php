<?php
// ============================================================
// index.php — Bagian 3 (versi PHP): Menampilkan data XML ke tabel
// Tugas Kelompok 9 — Web Semantik
// ============================================================

// 1. Fungsi bantu: ubah "Sangat Sulit" -> "badge-sangatsulit"
function getBadgeClass($tingkat) {
    $key = strtolower(str_replace(' ', '', $tingkat));
    return "badge badge-$key";
}

// 2. Baca file XML lalu ubah jadi objek PHP yang mudah diakses
//    simplexml_load_file() adalah fungsi bawaan PHP khusus untuk parsing XML
$karakterList = [];
$errorMessage = null;

if (!file_exists('karakter.xml')) {
    $errorMessage = "File karakter.xml tidak ditemukan.";
} else {
    // @ dipakai supaya warning bawaan PHP tidak tampil, karena error sudah kita tangani manual
    $xml = @simplexml_load_file('karakter.xml');

    if ($xml === false) {
        $errorMessage = "Gagal membaca / parsing file XML. Pastikan formatnya valid.";
    } else {
        // 3. $xml->karakter otomatis berisi semua elemen <karakter> sebagai array objek
        $karakterList = $xml->karakter;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Karakter Mobile Legends</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header class="page-header">
    <h1>Data Karakter Mobile Legends</h1>
    <p>Ditampilkan dari file <code>karakter.xml</code> menggunakan PHP</p>
  </header>

  <main class="container">
    <div class="table-wrapper">
      <table id="karakter-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Tipe Serangan</th>
            <th>Lane</th>
            <th>Tingkat Kesulitan</th>
            <th>Skill</th>
            <th>Profil</th>
          </tr>
        </thead>
        <tbody id="table-body">
          <?php if ($errorMessage): ?>
            <!-- 4a. Kalau ada error, tampilkan pesan error di tabel -->
            <tr>
              <td colspan="8" style="text-align:center; color:#ff8080;">
                Gagal memuat data: <?php echo htmlspecialchars($errorMessage); ?>
              </td>
            </tr>
          <?php else: ?>
            <?php
            // 4b. Looping setiap <karakter>, langsung dicetak jadi <tr>
            //     Ini dikerjakan di server, HTML jadinya sudah lengkap saat sampai ke browser
            $no = 1;
            foreach ($karakterList as $k):
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($k->nama); ?></td>
                <td><?php echo htmlspecialchars($k->role); ?></td>
                <td><?php echo htmlspecialchars($k->tipe_serangan); ?></td>
                <td><?php echo htmlspecialchars($k->lane); ?></td>
                <td>
                  <span class="<?php echo getBadgeClass($k->tingkat_kesulitan); ?>">
                    <?php echo htmlspecialchars($k->tingkat_kesulitan); ?>
                  </span>
                </td>
                <td><?php echo htmlspecialchars($k->skill); ?></td>
                <td><?php echo htmlspecialchars($k->profil); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="page-footer">
    <p>Tugas Kelompok 9 — Web Semantik</p>
  </footer>

</body>
</html>