<script>document.getElementsByTagName("html")[0].className += " js";</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/tab_style.css?ver=2">
<style>
	.inputan1 {
		text-align: center
	}
</style>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$jenisvideo = array("", "Modul", "Bimbel");
if (isset($jenisvidevent))
	$jenisnya = " " . $jenisvideo[$jenisvidevent];
else {
	$jenisnya = "";
	$jenisvidevent = 0;
}

if (!isset($linkevent))
	$linkevent = "";

if (!isset($linkdari))
	$linkdari = "video";

if (!isset($asal))
	$asal = "";
else
	$asal="/".$asal;

$jml_kurikulum = 0;
foreach ($dafkurikulum as $datane) {
	$jml_kurikulum++;
	$sel_kurikulum[$jml_kurikulum] = "";
	$nama_kurikulum[$jml_kurikulum] = $datane->kurikulum;
}

$jml_jenjang = 0;
foreach ($dafjenjang as $datane) {
	$jml_jenjang++;
	$sel_jenjang[$jml_jenjang] = "";
	$id_jenjang[$jml_jenjang] = $datane->id;
	$nama_jenjang[$jml_jenjang] = $datane->nama_jenjang;
}

$jml_kategori = 0;
foreach ($dafkategori as $datane) {
	$jml_kategori++;
	$sel_kategori[$jml_kategori] = "";
	$id_kategori[$jml_kategori] = $datane->id;
	$nama_kategori[$jml_kategori] = $datane->nama_kategori;
}

if ($addedit == "edit") {
	$judulvideo = substr($datavideo['file_video'], 0, strlen($datavideo['file_video']) - 20);
//echo "Jdl:".($judulvideo);
//die();
	$jml_kd1 = 0;
	foreach ($dafkd1 as $datane) {
		$jml_kd1++;
		$sel_kd1_1[$jml_kd1] = "";
		$sel_kd1_2[$jml_kd1] = "";
		$sel_kd1_3[$jml_kd1] = "";
		$id_kd1[$jml_kd1] = $datane->id;
		$nama_kd1[$jml_kd1] = $datane->nama_kd;

		//  echo $nama_kd1[$jml_kd1]."<br>";
	}

	$jml_kd2 = 0;
	foreach ($dafkd2 as $datane) {
		$jml_kd2++;
		$sel_kd2_1[$jml_kd2] = "";
		$sel_kd2_2[$jml_kd2] = "";
		$sel_kd2_3[$jml_kd2] = "";
		$id_kd2[$jml_kd2] = $datane->id;
		$nama_kd2[$jml_kd2] = $datane->nama_kd;
	}

}

$sel_standar[1] = "";
$sel_standar[2] = "";
$sel_jenis[1] = "";
$sel_jenis[2] = "";
$disp[1] = "";
$disp[2] = "";
$sel_ki1[1] = "";
$sel_ki1[2] = "";
$sel_ki1[3] = "";
$sel_ki1[4] = "";
$sel_ki2[1] = "";
$sel_ki2[2] = "";
$sel_ki2[3] = "";
$sel_ki2[4] = "";
$judul = "";
$topik = "";
$deskripsi = "";
$keyword = "";
$link_video = "";


