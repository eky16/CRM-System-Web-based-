<!DOCTYPE html>
<html lang="en">
<head>

  <?php $this->load->view('user/partials/head.php') ?>
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
.file-upload-input1 {
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

label.cameraButton {
  display: inline-block;
  margin: 1em 0;

  /* Styles to make it look like a button */
  padding: 0.5em;
  border: 2px solid #666;
  border-color: #EEE #CCC #CCC #EEE;
  background-color: #DDD;
}

/* Look like a clicked/depressed button */
label.cameraButton:active {
  border-color: #CCC #EEE #EEE #CCC;
}

/* This is the part that actually hides the 'Choose file' text box for camera inputs */
label.cameraButton input[accept*="camera"] {
  display: none;
}

}
.besar {
    line-height: 40px;
}
    </style>


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
            <h1 class="h3 m-0 text-gray-800"><?= $title ?> - <?php echo  $this->session->login['nama'] ?></h1>
          </div>
          <div class="float-right "> 
            
        
<?php 
$cek = $cek_absen->cek_in;
if ($cek < "00:00") : ?>
  <p>
          <a  data-toggle="modal" style="color:white" data-target="#cek_in" class="btn btn-primary btn-sm besar">
          <i class="fa fa-sign-in" style="font-size:18px;"></i>&nbsp;&nbsp;Absen Datang</a>
<?php else : ?>
      <a  data-toggle="modal"  style="color:white"   class="btn btn-success btn-sm besar" >
          <i class="fa fa-check " style="font-size:18px;"></i>&nbsp;&nbsp; Anda Sudah Absen Datang </a>
        </p>
<?php endif ?>


<?php 
$cek = $cek_absen->cek_out;
if ($cek < "00:00") : ?>
         <a  data-toggle="modal" style="color:white" data-target="#cek_out" class="btn btn-primary btn-sm"><i class="fa fa-sign-out" style="font-size:18px;color:red"></i>&nbsp;&nbsp;Absen Pulang</a>
<?php else : ?>
      <a  data-toggle="modal"  style="color:white"   class="btn btn-success btn-sm">
          <i class="fa fa-check " style="font-size:18px;"></i>&nbsp;&nbsp; Anda Sudah Absen Pulang </a>
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
          <div class="card-header"><strong>CASSA DESIGN  <a  href="#section1"><font color="blue">Read Me!</font></a><div id="timed"></div></strong></div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered"   width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <td>Id</td>
                    <td>NIK</td>
                    <td>Tanggal</td>
                    <td>Datang</td>
                    <td>Pulang</td>
                    <td>Foto</td>
                    <td>Lokasi</td>
                    <?php if ($this->session->login['role'] == 'admin'): ?>
                      <td>Aksi</td>
                    <?php endif ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($all_absensi as $absn): ?>
                    <tr>
                      <td><?= $absn->id ?></td>
                      <td align="center"><?= $absn->EmployeeID ?></td>
                      <td align="center"><?= $absn->tanggal ?></td>
                      <td align="center"><?= $absn->cek_in ?></td>
                      <td align="center"><?= $absn->cek_out ?></td>
                      <td align="center">
       <?php if (!empty($absn->foto)): ?>
<a target="blank" href="<?php echo base_url(); ?>img/uploads/foto_kehadiran/<?= $absn->foto ?>" title="Menuju halaman google">
  Datang
</a>
 <?php else : ?>
                
                    <strong> - </strong>
              
<?php endif; ?>   /      <?php if (!empty($absn->foto2)): ?>
<a target="blank" href="<?php echo base_url(); ?>img/uploads/foto_kehadiran/<?= $absn->foto2 ?>" title="Menuju halaman google">
  Pulang
</a>

