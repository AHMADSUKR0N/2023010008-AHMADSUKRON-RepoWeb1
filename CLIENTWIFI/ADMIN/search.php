<?php
include "db.php";

// Perbarui status klien berdasarkan tanggal kedaluwarsa
$updateExpiredClients = "UPDATE client SET checked = 0 WHERE expiration_date <= CURDATE() AND checked = 1";
mysqli_query($conn, $updateExpiredClients);

// Proses update jika ada data yang dicentang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checked_clients'])) {
    foreach ($_POST['checked_clients'] as $clientId) {
        $clientId = intval($clientId);

        // Ambil tanggal pemasangan
        $queryGetDate = "SELECT tanggalpasang FROM client WHERE id = $clientId";
        $resultDate = mysqli_query($conn, $queryGetDate);
        $row = mysqli_fetch_assoc($resultDate);

        if ($row) {
            $tanggalpasang = $row['tanggalpasang'];
            $expiration_date = date('Y-m-d', strtotime($tanggalpasang . ' +30 days'));

            // Update status checked dan expiration_date
            $updateQuery = "UPDATE client SET checked = 1, expiration_date = '$expiration_date' WHERE id = $clientId";
            mysqli_query($conn, $updateQuery);
        }
    }
}

// Mencari data jika ada parameter pencarian
$searchQuery = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $searchQuery = "WHERE nama LIKE '%$search%' OR alamat LIKE '%$search%' OR hp LIKE '%$search%' OR odp LIKE '%$search%' OR noip LIKE '%$search%'";
}

$sql = "SELECT * FROM client $searchQuery ORDER BY id DESC";  // Order by ID to ensure data is up-to-date
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="ASSET/IMAGE/ldplogo.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Client</h1>
        <!-- Tombol Navigasi -->
        <div class="mb-3">
            <a href="home.php" class="btn btn-info">Menu CRUD</a>
            <a href="clients_checked.php" class="btn btn-success">Lihat Klien Aktif</a>
            <a href="clients_unchecked.php" class="btn btn-warning">Lihat Klien Tidak Aktif</a>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari klien..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <!-- Tabel Daftar Klien -->
        <form method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pilih</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>ODP</th>
                        <th>Nomor IP</th>
                        <th>Tipe Modem</th>
                        <th>Langganan</th>
                        <th>Tanggal Pasang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['checked'] ? "Aktif" : "Tidak Aktif";
                            $statusClass = $row['checked'] ? "text-success" : "text-danger";

                            echo "<tr>
                                    <td>{$no}</td>
                                    <td>
                                        <input type='checkbox' name='checked_clients[]' value='{$row['id']}' " . ($row['checked'] ? "disabled" : "") . ">
                                    </td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['alamat']}</td>
                                    <td>{$row['hp']}</td>
                                    <td>{$row['odp']}</td>
                                    <td>{$row['noip']}</td>
                                    <td>{$row['tipemodem']}</td>
                                    <td>{$row['langganan']}</td>
                                    <td>{$row['tanggalpasang']}</td>
                                    <td class='{$statusClass}'>{$status}</td>
                                </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='11'>Tidak ada data yang ditemukan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Simpan yang Dicentang</button>
        </form>
    </div>
    <footer class="blockquote-footer fixed-bottom">RPL A POLIBANG
            BY RPL A 2023 <cite title="Source Title"><a
                    href="https://syukron.rpla2023.com/"
                    target="_blank">syukron.rpla2023.com</a></cite></footer>
</body>
</html>
