<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$txt_contreng = Array('---', 'Masuk');
$nama_verifikator = Array('-', 'Calon', 'Verifikator');
$txt_jenis = Array('-', 'Instruksional', 'Non Instruksional');
$namasifat = Array('Publik', 'Pribadi', 'Bimbel');
$statustayang = Array();

$jml_video = 0;
foreach ($dafvideo as $datane) {
	$jml_video++;
	$nomor[$jml_video] = $jml_video;
    $id_playlist[$jml_video] = $datane->idplaylist;
	$id_video[$jml_video] = $datane->idvideo;
	$kode_video[$jml_video] = $datane->kode_video;
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
	$durasi[$jml_video] = $datane->durasi;
	$deskripsi[$jml_video] = $datane->deskripsi;
	$keyword[$jml_video] = $datane->keyword;
	$link[$jml_video] = $datane->link_video;
	$namafile[$jml_video] = $datane->file_video;
	$dilist[$jml_video] = $datane->dilist;
	$sifat[$jml_video] = $datane->sifat;
    $urutan[$jml_video] = $datane->urutan;
	$namapaket = $datane->nama_paket;
	$kodepaket = $datane->link_list;

}

if ($jml_video==0)
{ ?>
	<div style="color:#000000;margin-left:10px;margin-right:10px;background-color:white;margin-top: 60px;">
	<br>
		<center>
			<span style="font-size:16px;font-weight: bold;">ANDA BELUM MEMILIKI VIDEO</span>
		</center>
	<br>
		<center>
			<span style="font-size:16px;font-weight: bold;">Silakan Tambahkan Video pada menu VOD Sekolah</span>
		</center>
	</div>
<?php 
die();
}
?>

<!--<script src="--><?php //echo base_url() ?><!--js/jquery-3.4.1.js"></script>-->
<script src="<?php echo base_url(); ?>js/jquery-3.4.1.js"></script>

<div style="color:#000000;margin-left:10px;margin-right:10px;background-color:white;margin-top: 60px;">
	<br>
	<center>
		<span style="font-size:16px;font-weight: bold;">PAKET <?php echo $namapaket;?></span></center>
	<br>
	
	<button type="button" onclick="window.location.href='<?php echo base_url();?>channel/playlisttve'" class=""
				style="float:left;margin-right:10px;margin-top:-20px;">Kembali
	</button>

    <button type="button" onclick="updatedata()" class=""
            style="float:right;margin-right:10px;margin-top:-20px;">Update
    </button>

	<!--	<button style="margin-left:10px" id="btn-show-all-children" type="button">Buka Semua</button>-->
	<!--	<button style="margin-left:10px" id="btn-hide-all-children" type="button">Tutup Semua</button>-->
	<hr>

	<div id="tabel1" style="margin-left:10px;margin-right:10px;">
		<table id="tbl_user" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th style='padding:5;width:5px;'>No</th>
					<th style='padding:5;width:20%;'>Judul</th>
					<th>Durasi</th>					
					<th>Masuk Playlist</th>
					<th class="none">Video</th>
					<th class="none">Topik</th>
					<th class="none">Jenis</th>
					<th class="none">Sifat</th>
				</tr>
			</thead>

			<tbody>
				<?php
				for ($i = 1; $i <= $jml_video; $i++) {
				?>
				<tr>
					<td><?php echo $nomor[$i]; ?></td>
					<td><?php echo $judul[$i]; ?></td>
					<td><?php echo $durasi[$i]; ?></td>

                    <td align="center">
                        <input style="text-align:center;" size="5px" maxlength="3" type="text"
                               name="iurut<?php echo $i;?>" id="iurut<?php echo $i;?>" value="<?php echo$urutan[$i]; ?>">
                    </td>
					
					<?php
										{
						if ($link[$i] != "") {
							$youtube_url = $link[$i];
							$id = youtube_id($youtube_url);
					?>
					<td>
						<button onclick="lihatvideo('<?php echo $id; ?>')" id="thumbnail"
										data-video-id="STxbtyZmX_E" type="button">Play
						</button>
						<br>
					</td>

					<?php
				} else if ($namafile[$i] != "") {
					$nama_video = $namafile[$i];
					//$id = youtube_id($youtube_url);
					?>
					<td>
						<button onclick="lihatvideo2('<?php echo $nama_video; ?>')" type="button">Play</button>
						<br>

					</td>

					<?php
				}
			} ?>
					
					<td><?php echo $topik[$i]; ?></td>
					<td><?php echo $jenis[$i]; ?></td>
					<td align="center">
						<div style="background-color: <?php
						if ($sifat[$i]==0)
							echo '#b4e7df';
						else
							echo '#ffd0b4';?>"><?php echo $namasifat[$sifat[$i]]; ?></div>
					</td>
					
					
				</tr>
				<?php
			}
				?>
			</tbody>
		</table>
	</div>
</div>

<div style="margin:auto;width:auto;color:#000000;margin-left:10px;margin-right:10px;background-color:white;">
	<div id="video-placeholder" style='display:none'></div>
	<div id="videolokal" style='display:none'></div>
</div>

<!-- <div id="controls">
<h2>Play</h2>
<i id="play" class="material-icons">play_arrow</i>

