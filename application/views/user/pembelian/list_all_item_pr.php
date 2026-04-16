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
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
				
                            <a href="<?= base_url('user/pembelian/tambah') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
					
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
					<div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/finish_"> Cetak Laporan</a></font></strong></div>
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

<div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <form action="" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                        <div class="form-group col-md-4">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd "  name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd s"  name="dan_tanggal" value="<?php echo $_POST['dan_tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="department"><strong> &nbsp;</strong></label>
                        <select name="jenis_tanggal" class="form-control" required>
                            <option value="">PILIH ...</option>

                            <option value="transDate" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'transDate' ? 'selected' : '';
                            }
                            ?>>Tanggal Pesan</option>

                            <option value="tanggal_kirim" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tanggal_kirim' ? 'selected' : '';
                            }
                            ?>>Tanggal Kirim</option>
  

                            <option value="Semua Data" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'Semua Data' ? 'selected' : '';
                            }
                            ?>>Semua Data</option>
                            </select>
                                        </div>
                                   <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>


                                    </div>
                                    </div> 
                                </form>
                            </div>              
                        </div>
                    </div>
                </div><hr>

<div class="card-header">
                        <div class="float-right"> 
         <?php if ($title == "Kemajuan Pesanan Sales Order") :?>   
                   <a href="<?= base_url('user/wo/export_excel_permintaan_diproses') ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Export Excel</a> 
                <?php endif; ?>

                   <?php if ($title == "List Permintaan Barang") :?>       
                    </div><font color="blue"><strong>List Sales Order</strong></font>  / <a  href="<?php echo base_url(); ?>user/wo/list_permintaan_item"><strong>Item Sales Order</strong></a>/ <a  href="<?php echo base_url(); ?>user/wo/list_history_permintaan"><strong>Riwayat Sales Order</strong></a></div>
                    <?php endif; ?>

                    <?php if ($title == "Kemajuan Pesanan Sales Order") :?>       
                    </div><a  href="<?php echo base_url(); ?>user/wo/list_permintaan"><strong>List Sales Order</strong></a>  / <a  href="<?php echo base_url(); ?>user/wo/proses_permintaan_barang"><strong>Permintaan Diproses</strong></a> / <font color="blue"><strong>Kemajuan Pesanan Sales Order</strong></font>/ <a  href="<?php echo base_url(); ?>user/wo/list_history_permintaan"><strong>Riwayat Sales Order</strong></a></div>
      
                     <?php endif; ?>
                       <?php if ($title == "Riwayat Permintaan Barang") :?> 
                    </div><a  href="<?php echo base_url(); ?>user/wo/list_permintaan"><strong> List Sales Order</strong></a> / <font color="blue"><strong>Riwayat Sales Order</strong></font></div>
                     <?php endif; ?>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px"><strong>No</strong></font></td>
										<td width="50"><font size="2px"><strong>ID</strong></font></td>
										<td width="50"><font size="2px"><strong>Tgl Pesan</strong></font></td>
                                        <td width="50"><font size="2px"><strong>Tgl Kirim</strong></font></td>
										<td width="150"><font size="2px"><strong>Customer</strong></font></td>
                                        <td ><font size="2px"><strong>Nama Barang</strong></font></td>
                                        <td width="50"><font size="2px"><strong>Jumlah</strong></font></td>
                                        <td width="50"><font size="2px"><strong>Sales</strong></font></td>
                                        <td width="50"><font size="2px"><strong>Status</strong></font></td>
										<td width="50"><font size="2px"><strong>Aksi</strong></font></td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pr as $row): ?>
										<tr>
											<td><font size="1px"><?= $no++ ?></font></td>
											<td><font size="2px"><?= $row->number_pr ?></font>
                                            </td>
											<td ><font size="2px"><?= $row->transDate ?></font></td>
                                            <td ><font size="2px"><?= $row->tanggal_kirim ?></font></td>
											<td><font size="2px"><?= $row->nama_cst ?></font></td>
                                            <td align="left"><font size="2px"><?= $row->detailName ?>
                                          </td>
                                            <td align="center"><font size="2px"><?= $row->itemUnitName ?> - <?= $row->quantity ?>
                                            </font></td>
                                            <td><font size="2px"><?= $row->nama_sales ?></font></td>
                                            <td align="center">  <?php $status_pr = $row->status_qr  ?>
                                                <?php if ($status_pr == "Subcon" and $row->number_po != ""):?>
                                                    <span class="badge badge-primary"> Subcon </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Stok" and $row->number_po != ""):?>
                                                    <span class="badge badge-primary"> Stok </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Forecast" and $row->number_po != ""):?>
                                                    <span class="badge badge-primary"> Forecast </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Produksi" and $row->number_po != ""):?>
                                                    <span class="badge badge-warning"> Menunggu Produksi </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Cutting"):?>
                                                    <span class="badge badge-info"> CUTTING </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Punching"):?>
                                                    <span class="badge badge-info">PUNCHING </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Bending"):?>
                                                    <span class="badge badge-info">BENDING </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Welding"):?>
                                                    <span class="badge badge-info">WELDING </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "PS"):?>
                                                    <span class="badge badge-info">PS </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "FA"):?>
                                                    <span class="badge badge-info">FA </span>
                                                <?php endif;?>
                                                <?php if ($status_pr == "Packing"):?>
                                                    <span class="badge badge-info">PACKING </span>
                                                    <?php endif;?>
                                                    <?php if ($status_pr == "WH FG"):?>
                                                    <span class="badge badge-primary">WH FG </span>
                                                    <?php endif;?>
                                                    <?php if ($status_pr == "Selesai"):?>
                                                    <span class="badge badge-success">SELESAI </span>
                                                    <?php endif;?>
                                                    <?php if ($status_pr == "Batal"):?>
                                                    <span class="badge badge-dark">BATAL </span>
                                                    <?php endif;?>
                          <!-- jika barang Ready DAN tanggal kirim kosong tampilkan status Ready -->
                          <?php if ($status_pr == "Ready" and $row->tanggal_kirim == ""):?>
                          <span class="badge badge-primary">Ready </span>
                          <?php endif;?> 
                          <!-- jika barang Ready DAN tanggal kirim tidak kosong tampilkan status Siap Dikirim -->
                          <?php if ($status_pr == "Ready" and $row->tanggal_kirim != ""):?>
                          <span class="badge badge-primary">Siap Dikirim </span>
                          <?php endif;?>   </td>
											<td><font size="2px">
                                                    <a  target="blank" href="<?= base_url('user/pembelian/detail_pr/' . $row->id ) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a></font>
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
<form action="<?= base_url('user/pembelian/move_pr') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
											<label>Progres Pemesanan Barang</label>
											 <input type="text" name="" placeholder="Tambah Laporan Proyek" autocomplete="off" readonly class="form-control" required value=" <?php 
                                                   $persentasi=round($row->proses/$row->progres * 100,2); 
                                                   echo "$persentasi% Dari" . " ".$row->progres." "."Pesanan Pembelian";
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
			<?php $this->load->view('user/partials/footer.php') ?>
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