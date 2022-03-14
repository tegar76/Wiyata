  <!-- Begin Page Content -->
  <div class="container-fluid">

  	<!-- Page Heading -->
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
  		<h1 class="h3 mb-0 text-gray-800">Ruang Diskusi</h1>
  	</div>

  	<a href="" class="btn btn-primary mt-4 mb-4" data-toggle="modal" data-target="#cekDiskusiSiswamodal" id="cekDiskusiSiswa">Cek Ruang Diskusi --></a>

  	<div class="row">
  		<div class="col-xs-6 col-sm-12">
  			<div class="card shadow mb-2 border-primary">

  				<div class="card-body" id="cr2">
  					<h4>Pesan Singkat <img src="<?= base_url() ?>assets/guru/icons/lamp.png" style="width: 20px; margin-top: -10px"></h4>

  					<p>
  						Selamat datang di E-learning Wiyata <strong><?= $data_guru['guru_nama'] ?></strong> selaku guru mata pelajaran Bahasa Indonesia di SMP N 01 Kalibagor, berikut adalah data mengajar anda sesuai jadwal yang berlaku saat ini :
  					</p>

  					<div class="table-responsive" id="trs2">
  						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  							<thead>
  								<tr>
  									<th>No</th>
  									<th>Nama</th>
  									<th>NIP/NUPTK</th>
  									<th>Mengajar Mapel</th>
  									<th>Kelas Yang Diajar</th>
  									<th>Tanggal Dibuat</th>
  									<th>Tanggal Diupdate</th>
  								</tr>
  							</thead>
  							<tbody>
  								<tr>
  									<td><?php $no = 1;
											echo $no++ ?></td>
  									<td><?= $data_guru['guru_nama'] ?></td>
  									<td><?= $data_guru['guru_nip'] ?></td>
  									<td><?= $data_guru['mapel_nama'] ?></td>
  									<?php
										$ci = get_instance();
										$guru_kelas = $this->db->get_where('tb_kelas', ['id_guru' => $data_guru['id_guru']])->result_array();
										?>
  									<td style='text-align:center; vertical-align:middle'>
  										<?php foreach ($guru_kelas as $kelas) echo $kelas['kelas_nama'] . '<br>' ?>
  									</td>
  									<td style='text-align:center;'>
  										<?= date('d-m-Y', strtotime($data_guru['created_at'])) ?>
  									</td>
  									<td style='text-align:center;'>
  										<?= ($data_guru['update_at'] == '0000-00-00 00:00:00') ? ' - ' : date('d-m-Y', strtotime($data_guru['update_at'])) ?>
  									</td>
  								</tr>
  							</tbody>
  						</table>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <!-- Modal Cek Ruang Diskusi -->
  <div class="modal fade" id="cekDiskusiSiswamodal" tabindex="-1" role="dialog" aria-labelledby="cekDiskusiSiswamodal" aria-hidden="true">
  	<div class="modal-dialog modal-md" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title text-center" id="cekDiskusiSiswamodallabel"> Form Cek Ruang diskusi</h5>
  			</div>
  			<div class="modal-body">
  				<?= form_open('Guru/RuangDiskusi/cek_diskusi') ?>
  				<div class="form-group row">
  					<label for="kelas" class="col-sm-4 col-form-label">Pilih Kelas</label>
  					<div class="col-sm-8 col-md-8">
  						<select id="kelas" name="kelas" class="form-control">
  							<option selected value="">Pilih Kelas Siswa</option>
  							<?php foreach ($getkelas as $row => $value) : ?>
  								<option value="<?= $value->kelas_nama ?>"><?= $value->kelas_nama ?></option>
  							<?php endforeach; ?>
  						</select>
  					</div>
  				</div>
				
  				<div class="form-group row">
  					<label for="bab" class="col-sm-4 col-form-label">Bab</label>
  					<div class="col-sm-8 col-md-8">
  						<select class="form-control" id="bab" name="bab">
  							<option selected>Pilih Bab</option>
  							<?php foreach ($getBab as $row => $value) : ?>
  								<option value="<?= $value->bab_ke ?>"><?= 'BAB ' . $value->bab_ke ?></option1>
  								<?php endforeach; ?>
  						</select>
  					</div>
  				</div>

  				<div class="form-group row">
  					<label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
  					<div class="col-sm-8 col-md-8">
  						<input id="mapel" class="form-control" type="text" placeholder="Bahasa Indonesia" readonly>
  					</div>
  				</div>

  				<div class="my-2" id="info-edit"></div>
  				<div class="modal-footer">
  					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Batal</button>
  					<button type="submit" class="btn btn-primary" id="editsiswa-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
  				</div>
  				</form>
  			</div>
  		</div>
  	</div>
  </div>
