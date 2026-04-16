<?php ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    <style>
        .removeRow
{
 background-color: #D1D1D1;
    color:#FFFFFF;
}
    /* The container */
    .container12 {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 6px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
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
.file-upload {
  background-color: #A9A9A9;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #A9A9A9;
  border: none;
  padding: 7px;
  border-radius: 4px;
  border-bottom: 4px solid #A9A9A9;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #adade2;
  color: #636367;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #636367;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #eff0f5;
  border: 4px dashed #3336ff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #aaabc2;
  padding: 10px 0;
}

.file-upload-image {
 width: 70%;
  height: auto;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 50%;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 200;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
#hidden_tgl {
    display: none;
}
    </style>

  
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('pengeluaran') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					
				     <button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button> 
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
					<div class="card-header"><strong><?= $title ?> - <?= $hd_pr->created_po ?>, <?= $hd_pr->createdtime_po ?></strong>
					      <div class="float-right">
					<a href="<?= base_url('user/pembelian/list_pengiriman') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Pengiriman </a>
				</div></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-5">
									<div class="table-responsive">
								<table class="table table-borderless">
									<tr>
										<td><strong>No </strong></td>
										<td width="5">:</td>
										<td><?= $hd_pr->number_ ?></td>
									</tr>
									<tr>
										<td><strong>Tanggal</strong></td>
										<td>:</td>
										<td><?= $hd_pr->transDate ?></td>
									</tr>
									<tr>
										<td><strong>Project</strong></td>
										<td>:</td>
										<td><?= $hd_pr->nama_project ?></td>
									</tr>
									<tr>
										<td><strong>Status</strong></td>
										<td>:</td>
										<td>     <?php $status_pr = $hd_pr->status_po  ?>
                                            <?php if ($status_pr == 1):?>
                                              <span class="badge badge-warning">PR- Menunggu Approval PM </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 2):?>
                                              <span class="badge badge-info">PR- Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 3):?>
                                            <span class="badge badge-info">Purchasing Mencari Supplier </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 4):?>
                                            <span class="badge badge-info">PR Settle -Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 5):?>
                                            <span class="badge badge-primary">PR Settle- Menunggu Approval Direksi</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 6):?>
                                            <span class="badge badge-primary">Menunggu Barang dikirim dari supplier</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 7):?>
                                            <span class="badge badge-success">Barang sudah diterima</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 8):?>
                                            <span class="badge badge-danger">Barang direject</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 9):?>
                                            <span class="badge badge-secondary">Klaim, Barang Tidak Sesuai</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 10):?>
                                            <span class="badge badge-info">Proses Pengiriman Ulang </span>
                                            <?php endif;?></td>
									</tr>
                        <?php if ($hd_pr->status_po == 10):?>
                  <tr>
                    <td><strong>Tanggal Pengiriman</strong></td>
                    <td>:</td>
                    <td><?= $hd_pr->tgl_return ?></td>
                  </tr><?php endif ;?>
									<?php if (!empty($hd_pr->vendorNo)):?>
									<tr>
										<td><strong>Pemasok</strong></td>
										<td>:</td>
										<td><?= $hd_pr->vendorNo ?></td>
									</tr><?php endif ;?>
								</table></div>
							</div>
                        <div class="col-md-5">
                  <div class="table-responsive">
                <?php $cek_pembuat_po = $hd_pr->created_po;
                      $cek_session    = $this->session->login['nama'];?>    
               <?php if($hd_pr->status_po != 7 and $cek_pembuat_po == $cek_session):?>     
                <table class="table table-borderless">
                  <form action="<?= base_url('user/pembelian/proses_terima_barang') ?>"  enctype="multipart/form-data" id="aksi_terima" method="POST">
                  <tr>
                    <td width="100"><strong> Status Barang </strong></td>
                    <td width="1">:</td>
                    <td><select name="status_po" class="form-control"  id="combo_jenis" onchange="showTgl('hidden_tgl', this)" required>
                            <option value="" >Pilih ...</option>
                            <option value="7" <?php
                            if (!empty($hd_pr->status_po)) {
                                echo $hd_pr->status_po == '7' ? 'selected' : '';
                            }
                            ?>>Terima Barang</option>
                            <option value="9" <?php 
                            if (!empty($hd_pr->status_po)) {
                                echo $hd_pr->status_po == '9' ? 'selected' : '';
                            }
                            ?>>Klaim</option>
                            </select></td>
                  </tr>
                  <tr id=vs1>
                    <td width="140" ><strong>   </strong></td>
                    <td width="5"></td>
                    <td> <div class="input-group mb-3" >
                          <div class="input-group-prepend">
                          <span class="input-group-text">Surat Jalan </span>
                          </div>
                          <input type="file" name="surat_jalan"  class="form-control" placeholder="" >
                    </div></td>
                  </tr>
                   <input type="text" name="number_" hidden value="<?php  echo $hd_pr->number_ ;?>" class="form-control" placeholder="" >

                  <tr >
                    <td><strong>Aksi</strong></td>
                    <td></td>
                    <td id="hidden_tgl" id="vs2">  <button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>&nbsp;&nbsp; Proses</button></td>
                  </tr>

      
          </form>
                </table><?php endif;?>
                <?php $cek_div = $emp->department; ?>
                 <?php  if($hd_pr->status_po == 9 and $cek_div == 'Purchasing'):?>     
                <table class="table table-borderless">
                  <form action="<?= base_url('user/pembelian/proses_return_barang') ?>"  enctype="multipart/form-data" id="aksi_terima" method="POST">
                  <tr>
                    <td width="100"><strong> Status Barang </strong></td>
                    <td width="1">:</td>
                    <td width="800"><select name="status_po" class="form-control"  id="combo_jenis" onchange="showTgl('hidden_tgl', this)" required>
                            <option value="" >Pilih ...</option>
                            <option value="10" <?php
                            if (!empty($hd_pr->status_po)) {
                                echo $hd_pr->status_po == '10' ? 'selected' : '';
                            }
                            ?>>Jadwalkan Ulang Pengiriman Barang Tidak Sesuai</option>
                            <option value="9" <?php 
                            if (!empty($hd_pr->status_po)) {
                                echo $hd_pr->status_po == '9' ? 'selected' : '';
                            }
                            ?>>Menunggu</option>
                            </select></td>
                  </tr>
                  <tr id=vs1>
                    <td width="140" ><strong>   </strong></td>
                    <td width="5"></td>
                    <td> <div class="input-group mb-3" >
                          <div class="input-group-prepend">
                          <span class="input-group-text">Tanggal Pengiriman </span>
                          </div>
                          <input type="date" name="tgl_return"  class="form-control" placeholder="" >
                    </div></td>
                  </tr>
                   <input type="text" name="number_" hidden value="<?php  echo $hd_pr->number_ ;?>" class="form-control" placeholder="" >

                  <tr >
                    <td><strong>Aksi</strong></td>
                    <td></td>
                    <td id="hidden_tgl" id="vs2">  <button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>&nbsp;&nbsp; Proses</button></td>
                  </tr>

      
          </form>
                </table><?php endif;?>
    <?php if($hd_pr->status_po == 7):?>     
                <table class="table table-borderless">
                
                  <tr>
                    <td width="140"><strong> Surat Jalan </strong></td>
                    <td width="5">:</td>
                    <td><a target="blank" href="<?php echo base_url(); ?>img/uploads/<?= $hd_pr->surat_jalan ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i>&nbsp;Lihat</a></td>
                  </tr>
                  <tr>
                    <td width="140"><strong> Penerima </strong></td>
                    <td width="5">:</td>
                    <td><?= $hd_pr->update_po_by ?></td>
                  </tr>
                  <tr>
                    <td width="140"><strong> Waktu </strong></td>
                    <td width="5">:</td>
                    <td><?= $hd_pr->updateTime_po ?></td>
                  </tr>

                </table><?php endif;?>
       <script>
