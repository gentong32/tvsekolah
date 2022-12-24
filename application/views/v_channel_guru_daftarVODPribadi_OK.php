<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//https://www.youtube.com/watch?v=xO51BDBhPWw

$txt_jenis = Array('-', 'Instruksional', 'Non Instruksional');
$do_not_duplicate = array();

$npsnku = "";
$kodeku = "";
$nama_sekolahku = "";


foreach ($infoguru as $datane) {
	$npsnku = $datane->npsn;
	$nama_sekolahku = $datane->sekolah;
	$namaku = $datane->first_name.' '.$datane->last_name;
	
}

$jml_list = 0;
foreach ($playlist as $datane) {
	//echo "<br><br><br><br>".($datane->id_youtube);
	$jml_list++;
	$id_videolist[$jml_list] = $datane->link_video;
	$durasilist[$jml_list] = $datane->durasi;
	$urutanlist[$jml_list] = $datane->urutan;
}

$jml_video = 0;
foreach ($dafvideo as $datane) {

	if (in_array($datane->kode_video, $do_not_duplicate)) {
		continue;
	} else {
		$do_not_duplicate[] = $datane->kode_video;
		$jml_video++;
		$nomor[$jml_video] = $jml_video;
		$id_video[$jml_video] = $datane->kode_video;
		$idjenis[$jml_video] = $datane->id_jenis;
		$jenis[$jml_video] = $txt_jenis[$datane->id_jenis];
		$id_jenjang[$jml_video] = $datane->id_jenjang;
		$id_kelas[$jml_video] = $datane->id_kelas;
		$id_mapel[$jml_video] = $datane->id_mapel;
		$id_ki1[$jml_video] = $datane->id_ki1;
		$id_ki2[$jml_video] = $datane->id_ki2;
		$id_kd1_1[$jml_video] = $datane->id_kd1_1;
		$id_kd1_2[$jml_video] = $datane->id_kd1_2;
		$id_kd1_3[$jml_video] = $datane->id_kd1_3;
		$id_kd2_1[$jml_video] = $datane->id_kd2_1;
		$id_kd2_2[$jml_video] = $datane->id_kd2_2;
		$id_kd2_3[$jml_video] = $datane->id_kd2_3;
		$id_kategori[$jml_video] = $datane->id_kategori;
		$topik[$jml_video] = $datane->topik;
		$judul[$jml_video] = $datane->judul;
		$deskripsi[$jml_video] = $datane->deskripsi;
		$keyword[$jml_video] = $datane->keyword;
		$link[$jml_video] = $datane->link_video;
		$filevideo[$jml_video] = $datane->file_video;

		$durasi[$jml_video] = $datane->durasi;
		if (substr($datane->durasi, 0, 2) == "00")
			$durasi[$jml_video] = substr($datane->durasi, 3, 5);

		$thumbs[$jml_video] = $datane->thumbnail;
		if (substr($thumbs[$jml_video], 0, 4) != "http")
			$thumbs[$jml_video] = "<?php echo base_url(); ?>uploads/thumbs/" . $thumbs[$jml_video];

		// if ($link[$jml_video]!="")
		// 	$thumbs[$jml_video]=substr($link[$jml_video],-11).'.';
		// else if ($filevideo[$jml_video]!="")
		// 	$thumbs[$jml_video]=substr($filevideo[$jml_video],0,strlen($filevideo[$jml_video])-3);
		$status_verifikasi[$jml_video] = $datane->status_verifikasi;
		$modified[$jml_video] = $datane->modified;
		//echo $datane->link_video;
		$pengirim[$jml_video] = $datane->first_name;
		// $verifikator1[$jml_video] = '';
		// $verifikator2[$jml_video] = '';
		// $siaptayang[$jml_video] = '';

		$catatan1[$jml_video] = $datane->catatan1;
		$catatan2[$jml_video] = $datane->catatan2;
	}
}



