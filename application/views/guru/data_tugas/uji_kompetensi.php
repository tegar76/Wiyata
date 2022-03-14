<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Uji Kompetensi</h1>
	</div>
	<div class="mb-2">
		<a href="" class="btn btn-primary mt-4" data-toggle="modal" data-target="#cekUjiKompetensimodal" id="cekUjiKompetensi">Cek Uji Kompetensi Siswa</a>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-12">

			<div class="card shadow mb-2 border-primary">
                <div class="col-md-12 text-right">
					<button class="btn btn-sm btn-primary mt-2" id="refresh-uk">refresh</button>
				</div>
				<div class="col-md-12 text-left">
					<h6 class="text-primary mt-n4"><img src="<?= base_url() ?>assets/guru/icons/pemberitahuan.png" width="15px" class="mr-2">Pemberitahuan</h6>
				</div>
				<div class="card-body" id="cr2">

					<div class="table-responsive" id="trs2">
						<table class="table table-bordered" id="cek-uk" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Kelas</th>
									<th>Mapel</th>
									<th>Bab</th>
									<th>Tanggal Ujian</th>
									<th>Tanggal Dibuat</th>
									<th>Tanggal Diedit</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Cek Uji Kompetensi -->
<div class="modal fade" id="cekUjiKompetensimodal" tabindex="-1" role="dialog" aria-labelledby="cekUjiKompetensimodal" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="cekUjiKompetensimodallabel"> Form Cek Uji Kompetensi Siswa</h5>
			</div>
			<div class="modal-body">
				<?= form_open_multipart('#', ['id' => 'cek_uk']) ?>
					<div class="form-group row">
						<label for="kelas" class="col-sm-4 col-form-label">Pilih Kelas</label>
						<div class="col-sm-8 col-md-8">
							<select id="kelas" name="kelas" class="form-control">
								<option selected value="">Pilih Kelas Siswa</option>
								<?php foreach($kelas as $row => $value) : ?>
									<option value="<?= $value->id_kelas ?>" ><?= $value->kelas_nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					 <div class="form-group row">
                        <label for="bab_ke" class="col-sm-4 col-form-label">Bab</label>
                        <div class="col-sm-8 col-md-8">
                            <select class="form-control" id="bab_ke" name="bab_ke">
                                <option selected>Pilih Bab</option>
								<?php foreach($getBab as $row => $value) : ?>
                                <option value="<?= $value->id_bab ?>" ><?= 'BAB ' . $value->bab_ke ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

					<div class="form-group row">
						<label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
						<div class="col-sm-8 col-md-8">
							<input id="mapel" name="mapel" class="form-control" type="text" value="Bahasa Indonesia" placeholder="Bahasa Indonesia" readonly>
						</div>
					</div>

					<div class="my-2" id="info-data"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
						<button type="submit" class="btn btn-primary" id="cekkompetensi-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
