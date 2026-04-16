<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<script src="<?= base_url('sb-admin') ?>/js/jquery-3.1.0.js"></script> 
 <script>
    $(document).ready(function() {
        $('#dataable').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [10, 25, 50, 75, 10]
        });        
    });
  </script> 
</head>
<?php error_reporting(0);  ?>
<body id="page-top">


	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('asst') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				
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
				<div class="row">


				</div>
 <!--               <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>Filter Tanggal Transaksi Diproses</strong></div>
                            <div class="card-body">
                                <form action="<?= base_url('pembelian/laporan_01/') ?>" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
  
<?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
     $page = end($link_array);
?>                   
                                    <div class="form-group col-md-4">
                                            <label for="department"><strong>Pilih Proyek</strong></label>
                                  <select name="project" class="form-control" required>
                            <option value="">PILIH ...</option>
                                    <?php foreach ($proyek as $prk) : ?>
                                    <option value="<?php echo $prk->projectNo ?>"<?php
                            if (!empty($page)) {
                                echo $page == $prk->projectNo ? 'selected' : '';
                            }
                            ?>
                                  ><?php echo $prk->project_name ?></option>
                                    <?php endforeach; ?>
                            </select>
                                        </div> 
                                    <div class="form-group col-md-2">
                                            <label for="department"><strong> &nbsp;</strong></label>

                                        <button type="submit" class="btn btn-primary form-control" ><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                                        </div>
 
 <div class="form-group col-md-4">
    <label for="department"><strong> &nbsp;</strong></label>
<?php if (!empty ($_POST['project'])): ?>                     
  <button type="button" class="btn btn-info dropdown-toggle form-control" data-toggle="dropdown"><i class="fas fa-print"></i>&nbsp;&nbsp;
   Laporan 
  </button>
  <div class="dropdown-menu">
 <!--<a class="dropdown-item" href="<?php echo $url_cetak; ?>"><i class="fa fa-file-pdf" style="color:red;"></i>&nbsp;&nbsp;Export Pdf</a>  
    <a class="dropdown-item" href="<?php echo $url_cetak_excel; ?>"><i class="fa fa-file-excel-o" style="color:green;"></i>&nbsp;&nbsp;Export Excel </a>
  </div><?php endif ?>

</div>
</div>

 

                                </form>
                            </div>              
                        </div>
                    </div>
                </div><hr>-->
				<div class="card shadow">
					<div class="card-header">
						<div class="float-right"> 
<?php if (!empty ($all_pr)): ?> 
     <a class="btn btn-success btn-sm" href="<?php echo $url_cetak_excel; ?>"><i class="fa fa-file-excel-o" style="color:green;"></i>&nbsp;&nbsp;Export Excel </a>
 <?php endif ?>
					</div> <a href="#"><font color="blue"><strong><?= $title ?>
                </strong></font></a>

            </div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td bgcolor="#DAE3E4" width="10">No</td>
										<td bgcolor="#DAE3E4" width="10">Tgl</td>
										<td bgcolor="#DAE3E4" width="100">No Pesanan</td>
                                        <td bgcolor="#DAE3E4">Project</td>
										<td bgcolor="#DAE3E4" width="200">Pemasok</td>
                                        <td bgcolor="#DAE3E4" width="10">Disc</td>
                                        <td bgcolor="#DAE3E4" width="10">Pajak</td>
										<td bgcolor="#DAE3E4">Total</td>
                                        <td bgcolor="#DAE3E4" width="50">Detail</td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pr as $mdl): ?>
										<tr>
											<td width="3"><?= $no++ ?></td>
											<td width="100"><?php echo date('Y-m-d', strtotime($mdl->shipDate)); ?></td>
											<td><?= $mdl->number_ ?></td>
											<td><?= $mdl->nama_project ?>
											</td> 
											<td><?= $mdl->vendorNo ?>
                                            <td><?php if ($mdl->cashDiscount != 0):?>
                                            <span class="badge badge-warning">YES</span>
                                        <?php endif;?>
                                        <?php if ($mdl->cashDiscount == 0):?>
                                            <span class="badge badge-info">NO </span>
                                        <?php endif;?>
                                    </td>
                                            <td><?php if ($mdl->taxable == 'true'):?>
                                                        <span class="badge badge-warning">YES</span>
                                                    <?php endif;?>
                                                    <?php if ($mdl->taxable == 'false'):?>
                                                        <span class="badge badge-info">NO </span>
                                                        <?php endif;?>
											</td>
											<td align="left">
                                        <?php if ($mdl->taxable == 'true'):?>
                                        <?php
                                            $diskon = $mdl->total_harga_p - $mdl->cashDiscount;
                                            $hasil_pajak = $diskon * 11/100 ;
                                            $hasil_pajak1 = $diskon + $hasil_pajak ;
                                            $hasil_rupiah = 'Rp '. number_format($hasil_pajak1,0,',','.');
                                            echo $hasil_rupiah; 
                                        ?>
                                         <?php endif;?>
                                        <?php if ($mdl->taxable == 'false'):?>
                                        <?php
                                            $diskon = $mdl->total_harga_np - $mdl->cashDiscount;
                                            $hasil_rupiah = 'Rp '. number_format($diskon,0,',','.');
                                            echo $hasil_rupiah; 
                                        ?>           
                                        <?php endif;?></td> 
											<td><a class="btn btn-success btn-sm" target="_blank" href="<?= base_url('pembelian/detail_po_dt_penerimaan/'.$mdl->id ) ?>"><i class="fa fa-eye"></i> Detail</a></td>
										</tr>

									<?php endforeach ?>
								</tbody>
        <?php foreach ($grand_total as $row): ?>

            <tr>
                <td colspan="7" align="right"> <b>Grand Total </b></td>

                <td colspan="4">  <b>
                    <?php

                    $hasil = "Rp " . number_format($row->harga_total,0,',','.');
                    echo $hasil; ?>
                </b></td>                                
            </tr>

                <?php endforeach ?>
							</table>
					</div>				
				</div>

				</div>
                            <hr>
       <!--     <?php if(!empty($isi)):?>
            <div class="card shadow">
                    <div class="card-header">
                    <font color="blue"><strong>Read Me !</strong></font></div>

                    <div class="card-body">
                        <?php foreach ($isi as $isi): ?>
                            <?= $isi->isi_sop ?>
                        <?php endforeach ?>
                    </div>
            </div>
            <?php endif; ?> -->
			</div>
			<!-- load footer -->
 
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	            <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>