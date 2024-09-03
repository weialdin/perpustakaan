<?php
include_once("connect.php");
session_start();

// Menangani pesan sesi untuk menampilkan notifikasi
if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    $msg_type = $_SESSION['msg_type'];
    unset($_SESSION['message']);
    unset($_SESSION['msg_type']);
}

// Mengambil data penerbit, pengarang, dan katalog untuk dropdown
$penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
$pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
$katalog = mysqli_query($mysqli, "SELECT * FROM katalog");

// Proses penambahan buku
if (isset($_POST['Submit'])) {
    $isbn = $_POST['isbn'];
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $id_penerbit = $_POST['id_penerbit'];
    $id_pengarang = $_POST['id_pengarang'];
    $id_katalog = $_POST['id_katalog'];
    $qty_stok = $_POST['qty_stok'];
    $harga_pinjam = $_POST['harga_pinjam'];

    // Menyimpan buku baru ke dalam database
    $result = mysqli_query($mysqli, "INSERT INTO buku (isbn, judul, tahun, id_penerbit, id_pengarang, id_katalog, qty_stok, harga_pinjam) VALUES ('$isbn', '$judul', '$tahun', '$id_penerbit', '$id_pengarang', '$id_katalog', '$qty_stok', '$harga_pinjam')");

    if ($result) {
        $_SESSION['message'] = "Horee, buku berhasil ditambahkan!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error adding book: " . mysqli_error($mysqli);
        $_SESSION['msg_type'] = "danger";
    }

    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <?php if (isset($msg)): ?>
        <div class="alert alert-<?php echo $msg_type; ?> alert-dismissible fade show" role="alert">
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-primary mb-3">Go to Home</a>

    <div class="card">
        <div class="card-header">
            <h4>Add Buku</h4>
        </div>
        <div class="card-body">
            <form action="add.php" method="post" name="form1">
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" name="isbn" id="isbn" required>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" required>
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="text" class="form-control" name="tahun" id="tahun" required>
                </div>
                <div class="mb-3">
                    <label for="id_penerbit" class="form-label">Penerbit</label>
                    <select class="form-select" name="id_penerbit" id="id_penerbit" required>
                        <?php while($penerbit_data = mysqli_fetch_array($penerbit)) { ?>
                            <option value="<?php echo $penerbit_data['id_penerbit']; ?>"><?php echo $penerbit_data['nama_penerbit']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_pengarang" class="form-label">Pengarang</label>
                    <select class="form-select" name="id_pengarang" id="id_pengarang" required>
                        <?php while($pengarang_data = mysqli_fetch_array($pengarang)) { ?>
                            <option value="<?php echo $pengarang_data['id_pengarang']; ?>"><?php echo $pengarang_data['nama_pengarang']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_katalog" class="form-label">Katalog</label>
                    <select class="form-select" name="id_katalog" id="id_katalog" required>
                        <?php while($katalog_data = mysqli_fetch_array($katalog)) { ?>
                            <option value="<?php echo $katalog_data['id_katalog']; ?>"><?php echo $katalog_data['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="qty_stok" class="form-label">Qty Stok</label>
                    <input type="text" class="form-control" name="qty_stok" id="qty_stok" required>
                </div>
                <div class="mb-3">
                    <label for="harga_pinjam" class="form-label">Harga Pinjam</label>
                    <input type="text" class="form-control" name="harga_pinjam" id="harga_pinjam" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="Submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>
