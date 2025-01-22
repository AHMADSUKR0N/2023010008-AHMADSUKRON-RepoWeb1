<html>
    <head>
        <title>Aplikasi PHP</title>
    </head>
    <!-- Buatlah program php yang menunjukkan bahwa program PHP sensitive terhadap
besar kecil huruf. -->
    <body>
    <?php
// Case-sensitive pada variabel
$nama = "Ali";
$Nama = "Budi";

echo "Variabel \$nama: " . $nama . "<br>"; // Mengakses $nama
echo "Variabel \$Nama: " . $Nama . "<br>"; // Mengakses $Nama

// Case-insensitive pada fungsi bawaan PHP
echo "<br>Fungsi bawaan PHP case-insensitive:<br>";
echo strToUpper("hello") . "<br>"; // Fungsi strtoupper (ditulis dengan huruf besar kecil acak)
echo STRTOUPPER("world") . "<br>"; // Fungsi strtoupper dengan semua huruf kapital
?>

    </body>
</html>