<?php endif; ?>
                      </td>   
                      <td align="center">
                   <?php if (!empty($absn->lokasi)): ?>
                        <a target="blank" href="https://www.google.co.id/maps/place/<?= $absn->lokasi ?>" class="btn btn-primary btn-sm">Datang </a> <?php endif; ?> 
                       <?php if (!empty($absn->lokasi_cekout)): ?>
                        <a target="blank" href="https://www.google.co.id/maps/place/<?= $absn->lokasi_cekout ?>" class="btn btn-primary btn-sm">Pulang </a><?php endif; ?> </td>
                      <?php if ($this->session->login['role'] == 'admin'): ?>
                        <td>
                          <a href="<?= base_url('asset/ubah/' . $asst->id_asset) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                          <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('asset/hapus/' . $asst->kode_asset) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                      <?php endif ?>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>        
        </div>
              <hr>
            <?php if(!empty($isi)):?>
            <div class="card shadow" id="section1">
                    <div class="card-header">
                    <font color="blue"><strong>Read Me !</strong></font></div>

                    <div class="card-body">
                        <?php foreach ($isi as $isi): ?>
                            <?= $isi->isi_sop ?>
                        <?php endforeach ?>
                    </div>
            </div>
            <?php endif; ?>
        </div>
      </div>
    <!-- modal update -->
  <?php
// deteksi IP pribadi
$ip_pribadi=$_SERVER['REMOTE_ADDR'];
// deteksi IP utama
$ip_utama = gethostbyaddr($_SERVER['REMOTE_ADDR']);
// deteksi perangkat
$deteksi_perangkat = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
if($deteksi_perangkat) {
    $perangkat = "Handphone";
}
else {
    $perangkat = "Komputer";
}
// deteksi browser
if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {
    $browser = 'Netscape';
}
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
    $browser = 'Mozilla Firefox';
}
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
    $browser = 'Google Chrome';
}
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
    $browser = 'Opera';
}
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
    $browser = 'Internet Explorer';
}
else {
    $browser = 'Lainnya';
}  
?>

<div id="cek_in" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title"></h4>
        </div>
<form action="<?= base_url('user/dashboard/simpan_cekin') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" name="formcek2" onsubmit="return validateForm2()">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cek In     <div class="float-right " >
                           
                        </div></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NIK </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="EmployeeID" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $emp->EmployeeID ?>"  class="form-control" >
                                </div>

  <textarea id='time_datang' hidden readonly name="cek_in" placeholder="Cek In"  autocomplete="off"   class="form-control" ></textarea> 

 <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tanggal" placeholder="Tanggal"  autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d');  ?>"  class="form-control">

  <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="waktu" placeholder="Waktu"  autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s');  ?>"  class="form-control">
  <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="ket" placeholder="Keterangan"  autocomplete="off" value="Cek In"  class="form-control">

 <input  hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="ip" placeholder="ip_pribadi"  autocomplete="off" value="<?= $ip_pribadi ?>"  class="form-control">
 <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="perangkat" placeholder="perangkat"  autocomplete="off" value="<?= $perangkat ?>"  class="form-control">
 <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="browser" placeholder="browser"  autocomplete="off" value="<?= $browser ?>"  class="form-control">

<!-- untuk Email -->


  <!--  <strong><?php echo "<br>IP address utama anda :</strong> ".$ip_utama;?> -->

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NAMA LENGKAP </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="user" placeholder="Masukkan Nama Lengkap"  autocomplete="off" value="<?= $emp->nama_karyawan ?>"  class="form-control">
                                </div>
                    
                                <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" hidden name="jenis" placeholder="Masukkan Nama Lengkap" readonly  autocomplete="off" value="MASUK"  class="form-control">
                               
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>LOKASI </strong><i><u> <font size="1px"> Reload Halaman  jika maps tidak akurat</font></u></i></label>
                              <textarea id="div_isi4" readonly  name="lokasi" autocomplete="off" class="form-control" required></textarea>
                              <!-- <div id="div_isi"> tampil maps -->
                              </div>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>FOTO </strong></label>
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Gambar Potrait</button>
      
  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="berkas" onchange="readURL(this);" accept="image/*" capture capture id="foto2" />

  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
                                </div>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>
