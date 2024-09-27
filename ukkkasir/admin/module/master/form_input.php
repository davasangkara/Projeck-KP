<!-- Form Input Master Barang -->
<form action="../module/master/tambah_barang.php" method="POST">
    <label>Nama Barang:</label>
    <input type="text" name="nama_barang"><br>
    <label>Kategori:</label>
    <input type="text" name="kategori"><br>
    <label>Harga:</label>
    <input type="text" name="harga"><br>
    <label>Stok:</label>
    <input type="text" name="stok"><br>
    <input type="submit" value="Tambah Barang">
</form>

<!-- Form Input Barang Masuk -->
<form action="../module/master/tambah_barang_masuk.php" method="POST">
    <label>ID Barang:</label>
    <input type="text" name="id_barang"><br>
    <label>Jumlah Masuk:</label>
    <input type="text" name="jumlah"><br>
    <label>Tanggal Masuk:</label>
    <input type="date" name="tanggal_masuk"><br>
    <input type="submit" value="Tambah Barang Masuk">
</form>

<!-- Form Input Barang Keluar -->
<form action="../module/master/tambah_barang_keluar.php" method="POST">
    <label>ID Barang:</label>
    <input type="text" name="id_barang"><br>
    <label>Jumlah Keluar:</label>
    <input type="text" name="jumlah"><br>
    <label>Tanggal Keluar:</label>
    <input type="date" name="tanggal_keluar"><br>
    <input type="submit" value="Tambah Barang Keluar">
</form>
