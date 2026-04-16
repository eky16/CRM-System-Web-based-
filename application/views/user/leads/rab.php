<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		
		
 
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
					<div class="card-header"><strong>Proyek - <?= $leads->nama_project ?></strong>			<div class="float-right">
							<a href="<?= base_url('user/dashboard') ?>" class="btn btn-primary btn-sm"><i class="fa fa-home"></i> Dashboard</a> 
							<a href="<?= base_url('user/leads/detail/'.$leads->id_lsp) ?>" class="btn btn-info btn-sm"><i class="fa fa-user"></i> Profil Proyek</a>
							<a  data-toggle="modal" style="color:white" data-target="#right_modalnew" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah List</a>
							<a href="<?= base_url('user/leads/upload_bq') ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Upload</a>
						</div>
				</div>
	
	          <?php  foreach ($all_subrab_info as $akey => $v_subrab_info) : ?>                                
            

					<div class="card-header"><strong><?php echo $all_rab_info[$akey]->nama_rab; ?> 
	
                          </strong>
					 </div>
					
						<div class="table-responsive">
							<table class="table table-bordered"  width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th ><font size="2 px">No</font></th>
                                    <th ><font size="2 px">ID</font></th>
                                    <th> <font size="2 px">Description</font></th>  
                                    <th ><font size="2 px">Spesification</font></th>
                                    <th ><font size="2 px">Qty</font></th> 
                                    <th ><font size="2 px">Unit</font></th> 
                                    <th ><font size="2 px">Unit Price(RAB)</font></th> 
                                    <th ><font size="2 px">Total (RAB)</font></th> 
                                    <th ><font size="2 px">Unit Price(RAP)</font></th>
                                    <th ><font size="2 px">Total (RAP)</font></th>
                                 <!--   <th ><font size="2 px">Action</font></th> -->                                            
                                </tr>
                            </thead>
								  <tbody>                                                        
                                <?php foreach ($v_subrab_info as $key => $v_rab) : ?>

                                    <tr>
                                        <td width="1"><font size="2 px"><?php echo $key + 1 ?></font></td>
                                         <td width="1"><font size="2 px"><?php echo $v_rab->no_rap ?></font></td>
                                        <td width="250"><font size="2 px"><?php echo $v_rab->deskripsi_rap ?></font></td>
                                        <td width="200"><font size="2 px"><?php echo $v_rab->spesifikasi_rap ?></font></td>
                                        <td width="10"><font size="2 px"><?php echo $v_rab->jumlah_rap ?></font></td>
                                        <td width="10"><font size="2 px"><?php echo $v_rab->satuan_rap ?></font></td>
                                        <td width="50"><font size="2 px"> 
                                                    <?php
                                                 $harga_rab = "Rp" . number_format($v_rab->harga_rab,0,',','.');
                                                  echo $harga_rab; ?>
                                                  </font></td>
                                        <td width="50"><font size="2 px">
                                        	 <?php
                                                 $total = "Rp" . number_format($v_rab->total,0,',','.');
                                                  echo $total; ?>
                                              </font></td>
                                        <td width="50"><font size="2 px"><?php
                                                 $harga_rap = "Rp" . number_format($v_rab->harga_rap,0,',','.');
                                                  echo $harga_rap; ?></font></td>
                                      	<td width="50"><font size="2 px">
                                        	 <?php

                                        	 	$qqty = $v_rab->jumlah_rap;
                                        	 	$harga_rap = $v_rab->harga_rap;
                                        	 	$sub_total_item = $qqty * $harga_rap; 
                                                 $total = "Rp" . number_format($sub_total_item,0,',','.');
                                                  echo $total; ?>


                                              </font></td>

 				<!--	<td width="50">                         
                        <a data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle"><font color="white"><i class="fa fa-ask"></i>&nbsp;&nbsp;Aksi</font></a>
                        <div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
 						<a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $v_rab->no_rap ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat</a>

						<a  data-toggle="modal" style="color:white" data-target="#right_modaldelete<?php echo $v_rab->no_rap ; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a> 

 					</td>  -->                                             

                                    </tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $v_rab->no_rap; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
<div class="modal-dialog modal-large" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Detail RaB - <?php echo $v_rab->no_rap; ?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="<?= base_url('user/leads/update_rap') ?>" enctype="multipart/form-data"  method="POST">
			<div class="modal-body">
				<!-- Content Column -->

				<div class="col-lg-12 mb-4">

					<!-- Project Card Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">

						</div>
