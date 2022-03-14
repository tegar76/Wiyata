<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/admin/auth_admin/images/iconMiniNoBg.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/auth_admin/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/auth_admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/auth_admin/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/auth_admin/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/auth_admin/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/auth_admin/css/mainn.css">
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

				<form action="<?= base_url('Admin/AuthAdmin') ?>" method="POST" class="login100-form">
					<span class="login100-form-title">
						<img src="<?= base_url() ?>assets/admin/auth_admin/images/Wiyata.png" alt="Wiyata" width="180px">

						<p>
							<hr color="#FAFAFA">
						</p>

						<h5><strong>Login Admin</strong> </h5>

					</span>
					<?= $this->session->flashdata('authmsg') ?>
					<div class="wrap-input100">
						<input class="input100" type="text" name="username" placeholder="Username" value="<?= set_value('username') ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>


					</div>

					<?= form_error('username', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'); ?>


					<div class="wrap-input100">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>
					<?= form_error('password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'); ?>

					<div class="container-login100-form-btn">
						<button type="submit" id="login-button" class="btn login100-form-btn">
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


	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/admin/auth_admin/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/admin/auth_admin/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets/admin/auth_admin/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/admin/auth_admin/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/admin/auth_admin/vendor/tilt/tilt.jquery.min.js"></script>
	<!-- SweetAlert -->
	<script src="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<!-- End SweetAlert -->
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script script type="text/javascript">
		$(function() {
			var title = '<?= $this->session->flashdata("title") ?>';
			var text = '<?= $this->session->flashdata("text") ?>';
			var type = '<?= $this->session->flashdata("type") ?>';
			if (title) {
				swal.fire({
					icon: type,
					title: title,
					text: text,
					type: type,
					button: true,
				});
			};
		});
	</script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets/admin/auth_admin/js/main.js"></script>

</body>

</html>
