<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style>

		        .removeRow
{
 background-color: #D1D1D1;
    color:#FFFFFF;
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: #555;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
</style>

<script src="<?= base_url('sb-admin') ?>/js/jquery-3.1.0.js"></script> 



<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
        "lengthMenu": [ 5,10, 25, 50, 75, 10
    });
</script>

 <script>
    $(document).ready(function() {
        $('#dataable-task').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [ 5,10, 25, 50, 75, 10]
        });        
    });
  </script> 
     <script>
    $(document).ready(function() {
        $('#dataable-mom').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [ 5,10, 25, 50, 75, 10]
        });        
    });
  </script>
 <script>
    $(document).ready(function() {
        $('#tabel-data-issue').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [ 5,10, 25, 50, 75, 10]
        });        
    });
  </script> 
 <script>
    $(document).ready(function() {
        $('#tabel-data-l').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [ 5,10, 25, 50, 75, 10]
        });        
    });
  </script> 
        <script>
    $(document).ready(function() {
        $('#tabel-data-foto').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [ 5,10, 25, 50, 75, 100 ]
        });        
    });
    </script>
            <script>
    $(document).ready(function() {
        $('#tabel-data-ceklist').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [ 5,10, 25, 50, 75, 100 ]
        });        
    });
    </script>
</head>

<body id="page-top">

	<div id="wrapper">
		<!-- load sidebar -->
		

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>

					<div class="float-right">

					<button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>					</div>
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
     <div class="row">
		 			<div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow ">
                                <div class="card-header py-4">
                    <div class="float-right">
                    	<button  class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    		List Material
                    	</button>
                    	<div class="dropdown-menu">
                    		<a class="dropdown-item" href="<?= base_url('leads/detail_meterial_lantai/' . $all_leads->id_lsp) ?>">Finishing Lantai</a>
                    		<a class="dropdown-item" href="<?= base_url('leads/detail_meterial_dinding/' . $all_leads->id_lsp) ?>">Finishing Dinding</a>
                    		<a class="dropdown-item" href="<?= base_url('leads/detail_meterial_pintu/' . $all_leads->id_lsp) ?>">Finishing Pintu & Celling</a>
                    		<a class="dropdown-item" href="<?= base_url('leads/detail_meterial_furnitur/' . $all_leads->id_lsp) ?>">Furniture</a> 
                    		<a class="dropdown-item" href="<?= base_url('leads/detail_meterial_me/' . $all_leads->id_lsp) ?>">ME</a>
                    		<a class="dropdown-item" href="<?= base_url('leads/detail_meterial_lighting/' . $all_leads->id_lsp) ?>">Lighting</a> 

                    	</div>
					<a href="<?= base_url('leads') ?>" class="btn btn-info btn-sm"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME </a>
				</div>
                                 <a href="<?= base_url('leads/detail/' . $all_leads->id_lsp) ?>">   <h6 class="m-0 font-weight-bold text-primary"><?= $all_leads->nama_project ?></h6></a>
                                     <span>Createdby <?= $all_leads->createdby .' - '. $all_leads->createdtime    ?></span> 
                                    <?php if (!empty($all_leads->updateby)): ?>  ,
                                     <span>Updateby <?= $all_leads->updateby .' - '. $all_leads->updatetime  ?></span>  <?php endif; ?> 
      
                                </div>
                    
                            </div>
				</div>
