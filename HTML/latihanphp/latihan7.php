<html>
    <head>
        <title>Aplikasi PHP</title>
    </head>
    
    <body>
    <!-- Buatlah program php dengan menggunakan Operator untuk menampilkan seperti
berikut: -->
<?php
// Operator Aritmatika
$angka1 = 10;
$angka2 = 5;
$penjumlahan = $angka1 + $angka2;
$pengurangan = $angka1 - $angka2;
$perkalian = $angka1 * $angka2;
$pembagian = $angka1 / $angka2;

// Operator Perbandingan
$is_equal = $angka1 == $angka2;
$is_greater = $angka1 > $angka2;

// Operator Logika
$is_between = ($angka1 > 0) && ($angka2 > 0);

// Operator Penugasan
$hasil = $angka1; // Menyalin nilai
$hasil += $angka2; // Penjumlahan dan assignment

// Menampilkan hasil menggunakan echo
echo "<h1>Demonstrasi Operator di PHP</h1>";

echo "<h3>Operator Aritmatika</h3>";
echo "<p>Penjumlahan ($angka1 + $angka2): $penjumlahan</p>";
echo "<p>Pengurangan ($angka1 - $angka2): $pengurangan</p>";
echo "<p>Perkalian ($angka1 * $angka2): $perkalian</p>";
echo "<p>Pembagian ($angka1 / $angka2): $pembagian</p>";

echo "<h3>Operator Perbandingan</h3>";
echo "<p>Apakah $angka1 sama dengan $angka2? " . ($is_equal ? "Ya" : "Tidak") . "</p>";
echo "<p>Apakah $angka1 lebih besar dari $angka2? " . ($is_greater ? "Ya" : "Tidak") . "</p>";

echo "<h3>Operator Logika</h3>";
echo "<p>Apakah $angka1 dan $angka2 keduanya lebih besar dari 0? " . ($is_between ? "Ya" : "Tidak") . "</p>";

echo "<h3>Operator Penugasan</h3>";
echo "<p>Nilai hasil setelah operasi penugasan: $hasil</p>";
?>

    </body>
</html>