if ($jml_video >= 5)
	$jml_video = 5;


?>
<div style="float: right; margin-right: 20px" id="jam">
	<!--	--><?php
			   //	$url = 'https://worldtimeapi.org/api/timezone/Asia/Jakarta';
			   //	$obj = json_decode(file_get_contents($url), true);
			   //	$stampdate = $obj['datetime'];
			   //	echo $stampdate.'<br>';
			   //	$jamsaiki = substr($obj['datetime'], 11, 8);
			   //	echo $jamsaiki." WIB";
			   // ?>
</div>

<div id="jamsekarang" style="padding-top:65px;float: right; margin-right: 20px" id="jam">
</div>

<div style="color:#ffffff;margin-left:10px;margin-right:10px;background-color:white;">
	<div class="indukplay" style="padding-top:90px;text-align:center;margin-left:auto;margin-right: auto;">
		<div class="iframe-container embed-responsive embed-responsive-16by9">
			<div class="embed-responsive-item" style="width: 100%" id="isivideoyoutube">
			<?php
				if ($jml_list==0) {
					if ($kdusr=="pemilik") {
				?>
				<img src="<?php echo base_url(); ?>assets/images/playlistbelum.png">
				<?php } else {
				?>
				<img src="<?php echo base_url(); ?>assets/images/playlistbelum2.png">
				<?php }} ?>
			</div>
		</div>
		<br>
	</div>
</div>
<hr>
<div style="text-align: center">
<span style="font-weight: bold;color: grey">Channel</span> <span style="font-weight: bold;color: black"><?php echo $namaku; ?> [
 <a href="<?php echo base_url(); ?>channel/sekolah/ch<?php echo $npsnku; ?>"><?php echo $nama_sekolahku; ?></a>]</span>
	</div><br>
<div style="text-align: center">
	<span style="font-weight: bold;color: grey">LEARNING PATH TERBARU</span>
	<div class="rowvod">
	
		<?php
		for ($a1 = 1; $a1 <= $jml_video; $a1++) {
			echo '<div class="columnvod">

		<a href="<?php echo base_url(); ?>watch/play/' . $id_video[$a1] . '/p">
		<div class="grup" style="margin:auto;width:175px;position:relative;text-align:center">
			<div style="font-size:11px;background-color:black;color:white;position: absolute;right:10px;bottom:10px">'
			. $durasi[$a1] . 
			'</div>
			<img style="align:middle;width:175px;height:112px" src="' . $thumbs[$a1] . '"><br>
		</div>
		
		<div class="grup" style="text-align:center">
			<div id="judulvideo">' . $judul[$a1] . '</div><br><br>
		</div>

		</a></div>';
		}
		?>
	</div>
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
	var namabulan = new Array('Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt','Nop', 'Des');
	var detiklokal = 0;
	var tgl, bln, thn, jam, menit, detik, jmmndt;
	var cekjatah = 0;
	var detikselisih;

	<?php
	$stampdate = new DateTime();
	$stampdate->setTimezone(new DateTimezone('Asia/Jakarta'));
	echo "var tglnow = new Date('" . $stampdate . "');";
	?>

	var jamnow = tglnow.getTime();
	var jmljudul = 0;
	var jmlterm = 0;
	var jamjadwal,jamsaiki;

	filler[1] = 'X7R-q9rsrtU';
	detikke[1] = "00:00:00";
	durasi = 0;
	
	console.log(<?php echo $jml_list;?>);

	<?php
	if ($jml_list>0) {
		for ($q=1;$q<=$jml_list;$q++) {
			echo "idvideo[".$q."] = youtube_parser('".$id_videolist[$q]."'); \r\n";
			echo "durasike[".$q."] = '".$durasilist[$q]."'; \r\n";
			if ($q>1) {
				echo "detikke[".$q."] = keJam(new Date(jamHitung(".($q-1).")+hitungDurasi(".($q-1)."))); \r\n";
			}
			echo "durasi=durasi+hitungDurasi(".$q."); \r\n";
		};
		
	}
	?>
	
	jmljudul = <?php echo $jml_list;?>;
	if (durasi>0)
	jmlterm = (86400 / (durasi/1000)) - 1;
	


