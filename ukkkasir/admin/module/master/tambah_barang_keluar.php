<?php
include('../konek.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    // Cek apakah stok mencukupi
    $result = $koneksi->query("SELECT stok FROM master_barang WHERE id_barang = $id_barang");
    $barang = $result->fetch_assoc();

    if ($barang['stok'] >= $jumlah) {
        // Update stok barang di master_barang
        $sql_update_stok = "UPDATE master_barang SET stok = stok - $jumlah WHERE id_barang = $id_barang";
        $koneksi->query($sql_update_stok);

        // Insert data barang keluar
        $sql = "INSERT INTO barang_keluar (id_barang, jumlah, tanggal_keluar) VALUES ('$id_barang', '$jumlah', '$tanggal_keluar')";

        if ($koneksi->query($sql) === TRUE) {
            echo "Barang keluar berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        echo "Stok tidak mencukupi.";
    }
}
?>
