<?php
include "db.php"
?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="icon" href="ASSET/IMAGE/ldplogo.png" type="image/x-icon">
    <link rel="stylesheet" href="ASSET/CSS/index.css">
</head>
<body>
    <!-- Body -->
    <div class="container mt-5">
        <h1>Daftar Client</h1>

        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="search.php" class="btn btn-info">Cari Client</a>
            </div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari klien..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <!-- Form untuk memasukkan atau mengedit data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php if ($error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php"); // Refresh halaman setelah 5 detik
                } ?>
                <?php if ($sukses) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses; ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                } ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hp" class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hp" name="hp" value="<?php echo $hp; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="odp" class="col-sm-2 col-form-label">ODP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="odp" name="odp" value="<?php echo $odp; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="noip" class="col-sm-2 col-form-label">Nomor IP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="noip" name="noip" value="<?php echo $noip; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tipemodem" class="col-sm-2 col-form-label">Tipe Modem</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tipemodem" name="tipemodem" value="<?php echo $tipemodem; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="langganan" class="col-sm-2 col-form-label">Langganan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="langganan" name="langganan" value="<?php echo $langganan; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggalpasang" class="col-sm-2 col-form-label">Tanggal Pasang</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggalpasang" name="tanggalpasang" value="<?php echo htmlspecialchars($tglpasang ?? ''); ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel untuk menampilkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Client
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">ODP</th>
                            <th scope="col">Nomor IP</th>
                            <th scope="col">Tipe Modem</th>
                            <th scope="col">Langganan</th>
                            <th scope="col">Tanggal Pasang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $sql2 = "SELECT * FROM client WHERE nama LIKE '%$search%' ORDER BY id DESC";
                    $q2 = mysqli_query($conn, $sql2);
                    $urut = 1;
                    while ($r2 = mysqli_fetch_array($q2)) {
                        $id         = $r2['id'];
                        $nama       = $r2['nama'];
                        $alamat     = $r2['alamat'];
                        $hp         = $r2['hp'];
                        $odp        = $r2['odp'];
                        $noip       = $r2['noip'];
                        $tipemodem  = $r2['tipemodem'];
                        $langganan  = $r2['langganan'];
                        $tglpasang  = $r2['tanggalpasang'];
                    ?>
                        <tr>
                            <th scope="row"><?php echo $urut++; ?></th>
                            <td><?php echo $nama; ?></td>
                            <td><?php echo $alamat; ?></td>
                            <td><?php echo $hp; ?></td>
                            <td><?php echo $odp; ?></td>
                            <td><?php echo $noip; ?></td>
                            <td><?php echo $tipemodem; ?></td>
                            <td><?php echo $langganan; ?></td>
                            <td><?php echo $tglpasang; ?></td>
                            <td>
                                <a href="index.php?op=edit&id=<?php echo $id; ?>">
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <a href="index.php?op=delete&id=<?php echo $id; ?>" onclick="return confirm('Yakin ingin menghapus data?')">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>

        <footer class="blockquote-footer fixed-bottom">RPL A POLIBANG
            BY RPL A 2023 <cite title="Source Title"><a
                    href="https://syukron.rpla2023.com/"
                    target="_blank">syukron.rpla2023.com</a></cite></footer>

</body>

</html>