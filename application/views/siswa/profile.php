    <div class="container">
    	<div class="main-body p-0">

    		<div class="row gutters-sm">
    			<div class="col-md-4 mb-3">
    				<div class="card">
    					<div class="card-body">
    						<div class="d-flex flex-column align-items-center text-center">
    							<img src="<?= base_url() ?>assets/siswa/img/UserDefault.png" alt="Admin" class="rounded-circle" width="150">
    							<div class="mt-3">
    								<h4><?= $profile_siswa['siswa_nama'] ?></h4>
    								<p class="text-secondary mb-1">Kelas <?= $profile_siswa['kelas_nama'] ?></p>
    								<p class="text-muted font-size-sm">SMP N 1 Kalibagor</p>
    							</div>
    						</div>
    					</div>
    				</div>

    			</div>
    			<div class="col-md-8">
    				<div class="card mb-3">
    					<div class="card-body">
    						<div class="row">
    							<div class="col-sm-3">
    								<h6 class="mb-0">NIS</h6>
    							</div>
    							<div class="col-sm-9 text-secondary">
    								<?= $profile_siswa['siswa_nis'] ?>
    							</div>
    						</div>
    						<hr>
    						<div class="row">
    							<div class="col-sm-3">
    								<h6 class="mb-0">Tempat Tanggal Lahir</h6>
    							</div>
    							<div class="col-sm-9 text-secondary">
    								<?= $profile_siswa['siswa_tempat_lahir'] . ', ' . ($profile_siswa['siswa_tanggal_lahir'] == '0000-00-00') ? ' - ' : date('d-m-Y', strtotime($profile_siswa['siswa_tanggal_lahir'])) ?>
    							</div>
    						</div>
    					</div>
    					<hr>
    					<div class="row">
    						<div class="col-sm-3">
    							<h6 class="mb-0">Jenis Kelamin</h6>
    						</div>
    						<div class="col-sm-9 text-secondary">
    							<?= $profile_siswa['siswa_jenis_kelamin'] ?>
    						</div>
    					</div>
    					<hr>
    					<div class="row">
    						<div class="col-sm-3">
    							<h6 class="mb-0">No Telepon</h6>
    						</div>
    						<div class="col-sm-9 text-secondary">
    							<?= $profile_siswa['siswa_phone'] ?>
    						</div>
    					</div>
    					<hr>
    					<div class="row">
    						<div class="col-sm-3">
    							<h6 class="mb-0">Alamat</h6>
    						</div>
    						<div class="col-sm-9 text-secondary">
    							<?= $profile_siswa['siswa_alamat'] ?>
    						</div>
    					</div>
    					<hr>
    					<div class="row">
    						<div class="col-sm-12">
    							<a class="btn-pink" href="<?= base_url('Siswa/profile/update_profile') ?>" style="width: 130px; height: 34px">Edit Profile</a>
    						</div>
    					</div>
    				</div>
    			</div>

    		</div>
    	</div>

    </div>
    </div>
