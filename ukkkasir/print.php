<?php 
    @ob_start();
    session_start();
    if(!empty($_SESSION['admin'])){ 
        // User is authenticated
    } else {
        echo '<script>window.location="login.php";</script>';
        exit;
    }
    require 'config.php';
    include $view;
    $lihat = new view($config);
    $toko = $lihat->toko();
    $hsl = $lihat->penjualan();
?>
<html>
<head>
    <title>Print Struk</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <script>window.print();</script>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <center>
                    <p><strong><?php echo $toko['nama_toko']; ?></strong></p>
                    <p><?php echo $toko['alamat_toko']; ?></p>
                    <p>Tanggal: <?php echo date("j F Y, G:i"); ?></p>
                    <p>Kasir: <?php echo htmlentities($_GET['nm_member']); ?></p>
                </center>
                <table class="table table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($hsl as $isi) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $isi['nama_barang']; ?></td>
                            <td><?php echo $isi['jumlah']; ?></td>
                            <td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
                <div class="pull-right">
                    <?php $hasil = $lihat->jumlah(); ?>
                    <p><strong>Total: Rp.<?php echo number_format($hasil['bayar']); ?>,-</strong></p>
                    <p>Bayar: Rp.<?php echo number_format(htmlentities($_GET['bayar'])); ?>,-</p>
                    <p>Kembali: Rp.<?php echo number_format(htmlentities($_GET['kembali'])); ?>,-</p>
                </div>
                <div class="clearfix"></div>
                <center>
                    <p>Terima Kasih Telah Berbelanja di Toko Kami!</p>
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>
</html>