</div>
           <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI PROJECT</h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
                                   
                            		
									<div class="form-group col-md-4">
								<font size="2px">		<label for="kode_barang"><strong>Start Project </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->tgl_start ?></font>
										</div>
									<div class="form-group col-md-4">
								<font size="2px">		<label for="kode_barang"><strong>Serah Terima Project </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->tgl_serah_terima ?></font>
										</div>
									<div class="form-group col-md-4">
							<font size="2px">			<label for="kode_barang"><strong>Sisa Waktu </strong>
											</label></font>
										</div>
										<div class="form-group col-md-5">:
										<?php 
                                            $start_date = new DateTime($all_leads->tgl_serah_terima);
                                            $end_date = new DateTime(date('Y-m-d'));
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                           
                                            ?>	
              	
								<?php if($start_date > $end_date OR $start_date == $end_date): ?>
								<span class="badge badge-primary"><?php  echo " ". $m . " bulan ". $d . " hari"; ?></span>	
								<?php else: ?>
									<span class="badge badge-danger">Expired</span>
								<?php endif;?></font>
					
								
										</div>
													<div class="form-group col-md-4">
								<font size="2px">		<label for="kode_barang"><strong>PM</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->project_manager ?></font>
										</div>
																			<div class="form-group col-md-4">
						<font size="2px">				<label for="kode_barang"><strong>SM </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->site_manager ?></font>
										</div>
																			<div class="form-group col-md-4">
							<font size="2px">			<label for="kode_barang"><strong>Spv </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $all_leads->spv_manager ?></font>
										</div>
															<div class="form-group col-md-4">
							<font size="2px">			<label for="kode_barang"><strong>Designer </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?php if(!empty($all_leads->designerBy )):?>	<?= $all_leads->designerBy ?><?php endif;?></font>
										</div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI PROJECT</h6>
                                </div>
                                <div class="card-body">
                                                                   	<div class="form-row">
                                   	<div class="form-group col-md-4">
										<font size="2px">	<label for="kode_barang"><strong>Kode Leads Project</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->id_lsp ?></font>
										</div>
                            		<div class="form-group col-md-4">
										<font size="2px">		<label for="kode_barang"><strong>Nama Project</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->nama_project ?></font>
										</div>
								    <div class="form-group col-md-4">
									<font size="2px">			<label for="kode_barang"><strong>Alamat Project </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $all_leads->alamat_project ?></font>
										</div>

								    <div class="form-group col-md-4">
											<font size="2px">	<label for="kode_barang"><strong>Status Project </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?php
                                    if ($all_leads->status_project == 'TENDER') {
                                        echo '<a class="btn btn-success btn-sm" style="color:white"><font size="2px">TENDER</font></a> ';
                                    } elseif ($all_leads->status_project == 'ON GOING') {

                                        echo '<a class="btn btn-primary btn-sm" style="color:white"><font size="2px">ON GOING</font></a>';
                                       
                                    }
                                   elseif ($all_leads->status_project == 'PENDING') {

                             echo '<a class="btn btn-outline-success btn-sm" style="color:black"> PENDING</a>';

                                       
                                    } elseif ($all_leads->status_project == 'FINISH'){
                                       
                                        echo '<a class="btn btn-warning btn-sm" style="color:white">FINISH</a>';
                                    }
                                    else {
                                       
                                        echo '<a class="btn btn-danger btn-sm" style="color:white">LOOSE</a>';
                                    }
                                    ?></font>
										</div>
						<?php if($all_leads->status_project == 'LOOSE'): ?>
									<div class="form-group col-md-4">
								<font size="2px"><label for="kode_barang"><strong>Keterangan </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $all_leads->keterangan_loose ?></font>
										</div>
									<?php endif ;?>	
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                 <!-- Start foto & issue -->
<div class="row">


     
                    <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4 " id="checklist">
                                    		<div class="card-header">  <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> - <?= $all_leads->nama_project ?>
					<div class="float-right"> 

                  <a  data-toggle="modal" style="color:white" data-target="#right_modal_ceklist" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah </a>
                
                    </div></h6></div>
                                <div class="card-body">
                      						<div class="table-responsive">
							<table class="table table-bordered" id="tabel-data-ceklist" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td width="70"><font size="2px">Tgl</font></td>
										<td width="50"><font size="2px">Satus</font></td>
										<td width="250"><font size="2px">Jenis Material</font></td>
										<td width="120"><font size="2px">Kode Spesifikasi</font></td>
										<td width="120"><font size="2px">Lokasi Penggunaan</font></td>
										<td width="100"> <font size="2px">Aksi</font></td>
										 <th width="5%"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs"><font size="2px">Del</font></button></th>
									</tr>
								</thead>
								<tbody>
									 <?php
                         $no = 1;
                          if (!empty($material)): foreach ($material as $mdl) : ?>
					
							<tr>
						<?php if($mdl->status_approved == 'Y'):?>
							<td width="1"><font size="2px"><?= $no++ ?></font></td>
													<?php if(!empty($mdl->last_time_update)):?>
							<td width="1"><font size="2px"><?php echo $mdl->last_time_update ?></font></td>	
							<?php else: ?>
							<td width="1"><font size="2px"><?php echo $mdl->creat_at_mt ?></font></td>	
							<?php endif;?>
							<td ><font size="2px">
								<?php $status_= $mdl->status_approved; ?>
									      <?php if ($status_ == 'Y'):?>
                                            <span class="badge badge-success">Y</span>
                                            <?php endif;?>
                                            <?php if ($status_ == 'N'):?>
                                            <span class="badge badge-danger">N</span>
                                            <?php endif;?>
							</font></td>
							<td ><font size="2px">	<?php echo $mdl->jenis_material ?></font></td>
							<td ><font size="2px"><?php  echo $mdl->kode_spesifikasi ?></font></td>
							<td ><font size="2px">	<?php  echo $mdl->lokasi_penggunaan ?>	</font></td>
						<?php endif;?>		

						<?php if($mdl->status_approved == 'N'):?>
							<td width="1"><font size="2px" color="red"><?= $no++ ?></font></td>
							<?php if(!empty($mdl->last_time_update)):?>
							<td width="1"><font size="2px" color="red"><?php echo $mdl->last_time_update ?></font></td>	
							<?php else: ?>
							<td width="1"><font size="2px" color="red"><?php echo $mdl->creat_at_mt ?></font></td>	
							<?php endif;?>
							<td ><font size="2px" color="red"><?php $status_= $mdl->status_approved; ?>
									      <?php if ($status_ == 'Y'):?>
                                            <span class="badge badge-success">Y</span>
                                            <?php endif;?>
                                            <?php if ($status_ == 'N'):?>
                                            <span class="badge badge-danger">N</span>
                                            <?php endif;?></font></td>
							<td ><font size="2px" color="red">	<?php echo $mdl->jenis_material ?></font></td>
							<td ><font size="2px" color="red"><?php  echo $mdl->kode_spesifikasi ?></font></td>
							<td ><font size="2px" color="red">	<?php  echo $mdl->lokasi_penggunaan ?>	</font></td>
						<?php endif;?>

							<td align="center"><a href="<?= base_url('leads/detail_material/' . $mdl->id_material) ?>" target="blank" class="btn btn-primary btn-sm">Lihat </span></a>
							 <a  data-toggle="modal" style="color:white" data-target="#right_modal_ceklist<?= $mdl->no ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah </a></td>
							  <td align="center"><input type="checkbox" class="delete_checkbox_daily" value="<?php  echo $mdl->id_material ?>" /></td>
										</tr>

