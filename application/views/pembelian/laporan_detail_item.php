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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>Filter Tanggal Transaksi Diproses</strong></div>
                            <div class="card-body">
                                <form action="" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                    <!--    <div class="form-group col-md-4">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd H:i:s"  name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd H:i:s"  name="dan_tanggal" value="<?php echo $_POST['dan_tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div> -->
                                    <div class="form-group col-md-4">
                                            <label for="department"><strong>Pilih Proyek</strong></label>
                                  <select name="project" class="form-control" required>
                            <option value="">PILIH ...</option>
                                    <?php foreach ($proyek as $prk) : ?>
                                    <option value="<?php echo $prk->projectNo ?>"<?php
                            if (!empty($_POST['project'])) {
                                echo $_POST['project'] == $prk->projectNo ? 'selected' : '';
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
 <!--<a class="dropdown-item" href="<?php echo $url_cetak; ?>"><i class="fa fa-file-pdf" style="color:red;"></i>&nbsp;&nbsp;Export Pdf</a>  -->
    <a class="dropdown-item" href="<?php echo $url_cetak_excel; ?>"><i class="fa fa-file-excel-o" style="color:green;"></i>&nbsp;&nbsp;Export Excel </a>
  </div><?php endif ?>

</div>
</div>

 

                                </form>
                            </div>              
                        </div>
                    </div>
                </div><hr>
				<div class="card shadow">
					<div class="card-header">
						<div class="float-right"> 
 <a  data-toggle="modal" style="color:white" data-target="#readme" class="btn btn-danger btn-sm"><i class="fa fa-book"></i>&nbsp;&nbsp;Read Me !!!</a>
					</div> <a href="<?php echo base_url(); ?>pembelian/laporan_01"><font color=""><strong>Laporan I</strong></font></a> /  <font color="blue"><strong>Laporan II</strong></font> /   <a href="<?php echo base_url(); ?>pembelian/laporan_detail_item_bydate"><font color=""><strong>Laporan III</strong></font></a></div>
<div id="readme" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">PENJELASAN LAPORAN</h4>
        </div>
 <form method="post" action="<?= base_url('mod_kerja/save_berkas_user') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
<!-- start isi -->
<p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Laporan II ( Laporan Detail Pembelian dengan filter Proyek  )  </span></strong></p>

<!-- end isi -->
                                </div>
                                    <hr>
                                </div>
                            </div>

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- end modal -->
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
									   <td bgcolor="#DAE3E4" width="10">No</td>
                                        <td bgcolor="#DAE3E4" width="10">Tgl</td>
                                        <td bgcolor="#DAE3E4" width="80">No Pesanan</td>
                                        <td bgcolor="#DAE3E4" width="300">Nama Barang</td>
                                        <td bgcolor="#DAE3E4" width="10">Qty</td>
                                        <td bgcolor="#DAE3E4" width="5">Harga</td>
                                        <td bgcolor="#DAE3E4">Harga Total</td>
                                        <td bgcolor="#DAE3E4" width="50">Detail</td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pr as $mdl): ?>
										<tr>
											<td width="3"><?= $no++ ?></td>
											<td width="100"><?php echo date('Y-m-d', strtotime($mdl->shipDate)); ?></td>
											<td><?= $mdl->number_ ?></td>
											<td><?= $mdl->detailName ?></td>
                                            <td><?= $mdl->quantity ?> - <?= $mdl->itemUnitName ?></td>
                                            <td><?php
                                             $hasil_rupiah = number_format($mdl->unitPrice,0,',','.');
                                              echo $hasil_rupiah; ?></td>
                                            <td align="left"><?php
                                             $hasil_rupiah2 = number_format($mdl->total_harga,0,',','.');
                                              echo $hasil_rupiah2; ?></td>
											<td><a class="btn btn-success btn-sm" target="_blank" href="<?= base_url('pembelian/detail_po_dt_penerimaan/'.$mdl->id ) ?>"><i class="fa fa-eye"></i> Detail</a></td>
										</tr>

									<?php endforeach ?>
								</tbody>
        <?php foreach ($grand_total as $row): ?>


                                    <tr>
                                        <td colspan="6" align="right"> <b>Grand Total</b></td>

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
 
<div  class="modal modal-right fade" id="right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">TOP UP PETTY CASH</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('petty_cash/save_topup') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal Top Up </label>
                                             <input  type="text" onkeypress="return hanyaAngka(event)" maxlength="50" onkeyup="sum();" id="nominal_topup"  name="nominal_petty_cash" placeholder="Nominal Top Up" autocomplete="off" value=""  class="form-control">

                                              <input  type="text" maxlength="50" id="saldo_sekarang" hidden name="saldo_before" placeholder="Nominal Top Up" autocomplete="off" value="<?= $petty_cash->saldo ?>"  class="form-control">

                                              <input  type="text" maxlength="50" id="hasilnya" hidden name="hasil_topup" placeholder="Nominal Top Up" autocomplete="off" value=""  class="form-control">

                                              <input  type="text" maxlength="50"  hidden name="jenis_pety_cash" placeholder="Nominal Top Up" autocomplete="off" value="Top Up"  class="form-control">

                                              <input  type="text" maxlength="50"  hidden name="jenis" placeholder="Nominal Top Up" autocomplete="off" value="Petty Cash"  class="form-control">
                                </div>
<script>
const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number);
  }
function sum() {

        var nominal_topup = document.getElementById('nominal_topup').value;
        var saldo_sekarang = document.getElementById('saldo_sekarang').value;
        var hasilnya = parseInt(nominal_topup)  + parseInt(saldo_sekarang);

       // var hasilkm = document.getElementById('hasilnya').value;
        if (!isNaN(hasilnya)) {
         document.getElementById('hasilnya').value = hasilnya;
      }


}
</script> 

                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tambah Laporan Proyek" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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