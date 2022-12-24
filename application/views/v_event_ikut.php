<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$jmlevent = 0;
if ($eventaktif) {
	foreach ($eventaktif as $datane) {
		$jmlevent++;
		$code_event[$jmlevent] = $datane->code_event;
		$link_event[$jmlevent] = $datane->link_event;
		$nama_event[$jmlevent] = $datane->nama_event;
		$petunjuk[$jmlevent] = $datane->petunjukbayar;
		$sub_nama_event[$jmlevent] = $datane->sub_nama_event;
		$gambar[$jmlevent] = $datane->gambar;
		$file[$jmlevent] = $datane->file;
		$isi_event[$jmlevent] = $datane->isi_event;
		$pakaisertifikat[$jmlevent] = $datane->pakaisertifikat;
		$status_user[$jmlevent] = $datane->status_user;
		if ($status_user[$jmlevent] >= 1) {
			$order_id[$jmlevent] = $datane->order_id;
			$namabank[$jmlevent] = $datane->nama_bank;
			$norek[$jmlevent] = $datane->no_rek;
			$tglorder = $datane->tgl_bayar;
			$tglorder = new DateTime($tglorder);
			//$tglurl->setTimezone(new DateTimezone('Asia/Jakarta'));
			$tanggalorder = $tglorder->format('Y-m-d H:i:s');
			$tglorder->add(new DateInterval('P1D'));
			$tglbayar[$jmlevent] = $tglorder;

			$now = new DateTime();
			$now->setTimezone(new DateTimezone('Asia/Jakarta'));
			$tglsekarang = $now->format('Y-m-d H:i:s');

			$date1 = date_create($tanggalorder);
			$date2 = date_create($tglsekarang);
			$diffbyr = date_diff($date1, $date2);
			if ($diffbyr->format("%d") >= 1)
				$bayarexpired[$jmlevent] = true;
			else
				$bayarexpired[$jmlevent] = false;
		}
		$iuran[$jmlevent] = $datane->iuran;
	}
}

?>

<form id="payment-form" method="post" action="<?php echo base_url(); ?>payment/finish_event">
	<input type="hidden" name="result_type" id="result-type" value=""></div>
	<input type="hidden" name="result_data" id="result-data" value=""></div>
	<input type="hidden" name="kodeevent" id="kodeevent" value="<?php echo $code_event[1]; ?>"></div>
</form>

