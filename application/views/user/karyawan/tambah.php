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
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('mom/lihat_semua') ?>">
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
                    <form action="<?= base_url('user/karyawan/proses_tambah') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" onsubmit="return validation(this)">
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">alba unggul metal</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Data Pribadi </h4>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="nama_karyawan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control" >
                                        </div>
                                    <div class="form-group col-12">
                                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control" >
                            <option value="">JENIS KELAMIN ...</option>
                            <option value="LAKI-LAKI" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'LAKI-LAKI' ? 'selected' : '';
                            }
                            ?>>LAKI-LAKI</option>
                            <option value="PEREMPUAN" <?php 
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'PEREMPUAN' ? 'selected' : '';
                            }
                            ?>>PEREMPUAN</option>
                            </select>
                                </div>
                                        <div class="form-group col-12">
                                            <label>Tanggal Lahir</label>
                                        <input type="text" placeholder="yyyy-mm-dd" id="datepicker" name="ulang_tahun" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>Status Kawin</label>
                                     <select name="status_kawin" class="form-control" >

                                        <option value="">PERNIKAHAN STATUS ...</option>
                                        <option value="SINGLE" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'SINGLE' ? 'selected' : '';
                                        }
                                        
                                        ?>>SINGLE</option>
                                        <option value="MARRIED" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'MARRIED' ? 'selected' : '';
                                        }
                                        ?>>MARRIED</option>
                                        <option value="SEPARATED" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'SEPARATED' ? 'selected' : '';
                                        }
                                        ?>>SEPARATED</option>
                                        <option value="DIVORCED" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'DIVORCED' ? 'selected' : '';
                                        }
                                        ?>>DIVORCED</option>
                                         <option value="WIDOWED" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'WIDOWED' ? 'selected' : '';
                                        }
                                        ?>>WIDOWED</option>
                                         <option value="NOTSPECIFIED" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'NOTSPECIFIED' ? 'selected' : '';
                                        }
                                        ?>>NOT SPECIFIED</option>
                                    </select>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Email</label>
                                        <input type="Email" maxlength="50"  name="email" placeholder="Masukkan Email Pribadi" autocomplete="off" value=""  class="form-control" required>
                                        </div>  
                              
                    <div class="form-group col-md-12">
                                            <label >Email Kantor</label>
                                            <div id="inputFormRow">
                        <div class="input-group mb-2">
                            <input type="text" name="email_kantor" class="form-control m-input" placeholder="Email Kantor" autocomplete="off" value="-">
                            <div class="input-group-append">
                               <input type="text" readonly name="buntut_email" value="@cassadesign.com" class="form-control m-input" autocomplete="off">
                            </div>
                        </div>
                    </div>
                            </div>
                   
                                        <div class="form-group col-12">
                                            <label>No Telp 1</label>
                                        <input type="text" maxlength="20"  name="no_telp1" placeholder="Masukkan Nomor Telp 1" autocomplete="off" value=""  class="form-control no_hp">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>No Telp 2</label>
                                        <input type="text" maxlength="20"   name="no_telp2" placeholder="Masukkan Nomor Telp 2" autocomplete="off" value=""  class="form-control no_hp">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>No Telp Darurat</label>
                                        <textarea  name="no_telp_darurat" class="form-control" ></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Hubungan</label>
                            <select name="hubungan" class="form-control" >
                            <option value="">HUBUNGAN ...</option>

                            <option value="SAUDARA KANDUNG" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'SAUDARA KANDUNG' ? 'selected' : '';
                            }
                            ?>>SAUDARA KANDUNG</option>


                            <option value="ISTRI" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'ISTRI' ? 'selected' : '';
                            }
                            ?>>ISTRI</option>

                            <option value="ORANG TUA" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'ORANG TUA' ? 'selected' : '';
                            }
                            ?>>ORANG TUA</option>

                            <option value="SAUDARA" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'SAUDARA' ? 'selected' : '';
                            }
                            ?>>SAUDARA</option>

                            <option value="KERABAT" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'KERABAT' ? 'selected' : '';
                            }
                            ?>>KERABAT</option>

                            </select>
                                </div>
                                        <div class="form-group col-12">
                                            <label>Nomor Induk KTP</label>
                                        <input type="text" onkeypress="return hanyaAngka(event)" maxlength="17"  name="nomor_ktp" placeholder="Masukkan Nomor Induk KTP" autocomplete="off" value=""  class="form-control" required>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Alamat Ktp</label>
                                        <textarea  name="alamat_ktp" class="form-control" ></textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Alamat Domisili</label>
                                        <textarea  name="alamat_domisili" class="form-control" ></textarea>
                                        </div>
                                        <hr>
                                    <div class="form-group col-12">
                                            <label>Foto</label>
                                    

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
<hr> 

                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
          <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Data Bank </h4>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Cabang Bank </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="bank" placeholder="Masukkan Nama Cabang Bank" autocomplete="off" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atas Nama </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="ats_nama" placeholder="Atas Nama" autocomplete="off" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>No Rekening</label>
                                        <input type="text" maxlength="20"  name="no_rek" placeholder="Masukkan Nomor Rekening" autocomplete="off" value=""  class="form-control">
                                        </div>
                               <hr>   
                                 <h4 class="small font-weight-bold">Data Bpjs & Npwp </h4>  
                                <div class="form-group col-12">
                                            <label>No Bpjs Kesehatan</label>
                                        <input type="text" maxlength="20"  name="bpjs_kes" placeholder="Masukkan Nomor Bpjs Kesehatan" autocomplete="off" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>No Bpjs Tenagakerja</label>
                                        <input type="text" maxlength="20"  name="bpjs_ket" placeholder="Masukkan Nomor Bpjs Tenagakerja" autocomplete="off" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>NPWP</label>
                                        <input type="text" maxlength="20"  name="npwp" placeholder="Masukkan Nomor NPWP" autocomplete="off" value=""  class="form-control">
                                        </div>  

                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
  <div class="card-body">
     <h4 class="small font-weight-bold">Data Kantor </h4>
         <div class="form-group col-12">   
                                            <label >No Induk Karyawan</label>
                                            <div id="inputFormRow">
                        <div class="input-group mb-2">
                                <div class="input-group-append">
                               <input type="text" readonly name="EmployeeID" value="<?php $txt = sprintf("%03s", $kode_nik);
                                        echo $txt ?>" class="form-control m-input" autocomplete="off">
                            </div>

                            <input type="text" name="buntut_nik" maxlength="4" class="form-control m-input" placeholder="mmyy" autocomplete="off" required>
                        
                        </div>
                    </div>
                            
                                   
                                    </div>
                                <div class="form-group col-12">
                                            <label>Tanggal Bergabung</label>
                                        <input type="text" placeholder="yyyy-mm-dd" id="datepicker_2" name="tgl_bergabung" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>Status</label>
                                     <select name="perjanjian_kerja" class="form-control"  onchange="showTgl('hidden_tgl', this)">

                                        <option value="">PILIH STATUS.....</option>
                                        <option value="PERCOBAAN" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'PERCOBAAN' ? 'selected' : '';
                                        }
                                        
                                        ?>>PERCOBAAN</option>
                                        <option value="KONTRAK" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'KONTRAK' ? 'selected' : '';
                                        }
                                        ?>>KONTRAK</option>
                                        <option value="TETAP" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'TETAP' ? 'selected' : '';
                                        }
                                        ?>>TETAP</option>
                                        <option value="HARIAN" <?php
                                        if (!empty($employee_info->MatrialStatus)) {
                                            echo $employee_info->MatrialStatus == 'HARIAN' ? 'selected' : '';
                                        }
                                        ?>>HARIAN</option>
                                         
                                    </select>

                                        </div>
                                        <div class="form-group col-12" id="hidden_tgl">
                                            <label>Akhir Kerja</label>
                                        <input type="text" placeholder="yyyy-mm-dd" id="datepicker_3" name="akhir_kerja" value=""  class="form-control">
                                        </div>

                                

                    <div class="form-group col-12">
                                <label>Divisi/Jabatan</label>
                        <select name="divisi" class="form-control" >                             
                            <option value="">PILIH POSISI.....</option>
                            <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                    <?php if (!empty($v_department_info)): ?>
                                        <optgroup label="<?php echo $dept_name; ?>">
                                            <?php foreach ($v_department_info as $designation) : ?>
                                                <option value="<?php echo $designation->id_div; ?>" 
                                                <?php
                                                if (!empty($employee_info->designations_id)) {
                                                    echo $designation->id_div == $employee_info->id_div ? 'selected' : '';
                                                }
                                                ?>><?php echo $dept_name.' - ' .$designation->divisi ?></option>                            
                                                    <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>                            
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                            <label>Manager/Supervisor</label>
            <select id="select-state" placeholder="Status Project" name="supervisorID" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($atasan as $spv) : ?>
                                <option value="<?php echo $spv->EmployeeID ?>" <?php
                                if (!empty($emp->supervisorID)) {
                                    echo $spv->EmployeeID == $emp->supervisorID ? 'selected' : '';
                                }
                                ?>><?php echo $spv->EmployeeID .' - '. $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select> 
                                    </div>
                    <hr>
                    <input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Tambah Karyawan" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s'); ?>">  
                       
                    <input type="hidden" name="Active" value="1">
                    <input type="hidden" name="updateby" value="">
                    <input type="hidden" name="updatetime" value="">


                    <input type="hidden" name="createdby" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d  H:i:s');
                                ?>">
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Kosongkan Semua</button>
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>

            </form>
                </div>
            </div>
            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
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
<script type="text/javascript">
    function showTgl(divId, element)
{
    document.getElementById(divId).style.display = element.value !== "TETAP" ? 'block' : 'none' ;
   
}
</script>
    <?php $this->load->view('user/partials/js.php') ?>

</body>

</html>