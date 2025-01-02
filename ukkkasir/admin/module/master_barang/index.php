<h4>Data Barang</h4>
<br />
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
                    <th>Tipe</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->getAllMasterBarang();
                $no = 1;
                foreach ($hasil as $isi) {
                ?><tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $isi['nama_kategori']; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['merk']; ?></td>
                        <td><?php echo $isi['unit_name']; ?></td>
                        <td><?php echo $isi['type']; ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-edit-barang"
                                data-id="<?php echo $isi['id']; ?>"
                                data-kategori="<?php echo $isi['id_kategori']; ?>"
                                data-nama="<?php echo $isi['nama_barang']; ?>"
                                data-merk="<?php echo $isi['merk']; ?>"
                                data-unit="<?php echo $isi['unit_id']; ?>"
                                data-type="<?php echo $isi['type']; ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                <?php } ?>
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
                            <td>Type</td>
                            <td><input type="text" placeholder="Type" required class="form-control"
                                    name="type"></td>
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

<div id="editBarangModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#ffc107;color:#fff;">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formEditBarang" action="fungsi/edit/edit.php?master_barang=edit" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editBarangId">
                    <table class="table table-striped bordered">
                        <tr>
                            <td>Kategori</td>
                            <td>
                                <select name="kategori" id="editKategori" class="form-control" required>
                                    <option value="#">Pilih Kategori</option>
                                    <?php $kat = $lihat->kategori();
                                    foreach ($kat as $isi) { ?>
                                        <option value="<?php echo $isi['id_kategori']; ?>">
                                            <?php echo $isi['nama_kategori']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" name="nama" id="editNamaBarang" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td><input type="text" name="merk" id="editMerkBarang" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td><input type="text" name="type" id="editTypeBarang" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>
                                <select name="unit_id" id="editUnit" class="form-control" required>
                                    <option value="#">Pilih Unit</option>
                                    <?php $units = $lihat->getAllUnits();
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
                    <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Save Changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.btn-edit-barang', function() {
        const id = $(this).data('id');
        const kategori = $(this).data('kategori');
        const nama = $(this).data('nama');
        const merk = $(this).data('merk');
        const unit = $(this).data('unit');
        const type = $(this).data('type');

        $('#editBarangId').val(id);
        $('#editKategori').val(kategori);
        $('#editNamaBarang').val(nama);
        $('#editMerkBarang').val(merk);
        $('#editTypeBarang').val(type);
        $('#editUnit').val(unit);

        $('#editBarangModal').modal('show');
    });
</script>