<div  class="modal modal-right fade" id="right_modal_ceklist<?= $mdl->no ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data Material <?= $mdl->kode_spesifikasi ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_material') ?>"  enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design </h6>
                                </div>
                                <div class="card-body">

                                	 <?php if ($title == 'Finishing Lantai'):?>
                                	 	<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="lantai" maxlength="8" hidden>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_lantai" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'Finishing Dinding'):?>
                                	 	 <input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_dinding" maxlength="8" hidden>
                                	 	 <input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="dinding" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	  <?php if ($title == 'Finishing Pintu & Celling'):?>
                                	 	 <input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_pintu" maxlength="8" hidden>
                                	 	  <input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="pintu" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'Furniture'):?>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_furnitur" maxlength="8" hidden>
                                	 	<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="furniture" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'ME'):?>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_me" maxlength="8" hidden>
                                	 	<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="me" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'Lighting'):?>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_lighting" maxlength="8" hidden>
                                	 		<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="lighting" maxlength="8" hidden>
                                	 <?php endif ;?> 	
                                <input type="text" name="user_ceklist" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
                    	       <input type=""  name="id_lsp"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>" hidden>
                    	       <input  type="text"  maxlength="50"  name="tgl_ceklist" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                            	echo date('Y-m-d H:i:s');
                            	?>"  class="form-control" hidden>

 <input  type="text" maxlength="50" readonly name="status_approved_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $mdl->status_approved ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="jenis_material_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $mdl->jenis_material ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="kode_spesifikasi_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $mdl->kode_spesifikasi ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="lokasi_penggunaan_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $mdl->lokasi_penggunaan ?>"  class="form-control " hidden>



                            	<div class="form-group col-md-12">
                                            <label for="nama_barang">Id </label>
                                            <input  type="text" maxlength="50" readonly name="idd_no" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $mdl->no ?>"  class="form-control " hidden>
                                             <input  type="text" maxlength="50" readonly name="id_material" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $mdl->id_material ?>"  class="form-control " required>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="tgl_" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $mdl->tgl_ ?>"  class="form-control" required>
                                </div>
                          <div class="form-group col-12">
                                            <label>Status Approved</label>
                            <select name="status_approved" class="form-control" >
                            <option value="">Pilih ...</option>
                            <option value="Y" <?php
                            if (!empty($mdl->status_approved)) {
                                echo $mdl->status_approved == 'Y' ? 'selected' : '';
                            }
                            ?>>Y</option>
                            <option value="N" <?php
                            if (!empty($mdl->status_approved)) {
                                echo $mdl->status_approved == 'N' ? 'selected' : '';
                            }
                            ?>>N</option>
                            </select>
                                </div>
                               <div class="form-group col-md-12">
                                            <label for="nama_barang">Jenis Material </label>
                                             <input  type="text" maxlength="50"  name="jenis_material" placeholder="Jenis Material" autocomplete="off" value="<?= $mdl->jenis_material ?>"  class="form-control " required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kode Spesifikasi </label>
                                             <input  type="text" maxlength="50"  name="kode_spesifikasi" placeholder="Kode Spesifikasi" autocomplete="off" value="<?= $mdl->kode_spesifikasi ?>"  class="form-control " required>
                                </div>

										<div class="form-group col-12">
											<label>Lokasi Penggunaan</label>
											<textarea  name="lokasi_penggunaan" class="form-control" ><?= $mdl->lokasi_penggunaan ?></textarea>
									</div>
									<div class="form-group col-12" >
