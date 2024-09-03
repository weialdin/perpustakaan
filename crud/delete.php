<?php
include_once("connect.php");

$isbn = $_GET['isbn'];

// Hapus entri terkait dari tabel 'detail_peminjaman' terlebih dahulu
mysqli_query($mysqli, "DELETE FROM detail_peminjaman WHERE isbn='$isbn'");

// Kemudian hapus dari tabel 'buku'
$result = mysqli_query($mysqli, "DELETE FROM buku WHERE isbn='$isbn'");

if ($result) {
    session_start();
    $_SESSION['message'] = "Yah, buku berhasil di hapus :)!";
    $_SESSION['msg_type'] = "success";
} else {
    session_start();
    $_SESSION['message'] = "Error deleting book: " . mysqli_error($mysqli);
    $_SESSION['msg_type'] = "danger";
}

// Redirect ke Home setelah menghapus
header("Location:index.php");
exit();
?>
