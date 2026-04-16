<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					
								<a href="<?= base_url('user/mom/export/'. $details->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
									<?php if ($this->session->login['role'] == 'admin'): ?>
					<a href="<?= base_url('mom/tambah') ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Buat M O M Baru </a> 
					<a href="<?= base_url('mom/edit2_mom/' . $details->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Lanjut M O M </a>
					<a href="<?= base_url('mom/ubah/' . $details->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
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
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $details->id_mom .' - '. $details->nama_project	 ?></h6>
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
											<label ><strong>Kode M O M</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->id_mom ?>
										</div> 
                            		<div class="form-group col-md-4">
											<label ><strong>Kode Leads Project</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->id_lsp ?>
										</div>
                            		<div class="form-group col-md-4">
											<label ><strong>Status Project</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->status_project ?>
										</div>
								    <div class="form-group col-md-4">
											<label ><strong>Nama PIC </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->nama_pic ?>
										</div>
								        <div class="form-group col-md-4">
											<label ><strong>Nama Project</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->nama_project ?>
										</div>
									<div class="form-group col-md-4">
											<label ><strong>Alamat Project</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $details->alamat_project ?>
										</div>


								    <div class="form-group col-md-4">
											<label ><strong>Tanggal M O M</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->tanggal ?>
										</div>
								    <div class="form-group col-md-4">
											<label ><strong>Lokasi </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->lokasi ?>
										</div>
								    <div class="form-group col-md-4">
											<label ><strong>Participants </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $details->partisipasi ?>
										</div>
								<div class="form-group col-md-4">
											<label ><strong>Status M O M </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <?php 
                                $attr = array(
                                'target'=>'_blank'
                                ); ?><?php
                               
                                    if ($details->status == '1') {
                                        echo anchor('mom/edit2_mom/'. $details->id,'<i class="label label-warning">M O M 1</i>',$attr);
                                    } elseif ($details->status == '2') {

                                        echo anchor('mom/edit2_mom/'. $details->id,'<i class="label label-warning">M O M 2</i>',$attr);

                                       
                                    }
                                   elseif ($details->status == '3') {

                                        echo anchor('mom/edit2_mom/'. $details->id,'<i class="label label-info"> M O M 3</i>',$attr);

                                       
                                    }
                                     elseif ($details->status == '4') {

                                        echo anchor('mom/edit2_mom/'. $details->id,'<i class="label label-info"> M O M 4</i>',$attr);

                                       
                                    }elseif ($details->status == '5') {

                                        echo anchor('mom/edit2_mom/'. $details->id,'<i class="label label-info"> M O M 5</i>',$attr);

                                       
                                    }elseif ($details->status == '6') {

                                      
                                        echo '<span class="label label-danger"> TIDAK </span>';
                                       
                                    } elseif ($details->status == '7'){
                                        echo '<span class="label label-success"> GOAL </span>';
                                    }
                                    else {
                                         echo anchor('mom/edit2_momnn/' . $details->leadsproject_id, '<i class="label label-danger">Rejected</i>',$attr);
                                    }
                                    ?>
										</div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI M O M PROJECT</h6>
                                </div>
                                <div class="card-body">
                                                                   	<div class="form-row">
                                   
                            		
								    <div class="form-group col-md-3">
											<label ><strong>Agenda</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $details->agenda ?>
										</div>
									 <?php if (!empty($details->berkas)): ?>
									<div class="form-group col-md-3">
											<label ><strong>Foto</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<a target="blank" href="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $details->berkas ?>" title="Menuju halaman google">
  Lihat 
</a>
										</div><?php endif; ?>

								    <div class="form-group col-md-3">
											<label ><strong>DISKUSI </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $details->diskusi ?>
										</div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
			</div>
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