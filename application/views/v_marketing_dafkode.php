<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
						<h1>Area Marketing</h1>
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
				<br>
				<center><span style="font-size:18px;font-weight: bold;">DAFTAR KODE REFERAL SEKOLAH<br><br>
		</span></center>
				<br>
				<div style="float:left;margin-bottom: 10px;">
					<button type="button" class="btn-main"
							onclick="window.location.href='<?php echo base_url(); ?>profil/'">
						Kembali
					</button>
				</div>
				<hr>

				<div id="tabel1" style="font-size:1em;margin-left:1px;margin-right:1px;">
					<table id="tbl_user" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:2%;text-align:center">No</th>
							<th style='width:10%;text-align:center'>Nama Sekolah</th>
							<th style='width:20%;text-align:center'>NPSN</th>
							<th style='width:20%;text-align:center'>Agency</th>
							<th style='width:20%;text-align:center'>Kode Ref</th>
							<th style='width:20%;text-align:center'>User</th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

<style>
	.text-wrap{
		white-space: initial;
		word-break: break-word;
	}
	.width-50{
		min-width: 10px;
	}
</style>

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
		foreach ($dafkode as $datane) {
			$jml_user++;
			if ($datane->id_agency == 0)
				$namaagency = "-";
			else
				$namaagency = $datane->first_name . " " . $datane->last_name;
			echo "data.push([ " . $jml_user . ", \"" . $datane->nama_sekolah .
				"\", \"" . $datane->npsn_sekolah . "\", \"" . $namaagency .
				"\",\"<center><div><button onclick='lihat(" . $datane->id . ");'>".$datane->kode_referal."</button></div></center>\"" .
				",\"<center><div><button onclick='dafuser(" . $datane->npsn_sekolah . ");'>Lihat</button></div></center>\"]);";
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
					targets: [0, 1, 2, 3]
				}
			]
		});


		// new $.fn.dataTable.FixedHeader(table);

	});

	function lihat(id) {
		window.open("<?php echo base_url() . 'marketing/kode_referal/';?>" + id, "_self");
	}

	function dafuser(npsn) {
		window.open("<?php echo base_url() . 'marketing/daftar_user/';?>" + npsn, "_self");
	}


</script>
