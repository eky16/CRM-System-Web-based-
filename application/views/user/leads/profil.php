<?php ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
	<style>
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
			<div id="content" data-url="<?= base_url('user/leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>

					<div class="float-right">

    <button  class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
      Link
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#section1">Task Proyek</a>
      <a class="dropdown-item" href="#section2">M O M</a>
      <a class="dropdown-item" href="#section3">Dokumentasi Foto</a>
      <a class="dropdown-item" href="#issue">Issue</a> 
      <a class="dropdown-item" href="#checklist">Checklist</a>
      <a class="dropdown-item" href="#section4">Daily Report</a> 

    </div>
  
						<?php if ($this->session->login['role'] == 'admin'): ?>

					<a href="<?= base_url('mom/tambah') ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Buat M O M </a>
					<a href="<?= base_url('leads/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data Leads Project</a>
					<a href="<?= base_url('leads/ubah/' . $all_leads->id_lsp) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
						<?php endif ?>

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
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_lantai/' . $all_leads->id_lsp) ?>">Finishing Lantai</a>
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_dinding/' . $all_leads->id_lsp) ?>">Finishing Dinding</a>
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_pintu/' . $all_leads->id_lsp) ?>">Finishing Pintu & Celling</a>
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_furnitur/' . $all_leads->id_lsp) ?>">Furniture</a> 
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_me/' . $all_leads->id_lsp) ?>">ME</a>
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_lighting/' . $all_leads->id_lsp) ?>">Lighting</a>
                    		<a class="dropdown-item" href="<?= base_url('user/leads/detail_meterial_all/' . $all_leads->id_lsp) ?>">All</a> 
                    	</div>
                  	<?php 	 	$department = $this->session->login['department'];
                  	 			$divisi = $this->session->login['divisi'];
                  	 			$cek_div = $divisi.' '.$department ?>  	
                   <?php if($cek_div == 'Staff Marketing'):?>
				<a href="<?= base_url('user/leads/my_leads_p') ?>" class="btn btn-info btn-sm"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME </a>
                   <?php else: ?>
					<a href="<?= base_url('user/leads') ?>" class="btn btn-info btn-sm"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME </a>
                   <?php endif;?>
					<a target="_blank" href="<?= base_url('user/leads/rab/'.$all_leads->id_proyek_accurate) ?>" class="btn btn-info btn-sm"><i class="fa fa-money"></i>&nbsp;&nbsp;RAB </a>
				</div>
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $all_leads->nama_project ?></h6>
                                     <span>Createdby <?= $all_leads->createdby .' - '. $all_leads->createdtime    ?></span> 
                                    <?php if (!empty($all_leads->updateby)): ?>  ,
                                     <span>Updateby <?= $all_leads->updateby .' - '. $all_leads->updatetime  ?></span>  <?php endif; ?> 
      
                                </div>
                    
                            </div>
				</div>
</div>
	<div class="row">
					                   <div class="col-xl-6 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                 <a target="blank" href="<?= base_url('user/pembelian/laporan_02/'. $all_leads->id_proyek_accurate ) ?>"> <div class="h6 mb-0  font-weight-bold text-success text-uppercase mb-1"> TOTAL PENGELUARAN PESANAN PEMBELIAN</div></a>
                        <a target="blank" href="<?= base_url('user/pembelian/laporan_02/'. $all_leads->id_proyek_accurate ) ?>">           <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_pesanan as $row): ?>
                      
				 <?php
                     $total_01     = $row->harga_total;
                    $hasil = "Rp " . number_format($row->harga_total,0,',','.');
                    echo $hasil; ?>
                   
     <?php endforeach ?>                      	
                        </div></a>
                                </div>
                                <div class="col-auto">
                              
                                <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Detail
                                </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

<!-- start tabel hidden -->

<div class="collapse col-xl-3 col-md-6 mb-4" id="collapseExample">
                          <div class="card border-bottom-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_furniture/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h6 mb-0  font-weight-bold text-primary text-uppercase mb-1"> FURNITURE</div></a>
                                 <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_furniture/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_pesanan_furniture as $row): ?>
                      
                    <?php
                    $total_furniture     = $row->harga_total_furniture;
                    $hasil_furniture = "Rp " . number_format($row->harga_total_furniture,0,',','.');
                    echo $hasil_furniture; ?>
                   
     <?php endforeach ?>                        
                        </div></a>
                                </div>
                       
                              </div>
                            </div>
                          </div>

