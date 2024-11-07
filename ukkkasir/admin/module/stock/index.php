<h4>Kategori</h4>
<br />
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Tambah Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['success-edit'])) { ?>
    <div class="alert alert-success">
        <p>Update Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil !</p>
    </div>
<?php } ?>

<button type="button" class="btn btn-primary btn-md mr-2 mb-2" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus"></i>Stock In</button>
<br />
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="example1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Type Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->getBarangStockTransaction();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['barang_type']; ?></td>
                        <td><?php echo $isi['harga_beli']; ?></td>
                        <td><?php echo $isi['harga_jual']; ?></td>
                        <td><?php echo $isi['stok']; ?></td>
                        <td><?php echo date("d F Y", strtotime($isi['created_at'])); ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Stock IN</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/tambah/tambah.php?stock=tambah" method="POST">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        <tr>
                            <td>Stock in barang</td>
                            <td>
                                <select name="barang" class="form-control" required>
                                    <option value="#" disabled selected>Pilih Barang - Type</option>
                                    <?php $barang = $lihat->getAllMasterBarang();
                                    foreach ($barang as $isi) {     ?>
                                        <option value="<?php echo $isi['id']; ?>">
                                            <?php echo $isi['nama_barang'] . " - " . $isi['type']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Harga Beli</td>
                            <td><input type="number" placeholder="Harga Beli" required class="form-control"
                                    name="harga_beli"></td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td><input type="number" placeholder="Harga Jual" required class="form-control"
                                    name="harga_jual"></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td><input type="number" placeholder="Jumlah" required class="form-control"
                                    name="stok"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                        Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

</div>