$(document).ready(function(){ 

  $("select[id=combo_jenis]").on("change", function() { 
    if ($(this).val() === "" || $(this).val() === "9" ) {
      $("tr[id=vs1]").hide(); 
    } else { 
      $("tr[id=vs1]").show();
    } 
  }); 
  $("select[id=combo_jenis]").trigger("change");
 
});
</script>
              <script type="text/javascript">
    function showTgl(divId, element)
{
    document.getElementById(divId).style.display = element.value != "" ? 'block' : 'none' ;
   
}
</script></div>
              </div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											
	
											<td width="10"><strong>Id</strong></td>
											<td><strong>Nama Barang</strong></td>
											<td width="10"><strong>Jumlah</strong></td>
											<td><strong>Keterangan</strong></td>
											
											<td width="150"><strong>Harga</strong></td>
											<td width="50"><strong>Disc %</strong></td>
											<td width="150"><strong>Total Harga</strong></td>
											<td width="100"><strong>Status</strong></td>

											<td width="100"><strong>Aksi</strong></td>
											</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($dt_pr as $row): ?>
											<tr>
												
												<td><?= $row->id_dt ?></td>
												<td><?= $row->detailName ?></td>
												<td align="center"><?= $row->quantity ?></td>
												<td><?= $row->detailNotes ?></td>
								
												<td>
													<?php if(!empty($row->unitPrice)):?>
													<?php
                                                 $hasil_rupiah = "Rp " . number_format($row->unitPrice,0,',','.');
                                                  echo $hasil_rupiah; ?> <?php endif;?>
												</td>
												<td><?= $row->itemDiscPercent ?></td>
												<td> 
													<?php if(!empty($row->unitPrice)):?>
													<?php 
													
													if (!empty($row->itemDiscPercent)) {
														$disc = $row->itemDiscPercent;
													}else{
														$disc = 0;
													}
												$harga = $row->unitPrice * $row->quantity;
												
												$hasilnya_disc = $harga * $disc / 100 ;
												$total_harga = $harga - $hasilnya_disc;
												
												$hasil_rupiah = "Rp " . number_format($total_harga,0,',','.');
                                                  echo $hasil_rupiah;
												?><?php endif;?>
													
												</td>
												<td> <?php if ($row->status_item == "Sesuai"):?>
                                              <span class="badge badge-success">Sesuai </span>
                                            <?php endif;?>
                                            <?php if ($row->status_item == "Tidak Sesuai"):?>
                                            <span class="badge badge-danger">Tidak Sesuai </span>
                                            <?php endif;?>
                         </td>
												<td><a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ubah</a> </td>
											</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Detail PO <?php echo $row->id_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/pembelian/ubah_po_dt') ?>" enctype="multipart/form-data" id="from2" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                         
                            <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                             <input  type="text" readonly maxlength="50"  name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Jumlah</span></label>
                                             <input  type="number" readonly maxlength="50"  name="quantity" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->quantity; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Keterangan</span></label>
                                            <textarea class="form-control" readonly name="detailNotes"><?php echo $row->detailNotes; ?></textarea>
                                  
                                </div> 
                              <?php if(!empty($row->unitPrice)):?>  
                              <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Harga </span></label>
                                             <input  type="text" maxlength="50" readonly onkeypress="return hanyaAngka(event)" name="unitPrice" placeholder="Harga" autocomplete="off" value="<?php echo $row->unitPrice; ?>"  class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Disc % </span></label>
                                             <input  type="number" maxlength="50" readonly name="itemDiscPercent" placeholder="%" autocomplete="off" value="<?php echo $row->itemDiscPercent; ?>" min="0" class="form-control">
                                </div><?php endif ?>

                               <?php if (!empty($row->foto)):?>
                                <div class="form-group col-md-12">
                                <label for="nama_barang">Foto Barang </label>
                               <a target="blank" href="<?php echo base_url(); ?>img/uploads/<?= $row->foto ?>">   <img  src="<?php echo base_url(); ?>img/uploads/<?= $row->foto ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div><?php endif; ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Upload Foto </label>

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="berkas" onchange="readURL(this);" accept="image/*"  required />
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>

 <div class="form-group col-md-12">
   <label for="nama_barang">Status : </label>
 <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_item" value="Sesuai" <?php if($row->status_item == 'Sesuai'){echo 'checked';}?>>Sesuai
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_item" value="Tidak Sesuai" <?php if($row->status_item == 'Tidak Sesuai'){echo 'checked';}?>>Tidak Sesuai
  </label>