if ($addedit == "add") {
	$judule = "Tambahkan Video";
	$sel_jenis[1] = "selected";
	$disp[2] = 'style="display:none;"';
	$thumbs = "blank.jpg";
	$durjam = "00";
	$durmenit = "00";
	$durdetik = "00";
	$jenjang = 0;
	$kaikade = "none";
	$dekelas = "block";
	$demapel = "block";
	if (!isset($judulvideo))
		$file_video = "";
} else {
	$judule = "Edit Video";
	$sel_jenis[$datavideo['id_jenis']] = "selected";
	$sel_kategori[$datavideo['id_kategori']] = "selected";
	$jenjang = $datavideo['id_jenjang'];

	if ($datavideo['kdnpsn'] == 0) {
		$sel_standar[1] = "selected";
		$sel_standar[2] = "";
	} else {
		$sel_standar[1] = "";
		$sel_standar[2] = "selected";
	}

	if ($datavideo['kdkur'] == "k13") {
		$sel_kurikulum[1] = "selected";
		$sel_kurikulum[2] = "";
	} else {
		$sel_kurikulum[1] = "";
		$sel_kurikulum[2] = "selected";
	}

	if ($datavideo['id_jenis'] == 2) {
		$disp[1] = 'style="display:none;"';
		$disp[2] = 'style="display:block;"';
	} else {
		$disp[1] = 'style="display:block;"';
		$disp[2] = 'style="display:none;"';
	}
	$sel_jenjang[$jenjang] = "selected";

	$jml_kelas = 0;
	foreach ($dafkelas as $datane) {
		$jml_kelas++;
		$id_kelas[$jml_kelas] = $datane->id;
		$nama_kelas[$jml_kelas] = $datane->nama_kelas;
	}
	for ($a1 = 1; $a1 <= 50; $a1++)
		$sel_kelas[$a1] = "";
	$sel_kelas[$datavideo['id_kelas']] = "selected";

	$jml_mapel = 0;
	foreach ($dafmapel as $datane) {
		$jml_mapel++;
		$sel_mapel[$jml_mapel] = "";
		$id_mapel[$jml_mapel] = $datane->id;
		$nama_mapel[$jml_mapel] = $datane->nama_mapel;
	}
	for ($a1 = 1; $a1 <= 50; $a1++)
		$sel_mapel[$a1] = "";

	if ($jenjang == 5) {
		$jml_jurusan = 0;
		foreach ($dafjurusan as $datane) {
			$jml_jurusan++;
			$sel_jurusan[$jml_jurusan] = "";
			$id_jurusan[$jml_jurusan] = $datane->id;
			$nama_jurusan[$jml_jurusan] = $datane->nama_jurusan;
		}
		for ($a1 = 1; $a1 <= $jml_jurusan; $a1++)
			$sel_jurusan[$a1] = "";
	} else if ($jenjang == 6) {
		$jml_jurusan = 0;
		foreach ($dafjurusanpt as $datane) {
			$jml_jurusan++;
			$sel_jurusan[$jml_jurusan] = "";
			$id_jurusan[$jml_jurusan] = $datane->id;
			$nama_jurusan[$jml_jurusan] = $datane->nama_jurusan;
		}
		for ($a1 = 1; $a1 <= $jml_jurusan; $a1++)
			$sel_jurusan[$a1] = "";
	}

	for ($a1 = 1; $a1 <= 200; $a1++) {
		$sel_kd1_1[$a1] = "";
		$sel_kd1_2[$a1] = "";
		$sel_kd1_3[$a1] = "";
		$sel_kd2_1[$a1] = "";
		$sel_kd2_2[$a1] = "";
		$sel_kd2_3[$a1] = "";
	}

	$sel_mapel[$datavideo['id_mapel']] = "selected";
	$sel_jurusan[$datavideo['id_jurusan']] = "selected";

	$sel_ki1[$datavideo['id_ki1']] = "selected";
	$sel_ki2[$datavideo['id_ki2']] = "selected";
	$sel_kd1_1[$datavideo['id_kd1_1']] = "selected";
	$sel_kd1_2[$datavideo['id_kd1_2']] = "selected";
	$sel_kd1_3[$datavideo['id_kd1_3']] = "selected";
	$sel_kd2_1[$datavideo['id_kd2_1']] = "selected";
	$sel_kd2_2[$datavideo['id_kd2_2']] = "selected";
	$sel_kd2_3[$datavideo['id_kd2_3']] = "selected";
	$judul = $datavideo['judul'];
	$topik = $datavideo['topik'];
	$deskripsi = $datavideo['deskripsi'];
	$keyword = $datavideo['keyword'];
	$status_video = $datavideo['status_verifikasi'];
	$link_video = $datavideo['link_video'];
	$file_video = $datavideo['file_video'];
	$channel = $datavideo['channeltitle'];
	$namafile = substr($file_video, 0, strlen($file_video) - 3) . rand(1, 32000) . '.jpg';
	$durasi = $datavideo['durasi'];
	$thumbs = $datavideo['thumbnail'];
//    if (substr($thumbs, 0, 4) != "http" && $thumbs != "")
	/*        $thumbs = "<?php echo base_url(); ?>uploads/thumbs/" . $thumbs;*/

	// if ($link_video!="")
	// 	$thumbs=substr($link_video,-11).'.';
	// else if ($file_video!="")
	// 	$thumbs=substr($file_video,0,strlen($file_video)-3);
//		if ($durasi=="")
//			$durasi = $infodurasi;
//    echo "<br><br><br><br>DURASI:".$durasi;
	$durjam = substr($durasi, 0, 2);
	$durmenit = substr($durasi, 3, 2);
	$durdetik = substr($durasi, 6, 2);

	if ($durjam == "")
		$durjam = "--";
	if ($durmenit == "")
		$durmenit = "--";
	if ($durdetik == "")
		$durdetik = "--";

	if ($jenjang == 1 || $jenjang == 6)
		$kaikade = "none";
	else
		$kaikade = "none";

	if ($jenjang == 6)
		$dekelas = "none";
	else
		$dekelas = "block";

//	if($jenjang==1)
//		$demapel="none";
//	else
	$demapel = "block";

}


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
						<h1>VIDEO</h1>
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

				<center><span style="font-size:20px;font-weight:Bold;"><?php echo $judule . $jenisnya; ?></span>
					<br>
					<h3><?php if ($linkdari == "event") {
							echo $dataevent[0]->nama_event;
						} ?></h3>
				</center>
				<?php if ($addedit == "edit" && ($file_video != "")) { ?>
					<div style="text-align: center;margin: auto">
						<button class="btn btn-primary" onclick="window.history.back();">Kembali</button>
						<button class="btn btn-primary" onclick="return editmp4(<?php echo $datavideo['id_video']; ?>)">
							Ganti Video
						</button>
					</div>
				<?php } else { ?>
					<div style="text-align: center;margin: auto">
						<button class="btn btn-primary" onclick="window.history.back();">Kembali</button>
					</div>
				<?php } ?>

				<div class="row">
					<?php
					if ($asal=="/evm")
						echo form_open($linkdari . '/addvideo'.$asal.'/'.$kodeevent.'/'.$bulan.'/'.$tahun);
					else if ($linkdari=="calver")
					{
							if (isset($kodeevent))
								echo form_open('event/addvideo/'.$kodeevent);
							else
								echo form_open('event/addvideo');
					}
					else
					{
							echo form_open($linkdari . '/addvideo'.$asal);
					}
					?>


					<div
						class="cd-tabs cd-tabs--vertical js-cd-tabs">

						<nav class="cd-tabs__navigation">
							<ul class="cd-tabs__list">
								<li>
									<a href="#tab-inbox" class="cd-tabs__item cd-tabs__item--selected">
										<!--                        <svg aria-hidden="true" class="icon icon&#45;&#45;xs"><path d="M15,0H1C0.4,0,0,0.4,0,1v14c0,0.6,0.4,1,1,1h14c0.6,0,1-0.4,1-1V1C16,0.4,15.6,0,15,0z M14,2v7h-3 c-0.6,0-1,0.4-1,1v2H6v-2c0-0.6-0.4-1-1-1H2V2H14z"></path></svg>-->
										<span>Sasaran</span>
									</a>
								</li>

								<li>
									<a href="#tab-new" class="cd-tabs__item">
										<!--                        <svg aria-hidden="true" class="icon icon--xs"><path d="M12.7,0.3c-0.4-0.4-1-0.4-1.4,0l-7,7C4.1,7.5,4,7.7,4,8v3c0,0.6,0.4,1,1,1h3 c0.3,0,0.5-0.1,0.7-0.3l7-7c0.4-0.4,0.4-1,0-1.4L12.7,0.3z M7.6,10H6V8.4l6-6L13.6,4L7.6,10z"></path><path d="M15,10c-0.6,0-1,0.4-1,1v3H2V2h3c0.6,0,1-0.4,1-1S5.6,0,5,0H1C0.4,0,0,0.4,0,1v14c0,0.6,0.4,1,1,1h14 c0.6,0,1-0.4,1-1v-4C16,10.4,15.6,10,15,10z"></path></svg>-->
										<span>Data</span>
									</a>
								</li>

							</ul> <!-- cd-tabs__list -->
						</nav>

						<ul class="cd-tabs__panels">
							<li id="tab-inbox" class="cd-tabs__panel cd-tabs__panel--selected text-component">
								<legend>Jenis dan Sasaran</legend>

								<?php if (($file_video != "") && ($this->session->userdata('tukang_kontribusi') == 2 || $this->session->userdata('tukang_verifikasi') == 2)) { ?>
									<div class="form-group">
										<label for="inputDefault" class="col-md-12 control-label">Video yang
											diunggah:</label>
										<div class="col-md-12" style="padding-bottom:10px">
											<?php echo $judulvideo; ?>
											<br>

											<video id="video_playermp4" width="320" height="240" controls>
												<source
													src="<?php echo base_url(); ?>uploads/tve/<?php echo $file_video; ?>"
													type="video/mp4">
											</video>

											<canvas style="display: none;" id="canvas-element"></canvas>
											<br>
											<?php if ($addedit == "add" || $thumbs == "") { ?>
												<img id="thumb1" style="margin-left:auto; align:middle;width:200px;"
													 src="">
											<?php } else { ?>
												<img id="thumb1" style="align:middle;width:200px;"
													 src="<?php echo $thumbs; ?>">
											<?php } ?>
											<?php if ($addedit == "edit") { ?>
												&nbsp;<br>
												<button class="btn btn-default" onclick="return sethumb()">Set
													Thumbnail
												</button>
											<?php } ?>

										</div>
									</div>
									<label for="inputDefault" class="col-md-12 control-label">Durasi
										(Jam:Menit:Detik)</label>

									<div class="col-md-12">
										<input style="display:inline;width:25px;height:25px;margin:0;padding:0"
											   type="text"
											   class="form-control inputan1" id="idurjam" name="idurjam" maxlength="2"
											   value="<?php echo $durjam; ?>" readonly placeholder="--">
										:
										<input style="display:inline;width:25px;height:25px;margin:0;padding:0"
											   type="text"
											   class="form-control inputan1" id="idurmenit" name="idurmenit"
											   maxlength="2"
											   value="<?php echo $durmenit; ?>" readonly placeholder="--">
										:
										<input style="display:inline;width:25px;height:25px;margin:0;padding:0"
											   type="text"
											   class="form-control inputan1" id="idurdetik" name="idurdetik"
											   maxlength="2"
											   value="<?php echo $durdetik; ?>" readonly placeholder="--">
									</div>
									<?php
								}
								?>


								<div class="form-group" id="djenis">
									<label for="select" class="col-md-12 control-label">Jenis</label>
									<div class="col-md-12">
										<select class="form-control" name="ijenis" id="ijenis">
											<option <?php echo $sel_jenis[1]; ?> value="1">Konten Instruksional</option>
											<option <?php echo $sel_jenis[2]; ?> value="2">Konten Non Instruksional
											</option>
										</select>
									</div>
								</div>

								<div id="grupins" <?php echo $disp[1]; ?>>

									<div class="form-group" id="dkurikulum"><br>
										<label for="select" class="col-md-12 control-label">Kurikulum</label>
										<div class="col-md-12">
											<select class="form-control" name="ikurikulum" id="ikurikulum">
												<?php
												for ($b0 = 1; $b0 <= $jml_kurikulum; $b0++) {
													echo '<option ' . $sel_kurikulum[$b0] . ' value="' . $nama_kurikulum[$b0] . '">' . $nama_kurikulum[$b0] . '</option>';
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group" id="dstandar"><br>
										<label for="select" class="col-md-12 control-label">Standar Kurikulum</label>
										<div class="col-md-12">
											<select class="form-control" name="istandar" id="istandar">
												<option <?php echo $sel_standar[1]; ?> value="0">Nasional</option>
												<?php if ($this->session->userdata('sebagai') != 4 && !$this->session->userdata('a01')) { ?>
													<option <?php echo $sel_standar[2]; ?>
														value="<?php echo $this->session->userdata('npsn'); ?>">Standar
														Sekolah
													</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="form-group" id="djenjang"><br>
										<label for="select" class="col-md-12 control-label">Jenjang</label>
										<div class="col-md-12">
											<select class="form-control" name="ijenjang" id="ijenjang">
												<option value="0">-- Pilih --</option>
												<?php
												for ($b1 = 1; $b1 <= $jml_jenjang; $b1++) {
													echo '<option ' . $sel_jenjang[$b1] . ' value="' . $id_jenjang[$b1] . '">' . $nama_jenjang[$b1] . '</option>';
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group" id="djurusan">
										<?php
										if ($addedit == "edit" && ($jenjang == 5 ||
												$jenjang == 6)) { ?>
											<br>
											<label for="select" class="col-md-12 control-label">Jurusan</label>
											<div class="col-md-12">
												<select class="form-control" name="ijurusan" id="ijurusan">
													<option value="0">-- Semua Jurusan --</option>
													<?php
													if ($addedit == "edit")
														for ($bc11 = 1; $bc11 <= $jml_jurusan; $bc11++) {
															echo '<option ' . $sel_jurusan[$id_jurusan[$bc11]] . ' value="' . $id_jurusan[$bc11] . '">' . $nama_jurusan[$bc11] . '</option>';
														}
													?>
												</select>
											</div>
										<?php } ?>
									</div>


									<div class="form-group" id="dkelas" style="display:<?php echo $dekelas; ?>;"><br>
										<label for="select" class="col-md-12 control-label">Kelas</label>
										<div class="col-md-12">
											<?php if ($jenjang != 6) { ?>
												<select class="form-control" name="ikelas" id="ikelas">
													<option value="0">-- Pilih --</option>
													<?php
													if ($addedit == "edit")
														for ($b11 = 1; $b11 <= $jml_kelas; $b11++) {
															echo '<option ' . $sel_kelas[$id_kelas[$b11]] . ' value="' . $id_kelas[$b11] . '">' . $nama_kelas[$b11] . '</option>';
														}
													?>
												</select>
											<?php } else { ?>
												<select class="form-control" name="ikelas" id="ikelas">
													<option value="0">-</option>
												</select>
											<?php } ?>
										</div>
									</div>

									<div class="form-group" id="dtema">
										<?php
										if ($addedit == "edit" && $jenjang == 2) { ?>
											<br>
											<label for="select" class="col-md-12 control-label">Tema</label>
											<div class="col-md-12">
												<select class="form-control" name="itema" id="itema">
													<option value="0">-- Pilih --</option>
													<?php
													if ($addedit == "edit")
														for ($bb11 = 1; $bb11 <= $jml_tema; $bb11++) {
															echo '<option ' . $sel_tema[$id_tema[$bb11]] . ' value="' . $id_tema[$bb11] . '">' . $nama_tema[$bb11] . '</option>';
														}
													?>
												</select>
											</div>
										<?php } ?>
									</div>


									<div class="form-group" id="dmapel" style="display:<?php echo $demapel; ?>;"><br>
										<label for="select" class="col-md-12 control-label">Mata Pelajaran</label>
										<div class="col-md-12">
											<select class="form-control" name="imapel" id="imapel">
												<option value="0">-- Pilih --</option>

												<?php
												if ($addedit == "edit")
													for ($b12 = 1; $b12 <= $jml_mapel; $b12++) {
														echo '<option ' . $sel_mapel[$id_mapel[$b12]] . ' value="' . $id_mapel[$b12] . '">' . $nama_mapel[$b12] . '</option>';
													}
												?>
											</select>
										</div>
									</div>

									<div id="bki" style="display: <?php echo $kaikade; ?>;" class="form-group"><br>
										<label for="inputDefault" class="col-md-12 control-label">Kompetensi
											Inti </label>
										<div class="col-md-12">
											<table>
												<tr>
													<td style='width:auto'>
														<div id="isidki">
															<select class="form-control" name="iki1" id="iki1">
																<option value="0">-- Pilih --</option>
																<?php

																if ($jenjang == 1) {
																	echo '<option ' . $sel_ki1[1] . ' value = "1" > Sikap Religius </option>' .
																		'<option ' . $sel_ki1[2] . ' value = "2" > Sikap Sosial </option>' .
																		'<option ' . $sel_ki1[3] . ' value = "3" > Pengetahuan </option>' .
																		'<option ' . $sel_ki1[4] . ' value = "4" > Ketrampilan </option>';
																} else {
																	echo '<option ' . $sel_ki1[3] . ' value = "3" > Pengetahuan </option>' .
																		'<option ' . $sel_ki1[4] . ' value = "4" > Ketrampilan </option>';
																}
																?>
															</select>
														</div>
													</td>
													<td style='width:50px'>
														&nbsp;<button class="btn btn-default"
																	  onclick="return tambahki()">+
														</button>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<div id="dkd1_1" class="form-group" style="display:<?php echo $kaikade; ?>;"><br>
										<label for="inputDefault" class="col-md-12 control-label">Kompetensi
											Dasar</label>
										<div class="col-md-12" style='padding-bottom:5px;left:10px;'>
											<table>
												<tr>
													<td style='width:auto'>
														<div id="isidkd1_1">
															<select class="form-control" name="ikd1_1" id="ikd1_1">
																<option value="0">-- Pilih --</option>

																<?php
																if ($addedit == "edit")
																	for ($b13 = 1; $b13 <= $jml_kd1; $b13++) {
																		echo '<option ' . $sel_kd1_1[$id_kd1[$b13]] . ' value="' . $id_kd1[$b13] . '">' . $nama_kd1[$b13] . '</option>';
																	}
																?>
															</select>
														</div>
													</td>
													<td style='width:50px'>
														&nbsp;<button class="btn btn-default"
																	  onclick="return tambahkd('1_2')">+
														</button>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<div id='dkd1_2' class="col-md-12" style='padding-bottom:5px;left:10px;display:<?php
									if ($addedit == 'edit') {
										if ($datavideo["id_kd1_2"] > 0) echo 'block'; else echo 'none';
									} else echo 'none'; ?>'>
										<table>
											<tr>
												<td style='width:auto'>
													<div id="isidkd1_2">
														<select class="form-control" name="ikd1_2" id="ikd1_2">
															<option value="0">-- Pilih --</option>

															<?php
															if ($addedit == "edit")
																for ($b14 = 1; $b14 <= $jml_kd1; $b14++) {
																	echo '<option ' . $sel_kd1_2[$id_kd1[$b14]] . ' value="' . $id_kd1[$b14] . '">' . $nama_kd1[$b14] . '</option>';
																}
															?>
														</select>
													</div>
												</td>
												<td style='width:auto'>
													&nbsp;<button class="btn btn-default"
																  onclick="return tambahkd('1_3')">+
													</button>
												</td>
												<td style='width:50px'>
													<button class="btn btn-default" onclick="return hapuskd('1_2')">-
													</button>
												</td>
											</tr>
										</table>
									</div>

									<div id='dkd1_3' class="col-md-12" style='padding-bottom:5px;left:10px;display:<?php
									if ($addedit == 'edit') {
										if ($datavideo["id_kd1_3"] > 0) echo 'block'; else echo 'none';
									} else echo 'none'; ?>'>
										<table>
											<tr>
												<td style='width:auto'>
													<div id="isidkd1_3">
														<select class="form-control" name="ikd1_3" id="ikd1_3">
															<option value="0">-- Pilih --</option>

															<?php
															if ($addedit == "edit")
																for ($b15 = 1; $b15 <= $jml_kd1; $b15++) {
																	echo '<option ' . $sel_kd1_3[$id_kd1[$b15]] . ' value="' . $id_kd1[$b15] . '">' . $nama_kd1[$b15] . '</option>';
																}
															?>
														</select>
													</div>
												</td>
												<td style='width:auto'>
													&nbsp;<button class="btn btn-default"
																  onclick="return hapuskd('1_3')">-
													</button>
												</td>
												<td style='width:50px'>

												</td>
											</tr>
										</table>
									</div>


									<!-- /////////////////////////////////////////////////// -->
									<div id="dki2" class="form-group" style='display:<?php
									if ($addedit == 'edit') {
										if ($datavideo["id_ki2"] > 0) echo 'block'; else echo 'none';
									} else echo 'none'; ?>'><br>
										<label for="inputDefault" class="col-md-12 control-label">Kompetensi Inti
											2</label>
										<div class="col-md-12">
											<table>
												<tr>
													<td style='width:auto'>
														<select class="form-control" name="iki2" id="iki2">
															<option value="0">-- Pilih --</option>

														</select>
													</td>
													<td style='width:50px'>
														&nbsp;<button class="btn btn-default"
																	  onclick="return hapuski()">-
														</button>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<div id="dkd2_1" class="form-group" style='display:<?php
									if ($addedit == 'edit') {
										if ($datavideo["id_kd2_1"] > 0) echo 'block'; else echo 'none';
									} else echo 'none'; ?>;left:10px;'><br>
										<label for="inputDefault" class="col-md-12 control-label">Kompetensi
											Dasar</label>
										<div class="col-md-12" style='padding-bottom:5px;left:10px;'>
											<table>
												<tr>
													<td style='width:auto'>
														<div id="isidkd2_1">
															<select class="form-control" name="ikd2_1" id="ikd2_1">
																<option value="0">-- Pilih --</option>

																<?php
																if ($addedit == "edit")
																	for ($b16 = 1; $b16 <= $jml_kd2; $b16++) {
																		echo '<option ' . $sel_kd2_1[$id_kd2[$b16]] . ' value="' . $id_kd2[$b16] . '">' . $nama_kd2[$b16] . '</option>';
																	}
																?>
															</select>
														</div>
													</td>
													<td style='width:50px'>
														&nbsp;<button class="btn btn-default"
																	  onclick="return tambahkd('1_2')">+
														</button>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<div id='dkd2_2' class="col-md-12" style='padding-bottom:5px;left:10px;display:<?php
									if ($addedit == 'edit') {
										if ($datavideo["id_kd2_2"] > 0) echo 'block'; else echo 'none';
									} else echo 'none'; ?>'>
										<table>
											<tr>
												<td style='width:auto'>
													<div id="isidkd2_2">
														<select class="form-control" name="ikd2_2" id="ikd2_2">
															<option value="0">-- Pilih --</option>

															<?php
															if ($addedit == "edit")
																for ($b17 = 1; $b17 <= $jml_kd2; $b17++) {
																	echo '<option ' . $sel_kd2_2[$id_kd2[$b17]] . ' value="' . $id_kd2[$b17] . '">' . $nama_kd2[$b17] . '</option>';
																}
															?>
														</select>
													</div>
												</td>
												<td style='width:auto'>
													&nbsp;<button class="btn btn-default"
																  onclick="return tambahkd('2_3')">+
													</button>
												</td>
												<td style='width:50px'>
													<button class="btn btn-default" onclick="return hapuskd('2_2')">-
													</button>
												</td>
											</tr>
										</table>
									</div>

									<div id='dkd2_3' class="col-md-12" style='padding-bottom:5px;left:10px;display:<?php
									if ($addedit == 'edit') {
										if ($datavideo["id_kd2_3"] > 0) echo 'block'; else echo 'none';
									} else
										echo 'none'; ?>'>
										<table>
											<tr>
												<td style='width:auto'>
													<div id="isidkd2_3">
														<select class="form-control" name="ikd2_3" id="ikd2_3">
															<option value="0">-- Pilih --</option>

															<?php
															if ($addedit == "edit")
																for ($b18 = 1; $b18 <= $jml_kd2; $b18++) {
																	echo '<option ' . $sel_kd2_3[$id_kd2[$b18]] . ' value="' . $id_kd2[$b18] . '">' . $nama_kd2[$b18] . '</option>';
																}
															?>
														</select>
													</div>
												</td>
												<td style='width:auto'>
													&nbsp;<button class="btn btn-default"
																  onclick="return hapuskd('2_3')">-
													</button>
												</td>
												<td style='width:50px'>

												</td>
											</tr>
										</table>
									</div>

								</div>


								<div id="grupnonins" <?php echo $disp[2]; ?>>
									<div class="form-group" id="dkategori">
										<label for="select" class="col-md-12 control-label">Kategori</label>
										<div class="col-md-12">
											<select class="form-control" name="ikategori" id="ikategori">
												<option value="0">-- Pilih --</option>

												<?php
												for ($b2 = 1; $b2 <= $jml_kategori; $b2++) {
													echo '<option ' . $sel_kategori[$b2] . ' value="' . $id_kategori[$b2] . '">' . $nama_kategori[$b2] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</li>

							<li id="tab-new" class="cd-tabs__panel text-component">
								<legend>Data Video</legend>

								<div class="form-group">
									<label for="inputDefault" class="col-md-12 control-label">Topik</label>
									<div class="col-md-12">
										<input type="text" class="form-control" id="itopik" name="itopik"
											   maxlength="100"
											   value="<?php echo $topik; ?>" placeholder="">
										<br>
									</div>
								</div>

								<div class="form-group">
									<label for="inputDefault" class="col-md-12 control-label">Judul</label>
									<div class="col-md-12">
										<input type="text" class="form-control" id="ijudul" name="ijudul"
											   maxlength="100"
											   value="<?php echo $judul; ?>" placeholder="">
										<br>
									</div>
								</div>

								<div class="form-group">
									<label for="inputDefault" class="col-md-12 control-label">Deskripsi Konten</label>
									<div class="col-md-12">
						<textarea rows="4" cols="60" class="form-control" id="ideskripsi" name="ideskripsi"
								  maxlength="500"><?php echo $deskripsi; ?></textarea><br>
									</div>
								</div>

								<div class="form-group">
									<label for="inputDefault" class="col-md-12 control-label">Keyword</label>
									<div class="col-md-12">
										<input type="text" class="form-control" id="ikeyword" name="ikeyword"
											   maxlength="100"
											   value="<?php echo $keyword; ?>" placeholder="">
										<br>
									</div>
								</div>

								<?php if (($link_video == "" && $addedit == 'add') || ($link_video != "" && $addedit == 'edit')) { ?>
								<div class="form-group">
									<label for="inputDefault" class="col-md-12 control-label">Alamat URL Video</label>
									<div class="col-md-12">
							<textarea <?php
							if ($addedit == "edit") {
								if (!$this->session->userdata('a01') && ($datavideo['status_verifikasi'] == 2 || $datavideo['status_verifikasi'] == 4 || $datavideo['status_verifikasi'] == 5)) {
									echo 'readonly';
								}
							} ?>

                                    rows="3" cols="60" class="form-control" id="ilink" name="ilink"
									maxlength="300"><?php echo $link_video; ?></textarea>
										<button disabled="disabled" id="tbgetyutub" class="btn btn-default"
												onclick="return ambilinfoyutub()">OK
										</button>
										<br><br>
									</div>
								</div>

								<div class="form-group">
									<?php if ($addedit == "edit") { ?>
										<label for="inputDefault" class="col-md-12 control-label">Channel</label>
										<div id="get_channel" class="col-md-12">
											<input style="display:inline;width:250px;height:50px;margin:0;padding:0"
												   type="text"
												   class="form-control inputan1" id="ichannel" name="ichannel"
												   maxlength=""
												   value="<?php echo $channel; ?>" placeholder="">
											<br><br>
										</div>

										<label for="inputDefault" class="col-md-12 control-label">Thumbnail</label>
										<div class="col-md-12">
											<?php if ($thumbs == "") {
												if ($link_video == "") {
													?>
													<img id="img_thumb" style="align:middle;width:200px;"
														 src="<?php echo base_url(); ?>assets/images/blank.jpg">
												<?php } else {
													?>
													<img id="img_thumb" style="align:middle;width:200px;"
														 src="https://img.youtube.com/vi/<?php
														 echo substr($link_video, 32, 11); ?>/0.jpg">
												<?php } ?>
											<?php } else { ?>
												<img id="img_thumb" style="align:middle;width:200px;"
													 src="<?php echo $thumbs; ?>">
											<?php } ?>

											<!--                                &nbsp;<button class="btn btn-default" onclick="return upload()">Upload Thumbnail-->
											<!--                                </button>-->

											<br><br>
										</div>

										<label for="inputDefault" class="col-md-12 control-label">Durasi
											(Jam:Menit:Detik)</label>
										<div id="get_durasi" class="col-md-12">
											<input <?php
											if ($addedit == "edit") {
												if ($datavideo['status_verifikasi'] == 2 || $datavideo['status_verifikasi'] == 4 || $datavideo['status_verifikasi'] == 5) {
													echo 'readonly';
												}
											} ?> style="display:inline;width:25px;height:25px;margin:0;padding:0"
												 type="text"
												 class="form-control inputan1" id="idurjam" name="idurjam" maxlength="2"
												 value="<?php echo $durjam; ?>" placeholder="--">
											:
											<input <?php
											if ($addedit == "edit") {
												if ($datavideo['status_verifikasi'] == 2 || $datavideo['status_verifikasi'] == 4 || $datavideo['status_verifikasi'] == 5) {
													echo 'readonly';
												}
											} ?> style="display:inline;width:25px;height:25px;margin:0;padding:0"
												 type="text"
												 class="form-control inputan1" id="idurmenit" name="idurmenit"
												 maxlength="2"
												 value="<?php echo $durmenit; ?>" placeholder="--">
											:
											<input <?php
											if ($addedit == "edit") {
												if ($datavideo['status_verifikasi'] == 2 || $datavideo['status_verifikasi'] == 4 || $datavideo['status_verifikasi'] == 5) {
													echo 'readonly';
												}
											} ?> style="display:inline;width:25px;height:25px;margin:0;padding:0"
												 type="text"
												 class="form-control inputan1" id="idurdetik" name="idurdetik"
												 maxlength="2"
												 value="<?php echo $durdetik; ?>" placeholder="--">
										</div>
									<?php } else { ?>

										<label for="inputDefault" class="col-md-12 control-label">Channel</label>
										<div id="get_channel" class="col-md-12">
											<input readonly
												   style="display:inline;width:250px;height:50px;margin:0;padding:0"
												   type="text"
												   class="form-control inputan1" id="ichannel" name="ichannel"
												   maxlength=""
												   value="" placeholder="">
											<br><br>
										</div>

										<label for="inputDefault" class="col-md-12 control-label">Thumbnail</label>
										<div class="col-md-12">
											<img id="img_thumb" style="align:middle;width:200px;"
												 src="<?php echo base_url(); ?>assets/images/blank.jpg">
											<!--					&nbsp;<button class="btn btn-default" onclick="return upload()">Upload Thumbnail</button>-->

											<br><br>
										</div>

										<label for="inputDefault" class="col-md-12 control-label">Durasi
											(Jam:Menit:Detik)</label>
										<div id="get_durasi" class="col-md-12">
											<input style="display:inline;width:25px;height:25px;margin:0;padding:0"
												   type="text"
												   class="form-control inputan1" id="idurjam" name="idurjam"
												   maxlength="2"
												   value="--" placeholder="--">
											:
											<input style="display:inline;width:25px;height:25px;margin:0;padding:0"
												   type="text"
												   class="form-control inputan1" id="idurmenit" name="idurmenit"
												   maxlength="2"
												   value="--" placeholder="--">
											:
											<input style="display:inline;width:25px;height:25px;margin:0;padding:0"
												   type="text"
												   class="form-control inputan1" id="idurdetik" name="idurdetik"
												   maxlength="2"
												   value="--" placeholder="--">
											<br><br>
										</div>

									<?php }
									}
									?>

									<!-- <?php //echo "ADDEDIT:".$addedit; ?> -->

									<?php
									if ($datavideo['status_verifikasi'] == 2 || $datavideo['status_verifikasi'] == 4
										|| $datavideo['status_verifikasi'] == 5) { ?>
										<input type="hidden" id="ilink" name="ilink"
											   value="<?php echo $datavideo['link_video']; ?>"/>
									<?php } ?>

									<input type="hidden" id="addedit" name="addedit"
										   value="<?php if ($addedit == "edit") echo 'edit'; else echo 'add'; ?>"/>
									<input type="hidden" id="linkevent" name="linkevent" value="<?php echo $linkevent;?>"/>
									<input type="hidden" id="kondisi" name="kondisi" value="2"/>
									<input type="hidden" id="kodeevent" name="kodeevent" value="<?php
									if (isset($kodeevent)) echo $kodeevent; ?>"/>

									<input type="hidden" id="id_user" name="id_user" value=""/>
									<input type="hidden" id="ichannelid" name="ichannelid" value=""/>
									<input type="hidden" id="ytube_duration" name="ytube_duration" value=""/>
									<input type="hidden" id="ytube_thumbnail" name="ytube_thumbnail" value=""/>
									<input type="hidden" id="status_ver" name="status_ver"
										   value="<?php echo $datavideo['status_verifikasi']; ?>"/>

									<input type="hidden" id="filevideo" name="filevideo"
										   value="<?php if ($addedit == "edit") echo $judulvideo; else echo ''; ?>"/>
									<input type="hidden" id="created" name="created"
										   value="<?php if ($addedit == "edit") echo $datavideo['created']; else echo ''; ?>"/>
									<input type="hidden" id="id_video" name="id_video"
										   value="<?php if ($addedit == "edit") echo $datavideo['id_video']; ?>"/>
									<input type="hidden" id="idyoutube" name="idyoutube" value=""/>

									<input type="hidden" id="jenisvidevent" name="jenisvidevent"
										   value="<?php echo $jenisvidevent; ?>"/>

									<div class="form-group">
										<div class="col-md-10 col-md-offset-0">
											<br>
											<?php if ((($addedit == "edit") && ($datavideo['topik'] != "")) || $addedit == "add") { ?>
												<button class="btn btn-default" onclick="return takon()">Batal
												</button> <?php } ?>
											<button type="submit" class="btn btn-primary"
													onclick="return cekaddvideo()"><?php
												if ($addedit == "edit") echo 'Update'; else echo 'Simpan' ?></button>
										</div>
									</div>
								</div>
							</li>

						</ul> <!-- cd-tabs__panels -->
					</div> <!-- cd-tabs -->

					<input type="hidden" name="npsnsekolah" id="npsnsekolah"
						   value="<?php echo $this->session->userdata('npsn'); ?>">

					<?php
					echo form_close() . '';
					?>
				</div>
			</div>
		</div>
	</section>
</div>

<center>
	<div
		style="margin:auto;width:auto;color:#000000;margin-left:10px;margin-right:10px;margin-bottom:20px;background-color:white;">
		<div id="video-placeholder" style='display:none'></div>
		<div id="videolokal" style='display:none'></div>
	</div>
</center>

<!----------------------------- SCRIPT DATATABLE  -------------------------------->
<?php require_once('layout/calljs.php'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
		src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="https://www.youtube.com/iframe_api"></script>
<script src="<?php echo base_url(); ?>js/videoscript.js"></script>

<script
	src="<?php echo base_url(); ?>js/tab_util.js"></script> <!-- util functions included in the CodyHouse framework -->
<script src="<?php echo base_url(); ?>js/tab_main.js"></script>

<script>
	//alert ("cew");
	<?php if ($addedit == "edit") {
	if ($jenisvideo == "mp4") {?>
	//alert ("cekek");
	var myVideoPlayer = document.getElementById('video_playermp4');
	var _CANVAS = document.querySelector("#canvas-element");
	var _CANVAS_CTX = _CANVAS.getContext("2d");

	myVideoPlayer.addEventListener('loadedmetadata', function () {
		var duration = myVideoPlayer.duration;

		durasidetik = parseInt(duration.toFixed(2));
		hitungjam = parseInt(durasidetik / 3600);
		sisadetik = durasidetik - (hitungjam * 3600);
		hitungmenit = parseInt(sisadetik / 60);
		sisadetik = sisadetik - (hitungmenit * 60);
		hitungdetik = sisadetik;
		if (hitungjam < 10)
			hitungjam = "0" + hitungjam;
		if (hitungmenit < 10)
			hitungmenit = "0" + hitungmenit;
		if (hitungdetik < 10)
			hitungdetik = "0" + hitungdetik;

		$('#idurjam').val(hitungjam);
		$('#idurmenit').val(hitungmenit);
		$('#idurdetik').val(hitungdetik);


	});

	myVideoPlayer.addEventListener('timeupdate', function () {


		/*var link = document.getElementById('link');
		link.setAttribute('download', 'MintyPaper.png');
		link.setAttribute('href', _CANVAS.toDataURL("image/png").replace("image/png", "image/octet-stream"));*/


	});

	function sethumb() {
		_CANVAS.width = 640;
		_CANVAS.height = 420;

		_CANVAS_CTX.drawImage(myVideoPlayer, 0, 0, _CANVAS.width, _CANVAS.height);

		datai = _CANVAS.toDataURL();

		uploadcanvas();
		return false;
	}

	function uploadcanvas() {
		$.ajax({
			url: "<?php echo base_url();?>video/do_uploadcanvas",
			method: "POST",
			data: {canvasimage: datai, idvideo: '<?php echo $idvideo;?>', filevideo: '<?php echo $namafile;?>'},
			success: function (result) {
				document.getElementById("thumb1").src = "<?php echo base_url(); ?>uploads/thumbs/<?php echo $namafile;?>";
				console.log(result);
			},
			error: function () {
				alert('Error occured');
			}
		})
	}

	<?php }} ?>


	$(document).on('change', '#ipropinsi', function () {
		getdaftarkota();
	});

	function getdaftarkota() {

		isihtml0 = '<br><label for="select" class="col-md-12 control-label">Kota/Kabupaten</label><div class="col-md-12">';
		isihtml1 = '<select class="form-control" name="ikota" id="ikota">' +
			'<option value="0">-- Pilih --</option>';
		isihtml3 = '</select></div>';
		$.ajax({
			type: 'GET',
			data: {idpropinsi: $('#ipropinsi').val()},
			dataType: 'json',
			cache: false,
			url: '<?php echo base_url();?>login/daftarkota',
			success: function (result) {
				//alert ($('#itopik').val());
				isihtml2 = "";
				$.each(result, function (i, result) {
					isihtml2 = isihtml2 + "<option value='" + result.id_kota + "'>" + result.nama_kota + "</option>";
				});
				$('#dkota').html(isihtml0 + isihtml1 + isihtml2 + isihtml3);
			}
		});
	}

	$(document).on('change', '#ijenis', function () {
		pilihanjenis();
	});

	$(document).on('change', '#ijenjang', function () {
		$('#ijurusan').val(0);
		ambilkelas();
		ambilmapel();
		ambilki();
		ambilkd(1);
		ambiltema();
		ambiljurusan();
	});

	$(document).on('change', '#ikelas', function () {
		//alert ("hallo");
		ambiltema();
		ambilki();
	});

	$(document).on('change', '#imapel', function () {
		//alert ("hallo");
		ambilki();
		ambilkd(1);
	});

	$(document).on('change', '#kurikulum', function () {
		//alert ("hallo");
		ambilki();
		ambilkd(1);
	});

	$(document).on('change', '#istandar', function () {
		//alert ("hallo");
		ambilki();
		ambilkd(1);
	});


	$(document).on('change', '#ijurusan', function () {
		//alert ("hallo");
		ambilmapel();
	});

	function myFunction() {
		//alert ("hallo2");
	}

	$(document).on('change', '#iki1', function () {
		//alert ("sijilorotelu");
		ambilkd(1);
	});

	$(document).on('change', '#iki2', function () {
		ambilkd(2);
	});

	$(document).on('change', '#ilink2', function () {
		$('#img_thumb').src = "";
	});

	$("#ilink").change(function () {
		//alert ("Jajajl");
		//ambilinfoyutub();
	});

	$(document).ready(function () {
		$('#ilink').on('input', (event) => {
			if (document.getElementById("ilink").value != "") {
				document.getElementById("tbgetyutub").disabled = false;
			} else {
				document.getElementById("tbgetyutub").disabled = true;
			}
			document.getElementById("idurjam").value = "--";
			document.getElementById("idurmenit").value = "--";
			document.getElementById("idurdetik").value = "--";
			document.getElementById("img_thumb").src = "<?php echo base_url();?>assets/images/blank.jpg";
		});
	});

	function ambilinfoyutub() {
		idyutub = youtube_parser($("#ilink").val());
		//$('#idyutube').val(idyutub);
		var filethumb = "https://img.youtube.com/vi/" + idyutub + "/0.jpg";
		$('#ytube_thumbnail').val(filethumb);

		$.ajax({
			url: '<?php echo base_url();?>video/getVideoInfo/' + idyutub,
			type: 'GET',
			dataType: 'json',
			data: {},
			success: function (text) {
				<?php if ($this->session->userdata('a01')) {
				echo "text.ket='paksaOK';";
			}
				?>
				if (text.durasi == "") {
					alert("Periksa alamat link YouTube");
					ambiljam = "--";
					ambilmenit = "--";
					ambildetik = "--"
				} else if (text.ket == "sudahpernah") {
					alert("Alamat ini sudah pernah diinput. Silakan masukkan alamat lain.");
				} else {
					$("#img_thumb").attr("src", filethumb);
					ambiljam = text.durasi.substr(0, 2);
					ambilmenit = text.durasi.substr(3, 2);
					ambildetik = text.durasi.substr(6, 2);
					$('#ichannelid').val(text.channelid);


					html01 = '<input readonly="true" style="display:inline;width:25px;height:25px;margin:0;padding:0" type="text"' +
						'class="form-control inputan1" id="idurjam" name="idurjam" maxlength="2" value="' + ambiljam + '" placeholder="00"> : ' +
						'<input readonly="true" style="display:inline;width:25px;height:25px;margin:0;padding:0" type="text"' +
						'class="form-control inputan1" id="idurmenit" name="idurmenit" maxlength="2" value="' + ambilmenit + '" placeholder="00"> : ' +
						'<input readonly="true" style="display:inline;width:25px;height:25px;margin:0;padding:0" type="text"' +
						'class="form-control inputan1" id="idurdetik" name="idurdetik" maxlength="2" value="' + ambildetik + '" placeholder="00">';

					html02 = '<input readonly="true" style="display:inline;width:250px;height:50px;margin:0;padding:0" type="text" ' +
						'class="form-control inputan1" id="ichannel" name="ichannel" maxlength="" ' +
						'value="' + text.channeltitle + '" placeholder=""><br><br>';
					$('#ytube_duration').val(html01);
					$('#get_durasi').html(html01);
					$('#get_channel').html(html02);
				}

			}
		});
		return false;
	}

	function youtube_parser(url) {
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		return (match && match[7].length == 11) ? match[7] : false;
	}

	function pilihanjenis() {

		var jenis = document.getElementById("ijenis");
		var y1 = document.getElementById("grupins");
		var y2 = document.getElementById("grupnonins");
		//var y2 = document.getElementById("grupnonins");

		if (jenis.value == 2) {
			y1.style.display = "none";
			y2.style.display = "block";
		} else {
			y2.style.display = "none";
			y1.style.display = "block";
		}
	}

	function ambilkelas() {
		var jenjang = $('#ijenjang').val();

		// alert (jenjang);

		if (jenjang == 6) {
			$('#ikelas').val(0);
			$('#dkelas').hide();
		} else {
			$('#dkelas').show();
		}

		if (jenjang == 6) {
			isihtmlb0 = '<br><label for="select" class="col-md-12 control-label">Kelas</label><div class="col-md-12">';
			isihtmlb1 = '<select class="form-control" name="ikelas" id="ikelas">' +
				'<option value="0">-</option>';
			isihtmlb3 = '</select></div>';
			$('#dkelas').html(isihtmlb0 + isihtmlb1 + isihtmlb3);
		} else {
			isihtmlb0 = '<br><label for="select" class="col-md-12 control-label">Kelas</label><div class="col-md-12">';
			isihtmlb1 = '<select class="form-control" name="ikelas" id="ikelas">' +
				'<option value="0">-- Pilih --</option>';
			isihtmlb3 = '</select></div>';
			$.ajax({
				type: 'GET',
				data: {idjenjang: $('#ijenjang').val()},
				dataType: 'json',
				cache: false,
				url: '<?php echo base_url();?>video/daftarkelas',
				success: function (result) {
					//alert ($('#itopik').val());
					isihtmlb2 = "";
					$.each(result, function (i, result) {
						isihtmlb2 = isihtmlb2 + "<option value='" + result.id + "'>" + result.nama_kelas + "</option>";
					});
					hateemel = isihtmlb0 + isihtmlb1 + isihtmlb2 + isihtmlb3;
					$('#dkelas').html(hateemel);
					//console.log(hateemel);
				}
			});
		}
	}

	function ambilmapel() {

		var jenjang = $('#ijenjang').val();

		if ($('#ijurusan').val() == null)
			$('#dmapel').html("<input type='hidden' id='ijurusan' value=0 />");

		if (jenjang == 3) {
			$('#imapel').val(0);
			$('#dmapel').hide();
		} else {
			$('#dmapel').show();
		}

		if (jenjang == 5) {
			var isihtmlb0 = '<br><label for="select" class="col-md-12 control-label">Aktifitas</label><div class="col-md-12">';
			var isihtmlb1 = '<select class="form-control" name="imapel" id="imapel">' +
				'<option value="0">-- Pilih --</option>';
			var isihtmlb3 = '</select></div>';
			$.ajax({
				type: 'GET',
				data: {
					idjenjang: $('#ijenjang').val(),
					idjurusan: $('#ijurusan').val()
				},
				dataType: 'json',
				cache: false,
				url: '<?php echo base_url();?>video/daftarmapel',
				success: function (result) {
					//alert ($('#itopik').val());
					var isihtmlb2 = "";
					$.each(result, function (i, result) {
						isihtmlb2 = isihtmlb2 + "<option value='" + result.id + "'>" + result.nama_mapel + "</option>";
					});
					$('#dmapel').html(isihtmlb0 + isihtmlb1 + isihtmlb2 + isihtmlb3);
				}
			});
		} else {
			var isihtmlb0 = '<br><label for="select" class="col-md-12 control-label">Mata Pelajaran</label><div class="col-md-12">';
			var isihtmlb1 = '<select class="form-control" name="imapel" id="imapel">' +
				'<option value="0">-- Pilih --</option>';
			var isihtmlb3 = '</select></div>';
			$.ajax({
				type: 'GET',
				data: {
					idjenjang: $('#ijenjang').val(),
					idjurusan: $('#ijurusan').val()
				},
				dataType: 'json',
				cache: false,
				url: '<?php echo base_url();?>video/daftarmapel',
				success: function (result) {
					//alert ($('#itopik').val());
					var isihtmlb2 = "";
					$.each(result, function (i, result) {
						isihtmlb2 = isihtmlb2 + "<option value='" + result.id + "'>" + result.nama_mapel + "</option>";
					});
					$('#dmapel').html(isihtmlb0 + isihtmlb1 + isihtmlb2 + isihtmlb3);
				}
			});
		}
	}

	function ambiltema() {
		var kelasbener = $('#ikelas').val() - 2;
		var jenjang = $('#ijenjang').val();

		if (jenjang != 8) {
			var isihtmlc = '<input type="hidden" id="itema" name="itema" value=0 />';
			$('#dtema').html(isihtmlc);
		} else {
			var isihtmlc0 = '<br><label for="select" class="col-md-12 control-label">Tema</label><div class="col-md-12">';
			var isihtmlc1 = '<select class="form-control" name="itema" id="itema">' +
				'<option value="0">-- Pilih --</option>';
			var isihtmlc3 = '</select></div>';
			$.ajax({
				type: 'GET',
				data: {idkelas: kelasbener},
				dataType: 'json',
				cache: false,
				url: '<?php echo base_url();?>video/daftartema',
				success: function (result) {
					//alert ($('#itopik').val());
					var isihtmlc2 = "";
					$.each(result, function (i, result) {
						isihtmlc2 = isihtmlc2 + "<option value='" + result.id + "'>" + result.nama_tematik + "</option>";
					});
					$('#dtema').html(isihtmlc0 + isihtmlc1 + isihtmlc2 + isihtmlc3);
				}
			});
		}
	}

	function ambiljurusan() {
		var jenjang = $('#ijenjang').val();
 
		if (jenjang != 6 && jenjang != 15) {
			var isihtmld = '<input type="hidden" id="ijurusan" name="ijurusan" value=0 />';
			$('#djurusan').html(isihtmld);
		} else {
			var isihtmld0 = '<br><label for="select" class="col-md-12 control-label">Jurusan</label><div class="col-md-12">';
			var isihtmld1 = '<select class="form-control" name="ijurusan" id="ijurusan">' +
				'<option value="0">-- Semua Jurusan --</option>';
			var isihtmld3 = '</select></div>';
			$.ajax({
				type: 'GET',
				data: {idjenjang: jenjang},
				dataType: 'json',
				cache: false,
				url: '<?php echo base_url();?>video/daftarjurusan',
				success: function (result) {
					//alert ($('#itopik').val());
					var isihtmld2 = "";
					$.each(result, function (i, result) {
						isihtmld2 = isihtmld2 + "<option value='" + result.id + "'>" + result.nama_jurusan + "</option>";
					});
					$('#djurusan').html(isihtmld0 + isihtmld1 + isihtmld2 + isihtmld3);
				}
			});
		}
	}

	function ambilkd(ki) {

		//var pilkelas = document.getElementById("ikelas").value;
		//alert ("KI:"+$('#iki' + ki).val());


		isihtml1_1 = '<select class="form-control" name="ikd' + ki + '_1" id="ikd' + ki + '_1">' +
			'<option value="0">-- Pilih --</option>;';
		isihtml1_2 = '<select class="form-control" name="ikd' + ki + '_2" id="ikd' + ki + '_2">' +
			'<option value="0">-- Pilih --</option>;';
		isihtml1_3 = '<select class="form-control" name="ikd' + ki + '_3" id="ikd' + ki + '_3">' +
			'<option value="0">-- Pilih --</option>;';
		isihtml3 = '</select>';

		$.ajax({
			type: 'GET',
			data: {
				npsn: $('#istandar').val(),
				kurikulum: $('#ikurikulum').val(),
				idkelas: $('#ikelas').val(),
				idmapel: $('#imapel').val(),
				idki: $('#iki1').val()
			},
			dataType: 'json',
			cache: false,
			url: '<?php echo base_url();?>video/ambilkd',
			success: function (result) {
				// alert ($('#ikelas').val());
				isihtml2 = "";
				$.each(result, function (i, result) {
					isihtml2 = isihtml2 + "<option value='" + result.id + "'>" + result.nama_kd + "</option>";
					//alert (result.nama_kd);
				});
				$('#isidkd' + ki + '_1').html(isihtml1_1 + isihtml2 + isihtml3);
				$('#isidkd' + ki + '_2').html(isihtml1_2 + isihtml2 + isihtml3);
				$('#isidkd' + ki + '_3').html(isihtml1_3 + isihtml2 + isihtml3);
			}
		});
	}


	function ambilki() {

		var jenjang = $('#ijenjang').val();

		// if (jenjang == 1 || jenjang == 6) {
		// 	$('#bki').hide();
		// 	$('#dkd1_1').hide();
		// } else {
		// 	$('#bki').show();
		// 	$('#dkd1_1').show();
		// }

		isihtml1 = '<select class="form-control" name="iki1" id="iki1">\n' +
			'<option value="0">-- Pilih --</option>\n';

		if (jenjang == 1) {
			isihtml2 = '<option value = "1" > Sikap Religius </option>' +
				'<option value = "2" > Sikap Sosial </option>' +
				'<option value = "3" > Pengetahuan </option>' +
				'<option value = "4" > Ketrampilan </option>';
		} else {
			isihtml2 = '<option value = "3" > Pengetahuan </option>' +
				'<option value = "4" > Ketrampilan </option>';
		}

		isihtml3 = '</select>';

		$('#isidki').html(isihtml1 + isihtml2 + isihtml3);
		// $('#isidki').html("kokok");
	}


	function cekaddvideo() {
		var oke1 = 1;
		var oke2 = 1;

		//ambilinfoyutub();
		//alert ($('#ytube_duration').val());

		var jenis = document.getElementById("ijenis");
		var jenjang = document.getElementById("ijenjang");
		var ki1 = document.getElementById("iki1");
		var kd1_1 = document.getElementById("ikd1_1");
		var pilkelas = document.getElementById("ikelas");
		var pilmapel = document.getElementById("imapel");
		var piltema = document.getElementById("itema");
		var pilkurikulum = document.getElementById("ikurikulum");
		var pilstandar = document.getElementById("istandar");
		//var piljurusan = document.getElementById("ijurusan");

		//alert (jenis.value);

		//alert (pilmapel.value);


		if (jenis.value == "1") {
			
			if (jenjang.value == 0)
				{
					oke1 = 0;
				}

			if (jenjang.value == 5) {
				if (pilmapel.value == 0)
					{
						oke1 = 0;
					}
			} else if (jenjang.value == 6) {
				
			} else if (jenjang.value == 8) {
				if (pilkelas.value == 0 || piltema.value == 0 || pilmapel.value == 0)
					{
						oke1 = 0;
					}
			} else if (jenjang.value >= 11 && jenjang.value <= 15) {
				if (pilkelas.value == 0 || pilmapel.value == 0)
					{
						oke1 = 0;
					}
			}

			
			// if ($('#ijenjang').val() == 0 || $('#ikelas').val() == 0 || $('#imapel').val() == 0
			//     || $('#iki1').val() == 0 || $('#ikd1_1').val() == 0 || $('#ilink').val() == "") {
			//     oke1 = 0;
			//     //alert ("Berhasil");
			//     //alert($('#ijenjang').val();
			// }
			if (document.getElementById("dkd1_2").style.display == 'none')
				$('#ikd1_2').val(0);
			if (document.getElementById("dkd1_3").style.display == 'none')
				$('#ikd1_3').val(0);
			if (document.getElementById("dkd2_1").style.display == 'none') {
				$('#iki21').val(0);
				$('#ikd2_1').val(0);
			}

			if ($('#ikd2_1').val() == 0)
				$('#iki2').val(0);

			if (document.getElementById("dki2").style.display == 'none') {
				//alert ("HLOOOO");
				$('#iki2').val(0);
				$('#ikd2_1').val(0);
				$('#ikd2_2').val(0);
				$('#ikd2_3').val(0);

			}
			if (document.getElementById("dkd2_2").style.display == 'none')
				$('#ikd2_2').val(0);
			if (document.getElementById("dkd2_3").style.display == 'none')
				$('#ikd2_3').val(0);

		} else {
			//alert ($('#ikategori').val());
			if ($('#ikategori').val() == 0) {
				oke1 = 0;
			}
		}

		//alert  ($('#ikd2_1').val());


		if ($('#itopik').val() == "" || $('#ijudul').val() == "" || $('#ideskripsi').val() == ""
			|| $('#ikeyword').val() == "") {
			oke2 = 0;
			//  alert ("s5");
		}

		if ($('#idurjam').val() == "--") {
			oke2 = 0;
			// alert ("wedus");
		}

		<?php if ($addedit == "add" && $this->session->userdata('sebagai') != 4) { ?>
		if ($('#ytube_duration').val() == "") {
			oke2 = 0;
			// alert ("s6");
		}
		<?php } ?>



		if (oke1 == 1 && oke2 == 1) {

			var retVal = confirm("Dengan ini Anda menyatakan bahwa semua data terkait video beserta isi video ini tidak melanggar hukum!");
			if (retVal == true) {
				// document.write ("User wants to continue!");
				return true;
			} else {
				//document.write ("User does not want to continue!");
				return false;
			}
		} else {
			if (oke1 == 0 || oke2 == 0)
				alert("Semua Data harus dilengkapi");
			return false;
		}
	}

	function takon() {
		window.open("<?php echo base_url();?>video", "_self");
		return false;
	}

	function editmp4(idvideo) {
		window.open("<?php echo base_url();?>video/upload_mp4/" + idvideo, "_self");
		return false;
	}


	<?php if ($addedit == "edit") {?>
	function upload() {
		window.open("<?php echo base_url();?>video/file_view/<?php echo $datavideo['id_video'];?>", "_self")
		return false;
	}
	<?php } ?>

	function tambahki() {
		document.getElementById("dki2").style.display = "block";
		document.getElementById("dkd2_1").style.display = "block";
		return false;
	}

	function hapuski() {
		document.getElementById("dki2").style.display = "none";
		document.getElementById("dkd2_1").style.display = "none";
		document.getElementById("dkd2_2").style.display = "none";
		document.getElementById("dkd2_3").style.display = "none";
		return false;
	}

	function tambahkd(obj) {
		document.getElementById("dkd" + obj).style.display = "block";
		return false;
	}

	function hapuskd(obj) {
		document.getElementById("dkd" + obj).style.display = "none";
		return false;
	}

	function diklik_uploadvideo() {
		post('<?php echo base_url();?>video/upload_mp4', {video: 'mp4'});
	}

	function post(path, params, method = 'post') {

		// The rest of this code assumes you are not using a library.
		// It can be made less wordy if you use one.
		var form = document.createElement('form');
		form.method = method;
		form.action = path;

		for (var key in params) {
			if (params.hasOwnProperty(key)) {
				var hiddenField = document.createElement('input');
				hiddenField.type = 'hidden';
				hiddenField.name = key;
				hiddenField.value = params[key];

				form.appendChild(hiddenField);
			}
		}

		document.body.appendChild(form);
		form.submit();
	}

</script>
