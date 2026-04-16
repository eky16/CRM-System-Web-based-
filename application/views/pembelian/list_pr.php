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
				
                            <a href="<?= base_url('wo/tambah') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
					
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
    <!--          <div class="form-group">
           </br>

 <div class="col-sm-5">                             
                 <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($all_leads_project as $lsp) : ?>
                                <option value="<?php echo $lsp->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $lsp->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option>
                                    <?php endforeach; ?>

                        </select>  
            </div>
            </div>
          
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-primary">Cari</button>  
            <a href="<?= base_url('mom/lihat_semua') ?>"> 
            <input type="button" class="btn btn-primary" value="Semua" \></a>                           
        </div> -->

    </div>
    </form>  
</div>  
<div class="card-header">
                        <div class="float-right">
                            
                 <?php if ($title == "Permintaan Barang Sedang Diproses") :?>   
                   <a href="<?= base_url('wo/export_excel_permintaan_diproses') ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Export Excel</a> 
                <?php endif; ?>

                   <?php if ($title == "List Sales Order") :?>       
                    </div><font color="blue"><strong>List Sales Order</strong></font>  / <a  href="<?php echo base_url(); ?>wo/proses_permintaan_barang"><strong>Permintaan Diproses</strong></a> / <a  href="<?php echo base_url(); ?>wo/list_permintaan_item"><strong>Kemajuan Sales Order</strong></a>/ <a  href="<?php echo base_url(); ?>wo/list_history_permintaan"><strong>Riwayat Permintaan Barang</strong></a></div>
                    <?php endif; ?>
                   <?php if ($title == "Permintaan Barang Sedang Diproses") :?>       
                    </div><a  href="<?php echo base_url(); ?>wo/list_permintaan"><strong>List Sales Order</strong></a> / <font color="blue"><strong>Permintaan Diproses</strong></font> / <a  href="<?php echo base_url(); ?>wo/list_permintaan_item"><strong>Kemajuan Sales Order</strong></a>/ <a  href="<?php echo base_url(); ?>wo/list_history_permintaan"><strong>Riwayat Permintaan Barang</strong></a></div>
                    <?php endif; ?>

                       <?php if ($title == "Riwayat Permintaan Barang") :?> 
                    </div><a  href="<?php echo base_url(); ?>wo/list_permintaan"><strong> List Sales Order</strong></a> / <font color="blue"><strong>Riwayat Permintaan Barang</strong></font></div>
                     <?php endif; ?>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td width="100"><font size="2px">ID</font></td>
										<td width="50"><font size="2px">Tgl Pesanan</font></td>
										<td width="300"><font size="2px">Customer</font></td>
                                        <td width="50"><font size="2px">Status</font></td>
                                       
                                        <td width="80"><font size="2px">Progress</font></td>
                                       
										<td width="80"><font size="2px">Aksi</font></td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pr as $row): ?>
										<tr>
											<td><font size="1px"><?= $no++ ?></font></td>
											<td><font size="2px"><?= $row->number_pr ?></font>
                                            </td>
											<td ><font size="2px"><?= $row->transDate ?></font></td>
											<td><font size="2px"><?= $row->nama_cst ?></font></td>
                                            <td align="center"><font size="3px">
                                            <?php
                                            $persentasi=round($row->proses/$row->progres * 100,2); 
                                             $status_pr = $row->status_po  ?>
                                            <?php if ($status_pr == 1 and $persentasi != 100):?>
                                              <span class="badge badge-warning">Menunggu Proses PPIC </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 2 and $persentasi != 100):?>
                                              <span class="badge badge-info">PROSES </span>
                                            <?php endif;?>

                                            <?php if ( $emp->department == 'Purchasing' OR $emp->department == 'IT' OR $emp->department == 'PPIC'):?>
                                            <?php if ($status_pr == 2 and $persentasi == 100):?>
                                            <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $row->id ; ?>" class="badge badge-success" style=" cursor:pointer;"><i class="fa fa-history"></i>&nbsp;&nbsp; <span  style=" cursor:pointer;" > Selesai Diproses </span></a>
                                            <?php endif;?>
                                            <?php else: ?>
                                            <?php if ($status_pr == 1 and $persentasi == 100):?>
                                             <span  class="badge badge-success"> Selesai Diproses </span>
                                              <?php endif;?>
                                             <?php endif;?>
                 
         
                                           <?php if ($status_pr == "Selesai"):?>
                                              <span  class="badge badge-success"> Selesai Diproses </span>
                                            <?php endif;?>
                                            </font></td>
                                           
                                            <td align="center"><font size="2px"><!--<?= $row->proses ?>/<?= $row->progres ?> - -->
                                                <?php 
                                                   $persentasi=round($row->proses/$row->progres * 100,2); 
                                                   echo "$persentasi% "."(".$row->progres . "Item)";
                                                 ?>
                                            </font></td>
                                         
											<td><font size="2px">
                                                    <a target="_blank" href="<?= base_url('wo/detail_pr/' . $row->id ) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a>
												
											<?php if ($row->status_po == 1 and $persentasi == 0) : ?>
                                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('wo/hapus_pr/' . $row->number_pr ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a><?php endif;?></font>
												</td>
										
										</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pindahkan <?php echo $row->number_pr; ?> ke Tabel Riwayat Permintaan Barang </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('wo/move_pr') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                Dibuat : <?php echo $row->created_po; ?>, <?php echo $row->createdtime_po; ?>
                                </div>
                                <div class="card-body">


          <input  type="text" hidden readonly name="id" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->id; ?>"  class="form-control" >
          <input  type="text" hidden readonly name="number_pr" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->number_pr; ?>"  class="form-control" >


										<div class="form-group col-12">
											<label>Progres Permintaan Barang</label>
											 <input type="text" name="" placeholder="Tambah Laporan Proyek" autocomplete="off" readonly class="form-control" required value=" <?php 
                                                   $persentasi=round($row->proses/$row->progres * 100,2); 
                                                   echo "$persentasi% Dari" . " ".$row->progres." "."Permintaan Barang";
                                                 ?>" >
									</div>

                                    <div class="form-group col-12">
                                        <button type="submit"  class="btn btn-success"><i class="fa fa-history"></i>&nbsp;&nbsp;Proses </button>
                                    </div>

                                </div>
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                             <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

                        </div>
        </div></form>
  

    </div>
  </div>
</div>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
<!-- modal update -->
 

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