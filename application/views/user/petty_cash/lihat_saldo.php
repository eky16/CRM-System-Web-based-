<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
	<script src="<?= base_url('sb-admin') ?>/js/jquery-3.1.0.js"></script> 
 <script>
    $(document).ready(function() {
        $('#dataable').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [10, 25, 50, 75, 10]
        });        
    });
  </script> 

   <script>
    $(document).ready(function() {
        $('#dataable_topup').dataTable({
        
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
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('asst') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

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
					                   <div class="col-xl-12 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="h6 mb-0  font-weight-bold text-success text-uppercase mb-1"> <a  href="#"> <?= $title ?></a></div>
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"> <?php if(!empty($petty_cash->saldo)): ?>
					  	<?php $hasil_rupiah = "Rp " . number_format($petty_cash->saldo,2,',','.');
                        echo $hasil_rupiah; ?><?php else: ?>
                        <?php $hasil_rupiah = "Rp " . number_format('0',2,',','.');
                        echo $hasil_rupiah; ?>	
                        <?php endif;?></div>
                                </div>
                                <div class="col-auto">
                                <a href="#">   <i class="fa fa-money fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
				</div>
				<div class="card shadow">
					<div class="card-header">
						<div class="float-right"> 
				<a  data-toggle="modal" style="color:white" data-target="#right_modal_out" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Transaksi</a>
				<a  data-toggle="modal" style="color:white" data-target="#right_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Isi Ulang Saldo</a>

					</div><font color="blue"><strong>Riwayat Saldo</strong></font>  / <a  href="<?php echo base_url(); ?>user/petty_cash/riwayat"><strong>Semua Riwayat</strong></a></div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataable_topup" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td bgcolor="#DAE3E4">No</td>
										<td bgcolor="#DAE3E4">Creat_at</td>
										<td bgcolor="#DAE3E4">Kode</td>
										<td bgcolor="#DAE3E4">Saldo Sebelum</td>
										<td bgcolor="#DAE3E4">Nominal Transaksi</td>
										<td bgcolor="#DAE3E4">Status</td>
										<td bgcolor="#DAE3E4">Tanggal</td>

										
									</tr>
								</thead>
								<tbody>
									<?php
									   $no = 1;
									    foreach ($petty_cash_top_up as $mdl): ?>
										<tr>
											<td width="3"><?= $no++ ?></td>
											<td width="150"><?php echo date('Y-m-d H:i:s', strtotime($mdl->tgl_log_petty_cash)); ?></td>
											
										<td width="100"><?= $mdl->kode_topup ?></td> 
											<td>
												<?php $hasil_rupiah = "Rp " . number_format($mdl->saldo_before,2,',','.');
                        						echo $hasil_rupiah; ?>
											</td>
											<td>
												<?php $hasil_rupiah = "Rp " . number_format($mdl->nominal_petty_cash,2,',','.');
                        						echo $hasil_rupiah; ?>
											</td> 
											<td><?= $mdl->jenis_pety_cash ?></td> 
											<td width="100"><?php echo date('Y-m-d', strtotime($mdl->tgl_transaksi_petty)); ?></td>
									
											
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>

						</div>
					</div>	


				</div>            <hr>
            <?php if(!empty($isi)):?>
            <div class="card shadow">
                    <div class="card-header">
                    <font color="blue"><strong>Read Me !</strong></font></div>

                    <div class="card-body">
                        <?php foreach ($isi as $isi): ?>
                            <?= $isi->isi_sop ?>
                        <?php endforeach ?>
                    </div>
            </div>
            <?php endif; ?>
				</div>
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
<form action="<?= base_url('user/petty_cash/save_topup') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_transaksi_petty" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                </div>
                                                    <div class="form-group col-md-12">
                                            <label for="department"><strong>Kode Isi ulang</strong></label>
                                            <input type="text" name="kode_topup" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php  
                                            $code =  random_string('numeric', 5);
                                            echo 'TP'.''.$code ?>"  class="form-control" required>
                                        </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal Top Up </label>
                                             <input  type="text" onkeypress="return hanyaAngka(event)" maxlength="50" onkeyup="sum();" id="nominal_topup"  name="nominal_petty_cash" placeholder="Nominal Top Up" autocomplete="off" value=""  class="form-control">

                                          <?php if(!empty($petty_cash->saldo)):?>
                                              <input  type="text" maxlength="50" hidden id="saldo_sekarang"  name="saldo_before" placeholder="Nominal Top Up" autocomplete="off" value="<?= $petty_cash->saldo ?>"  class="form-control">
                                          <?php else:?>
 											  <input  type="text" maxlength="50" hidden id="saldo_sekarang"  name="saldo_before" placeholder="Nominal Top Up" autocomplete="off" value="0"  class="form-control">
 										  <?php endif;?>

                                              <input  type="text" maxlength="50" hidden id="hasilnya"  name="hasil_topup" placeholder="Nominal Top Up" autocomplete="off" value=""  class="form-control">

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

<div  class="modal modal-right fade" id="right_modal_out" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">TRANSAKSI PETTY CASH</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/petty_cash/save_transaksi_pety') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_transaksi_petty" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                </div>
                                                    <div class="form-group col-md-12">
                                            <label for="department"><strong>Kode Transaksi</strong></label>
                                            <input type="text" name="kode_topup" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php  
                                            $code =  random_string('numeric', 5);
                                            echo 'TRF'.''.$code ?>"  class="form-control" required>
                                        </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal Transaksi </label>
                                             <input  type="text" onkeypress="return hanyaAngka(event)" maxlength="50" onkeyup="sum2();" id="nominal_transaksi"  name="nominal_petty_cash" placeholder="Nominal Transaksi" autocomplete="off" value=""  class="form-control">

                                          <?php if(!empty($petty_cash->saldo)):?>
                                              <input  type="text" maxlength="50" hidden id="saldo_sekarang1"  name="saldo_before" placeholder="Nominal Top Up" autocomplete="off" value="<?= $petty_cash->saldo ?>"  class="form-control">
                                          <?php else:?>
 											  <input  type="text" maxlength="50" hidden id="saldo_sekarang1"  name="saldo_before" placeholder="Nominal Top Up" autocomplete="off" value="0"  class="form-control">
 										  <?php endif;?>

                                              <input  type="text" maxlength="50" hidden id="hasilnya1"  name="hasil_topup" placeholder="Nominal Top Up" autocomplete="off" value=""  class="form-control">

                                              <input  type="text" maxlength="50"  hidden name="jenis_pety_cash" placeholder="" autocomplete="off" value="Top Up"  class="form-control">

                                              <input  type="text" maxlength="50"  hidden name="jenis" placeholder="" autocomplete="off" value="Petty Cash"  class="form-control">
                                </div>
<script>

function sum2() {

        var nominal_transaksi = document.getElementById('nominal_transaksi').value;
        var saldo_sekarang1 = document.getElementById('saldo_sekarang1').value;
        var hasilnya1 = parseInt(saldo_sekarang1)  - parseInt(nominal_transaksi);

       // var hasilkm = document.getElementById('hasilnya').value;
        if (!isNaN(hasilnya1)) {
         document.getElementById('hasilnya1').value = hasilnya1;
      }


}
</script> 
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>keterangan</strong></label>
                                           <textarea class="form-control" name="ket_saldo_keluar"></textarea>
                                        </div>
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
			<?php $this->load->view('user/partials/footer.php') ?>
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
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>