</div>
<div class="collapse col-xl-3 col-md-6 mb-4" id="collapseExample">
                          <div class="card border-bottom-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_me/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h6 mb-0  font-weight-bold text-primary text-uppercase mb-1"> ME</div></a>
                                 <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_me/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_pesanan_ME as $row): ?>
                      
                    <?php
                    $total_me     = $row->harga_total_me;
                    $hasil_me = "Rp " . number_format($row->harga_total_me,0,',','.');
                    echo $hasil_me; ?>
                   
     <?php endforeach ?>                        
                        </div></a>
                                </div>
                             
                              </div>
                            </div>
                          </div>
            
</div>
               <div class="col-xl-6 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a target="_blank" href="<?= base_url('user/pembelian/laporan_03/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h6 mb-0  font-weight-bold text-danger text-uppercase mb-1"> TOTAL PENGELUARAN PESANAN PEMBELIAN DALAM PENGIRIMAN</div></a>
                                 <a target="_blank" href="<?= base_url('user/pembelian/laporan_03/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_pesanan_not_fix as $row): ?>
                      
                    <?php
                    $total_02     = $row->harga_total;
                    $hasil = "Rp " . number_format($row->harga_total,0,',','.');
                    echo $hasil; ?>
                   
     <?php endforeach ?>                        
                        </div></a>
                                </div>
                                <div class="col-auto">
                                <a href="#">   <i class="fa fa-truck fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<!-- start tabel hidden -->
<div class="collapse col-xl-3 col-md-6 mb-4" id="collapseExample">
                          <div class="card border-bottom-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_sipil/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h6 mb-0  font-weight-bold text-primary text-uppercase mb-1"> SIPIL</div></a>
                                 <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_sipil/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_pesanan_sipil as $row): ?>
                      
                    <?php
                    $total_sipil     = $row->harga_total_sipil;
                    $hasil_sipil = "Rp " . number_format($row->harga_total_sipil,0,',','.');
                    echo $hasil_sipil; ?>
                   
     <?php endforeach ?>                        
                        </div></a>
                                </div>
                           
                              </div>
                            </div>
                          </div>
            
</div>
<div class="collapse col-xl-3 col-md-6 mb-4" id="collapseExample">
                          <div class="card border-bottom-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_dll/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h6 mb-0  font-weight-bold text-primary text-uppercase mb-1"> DLL</div></a>
                                 <a target="_blank" href="<?= base_url('user/pembelian/sub_laporan_dll/'. $all_leads->id_proyek_accurate ) ?>">
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_pesanan_dll as $row): ?>
                      
                    <?php
                    $total_dll     = $row->harga_total_dll;
                    $hasil_dll = "Rp " . number_format($row->harga_total_dll,0,',','.');
                    echo $hasil_dll; ?>
                   
     <?php endforeach ?>                        
                        </div></a>
                                </div>
                             
                              </div>
                            </div>
                          </div>
            
</div> <!-- end tabel hidden -->


