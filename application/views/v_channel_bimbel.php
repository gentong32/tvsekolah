<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//https://www.youtube.com/watch?v=xO51BDBhPWw

$txt_jenis = Array('-', 'Instruksional', 'Non Instruksional');
$namabulan = Array('', 'Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des');
$do_not_duplicate = array();
$npsnku = "";
$kodeku = "";
$nama_sekolahku = "";
$jml_list = 0;
$idliveduluan = 0;

$tgl_tayang = array("", "");
$tgl_tayang1 = array("", "");

if ($iduser!=null) {
	foreach ($infoguru as $datane) {
		$npsnku = $datane->npsn;
		$idguru = $datane->id;
		$nama_sekolahku = $datane->sekolah;
		$namaku = $datane->first_name . ' ' . $datane->last_name;
	}
}
else
{
	$namaku = "BIMBEL TVSEKOLAH";
}

$jmldaf_list = 0;
$statuspaket = 1;
$namapaket = "";

foreach ($dafplaylist as $datane) {
	$jmldaf_list++;

	$iddaflist[$jmldaf_list] = $datane->id_paket;
	$id_videodaflist[$jmldaf_list] = $datane->link_list;
	$nama_playlist[$jmldaf_list] = $datane->nama_paket;
	$status[$jmldaf_list] = $datane->status_paket;

	if ($datane->status_paket == 1) {
		$tlive[$jmldaf_list] = "Segera Tayang";
		$idliveduluan = $jmldaf_list;
	} else {
		$tlive[$jmldaf_list] = "";
	}

	$tgl_tayang1[$jmldaf_list] = $datane->tanggal_tayang;
	$tgl_tayang[$jmldaf_list] = substr($datane->tanggal_tayang, 8, 2) . ' ' . $namabulan[(int)(substr($datane->tanggal_tayang, 5, 2))] . ' ' . substr($datane->tanggal_tayang, 0, 4) . ' Pukul ' . substr($datane->tanggal_tayang, 11, 5) . ' WIB';
	$idvideoawal[$jmldaf_list] = $datane->judul;
	$durasidaf[$jmldaf_list] = $datane->durasi_paket;
	$thumbnail[$jmldaf_list] = $datane->thumbnail;
	if (substr($thumbnail[$jmldaf_list], 0, 4) != "http") {
		$thumbnail[$jmldaf_list] = "<?php echo base_url(); ?>uploads/thumbs/" . $thumbnail[$jmldaf_list];
	}


	if ($id_playlist == $datane->link_list) {
		$statuspaket = $datane->status_paket;
		$namapaket = $datane->nama_paket;
		$thumbspaket = $thumbnail[$jmldaf_list];
		$tayangpaket = $tgl_tayang[$jmldaf_list];
	}
}


if ($punyalist) {
	$jml_list = 0;
	foreach ($playlist as $datane) {
		//echo "<br><br><br><br>DATANE".($datane->link_video);
		$jml_list++;
		$id_videolist[$jml_list] = $datane->link_video;
		$durasilist[$jml_list] = $datane->durasi;
		$urutanlist[$jml_list] = $datane->urutan;
	}
}




$jml_jenjang = 0;
foreach ($dafjenjang as $datane) {
//echo "ID Jenjang pil:".$datane->id;
	$jml_jenjang++;
	$kd_jenjang[$jml_jenjang] = $datane->id;
	$nama_jenjang[$jml_jenjang] = $datane->nama_pendek;
	$keselectj[$jml_jenjang] = "";
	if ($jenjang == $kd_jenjang[$jml_jenjang]) {
//echo "DISINI NIH:".$kd_jenjang[$jml_jenjang].'='.$jenjang;
		$keselectj[$jml_jenjang] = "selected";
	}
}