<h2>Pause</h2>
<i id="pause" class="material-icons">pause</i>



<h2>Dynamically Queue Video</h2>
<img class="thumbnail" src="images/cat_video_1.jpg" data-video-id="Aas9SPY_k2M">
<img class="thumbnail" src="images/cat_video_2.jpg" data-video-id="KkFnm-7jzOA">
<img class="thumbnail" src="images/cat_video_3.jpg" data-video-id="Ph77yOQFihc">
</div> -->


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/responsive.bootstrap.min.css">


<style type="text/css" class="init">
	.text-wrap {
		white-space: normal;
	}

	.width-200 {
		width: 200px;
	}
</style>

<script src="https://www.youtube.com/iframe_api"></script>
<script src="<?php echo base_url(); ?>js/videoscript.js"></script>
<script>

	var oldurl = "";
	var oldurl2 = "";

	$(document).on('change', '#itahun', function () {
		get_analisis_view();
	});

	function get_analisis_view()
	{
		window.open("/rtf2/home/filter/" + $('#itahun').val() +
		"/" + $('#iformal').val() + "/" + $('#iseri').val() + "/" + $('#ijenjang').val() + "/" + $('#imapel').val(), "_self");
	}

	$(document).ready(function () {
		var table = $('#tbl_user').DataTable({
			'responsive': true,
			'columnDefs': [
				{
					render: function (data, type, full, meta) {
						return "<div class='text-wrap width-50'>" + data + "</div>";
					},
					targets: [1, 2]
				},
				{
					width: 25,
					targets: 0
				}
			]

		});


		new $.fn.dataTable.FixedHeader(table);

		// Handle click on "Expand All" button
		$('#btn-show-all-children').on('click', function () {
			// Expand row details
			table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
		});

		// Handle click on "Collapse All" button
		$('#btn-hide-all-children').on('click', function () {
			// Collapse row details
			table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
		});
	});

	function lihatvideo(url)
	{
		document.getElementById("videolokal").style.display = 'none';
		$('#videolokal').html('');

		if (oldurl == "") {
			document.getElementById("video-placeholder").style.display = 'block';
			player.cueVideoById(url);
			player.playVideo();
		} else {
			if ((oldurl == url) && (document.getElementById("video-placeholder").style.display == 'block')) {
				document.getElementById("video-placeholder").style.display = 'none';
				player.pauseVideo();
			} else {
				document.getElementById("video-placeholder").style.display = 'block';
				player.cueVideoById(url);
				player.playVideo();
			}
		}
		oldurl = url;
	}

	function lihatvideo2(url2)
	{
		player.pauseVideo();
		$('#videolokal').html('<video width="600" height="400" autoplay controls>' +
		'<source src="<?php echo base_url();?>uploads/tve/' + url2 + '" type="video/mp4">' +
		'Your browser does not support the video tag.</video>');
		//alert ("VIDEO");
		document.getElementById("video-placeholder").style.display = 'none';
		if (oldurl2 == "") {
			document.getElementById("videolokal").style.display = 'block';
			//document.getElementById("videolokal").value = "NGENGOS";
		} else {
			if ((oldurl2 == url2) && (document.getElementById("videolokal").style.display == 'block')) {
				document.getElementById("videolokal").style.display = 'none';
				$('#videolokal').html('');
				//document.getElementById("videolokal").value = "NGENGOS";
			} else {
				document.getElementById("videolokal").style.display = 'block';
				//document.getElementById("videolokal").value = "NGENGOS";
			}
		}
		oldurl2 = url2;
	}

	function mauhapus(idx)
	{

		var r = confirm("Yakin mau hapus?");
		if (r == true) {
			window.open('<?php echo base_url();?>video/hapus/' + idx);
		} else {
			return false;
		}
		return false;
	}

	function gantisifat(idx)
	{
		statusnya=0;
		if ($('#bt1_'+idx).html()=="Publik") {
			statusnya=1;	
		}
		
		$.ajax({
			url: "<?php echo base_url();?>channel/gantisifat",
			method: "POST",
			data: {id: idx, status:statusnya},
			success: function (result) {
				if ($('#bt1_'+idx).html()=="Publik") {
					$('#bt1_'+idx).html("Pribadi");
					$('#bt1_'+idx).css({"background-color":"#ffd0b4"});
				} else {
					$('#bt1_'+idx).html("Publik");
					$('#bt1_'+idx).css({"background-color":"#b4e7df"});
				}	
			}
		})
			
	}

    function updatedata()
    {
        var urutbaru = new Array();
        var idvid = new Array();

        <?php
        for ($i = 0; $i < $jml_video; $i++) {
            echo "urutbaru[".$i."]=$('#iurut".($i+1)."').val();";
            echo "idvid[".$i."]=".$id_playlist[($i+1)].";";
        }
        ?>

		//for (var a=0; a<<?php //echo $jml_video;?>//; a++) {
		//	console.log("ID:"+idvid[a]);
		//	console.log("URUT:"+urutbaru[a]);
		//}

        $.ajax({
            url: "<?php echo base_url();?>channel/updateurutan_tve",
            method: "POST",
            data: {id:idvid, urutan:urutbaru},
            success: function (result) {
                location.reload();
            }
        })


    }

</script>
