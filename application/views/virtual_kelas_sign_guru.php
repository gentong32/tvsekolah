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
						<h1>Kelas Virtual</h1>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- section close -->
	<section id="section-collections" class="pt30">
		<div class="container">
			<div class="row wow fadeIn">
				<div class="col-lg-12">
					<p class="text-center">Pilih akses yang anda inginkan</p>
				</div>
			</div>
			<div class="row d-flex justify-content-center">

				<div class="video__item style-2" style="max-width:300px;">
					<div class="video__item_wrap">
						<div class="video__item_extra">
							<div class="video__item_buttons">
								<p>Untuk memanfaatkan fitur ini anda harus login terlebih dahulu</p>
								<button onclick="location.href='login.html'">Login</button>
							</div>
						</div>
						<div>
							<a href="<?php echo base_url(); ?>virtualkelas/modul_guru/saya">
								<img src="<?php echo base_url(); ?>images/fitur/sekolah-saya.jpg"
									 class="lazy video__item_preview" alt="" style="cursor: pointer">
							</a>
						</div>
					</div>
					<div class="video__item_info">
						<a>
							<h3 align="center">Modul Sekolah</h3>
						</a>
					</div>
				</div>
				<?php if ($this->session->userdata('bimbel')==3 || $this->session->userdata('bimbel')==4) {?>
				<div class="video__item style-2" style="max-width:300px;">
					<div class="video__item_wrap">
						<div class="video__item_extra">
							<div class="video__item_buttons">
								<p>Untuk memanfaatkan fitur ini anda harus login terlebih dahulu</p>
								<button onclick="#">Login</button>
							</div>
						</div>
						<div>
							<a href="<?php
							if ($this->session->userdata('bimbel')==3)
								echo base_url()."bimbel/modul_saya";
							else if ($this->session->userdata('bimbel')==4)
								echo base_url()."video/bimbel";
							else if ($this->session->userdata('sebagai')==1)
								echo base_url()."/";?>">
								<img src="<?php echo base_url(); ?>images/fitur/bimbel-online.jpg"
									 class="lazy video__item_preview" alt="" style="cursor: pointer">
							</a>
						</div>
					</div>
					<div>
						<a>
							<h3 align="center">Modul Bimbel</h3>
						</a>
					</div>

				</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>


<!-- content close -->
