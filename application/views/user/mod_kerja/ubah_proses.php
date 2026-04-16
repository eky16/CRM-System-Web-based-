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
#hidden_div { 
    display: none;
}

#hidden_tgl {
    display: none;
}
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('barang') ?>">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                            <div class="card-body">
        <form action="<?= base_url('user/upload/proses') ?>" enctype="multipart/form-data" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>

                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Kode</strong></label>
                                            <input type="text" name="kode_modul" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php
                                if (!empty($department_info->kode_modul)) {
                                    echo $department_info->kode_modul;
                                }
                                ?>"  class="form-control" required>
                                        </div>
                                    <div class="form-group col-md-12">
                                            <label for="department"><strong>Progress</strong></label>
                                            <input type="text" name="progress" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php 
                                       $persentasi=round($department_info->proses/$department_info->progres * 100,2); 
                                       echo "$persentasi%";
                                        ?>"  class="form-control" required>
                                        </div>


                                    </div>
                                    <div class="form-row">
 <input type="text" name="email" hidden readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php
                                if (!empty($department_info->to)) {
                                    echo $department_info->to;
                                }
                                ?>"  class="form-control" required>
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Nama </strong></label>
                    <input type="text" name="" readonly  placeholder="Masukkan Nama Department" autocomplete="off" value="<?php
                                if (!empty($emp->nama_karyawan)) {
                                    echo $emp->nama_karyawan;
                                }
                                ?>"  class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="stok"><strong>Tugas</strong></label>
                          <?php foreach ($designation_info as $designation_info): ?>
                                            <div id="inputFormRow">
                        <div class="input-group mb-2">
                               <textarea  name="tugas[]" readonly class="form-control m-input" placeholder="Tugas" autocomplete="off"><?php
                                            if (!empty($designation_info->tugas)) {
                                                echo $designation_info->tugas;
                                            }
                                            ?></textarea>
                 <input type="text" name="status_tugas[]" disabled hidden  autocomplete="off" value="<?php
                                if (!empty($designation_info->status_tugas)) {
                                    echo $designation_info->status_tugas;
                                }
                                ?>"  class="form-control">
 <fieldset>

  <div class="container mt-8"> 
                     
  <div class="form-check" >

      <input type="checkbox" class="form-check-input"  name="status_tugas[]" value="1"  <?php if($designation_info->status_tugas == '1'){echo 'checked';}?> >
      <label class="form-check-label" >Menunggu</label>  
    </div> 
    <div class="form-check">
      <input type="checkbox" class="form-check-input"  name="status_tugas[]" value="2" <?php if($designation_info->status_tugas == '2'){echo 'checked';}?> >
      <label class="form-check-label" >Proses</label>

    </div>
   <div class="form-check">
      <input type="checkbox" class="form-check-input"  name="status_tugas[]" value="3" <?php if($designation_info->status_tugas == '3'){echo 'checked';}?> >
      <label class="form-check-label" >Selesai</label>
    </div>

</div> </fieldset>
              

                    </div>
                         <input type="text" hidden name="kode_modulnya[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php
                                if (!empty($department_info->kode_modul)) {
                                    echo $department_info->kode_modul;
                                }
                                ?>"  class="form-control" required>
                               <input type="text" hidden name="id_sub[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php
                                if (!empty($designation_info->id_sub)) {
                                    echo $designation_info->id_sub;
                                }
                                ?>"  class="form-control" required>
                              <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Upload Foto</strong>
                                        <i><u> <font size="2px"> Jika Semua Task Telah Selesai</font></u></i></label>
                                            <input type="file" name="berkas[]" value="<?php
                                if (!empty($designation_info->berkas_file)) {
                                    echo $designation_info->berkas_file;
                                }
                                ?>" class="form-control">

                                
                                        </div>
                                    </div>
                <?php endforeach ?>
 

                   
                                        </div>
     
                                    
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                    </div>

                                </form>
                            </div>              
                        </div>
                    </div>
                </div>



                </div>
            </div>

   
            <!-- load footer -->
        
        </div>
          <?php $this->load->view('user/partials/footer.php') ?>
    </div>
    <?php $this->load->view('partials/js.php') ?>
</body>
</html>