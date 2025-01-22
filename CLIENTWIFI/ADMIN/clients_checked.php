<?php
include "db.php";

// Query untuk mendapatkan klien aktif (checked = 1) dan belum kedaluwarsa
$sql = "SELECT * FROM client WHERE checked = 1 AND expiration_date > CURDATE()";
$result = mysqli_query($conn, $sql);

function calculate_days_left($expiration_date) {
    $current_date = new DateTime();
    $expire_date = new DateTime($expiration_date);
    $interval = $current_date->diff($expire_date);
    return $interval->format('%r%a');
}

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Proses pembaruan status jika ada data yang dicentang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checked_clients'])) {
    foreach ($_POST['checked_clients'] as $clientId) {
        $clientId = intval($clientId);

        // Ambil tanggal pemasangan untuk menentukan tanggal kedaluwarsa
        $queryGetDate = "SELECT tanggalpasang FROM client WHERE id = $clientId";
        $resultDate = mysqli_query($conn, $queryGetDate);
        $row = mysqli_fetch_assoc($resultDate);

        if ($row) {
            $tanggalpasang = $row['tanggalpasang'];
            $expiration_date = date('Y-m-d', strtotime($tanggalpasang . ' +30 days'));  // Tambahkan 30 hari pada tanggal pemasangan

            // Pembaruan status klien menjadi aktif dan perbarui tanggal kedaluwarsa
            $updateQuery = "UPDATE client SET checked = 1, expiration_date = '$expiration_date' WHERE id = $clientId";
            mysqli_query($conn, $updateQuery);
        }
    }

    // Redirect untuk memastikan data terbaru ditampilkan setelah pembaruan
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients Checked</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="ASSET/IMAGE/ldplogo.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h1>Client Sudah Dicentang</h1>
            <div>
                <a href="" class="btn btn-primary">
                    <i class="material-icons">&#xE863;</i> <span>Refresh List</span>
                </a>
                <a href="#" onclick="printClients()" class="btn btn-info">
                    <i class="material-icons">&#xE24D;</i> <span>Print</span>
                </a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor HP</th>
                    <th>ODP</th>
                    <th>Nomor IP</th>
                    <th>Tipe Modem</th>
                    <th>Langganan</th>
                    <th>Tanggal Pasang</th>
                    <th>Hari Lagi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $days_left = calculate_days_left($row['expiration_date']);
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['hp']}</td>
                                <td>{$row['odp']}</td>
                                <td>{$row['noip']}</td>
                                <td>{$row['tipemodem']}</td>
                                <td>{$row['langganan']}</td>
                                <td>{$row['tanggalpasang']}</td>
                                <td>" . ($days_left >= 0 ? "$days_left hari lagi" : "Sudah kedaluwarsa") . "</td>
                            </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>Tidak ada klien aktif.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="search.php" class="btn btn-secondary">Kembali</a>
    </div>
    <script src="ASSET/JS/cetakpdf.js"></script>
</body>
</html>
