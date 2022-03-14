<footer>
    <center>&copy; 2021 Team Paradoks Technology</center> <br>
</footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url()?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url()?>assets/siswa/bootstrap/js/bootstrap.min.js"></script>

	<!-- Data Table CDN -->
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

	<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


	<!-- SweetAlert -->
	<script src="<?= base_url() ?>assets/admin/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<!-- End SweetAlert -->

	<!-- Flashdata -->
	<script	script type="text/javascript">
		$(function(){
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
		
		$(document).ready(function () {
			$("#show_hide_password button").on("click", function (event) {
				event.preventDefault();
				if ($("#show_hide_password input").attr("type") == "text") {
					$("#show_hide_password input").attr("type", "password");
					$("#show_hide_password span").addClass("fa-eye-slash");
					$("#show_hide_password span").removeClass("fa-eye");
				} else if ($("#show_hide_password input").attr("type") == "password") {
					$("#show_hide_password input").attr("type", "text");
					$("#show_hide_password span").removeClass("fa-eye-slash");
					$("#show_hide_password span").addClass("fa-eye");
				}
			});
		});
	</script>

	<!-- Ajax Logout -->
	<script>
		$(".logout").click(function(event) {
			event.preventDefault();
			Swal.fire({
				title: 'Anda Yakin Keluar?',
				text: 'Anda yakin ingin keluar dari kelas ini!',
				icon: 'warning',
				showConfirmButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Logout'
			}).then((result) => {
				if(result.value) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('auth/logout'); ?>",
						beforeSend: function() {
							swal.fire({
								imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
								title: "Logging Out",
								text: "Please wait",
								showConfirmButton: false,
								allowOutsideClick: false
							});
						},
						success: function(data) {
							swal.fire({
								icon: 'success',
								title: 'Logout',
								text: 'Anda Telah Keluar!',
								showConfirmButton: false,
								allowOutsideClick: false
							});
							window.location.href = "<?= base_url() ?>";
						}
					});
				}
			}); 
        });
	</script>
	
    <script>
		function load_process() {
            swal.fire({
                imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
                title: "Refresh Data",
                text: "Silahkan Tunggu",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1500
            });
        }
	</script>
	
	<script>
	    
	    $(document).ready(function() {
			$("#tugas-siswa-table a").click(function(e) {
				e.preventDefault();
				var id_bab 	= $(e.currentTarget).attr("data-bab-id");
				console.log(id_bab);
		
				$('#data-tugas-siswa').DataTable({
					destroy: true,
					"lengthMenu": [[10, 15, 25, -1], [10, 15, 25, "All"]],
					"ajax": {
						url: "<?= base_url('ruang_materi/BahanAjar/get_tabletugas'); ?>",
						type: 'POST',
						data : {
							id_bab : id_bab
						},
						async: true,
						dataType: 'json',
						"processing": true,
						"serverSide": true,
						"bDestroy": true,
					},
					rowCallback: function(row, data, iDisplayIndex) {
						$('td:eq(0)', row).html();
					},
				});
			});
		});


		function change_tbtugas(id_bab) {
			$('#data-tugas-siswa').DataTable({
				destroy: true,
				"lengthMenu": [[10, 15, 25, -1], [10, 15, 25, "All"]],
				"ajax": {
					url: "<?= base_url('ruang_materi/BahanAjar/get_tabletugas'); ?>",
					type: 'POST',
					data : {
						id_bab : id_bab
					},
					async: true,
					dataType: 'json',
					"processing": true,
					"serverSide": true,
					"bDestroy": true,
				},
				rowCallback: function(row, data, iDisplayIndex) {
					$('td:eq(0)', row).html();
				},
			});
		}
	    
	    // refresh table data guru
		$("#refresh-table-tugas").click(function(e) {
            e.preventDefault();
			var id_bab = $(e.currentTarget).attr('data-bab-id');
            load_process();
			change_tbtugas(id_bab);
        });
	    
		$("#accordionExample").on('click', '.upload-tugas', function(e) {
			e.preventDefault();
			var id_tugas = $(e.currentTarget).attr("data-tugas-id");
			var id_deadline = $(e.currentTarget).attr("deadline-tugas-id");
			var id_bab = $(e.currentTarget).attr("data-bab-id");
			if (id_tugas === '') return;
			if (id_deadline === '') return;
			if (id_bab === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('ruang_materi/BahanAjar/cek_deadline') ?>",
				data: {
					id_deadline : id_deadline
				},
				dataType: 'json',
				success: function(response) {
					if (response.success == true) {
						$.ajax({
							type: "POST",
							url: "<?= base_url('ruang_materi/BahanAjar/crud_tugassiswa?type=upload_tugas') ?>",
							data: {
								id_tugas: id_tugas
							},
							success: function(data) {
								swal.close();
								$('#kumpulkanTugas').modal('show');
								$('#uploadtugasmodal').html(data);
								$('#upload_tugas').submit(function(e) {
									e.preventDefault();
									var form = this;
									$("#uploadtugas-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
									var formdata = new FormData(form);
									$.ajax({
										url: "<?= base_url('ruang_materi/BahanAjar/crud_tugassiswa?type=do_upload') ?>",
										type: 'POST',
										data: formdata,
										processData: false,
										contentType: false,
										dataType: 'json',
										beforeSend: function() {
											swal.fire({
												imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
												title: "Upload Latihan Tugas",
												text: "silahkan tunggu",
												showConfirmButton: false,
												allowOutsideClick: false
											});
										},success: function(response) {
											if (response.success == true) {
												$('.text-danger').remove();
												swal.fire({
													icon: 'success',
													title: 'Upload Latihan Tugas Berhasil',
													text: 'Selamat, Latihan tugas Anda telah dikumpulkan',
													showConfirmButton: false,
													timer: 1500
												});
												change_tbtugas(id_bab);
												$('#data-tugas-siswa').DataTable().ajax.reload();
												$('#kumpulkanTugas').modal('hide');
												form.reset();
												$("#uploadtugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
											} else {
												swal.close()
												$("#uploadtugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
												$("#info-upload").html(response.messages);
											}
										},
										error: function() {
											swal.fire("Upload Latihan Tugas Gagal", "Ada Kesalahan Saat Upload Latihan Tugas!", "error");
											$("#uploadtugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
										}
									});
								});
							}
						});
					} else {
						swal.fire("Anda Terlambat!", "Waktu Pengumpulan Tugas Latihan Telah Berakhir", "warning");
					}
				}
			});
			
		});

		$("#data-tugas-siswa").on('click', '.edit-tugas', function(e) {
			e.preventDefault();
			var id_tugas_siswa = $(e.currentTarget).attr("data-upload-id");
			var id_deadline = $(e.currentTarget).attr("deadline-tugas-id");
			var id_bab = $(e.currentTarget).attr("data-bab-id");
			console.log(id_tugas_siswa); 
			if (id_tugas_siswa === '') return;
			$.ajax({
				type: "POST",
				url: "<?= base_url('ruang_materi/BahanAjar/cek_deadline') ?>",
				data: {
					id_deadline : id_deadline
				},
				dataType: 'json',
				success: function(response) {
                    if (response.success == true) {
						$.ajax({
							type: "POST",
							url: "<?= base_url('ruang_materi/BahanAjar/crud_tugassiswa?type=update_tugas') ?>",
							data: {
								id_tugas_siswa: id_tugas_siswa
							},
							success: function(data) {
								swal.close();
								$('#editTugas').modal('show');
								$('#updatetugassiswa').html(data);
								$('#update_tugas').submit(function(e) {
									e.preventDefault();
									var form = this;
									$("#updatetugas-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
									var formdata = new FormData(form);
									$.ajax({
										url: "<?= base_url('ruang_materi/BahanAjar/crud_tugassiswa?type=do_update') ?>",
										type: 'POST',
										data: formdata,
										processData: false,
										contentType: false,
										dataType: 'json',
										beforeSend: function() {
											swal.fire({
												imageUrl: "<?= base_url('assets/admin/icons/rolling.png'); ?>",
												title: "Update Latihan Tugas",
												text: "silahkan tunggu",
												showConfirmButton: false,
												allowOutsideClick: false
											});
										},success: function(response) {
											if (response.success == true) {
												$('.text-danger').remove();
												swal.fire({
													icon: 'success',
													title: 'Update Latihan Tugas Berhasil',
													text: 'Selamat, Latihan tugas Anda telah dikumpulkan',
													showConfirmButton: false,
													timer: 1500
												});
												change_tbtugas(id_bab);
												$('#data-tugas-siswa').DataTable().ajax.reload();
												$('#editTugas').modal('hide');
												form.reset();
												$("#updatetugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
											} else {
												swal.close()
												$("#updatetugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
												$("#info-update").html(response.messages);
											}
										},
										error: function() {
											swal.fire("Update Latihan Tugas Gagal", "Ada Kesalahan Saat Update Latihan Tugas!", "error");
											$("#updatetugas-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
										}
									});
								});
							}
						});
					} else {
						swal.fire("Anda Terlambat!", "Waktu Pengumpulan Tugas Latihan Telah Berakhir", "warning");
					}
				}
			});
		});

		$("#accordionExample").on('click', '.cek-tugas', function(e) {
			e.preventDefault();
			swal.fire({
				title: 'Pemberitahuan!',
				text: 'Belum ada intruksi untuk mengerjakan tugas dari Guru',
			});	
		});
	</script>
	<script>
		$("#info-uk-siswa").on('click', '.cek-nilai', function(e) {
			e.preventDefault();
			var id_bab 	= $(e.currentTarget).attr("data-bab-id");
			window.location = "<?=base_url('uji_kompetensi/Ujian/nilai_ujian')?>/"+id_bab;
		});

		$("#info-uk-siswa").on('click', '.mulai-ujian', function(e) {
			e.preventDefault();
			var id_bab 	= $(e.currentTarget).attr("data-bab-id");
			console.log(id_bab);
			$.ajax({
				type: "POST",
				url: "<?= base_url('uji_kompetensi/Ujian/cek_ujian') ?>",
				data: {
					id_bab : id_bab
				},
				dataType: 'json',
				success: function(response) {
					console.log(response);
                    if (response.success == true) {
						window.location = "<?= base_url('uji_kompetensi/Ujian/uji_kompetensiEssay')?>/"+id_bab;
                    } else {
						Swal.fire({
							icon: 'warning',
							title: 'Oppss...',
							text: response.msgujian,
						})
					}
				}

			});
		});
	</script>
	
	<script>
		$("#refresh-diskusi").click(function(e) {
            e.preventDefault();
			load_comment();
        });

		$('#berdiskusi').submit(function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            $.ajax({
                url: "<?= base_url('ruang_diskusi/Diskusi/submit_diskusi'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Komentar Berhasil',
                            text: 'Penambahan komentar sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
    					$('#diskusi_id').val('0');
    					load_comment();
						form.reset();

                    }
                },
                error: function() {
                    swal.fire("Penambahan Komentar Gagal", "Ada Kesalahan Saat penambahan Komentar!", "error");
                }
            });
        });

		load_comment();

		function load_comment(){
			var id_info = $("#id_forum").val();
			console.log(id_info);
				$.ajax({
					type:"POST",
					url:"<?= base_url('ruang_diskusi/Diskusi/get_komentar') ?>",
					data: {
						id_info : id_info
					},
					dataType: 'json',
					success:function(reponse){
						$('#display_forum').html(reponse);
					}, error: function(reponse) {
		            	console.log(reponse.responseText)
		            }
				})
			}
			$(document).on('click', '.reply', function(e){
				var id_forum = $(e.target).attr("id-forum");
				$('#diskusi_id').val(id_forum);
				$('#isi_diskusi').focus();
			});
	</script>
</body>
</html>
