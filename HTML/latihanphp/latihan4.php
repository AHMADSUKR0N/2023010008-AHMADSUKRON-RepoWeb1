<html>
    <head>
        <title>Aplikasi PHP</title>
    </head>
    
    <body>
    <!-- Buatlah program php dengan menggunakan lingkup varibel local dan global. -->
    <?php
// Variabel global
$globalVar = "Ini adalah variabel global."; // Variabel global dideklarasikan di luar fungsi

function contohFungsi() {
    // Variabel lokal
    $localVar = "Ini adalah variabel lokal."; // Variabel lokal hanya dapat diakses di dalam fungsi ini

    // Menampilkan variabel lokal
    echo "Variabel Lokal: " . $localVar . "<br>"; // Menampilkan variabel lokal di dalam fungsi

    // Menampilkan variabel global dengan global keyword
    global $globalVar; // Mengakses variabel global menggunakan kata kunci 'global'
    echo "Variabel Global: " . $globalVar . "<br>"; // Menampilkan variabel global
}

// Memanggil fungsi
contohFungsi(); // Fungsi dipanggil untuk menjalankan kode di dalamnya

// Menampilkan variabel global di luar fungsi
echo "Variabel Global di luar fungsi: " . $globalVar . "<br>"; // Variabel global tetap dapat diakses di luar fungsi

// Mengakses variabel lokal di luar fungsi akan menyebabkan error
// echo "Variabel Lokal di luar fungsi: " . $localVar; // Ini akan menghasilkan error karena variabel lokal hanya berlaku di dalam fungsi
?>

    </body>
</html>