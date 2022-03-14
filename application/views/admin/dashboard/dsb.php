<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Jumlah Guru -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
								Jumlah Guru</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sum_guru ?></div>
						</div>
						<div class="col-auto">
							<i><img src="<?= base_url() ?>assets/admin/icons/jg.png" style="width:40px"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-success text-uppercase mb-1">
								Jumlah Kelas</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sum_kelas ?></div>
						</div>
						<div class="col-auto">
							<i><img src="<?= base_url() ?>assets/admin/icons/jk.png" style="width:40px"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-info text-uppercase mb-1">Jumlah Siswa
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $sum_siswa ?></div>
								</div>

							</div>
						</div>
						<div class="col-auto">
							<i><img src="<?= base_url() ?>assets/admin/icons/js.png" style="width:40px"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
								Pesan</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sum_pesan ?></div>
						</div>
						<div class="col-auto">
							<i><img src="<?= base_url() ?>assets/admin/icons/ps.png" style="width:40px"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6 col-sm-12">
			<!-- Daftar Guru -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<label class="m-0 font-weight-bold text-primary">Daftar Guru</label>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="tabelgurudsb" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>NIP</th>
									<th>Mengajar Mapel</th>
									<th>Telepon</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<div class="col-xs-6 col-sm-6">
			<!-- Daftar Kelas -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="tabelkelas" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kelas</th>
									<th>Mapel</th>	
									<th>Nama Guru</th>
								</tr>
							</thead>
						</table>
					</div>

				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6">
			<!-- Pesan Aduan -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Pesan Aduan</h6>
				</div>
				<div class="card-body">

					<div class="table-responsive">
						<table id="tabelpesan" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Subject</th>
									<th>Keluhan</th>
									<th>Action</th>
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