$jml_mapel = 0;
if ($jenjang != "0") {

	foreach ($dafmapel as $datane) {
		$jml_mapel++;
		$kd_mapel[$jml_mapel] = $datane->id;
		$nama_mapel[$jml_mapel] = $datane->nama_mapel;
		$keselectm[$jml_mapel] = "";
		if ($mapel == $kd_mapel[$jml_mapel]) {
			$keselectm[$jml_mapel] = "selected";
		}
//echo $nama_mapel[$jml_mapel];
	}
}

//if ($jenjang!="0")
{
	$jml_kategori = 0;
	foreach ($dafkategori as $datane) {
//echo "ID Jenjang pil:".$datane->id;
		$jml_kategori++;
		$kd_kategori[$jml_kategori] = $datane->id;
		$nama_kategori[$jml_kategori] = $datane->nama_kategori;
		$keselectk[$jml_kategori] = "";
		if ($kategori == $kd_kategori[$jml_kategori]) {
//echo "DISINI NIH:".$kd_jenjang[$jml_jenjang].'='.$jenjang;
			$keselectk[$jml_kategori] = "selected";
		}
	}
}


//echo "<br><br><br><br>".$statuspaket;
?>


<div class="container bgimg3" style="margin-top: 0px;width: 100%">
	<div class="row">
		<div class="col-lg-12">
			<div id="jamsekarang"
				 style="font-weight: bold;color: black;padding-top:65px;float: right; margin-right: 20px" id="jam">
			</div>
		</div>
	</div>

	<div id="judul" style="text-align:center;padding-top: 0px">
	<span style="font-weight: bold;color: black">Channel <?php echo $namaku; ?></span>
	</div>

	<div class="indukplay" style=";margin-top:10px;text-align:center;margin-left:auto;margin-right: auto;">
		<?php
		if ($jmldaf_list > 0) {
		?>
		<div id="layartancap" <?php
		if ($status[1] == 2 && $id_playlist == null)
			//JIKA GAK ADA YANG MAU TAYANG
			echo 'style="display:none";' ?>" class="iframe-container embed-responsive embed-responsive-16by9">
		<div class="embed-responsive-item" style="width: 100%" id="isivideoyoutube">
			<?php
			if ($statuspaket == 1 && $idliveduluan>0) {
				?>
				<img style="margin-top:-58px;width: 100%" src="<?php
				if ($id_playlist == null)
					echo $thumbnail[$idliveduluan]; else
					echo $thumbspaket; ?>"/>
			<?php
			} ?>
		</div>
	</div>
	<?php
		} else {
		?>
		<img style="width: 100%" src="<?php echo base_url(); ?>assets/images/playlistbelum2.png"/>
	<?php }
	?>

	<div id="divnamapaket" style="text-align:center; color:black">
		<?php
		if ($id_playlist == null && $jmldaf_list > 0 && $idliveduluan != "")
			{
				echo "<div style='text-align: left' id='seconds'></div>";
				echo "[".$nama_playlist[$idliveduluan]."]";
				echo '<hr style="height:1px;border:none;color:#366e8f;background-color:#366e8f;">';
			}
		else
		{
			echo "<div style='text-align: left' id='seconds'></div>";
			echo $namapaket;

		}
			 ?>
	</div>
	<?php

	if ($jmldaf_list > 0) {
		if ($statuspaket == 1 && $idliveduluan != 0) {
			?>
			<div id="keteranganLive" style="text-align:center; color:black">
				SEGERA TAYANG TANGGAL: <?php echo $tgl_tayang[1]; ?>
			</div>
			<hr style="height:1px;border:none;color:#366e8f;background-color:#366e8f;">
		<?php }
	} ?>
</div>





<div id="myModal1" class="modal2">
	<!-- Modal content -->
	<div class="modal2-content">

		<p style="text-align:center;font-size: medium">USER NAME dan PASSWORD yang Anda masukkan salah.<br>
			Silakan gunakan username dan password yang valid.<br><br>
			<button id="silang">Tutup</button></p>
	</div>
