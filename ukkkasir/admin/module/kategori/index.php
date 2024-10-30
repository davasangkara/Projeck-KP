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
<?php
if (!empty($_GET['uid'])) {
    $sql = "SELECT * FROM kategori WHERE id_kategori = ?";
    $row = $config->prepare($sql);
    $row->execute(array($_GET['uid']));
    $edit = $row->fetch();
?>
    <form method="POST" action="fungsi/edit/edit.php?kategori=edit">
        <table>
            <tr>
                <td style="width:25pc;">
                    <input type="text" class="form-control" value="<?= $edit['nama_kategori']; ?>" required name="kategori" placeholder="Masukan Kategori Barang Baru">
                    <input type="hidden" name="id" value="<?= $edit['id_kategori']; ?>">
                </td>
                <td style="padding-left:10px;">
                    <button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah Data</button>
                </td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <form method="POST" action="fungsi/tambah/tambah.php?kategori=tambah">
        <table>
            <tr>
                <td style="width:25pc;">
                    <input type="text" class="form-control" required name="kategori" placeholder="Masukan Kategori Barang Baru">
                </td>
                <td style="padding-left:10px;">
                    <button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
                </td>
            </tr>
        </table>
    </form>
<?php } ?>
<br />
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Tanggal Input</th>
                    <!-- <th>Status</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->kategori();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_kategori']; ?></td>
                        <td><?php echo $isi['tgl_input']; ?></td>
                        <!-- <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status" type="checkbox" role="switch" id="statusSwitch<?php echo $isi['id_kategori']; ?>"
                                <?php echo $isi['status'] ? 'checked' : ''; ?> data-id="<?php echo $isi['id_kategori']; ?>">
                            <label class="form-check-label" for="statusSwitch<?php echo $isi['id_kategori']; ?>">
                                <?php echo $isi['status'] ? 'Aktif' : 'Nonaktif'; ?>
                            </label>
                        </div>
                        </td> -->
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-status').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const kategoriId = this.getAttribute('data-id');
            const newStatus = this.checked ? 1 : 0;

            fetch('fungsi/edit/edit_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${kategoriId}&status=${newStatus}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status berhasil diperbarui!');
                    } else {
                        alert('Gagal memperbarui status.');
                    }
                });
        });
    });
</script>