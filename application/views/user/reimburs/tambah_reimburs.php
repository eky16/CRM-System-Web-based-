<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">

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
    <form action="<?= base_url('user/reimburs/proses') ?>" enctype="multipart/form-data" method="POST">
                                    <div class="form-row">
    <input type="text" name="createddate_reimbus" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                         <input type="text" name="id_sub[]" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="0"  class="form-control" required>
                                    <input type="text" name="kode_reimburs1" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php  $codek =  random_string('numeric', 5);
                                    $code = "RMS".$codek ;
                                            echo $code ?>"  class="form-control" required>
   
     <div class="form-group col-md-12">
                                            <label for="department"><strong>Kode</strong></label>
                                            <input type="text" name="kode_reimburs[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $code ?>"  class="form-control" required>
                                        </div>
                                                    <div class="form-group col-md-12">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" readonly name="tanggal_reimbus"  placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control" required>
                                        </div>
                                    </div>

    
                                 <div class="form-row" id=cd1>

                                        <div class="form-group col-md-12"  >
                                            <label for="department"><strong> Proyek</strong></label>
            <select  placeholder="Pilih Proyek" name="name_project" class="form-control" required>           
                             <option value="" >PILIH .....</option>
                    <?php foreach ($proyek->result() as $row) :?>
                                <option value="<?php echo $row->nama_project;?>"><?php echo $row->nama_project;?></option>
                            <?php endforeach;?>>
    <option value="Dll" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'Dll' ? 'selected' : '';
                                        }
                                        ?>>Dll</option>
                                   </select> 
                                        </div>


                                    </div>


        <div class="form-row" id=cd1>
            <div class="form-group col-md-12" >
                                            <label for="department"><strong> Jenis</strong></label>
            <select  placeholder="Pilih Jenis" name="kategori_reimburs[]" class="form-control" id="combo_jenis" required>           
                             <option value="" >PILIH .....</option>
                                    <option value="BENSIN (Kendaraan Pribadi)" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'BENSIN (Kendaraan Pribadi)' ? 'selected' : '';
                                        }
                                        
                                        ?>>BENSIN (Kendaraan Pribadi)</option>
                                        <option value="BENSIN (Kendaraan Kantor)" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'BENSIN (Kendaraan Kantor)' ? 'selected' : '';
                                        }
                                        ?>>BENSIN (Kendaraan Kantor)</option>
                                        <option value="PARKIR" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'PARKIR' ? 'selected' : '';
                                        }
                                        ?>>PARKIR</option>
                                        <option value="TOL" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'TOL' ? 'selected' : '';
                                        }
                                        ?>>TOL</option>
                                         <option value="ENTERTAIN" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'ENTERTAIN' ? 'selected' : '';
                                        }
                                        ?>>ENTERTAIN</option>

                                        <option value="KESEHATAN" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'KESEHATAN' ? 'selected' : '';
                                        }
                                        ?>>KESEHATAN</option>

                                         <option value="Dll" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'Dll' ? 'selected' : '';
                                        }
                                        ?>>Dll</option>

                                   </select> 
                    </div>
                </div>






                                    <div class="form-row" id="vs2">
                                        <div class="form-group col-md-12">
                      <div id="inputFormRow" >
                        <div class="input-group mb-3">
                            <input type="file" name="berkas[]"  placeholder="foto reimburs" autocomplete="off" value=""  class="form-control" >
                        </div>
                    </div>
                                        </div>
                                    </div>
        <div class="input-group mb-3" id=vs1>
    <div class="input-group-prepend">
      <span class="input-group-text">Pic Finish KM </span>
    </div>
    <input type="file" name="foto_km_after" class="form-control" placeholder="Total KM" >

  </div>
<div class="input-group mb-3" id=vs1>
    <div class="input-group-prepend">
      <span class="input-group-text">KM</span>
    </div>
    <input type="text" name="total_km[]" value="" class="form-control" placeholder="Total KM" >
     </div>
                            
                            <div class="input-group mb-3" id=vs2nom>

    <input type="text" name="nominal[]" onkeypress="return hanyaAngka(event)" placeholder="Hanya Angka Tidak boleh ada titik & koma" autocomplete="off" value=""  class="form-control" >
     </div>
                                         <div id="cd1">
<div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Tambah Jenis</button>
</div></br>
<div class="input-group mb-3" >
    <div class="input-group-prepend">
      <span class="input-group-text">Keterangan</span>
    </div>
    <textarea type="text" name="keterangan" class="form-control" placeholder="">
</textarea>
  </div>

                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                              
                                    </div>
       <script>
$(document).ready(function(){ 

  $("select[id=combo_jenis]").on("change", function() { 
    if ($(this).val() === "" || $(this).val() === "TOL" || $(this).val() === "BENSIN (Kendaraan Kantor)" || $(this).val() === "Dll" || $(this).val() === "ENTERTAIN" || $(this).val() === "PARKIR" || $(this).val() === "KESEHATAN") {
      $("div[id=vs1]").hide(); 
    } else { 
      $("div[id=vs1]").show();
      $("div[id=vs2]").show();
    } 
  }); 
  $("select[id=combo_jenis]").trigger("change");

 $("select[id=combo_jenis]").on("change", function() { 
    if ($(this).val() === "" || $(this).val() === "BENSIN (Kendaraan Pribadi)" ) {
      $("div[id=vs2nom]").hide();
    } else { 
      $("div[id=vs2]").show();
      $("div[id=vs2nom]").show();
    } 
  }); 
  $("select[id=combo_jenis]").trigger("change");
 
});
</script>
                                     <script type="text/javascript">
        // add row


        $("#addRow").click(function () {
            var html = '';
         
            html += '<input type="text" hidden name="kode_reimburs[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $code ?>"  class="form-control" required>';                                 
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<select  placeholder="Pilih Proyek" name="kategori_reimburs[]" class="form-control"  required>'           
            html += '<option value="" >PILIH .....</option>'
            html += '                           <option value="BENSIN (Kendaraan Kantor)" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'BENSIN (Kendaraan Kantor)' ? 'selected' : '';
                                        }
                                        ?>>BENSIN (Kendaraan Kantor)</option>'
            html += ' <option value="PARKIR" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'PARKIR' ? 'selected' : '';
                                        }
                                        ?>>PARKIR</option>'
            html += '<option value="TOL" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'TOL' ? 'selected' : '';
                                        }
                                        ?>>TOL</option>'
            html += '<option value="ENTERTAIN" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'ENTERTAIN' ? 'selected' : '';
                                        }
                                        ?>>ENTERTAIN</option>'
            html += '<option value="KESEHATAN" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'KESEHATAN' ? 'selected' : '';
                                        }
                                        ?>>KESEHATAN</option>'
            html += '<option value="Dll" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'Dll' ? 'selected' : '';
                                        }
                                        ?>>Dll</option>'
                     html += '</select> '
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="file" name="berkas[]"  placeholder="Masukkan Nominal" autocomplete="off" value=""  class="form-control" required>';
            html += '</div>';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="nominal[]" onkeypress="return hanyaAngka(event)" placeholder="Hanya Angka Tidak boleh ada titik & koma" autocomplete="off" value=""  class="form-control" required>';

            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
                                </form>
                            </div> 

                        </div>

                    </div>
<div class="col-md-6">
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
  
                </div>

                </div>
   <?php $this->load->view('user/partials/footer.php') ?>
            </div>


   
            <!-- load footer -->
         
        </div>

    </div>
            <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
    <?php $this->load->view('user/partials/js.php') ?>
</body>
</html>