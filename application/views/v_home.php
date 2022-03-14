<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?= $title ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url('assets/home/icons/iconMiniNoBg.png') ?>" rel="icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url('assets/home/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/home/vendor/icofont/icofont.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/home/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/home/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/home/vendor/venobox/venobox.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/home/vendor/owl.carousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/home/vendor/aos/aos.css') ?>" rel="stylesheet">
	<!-- SweetAlert -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.min.css">
	<!-- End SweetAlert -->
	<!-- Template Main CSS File -->
	<link href="<?= base_url('assets/home/css/styles.css') ?>" rel="stylesheet">

	<!-- =======================================================
  * Template Name: Arsha - v2.3.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top ">
		<div class="container d-flex align-items-center">

			<h1 class="logo mr-auto"><a href="index.html"><img src="<?= base_url('assets/home/icons/WiyataDark.png') ?>" alt=""></a></h1>

			<nav class="nav-menu d-none d-lg-block">
				<ul>
					<li class="active"><a href="#home">Home</a></li>
					<li><a href="#fitur">Fitur</a></li>
					<li><a href="#contact">Kontak</a></li>
				</ul>
			</nav><!-- .nav-menu -->
		</div>
	</header><!-- End Header -->

	<!-- ======= home Section ======= -->
	<section id="home" class="d-flex align-items-center">

		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
					<h1>Selamat Datang !!</h1>
					<h2>Siswa Kelas VIII SMP N 1 Kalibagor Di Pembelajaran Elearning
						Mata Pelajaran Bahasa Indonesia Wiyata </h2>
					<div class="d-lg-flex">
						<a href="<?= base_url('auth') ?>" class="btn-get-started scrollto">Masuk <img class="mt-n1" src="<?= base_url('assets/home/icons/masuk.png') ?>"></a>
					</div>
				</div>
				<div class="col-lg-6 order-1 order-lg-2 home-img" data-aos="zoom-in" data-aos-delay="200">
					<img src="<?= base_url('assets/home/icons/ilustration1.png') ?>" class="img-fluid animated">
				</div>
			</div>
		</div>

	</section><!-- End home -->

	<main id="main">

		<!-- ======= Fitur Section ======= -->
		<section id="fitur" class="fitur section-bg">
			<div class="container-fluid" data-aos="fade-up">

				<div class="section-title">
					<h2>Fitur Wiyata</h2>
				</div>

				<div class="row">

					<div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

						<div class="content">
							<h3><strong>Fitur Aplikasi Wiyata</strong></h3>
							<h4>Pembelajaran Terintegrasi Dengan Mobile Apps</h4>
						</div>

						<div class="accordion-list">
							<ul>
								<li>
									<a data-toggle="collapse" class="collapse"><span>༶</span> Materi Pelajaran Bahasa Indonesia Kelas VIII</a>
								</li>

								<li>
									<a data-toggle="collapse" class="collapsed"><span>༶</span> Video Pembelajaran</a>
								</li>

								<li>
									<a data-toggle="collapse" class="collapsed"><span>༶</span> Tugas Setiap Bab</a>
								</li>

								<li>
									<a data-toggle="collapse" class="collapsed"><span>༶</span> Ruang Diskusi</a>
								</li>

							</ul>

							<a href="<?= base_url('Home/unduh_panduan') ?>" class="btn-get-paduan">Panduan <img class="mt-n1" src="<?= base_url('assets/home/icons/unduh.png') ?>"></a>

						</div>

					</div>

					<div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("<?= base_url('assets/home/icons/fiturImg.png') ?>");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
				</div>

			</div>
		</section><!-- Fitur Section -->

		<section id="contact" class="contact section-bg mt-n5">
			<div class="container" data-aos="fade-up">

				<div class="section-title">
					<h2>Kontak Kami Jika Anda Mengalami <br>
						Kendala Teknis Di E-Learning Wiyata </h2>
				</div>


				<div class="row">
					<div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
						<img src="<?= base_url('assets/home/icons/contactImg.png') ?>" class="img-fluid" alt="">
					</div>
					<div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">

						<div class="contact-content">

							<?= form_open_multipart('#', ['id' => 'tambahpesan']) ?>
							<div class="form-group">
								<label for="nama_user">Nama Anda</label>
								<input type="text" name="nama_user" class="form-control" />
								<div class="validate"></div>
								<div class="form-group">
									<label for="subject_name">Subject</label>
									<input type="text" class="form-control" name="subject_name" />
									<div class="validate"></div>
								</div>
								<div class="form-group">
									<label for="message">Keluhan Anda</label>
									<textarea class="form-control" name="message" rows="10"></textarea>
									<div class="validate"></div>
								</div>
								<div class="my-2" id="info-data"></div>
								<div class="form-group">
									<button type="submit" class="btn-message border-0">Kirim</button>
								</div>
								</form>

							</div>

						</div>
					</div>

				</div>
		</section><!-- End contact Section -->

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<footer id="footer">

		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-4 col-md-6 footer-contact">
						<h3>Kontak Kami</h3>
						<p>
							Jl.Kyai Badri Rt. 07 / 03 <br>
							Kec.Paguyangan<br>
							Kab. Brebes 52276 <br><br>
							<strong>CP :</strong> 087899703471<br>
						</p>
					</div>

					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Tentang Aplikasi</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Sistem Informasi</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Pembelajaran Online</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Elearning Wiyata</a></li>
						</ul>
					</div>

					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Sosial Media</h4>
						<div class="social-links mt-3">
							<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a> Facebook <br><br>
							<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a> Instagram
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="container footer-bottom clearfix">
			<div class="copyright" align="center">
				&copy; 2021<strong><span> Team Paradoks Technology</span></strong>
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
	<div id="preloader"></div>

	<!-- Vendor JS Files -->
	<script src="<?= base_url('assets/home/vendor/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/php-email-form/validate.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/waypoints/jquery.waypoints.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/venobox/venobox.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/owl.carousel/owl.carousel.min.js') ?>"></script>
	<script src="<?= base_url('assets/home/vendor/aos/aos.js') ?>"></script>

	<!-- SweetAlert -->
	<script src="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<!-- End SweetAlert -->	
	<!-- Template Main JS File -->
	<script src="<?= base_url('assets/home/js/main.js') ?>"></script>

	<script>
	$("#tambahpesan").submit(function(e) {
		e.preventDefault();
		var form = this;
		var formdata = new FormData(form);
		$.ajax({
			url: "<?= base_url('home/crud_pesan_aduan?type=addpesan') ?>",
			type: 'POST',
			data: formdata,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response) {
				$("#info-data").html(response.messages).attr("disabled", false).show();
				if (response.success == true) {
					swal.fire({
						icon: 'success',
						title: 'Pesan Aduan Tersampaikan',
						text: 'terima kasih telah mengirimkan pesan aduan kepada kami',
						showConfirmButton: false,
						timer: 1000,
					});
					form.reset();
				} else {
					swal.close();
				}
			},
			error: function() {
				swal.fire("Maaf Pesan Aduan Gagal Terkirim", "Ada kesalahan saat mengirimkan pesan aduan", "error");
			}
		})
	});
</script>

</body>


</html>
