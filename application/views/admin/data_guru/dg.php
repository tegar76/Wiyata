<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
	</div>

	<div class="textdecor-none mb-2">
		<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#addgurumodal" id="addguru">+ Tambah Guru</button>
	</div>
	
	<div class="row">
		<div class="col-xs-6 col-sm-12">
			<!-- Daftar Guru -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<div class="float-left">
						<div class="btn btn-primary" id="refresh-tabel-guru"><span class="fas fa-sync-alt mr-1"></span></div>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="tabelguru" width="100%" cellspacing="0">
							<thead>
								<tr>	
									<th>No</th>
									<th>Nama</th>
									<th>NIP/NUPTK</th>
									<th>Mengajar Mapel</th>
									<th>Telepon</th>
									<th>Tanggal Input</th>
									<th>Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->



<!-- Modal Add Guru -->
<div class="modal fade" id="addgurumodal" tabindex="-1" role="dialog" aria-labelledby="addgurumodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addgurumodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Guru</h5>
            </div>
            <div class="modal-body">
				<?= form_open_multipart('#', ['id' => 'tambahguru']) ?>
				<div class="form-group row">
                    <label for="nama_guru" class="col-sm-4 col-form-label">Nama Guru</label>
                    <div class="col-sm-8 col-md-8">
						<input id="nama_guru" type="text" name="nama_guru" class="form-control">
					</div>
                </div>
				<div class="form-group row">
                    <label for="nip_guru" class="col-sm-4 col-form-label">NIP</label>
                    <div class="col-sm-8 col-md-8">
						<input id="nip_guru" type="text" name="nip_guru" class="form-control">
					</div>
                </div>
				<div class="form-group row">
                    <label for="guru_mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-8 col-md-8">
						<select class="form-control" id="guru_mapel" name="guru_mapel">
							<option selected value="">Mengajar  Mata Pelajaran</option>
							<?php foreach($mapel as $row => $value ) : ?>
								<option value="<?= $value->id_mapel ?>" ><?= $value->mapel_nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
                </div>
				<div class="form-group row">
                    <label for="guru_kelas" class="col-sm-4 col-form-label">Kelas yang diajar</label>
                    <div class="col-sm-8 col-md-8">
						<select class="form-control" id="guru_kelas" name="guru_kelas[]" data-live-search="true" multiple>
							<?php foreach($kelas as $row => $value) : ?>
								<option value="<?= $value->id_kelas?>" ><?= $value->kelas_nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
                </div>
				<div class="form-group row">
                    <label for="jenis_kelamin_guru" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8 col-md-8">
						<div class="form-check form-check-inline">
                            <?= form_radio('jenis_kelamin_guru', 'laki-laki', set_radio('jenis_kelamin_guru[]', 'laki-laki'), "id='jenis_kelamin_guru1' class='form-check-input'"); ?>
                            <label class="form-check-label" for="jenis_kelamin_guru1">Laki - Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('jenis_kelamin_guru', 'perempuan', set_radio('jenis_kelamin_guru[]', 'perempuan'), "id='jenis_kelamin_guru1' class='form-check-input'"); ?>
                            <label class="form-check-label" for="jenis_kelamin_guru2">Perempuan</label>
                        </div>
                    </div>
				</div>
				<div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-8 col-md-8">
						<input id="tempat_lahir" type="text" name="tempat_lahir" class="form-control">
					</div>
                </div>
				<div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4 col-md-8">
						<input id="tanggal_lahir" type="date" name="tanggal_lahir" class="form-control">
					</div>
                </div>
				<div class="form-group row">
                    <label for="agama_guru" class="col-sm-4 col-form-label">Agama</label>
                    <div class="col-sm-8 col-md-8">
						<div class="form-check form-check-inline">
                            <?= form_radio('agama_guru', 'Islam', set_radio('agama_guru[]', 'Islam'), "id='agama_guru1' class='form-check-input'"); ?>
                            <label class="form-check-label" for="agama_guru1">Islam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('agama_guru', 'Kristen', set_radio('agama_guru[]', 'Kristen'), "id='agama_guru2' class='form-check-input'"); ?>
                            <label class="form-check-label" for="agama_guru2">Kristen</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('agama_guru', 'Katolik', set_radio('agama_guru[]', 'Katolik'), "id='agama_guru3' class='form-check-input'"); ?>
                            <label class="form-check-label" for="agama_guru3">Katolik</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('agama_guru', 'Hindu', set_radio('agama_guru[]', 'Hindu'), "id='agama_guru4' class='form-check-input'"); ?>
                            <label class="form-check-label" for="agama_guru4">Hindu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('agama_guru', 'Budha', set_radio('agama_guru[]', 'Budha'), "id='agama_guru5' class='form-check-input'"); ?>
                            <label class="form-check-label" for="agama_guru5">Budha</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('agama_guru', 'Konghucu', set_radio('agama_guru[]', 'Konghucu'), "id='agama_guru6' class='form-check-input'"); ?>
                            <label class="form-check-label" for="agama_guru6">Konghucu</label>
                        </div>
					</div>
                </div>
				<div class="form-group row">
                    <label for="alamat_guru" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8 col-md-8">
						<input id="alamat_guru" type="text" name="alamat_guru" class="form-control">
					</div>
                </div>
				<div class="form-group row">
                    <label for="no_telp_guru" class="col-sm-4 col-form-label">No Telepon</label>
                    <div class="col-sm-8 col-md-8">
						<input id="no_telp_guru" type="text" name="no_telp_guru" class="form-control">
					</div>
                </div>
				<div class="form-group row">
                    <label for="pass_guru" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8 col-md-8">
						<div class="input-group" id="show_hide_password">
							<input id="pass_guru" type="password" name="pass_guru" class="form-control">
							<div class="input-group-append">
								<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
							</div>
						</div>
					</div>
                </div>
				<input type="hidden" name="role_guru" value="2">
				<div class="form-group row">
                    <label for="foto_guru" class="col-sm-4 col-form-label">Foto Guru</label>
                    <div class="col-sm-8 col-md-8">
						<div class="custom-file">
                            <input type="file" class="form-control-file" id="foto_guru" name="foto_guru">
                            <small>Choose file. Max 2 MB</small>
                        </div>
					</div>
                </div>
				<div class="my-2" id="info-data"></div>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
                <button type="submit" class="btn btn-primary" id="addguru-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
            </div>
			</form>
		</div>
	</div>
</div>

<!-- Modal View Guru -->
<div class="modal fade" id="viewgurumodal" tabindex="-1" role="dialog" aria-labelledby="viewgurumodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="viewgurumodallabel"><span class="fas fa-user-tie mr-1"></span>Preview Guru</h5>
            </div>
            <div class="modal-body">
                <div id="viewdataguru"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Guru -->
<div class="modal fade" id="editgurumodal" tabindex="-1" role="dialog" aria-labelledby="editgurumodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editgurumodallabel"><span class="fas fa-calendar-alt mr-1"></span>Edit Guru</h5>
            </div>
            <div class="modal-body">
                <div id="editdataguru"></div>
            </div>
        </div>
    </div>
</div
