<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$txt_sebagai = Array('', 'Guru', 'Siswa', 'Umum', 'Staf Fordorum');
$nama_verifikator = Array('-', 'Calon', 'Verifikator', 'Verifikator', '', '', '', '', '', '-');

if (!isset($sebagai))
	$sebagai = "";

if (!isset($premium))
	$premium = "";

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
						<h1>User</h1>
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
				<center>
					<?php if ($this->session->userdata('a02') && $this->session->userdata('sebagai') == 1) {
						echo $sekolahku . $premium;
					}
					if ($this->session->userdata("a01") || ($this->session->userdata("sebagai") == 4
							&& $this->session->userdata("verifikator") == 3)) { ?>
						<br><br>
						<span style="font-size: 14px;">
				<button onclick="window.open('<?php echo base_url() . "user/"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar User</button>
				<button onclick="window.open('<?php echo base_url() . "user/calver"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar Calon Ver</button>
				<button onclick="window.open('<?php echo base_url() . "user/calkontri"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar Calon Kontri</button>
				<button onclick="window.open('<?php echo base_url() . "user/kontributorsekolah/dashboard"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar Guru Modul</button>
				<button onclick="window.open('<?php echo base_url() . "user/narsum"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar Narsum</button>
				<button onclick="window.open('<?php echo base_url() . "user/ae"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar AE</button>
				<button onclick="window.open('<?php echo base_url() . "user/am"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar AM</button>
				<button onclick="window.open('<?php echo base_url() . "user/agency"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar Agency</button>
				<button onclick="window.open('<?php echo base_url() . "user/bimbel"; ?>','_self');"
						style="padding:5px;margin-bottom: 5px;" class="">Daftar Tutor</button>
			</span>
					<?php }
					?>
					<br><br>
<!--					--><?php //if ($this->session->userdata('a02') && !$this->session->userdata('a01') && $nama_am != "kosong") {
//						echo "Area Marketing : " . $nama_am . "<br>";
//						if ($premium == "") {
//							$sisa = 25 - ($total_adapaketreguler + $total_adapaketpremium);
//							if ($sisa > 0)
//								echo "[Perlu " . $sisa . " paket pembelian menuju TV Sekolah Gratis]";
//							else
//								echo "Sekolah anda gratis iuran untuk bulan depan";
//						} else if ($premium == "PREMIUM") {
//							$sisa = 100 - ($total_adapaketreguler + $total_adapaketpremium);
//							echo "[Masih tersedia " . $sisa . " Paket Premium gratis]";
//						}
//
//					}
//					?>
				</center>
				<!--<button style="margin-left:10px" id="btn-show-all-children" type="button">Expand All</button>-->
				<!--<button style="margin-left:10px" id="btn-hide-all-children" type="button">Collapse All</button>-->
				<?php if ($asal == "dashboard") {
					if ($sebagai=="calver") { ?>
					<div style="margin-bottom: 10px;">
						<button class="btn-main"
								onclick="window.location.href='<?php echo base_url() . 'event/calon_verifikator'; ?>'">Kembali
						</button>
					</div>
				<?php }
				else
				{ ?>
					<div style="margin-bottom: 10px;">
						<button class="btn-main"
								onclick="window.location.href='<?php echo base_url() . 'profil'; ?>'">Kembali
						</button>
					</div>
				<?php }
				} ?>
				<hr>

				<div id="tabel1" style="font-size:1em;margin-left:1px;margin-right:1px;">
					<table id="tbl_user" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style='width:5px;text-align:center'>No</th>
							<th style='width:20%;text-align:center'>Nama</th>
							<th style='width:15%;text-align:center'>Sebagai</th>
							<?php if ($sebagai != "siswa") { ?>
								<th style='text-align:center'>Level</th>
							<?php } ?>
							<?php if ($this->session->userdata('a02') && !$this->session->userdata('a01')) { ?>
								<th style='text-align:center'>Paket Bulan Ini</th>
							<?php } else { ?>
								<th style='text-align:center'>Nama Sekolah</th>
							<?php } ?>
							<?php if($this->session->userdata('a01')) { ?>
								<th>Kab/Kota</th>
							<?php }
							?>
							<th>Email</th>
							<th>HP</th>
							<th>Detail</th>

						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

