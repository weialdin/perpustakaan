<?php
    include_once("connect.php");
    session_start();

    // Ambil ISBN dari query parameter
    $isbn = $_GET['isbn'];

    // Mengambil data buku, penerbit, pengarang, dan katalog
    $buku = mysqli_query($mysqli, "SELECT * FROM buku WHERE isbn='$isbn'");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");

    // Fetch data buku untuk mengisi form
    $buku_data = mysqli_fetch_array($buku);
    $judul = $buku_data['judul'];
    $tahun = $buku_data['tahun'];
    $id_penerbit = $buku_data['id_penerbit'];
    $id_pengarang = $buku_data['id_pengarang'];
    $id_katalog = $buku_data['id_katalog'];
    $qty_stok = $buku_data['qty_stok'];
    $harga_pinjam = $buku_data['harga_pinjam'];

    // Update data buku jika form disubmit
    if (isset($_POST['update'])) {
        $judul = $_POST['judul'];
        $tahun = $_POST['tahun'];
        $id_penerbit = $_POST['id_penerbit'];
        $id_pengarang = $_POST['id_pengarang'];
        $id_katalog = $_POST['id_katalog'];
        $qty_stok = $_POST['qty_stok'];
        $harga_pinjam = $_POST['harga_pinjam'];

        $result = mysqli_query($mysqli, "UPDATE buku SET judul='$judul', tahun='$tahun', id_penerbit='$id_penerbit', id_pengarang='$id_pengarang', id_katalog='$id_katalog', qty_stok='$qty_stok', harga_pinjam='$harga_pinjam' WHERE isbn='$isbn'");

        if ($result) {
            $_SESSION['message'] = "Yey, buku berhasil di update!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating book: " . mysqli_error($mysqli);
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
    <title>Edit Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .form-container {
            max-width: 600px;
            margin: 5% auto;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container form-container card shadow p-4">
        <h3 class="text-center mb-4">Edit Buku</h3>

        <a href="index.php" class="btn btn-outline-primary mb-3">Go to Home</a>
        
        <!-- Form Edit Buku -->
        <form action="edit.php?isbn=<?php echo $isbn; ?>" method="post">
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" value="<?php echo $isbn; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $judul; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_penerbit" class="form-label">Penerbit</label>
                <select class="form-select" name="id_penerbit" id="id_penerbit">
                    <?php while($penerbit_data = mysqli_fetch_array($penerbit)) { ?>
                        <option value="<?php echo $penerbit_data['id_penerbit']; ?>" <?php if($penerbit_data['id_penerbit'] == $id_penerbit) echo 'selected'; ?>>
                            <?php echo $penerbit_data['nama_penerbit']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_pengarang" class="form-label">Pengarang</label>
                <select class="form-select" name="id_pengarang" id="id_pengarang">
                    <?php while($pengarang_data = mysqli_fetch_array($pengarang)) { ?>
                        <option value="<?php echo $pengarang_data['id_pengarang']; ?>" <?php if($pengarang_data['id_pengarang'] == $id_pengarang) echo 'selected'; ?>>
                            <?php echo $pengarang_data['nama_pengarang']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_katalog" class="form-label">Katalog</label>
                <select class="form-select" name="id_katalog" id="id_katalog">
                    <?php while($katalog_data = mysqli_fetch_array($katalog)) { ?>
                        <option value="<?php echo $katalog_data['id_katalog']; ?>" <?php if($katalog_data['id_katalog'] == $id_katalog) echo 'selected'; ?>>
                            <?php echo $katalog_data['nama']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="qty_stok" class="form-label">Qty Stok</label>
                <input type="text" class="form-control" name="qty_stok" id="qty_stok" value="<?php echo $qty_stok; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_pinjam" class="form-label">Harga Pinjam</label>
                <input type="text" class="form-control" name="harga_pinjam" id="harga_pinjam" value="<?php echo $harga_pinjam; ?>" required>
            </div>
            <div class="d-grid">
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>