<div class="col-xl-6 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                 <a target="blank" href="<?= base_url('user/barang/laporan_pengeluaran002/'. $all_leads->id_proyek_accurate ) ?>"> <div class="h6 mb-0  font-weight-bold text-info text-uppercase mb-1"> TOTAL PENGELUARAN BARANG</div></a>
                        <a target="blank" href="<?= base_url('user/barang/laporan_pengeluaran002/'. $all_leads->id_proyek_accurate ) ?>">           <div class="h3 mb-0 font-weight-bold text-gray-800"> 
  <?php foreach ($grand_total_barang as $row): ?>
                      
                        <?php
                                            $total_03 = $row->total_harga_barang;
                                             $pengeluaran_barang = "Rp " . number_format($row->total_harga_barang,0,',','.');
                                              echo $pengeluaran_barang; ?>
                   
     <?php endforeach ?>                        
                        </div></a>
                                </div>
                                <div class="col-auto">
                                <a target="blank" href="<?= base_url('user/pembelian/laporan_02/'. $all_leads->id_proyek_accurate ) ?>">   <i class="fa fa-briefcase fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                       	<div class="col-xl-6 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="h6 mb-0  font-weight-bold text-primary text-uppercase mb-1"> 
                            <a target="blank"  href="<?= base_url('user/reimburs/laporan_001/'. $all_leads->id_lsp ) ?>"> TOTAL REIMBURSEMENT</a></div>
                         <a target="blank" href="<?= base_url('user/reimburs/laporan_001/'. $all_leads->id_lsp ) ?>"> 
                                  <div class="h3 mb-0 font-weight-bold text-gray-800">
  <?php foreach ($grand_total as $row): ?>
                     <?php if(!empty($row->total_reimburs)): ?>

					  	<?php 
                        $total_04 = $row->total_reimburs ;
                        $hasil_rembes = "Rp " . number_format($row->total_reimburs,0,',','.');
                        echo $hasil_rembes; ?>
                    <?php else: ?>
                        <?php
                  
                        $hasil_rembes = "Rp " . number_format('0',0,',','.');
                        echo $hasil_rembes; ?>	
                        <?php endif;?>
  <?php endforeach ?>
                        </div></a>
                                </div>
                                <div class="col-auto">
                                <a href="#">   <i class="fa fa-money fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="h6 mb-0  font-weight-bold text-primary text-uppercase mb-1"> GRAND TOTAL</div>
                       
                                  <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <u>
<?php $g_total = $total_01 + $total_02 +$total_03 +$total_04;
$hasil_00 = "Rp " . number_format($g_total,0,',','.');
                        echo $hasil_00; ?></u>
                        </div>
                                </div>
                                <div class="col-auto">
                                <a href="#">   <i class="fa fa-money fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
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

                                       
                                    }elseif ($all_leads->status_project == 'RETENSI') {

													echo '<a class="btn btn-outline-warning btn-sm" style="color:black"> RETENSI</a>';

													
												} elseif ($all_leads->status_project == 'FINISH'){
                                       
                                        echo '<a class="btn btn-warning btn-sm" style="color:white">FINISH</a>';
                                    }
                                    else {
                                       
                                        echo '<a class="btn btn-danger btn-sm" style="color:white">LOOSE</a>';
                                    }
                                    ?></font>
										</div>
										<?php if($all_leads->status_project == 'RETENSI'): ?>
										<div class="form-group col-md-4">
											<font size="2px">			<label for="kode_barang"><strong>Tanggal Retensi </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $all_leads->tanggal_retensi ?></font>
										</div>
										<?php endif ;?>	
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

                <!-- start all task -->
<div class="card shadow" id="section1">
				<div class="card-header py-3">
  						  	<div class="float-right"> 
  						  		<a  href="<?php echo base_url('user/mod_kerja/tambah');?>" target="blank_" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Task</a>
                    </div>        
                       <h6 class="m-0 font-weight-bold text-primary">TASK - <?= $all_leads->nama_project ?></h6>
                      </div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataable-task" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td ><font size="2px">No</font></td>
										<td ><font size="2px">Tanggal</font></td>
										<td><font size="2px">Kode</font></td>
										<td><font size="2px">Task</font></td>
										<td><font size="2px">Moderator</font></td>
										<td><font size="2px">Penerima</font></td>
										<td><font size="2px">Proyek</font></td>
										<td><font size="2px">Due Date</font></td>
										<td><font size="2px">Status</font></td>
										<td><font size="2px">Lihat</font></td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_dept_info as $mdl): ?>
										<tr>
											<td width="3"><font size="2px"><?= $no++ ?></font></td>
											<td width="10"><font size="2px"><?php echo date('Y-m-d', strtotime($mdl->createdtime)); ?></font></td>
											<td width="10"><font size="2px"><?= $mdl->kode_modul ?></font></td>
											<td><font size="2px">
												<?php 
												echo $mdl->tugas ?></font></td>
											<td width="150"><font size="2px">
										 <?php
$myvalue = $mdl->createdby;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?> 
												</font></td>
													<td width="150"><font size="2px">
										 <?php