<input  type="text" name="no_rap" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $v_rab->no_rap	; ?>"  class="form-control" hidden>
<input  type="text" name="proyek_rap" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $v_rab->proyek_rap; ?>"  class="form-control" hidden>
<input  type="text" name="nama_project" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $leads->nama_project; ?>"  class="form-control" hidden>
						<div class="card-body">
                            <div class="form-group col-md-12">
                            	<label for="jenis_rap"> <span class="badge badge-success">Jenis RaB</span></label>
                            	<select name="jenis_rap" id="" class="form-control" required>
                            		<option value="" >PILIH .....</option>
                            		<?php foreach ($pilih_rap as $prk) : ?>
                            			<option value="<?php echo $prk->nama_rab ?>" <?php
                            			if (!empty($v_rab->jenis_rap)) {
                            				echo $prk->nama_rab == $v_rab->jenis_rap ? 'selected' : '';
                            			}
                            		?>><?php echo $prk->nama_rab ?></option>
                            	<?php endforeach; ?>


                            </select>
                             </div>
							<div class="form-group col-md-12">
								<label for="nama_barang"> <span class="badge badge-success">Description</span></label>
								<input  type="text"     name="deskripsi_rap" placeholder="Description" autocomplete="off" value="<?php echo $v_rab->deskripsi_rap	; ?>"  class="form-control">
							</div> 
							<div class="form-group col-md-12">
								<label for="nama_barang"><span class="badge badge-success">Spesification </span></label>
								<input  type="text"   name="spesifikasi_rap" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_rab->spesifikasi_rap; ?>"  class="form-control">
</div>
<div class="form-group col-md-12">
<label for="nama_barang"> <span class="badge badge-success">Qty</span></label>
<input  type="text "    name="jumlah_rap" placeholder="Qty" autocomplete="off" value="<?php echo $v_rab->jumlah_rap; ?>"  class="form-control">
</div>

								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit </span></label>
									<input  type="text"  name="satuan_rap" placeholder="Unit" autocomplete="off" value="<?php echo $v_rab->satuan_rap; ?>" min="0" class="form-control">
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit Price (RAB) </span></label>
									<input  type="number"  name="harga_rab" placeholder="Unit Price (RAB)" autocomplete="off" value="<?php echo $v_rab->harga_rab; ?>" min="0" class="form-control">
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Total ( IDR ) </span></label>
									<input  type="number"  name="total" placeholder="Total ( IDR )" autocomplete="off" value="<?php echo $v_rab->total; ?>" min="0" class="form-control" readonly>
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit Price (RAP)	 </span></label>
									<input  type="number"  name="harga_rap" placeholder="Unit Price (RAP)" autocomplete="off" value="<?php echo $v_rab->harga_rap; ?>" min="0" class="form-control">
								</div>

								<hr>

								<div class="form-group col-12">
									
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
							
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
<!-- end modal -->
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modaldelete<?php echo $v_rab->no_rap; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
<div class="modal-dialog modal-large" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Detail RaB - <?php echo $v_rab->no_rap; ?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="<?= base_url('user/leads/hapus_rab_ByID') ?>" enctype="multipart/form-data"  method="POST" id="hapus_item">
			<div class="modal-body">
				<!-- Content Column -->

				<div class="col-lg-12 mb-4">

					<!-- Project Card Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">

						</div>
<input  type="text" name="no_rap" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $v_rab->no_rap	; ?>"  class="form-control" hidden>
<input  type="text" name="proyek_rap" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $v_rab->proyek_rap; ?>"  class="form-control" hidden>
<input  type="text" name="nama_project" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $leads->nama_project; ?>"  class="form-control" hidden>
						<div class="card-body">
                            <div class="form-group col-md-12">
                            	<label for="jenis_rap"> <span class="badge badge-success">Jenis RaB</span></label>
                            	<select name="jenis_rap" id="" class="form-control" required>
                            		<option value="" >PILIH .....</option>
                            		<?php foreach ($pilih_rap as $prk) : ?>
                            			<option value="<?php echo $prk->nama_rab ?>" <?php
                            			if (!empty($v_rab->jenis_rap)) {
                            				echo $prk->nama_rab == $v_rab->jenis_rap ? 'selected' : '';
                            			}
                            		?>><?php echo $prk->nama_rab ?></option>
                            	<?php endforeach; ?>


                            </select>
                             </div>
							<div class="form-group col-md-12">
								<label for="nama_barang"> <span class="badge badge-success">Description</span></label>
								<input  type="text"     name="deskripsi_rap" placeholder="Description" autocomplete="off" value="<?php echo $v_rab->deskripsi_rap	; ?>"  class="form-control" readonly>
							</div> 
							<div class="form-group col-md-12">
								<label for="nama_barang"><span class="badge badge-success">Spesification </span></label>
								<input  type="text"   name="spesifikasi_rap" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_rab->spesifikasi_rap; ?>"  class="form-control" readonly>
