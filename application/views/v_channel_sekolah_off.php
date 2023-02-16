<div class="no-bottom no-top" id="content" style="margin: auto;">
	<div id="top"></div>
	<!-- section begin -->
	<section id="subheader" class="text-light"
			 data-bgimage="url(<?php echo base_url(); ?>images/background/subheader.jpg) top">
		<div class="center-y relative text-center">
			<div class="container">
				<div class="row">

					<div class="col-md-12 text-center wow fadeInRight" data-wow-delay=".5s">
						<h1>Panggung Sekolah</h1>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- section close -->


	<section aria-label="section" class="pt30">
		<div class="container">

			<div class="row">
				<div class="col-lg-12">
					<div id="jamsekarang"
						 style="font-weight: bold;color: black;float: right; margin-right: 20px"
						 id="jam">
					</div>
				</div>
			</div>

			<div class="col-lg-8 col-md-8"
				 style="background-color: transparent; font-weight: bold;font-size:16px;
		 position: relative ; top: 0px; text-align:center; color:black; margin-top:0px;">
				
				<!--		<br>-->
				<!--		<button onclick="hitunglagi();">Cek</button>-->
			</div>


			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div class="row content-block">
						<!--                <div class="indukplay" style="padding-top:0px;text-align:center;margin-left:auto;margin-right: auto;">-->
						<?php
						 {
							?>
							<img style="width: 100%" src="<?php echo base_url(); ?>assets/images/playlistoff.png"/>
						<?php }
						?>
						<!--                </div>-->
					</div>
					<div id="namachannel" style="display: inline-block;float: right"></div>
					<div id='seconds' style="display: inline-block"></div>
				</div>
				<div class="col-lg-4 col-md-4" style="background-color: #f6f6f6;padding-bottom: 30px;">
					<div class="row content-block">
						<div class="col-lg-12">
							<div style="text-align: center;font-weight: bold;font-size:16px;color:#000">
								JADWAL ACARA HARI INI [<?php echo $namahari; ?>]
							</div>
							<div id="tempatJadwal" style="font-size:15px;font-weight: normal;color:#000;height: 400px;overflow: auto;">

							</div>
						</div>

					</div>

				</div>

			</div>

		</div>


	</section>
</div>