$myvalue = $mdl->nama_karyawan;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?> <font size="1px">(<?php echo $mdl->department ?>)</font>
												</font></td>
											<td><font size="2px"><?= $mdl->nama_proyek ?></font></td>
                          					<td><font size="2px"><?= $mdl->tempo ?></font></td>
											<td><font size="2px"> <?php if ($mdl->status_modul == 2) : ?>
                                        	<span class="badge badge-info">Proses</span>
                                      <?php elseif($mdl->status_modul == 1) : ?>
										<span class="badge badge-warning">Menunggu</span>
										  <?php elseif($mdl->status_modul == 3) : ?>
										<span class="badge badge-success">Selesai</span>
                                       <?php endif; ?></td> </font></td>
											<td align="center"><a target="blank" href="<?= base_url('user/mod_kerja/detail/' . $mdl->kode_modul) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
									
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div> <!-- end all task -->
				<br>
                <!-- start all mom -->
<div class="card shadow" id="section2">
									<div class="card-header py-3">
  						  	<div class="float-right"> 
                    </div>        
                                  <div class="float-right"> 

                  <a  href="<?php echo base_url('user/mom/tambah');?>" target="blank" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah M O M</a>
                
                    </div>  
                       <h6 class="m-0 font-weight-bold text-primary">M O M - <?= $all_leads->nama_project ?></h6>
                      </div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataable-mom" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td ><font size="2px">No</font></td>
										<td ><font size="2px">Tanggal</font></td>
										<td><font size="2px">Kode</font></td>
										<td><font size="2px">Proyek</font></td>
										<td><font size="2px">Agenda</font></td>
										<td><font size="2px">Status</font></td>
										<td><font size="2px">Lihat</font></td>
										
									</tr>
								</thead>
								<tbody>
									 <?php
                         $no = 1;
                          if (!empty($momshow)): foreach ($momshow as $mdl) : ?>
								
										<tr>
											<td width="3"><font size="2px"><?= $no++ ?></font></td>
											<td width="10"><font size="2px"><?php echo date('Y-m-d', strtotime($mdl->tanggal)); ?></font></td>
											<td width="10"><font size="2px"><?= $mdl->id_mom ?></font></td>
											<td><font size="2px">
												<?php 
												echo $mdl->nama_project ?></font></td>
											<td><font size="2px"><?= $mdl->agenda ?></font></td>

											<td><font size="2px"> <?php if ($mdl->status == 1) : ?>
                                        	<span class="badge badge-info">MOM 1</span>
                                      <?php elseif($mdl->status == 2) : ?>
										<span class="badge badge-warning">MOM 2</span>
										  <?php elseif($mdl->status == 3) : ?>
										<span class="badge badge-success">MOM 3</span>
									  <?php elseif($mdl->status == 4) : ?>
<span class="badge badge-success">MOM 4</span>
									  <?php elseif($mdl->status == 5) : ?>
<span class="badge badge-success">MOM 5</span>
									  <?php elseif($mdl->status == 6) : ?>
<span class="badge badge-success">TIDAK</span>
									  <?php elseif($mdl->status == 7) : ?>
<span class="badge badge-success">GOAL</span>
                                       <?php endif; ?></td>

											<td align="center"><a href="<?= base_url('user/mom/detail/' . $mdl->id) ?> "target="blank" class="btn btn-primary btn-sm">Lihat</a></td>
										</tr>
									<?php endforeach ?>   <?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div> <!-- end all mom -->
					<br>
                 <!-- Start foto & issue -->
<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4 " id="section3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DOKUMENTASI FOTO</h6>
                                </div>
                                <div class="card-body">
                      						<div class="table-responsive">
							<table class="table table-bordered" id="tabel-data-foto" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td ><font size="2px">Karyawan</font></td>
										<td ><font size="2px">Tanggal</font></td>
										<td><font size="2px">Jumlah Foto</font></td>
										<td><font size="2px">Lihat</font></td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_foto as $mdl): ?>
										<tr>
											<td width="1"><font size="2px"><?= $nooo++ ?></font></td>
											<td ><font size="2px">	 <?php
