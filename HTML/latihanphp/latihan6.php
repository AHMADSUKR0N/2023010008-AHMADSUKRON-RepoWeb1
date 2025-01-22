<html>
    <head>
        <title>Aplikasi PHP</title>
    </head>
    
    <body>
    <!-- Buatlah program php dengan memanfaatkan 4 konsep tipe data dalam satu program. -->
    <?php
// Tipe data String
$nama = "Ahmad Sukron";
$kampus = "Politeknik Balekambang";

// Tipe data Integer
$nim = 2023010008;
$angkatan = 2023;

// Tipe data Float
$ipk = 3.75;

// Tipe data Array
$hobi = array("Coding", "Membaca", "Bermain Game");

// Menampilkan data menggunakan echo
echo "<h1>Data Mahasiswa</h1>";
echo "<p><strong>Nama:</strong> $nama</p>";
echo "<p><strong>Kampus:</strong> $kampus</p>";
echo "<p><strong>NIM:</strong> $nim</p>";
echo "<p><strong>Angkatan:</strong> $angkatan</p>";
echo "<p><strong>IPK:</strong> $ipk</p>";

echo "<h3>Hobi:</h3>";
echo "<ul>";
foreach ($hobi as $h) {
    echo "<li>$h</li>";
}
echo "</ul>";
?>

    </body>
</html>