<!----------------------------- SCRIPT DATATABLE  -------------------------------->
<?php require_once('layout/calljs.php'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
		src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<script>

	//$('#d3').hide();

	$(document).ready(function () {
		//$.fn.DataTable.ext.pager.numbers_length = 4;
		var data = [];

		<?php
		$jml_user = 0;
		foreach ($dafuser as $datane) {
			$txtsebagai = array("", "Guru", "Siswa", "Umum", "Staf");
			if ($datane->verifikator == 3)
				$level = "Verifikator";
			else if ($datane->verifikator == 2)
				$level = "Calon Verifikator";
			else if ($datane->kontributor == 1 || $datane->kontributor == 2)
				$level = "Calon Kontributor";
			else if ($datane->kontributor == 3)
				$level = "Kontributor";
			else if ($datane->siam == 3)
				$level = "Mentor";
			else if ($datane->siae == 3)
				$level = "AE";
			else if ($datane->siag == 3)
				$level = "Agency";
			else if ($datane->bimbel == 3)
				$level = "Tutor Bimbel";
			else
				$level = "-";

			if ($this->session->userdata('a02') && !$this->session->userdata('a01')) {
				$cekpaket = $datane->strata;
				if ($cekpaket == 1)
					$datapaketsekolah = "Lite";
				else if ($cekpaket == 2)
					$datapaketsekolah = "Pro";
				else if ($cekpaket == 3)
					$datapaketsekolah = "Premium";
				else
					$datapaketsekolah = "-";
			} else {
				$datapaketsekolah = $datane->sekolah;
				$datapaketsekolah = str_replace('"',"'",$datapaketsekolah);
			}

			$jml_user++;
//			if($jml_user>58)
//				continue;

			if($this->session->userdata('a01')) {
				echo "data.push([ " . $jml_user . ", \"" . $datane->first_name . " " .
					$datane->last_name . "\", \"" . $txtsebagai[$datane->sebagai] . "\", \"" .
					$level . "\", \"" . $datapaketsekolah . "\", \"" . $datane->nama_kota . "\", \"" . $datane->email . "\", \"" . $datane->hp .
					"\",\"<button onclick='detil(" . $datane->id . ");'>Detil</button>\"]);";
			}
			else if ($sebagai != "siswa") {
				echo "data.push([ " . $jml_user . ", \"" . $datane->first_name . " " .
					$datane->last_name . "\", \"" . $txtsebagai[$datane->sebagai] . "\", \"" .
					$level . "\", \"" . $datapaketsekolah . "\", \"" . $datane->email . "\", \"" . $datane->hp .
					"\",\"<button onclick='detil(" . $datane->id . ");'>Detil</button>\"]);";
			}
			else
			{
				echo "data.push([ " . $jml_user . ", \"" . $datane->first_name . " " .
					$datane->last_name . "\", \"" . $txtsebagai[$datane->sebagai] . "\", \"" . $datapaketsekolah . "\", \"" . $datane->email . "\", \"" . $datane->hp .
					"\",\"<button onclick='detil(" . $datane->id . ");'>Detil</button>\"]);";
			}
		}
		?>


		$('#tbl_user').DataTable({
			data: data,
			deferRender: true,
			scrollCollapse: true,
			scroller: true,
			pagingType: "simple",
			language: {
				paginate: {
					previous: "<",
					next: ">"
				}
			},
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


		// new $.fn.dataTable.FixedHeader(table);

	});

	function detil(idnya) {
		window.open("<?php echo base_url() . 'user/detil/';?>" + idnya + "/<?php echo $asal;?>", "_self");
	}

</script>