$myvalue = $mdl->nama_karyawan;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?> <font size="1px">(<?php echo $mdl->department ?>)</font>
												</font></font></td>
											<td ><font size="2px"><?php 
												echo $mdl->tgl_upload ?></font></td>
											<td align="center"><font size="2px"><!--<?php 
										$total= $mdl->total_foto;
										$bagi = 2;
										$hasil = $total / $bagi ;
											echo $hasil; ?> --><?= $mdl->total_foto; ?></font></td>	
											<td align="center"><a href="<?= base_url('user/leads/detail_foto/' . $mdl->id_lsp .'/'. $mdl->tgl_upload) ?>" target="blank" class="btn btn-primary btn-sm">Lihat</a></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>

</div></div>
                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4" id="issue">
                           		<div class="card-header">  <h6 class="m-0 font-weight-bold text-primary">ISSUE - <?= $all_leads->nama_project ?>
					<div class="float-right"> 

                  <a  data-toggle="modal" style="color:white" data-target="#right_modal_issue" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Issue</a>
                
                    </div></h6></div>
                                <div class="card-body">
   						<div class="table-responsive">
							<table class="table table-bordered" id="tabel-data-issue" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="5"><font size="2px">No</font></td>
										<td width="50"><font size="2px">Tanggal</font></td>
										<td width="50"><font size="2px">Moderator</font></td>
										<td align="center"><font size="2px">Judul Issue</font></td>
										<td width="50"><font size="2px">Lihat</font></td>
										
									</tr>
								</thead>
								<tbody>
													 <?php
                         $no = 1;
                          if (!empty($all_issue)): foreach ($all_issue as $mdl) : ?>
						
										<tr>
									<td width="5"><font size="2px"><?= $no++ ?></font></td>
								<td ><font size="2px"><?php echo $mdl->created_time_issue ?></font></td>
												<td ><font size="2px">	 <?php
$myvalue = $mdl->created_issue;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?> <font size="1">(<?php echo $mdl->department ?>)</font>
												</font></font></td>
											<td ><font size="2px"><?php 
											echo $mdl->judul_issue; ?></font></td>	
											<td align="center"><a href="<?= base_url('user/leads/detail_issue/' . $mdl->kode_issue) ?>" target="blank" class="btn btn-primary btn-sm">Lihat  <span class="badge badge-danger badge-counter "><?php echo $mdl->hitung ?></span></a></td>
										</tr>

									<?php endforeach ?><?php endif;?>

								</tbody>
							</table>
						</div>
                                </div>
                            </div>

                        </div>
                    <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4 " id="checklist">
                                    		<div class="card-header">  <h6 class="m-0 font-weight-bold text-primary">CHECKLIST - <?= $all_leads->nama_project ?>
					<div class="float-right"> 

                  <a  data-toggle="modal" style="color:white" data-target="#right_modal_ceklist" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah </a>
                
                    </div></h6></div>
                                <div class="card-body">
                      						<div class="table-responsive">
							<table class="table table-bordered" id="tabel-data-ceklist" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td width="1"><font size="2px">Kode</font></td>
										<td width="70"><font size="2px">Tgl</font></td>
										<td width="300"><font size="2px">Penangung Jawab</font></td>
										<td width="300"><font size="2px">Lokasi</font></td>
										<td width="120"><font size="2px">Durasi</font></td>
										<td width="70"><font size="2px">Due date</font></td>
										<td width="70"> <font size="2px">Aksi</font></td>
										
									</tr>
								</thead>
								<tbody>
									 <?php
                         $no = 1;
                          if (!empty($all_checklist)): foreach ($all_checklist as $mdl) : ?>
					
										<tr>
											<td width="1"><font size="2px"><?= $no++ ?></font></td>
											<td width="1"><font size="2px"><?php echo $mdl->kode_ceklist ?></font></td>
							<td ><font size="2px"><?php echo $mdl->tgl_ceklist ?></font></td>
							<td ><font size="2px">	 <?php
$myvalue = $mdl->user_ceklist;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?> <font size="1">(<?php echo $mdl->department ?>)</font>
												</font></font></td>
							<td ><font size="2px"><?php  echo $mdl->lokasi_ceklist ?></font></td>
							<td ><font size="2px">		
				<?php
				  $persentasi=round($mdl->hitung_persen/$mdl->hitung_sub * 100); 
                                       echo "$persentasi%";
				 if($mdl->hitung > 0):?>
				<?php 
                                            $start_date = new DateTime($mdl->duedate_ceklist);
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
								<?php endif;?><?php else: ?>