</div>

<script src="<?php echo base_url() ?>js/jquery-3.4.1.js"></script>

<div style="background-color:#aabfb8;padding-top: 50px;">
	<br>
	<center><span style="color:#000000;font-size:18px;font-weight: bold;"><?php echo $title; ?></span></center>
	<br>

	<div class="row" style="text-align:center;width:100%">

		<div id="isijenjang" style="text-align:center;width:280px;display:inline-block;padding-bottom: 5px;">
			<select class="form-control" name="ijenjang" id="ijenjang">
				<option value="0">-- Pilih Jenjang --</option>
				<option value="kategori">[Ganti Pilihan ke Kategori]</option>
				<?php
				for ($v1 = 1; $v1 <= $jml_jenjang; $v1++) {
					echo '<option ' . $keselectj[$v1] . ' value="' . $nama_jenjang[$v1] . '">' . $nama_jenjang[$v1] . '</option>';
				}
				?>
			</select>
		</div>

		<div id="pencarian" style="width:230px;display:inline-block">
			<input type="text" name="isearch" class="form-control" id="isearch" placeholder="cari ..."
				   value="<?php echo $kuncine; ?>" style="width:220px;height:35px">
		</div>
		<button  style="width: 48px;margin-left:0px;margin-top:-5px;height: 30px;" class="btn btn-default" onclick="return caridonk()">Cari</button>

	</div>
	<br>
</div>




<div class="bgimg3" style="text-align: center;width: 100%;">
<!--	<span style="font-weight: bold;color: black">MICRO LEARNING TERBARU</span>-->

		<div class="rowvod">

			<?php for ($a1 = 1; $a1 <= $jmldaf_list; $a1++) {
				$judulTitle = ucwords(strtolower($nama_playlist[$a1]));
				if (strlen($judulTitle)>72)
				{
					$judulTitle = substr(ucwords(strtolower($nama_playlist[$a1])),0,72).' ...';
				}
				echo '<div class="columnvod" style="height: 180px">
			
	<a href="' . base_url() . 'channel/bimbel/' . $id_videodaflist[$a1] . '">
			 <div class="grup" style="margin:auto;width:220px;position:relative;text-align:center">
			 <div style="font-size:11px;background-color:black;color:white;position: absolute;right:10px;bottom:10px">'
					. $durasidaf[$a1] . '</div>
			
			<img style="align:middle;width:220px;height:140px" src="' . $thumbnail[$a1] . '"><br>
			</div>
			<div class="grup" style="text-align:center">
			
			<div id="judulvideo">' . $judulTitle . '</div>
			
			</div>
	
			  
			</div></a>';
			}
			?>
		</div>


</div>
<!--<script src="--><?php //echo base_url() ?><!--js/jquery-3.4.1.js"></script>-->

<script src="https://code.jquery.com/jquery-3.5.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/slick.js" type="text/javascript" charset="utf-8"></script>
<script src="https://www.youtube.com/iframe_api"></script>

<script>
	var player;
	var detikke = new Array();
	var idvideo = new Array();
	var durasike = new Array();
	var filler = new Array();
	var jatah = 0;
	var namabulan = new Array('Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des');
	var detiklokal = 0;
	var tgl, bln, thn, jam, menit, detik, jmmndt;
	var cekjatah = 0;
	var durasi = 0;
	var detikselisih;
	var loadsekali = false;
	<?php
	if ($idliveduluan != "") {
	?>
	//var statuslive = <?php //echo $iddaflist[$idliveduluan];?>//;
	var statuslive = <?php echo $status[$idliveduluan];?>;
	var tgljadwal = new Date("<?php echo $tgl_tayang1[$idliveduluan];?>");
	<?php
	}

