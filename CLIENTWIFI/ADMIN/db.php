<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'dataclient';

// Establishing connection
$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$nama = $alamat = $hp = $odp = $noip = $tipemodem = $langganan = $tglpasang = $error = $sukses = '';
$op = isset($_GET['op']) ? $_GET['op'] : '';

if ($op == 'delete') {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM client WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $sukses = $stmt->execute() ? "Berhasil hapus data" : "Gagal melakukan delete data: " . $conn->error;
}

if ($op == 'edit') {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM client WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $r = $result->fetch_assoc();
    if ($r) {
        $nama = $r['nama'];
        $alamat = $r['alamat'];
        $hp = $r['hp'];
        $odp = $r['odp'];
        $noip = $r['noip'];
        $tipemodem = $r['tipemodem'];
        $langganan = $r['langganan'];
        $tglpasang = $r['tanggalpasang'];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $odp = $_POST['odp'];
    $noip = $_POST['noip'];
    $tipemodem = $_POST['tipemodem'];
    $langganan = $_POST['langganan'];
    $tglpasang = $_POST['tanggalpasang'];

    if ($nama && $alamat && $hp && $odp && $noip && $tipemodem && $langganan && $tglpasang) {
        if ($op == 'edit') {
            $sql = "UPDATE client SET nama = ?, alamat = ?, hp = ?, odp = ?, noip = ?, tipemodem = ?, langganan = ?, tanggalpasang = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssi', $nama, $alamat, $hp, $odp, $noip, $tipemodem, $langganan, $tglpasang, $id);
            $sukses = $stmt->execute() ? "Data berhasil diupdate" : "Data gagal diupdate: " . $conn->error;
        } else {
            $sql = "INSERT INTO client (nama, alamat, hp, odp, noip, tipemodem, langganan, tanggalpasang) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssss', $nama, $alamat, $hp, $odp, $noip, $tipemodem, $langganan, $tglpasang);
            $sukses = $stmt->execute() ? "Berhasil memasukkan data baru" : "Gagal memasukkan data: " . $conn->error;
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
