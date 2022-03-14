<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('assets/auth/images/iconMiniNoBg.png') ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url() ?>assets/auth/css/mainn.css">
<!--===============================================================================================-->
	<!-- SweetAlert -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.min.css">
	<script src="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<!-- End SweetAlert -->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?=base_url() ?>assets/auth/images/LoginImage.svg" alt="IMG">
				</div>

				<form action="<?= base_url('Auth') ?>" method="post"  class="login100-form">
					<span class="login100-form-title">
						<img src="<?=base_url() ?>assets/auth/images/WiyataDark.png" alt="Wiyata" width="180px">

						<p><hr color="#efeeff"></p>

						<p>Mengelola Proses Pembelajaran Daring Anda Pada Satu Sistem didalam E-learning Wiyata </p>
					
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username" placeholder="Username" value="<?= set_value('username') ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<p id="alertUsername"></p>
					<?= form_error('username', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'); ?>
					<div class="icon-info">
						<img src="<?=base_url() ?>assets/auth/images/VectorInfo.png" alt="" width="22px"
						onclick="alertUsername()">
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>

					<p id="alertPassword"></p>
					<?= form_error('password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'); ?>
					
					<div class="icon-info">
						<img src="<?=base_url() ?>assets/auth/images/VectorInfo.png" alt="" width="22px"
						onclick="alertPassword()">
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Masuk
						</button>
					</div>
					
				</form>
			</div>
		</div>
		<footer>
			<center>&copy; 2021 Team Paradoks Technology</center> <br>
		</footer>
	</div>

	<script>
		function alertUsername() {
  		document.getElementById("alertUsername").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Catatan : <br> Untuk Siswa </strong> <br> Untuk  Siswa dalam  menginput kolom Username Menggunakan <strong> NIS Masing-masing </strong> <br> <strong> Untuk Guru </strong> <br> Sedangkan untuk Guru dalam menginput kolom Username Menggunakan <strong> 6 digit pertama dari NIP/NUPTK </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';}
		function alertPassword() {
  		document.getElementById("alertPassword").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Catatan : <br> Untuk Siswa </strong> <br> Untuk  Siswa dalam  menginput kolom Password Menggunakan password default <strong> siswa-2022 </strong> <br> <strong>Untuk Guru </strong> <br> Dalam Menginput Kolom Password Menggunakan <strong> Password yang Telah Diberikan Oleh Admin Melalui Chat Whatsapp </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <br></div>';}
	
	</script>

<!--===============================================================================================-->	
	<script src="<?=base_url() ?>assets/auth/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url() ?>assets/auth/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url() ?>assets/auth/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url() ?>assets/auth/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url() ?>assets/auth/vendor/tilt/tilt.jquery.min.js"></script>
	<!-- SweetAlert -->
	<script src="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<!-- End SweetAlert -->
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?=base_url() ?>assets/auth/js/main.js"></script>
	<script type="text/javascript">
        $(function(){
            var title = '<?= $this->session->flashdata("title") ?>';
            var text = '<?= $this->session->flashdata("text") ?>';
            var type = '<?= $this->session->flashdata("type") ?>';
            if (title) {
                swal.fire({
                  title: title,
                  text: text,
                  type:type,
                  button: true,
                });
            };
        });
    </script>
</body>
</html>
