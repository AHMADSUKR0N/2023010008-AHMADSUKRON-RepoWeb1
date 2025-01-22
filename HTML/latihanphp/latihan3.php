<html>
    <head>
        <title>Aplikasi PHP</title>
    </head>
    
    <body>
    <!-- Buatlah program php dengan menggunakan minimal 5 varibel dan kombinasikan
    variable tersebut saat ditampilkan. -->
    <?php
// Mendefinisikan variabel
$nama = "SYUKRON"; // Nama seseorang
$umur = 20; // Umur seseorang
$pekerjaan = "Web Developer"; // Pekerjaan seseorang
$kota = "JEPARA"; // Kota tempat tinggal
$hobi = "PS"; // Hobi seseorang

// Menampilkan kombinasi variabel
echo "<h1>Profil Seseorang</h1>"; // Menampilkan judul "Profil Seseorang"
echo "<p>Halo, nama saya $nama. Saya berusia $umur tahun dan bekerja sebagai $pekerjaan.</p>"; // Menggabungkan $nama, $umur, dan $pekerjaan dalam kalimat
echo "<p>Saya tinggal di $kota dan hobi saya adalah $hobi.</p>"; // Menggabungkan $kota dan $hobi dalam kalimat

// Menggunakan variabel untuk kombinasi tambahan
$deskripsi = "$nama adalah seorang $pekerjaan yang berumur $umur tahun, tinggal di $kota, dan senang $hobi."; // Membuat kalimat deskripsi lengkap dengan menggabungkan semua variabel
echo "<p>$deskripsi</p>"; // Menampilkan deskripsi lengkap
?>

    </body>
</html>