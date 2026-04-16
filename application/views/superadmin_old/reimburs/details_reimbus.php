<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
       <style type="text/css">
body {
  font-family: sans-serif;

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
					<div class="card-header"><strong>LIST REIMBURSEMENT  </strong></div>


					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered"   width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                  <th >No</th>
                                    <th class="col-sm-2">Karyawan</th>
                                    <th class="col-sm-2">Jenis</th>
                                    <th width="200">Nama Project</th>
                                    <th width="140">Rincian</th>
                                     <th width="120">File Diterima</th>  
                                    <th  width="100">Status</th>

                        
                                    <th width="120" align="center">Aksi</th>     
                                </tr>
                            </thead>
								  <tbody>                                                        
                               <?php  foreach ($all_department_info as $akey => $v_department_info) : ?>                                                       
                                <?php foreach ($v_department_info as $key => $v_department) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $v_department->user_reimbus ?></td>
                                        <td><?php echo $v_department->kategori_reimburs ?></td>
                                         <td><?php echo $v_department->name_project ?></td>
                                        <td><?php
                                             $hasil_rupiah = "Rp " . number_format($v_department->nominal,2,',','.');
                                              echo $hasil_rupiah; ?></td>
                                        <td><?php echo $v_department->tgl_file_diterima ?></td>
                                        <td><?php echo $v_department->status_cek ?></td>
                      
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $v_department->id_sub; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a>
									</td>                                       
                                    </tr>
<!-- modal update -->	

<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $v_department->id_sub; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Reimbursement : <?php echo $v_department->kategori_reimburs; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('reimburs/save_proses_cek') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $v_department->user_reimbus; ?>. <?php echo $v_department->createddate_reimbus; ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->id_sub.' - '.$v_department->kode_reimbus; ?>"  class="form-control">
                             <input hidden type="text" maxlength="50" readonly name="id_sub" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->id_sub; ?>"  class="form-control">
                                       <input hidden type="text" maxlength="50" readonly name="kode_reimbus" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->kode_reimbus; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Jenis </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kategori_reimburs" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->kategori_reimburs; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama proyek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->name_project; ?>"  class="form-control">
                                </div>

<?php if($v_department->kategori_reimburs == "BENSIN (Kendaraan Pribadi)" ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kilometer Awal </label>
                                          <a target="blank" href="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>">   <img  src="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Kilometer Akhir </label>
                               <a target="blank" href="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_km_after ?>">   <img  src="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_km_after ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Kilometer </label>
                                             <input  type="text" maxlength="50" id="userkm" readonly name="total_km" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->total_km; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Jarak KM/Liter </label>
                                             <input  type="text" maxlength="50" onkeyup="sum();" id="totalkm" name="Jarak" placeholder=" KM/Liter" autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> Hasil </label>
                                             <input  type="text" readonly  id="hasilnya"  maxlength="50"  name="total_jarak" placeholder=" ... " autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Harga PerLiter </label>
                                             <input  type="text" maxlength="50" onkeyup="sum();" id="harga" name="" placeholder=" Masukan Harga Perliter " autocomplete="off" value=""  class="form-control">
                                </div> 

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total </label>
                                             <input  type="text" maxlength="50" readonly id="total" name="" placeholder=" Liter/KM " autocomplete="off" value="<?php
                        if (!empty($v_department->nominal)) {
                            echo $v_department->nominal;
                        }
                        ?>"  class="form-control">
                                                     <input  type="text" hidden maxlength="50" id="totall" name="nominal" placeholder=" Liter/KM " autocomplete="off" value="<?php
                        if (!empty($v_department->nominal)) {
                            echo $v_department->nominal;
                        }
                        ?>"  class="form-control">
                                </div>
         
<script>
const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number);
  }
function sum() {

        var userkm = document.getElementById('userkm').value;
        var txtFirstNumberValue1 = document.getElementById('totalkm').value;
        var hasilnya = parseInt(userkm)  / parseInt(txtFirstNumberValue1);

       // var hasilkm = document.getElementById('hasilnya').value;
        var harga = document.getElementById('harga').value;
        var total = parseInt(userkm)  / parseInt(txtFirstNumberValue1)  * parseInt(harga);
        var totall = parseInt(userkm)  / parseInt(txtFirstNumberValue1)  * parseInt(harga);
        if (!isNaN(hasilnya)) {
         document.getElementById('hasilnya').value = hasilnya;
      }
            if (!isNaN(total)) {
         document.getElementById('total').value = rupiah(total.toFixed(0));
}
              if (!isNaN(totall)) {
         document.getElementById('totall').value = totall.toFixed(0);
      }

}
</script>   
                            <?php endif; ?>

