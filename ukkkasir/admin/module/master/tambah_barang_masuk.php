<?php
include('../konek.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    // Update stok barang di master_barang
    $sql_update_stok = "UPDATE master_barang SET stok = stok + $jumlah WHERE id_barang = $id_barang";
    $koneksi->query($sql_update_stok);

    // Insert data barang masuk
    $sql = "INSERT INTO barang_masuk (id_barang, jumlah, tanggal_masuk) VALUES ('$id_barang', '$jumlah', '$tanggal_masuk')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Barang masuk berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>