//	$url = 'https://worldtimeapi.org/api/timezone/Asia/Jakarta';
//	$obj = json_decode(file_get_contents($url), true);
//	$stampdate = substr($obj['datetime'], 0, 19);

	$now = new DateTime();
	$now->setTimezone(new DateTimezone('Asia/Jakarta'));
	$stampdate = $now->format("Y-m-d") . "T" . $now->format("H:i:s");

	echo "var tglnow = new Date('" . $stampdate . "');";

	?>

	var jamnow = tglnow.getTime();
	var jmljudul = 0;
	var jmlterm = 0;
	var jamjadwal, jamsaiki;
	var masuksiaran = false;
	var dalamsiaran = false;

	filler[1] = 'X7R-q9rsrtU';

	<?php
	if ($id_playlist == null) {
	?>
	detikke[1] = '<?php echo substr($tgl_tayang1[$idliveduluan], 11, 8);?>';
	<?php } else {
	?>
	detikke[1] = keJam(tglnow);
	<?php } ?>

	//console.log('JML LIST:'+<?php //echo $jml_list;?>//);
	//console.log("Detik 1:"+detikke[1]);
	<?php
	for ($q = 1; $q <= $jml_list; $q++) {
		echo "idvideo[" . $q . "] = youtube_parser('" . $id_videolist[$q] . "'); \r\n";
		echo "durasike[" . $q . "] = '" . $durasilist[$q] . "'; \r\n";
		if ($q > 1) {
			echo "detikke[" . $q . "] = keJam(new Date(jamHitung(" . ($q - 1) . ")+hitungDurasi(" . ($q - 1) . "))); \r\n";
		}
		echo "durasi=durasi+hitungDurasi(" . $q . "); \r\n";

//		echo "console.log('Detikke ".$q." = '+detikke[$q]); \r\n";
//		echo "console.log('Durasi ".$q." = '+durasike[$q]); \r\n";
//		echo "console.log('Id ke ".$q." = '+idvideo[$q]); \r\n";
	};
	?>

	/*console.log("Durasi:"+durasi);
	console.log("Selisih waktu:"+(tglnow-tgljadwal));*/

	detik2 = 0;

	function ceklive() {
		//alert ("HOLA");
		detik2++;
		tglsaiki = new Date(tglnow.getTime() + (detik2 * 1000));

		if (tglsaiki - tgljadwal < 0) {

			$('#layartancap').show();
			$('#keteranganLive').html("SEGERA TAYANG TANGGAL: <?php if ($id_playlist == null)
				echo $tgl_tayang[$idliveduluan]; else
				echo $tayangpaket; ?>");
			$('#divnamapaket').show();
			$('#keteranganLive').show();
			$('#infolive<?php echo $idliveduluan;?>').html("Segera Tayang");


		} else {
			//alert (tglsaiki-tgljadwal);
			masuksiaran = true;
			if ((tglsaiki - tgljadwal) < durasi) {
				dalamsiaran = true;
				if (loadsekali == false) {
					loadsekali = true;
					loadplayer();
				}

				$('#layartancap').show();
				$('#keteranganLive').html("LIVE");
				$('#divnamapaket').show();
				$('#keteranganLive').show();
				$('#infolive<?php echo $idliveduluan;?>').html("Live");
			} else {
				dalamsiaran = false;
				$('#layartancap').hide();
				$('#keteranganLive').html("");
				$('#divnamapaket').hide();
				$('#keteranganLive').hide();
				$('#infolive<?php echo $idliveduluan;?>').html("");
				if (statuslive == 1) {
					gantistatusselesai();
				}
			}
		}
	}


	jmljudul = <?php echo $jml_list;?>;
	/*if (durasi>0)
	jmlterm = (86400 / (durasi/1000)) - 1;
	*/
	jmlterm = 1;

	/*jamakhir = new Date("1970-01-01T" + detikke[3] + "Z").getTime();
	jamawal = new Date("1970-01-01T" + detikke[1] + "Z").getTime();*/
	//	durasi = hitungDurasi(1) + hitungDurasi(2) + hitungDurasi(3);

	if (jmlterm > 0) {
		for (var y = 1; y <= jmlterm; y++) {
			for (var z = 1; z <= jmljudul; z++) {
				detikke[y * jmljudul + z] = keJam(new Date("1970-01-01T" + detikke[z]).getTime() + durasi * y);
				durasike[y * jmljudul + z] = durasike[z];
				idvideo[y * jmljudul + z] = idvideo[z];
				//console.log("detikke"+(y * jmljudul + z)+":"+detikke[y * jmljudul + z]);
			}
		}
	}

	function youtube_parser(url) {
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		return (match && match[7].length == 11) ? match[7] : false;
	}


	/*echo 'console.log('.$jml_list.');';*/


	function onYouTubeIframeAPIReady() {
		initialize();
		<?php
		/*echo "console.log('".$id_playlist."'); \r\n";
		echo "console.log('status:".$status[1]."'); \r\n";*/
		if (($id_playlist != null && $statuspaket == 2)) {
			echo "loadplayer(); \r\n";
		}?>
	}

	function loadplayer() {
		idvideolain = "";
		<?php
		if ($id_playlist != null) {
			for ($x = 2; $x < $jml_list; $x++)
				echo "idvideolain = idvideolain + idvideo[" . $x . "]+','; \r\n";
		}
		if ($jml_list>1)
			echo "idvideolain = idvideolain + idvideo[" . $jml_list . "]; \r\n";
		?>

		//console.log(idvideo[1]);
		//console.log(idvideolain);

		player = new YT.Player('isivideoyoutube', {
			width: 600,
			height: 400,
			videoId: <?php echo "idvideo[1]";?>,
			showinfo: 0,
			controls: 0,
			autoplay: 0,
			playerVars: {
				color: 'white',
				playlist: <?php echo "idvideolain";?>
			},
			events: {
				//onReady: initialize
			}
		});
	}


	function initialize() {
		$(function () {
			setInterval(updateTanggal, 1000);
			<?php
			if ($status[1] == 1) {
			?>
			setInterval(ceklive, 1000);
			<?php } ?>

		});

		if (dalamsiaran)
			player.playVideo();
	}


	function jamHitung(ke) {
		return new Date("1970-01-01T" + detikke[ke]).getTime();
	}

	function hitungDurasi(ke) {
		detikjam = parseInt(durasike[ke].substring(0, 2)) * 3600;
		detikmenit = parseInt(durasike[ke].substring(3, 5)) * 60;
		detikdetik = parseInt(durasike[ke].substring(6, 8));
		totaldurasi = (detikjam + detikmenit + detikdetik) * 1000;
		return totaldurasi;
	}

	function updateTanggal() {
		jamnow = jamnow + 1000;
		tgl = new Date(jamnow).getDate();
		bln = new Date(jamnow).getMonth();
		thn = new Date(jamnow).getFullYear();
		jam = new Date(jamnow).getHours();
		if (jam < 10)
			jam = '0' + jam;
		menit = new Date(jamnow).getMinutes();
		if (menit < 10)
			menit = '0' + menit;
		detik = new Date(jamnow).getSeconds();
		if (detik < 10)
			detik = '0' + detik;
		jmmndt = jam + ':' + menit + ':' + detik;

		$('#jamsekarang').html(tgl + ' ' + namabulan[bln] + ' ' + thn + ', ' + jmmndt + ' WIB');

		if (durasi > 0 && dalamsiaran)
			updatePlaying();
	}

	function keJam(jaminput) {
		tgl1 = new Date(jaminput).getDate();
		bln1 = new Date(jaminput).getMonth();
		thn1 = new Date(jaminput).getFullYear();
		jam1 = new Date(jaminput).getHours();
		if (jam1 < 10)
			jam1 = '0' + jam1;
		menit1 = new Date(jaminput).getMinutes();
		if (menit1 < 10)
			menit1 = '0' + menit1;
		detik1 = new Date(jaminput).getSeconds();
		if (detik1 < 10)
			detik1 = '0' + detik1;
		jame = jam1 + ':' + menit1 + ':' + detik1;

		return jame;
		//updatePlaying();
	}


	function updatePlaying() {
		for (a = 1; a <= (jmljudul * jmlterm); a++) {
			jamjadwal = new Date("1970-01-01T" + detikke[a] + "Z").getTime();
			jamsaiki = new Date("1970-01-01T" + jmmndt + "Z").getTime();
			//console.log(detikke[a]+":"+jmmndt);
			terakhir = a;
			if (jamsaiki >= jamjadwal) {
				cekjatah = a;
				detikselisih = (jamsaiki - jamjadwal) / 1000;
				//break;
			}
			if (terakhir != cekjatah)
				break;
		}

		/*console.log("Jatah:"+jatah);
		console.log("CekJatah:"+cekjatah);*/

		if (cekjatah != jatah) {

			console.log(cekjatah);
			console.log(idvideo[cekjatah]);
			jatah = cekjatah;

			detiklokal = detikselisih;

			console.log("Jatah2:" + jatah);
			console.log("Selisih:" + detikselisih);

			if (detiklokal > durasike[jatah]) {
				detiklokal = 0;
				player.loadVideoById(filler[1]);
			} else {
				player.loadVideoById(idvideo[jatah], detiklokal);
			}

			player.playVideo();
		} else {
			detiklokal = detiklokal + 1;
			videoPos = !player.getCurrentTime ? 0.0 : player.getCurrentTime();
			jarak = (videoPos - detiklokal);
			if (player.getPlayerState() != 2) {
				if (jarak > 5 || jarak < -5)
					player.seekTo(detiklokal);
				player.playVideo();
			}
		}
	}

	<?php
	if ($idliveduluan) {
	?>

	function gantistatusselesai() {
		$.ajax({
			url: "<?php echo base_url();?>channel/gantistatuspaketbimbel",
			method: "POST",
			data: {id: <?php echo $iddaflist[$idliveduluan];?>},
			success: function (result) {
				statuslive = 1;
				//detik2=0;
			}
		})
	}

	<?php } ?>




</script>


<script src="<?php echo base_url() ?>js/jquery-ui.js"></script>


<script>

	$(document).ready(function(){
		$('#isearch').autocomplete({
			source: '<?php echo (site_url() . "vod/get_autocomplete");?>',
			minLength: 1,
			select: function (event, ui) {
				$('#isearch').val(ui.item.value);
				//$('#description').val(ui.item.deskripsi);
			}
		});
	});

	$(document).on('change', '#ijenjang', function () {

		if ($('#ijenjang').val() == "kategori") {
			window.open("<?php echo base_url(); ?>vod/kategori/pilih", "_self");
		}
		else if ($('#ijenjang').val() != "0") {
			window.open("<?php echo base_url(); ?>vod/mapel/" + $('#ijenjang').val(), "_self");
		}
		else {
			window.open("<?php echo base_url(); ?>vod/", "_self");
		}

	});

	$('#isearch').keypress(function (event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			caridonk();
		}
		event.stopPropagation();
	});

	function caridonk() {

		window.open('<?php echo base_url(); ?>vod/cari/' + $('#isearch').val(), '_self');

	}


</script>

<script>

	<?php
	if (!$this->session->userdata('loggedIn') && ($message=="Login Gagal")) { ?>

	var tombolku2 = document.getElementById('tombolku2');
	var modal = document.getElementById("myModal1");


	modal.setAttribute('style', 'display: block');

	<?php } ?>


	var btn = document.getElementById("myBtn");

	var span = document.getElementById("silang");


	span.onclick = function() {
		modal.setAttribute('style', 'display: none');
	}



</script>
