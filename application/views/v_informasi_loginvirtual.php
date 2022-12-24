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
						<h1>Informasi</h1>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- section close -->

	<section aria-label="section" class="mt0 sm-mt-0">
		<div class="container">
			<div style="font-size: larger; color: black">
				<center>Silakan Anda login sebagai <b>Guru</b> yang terdaftar di <b><?=$nama_sekolah?></b> terlebih dahulu untuk mengikuti event ini. Atau silakan daftar dahulu.
				<br><br>	<button class="btn-primary" onclick="window.open('<?=base_url()?>login', '_self');">Login</button>
				<button class="btn-primary" onclick="window.open('<?=base_url()?>login/registrasi/guru/<?=$kd_ref?>', '_self');">Daftar</button>
				</center>
			</div>
		</div>
	</section>
</div>
