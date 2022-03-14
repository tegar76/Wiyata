<div class="container">
        <div class="main-body p-0">
        
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                      <img src="<?= ( $data_guru['guru_image'] == 'default.png' ? base_url('assets/siswa/img/UserDefault.png') : base_url('storage/guru/profile/'. $data_guru['guru_image'])) ?>" alt="<?= $data_guru['guru_nama'] ?>" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4><?= $data_guru['guru_nama'] ?></h4>
                          <p class="text-secondary mb-1"><?= $data_guru['guru_nip'] ?></p>
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
                          <h6 class="mb-0 font-weight-bold">Nama Guru</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
												<?= $data_guru['guru_nama'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">NIP/NUPTK</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        	 <?= $data_guru['guru_nip'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Mengajar Mapel</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          Bahasa Indonesia
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Kelas Yang Diajar</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                         <?php foreach($data_kelas as $row => $value) echo $value['kelas_nama'] . ', ' ?> 
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
												<?= $data_guru['guru_jenis_kelamin'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Tempat / Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
												<?= (empty($data_guru['guru_tempat_lahir'])) ? " - " : $data_guru['guru_tempat_lahir'] ?> , <?= ($data_guru['guru_tanggal_lahir'] == '0000-00-00') ? " - " : date('d-m-Y', strtotime($data_guru['guru_tanggal_lahir'])) ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Agama</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
												<?= (empty($data_guru['guru_agama'])) ? " - " : $data_guru['guru_agama'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
												<?= (empty($data_guru['guru_alamat'])) ? " - " : $data_guru['guru_alamat'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 font-weight-bold">Nomor Telepon</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
												<?= (empty($data_guru['guru_phone'])) ? " - " : $data_guru['guru_phone'] ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                          <a class="btn btn-sm btn-info" href="<?= base_url('Guru/Profile/editprofile')?>" style="width: 130px; height: 34px">Edit Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
    
                </div>
              </div>
    
            </div>
        </div>
</div>


       