<?php if($v_department->kategori_reimburs != "BENSIN (Kendaraan Pribadi)" ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Foto </label>
                                         <a target="blank" href="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>">   <img  src="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>

                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($v_department->nominal,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                </div>
                <?php if(!empty($v_department->nominal_tf)):?>
                  <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal Transfer </label>
                                             <input  type="text" maxlength="20"  name="nominal_tf" placeholder="Masukkan Nama Lengkap" autocomplete="off" 
                                             value="<?php echo $v_department->nominal_tf; ?>"  class="form-control">
                                </div>
                        <?php else: ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal Transfer </label>
                                             <input  type="text" maxlength="20"  name="nominal_tf" placeholder="Masukkan Nama Lengkap" autocomplete="off" 
                                             value="<?php echo $v_department->nominal; ?>"  class="form-control">
                                </div> <?php endif; ?>  <?php endif; ?>
                                
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea readonly name="keterangan_proyek" class="form-control" ><?php
			                            if (!empty($v_department->keterangan)) {
			                                echo $v_department->keterangan;
			                            }
			                            ?></textarea>
									</div>
                                <div class="form-group col-12">
                                            <label>Catatan</label>
                                            <textarea  name="catatan" class="form-control" ><?php
                                        if (!empty($v_department->catatan)) {
                                            echo $v_department->catatan;
                                        }
                                        ?></textarea>
                                    </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Status : </label>
 <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_cek" value="Pending" <?php if($v_department->status_cek == 'Pending'){echo 'checked';}?>>Pending
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_cek" value="OK" <?php if($v_department->status_cek == 'OK'){echo 'checked';}?>>OK
  </label>
</div>
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_cek" value="Fail" <?php if($v_department->status_cek == 'Fail'){echo 'checked';}?>>Fail
  </label>
</div> 

                                </div>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>
                       <?php if($v_department->status_reimbus == 3 OR $v_department->status_reimbus == 4) : ?>                 
                                <div class="form-group">
                                        <button disabled type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Sesi Telah Selesai</button>
                                    </div>
                       <?php else: ?>
                             <div class="form-group">
                                        <button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    </div>
                        <?php endif; ?>
   
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
</div>
                                   <?php  endforeach; ?>   <?php endforeach; ?>
                                                           
                        </tbody>
							</table>
                            <table class="table table-bordered"   width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                     <?php foreach ($hitung_reimbus as $key => $total) : ?>
                                    <th class="col-sm-1"><?php echo $total->total_reimburs ?></th>
                                    <th class="col-sm-2"><?php
                                             $hasil_rupiah = "Rp " . number_format($total->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?></th>
                                               <th class="col-sm-1" align="center">
         <?php if($total->status_reimbus == 3 OR $total->status_reimbus == 4) : ?>

                <a  data-toggle="modal" style="color:white" data-target="#right_modalcek<?php echo $total->kode_reimbus; ?>" class="btn btn-info btn-sm"><i class="fa fa-check-circle" style="font-size:15px;color:green"></i>&nbsp;<i class="fa fa-credit-card"></i>&nbsp;&nbsp;Telah Di Transfer</a>
        <?php else: ?>                                      
            <a  data-toggle="modal" style="color:white" data-target="#right_modalpay<?php echo $total->kode_reimbus; ?>" class="btn btn-info btn-sm"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Upload Bukti Bayar</a>
               <?php endif; ?>     
         <?php if( $total->status_reimbus == 4) : ?>

                <a  data-toggle="modal" style="color:white" data-target="" class="btn btn-success btn-sm"><i class="fa fa-check-circle" style="font-size:15px;color:green"></i></a>
               <?php endif; ?>     
        </th>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalcek<?php echo $total->kode_reimbus; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Bukti Transfer : <?php echo $total->kode_reimbus; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('reimburs/save_proses_pengecekan') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $total->user_reimbus; ?>. <?php echo $total->createddate_reimbus; ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_reimbus" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->kode_reimbus; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama Karyawan </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->user_reimbus; ?>"  class="form-control">
                                </div>
                             <!--   <div class="form-group col-md-12">
                                            <label for="nama_barang">Bank & No Rek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->bank.' - '.$total->no_rek; ?>"  class="form-control">
                                </div> -->
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama proyek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->name_project; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Harus Dibayar  </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($total->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                </div>

                     <?php if($total->status_reimbus == 2) : ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bukti Transfer </label>
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
      <input type="hidden" name="old_path" value="<?php
                                if (!empty($employee_info->photo_a_path)) {
                                    echo $employee_info->photo_a_path;
                                }
                                ?>">
  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="berkas" onchange="readURL(this);" accept="image/*" />
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
  <?php else: ?> 

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bukti Transfer </label>
                                          <a target="blank" href="<?php echo base_url(); ?>img/uploads/<?= $total->bukti_bayar ?>">   <img  src="<?php echo base_url(); ?>img/uploads/<?= $total->bukti_bayar ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                
     <?php endif; ?>
      <?php if($total->status_reimbus == 3 OR $total->status_reimbus == 4) : ?>
                    <div class="form-group col-md-12">
                                            <label for="nama_barang">Metode Pembayaran </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->metode_pembayaran; ?>"  class="form-control">
                                </div>
            <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Pembayaran </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->tgl_transfer_real; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">TransferBy </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->user_bayar; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tgl Proses </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->tgl_bayar; ?>"  class="form-control">
                                </div>

         <?php endif; ?>
               <?php if($total->status_reimbus == 4) : ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Cek By </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->end_apprv; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tgl Cek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->end_time_apprv; ?>"  class="form-control">
                                </div>

         <?php endif; ?>
                                

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>
            <?php if($total->status_reimbus == 2) : ?>
           <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    </div>
        <?php else: ?> 

         <div class="form-group col-md-12">                                     
          <div class="form-group">
                                        <button disabled type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;Sudah Ditransfer</button>
                                    </div></div>
               <?php endif; ?>                      
                              <?php if($this->session->login['akses'] == "finance") : ?>
                                <div class="form-group col-md-12">
                                         <?php if($total->status_reimbus == 3) : ?>
                                            <label for="nama_barang">Pengecekan : </label>
                                    
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_cek" value="OK" <?php if($v_department->total == '4'){echo 'checked';}?>>OK
  </label>
</div>
<div class="form-check-inline disabled">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status_cek" value="Fail" <?php if($v_department->total == '5'){echo 'checked';}?>>Fail
  </label>
</div> 

    <div class="form-group">
                                        <button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                                    </div>   <?php endif; ?>

                                </div>
                                <?php endif; ?>
   
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
</div>

<div  class="modal modal-right fade" id="right_modalpay<?php echo $total->kode_reimbus; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Bukti Transfer : <?php echo $total->kode_reimbus; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('reimburs/save_proses_transfer') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $total->user_reimbus; ?>. <?php echo $total->createddate_reimbus; ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_reimbus" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->kode_reimbus; ?>"  class="form-control">
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama Karyawan </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="namekar1" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->user_reimbus; ?>"  class="form-control">
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">keterangan</label>
                                             <textarea onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="keterangan2" placeholder="Masukkan Nama Lengkap" autocomplete="off"  class="form-control"><?php echo $total->keterangan; ?> </textarea>
                                </div>
                            <!--    <div class="form-group col-md-12">
                                            <label for="nama_barang">Bank & No Rek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->bank.' - '.$total->no_rek; ?>"  class="form-control">
                                </div> -->
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama proyek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->name_project; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Harus Dibayar  </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($total->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                </div>
                                    <div class="form-group col-md-12">
                                            <label for="nama_barang">Metode Pembayaran </label>
                           <select name="metode_pembayaran" id="metod_pembayaran" class="form-control"  onchange="showTgl('hidden_tgl', this)" required>

                                        <option value="">Pilih.....</option>
                                        <option value="Petty Cash" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'Petty Cash' ? 'selected' : '';
                                        }
                                        
                                        ?>>Petty Cash</option>
                                        <option value="Dll" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'Dll' ? 'selected' : '';
                                        }
                                        ?>>Dll</option>
                                    </select>
                                            
                                </div>
                                 <div class="form-group col-12" id="hidden_tgl">
                                            <label>Saldo Petty Cash</label>
                                        <input  type="text" maxlength="50" readonly name="" placeholder="Saldo Petty Cash" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($petty_cash->saldo,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                        
                                        <input onkeyup="this.value = this.value.toUpperCase()" hidden type="text" maxlength="50" readonly id="" name="tgl_reinburs" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo date('Y-m-d', strtotime($total->createddate_reimbus)); ?>"  class="form-control">
                                        <input onkeyup="this.value = this.value.toUpperCase()" hidden type="text" maxlength="50" readonly id="total_bayar" name="total_bayar" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                              echo $total->total_reimburs; ?>"  class="form-control">
                                        <input onkeyup="this.value = this.value.toUpperCase()" hidden type="text" maxlength="50" readonly id="saldo_petty" name="saldo_petty" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                              echo $petty_cash->saldo; ?>"  class="form-control">
                                </div>
                                       

<script type="text/javascript">
    function showTgl(divId, element)
{
    document.getElementById(divId).style.display = element.value !== "Dll" ? 'block' : 'none' ;
   
}
</script>
                     <?php if($total->status_reimbus == 2) : ?>
                         <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Transfer  </label>
                                             <input  type="date" maxlength="50" id="tgl_transfer_real" name="tgl_transfer_real" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bukti Transfer </label>
      <input type="hidden" name="old_path" value="<?php
                                if (!empty($employee_info->photo_a_path)) {
                                    echo $employee_info->photo_a_path;
                                }
                                ?>">
  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="berkas" onchange="readURL(this);" accept="image/*" />
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
  <?php else: ?> 

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bukti Transfer </label>
                                          <a target="blank" href="<?php echo base_url(); ?>img/uploads/<?= $total->bukti_bayar ?>">   <img  src="<?php echo base_url(); ?>img/uploads/<?= $total->bukti_bayar ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                
     <?php endif; ?>
      <?php if($total->status_reimbus == 3) : ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">TransferBy </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->user_bayar; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tgl Transfer </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->tgl_bayar; ?>"  class="form-control">
                                </div>

         <?php endif; ?>
                                

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>
            <?php if($total->status_reimbus == 2) : ?>
           <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    </div>
        <?php else: ?>                                      
          <div class="form-group">
                                        <button disabled type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;Sudah Ditransfer</button>
                                    </div>
               <?php endif; ?>                      
                            
   
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
</div>
                                    <?php  endforeach; ?>
                                </tr>
                            </thead>
                                 </table>
						</div> </div>      

     
							
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