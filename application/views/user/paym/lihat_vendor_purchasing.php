<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
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
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
	
 						<a  data-toggle="modal" style="color:white" data-target="#izin_tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
			
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
              
					<div class="card-header"><strong>LIST VENDOR <?php foreach ($hd_api as $key => $vn) : ?>
                    <?php   $token = $vn->akses_token;
                            $session = $vn->session_api; ?>
                     <?php  endforeach; ?></strong></div>


					       <div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th width="5">No</th>
                                    <th width="100">ID Pemasok</th>
                                    <th >Nama Vendor</th>  
                                    <th >Tlp Bisnis</th>
                                    <th >Pemilik Rekening</th>  
                                    <th >No Rekening</th>    
                                    <th width="100" align="center">Aksi</th>     
                                </tr>
                            </thead>
								  <tbody>                                                        
                                <?php foreach ($vendor as $key => $vn) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $vn->ID_Pemasok ?></td>
                                        <td><?php echo $vn->Nama ?></td>
                                        <td><?php echo $vn->No_Telp_Bisnis  ?></td>
                                        <td><?php echo $vn->atas_nama_bank ?></td>
                                        <td><?php echo $vn->norek_vendor  ?></td>
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#person_adm<?php echo $vn->No ; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
										
									<!--	<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/payment/hapus_vendor/' . $vn->ID_Pemasok) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> --></td>                                       
                                    </tr>
<!-- modal update -->
	
<div id="person_adm<?php echo $vn->No ; ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">UPDATE DATA VENDOR <?php echo $vn->ID_Pemasok ?></h4>
        </div>
<form action="<?= base_url('user/payment/proses_update_vendor_purchasing') ?>" id="form-tambah" method="POST">
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
                                            <label for="nama_barang"><strong>Nama Vendor </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="nama_vendor" placeholder="Masukkan Nama Vendor" autocomplete="off" value="<?= $vn->Nama ?>"  class="form-control" required>
                                </div>
                                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Email</strong></label>
                                             <input  type="text"  name="Email" placeholder="email"  autocomplete="off" value="<?= $vn->Email ?>"  class="form-control" >
                                </div>
                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Tlp Bisnis</strong></label>
                                             <input  type="text"  name="No_Telp_Bisnis" placeholder="No Tlp Bisnis"  autocomplete="off" value="<?= $vn->No_Telp_Bisnis ?>"  class="form-control" >
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Hanphone </strong></label>
                                             <input  type="text"  name="Handphone" placeholder="No Hanphone"  autocomplete="off" value="<?= $vn->Handphone ?>"  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Rekening</strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="norek_vendor" placeholder="Masukkan No Rekening" autocomplete="off" value="<?= $vn->norek_vendor ?>"  class="form-control" >
                                </div>
                               <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Bank</strong></label>
                                             <input  type="text" maxlength="50" name="nama_bank_vendor" placeholder="Nama Bank" autocomplete="off" value="<?= $vn->nama_bank_vendor ?>"  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Pemilik Rekening</strong></label>
                                             <input  type="text" maxlength="50" name="atas_nama_bank" placeholder="Nama Pemilik Rekening" autocomplete="off" value="<?= $vn->atas_nama_bank ?>"  class="form-control" >
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Alamat Pembayaran </strong></label>
                                          <textarea class="form-control" name="Alamat_Pembayaran"><?= $vn->Alamat_Pembayaran ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kota</strong></label>
                                             <input  type="text" maxlength="50" name="Kota" placeholder="Kota" autocomplete="off" value="<?= $vn->Kota ?>"  class="form-control" >
                                </div>
  <input hidden type="text" maxlength="50" name="id_ven" placeholder="Masukkan No Rekening" autocomplete="off" value="<?= $vn->ID_Pemasok ?>"  class="form-control">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->
                                    <?php  endforeach; ?>
                                                           
                        </tbody>
							</table>
						</div>      </div> 

     
							
				</div>
				</div>
			</div>
<!-- modal update -->
	  
<div id="izin_tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">TAMBAH VENDOR </h4>
        </div>
