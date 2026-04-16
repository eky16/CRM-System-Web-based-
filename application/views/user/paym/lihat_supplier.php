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
					<div class="card-header"><strong>LIST SUPPLIER </strong></div>


					       <div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th >Nama Toko</th>   
                                    <th >No Rekening</th> 
                                    <th >Atas Nama</th> 
                                    <th class="col-sm-2" align="center">Aksi</th>     
                                </tr>
                            </thead>
								  <tbody>                                                        
                                <?php foreach ($supplier as $key => $vn) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $vn->supp_name ?></td>
                                        <td><?php echo $vn->supp_norek  ?></td>
                                        <td><?php echo $vn->supp_rekname  ?></td>
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#person_adm<?php echo $vn->id_supp; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
										
										<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/payment/hapus_supplier/' . $vn->id_supp) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                                       
                                    </tr>
<!-- modal update -->
	
<div id="person_adm<?php echo $vn->id_supp; ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">UPDATE DATA SUPPLIER</h4>
        </div>
<form action="<?= base_url('user/payment/proses_update_supplier') ?>" id="form-tambah" method="POST">
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
                                            <label for="nama_barang"><strong>Nama Toko </strong></label>
                                             <input  type="text"  name="supp_name" placeholder="Masukkan Nama Vendor"  autocomplete="off" value="<?php echo $vn->supp_name; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Rekening </strong></label>
                                             <input  type="text"  name="supp_norek" placeholder="Masukkan Nama Vendor"  autocomplete="off" value="<?php echo $vn->supp_norek; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atas Nama </strong></label>
                                             <input  type="text"  name="supp_rekname" placeholder="Masukkan No Rekening"  autocomplete="off" value="<?php echo $vn->supp_rekname; ?>"  class="form-control">
                                </div>
  <input hidden type="text" maxlength="50" name="id_supp" placeholder="Masukkan No Rekening" autocomplete="off" value="<?= $vn->id_supp ?>"  class="form-control">
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
        
          <h4 class="modal-title">TAMBAH SUPPLIER</h4>
        </div>
<form action="<?= base_url('user/payment/proses_simpan_supplier') ?>" id="form-tambah" method="POST">
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
                                            <label for="nama_barang"><strong>Nama Toko </strong></label>
                                             <input  type="text"  name="supp_name" placeholder="Masukkan Nama Vendor"  autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>No Rekening </strong></label>
                                             <input  type="text"  name="supp_norek" placeholder="Masukkan Nama Vendor"  autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atas Nama </strong></label>
                                             <input  type="text"  name="supp_rekname" placeholder="Masukkan No Rekening"  autocomplete="off" value=""  class="form-control">
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