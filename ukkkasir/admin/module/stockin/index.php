<h4>Barang Masuk</h4>

<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->getAllTransactionStockIn();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['stok']; ?></td>
                        <td><?php echo $isi['harga_beli']; ?></td>
                        <td><?php echo $isi['harga_jual']; ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <a href="stock_in_to_excel.php" class="btn btn-info"><i class="fa fa-download"></i>
            Export to Excel</a>

    </div>
</div>