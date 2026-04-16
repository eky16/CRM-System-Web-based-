<?php ini_set('display_errors', 0); ?>
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
			<div id="content" data-url="<?= base_url('sales') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>

					<div class="float-right">


  
						<?php if ($this->session->login['role'] == 'admin'): ?>

					<a href="<?= base_url('sales/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah sales</a>
					<a href="<?= base_url('sales/ubah/' . $sales_id->id_sales) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
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

                                 <a href="<?= base_url('sales') ?>" class="btn btn-info btn-sm"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME </a>

                               </div>
                               <h6 class="m-0 font-weight-bold text-primary"><?= $sales_id->nama_cst ?></h6>
                               <span>Createdby <?= $sales_id->creatby_cst .' - '. $sales_id->creattime_cst    ?></span> 
                             </div>
                             
                           </div>
				</div>



        <!-- Content Column -->

        <div class="col-lg-12 mb-4">

          <!-- Illustrations -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">INFORMASI SALES</h6>
            </div>
            <div class="card-body">
             <div class="form-row">
              <div class="form-group col-md-4">
                <font size="2px">	<label for="kode_barang"><strong>ID</strong>
                </label>
              </div>
              <div class="form-group col-md-5">:
               <?= $sales_id->kode_sales ?></font>
             </div>
             <div class="form-group col-md-4">
              <font size="2px">		<label for="kode_barang"><strong>Nama Sales</strong>
              </label>
            </div>
            <div class="form-group col-md-5">:
             <?= $sales_id->nama_sales ?></font>
           </div>

        <div class="form-group col-md-4">
         <font size="2px">	<label for="kode_barang"><strong>Status </strong>
         </label>
       </div>
       <div class="form-group col-md-5">:
         <?php
         if ($sales_id->status_sales == 'aktif') {
          echo '<a class="btn btn-success btn-sm" style="color:white"><font size="2px">AKTIF</font></a> ';
        } 
        else {

          echo '<a class="btn btn-danger btn-sm" style="color:white">NON - AKTIF</a>';
        }
      ?></font>
    </div> 	
  </div>
</div>
</div>

</div>
</div>

  </div> 
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>

	</div>
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
    url:"<?php echo base_url(); ?>sales/delete_all_daily",
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
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>
</html>