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
				<center><span style="font-size:18px;font-weight: bold;">EVENT HARIAN SHARE KONTEN <br><?=$tanggalsekarang?><br><br>
		</span></center>
				<br>
				<div style="float:left;margin-bottom: 10px;">
					<button type="button" class="btn-main"
							onclick="window.location.href='<?php echo base_url(); ?>event/mentor_dashboard'">
						Kembali
					</button>
					<button type="button" class="btn-main"
							onclick="window.open('<?php echo base_url(); ?>vod','_blank')">
						Konten Perpustakaan Digital
					</button>
				</div>
				<hr style="margin-bottom:5px;">
				<div>
				<ol>
					<li>
						Klik tombol 'Konten Perpustakaan Digital'</li>
					<li>Cari dan pilih kontennya</li>
					<li>Bagikan dengan cara klik tombol <img class='logobagikan' height="20" width="60" src="<?php echo base_url(); ?>images/bagikan.jpg"> pada bagian bawah Video. </li>
					<li>Copy alamat url (<i>mis. https://www.facebook.com/sharer/sharer.php?u=https....</i>) dan paste ke tabel berikut dengan cara klik tombol Edit
					</li>
				</ol>
				</div>
				 
				<div id="tabel1" style="font-size:1em;margin-left:1px;margin-right:1px;">
					<table id="tbl_user" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th style="width:2%;text-align:center">No</th>
							<th style='width:25%;text-align:center'>Alamat URL Share</th>
							<th style='width:5%;text-align:center'>Input</th>
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
		$urutan = 0;
		foreach ($daftarharian as $datane) {
			$urutan++;
			
			echo "data.push([ " . $urutan . ", \"<input onClick='this.select();' id='input".$urutan."' disabled style='width:100%' type='text' value='" . $datane->alamat_share .
				"'>\",\"<center><div><button id='tombol".$urutan."' onclick='inputurl(".$urutan.");'>Edit</button></div></center>\"]);";
		}

		for ($a=$urutan+1;$a<=5;$a++) {
			echo "data.push([ " . $a . ", \"<input onClick='this.select();' id='input".$a."' disabled style='width:100%' type='text' value=''>\",\"<center><div><button id='tombol".$a."' onclick='inputurl(".$a.");'>Edit</button></div></center>\"]);";
		}
		?>


		$('#tbl_user').DataTable({
			data: data,
			deferRender: true,
			scrollCollapse: true,
			scroller: true,
			'ordering': false,
			'searching' : false,
			'bInfo' : false,
			'bPaginate': false,
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
					targets: [1],
					render: function (data, type, full, meta) {
						return "<div style='text-align:center'>" + data + "</div>";
					},
					targets: [0]
				}
			]
		});


		// new $.fn.dataTable.FixedHeader(table);

	});

	function inputurl(indeks) {
		if ($('#tombol'+indeks).html()=="Update")
		{
			$.ajax({
				url: "<?php echo base_url();?>event/add_mentor_harian",
				method: "POST",
				data: {indeks: indeks, alamat_url: $('#input'+indeks).val()},
				success: function (result) {
					$('#tombol'+indeks).html('Edit');
					document.getElementById('input'+indeks).disabled = true;
				}
			})
			
		}
		else
		{
			$('#tombol'+indeks).html('Update');
			document.getElementById('input'+indeks).disabled = false;
			$("#input"+indeks).select();
		}
		
	}


</script>
