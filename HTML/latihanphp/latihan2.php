<html>
    <head>
        <title>Aplikasi PHP</title>
    </head>
    
    <body>
    <!-- Buatlah program php yang menunjukkan bahwa program PHP akan membuat script
    menjadi lebih sederhana dan dinamis. -->
    <?php
// Membuat daftar produk (data dinamis)
$produk = [ // Array asosiatif yang berisi daftar produk
    ["nama" => "Laptop", "harga" => 15000000], // Produk pertama
    ["nama" => "Smartphone", "harga" => 5000000], // Produk kedua
    ["nama" => "Headset", "harga" => 250000], // Produk ketiga
    ["nama" => "Monitor", "harga" => 2000000], // Produk keempat
];

// Fungsi untuk menampilkan produk
function tampilkanProduk($produk) { // Fungsi untuk membuat tabel produk secara dinamis
    echo "<table border='1' cellpadding='5' cellspacing='0'>"; // Membuka tabel HTML
    echo "<tr><th>No</th><th>Nama Produk</th><th>Harga</th></tr>"; // Header tabel

    foreach ($produk as $key => $item) { // Perulangan untuk setiap produk dalam array
        echo "<tr>";
        echo "<td>" . ($key + 1) . "</td>"; // Kolom nomor urut
        echo "<td>" . $item["nama"] . "</td>"; // Kolom nama produk
        echo "<td>Rp " . number_format($item["harga"], 0, ',', '.') . "</td>"; // Kolom harga, diformat dengan ribuan
        echo "</tr>";
    }

    echo "</table>"; // Menutup tabel HTML
}

// Menampilkan daftar produk
echo "<h1>Daftar Produk</h1>"; // Judul halaman
tampilkanProduk($produk); // Memanggil fungsi untuk menampilkan tabel produk
?>


    </body>
</html>