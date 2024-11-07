<h4>Laporan Barang Keluar</h4>

<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Type Barang</th>
                    <th>Stok Keluar</th>
                    <th>Harga Jual</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->getAllTransactionStockOut();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['barang_type']; ?></td>
                        <td><?php echo $isi['stok']; ?></td>
                        <td><?php echo $isi['harga_jual']; ?></td>
                        <td><?php echo date("d F Y", strtotime($isi['transaction_date'])); ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <a href="stock_out_to_excel.php" class="btn btn-info"><i class="fa fa-download"></i>
            Export to Excel</a>

    </div>
</div>