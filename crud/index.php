<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<?php
    include_once("connect.php");
    $buku = mysqli_query($mysqli, "SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku
    LEFT JOIN pengarang ON pengarang.id_pengarang = buku.id_pengarang
    LEFT JOIN penerbit ON penerbit.id_penerbit = buku.id_penerbit
    LEFT JOIN katalog ON katalog.id_katalog = buku.id_katalog
    ORDER BY judul ASC");

    // Start session untuk menampilkan pesan
    session_start();
?>

<body class="bg-light">

    <!-- Menu Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Buku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Penerbit</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pengarang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Catalog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <!-- Notifikasi pesan sukses atau error -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); 
                    unset($_SESSION['msg_type']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Header dan Button Add New Book -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-center">Daftar Buku</h2>
            <a href="add.php" class="btn btn-primary">Add New Book</a>
        </div>

        <!-- Tabel untuk menampilkan data buku -->
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Katalog</th>
                    <th>Stok</th>
                    <th>Harga Pinjam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($buku_data = mysqli_fetch_array($buku)) {
                        echo "<tr>";
                        echo "<td>".$buku_data['isbn']."</td>";
                        echo "<td>".$buku_data['judul']."</td>";
                        echo "<td>".$buku_data['tahun']."</td>";
                        echo "<td>".$buku_data['nama_pengarang']."</td>";
                        echo "<td>".$buku_data['nama_penerbit']."</td>";
                        echo "<td>".$buku_data['nama_katalog']."</td>";
                        echo "<td>".$buku_data['qty_stok']."</td>";
                        echo "<td>".$buku_data['harga_pinjam']."</td>";
                        echo "<td>
                                <a href='edit.php?isbn=$buku_data[isbn]' class='btn btn-warning btn-sm'>Edit</a> 
                                <a href='delete.php?isbn=$buku_data[isbn]' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah anda yakin ingin menghapus buku ini?\");'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>
