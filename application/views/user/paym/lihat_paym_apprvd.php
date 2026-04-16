<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        scrollX: true,
    });
});
</script>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
        "lengthMenu": [ 5,10, 25, 50, 75, 10
    });
</script>
 <style>
    /* The container */
    .container12 {
      display: block;
      position: relative;
      padding-right: 35px;
      margin-bottom: 6px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
.center {
  position: absolute;
  top: 50%;
  width: 100%;
  text-align: center;
  font-size: 18px;
}
    /* Hide the browser's default checkbox */
    .container12 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 15px;
      width: 15px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container12:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container12 input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container12 input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container12 .checkmark:after {
      left: 3px;
      top: 1px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(25deg);
      -ms-transform: rotate(25deg);
      transform: rotate(25deg);
    }
    </style>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
				
                            <a href="<?= base_url('user/payment/add_pay/') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
					
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
					<div class="card-header"><strong><?= $title ?> /<font color="blue"> <a href="<?php echo base_url(); ?>user/payment/finish_"> Cetak Laporan</a></font></strong></div>
   <div class="panel-body">
    <form method="post" action="<?= base_url('mom/lihat_filter') ?>" class="form-horizontal">  
        <div class="panel_controls">                         
    <!--          <div class="form-group">
           </br>

 <div class="col-sm-5">                             
                 <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($all_leads_project as $lsp) : ?>
                                <option value="<?php echo $lsp->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $lsp->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option>
                                    <?php endforeach; ?>

                        </select>  
            </div>
            </div>
          
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-primary">Cari</button>  
            <a href="<?= base_url('mom/lihat_semua') ?>"> 
            <input type="button" class="btn btn-primary" value="Semua" \></a>                           
        </div> -->

    </div>
    </form>  
</div>  
					<div class="card-body">

                       <form action="<?= base_url('payment/update_payment_cek_user') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td><font size="2px">No Spk</font></td>
										<td width="50"><font size="2px">Tanggal</font></td>
										<td width="100"><font size="2px">Project</font></td>
                                        <td ><font size="2px">Vendor</font></td>
                                        <td width="60"><font size="2px">Jumlah</font></td>

                                        <td width="60"><font size="2px">Keterangan</font></td>
									<!--	<td>Pdf</td> -->
									   <td width="60"  style="text-align: center;">   
      <input  type="checkbox" onclick="toggled(this);" > Paid
  
 </td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_paym as $pay): ?>
										<tr>
											<td><font size="1px"><?= $no++ ?></font></td>
											<td><font size="2px"><?= $pay->no_spk ?></font>
                                              <input type="text" class="form-control" hidden  name="id_payment[]" value="<?= $pay->id_payment ?>" > </td>
											<td ><font size="2px"><?= $pay->tgl_payment ?></font></td>
											<td><font size="2px"><?= $pay->nama_project ?></font></td>
                                            <td><font size="2px">&nbsp;<?= $pay->nama_vendor ?>
                                            <br>&nbsp;<?= $pay->atas_nama_bank ?>
                                            <br>&nbsp;<?= $pay->norek_vendor .' - '. $pay->nama_bank_vendor ?></font></td>
                                                     <td><font size="2px">       <?php
                                             $hasil_rupiah = " " . number_format($pay->total_payment,0,',','.');
                                              echo $hasil_rupiah; ?></font></td>
                                            <td><font size="2px"><?= $pay->note_payment ?></font></td>

											
												<td><font size="2px">
   <div class="form-check">
    
      <label class="container12" > 
  <input type="checkbox" name="status_approval[]" >
  <span class="checkmark"></span>
</label>
  </div></font>
												</td>
										
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>         <br>
                                    <div class="form-group ">
                                        <div class="bg-light text-right">
                                   <button type='submit' class='btn btn-primary' onclick='archiveFunction()'>PROSES</button>
                                 <!--   <button  class='btn btn-danger' id="batal">BATAL</button> -->
                                    </div></div>
                                    <script type="text/javascript">
    $("form").submit(function () {
    var this_master = $(this);
    this_master.find('input[type="checkbox"]').each( function () {
        var checkbox_this = $(this);
        if( checkbox_this.is(":checked") == true ) {
            checkbox_this.attr('value','4');
        } else {
            checkbox_this.prop('checked',true);
            //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
            checkbox_this.attr('value','3');
        }
    })
});

                                    </script></form>
						</div>
					</div>				
				</div>
				</div>
			</div>
<!-- modal update -->
 
<div  class="modal modal-right fade" id="right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/payment/save_laporan') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
                                <div class="form-group col-md-2">
                                            
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kod_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php  $code =  random_string('numeric', 4);
                                            echo 'P'.''.$code ?>"  class="form-control">
                                </div> 
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Metode Pembayaran </label>
                   <select name="header_payment" class="form-control" required>
                            <option value="">PILIH ...</option>

                            <option value="CAHAYA SELARAS AGUNG,PT" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'CAHAYA SELARAS AGUNG,PT' ? 'selected' : '';
                            }
                            ?>>CAHAYA SELARAS AGUNG,PT</option>
                            <option value="VIA BCA 1988" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'VIA BCA 1988' ? 'selected' : '';
                            }
                            ?>>VIA BCA 1988</option>

                            <option value="VIA BCA 3701" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'VIA BCA 3701' ? 'selected' : '';
                            }
                            ?>>VIA BCA 3701</option>
                            </select>
                                </div> 
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Pembayaran</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control" required>
                                </div>   
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">No Spk </label>
                                             <input  type="text"   name="no_spk" placeholder="Masukkan No SPK" autocomplete="off" value=""  class="form-control" required>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Proyek </strong></label>
                            <select  placeholder="Nama Project" name="project_payment" class="form-control" required>
                            <option value="" >PILIH .....</option>
                            <?php foreach ($proyek as $prk) : ?>
                                <option value="<?php echo $prk->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $prk->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $prk->nama_project ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Vendor & No Rek</strong></label>
                            <select  placeholder="Vendor" name="vendor" class="form-control" required>
                            <option value="" >PILIH .....</option>
                            <?php foreach ($vendor as $vn) : ?>
                                <option value="<?php echo $vn->id_ven ?>"
                                 <?php $id_ven = $_POST['id_ven']; ?>
                                <?php
                                if (!empty($id_ven)) {
                                    echo $vn->id_ven == $id_ven ? 'selected' : '';
                                }
                                ?>><?php echo $vn->nama_vendor .' - '.$vn->norek_vendor  ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Almount </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="almount" placeholder="Masukkan Jumlah" autocomplete="off" value=""  class="form-control" required>
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="note_payment" class="form-control " ><?php
			                            if (!empty($employee_info->diskusi)) {
			                                echo $employee_info->diskusi;
			                            }
			                            ?></textarea>
									</div>
                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tambah Laporan Proyek" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdTime_payment" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>
                     

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
    <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
        <script type="text/javascript">
        function toggled(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
    </script>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>