</div>
<div class="form-group col-md-12">
<label for="nama_barang"> <span class="badge badge-success">Qty</span></label>
<input  type="text "    name="jumlah_rap" placeholder="Qty" autocomplete="off" value="<?php echo $v_rab->jumlah_rap; ?>"  class="form-control" readonly>
</div>

								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit </span></label>
									<input  type="text"  name="satuan_rap" placeholder="Unit" autocomplete="off" value="<?php echo $v_rab->satuan_rap; ?>" min="0" class="form-control" readonly>
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit Price (RAB) </span></label>
									<input  type="number"  name="harga_rab" placeholder="Unit Price (RAB)" autocomplete="off" value="<?php echo $v_rab->harga_rab; ?>" min="0" class="form-control" readonly>
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Total ( IDR ) </span></label>
									<input  type="number"  name="total" placeholder="Total ( IDR )" autocomplete="off" value="<?php echo $v_rab->total; ?>" min="0" class="form-control" readonly>
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit Price (RAP)	 </span></label>
									<input  type="number"  name="harga_rap" placeholder="Unit Price (RAP)" autocomplete="off" value="<?php echo $v_rab->harga_rap; ?>" min="0" class="form-control" readonly>
								</div>

								<hr>

								<div class="form-group col-12">
									
										<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</button>
							
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
<!-- end modal -->
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalnew" tabindex="-1" role="dialog" aria-labelledby="right_modal">
<div class="modal-dialog modal-large" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Detail RaB - <?php echo $leads->nama_project; ?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="<?= base_url('user/leads/simpan_rap') ?>" enctype="multipart/form-data"  method="POST">
			<div class="modal-body">
				<!-- Content Column -->

				<div class="col-lg-12 mb-4">

					<!-- Project Card Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">

						</div>

<input  type="text" name="id_project" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $leads->id_proyek_accurate; ?>"  class="form-control" hidden>
						<div class="card-body">
                            <div class="form-group col-md-12">
                            	<label for="jenis_rap"> <span class="badge badge-success">Jenis RaB</span></label>
                            	<select name="jenis_rap" id="" class="form-control" required>
                            		<option value="" >PILIH .....</option>
                            		<?php foreach ($pilih_rap as $prk) : ?>
                            			<option value="<?php echo $prk->nama_rab ?>" >
                            				<?php echo $prk->nama_rab ?></option>
                            	<?php endforeach; ?>


                            </select>
                             </div>
							<div class="form-group col-md-12">
								<label for="nama_barang"> <span class="badge badge-success">Description</span></label>
								<input  type="text"     name="deskripsi_rap" placeholder="Description" autocomplete="off" value=""  class="form-control">
							</div> 
							<div class="form-group col-md-12">
								<label for="nama_barang"><span class="badge badge-success">Spesification </span></label>
								<input  type="text"   name="spesifikasi_rap" placeholder="Spesification" autocomplete="off" value=""  class="form-control">
</div>
<div class="form-group col-md-12">
<label for="nama_barang"> <span class="badge badge-success">Qty</span></label>
<input  type="text "    name="jumlah_rap" placeholder="Qty" autocomplete="off" value=""  class="form-control">
</div>

								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit </span></label>
									<input  type="text"  name="satuan_rap" placeholder="Unit" autocomplete="off" value="" min="0" class="form-control">
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit Price (RAB) </span></label>
									<input  type="number"  name="harga_rab" placeholder="Unit Price (RAB)" autocomplete="off" value="" min="0" class="form-control">
								</div>
								<div class="form-group col-md-12">
									<label for="nama_barang"><span class="badge badge-success">Unit Price (RAP)	 </span></label>
									<input  type="number"  name="harga_rap" placeholder="Unit Price (RAP)" autocomplete="off" value="" min="0" class="form-control">
								</div>

								<hr>

								<div class="form-group col-12">
									
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
							
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
<!-- end modal -->					
                                    <?php  endforeach; ?>
                                                           
                        </tbody>
							</table>
						</div>         <?php endforeach; ?>
		
     
		
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	 <script>
    document.querySelector('#hapus_item').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Item Akan dihapus!",
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
              text: 'Item Berhasil dihapus !',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Data tidak ada perubahan :)", "error");
          }
        });
    });
  </script>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>