<?php 
 
$hariIni = new DateTime();
$hasil = $hariIni->format('l');
?>
                <!--      <?php
                      $cek_hari  =  $hasil;
                     
                       if($cek_hari == 'Sunday' OR $cek_hari == 'Saturday') :?>                
                                    <div class="form-group col-12">
                                        <button disabled type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Hari Libur</button>
                            
                                    </div>
                                  <?php else: ?>
                                          <div class="form-group col-12">
                                        <button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                            
                                    </div>
                        <?php endif; ?> -->
                                       <div class="form-group col-12">
                       
                    <?php if ($perangkat == 'Komputer'): ?>
                                        <button  type="submit" disabled class="btn btn-danger"><i class="fa fa-"></i>&nbsp;&nbsp;Silahkan Absen Menggunakan Smartphone</button>
                     <?php else: ?>
                    <button  type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>   
                     <?php endif; ?>    
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
  </div> <!-- selesai cek_in asset -->

<div id="cek_out" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title"></h4>
        </div>
<form action="<?= base_url('user/dashboard/simpan_cekout') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" name="formcek" onsubmit="return validateForm()">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cek Out        <div class="float-right " >
                           
                        </div></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NIK </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="EmployeeID" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $emp->EmployeeID ?>"  class="form-control">
                                </div>
  
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>TANGGAL </strong></label>
                                                <input type="text" placeholder="yyyy-mm-dd" id="datepicker_pulang" autocomplete="off" name="tanggal" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d');  ?>"  class="form-control"  required onkeypress='return harusHuruf(event)'>
                                </div>
  
                    
 <textarea id='time_pulang' hidden  name="cek_out" placeholder="Cek Out"  autocomplete="off"   class="form-control" ></textarea> 

<?php
date_default_timezone_set('Asia/Jakarta');
$cek_lembur = date('H:i');
if ($cek_lembur > '18:59'): ?>

<input  type="text" hidden maxlength="50" readonly name="over_time" placeholder="over_time"  autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
$start_date = new DateTime(date('Y-m-d 19:00'));
$end_date =new DateTime(date('Y-m-d H:i:s'));
$h = $end_date->diff($start_date)->h;
$i = $end_date->diff($start_date)->i;
$s = $end_date->diff($start_date)->s;
echo " " . $h . "." . $i;?>"  class="form-control">
<?php endif; ?>




  <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="waktu" placeholder="Waktu"  autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s');  ?>"  class="form-control">
  <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="ket" placeholder="Keterangan"  autocomplete="off" value="Cek Out"  class="form-control">

 <input  hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="ip" placeholder="ip_pribadi"  autocomplete="off" value="<?= $ip_pribadi ?>"  class="form-control">
 <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="perangkat" placeholder="perangkat"  autocomplete="off" value="<?= $perangkat ?>"  class="form-control">
 <input hidden onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="browser" placeholder="browser"  autocomplete="off" value="<?= $browser ?>"  class="form-control">



  <!--  <strong><?php echo "<br>IP address utama anda :</strong> ".$ip_utama;?> -->

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NAMA LENGKAP </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="user" placeholder="Masukkan Nama Lengkap"  autocomplete="off" value="<?= $emp->nama_karyawan ?>"  class="form-control">
                                </div>
                    
                                <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" hidden name="jenis" placeholder="Masukkan Nama Lengkap" readonly  autocomplete="off" value="PULANG"  class="form-control">
                               
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>LOKASI </strong><i><u> <font size="1px"> Reload Halaman  jika maps tidak akurat</font></u></i></label>
                              <textarea id="div_isi2" readonly  name="lokasi" autocomplete="off" class="form-control" required></textarea>
                              
                                </div>
                                  <!--  <div id="div_isi5"> tampil maps -->
                              </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>FOTO </strong></label>
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input1').trigger( 'click' )">Gambar Potrait</button>
      
  <div class="image-upload-wrap">
    <input class="file-upload-input1" type='file' name="foto2" onchange="readURL(this);" accept="image/*" capture id="foto"/>

  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
                                </div>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

                                    <div class="form-group col-12">
                                       <?php if ($perangkat == 'Komputer'): ?>
                                        <button  type="submit" disabled class="btn btn-danger"><i class="fa fa-"></i>&nbsp;&nbsp;Silahkan Absen Menggunakan Smartphone</button>
                     <?php else: ?>
                    <button  type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>   
                     <?php endif; ?>  
                            
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
    
  </div> <!-- selesai cek_in asset -->
      <!-- load footer -->
   
    </div>

  </div>

  <?php $this->load->view('user/partials/js.php') ?>

   <script>
 
function harusHuruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
}
 
 
</script> 

  <script>
        function validateForm() {
                if (document.forms["formcek"]["div_isi2"].value == "error=Network error. Check DevTools console for more information.") {
                alert("Lokasi Error, Cek Kondisi Internet Anda");
                document.forms["formcek2"]["div_isi2"].focus();
                return false;
            }
            if (document.forms["formcek"]["div_isi2"].value == "error=User denied Geolocation") {
                alert("Lokasi Error, Berikan izin Ke Aplikasi untuk mengambil lokasi anda!");
                document.forms["formcek"]["div_isi2"].focus();
                return false;
            }
            if (document.forms["formcek"]["div_isi2"].value == "") {
                alert("Titik Kordinat Tidak Boleh Kosong");
                document.forms["formcek"]["div_isi2"].focus();
                return false;
            }
              if (document.forms["formcek"]["foto"].value == "") {
                alert("Foto Tidak Boleh Kosong");
                document.forms["formcek"]["foto"].focus();
                return false;
            }

        }
</script>

  <script> 
        function validateForm2() {
            if (document.forms["formcek2"]["div_isi4"].value == "error=Network error. Check DevTools console for more information.") {
                alert("Lokasi Error, Cek Kondisi Internet Anda");
                document.forms["formcek2"]["div_isi4"].focus();
                return false;
            }
            if (document.forms["formcek2"]["div_isi4"].value == "error=User denied Geolocation") {
                alert("Lokasi Error, Berikan izin Ke Aplikasi untuk mengambil lokasi anda!");
                document.forms["formcek2"]["div_isi4"].focus();
                return false;
            }
            if (document.forms["formcek2"]["div_isi4"].value == "") {
                alert("Titik Kordinat Tidak Boleh Kosong");
                document.forms["formcek2"]["div_isi4"].focus();
                return false;
            }
            if (document.forms["formcek2"]["foto2"].value == "") {
                alert("Foto Tidak Boleh Kosong");
                document.forms["formcek2"]["foto2"].focus();
                return false;
            }

        }
</script>

<script type="text/javascript">
  (function () {
    function checkTime(i) {
        return (i < 10) ? "0" + i : i;
    }

    function startTime() {
        var today = new Date(),
            h = checkTime(today.getHours()),
            m = checkTime(today.getMinutes()),
            s = checkTime(today.getSeconds());
        document.getElementById('time_datang').innerHTML = h + ":" + m;
        t = setTimeout(function () {
            startTime()
        }, 500);
    }
    startTime();
})();
</script>
<script type="text/javascript">
  (function () {
    function checkTime(i) {
        return (i < 10) ? "0" + i : i;
    }

    function startTime() {
        var today = new Date(),
            h = checkTime(today.getHours()),
            m = checkTime(today.getMinutes()),
            s = checkTime(today.getSeconds());
        document.getElementById('time_pulang').innerHTML = h + ":" + m;
        t = setTimeout(function () {
            startTime()
        }, 500);
    }
    startTime();
})();
</script>
  <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
  <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
</body>
</html>