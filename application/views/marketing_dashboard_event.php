<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo "<br><br><br><br><br>CEK TUKAN VERIFIKATOR:".$this->session->userdata('tukang_verifikasi');

?>

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
						<h1>Event Mentor</h1>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- section close -->


	<section aria-label="section" class="mt0 sm-mt-0">
		<div class="container">
			<div style="margin:auto;margin-bottom:20px;margin-top:-40px;">
			<center>
				[Agency: <?=$namaag?> - <?=$telpag?>]
			</center>
			</div>
			<div class="row">
					<div class="col-xl-3 col-md-6">
						<div class="card bg-primary text-white mb-4">
							<div class="card-body">Tahap Orientasi</div>
							<div class="card-footer align-items-center justify-content-between">
								<div>
									<b><?=$tglsekarang?></b>
								</div>
								<div>
								<div class="small text-white"><ul style="margin-left:-20px;"><li>Share Konten : <?=$jmlshare?> / <?=$minshare?></li></ul></div>
								<button class="btn-oyen"
								   onclick="window.open('<?php echo base_url(); ?>event/mentor_harian/','_self');">Share Konten
								</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6">
						<div class="card bg-color-2 text-white mb-4">
							<div class="card-body">Tahap Sosialisasi</div>
							<div class="card-footer align-items-center justify-content-between">
								<div>
									<b><?php echo nmbulan_pendek($bln_skr) .
											" " . $thn_skr; ?></b>
								</div>
								<div>
								<div class="small text-white"><ul style="margin-left:-20px;"><li>Membuat Event Calon Pengelola Channel (Verifikator) : <?=$jmlcalver?> / <?=$mincalver?></li></ul></div>
								<button class="btn-oyen"
								   onclick="window.open('<?php echo base_url(); ?>marketing/daftar_event_ver?dash=1','_self');">Buat Event
								</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-md-6">
						<div class="card bg-success text-white mb-4">
							<div class="card-body">Tahap Implementasi</div>
							<div class="card-footer align-items-center justify-content-between">
								<div>
									<b><?php echo nmbulan_pendek($bln_skr) .
											" " . $thn_skr; ?></b>
								</div>
								<div>
								<div class="small text-white"><ul style="margin-left:-20px;"><li>Membuat Event Penyusunan Modul Kelas Virtual (Kontributor): <br> <?=$jmleventmodul?> / <?=$minmodul?></li></ul></div>
								<button class="btn-oyen"
								onclick="window.open('<?php echo base_url(); ?>marketing/daftar_event?dash=1','_self');">Buat Event
								</button>
								</div>
							</div>
						</div>
					</div>

				<div class="col-xl-3 col-md-6">
					<div class="card bg-danger text-white mb-4">
						<div class="card-body">Tahap Pendampingan</div>
						<div class="card-footer align-items-center justify-content-between">
							<div>
								<b><?php echo nmbulan_pendek($bln_skr) .
										" " . $thn_skr; ?></b>
							</div>
							<div class="small text-white"><ul style="margin-left:-20px;"><li>Membuat Event Sekolah Model :<br> 1 / <?=$minsekolah?></li></ul></div>
								<!-- <button class="btn-oyen"
								   onclik="window.open('<?php// echo base_url(); ?>marketing/event_bulanan/','_self')">Buat Event
								</button> -->
								</div>
						</div>
					</div>
				</div>

			</div>
	</section>
</div>