</div>

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

</div> <!-- end modal ceklist new -->
									<?php endforeach ?><?php endif;?>
								</tbody>
							</table>
						</div>

</div></div>
                        </div>
                    </div>  <!-- end foto & issue -->

				<!-- modal pesan -->


			</div>


<!-- modal ceklist new -->
 
<div  class="modal modal-right fade" id="right_modal_ceklist" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/create_material') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design </h6>
                                </div>
                                <div class="card-body">

                                	 <?php if ($title == 'Finishing Lantai'):?>
                                	 	<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="lantai" maxlength="8" hidden>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_lantai" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'Finishing Dinding'):?>
                                	 	 <input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_dinding" maxlength="8" hidden>
                                	 	 <input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="dinding" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	  <?php if ($title == 'Finishing Pintu & Celling'):?>
                                	 	 <input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_pintu" maxlength="8" hidden>
                                	 	  <input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="pintu" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'Furniture'):?>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_furnitur" maxlength="8" hidden>
                                	 	<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="furniture" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'ME'):?>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_me" maxlength="8" hidden>
                                	 	<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="me" maxlength="8" hidden>
                                	 <?php endif ;?>
                                	 <?php if ($title == 'Lighting'):?>
                                	 	<input type="text" name="link2" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="detail_meterial_lighting" maxlength="8" hidden>
                                	 		<input type="text" name="jenis" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="lighting" maxlength="8" hidden>
                                	 <?php endif ;?>
                                <input type="text" name="user_ceklist" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
                    	       <input type=""  name="id_lsp"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>" hidden>
                    	       <input  type="text"  maxlength="50"  name="tgl_ceklist" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                            	echo date('Y-m-d H:i:s');
                            	?>"  class="form-control" hidden>
                            	<div class="form-group col-md-12">
                                            <label for="nama_barang">Id </label>
                                             <input  type="text" maxlength="50" readonly name="id_material" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?php  $code =  random_string('numeric', 5);
                                            $kodee = 'MT'.''.$code ;
                                            echo $kodee; ?>"  class="form-control " required>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="tgl_" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control" required>
                                </div>
                          <div class="form-group col-12">
                                            <label>Status Approved</label>
                            <select name="status_approved" class="form-control" >
                            <option value="">Pilih ...</option>
                            <option value="Y" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'Y' ? 'selected' : '';
                            }
                            ?>>Y</option>
                            <option value="N" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'N' ? 'selected' : '';
                            }
                            ?>>N</option>
                            </select>
                                </div>
                               <div class="form-group col-md-12">
                                            <label for="nama_barang">Jenis Material </label>
                                             <input  type="text" maxlength="50"  name="jenis_material" placeholder="Jenis Material" autocomplete="off" value=""  class="form-control " required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kode Spesifikasi </label>
                                             <input  type="text" maxlength="50"  name="kode_spesifikasi" placeholder="Kode Spesifikasi" autocomplete="off" value=""  class="form-control " required>
                                </div>

										<div class="form-group col-12">
											<label>Lokasi Penggunaan</label>
											<textarea  name="lokasi_penggunaan" class="form-control" ></textarea>
									</div>
									<div class="form-group col-12" >
</div>

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

</div> <!-- end modal ceklist new -->
<!-- modal ceklist new -->

			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>

	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<script>
$(document).ready(function(){
 
 $('.delete_checkbox_daily').click(function(){
  if($(this).is(':checked'))
  {
   $(this).closest('tr').addClass('removeRow');
  }
  else
  {
   $(this).closest('tr').removeClass('removeRow');
  }
 });

 $('#delete_all').click(function(){
  var checkbox = $('.delete_checkbox_daily:checked');
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({
    url:"<?php echo base_url(); ?>user/leads/delete_material",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
     $('.removeRow').fadeOut(1500);
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });

});
</script>

</body>
</html>