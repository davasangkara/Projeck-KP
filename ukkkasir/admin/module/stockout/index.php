<h4>Laporan Barang Keluar</h4>

<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Type Barang</th>
                    <th>Merk</th>
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
                        <td><?php echo $isi['merk']; ?></td>
                        <td><?php echo $isi['stok']; ?></td>
                        <td><?php echo $isi['harga_jual']; ?></td>
                        <td><?php echo date("d F Y", strtotime($isi['transaction_date'])); ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <form action="stock_out_to_excel.php" method="GET" class="form-inline">
            <label for="bulan">Bulan:</label>
            <select name="bulan" id="bulan" class="form-control ml-2">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            <label for="tahun">Tahun:</label>
            <select name="tahun" id="tahun" class="form-control ml-1">
                <?php
                $currentYear = date("Y");
                for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn btn-info ml-1">
                <i class="fa fa-download"></i> Export to Excel
            </button>
        </form>


    </div>
</div>