<form action="<?= base_url('user/payment/proses_simpan_vendor_1') ?>" id="from1" name="form" method="POST">
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
                                            <label for="nama_barang"><strong>Tipe Vendor </strong></label>
                                            <select id="" name="categoryName" class="form-control" required>
                                                <option value="SUPPLIER">SUPPLIER</option>
                                                <option value="SUBCON" >SUBCON</option>
                                                
                                             <!--  <option value="SPK CSA">SPK CSA</option>
                                                <option value="SPK MSA">SPK MSA</option> -->
                                            </select>

                                </div>
<?php $txt = sprintf("%05s", $generate_kode_supplier);
//$kodeTransaksi_po = 'PO.'.date('Y').'.'.date('m').'.'.$txt;
$generate_kode_supplier1 = 'V.'.$txt;
?>

                                <div class="form-group col-12" >
                                    <label>No. Vendor</label>  
                                    <input type="text"   name="vendorNo" value="<?= $generate_kode_supplier1 ?>"  class="form-control">
                                    <!--    <input type="text" readonly  name="typeAutoNumber" value="16"  class="form-control" hidden> -->
                                </div>
 
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Vendor </strong></label>
                                             <input  type="text"  name="name" placeholder="Masukkan Nama Vendor"  autocomplete="off" value=""  class="form-control" required>
                                            <input  type="text" hidden name="transDate" placeholder="Masukkan transDate"  autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                echo date('d/m/Y');
                                             ?>"  class="form-control" required>
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atas Nama </strong></label>
                                             <input  type="text"  name="atas_nama_bank" placeholder="Atas Nama"  autocomplete="off" value=""  class="form-control">
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Bank </strong></label>
                                             <input  type="text"  name="nama_bank_vendor" placeholder="Nama Bank"  autocomplete="off" value=""  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Rekening </strong></label>
                                             <input  type="text"  name="norek_vendor" placeholder="Masukkan No Rekening"  autocomplete="off" value=""  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Email </strong></label>
                                             <input  type="text"  name="email" placeholder="Masukkan Nama Kota"  autocomplete="off" value=""  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Tlp Bisnis </strong></label>
                                             <input  type="text"  name="workPhone" placeholder="Masukkan Nama Kota"  autocomplete="off" value=""  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Handphone </strong></label>
                                             <input  type="text"  name="mobilePhone" placeholder="Masukkan Nama Kota"  autocomplete="off" value=""  class="form-control" >
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Alamat Pembayaran </strong></label>
                                            <textarea class="form-control" name="billStreet"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kota </strong></label>
                                             <input  type="text"  name="billCity" placeholder="Masukkan Nama Kota"  autocomplete="off" value=""  class="form-control" >
                                </div>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->

                                    <script>
                                        document.querySelector('#from1').addEventListener('submit', function(e) { 
                                            var form = this;
                                            var input = $('#from1').serialize();
                                            e.preventDefault();

                                            swal({
                                                title: "Are you sure?",
                                                text: "Data Pemasok Akan Diintegrasikan dengan Accurate",
                                                icon: "warning",
                                                buttons: [
                                                    'No, cancel it!',
                                                    'Yes, I am sure!'
                                                    ],
                                                dangerMode: true,
                                            }).then(function(isConfirm) {
                                                if (isConfirm) {
                                                    swal({
                                                        title: 'Success!',
                                                        text: 'Data Pemasok Berhasil Diintegrasikan Dengan Accurate, Sukses!',
                                                        icon: 'success'

                                                    }).then(function() {
                                                        $.ajax({ 
                                                            type: 'POST',
                                                            url: 'https://public.accurate.id/accurate/api/vendor/save.do?access_token=<?= $token;?>&session=<?= $session;?>',
                                                            data: JSON.stringify(input),
                                                            mode: 'no-cors',
                                                            dataType : 'JSON',
                      //    contentType: 'application/json; charset=utf-8',
                                                            success:function(data){
                                                                console.log(data)
                                                            }

                                                        })

                                                    }).then(function(data) {
                                                        window.setTimeout(function() { document.form.submit(); }, 2000);        
                                                    })
                                                }  else {
                                                    swal("Cancelled", "Data Pemasok tidak ada perubahan :)", "error");
                                                }
                                            });
                                        });


                                    </script> <!-- selesai modal asset -->
			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>