/*jamakhir = new Date("1970-01-01T" + detikke[3] + "Z").getTime();
jamawal = new Date("1970-01-01T" + detikke[1] + "Z").getTime();*/
	//	durasi = hitungDurasi(1) + hitungDurasi(2) + hitungDurasi(3);
	
	if (jmlterm>0) {
		for (var y=1;y<=jmlterm;y++) {
			for (var z = 1; z <= jmljudul; z++) {
				detikke[y * jmljudul + z] = keJam(new Date("1970-01-01T" + detikke[z]).getTime() + durasi*y);
				durasike[y * jmljudul + z] = durasike[z];
				idvideo[y * jmljudul + z] = idvideo[z];
				//console.log("detikke"+(y * jmljudul + z)+":"+detikke[y * jmljudul + z]);
			}
		}
	}
	
	function youtube_parser(url)
	{
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		return (match && match[7].length == 11) ? match[7] : false;
	}

	<?php
	if ($jml_list>0) {
		?>
		
	function onYouTubeIframeAPIReady()
	{
		player = new YT.Player('isivideoyoutube', {
			width: 600,
			height: 400,
			videoId: 'lEc1oydQDHo',
			showinfo: 0,
			controls: 0,
			autoplay: 0,
			playerVars: {
				color: 'white',
				playlist: ''
			},
			events: {
				onReady: initialize
			}
		});
	}
	
	<?php } ?>

	function initialize()
	{
		$(function () {
			setInterval(updateTanggal, 1000);
		});
		player.playVideo();
	}


	function jamHitung(ke)
	{
		return new Date("1970-01-01T" + detikke[ke]).getTime();
	}

	function hitungDurasi(ke)
	{
		detikjam = parseInt(durasike[ke].substring(0,2))*3600;
		detikmenit = parseInt(durasike[ke].substring(3,5))*60;
		detikdetik = parseInt(durasike[ke].substring(6,8));
		totaldurasi = (detikjam + detikmenit + detikdetik)*1000;
		return totaldurasi;
	}

	function updateTanggal()
	{
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

		if(durasi>0)
			updatePlaying();
	}

	function keJam(jaminput)
	{
		tgl1 = new Date(jaminput).getDate();
		bln1 = new Date(jaminput).getMonth();
		thn1 = new Date(jaminput).getFullYear();
		jam1 = new Date(jaminput).getHours();
		if (jam1 < 10)
			jam1= '0' + jam1;
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


	function updatePlaying()
	{
		for (a = 1; a <= (jmljudul*jmlterm); a++) {
			jamjadwal = new Date("1970-01-01T" + detikke[a] + "Z").getTime();
			jamsaiki = new Date("1970-01-01T" + jmmndt + "Z").getTime();
			//console.log(detikke[a]+":"+jmmndt);
			terakhir = a;
			if (jamsaiki >= jamjadwal) {
				cekjatah = a;
				detikselisih = (jamsaiki - jamjadwal) / 1000;
				//break;
			}
			if (terakhir!=cekjatah)
				break;
		}

	/*console.log("Jatah:"+jatah);
	console.log("CekJatah:"+cekjatah);*/

		if (cekjatah != jatah) {

			console.log(cekjatah);
			console.log(idvideo[cekjatah]);
			jatah = cekjatah;

			detiklokal = detikselisih;

			console.log("Jatah2:"+jatah);
			console.log("Selisih:"+detikselisih);

			if (detiklokal>durasike[jatah]) {
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


	$(document).on('ready', function () {
		$(".regular").slick({
			dots: true,
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 5
		});
	});
	
</script>


