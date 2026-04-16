<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
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
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
						<?php if ($this->session->login['role'] == 'admin'): ?>

							<a href="<?= base_url('dept/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						<?php endif ?>
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
					<div class="card-header"><strong>DEPARTMENT</strong></div>

	          <?php  foreach ($all_department_info as $akey => $v_department_info) : ?>                                
            

					<div class="card-header"><strong><?php echo $all_dept_info[$akey]->department.' - '.$all_dept_info[$akey]->id_dept ?> 
					<div class="float-right"> 
						<a href="<?= base_url('dept/ubah/' . $all_dept_info[$akey]->id_dept) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i> Ubah</a>
					</div>
                          </strong>
					 </div>
					
						<div class="table-responsive">
							<table class="table table-bordered"  width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th class="col-sm-1">Department</th>  
                                   
                                    <th>Jabatan</th>                                            
                                </tr>
                            </thead>
								  <tbody>                                                        
                                <?php foreach ($v_department_info as $key => $v_department) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $v_department->department ?></td>
                                        <td><?php echo $v_department->divisi ?></td>                                                

                                    </tr>
                                    <?php  endforeach; ?>
                                                           
                        </tbody>
							</table>
						</div>         <?php endforeach; ?>
		
     
							
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>