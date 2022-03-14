<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Siswa </h1>
	</div>

    <div class="textdecor-none mb-2">
		<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahsiswamodal" id="tambahsiswa">+ Tambah Siswa</button>
	</div>

	<div class="row">
		<div class="form-group col-md-3">
			<div class="input-group mb-2">
				<select id="id_kelas" class="form-control">
					<option value="null">Pilih Kelas</option>
					<?php foreach($kelas as $row => $value ) : ?>
						<?php if( $value->kelas_nama == $class) : ?>
							<option value="<?= $value->id_kelas  ?>" selected><?= $value->kelas_nama?></option>
						<?php else : ?>
							<option value="<?= $value->id_kelas ?>"><?= $value->kelas_nama ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-filter"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-12">
			<!-- Daftar Siswa -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Tabel Siswa</h6>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="tabelsiswa" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>NIS</th>
									<th>Jenis Kelamin</th>
									<th>No Telepon</th>
									<th>Terakhir Aktif</th>
									<th>Status</th>
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

</div>
<!-- End of Main Content -->

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahsiswamodal" tabindex="-1" role="dialog" aria-labelledby="tambahsiswamodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="tambahsiswamodallabel"><span class="fas fa-user-tie mr-1"></span>Tambah Data Siswa</h5>
            </div>
            <div class="modal-body">
				<?= form_open_multipart('#', ['id' => 'submitsiswa']) ?>
				<label><h5>Data Siswa</h5></label>
				<div class="form-group row">
					<label for="nama_siswa" class="col-sm-4 col-form-label">Nama Siswa</label>
					<div class="col-sm-8 col-md-8">
						<input id="nama_siswa" type="text" name="nama_siswa" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="nis_siswa" class="col-sm-4 col-form-label">NIS</label>
					<div class="col-sm-8 col-md-8">
						<input id="nis_siswa" type="text" name="nis_siswa" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="nisn_siswa" class="col-sm-4 col-form-label">NISN</label>
					<div class="col-sm-8 col-md-8">
						<input id="nisn_siswa" type="text" name="nisn_siswa" class="form-control">
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
					<label for="jenis_kelamin_siswa" class="col-sm-4 col-form-label">Jenis Kelamin</label>
					<div class="col-sm-8 col-md-8">
						<div class="form-check form-check-inline">
							<?= form_radio('jenis_kelamin_siswa', 'laki-laki', set_radio('jenis_kelamin_siswa[]', 'laki-laki'), "id='jenis_kelamin_siswa1' class='form-check-input'"); ?>
							<label class="form-check-label" for="jenis_kelamin_siswa1">laki-laki</label>
						</div>
						<div class="form-check form-check-inline">
							<?= form_radio('jenis_kelamin_siswa', 'perempuan', set_radio('jenis_kelamin_siswa[]', 'perempuan'), "id='jenis_kelamin_siswa2' class='form-check-input'"); ?>
							<label class="form-check-label" for="jenis_kelamin_siswa2">perempuan</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="agama_siswa" class="col-sm-4 col-form-label">Agama</label>
					<div class="col-sm-8 col-md-8">
						<div class="form-check form-check-inline">
							<?= form_radio('agama_siswa', 'Islam', set_radio('agama_siswa[]', 'Islam'), "id='agama_siswa1' class='form-check-input'"); ?>
							<label class="form-check-label" for="agama_siswa1">Islam</label>
						</div>
						<div class="form-check form-check-inline">
							<?= form_radio('agama_siswa', 'Kristen', set_radio('agama_siswa[]', 'Kristen'), "id='agama_siswa2' class='form-check-input'"); ?>
							<label class="form-check-label" for="agama_siswa2">Kristen</label>
						</div>
						<div class="form-check form-check-inline">
							<?= form_radio('agama_siswa', 'Katolik', set_radio('agama_siswa[]', 'Katolik'), "id='agama_siswa3' class='form-check-input'"); ?>
							<label class="form-check-label" for="agama_siswa3">Katolik</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label" for="agama_siswa4">Hindu</label>
							<?= form_radio('agama_siswa', 'Hindu', set_radio('agama_siswa[]', 'Hindu'), "id='agama_siswa4' class='form-check-input'"); ?>
						</div>
						<div class="form-check form-check-inline">
							<?= form_radio('agama_siswa', 'Budha', set_radio('agama_siswa[]', 'Budha'), "id='agama_siswa5' class='form-check-input'"); ?>
							<label class="form-check-label" for="agama_siswa5">Budha</label>
						</div>
						<div class="form-check form-check-inline">
							<?= form_radio('agama_siswa', 'Konghucu', set_radio('agama_siswa[]', 'Konghucu'), "id='agama_siswa6' class='form-check-input'"); ?>
							<label class="form-check-label" for="agama_siswa6">Konghucu</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="alamat_siswa" class="col-sm-4 col-form-label">Alamat</label>
					<div class="col-sm-8 col-md-8">
						<textarea id="alamat_siswa" type="text" name="alamat_siswa" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="no_telp_siswa" class="col-sm-4 col-form-label">No Telepon</label>
					<div class="col-sm-8 col-md-8">
						<input id="no_telp_siswa" type="text" name="no_telp_siswa" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="kelas_siswa" class="col-sm-4 col-form-label">Pilih Kelas</label>
					<div class="col-sm-8 col-md-8">
						<select id="kelas_siswa" name="kelas_siswa" class="form-control">
							<option selected value="">Pilih Kelas Siswa</option>
							<?php foreach($kelas as $row => $value) : ?>
								<option value="<?= $value->id_kelas ?>" ><?= $value->kelas_nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="foto_siswa" class="col-sm-4 col-form-label">Foto Siswa</label>
					<div class="col-sm-8 col-md-8">
						<div class="custom-file">
							<input type="file" class="form-control-file" id="foto_siswa" name="foto_siswa">
							<small>Choose file. Max 2 MB</small> 
						</div>
					</div>
				</div>
				<label><h5>Data Orang Tua</h5></label>
				<div class="form-group row">
					<label for="nama_ortu_siswa" class="col-sm-4 col-form-label">Nama Orang Tua/Wali</label>
					<div class="col-sm-8 col-md-8">
						<input id="nama_ortu_siswa" type="text" name="nama_ortu_siswa" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="no_telp_ortu" class="col-sm-4 col-form-label">No Telepon</label>
					<div class="col-sm-8 col-md-8">
						<input id="no_telp_ortu" type="number" name="no_telp_ortu" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="alamat_ortu" class="col-sm-4 col-form-label">Alamat</label>
					<div class="col-sm-8 col-md-8">
						<textarea id="alamat_ortu" type="text" name="alamat_ortu" class="form-control"></textarea>
					</div>
				</div>
				<label><h5>Password Siswa</h5></label>
				<div class="form-group row">
                    <label for="pass_siswa" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8 col-md-8">
						<div class="input-group" id="show_hide_password">
							<input id="pass_siswa" type="password" name="pass_siswa" class="form-control">
							<div class="input-group-append">
								<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
							</div>
						</div>
					</div>
                </div>
				<div class="form-group row">
                    <label for="pass_siswa_conf" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-8 col-md-8">
						<div class="input-group" id="show_hide_password">
							<input id="pass_siswa_conf" type="password" name="pass_siswa_conf" class="form-control">
							<div class="input-group-append">
								<button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
							</div>
						</div>
					</div>
                </div>
				<div class="my-2" id="info-data"></div>
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
                <button type="submit" class="btn btn-primary" id="submitsiswa-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
            </div>
			</form>
        </div>
    </div>
</div>

<!-- Modal View Siswa -->
<div class="modal fade" id="viewsiswamodal" tabindex="-1" role="dialog" aria-labelledby="viewsiswamodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="viewsiswamodallabel"><span class="fas fa-user-tie mr-1"></span>Preview Siswa</h5>
            </div>
            <div class="modal-body">
                <div id="viewdatasiswa"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div class="modal fade" id="editsiswamodal" tabindex="-1" role="dialog" aria-labelledby="editsiswamodal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editsiswamodallabel"><span class="fas fa-calendar-alt mr-1"></span>Edit Siswa</h5>
            </div>
            <div class="modal-body">
                <div id="updatedatasiswa"></div>
            </div>
        </div>
    </div>
</div>


