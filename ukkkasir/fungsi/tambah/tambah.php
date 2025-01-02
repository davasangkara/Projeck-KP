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


    if (!empty($_GET['master_barang'])) {
        try {
            $config->beginTransaction();

            $idKategori = htmlentities($_POST['kategori']);
            $nama = htmlentities($_POST['nama']);
            $merk = htmlentities($_POST['merk']);
            $unitId = htmlentities($_POST['unit_id']);
            $type = htmlentities($_POST['type']);

            $dataBarang = [
                $idKategori,
                $nama,
                $merk,
                $unitId,
                $type
            ];

            $transactionSql = 'INSERT INTO barang (id_kategori, nama_barang, merk, unit_id, type) 
                               VALUES (?, ?, ?, ?, ?)';

            $barangStmt = $config->prepare($transactionSql);

            if (!$barangStmt->execute($dataBarang)) {
                throw new Exception("Gagal memasukkan data barang.");
            }

            $config->commit();
            echo '<script>window.location="../../index.php?page=master_barang&success=tambah-data"</script>';
        } catch (PDOException $e) {
            $config->rollBack();
            echo 'Kesalahan Database: ' . $e->getMessage();
        } catch (Exception $e) {
            $config->rollBack();
            echo 'Kesalahan: ' . $e->getMessage();
        }
    }

    if (!empty($_GET['stock'])) {
        try {
            $config->beginTransaction();

            $idBarang = htmlentities($_POST['barang']);
            $hargaBeli = htmlentities($_POST['harga_beli']);
            $hargaJual = htmlentities($_POST['harga_jual']);
            $stok = htmlentities($_POST['stok']);

            // $cekSql = 'SELECT * FROM transaksi WHERE barang_id = ? AND type = "IN" LIMIT 1';
            // $cekStmt = $config->prepare($cekSql);
            // $cekStmt->execute([$idBarang]);
            // $existingData = $cekStmt->fetch();

            // if ($existingData) {
            //     $updateSql = 'UPDATE transaksi SET 
            //                   harga_beli = ?, harga_jual = ?, stok = stok + ? 
            //                   WHERE barang_id = ? AND type = "IN"';
            //     $updateStmt = $config->prepare($updateSql);

            //     if (!$updateStmt->execute([$hargaBeli, $hargaJual, $stok, $idBarang])) {
            //         throw new Exception("Gagal memperbarui stok!");
            //     }
            // } else {
            //     $insertSql = 'INSERT INTO transaksi (type, harga_beli, harga_jual, stok, barang_id, created_at) 
            //                   VALUES ("IN", ?, ?, ?, ?, NOW())';
            //     $insertStmt = $config->prepare($insertSql);

            //     if (!$insertStmt->execute([$hargaBeli, $hargaJual, $stok, $idBarang])) {
            //         throw new Exception("Gagal menambah stok!");
            //     }
            // }
            // Masukin stok barang walaupun sama, jadi barang baru
            $insertSql = 'INSERT INTO transaksi (type, harga_beli, harga_jual, stok, barang_id, created_at) 
            VALUES ("IN", ?, ?, ?, ?, NOW())';
            $insertStmt = $config->prepare($insertSql);

            if (!$insertStmt->execute([$hargaBeli, $hargaJual, $stok, $idBarang])) {
                throw new Exception("Gagal menambah stok!");
            }

            $transaksiStockSql = 'INSERT INTO stok_transactions (type, harga_beli, harga_jual, stok, barang_id, transaction_date)
                                  VALUES("IN", ?, ?, ?, ?, NOW())';
            $transactionStockStmt = $config->prepare($transaksiStockSql);

            if (!$transactionStockStmt->execute([$hargaBeli, $hargaJual, $stok, $idBarang])) {
                throw new Exception("Gagal mencatat transaksi stok!");
            }

            $config->commit();
            echo '<script>window.location="../../index.php?page=stock&success=tambah-data"</script>';
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

        try {
            $sql = 'SELECT * FROM transaksi WHERE barang_id = ?';
            $row = $config->prepare($sql);
            $row->execute([$id]);
            $hsl = $row->fetch(PDO::FETCH_ASSOC);

            if ($hsl['stok'] > 0) {
                $kasir = $_GET['id_kasir'];
                $jumlah = 1;
                $total = $hsl['harga_jual'];
                $tgl = date("j F Y, G:i");

                $data1 = [
                    $id,
                    $kasir,
                    $jumlah,
                    $total,
                    $tgl
                ];

                $sql1 = 'INSERT INTO penjualan (barang_id, id_member, jumlah, total, tanggal_input) VALUES (?, ?, ?, ?, ?)';
                $row1 = $config->prepare($sql1);
                $row1->execute($data1);

                echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
            } else {
                echo '<script>alert("Stok Barang Anda Telah Habis !");
                      window.location="../../index.php?page=jual#keranjang"</script>';
            }
        } catch (PDOException $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");
                  window.location="../../index.php?page=jual"</script>';
        }
    }
}