<span class="badge badge-success">Finish</span>
							<?php endif;?>
</font></font></td>
												<td ><font size="2px"><?php 
												echo $mdl->duedate_ceklist ?></font></td>	
											<td align="center"><a href="<?= base_url('user/leads/detail_checklist/' . $mdl->kode_ceklist) ?>" target="blank" class="btn btn-primary btn-sm">Lihat  <span class="badge badge-danger badge-counter "><?php echo $mdl->hitung ?></span></a></td>
										</tr>
									<?php endforeach ?><?php endif;?>
								</tbody>
							</table>
						</div>

</div></div>
                        </div>
                    </div>  <!-- end foto & issue -->
                 <!-- STATUS LOG PROYEK -->

<div class="card shadow" id="section4">
				
	
  						<div class="card-header py-3">
  						  	<div class="float-right"> 

                  <a  data-toggle="modal" style="color:white" data-target="#right_modal" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                
                    </div>        
                       <h6 class="m-0 font-weight-bold text-primary">DAILY REPORT - <?= $all_leads->nama_project ?></h6>
                      </div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="tabel-data-l" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td ><font size="2px">No</font></td>
										<td ><font size="2px">Operator</font></td>
										<td><font size="2px">Tgl</font></td>
										<td align="center"><font size="2px">Kegiatan</font></td>
										<td><font size="2px">Due Date</font></td>
										<td><font size="2px">File</font></td>
									
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_stts_proyek as $mdl): ?>
										<tr>
											<td width="30"><font size="2px"><?= $noo++ ?></font></td>
											<td width="150"><font size="2px">
										 <?php
$myvalue = $mdl->operator;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?> <font size="1px">(<?php echo $mdl->department ?>)</font>
												</font></td>
											<td width="110"><font size="2px"><?php 
												echo $mdl->tgl_create ?></font></td>
											<td ><font size="2px"><?php 
												echo $mdl->kegiatan ?></font></td>
											<td align="center" width="110"><font size="2px"><?php 
												echo $mdl->due_date_log ?></font></td>	
										<td align="center" width="110">
<?php if (!empty($mdl->file)): ?>
<a target="blank" href="<?php echo base_url(); ?>img/uploads/berkas1/<?= $mdl->file ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i>&nbsp;Lihat</a>
 <?php else : ?>
<strong>  <a  data-toggle="modal" style="color:white" data-target="#right_modal_update<?= $mdl->id_stts_log ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>               
<?php endif; ?>
											</td>
										
										</tr>
													<!-- modal pesan -->
 
<div  class="modal modal-right fade" id="right_modal_update<?= $mdl->id_stts_log ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Log Status Proyek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/leads/update_laporan_status_log') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                	       <input type="" hidden name="id_lsp_proyek"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
                                	     <input type="" hidden name="id_stts_log"  value="<?= $mdl->id_stts_log ?>">
                                	       <input  type="text" hidden maxlength="50"  name="tgl_create" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Due Date </label><i> <font size="2px" color="red">Abaikan jika tidak perlu</font></i>
                                             <input  type="date" maxlength="50"  name="due_date_log" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>File </strong>  <i> <font size="2px" color="red">* .pdf .jpeg .jpg .png</font></i></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="file"  name="file" readonly placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="kegiatan" class="form-control" ><?= $mdl->kegiatan ?></textarea>
									</div>

                                <input type="text" name="operator" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

         

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

</div> <!-- end modal log proyek -->
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				<!-- modal pesan -->
 
<div  class="modal modal-right fade" id="right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Log Status Proyek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/leads/save_laporan_status_log') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                	       <input type="" hidden name="id_lsp_proyek"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
                                	       <input  type="text" hidden maxlength="50"  name="tgl_create" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Due Date </label><i> <font size="2px" color="red">Abaikan jika tidak perlu</font></i>
                                             <input  type="date" maxlength="50"  name="due_date_log" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>File </strong>  <i> <font size="2px" color="red">* .pdf .jpeg .jpg .png</font></i></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="file"  name="file" readonly placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
										<textarea  name="kegiatan" class="form-control textEditor" ></textarea>
									</div>

                                <input type="text" name="operator" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

         

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

</div> <!-- end modal log proyek -->

			</div>
