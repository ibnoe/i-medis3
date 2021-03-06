<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {

		var oTable = $('#setup_komponen_jp').dataTable( {
			"sPaginationType"	: "full_numbers",
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?php echo site_url('master/setup_komponen_jp/load_data?unit_id='.$unit->id); ?>",
			"aoColumnDefs"		: [
									  { "bSortable": false, "aTargets": [ 2 ] }
								  ],
			"aaSorting"			: [[ 1, "asc" ]],
			"aoColumns"			: [
									  { sWidth: 'null' },
									  { sWidth: '80px' },
									  { sWidth: '90px' }
								  ]
		});
		
		$('#setup_komponen_jp').on('click', '.delete-row', function() {
			var id = $(this).data('id');
			alertify.set({
				labels: {
					ok: "OK",
					cancel: "Batal"
				},
				delay: 5000,
				buttonReverse: false,
				buttonFocus: "ok"
			});
			alertify.confirm("Hapus record tersebut?", function (e) {
				if (e) {
					$.ajax({
						type: 'get',
						url: '<?php echo site_url('master/setup_komponen_jp/delete'); ?>',
						data: 'id=' + id,
						success: function() {
							oTable.fnDraw();
							alertify.success("Record telah di hapus dari database!");
						},
						error: function() {
							alertify.error("Penghapusan record gagal!");
						}
					});
				}
			});
			return false;
		});
		
		$("#setup_komponen_jp").on("click", ".order_up", function(event){
			var id = $(this).data('id');
			$.ajax({
				type: 'get',
				url: '<?php echo site_url('master/setup_komponen_jp/order_up'); ?>',
				data: 'id=' + id,
				success: function() {
					oTable.fnDraw();
					alertify.success("Ordering berhasil disimpan.");
				},
				error: function() {
					alertify.error("Penghapusan record gagal!");
				}
			});
			return false;
		});

		$("#setup_komponen_jp").on("click", ".order_down", function(event){
			var id = $(this).data('id');
			$.ajax({
				type: 'get',
				url: '<?php echo site_url('master/setup_komponen_jp/order_down'); ?>',
				data: 'id=' + id,
				success: function() {
					oTable.fnDraw();
					alertify.success("Ordering berhasil disimpan.");
				},
				error: function() {
					alertify.error("Penghapusan record gagal!");
				}
			});
			return false;
		});
		
	});
</script>
<style type="text/css">
	.dashboard-wrapper .left-sidebar {
		margin-right: 0;
	}
	.form-actions {
		border-top: 0;
		border-bottom: 1px solid #E5E5E5;
		margin: 0;
		padding: 5px 10px 5px;
	}
	span.gi {
		color: #CCCCCC;
		font-weight: bold;
		vertical-align: top;
	}
	#tarif_pelayanan thead th {
		text-align: center;
	}
	#tarif_pelayanan td:nth-child(2),
	#tarif_pelayanan td:nth-child(3) {
		text-align: right;
	}
	#setup_komponen_jp_processing {
		position:absolute;
		top: 50%;
		left: 50%;
		width:20em;
		height:2em;
		margin-top: -10em; /*set to a negative number 1/2 of your height*/
		margin-left: -10em; /*set to a negative number 1/2 of your width*/
		border: 1px solid #ccc;
		background-color: #f3f3f3;
		text-align: center;
		padding-top: 0.5em;
		padding-bottom: 0.5em;
	}
</style>
<div class="left-sidebar">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget" style="border: none; margin-bottom: 10px;">
				<ul class="breadcrumb-beauty">
					<li><a href="<?php echo site_url('master/jenis_pelayanan'); ?>">Jenis Pelayanan</a></li>
					<li><a href="<?php echo site_url("master/jenis_pelayanan/setup_jp/".$unit->id); ?>">Setup Jasa Pelayanan <?php echo $unit->nama; ?></a></li>
					<li><a href="#">Setup Komponen Jasa Pelayanan <?php echo $unit->nama; ?></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="widget">
				<div class="widget-header">
					<div class="title">Setup Komponen Jasa Pelayanan</div>
					<span class="tools"><a class="fs1" aria-hidden="true" data-icon="&#xe090;"></a></span>
				</div>
				<div class="form-actions no-margin">
					<a id="tambah" class="btn btn-info bottom-margin pull-right" href="<?php echo site_url('master/setup_komponen_jp/add?unit_id='.$unit->id); ?>" data-original-title="">Tambah</a>
					<div class="clearfix"></div>
				</div>
				<div class="widget-body">
					<div id="dt_example" class="example_alt_pagination">
						<table class="table table-striped table-condensed table-striped table-hover table-bordered pull-left" id="setup_komponen_jp">
							<thead>
								<tr>
									<th>Nama Komponen</th>
									<th>Ordering</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="3" class="dataTables_empty">Loading data from server</td>
								</tr>
							</tbody>
						</table>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
