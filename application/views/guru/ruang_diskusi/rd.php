<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="row">
		<div class="col-xs-6 col-sm-12">

			<a class="btn btn-primary text-white mb-3" data-toggle="modal" data-target="#tambahDiskusi">+ Tambah Diskusi</a>

			<div class="card shadow mb-4">
				<?php if (!empty($get_bab) and !empty($kelas)) : ?>
					<div class="card-header py-3">
						<h4 class="text-gray-900">Ruang Diskusi Bab <?= $get_bab['bab_ke'] . ' ' . $get_bab['bab_judul'] . ' Kelas ' . $kelas['kelas_nama'] ?></h4>
					</div>
				<?php else :  ?>
					<div class="card-header py-3">
						<h4 class="text-gray-900">Ruang Diskusi Bab</h4>
					</div>
				<?php endif; ?>
				<div class="col-md-12 mb-4 mt-3">
					<?php if (!empty($diskusi)) : ?>
						<?php foreach ($diskusi as $row => $value) : ?>
							<?php $ci = get_instance();
							$query = $ci->db->get_where('tb_diskusi', ['id_info' => $value->id_info]);
							?>
							<div class="card h-100 py-2 mt-3">
								<div class="card-body">
									<section>
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="row">
													<h5 class="mb-4 ml-3 text-gray-900"><?= $value->judul ?></h5>
													<a href="<?= base_url('Guru/RuangDiskusi/ruangDiskusiDetail/' . $this->secure->encrypt_url($value->id_info)) ?>" class="ml-3 mt-n2">
														<div class="card p-1 border border-primary rounded-pill">
															<div class="row no-gutters align-items-center">
																<div class="col">
																	<div class="text-xs text-primary text-decoration-none ml-2 mr-2">
																		Komentar
																		<button class="btn text-success btn-warning btn-sm border-0 ml-1 mr-1 pl-1 pr-1 pt-0 pb-0 rounded"><?= ($query->num_rows() == null) ? '0' : $query->num_rows() ?></button>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<p class="info"><?= $value->deskripsi ?></p>
											</div>
										</div>
									</section>
									<section class="mt-3">
										<div class="row no-gutters align-items-center">
											<div class="col-md-12 mr-2 ml-3">
												<div class="row" id="btnInfo">
													<div class="card p-1 bg-success rounded mr-3">
														<div class="row no-gutters align-items-center">
															<div class="col">
																<div class="text-xs text-white ml-2 mr-2">
																	<i class="fa fa-user"></i>
																	<?= $value->pembuat ?>
																</div>
															</div>
														</div>
													</div>
													<div class="card p-1 bg-success rounded">
														<div class="row no-gutters align-items-center">
															<div class="col">
																<div class="text-xs text-white ml-2 mr-2">
																	<i class="fa fa-calendar"></i>
																	<?= date('Y-m-d', strtotime($value->tanggal)) ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
					

							
							<div class="alert alert-info" role="alert">
								<div class="h4 alert-heading">Belum Ada Forum Diskusi</div>
								<hr>
								<p class="mb-0">Silahkan buat forum diskusi baru dengan klik tombol tambah diskusi</p>
							</div>
							
							<?php endif; ?>
						
				</div>
			</div>
		</div>
					
	</div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal Tambah Diskusi -->
<div class="modal fade" id="tambahDiskusi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Diskusi Baru </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('Guru/RuangDiskusi/submit_forum') ?>
			<div class="modal-body">
				<input type="hidden" name="id_bab" value="<?= $get_bab['id_bab'] ?>">
				<input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas'] ?>">
				<input type="hidden" name="nama_user" value="<?= $data_guru['guru_nama'] ?>">
				<div class="form-group">
					<label for="judul_diskusi">Judul</label>
					<input type="text" id="judul_diskusi" name="judul_diskusi" class="form-control" placeholder="Ex : BAB 1 Text Berita">
				</div>
	
				<div class="form-group">
					<label for="deskripsi_diskusi">Deskripsi</label>
					<textarea id="deskripsi_diskusi" name="deskripsi_diskusi" class="form-control" placeholder="Input Deskripsi"></textarea>
					</div>

			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-sm btn-info">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
