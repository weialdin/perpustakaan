<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Warna background halaman */
        }
        .form-container {
            width: 60%;
            margin: auto;
            margin-top: 5%;
        }
    </style>
</head>

<?php
	include_once("connect.php");
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>

<body>
    <div class="container d-flex justify-content-center">
        <div class="form-container card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add Buku</h4>
            </div>
            <div class="card-body">
                <form action="add.php" method="post" name="form1">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul">
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" name="tahun" id="tahun">
                    </div>
                    <div class="mb-3">
                        <label for="id_penerbit" class="form-label">Penerbit</label>
                        <select class="form-select" name="id_penerbit" id="id_penerbit">
                            <?php 
                                while($penerbit_data = mysqli_fetch_array($penerbit)) {         
                                    echo "<option value='".$penerbit_data['id_penerbit']."'>".$penerbit_data['nama_penerbit']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_pengarang" class="form-label">Pengarang</label>
                        <select class="form-select" name="id_pengarang" id="id_pengarang">
                            <?php 
                                while($pengarang_data = mysqli_fetch_array($pengarang)) {         
                                    echo "<option value='".$pengarang_data['id_pengarang']."'>".$pengarang_data['nama_pengarang']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_katalog" class="form-label">Katalog</label>
                        <select class="form-select" name="id_katalog" id="id_katalog">
                            <?php 
                                while($katalog_data = mysqli_fetch_array($katalog)) {         
                                    echo "<option value='".$katalog_data['id_katalog']."'>".$katalog_data['nama']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty_stok" class="form-label">Qty Stok</label>
                        <input type="text" class="form-control" name="qty_stok" id="qty_stok">
                    </div>
                    <div class="mb-3">
                        <label for="harga_pinjam" class="form-label">Harga Pinjam</label>
                        <input type="text" class="form-control" name="harga_pinjam" id="harga_pinjam">
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
