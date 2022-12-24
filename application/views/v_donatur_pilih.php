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
						<h1>ACCOUNT EXECUTIVE</h1>
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
				<center><span style="font-size:18px;font-weight: bold;">DAFTAR DONATUR<br><br>
				<button onclick="window.open('<?php echo base_url() . "eksekusi/register_donatur/pilih"; ?>','_self');"
						style="font-size:16px;padding:10px;margin-bottom: 5px;" class="btn-main">Donatur Baru</button>
        </span></center>
				<br>
				<hr>

				<div id="tabel1" style="font-size:1em;margin-left:1px;margin-right:1px;">
					<table id="tbl_user" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:2%;text-align:center">No</th>
							<th style='width:10%;text-align:center'>Nama Donatur</th>
							<th style='width:20%;text-align:center'>Lembaga</th>
							<th class="none" style='width:20%;text-align:center'>HP</th>
							<th class="none" style='text-align:center'>Alamat</th>
							<th class="none" style='width:10%;text-align:center'>Email</th>

							<th style='width:10%;text-align:center'>Aksi</th>
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


<script src="https://www.youtube.com/iframe_api"></script>
<script src="<?php echo base_url(); ?>js/videoscript.js"></script>

<script>

	//$('#d3').hide();

	$(document).ready(function () {
		//$.fn.DataTable.ext.pager.numbers_length = 4;
		var data = [];

		<?php
		$jml_user = 0;
		foreach ($dafuser as $datane) {
			$jml_user++;
			echo "data.push([ " . $jml_user . ", \"" . $datane->nama_donatur .
				"\", \"" . $datane->nama_lembaga . "\", \"" .
				$datane->telp_donatur . "\", \"" . $datane->alamat .
				"\", \"" . $datane->email_donatur .
				"\",\"<button onclick='pilih(" . $datane->id . ");'>Pilih</button><button onclick='edit(" . $datane->id . ");'>Edit</button><button onclick='hapus(" . $datane->id . ");'>Hapus</button>\"]);";
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
					targets: [0, 1, 2, 3, 4, 5, 6]
				}
			]
		});


		// new $.fn.dataTable.FixedHeader(table);

	});

	function pilih(idnya) {
		kodeeks = "<?php echo $kodeeks;?>";
		window.open("<?php echo base_url() . 'eksekusi/donatur_terpilih/';?>" + kodeeks + "/" + idnya + "/", "_self");
	}

	function edit(idnya) {
		window.open("<?php echo base_url() . 'eksekusi/edit_donatur/pilih/';?>" + idnya + "/", "_self");
	}

	function hapus(idnya) {
		var r = confirm("Mau menghapus donatur ini?");
		if (r == true) {
			$.ajax({
				url: "<?php echo base_url();?>eksekusi/deldonatur",
				method: "POST",
				data: {iddonatur: idnya},
				success: function (result) {
					if (result == "berhasil")
						location.reload();
					else
						alert("Gagal menghapus");
				}
			});
		} else {
			return false;
		}
		return false;
	}
</script>