</div>



                                </div>
                              <div class="form-group col-md-12">
                                            <label for="nama_barang">Keterangan</label>
                                             <textarea name="status_item_noted" class="form-control"><?php echo $row->status_item_noted; ?></textarea>  
                                </div>
                               <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
                               <input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
                               <input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_; ?>" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

       <div class="form-group col-12">
                                <?php if($hd_pr->status_po != 7):?>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
                                    <?php else:?>
                                      <button type="submit" disabled class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Pesanan Telah Selesai</button>
                                    <?php endif;?>
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
										<?php endforeach ?>
									</tbody>
								</table> </div>

							</div>
							<br><br>
								<div class="col-md-12">
								<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<td width="155" ><font size="2">Waktu</font></td>
											<td width="250"><font size="2">Keterangan</font></td>
											<td width="200"><font size="2">Nama</font></td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($his_pr as $row): ?>
											<tr>
												<td><font size="2"><?= $row->actiontime ?></font></td>
												<td><font size="2"><?= $row->status ?></font> </td>
												<td><font size="2"><?= $row->action_by ?></font> </td>
											</tr>
									<?php endforeach ?>
									</tbody>
								</table></div>
							</div>
<div class="form-group col-12">
	 <div class="bg-light text-right">
<form action="<?= base_url('user/pembelian/proses_approve_pr') ?>" enctype="multipart/form-data" id="from1" method="POST">

	<input type="text" name="id" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>
	<input type="text" name="number_" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_; ?>" hidden>
	<?php  	$cek_jabatan 	= $emp->divisi.' '.$emp->department;
			$cek_status_pr 	= $hd_pr->status_po; ?>

	<?php if($cek_jabatan == 'Manager Project' and $cek_status_pr == 1):?>
	<input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="2" hidden>
	<input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="PM Mengetahui" hidden>  
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;PM Approve</button>
	 <?php endif;?>

	<?php if($cek_jabatan == 'Staff Qs' and $cek_status_pr == 2):?>
	<input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="3" hidden>
	<input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="Estimator Mengetahui" hidden>  
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Estimator Approve</button>
	<?php endif;?>
		<?php if($cek_jabatan == 'Staff Qs' and $cek_status_pr == 4):?>
	<input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="5" hidden>
	<input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="Estimator Mengetahui" hidden>  
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Estimator Approve</button>
	<?php endif;?>
    	<?php if($cek_jabatan == 'Manager Purchasing' or $cek_jabatan == 'Staff Purchasing' and $cek_status_pr == 3):?>
	 <a  onclick="return confirm('Lanjut ?')" href="<?= base_url('user/pembelian/kelengkapan_pr/' . $hd_pr->id ) ?>"  class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Lengkapi Data PR</a>
	<?php endif;?> 	
 </form>
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
    url:"<?php echo base_url(); ?>user/pembelian/delete_detail_pr",
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
 <script>
    document.querySelector('#from1').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Status PR akan berubah setelah anda Setujui!",
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
              text: 'PR Approved!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "PR tidak ada perubahan :)", "error");
          }
        });
    });
  </script>
   <script>
    document.querySelector('#from2').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Data PO akan diubah!",
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
              text: 'PR Detail Berhasil diubah!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Data tidak diupdate :)", "error");
          }
        });
    });

        document.querySelector('#aksi_terima').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Status PO akan diubah!",
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
              text: 'PO Berhasil diubah!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Data tidak diupdate :)", "error");
          }
        });
    });

        function validateForm() {
                if (document.forms["formcek2"]["status_po"].value == "") {
                alert("Error, Data Harus Diisi ");
                document.forms["formcek2"]["status_po"].focus();
                return false;
            }
        }
  </script>

</body>
</html>