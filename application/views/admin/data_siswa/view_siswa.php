<div class="row detail">
    <div class="col-md-2 col-sm-4 col-6 p-2">
        <img class="img-thumbnail" src="<?= ($datasiswa->siswa_image == 'default.png' ?  base_url('assets/admin/img/AdminDefault.png') : base_url('storage/siswa/profile/' . $datasiswa->siswa_image)); ?>" class="card-img rounded-circle" alt="<?= $datasiswa->siswa_image ?>" width="200">
    </div>
    <div class="col-md-10 col-sm-8 col-6">
		<label for=""><h5>Data Siswa</h5></label>
        <dl class="row">
            <dt class="col-sm-5">Nama Siswa</dt>
            <dd class="col-sm-7"><?= $datasiswa->siswa_nama ?></dd>
            <dt class="col-sm-5">NIS</dt>
            <dd class="col-sm-7"><?= $datasiswa->siswa_nis ?></dd>
            <dt class="col-sm-5">Kelas</dt>
            <dd class="col-sm-7"><?= $datasiswa->kelas_nama ?></dd>
            <dt class="col-sm-5">Tempat / Tanggal Lahir</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_tempat_lahir)) ? " - " : $datasiswa->siswa_tempat_lahir ?> , <?= ($datasiswa->siswa_tanggal_lahir == '0000-00-00') ? " - " : date('d-m-Y', strtotime($datasiswa->siswa_tanggal_lahir)) ?></dd>
            <dt class="col-sm-5">jenis Kelamin</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_jenis_kelamin)) ? " - " : $datasiswa->siswa_jenis_kelamin ?></dd>
            <dt class="col-sm-5">Agama</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->agama)) ? " - " : $datasiswa->agama ?></dd>
            <dt class="col-sm-5">Alamat</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_alamat)) ? " - " : $datasiswa->siswa_alamat ?></dd>
            <dt class="col-sm-5">Nomor Telepon</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_phone)) ? " - " : $datasiswa->siswa_phone ?></dd>
			<dt class="col-sm-5">Nama Orang Tua</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_ortu)) ? " - " : $datasiswa->siswa_ortu?></dd>
            <dt class="col-sm-5">Telepon Orang Tua</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_ortu_phone)) ? " - " : $datasiswa->siswa_ortu_phone ?></dd>
            <dt class="col-sm-5">Alamat Orang Tua</dt>
            <dd class="col-sm-7"><?= (empty($datasiswa->siswa_ortu_alamat)) ? " - " : $datasiswa->siswa_ortu_alamat ?></dd> 	
    </div>
</div>
