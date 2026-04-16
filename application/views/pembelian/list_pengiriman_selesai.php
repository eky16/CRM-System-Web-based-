<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        scrollX: true,
    });
});
</script>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
        "lengthMenu": [ 5,10, 25, 50, 75, 10
    });
</script>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
					</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="card shadow">
                 <?php if($title == "List Payment Waiting Approved"):?>   
					<div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>payment/finish_"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>

   <div class="panel-body">
    <form method="post" action="<?= base_url('mom/lihat_filter') ?>" class="form-horizontal">  
        <div class="panel_controls">                         

    </div>
    </form>  
</div>  
<div class="card-header">
           <div class="float-right"> 
            <a  href="<?= base_url('wo/export_excel_selesai'); ?>" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Laporan !!!</a>

           <font size="2px">       
            </div>

           <font color="blue"><strong>Riwayat Pengiriman</strong></font> / <a  href="<?php echo base_url(); ?>wo/item_selesai">
            <strong>List Item Selesai</strong></a> / <a  href="<?php echo base_url(); ?>wo/item_selesai_forecast">
            <strong>Riwayat Forecast Stok</strong></a> 
      

            </div>
            </font>
                    
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
                                        <td width="50"><font size="2px">Tgl Kirim</font></td>
					                    
										<td width="100"><font size="2px">No Kendaraan</font></td>
										<td width="150"><font size="2px">Supir</font></td>
										<td width="150"><font size="2px">Kenek</font></td>
										<td width="100"><font size="2px">Aksi</font></td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pr as $row): ?>
										<tr>
											<td><font size="1px"><?= $no++ ?></font></td>
				                            <td ><font size="2px"><?= $row->tgl_kiriman ?></font></td>
											<td ><font size="2px"><?= $row->no_kendaraan ?></font></td>
                                            <td><font size="2px"><?= $row->nama_supir ?></font></td>
                                            <td><font size="2px"><?= $row->nama_kenek ?></font></td>
											<td><font size="2px">
											 <a target="_blank" href="<?= base_url('wo/detail_pengiriman/' . $row->id_pengiriman  ) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a>	
										
                                                    <!--<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('pembelian/hapus_pr_hd_dt_hs/' . $row->number_ ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>-->
                                           </font>
												</td>
										
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
<!-- modal update -->


                            <!-- Color System -->
                       

 <!-- end modal -->
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
    <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>