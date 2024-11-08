 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->

 <?php
	$id = $_SESSION['admin']['id_member'];
	$hasil = $lihat->member_edit($id);
	?>
 <h4>Keranjang Penjualan</h4>
 <br>
 <?php if (isset($_GET['success'])) { ?>
 	<div class="alert alert-success">
 		<p>Tambah Barang Berhasil !</p>
 	</div>
 <?php } ?>
 <?php if (isset($_GET['remove'])) { ?>
 	<div class="alert alert-danger">
 		<p>Hapus Barang Berhasil !</p>
 	</div>
 <?php } ?>


 <div class="row">
 	<div class="col-sm-4">
 		<div class="card card-primary mb-3">
 			<div class="card-header bg-primary text-white">
 				<h5><i class="fa fa-search"></i> Cari Barang</h5>
 			</div>
 			<div class="card-body">
 				<input type="text" id="cari" class="form-control" name="cari"
 					placeholder="Masukan : Kode / Nama Barang  [ENTER]">
 			</div>
 		</div>
 	</div>
 	<div class="col-sm-8">
 		<div class="card card-primary mb-3">
 			<div class="card-header bg-primary text-white">
 				<h5><i class="fa fa-list"></i> Hasil Pencarian</h5>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<div id="hasil_cari"></div>
 					<div id="tunggu"></div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!---Kasir dimulai dari sini-->

 	<div class="col-sm-12">
 		<div class="card card-primary">
 			<div class="card-header bg-primary text-white">
 				<h5><i class="fa fa-shopping-cart"></i> KASIR
 					<a class="btn btn-danger float-right"
 						onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');"
 						href="fungsi/hapus/hapus.php?penjualan=jual">
 						<b>RESET KERANJANG</b></a>
 				</h5>
 			</div>
 			<div class="card-body">
 				<div id="keranjang" class="table-responsive">
 					<table class="table table-bordered">
 						<tr>
 							<td><b>Tanggal</b></td>
 							<td><input type="text" readonly="readonly" class="form-control"
 									value="<?php echo date("j F Y, G:i"); ?>" name="tgl"></td>
 						</tr>
 					</table>
 					<table class="table table-bordered w-100" id="example1">
 						<thead>
 							<tr>
 								<td> No</td>
 								<td> Nama Barang</td>
 								<td> Merk </td>
 								<td> Type</td>
 								<td style="width:10%;"> Jumlah</td>
 								<td> Total</td>
 								<td> Kasir</td>
 								<td> Aksi</td>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$total_bayar = 0;
								$no = 1;
								$hasil_penjualan = $lihat->penjualan(); ?>
 							<?php foreach ($hasil_penjualan  as $isi) { ?>
 								<tr>
 									<td><?php echo $no; ?></td>
 									<td><?php echo $isi['nama_barang']; ?></td>
 									<td><?php echo $isi['merk']; ?></td>
 									<td><?php echo $isi['type']; ?></td>
 									<td>

 										<form method="POST" action="fungsi/edit/edit.php?jual=jual">
 											<input type="number" name="jumlah" value="<?php echo $isi['jumlah']; ?>"
 												class="form-control">
 											<input type="hidden" name="id" value="<?php echo $isi['id_penjualan']; ?>"
 												class="form-control">
 											<input type="hidden" name="barang_id" value="<?php echo $isi['barang_id']; ?>"
 												class="form-control">
 									</td>
 									<td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
 									<td><?php echo $isi['nm_member']; ?></td>
 									<td>
 										<button type="submit" class="btn btn-warning">Update</button>
 										</form>
 										<a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['barang_id']; ?>
											&jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger"><i class="fa fa-times"></i>
 										</a>
 									</td>
 								</tr>
 							<?php $no++;
									$total_bayar += $isi['total'];
								} ?>
 						</tbody>
 					</table>
 					<br />
 					<!----ini buat bayar start-->
 					<?php $hasil = $lihat->jumlah(); ?>
 					<div id="kasirnya">
 						<table class="table table-stripped">
 							<?php
								try {
									if (!empty($_GET['nota'] == 'yes')) {
										try {
											$total = $_POST['total'];
											$bayar = $_POST['bayar'];

											if (!empty($bayar)) {
												$hitung = $bayar - $total;

												if ($bayar >= $total) {
													try {
														$nama_barang = $_POST['nama_barang'];
														$barang_id = $_POST['barang_id'];
														$id_member = $_POST['id_member'];
														$jumlah = $_POST['jumlah'];
														$total = $_POST['total1'];
														$tgl_input = $_POST['tgl_input'];
														$periode = $_POST['periode'];
														$jumlah_dipilih = count($barang_id);
														$config->beginTransaction();

														for ($x = 0; $x < $jumlah_dipilih; $x++) {
															try {
																$d = array($barang_id[$x], $nama_barang[$x], $id_member[$x], $jumlah[$x], $total[$x], $tgl_input[$x], $periode[$x]);

																$sql = "INSERT INTO nota (barang_id,nama_barang,id_member,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?,?)";
																$row = $config->prepare($sql);
																$row->execute($d);

																$sql_barang = "SELECT * FROM transaksi WHERE barang_id = ?";
																$row_barang = $config->prepare($sql_barang);
																$row_barang->execute(array($barang_id[$x]));
																$hsl = $row_barang->fetch();

																if (!$hsl) {
																	throw new Exception("Barang dengan ID {$barang_id[$x]} tidak ditemukan");
																}

																$stok = $hsl['stok'];
																$idb  = $hsl['barang_id'];
																$total_stok = $stok - $jumlah[$x];

																if ($total_stok < 0) {
																	throw new Exception("Stok tidak mencukupi untuk barang ID {$barang_id[$x]}");
																}

																$sql_stok = "UPDATE transaksi SET stok = ? WHERE barang_id = ?";
																$row_stok = $config->prepare($sql_stok);
																$row_stok->execute(array($total_stok, $idb));

																$sqlTransactionOut = "INSERT INTO stok_transactions (type, harga_jual, stok, barang_id, transaction_date) VALUES ('OUT', ?, ?, ?, NOW())";
																$transRow = $config->prepare($sqlTransactionOut);
																$transRow->execute(array($total[$x], $jumlah[$x], $barang_id[$x]));
															} catch (PDOException $e) {
																$config->rollBack();
																throw new Exception("Error dalam transaksi database: " . $e->getMessage());
															} catch (Exception $e) {
																$config->rollBack();
																throw new Exception($e->getMessage());
															}
														}

														$config->commit();
														echo '<script>alert("Belanjaan Berhasil Di Bayar!");</script>';
													} catch (Exception $e) {
														echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
													}
												} else {
													echo '<script>alert("Uang Kurang! Rp.' . abs($hitung) . '");</script>';
												}
											}
										} catch (PDOException $e) {
											echo '<script>alert("Error database: ' . $e->getMessage() . '");</script>';
										} catch (Exception $e) {
											echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
										}
									}
								} catch (Exception $e) {
									echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
								}
								?>

 							<form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
 								<?php foreach ($hasil_penjualan as $isi) {; ?>
 									<input type="hidden" name="nama_barang[]" value="<?php echo $isi['nama_barang']; ?>">
 									<input type="hidden" name="barang_id[]" value="<?php echo $isi['barang_id']; ?>">
 									<input type="hidden" name="id_member[]" value="<?php echo $isi['id_member']; ?>">
 									<input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah']; ?>">
 									<input type="hidden" name="total1[]" value="<?php echo $isi['total']; ?>">
 									<input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input']; ?>">
 									<input type="hidden" name="periode[]" value="<?php echo date('m-Y'); ?>">
 								<?php $no++;
									} ?>
 								<tr>
 									<td>Total Semua </td>
 									<td><input type="text" class="form-control" name="total"
 											value="<?php echo $total_bayar; ?>"></td>

 									<td>Bayar </td>
 									<td><input type="text" class="form-control" name="bayar"
 											value="<?php echo $bayar; ?>"></td>
 									<td>

 										<button class="btn btn-success"><i class="fa fa-shopping-cart"></i>
 											Bayar
 										</button>
 										<?php if (!empty($_GET['nota'] == 'yes')) { ?>
 											<a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
 												<b>RESET</b></a>
 									</td><?php } ?></td>
 								</tr>
 							</form>
 							<tr>
 								<td>Kembali</td>
 								<td><input type="text" class="form-control" value="<?php echo $hitung; ?>"></td>
 								<td></td>
 								<td>
 									<a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member']; ?>
									&bayar=<?php echo $bayar; ?>&kembali=<?php echo $hitung; ?>">
 										<button class="btn btn-secondary">
 											<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
 										</button></a>
 								</td>
 							</tr>
 						</table>
 						<br />
 						<br />
 					</div>
 				</div>

 				<!----Ending buat bayar--->
 			</div>
 		</div>
 	</div>

 	<script>
 		$(document).ready(function() {

 			let timeout;

 			$("#cari").on("keyup", function() {
 				var keyword = $(this).val();

 				clearTimeout(timeout);

 				if (keyword.length > 0) {
 					timeout = setTimeout(function() {
 						$.ajax({
 							type: "POST",
 							url: "fungsi/edit/edit.php?cari_barang=yes",
 							data: {
 								keyword: keyword
 							},
 							beforeSend: function() {
 								$("#hasil_cari").hide();
 								$("#tunggu").html(
 									'<p style="color:green"><blink>tunggu sebentar</blink></p>'
 								);
 							},
 							success: function(html) {
 								$("#tunggu").html('');
 								$("#hasil_cari").show();
 								$("#hasil_cari").html(html);
 							}
 						});
 					}, 1500);
 				} else {
 					$("#hasil_cari").hide();
 				}
 			});
 		});
 	</script>