<!-- content begin -->
<div class="no-bottom no-top" id="content">
	<div id="top"></div>
	<!-- section begin -->
	<section id="subheader" class="text-light"
			 data-bgimage="url(<?php echo base_url(); ?>images/background/subheader.jpg) top">
		<div class="center-y relative text-center">
			<div class="container">
				<div class="row">

					<div class="col-md-12 text-center wow fadeInRight" data-wow-delay=".5s">
						<h1>Lokakarya / Seminar</h1>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- section close -->

	<section aria-label="section" class="pt30">
		<div class="container" style="color:black;max-width: 600px;text-align: center;margin:auto;">
			<?php { ?>
				<h3 style="color: black; font-weight: bold">Registrasi Event</h3>
				<?php for ($a = 1; $a <= 1; $a++) { ?>
					<center>
					<div class="row"
						 style="text-align:center;width:100%;border: #5faabd solid 1px;padding: 5px;padding-top: 15px">
						<h4 style="color: black"><?php echo $nama_event[$a]; ?></h4>
						<img style="text-align:center;max-width:800px;width:100%"
							 src="<?php echo base_url(); ?>uploads/event/<?php echo $gambar[$a]; ?>">
						<hr style="margin-top:20px;margin-bottom:20px;height:1px;border:none;color:#366e8f;background-color:#366e8f;"/>
						<center>
						<div class="row" style="font-size:16px;font-weight:bold;text-align:center;width:100%;">
							<?php echo $isi_event[$a]; ?>
						</div>
						</center>
						<hr style="height:1px;border:none;color:#366e8f;background-color:#366e8f;"/>
						<div class="row" style="text-align:center;width:100%;font-size: 16px;">
							<?php
							if ($status_user[$a] == 2) {
								?>
								<span
									style="font-weight: bold;font-size: 16px;">Anda telah terdaftar pada event ini.</span>
								<br>
							<?php } else if ($iuran[$a] == 0) {
								?>
<!--								Silakan klik tombol <span-->
<!--									style="font-weight: bold">Daftarkan Saya</span> untuk melanjutkan.-->
<!--								<br>-->
							<?php } else if ($status_user[$a] == 0 || ($status_user[$a] == 1 && $bayarexpired[$a] == true)) {
								if ($this->session->userdata('verifikator') == 3 || $viaver == 0) {
									?>
									<center>Silakan membayar biaya registrasi untuk melanjutkan.</center><br>
								<?php } else { ?>
									Khusus untuk yang sudah mendaftar sebagai Verifikator
								<?php }
								?>
							<?php } else if ($status_user[$a] == 1) { ?>
								Menunggu biaya pendaftaran sebesar <br> <span
									style="font-weight: bold">Rp <?php echo number_format($iuran[1], 0, ",", "."); ?>,-</span> ke rekening:
								<br>
								<span
									style="font-weight: bold">Midtrans via <?php echo strtoupper($namabank[1]); ?> : <?php echo $norek[1]; ?></span>
								<br>
								<button class="myButtongreen"
										onclick="window.open('<?php echo $petunjuk[$a]; ?>','_blank')"><span
										style="font-weight: bold">Petunjuk Bayar</span>
								</button>
							<?php } ?>

						</div>
<!--						<hr>-->
						<div class="row" style="text-align:center;width:100%">
							<?php
							if ($status_user[$a] < 2) {
								if ($iuran[$a] == 0) { ?>
									<button class="myButtonDonasi" id="daftarkansaya-button"><span
											style="font-weight: bold">Daftarkan Saya</span>
									</button>
									<br><br>
								<?php } else if ($status_user[$a] == 0 || ($status_user[$a] == 1 && $bayarexpired[$a] == true)) {
									if ($this->session->userdata('verifikator') == 3 || $viaver == 0) {
										?>
										<div class="container">
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<button class="btn-main"
															onclick="window.open('<?php echo base_url(); ?>event/acara/<?php echo $hal; ?>','_self')">
														Kembali
													</button>
													<button class="btn-main" id="pay-button">Bayar</button>
												</div>
											</div>
										</div>
									<?php } else {

									} ?>

								<?php }
							} else { ?>
								<div>
									<button class="btn-main"
											onclick="window.open('<?php echo base_url(); ?>event/acara/<?php echo $hal; ?>','_self')">
										OK
									</button>
								</div>
							<?php } ?>

						</div>
					</div>
					</center>
				<?php }
			}
			//else {?>
			<!--	<h3>Belum ada event khusus</h3>-->
			<?php //} ?>

		</div>
</div>

<script type="text/javascript">


	$('#pay-button').click(function (event) {
		event.preventDefault();

		$(this).attr("disabled", "disabled");

		setTimeout(() => {
			$(this).attr("disabled", false)
		}, 3000);

		$.ajax({
			url: '<?php echo base_url();?>payment/token_event/<?php echo $code_event[1];?>',
			cache: false,

			success: function (data) {
				//location = data;

				console.log('token = ' + data);

				var resultType = document.getElementById('result-type');
				var resultData = document.getElementById('result-data');

				function changeResult(type, data) {
					$("#result-type").val(type);
					$("#result-data").val(JSON.stringify(data));
					//resultType.innerHTML = type;
					//resultData.innerHTML = JSON.stringify(data);
				}

				snap.pay(data, {

					onSuccess: function (result) {
						changeResult('success', result);
						console.log(result.status_message);
						console.log(result);
						$("#payment-form").submit();
					},
					onPending: function (result) {
						changeResult('pending', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					},
					onError: function (result) {
						changeResult('error', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					}
				});
			}
		});
	});

	$('#daftarkansaya-button').click(function (event) {
		event.preventDefault();
		$(this).attr("disabled", "disabled");
		$.ajax({
			url: '<?php echo base_url();?>payment/free_event/<?php echo $code_event[1];?>',
			cache: false,
			success: function (data) {
				location.reload();
			}
		});
	});

</script>
