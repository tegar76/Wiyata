<div class="row detail">
    <div class="col-md-2 col-sm-4 col-6 p-2">
		<img class="img-thumbnail" src="<?= ($dataguru['guru_image'] == 'default.png' ?  base_url('assets/admin/img/AdminDefault.png') : base_url('storage/guru/profile/' . $dataguru['guru_image'])); ?>" class="card-img rounded-circle" alt="<?= $dataguru['guru_image'] ?>" width="200">
    </div>
    <div class="col-md-10 col-sm-8 col-6">
        <dl class="row">
            <dt class="col-sm-5">Tanggal Input</dt>
            <dd class="col-sm-7"><?= date('d-m-Y', strtotime($dataguru['created_at'])) ?></dd>
            <dt class="col-sm-5">Tanggal Update</dt>
            <dd class="col-sm-7"><?= ($dataguru['update_at'] == '0000-00-00 00:00:00') ? ' - ' : date('d-m-Y', strtotime($dataguru['update_at'])) ?></dd>
            <dt class="col-sm-5">Nama Guru</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_nama'] ?></dd>
            <dt class="col-sm-5">NIP</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_nip'] ?></dd>
            <dt class="col-sm-5">Mengajar Mapel</dt>
            <dd class="col-sm-7"><?= $dataguru['mapel_nama'] ?></dd>
            <dt class="col-sm-5">Kelas Diajar</dt>
            <dd class="col-sm-7"><?php  foreach ($datakelas as $row) echo $row['kelas_nama'] . ' ' ?></dd>
            <dt class="col-sm-5">jenis Kelamin</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_jenis_kelamin'] ?></dd>
            <dt class="col-sm-5">Tempat / Tanggal Lahir</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_tempat_lahir'] ?> , <?= ($dataguru['guru_tanggal_lahir'] == '0000-00-00') ? " - " : date('d-m-Y', strtotime($dataguru['guru_tanggal_lahir'])) ?></dd>
            <dt class="col-sm-5">Agama</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_agama'] ?></dd>
            <dt class="col-sm-5">Alamat</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_alamat'] ?></dd>
            <dt class="col-sm-5">Nomor Telepon</dt>
            <dd class="col-sm-7"><?= $dataguru['guru_phone'] ?></dd>
    </div>
</div>
