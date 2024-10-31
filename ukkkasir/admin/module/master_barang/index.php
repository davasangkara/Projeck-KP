<h4>Data Barang</h4>
<br />
<?php if (isset($_GET['success-stok'])) { ?>
    <div class="alert alert-success">
        <p>Tambah Stok Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Tambah Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil !</p>
    </div>
<?php } ?>

<button type="button" class="btn btn-primary btn-md mr-2 mb-2" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus"></i> Insert Data</button>

<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Satuan</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->getAllMasterBarang();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $isi['nama_kategori']; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['merk']; ?></td>
                        <td> <?php echo $isi['unit_name']; ?></td>
                    <?php
                }
                    ?>
            </tbody>
        </table>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#285c64;color:#fff;">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="fungsi/tambah/tambah.php?master_barang=tambah" method="POST">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        <tr>
                            <td>Kategori</td>
                            <td>
                                <select name="kategori" class="form-control" required>
                                    <option value="#">Pilih Kategori</option>
                                    <?php $kat = $lihat->kategori();
                                    foreach ($kat as $isi) {     ?>
                                        <option value="<?php echo $isi['id_kategori']; ?>">
                                            <?php echo $isi['nama_kategori']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" placeholder="Nama Barang" required class="form-control"
                                    name="nama"></td>
                        </tr>
                        <tr>
                            <td>Merk Barang</td>
                            <td><input type="text" placeholder="Merk Barang" required class="form-control"
                                    name="merk"></td>
                        </tr>
                        <tr>
                            <td>Unit Barang</td>
                            <td>
                                <select name="unit_id" class="form-control" required>
                                    <option value="#">Pilih unit</option>
                                    <?php
                                    $units = $lihat->getAllUnits();
                                    foreach ($units as $unit) { ?>
                                        <option value="<?php echo $unit['id']; ?>">
                                            <?php echo $unit['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
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