<!-- modal issue -->
<div  class="modal modal-right fade" id="right_modal_issue" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Issue </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/leads/create_issue') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" name="formcek2" onsubmit="return validateForm2()">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                	       <input type=""  name="id_lsp_issue" hidden value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
                                	 <input  type="text"  maxlength="50" hidden name="created_time_issue" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Kode </label>
                                             <input  type="text" maxlength="50" readonly name="kode_issue" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php  $code =  random_string('numeric', 5);
                                            $kode = 'I'.''.$code ;
                                            echo $kode; ?>"  class="form-control">
                                </div>
                                    <div class="form-group col-md-12">
                                            <label for="nama_barang">Judul Issue </label>
                                             <input  type="text"   name="judul_issue" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="" id="judul_isue" class="form-control" >
                                </div> 
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea   name="ket_issu" class="form-control" ></textarea>
									</div>
									<div class="form-group col-12" >
 					<div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Tambah Issue</button>
					</div>
                                <input type="text" name="created_issue" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
 <script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
             html += '<textarea   name="kode_issuee[]" hidden readonly  class="form-control m-input" placeholder="issue" autocomplete="off"><?php echo $kode; ?></textarea>';
            html += '<textarea   name="issue[]" id="isi_isue" class="form-control m-input" placeholder="issue" autocomplete="off" ></textarea>';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
                                <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                    

                        </div>
        </div>
      </form> 
    <script> 
        function validateForm2() {

            if (document.forms["formcek2"]["judul_isue"].value == "") {
                alert("Judul Tidak Boleh Kosong");
                document.forms["formcek2"]["judul_isue"].focus();
                return false;
            }
            if (document.forms["formcek2"]["isi_isue"].value == "") {
                alert("Issue Tidak Boleh Kosong");
                document.forms["formcek2"]["isi_isue"].focus();
                return false;
            }
        }
</script>
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div> <!-- end modal issue -->

<!-- modal ceklist new -->
 
<div  class="modal modal-right fade" id="right_modal_ceklist" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CHECKLIST</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/leads/create_checklist') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                <input type="text" name="user_ceklist" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
                    	       <input type=""  name="id_lsp_ceklist"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>" hidden>
                    	       <input  type="text"  maxlength="50"  name="tgl_ceklist" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                            	echo date('Y-m-d H:i:s');
                            	?>"  class="form-control" hidden>
                            	<div class="form-group col-md-12">
                                            <label for="nama_barang">Kode </label>
                                             <input  type="text" maxlength="50" readonly name="kode_ceklist" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?php  $code =  random_string('numeric', 5);
                                            $kodee = 'C'.''.$code ;
                                            echo $kodee; ?>"  class="form-control " required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Lokasi </label>
                                             <input  type="text" maxlength="50"  name="lokasi_ceklist" placeholder="Masukkan Nama Lokasi" autocomplete="off" value=""  class="form-control " required>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Due Date </label>
                                             <input  type="date" maxlength="50"  name="duedate_ceklist" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control" required>
                                </div>
                                <textarea   name="code_ceklist[]" hidden readonly  class="form-control m-input" placeholder="issue" autocomplete="off"><?php echo $kodee; ?></textarea>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Foto </strong>  <i> <font size="2px" color="red">* .pdf .jpeg .jpg .png</font></i></label>
                                             <input  type="file"  name="berkas[]"  placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control" required>
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_ceklist[]" class="form-control" ></textarea>
									</div>
									<div class="form-group col-12" >
 					<div id="newRow1"></div>
                    <button id="addRow1" type="button" class="btn btn-info">Tambah Foto</button>
					</div>
 <script type="text/javascript">
        // add row
        $("#addRow1").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
             html += '<textarea   name="code_ceklist[]" hidden readonly  class="form-control m-input" placeholder="issue" autocomplete="off"><?php echo $kodee; ?></textarea>';
            html += ' <input  type="file"  name="berkas[]"  placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control" required>';
           

			
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';
            html += '<div class="input-group mb-3">';
			html += '<textarea placeholder="keterangan" name="ket_ceklist[]" class="form-control" ></textarea>';
 			html += '</div>';
            $('#newRow1').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
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

</div> <!-- end modal ceklist new -->
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