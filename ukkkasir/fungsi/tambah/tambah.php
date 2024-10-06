<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty($_GET['kategori'])) {
        $nama = htmlentities(htmlentities($_POST['kategori']));
        $tgl = date("j F Y, G:i");
        $data[] = $nama;
        $data[] = $tgl;
        $sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
    }

    if (!empty($_GET['barang'])) {
        try {
            $config->beginTransaction();

            $idBarang = htmlentities($_POST['id_barang']);
            $idKategori = htmlentities($_POST['kategori']);
            $nama = htmlentities($_POST['nama']);
            $merk = htmlentities($_POST['merk']);
            $beli = htmlentities($_POST['beli']);
            $jual = htmlentities($_POST['jual']);
            $stok = htmlentities($_POST['stok']);
            $unitId = htmlentities($_POST['unit_id']);
            $price = htmlentities($_POST['beli']);
            $value = htmlentities($_POST['stok']);

            $dataBarang = [
                $idBarang,
                $idKategori,
                $nama,
                $merk,
                $beli,
                $jual,
                $unitId,
                $stok
            ];

            $sql = 'INSERT INTO barang (id_barang, id_kategori,nama_barang, merk, harga_beli, harga_jual, unit_id,stok) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

            $barangStmt = $config->prepare($sql);

            if (!$barangStmt->execute($dataBarang)) {
                throw new Exception("Gagal memasukkan data barang.");
            }

            $barangId = $config->lastInsertId();

            $stockInSql = 'INSERT INTO transactions (barang_id, price, qty, type,transaction_date) 
                           VALUES (?, ?, ?, "IN",NOW())';

            $stockInStmt = $config->prepare($stockInSql);

            $dataStockIn = [$barangId, $price, $stok];

            if (!$stockInStmt->execute($dataStockIn)) {
                throw new Exception("Gagal memasukkan data stock_in.");
            }

            $config->commit();
            echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
        } catch (PDOException $e) {
            $config->rollBack();
            echo 'Kesalahan Database: ' . $e->getMessage();
        } catch (Exception $e) {
            $config->rollBack();
            echo 'Kesalahan: ' . $e->getMessage();
        }
    }

    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];

        // get tabel barang id_barang
        $sql = 'SELECT * FROM barang WHERE id_barang = ?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        $hsl = $row->fetch();

        if ($hsl['stok'] > 0) {
            $kasir =  $_GET['id_kasir'];
            $jumlah = 1;
            $total = $hsl['harga_jual'];
            $tgl = date("j F Y, G:i");

            $data1[] = $id;
            $data1[] = $kasir;
            $data1[] = $jumlah;
            $data1[] = $total;
            $data1[] = $tgl;

            $sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
            $row1 = $config->prepare($sql1);
            $row1->execute($data1);

            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }
}
