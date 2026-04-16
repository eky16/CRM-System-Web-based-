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
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('mom/lihat_semua') ?>">
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
                    <form action="<?= base_url('karyawan/proses_update') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" onsubmit="return validation(this)">
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Data Pribadi </h4>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="nama_karyawan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->nama_karyawan ?>"  class="form-control">
                                        </div>
                                    <div class="form-group col-12">
                                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control" >
                            <option value="">JENIS KELAMIN ...</option>
                            <option value="LAKI-LAKI" <?php
                            if (!empty($emp->gender)) {
                                echo $emp->gender == 'LAKI-LAKI' ? 'selected' : '';
                            }
                            ?>>LAKI-LAKI</option>
                            <option value="PEREMPUAN" <?php
                            if (!empty($emp->gender)) {
                                echo $emp->gender == 'PEREMPUAN' ? 'selected' : '';
                            }
                            ?>>PEREMPUAN</option>
                            </select>
                                </div>
                                        <div class="form-group col-12">
                                            <label>Tanggal Lahir</label>
                                        <input type="date" placeholder="yyyy-mm-dd"  name="ulang_tahun" value="<?= $emp->ulang_tahun ?>"  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>Status Kawin</label>
                                     <select name="status_kawin" class="form-control" >

                                        <option value="">PERNIKAHAN STATUS ...</option>
                                        <option value="SINGLE" <?php
                                        if (!empty($emp->status_kawin)) {
                                            echo $emp->status_kawin == 'SINGLE' ? 'selected' : '';
                                        }
                                        
                                        ?>>SINGLE</option>
                                        <option value="MARRIED" <?php
                                        if (!empty($emp->status_kawin)) {
                                            echo $emp->status_kawin == 'MARRIED' ? 'selected' : '';
                                        }
                                        ?>>MARRIED</option>
                                        <option value="SEPARATED" <?php
                                        if (!empty($emp->status_kawin)) {
                                            echo $emp->status_kawin == 'SEPARATED' ? 'selected' : '';
                                        }
                                        ?>>SEPARATED</option>
                                        <option value="DIVORCED" <?php
                                        if (!empty($emp->status_kawin)) {
                                            echo $emp->status_kawin == 'DIVORCED' ? 'selected' : '';
                                        }
                                        ?>>DIVORCED</option>
                                         <option value="WIDOWED" <?php
                                        if (!empty($emp->status_kawin)) {
                                            echo $emp->status_kawin == 'WIDOWED' ? 'selected' : '';
                                        }
                                        ?>>WIDOWED</option>
                                         <option value="NOTSPECIFIED" <?php
                                        if (!empty($emp->status_kawin)) {
                                            echo $emp->status_kawin == 'NOTSPECIFIED' ? 'selected' : '';
                                        }
                                        ?>>NOT SPECIFIED</option>
                                    </select>

                                        </div>
                                        <div class="form-group col-12">
                                            <label>Email</label>
                                        <input type="Email"   name="email" placeholder="Masukkan Email Aktif" autocomplete="off" value="<?= $emp->email ?>"  class="form-control">
                                        </div>
                                      <div class="form-group col-12">
                                            <label>Email Kantor</label>
                                        <input type="text"   name="email_kantor" placeholder="Masukkan Email Aktif" autocomplete="off" value="<?= $emp->email_kantor ?>"  class="form-control">
                                        </div>  
                                        <div class="form-group col-12">
                                            <label>No Telp 1</label>
                                        <input type="text" maxlength="20"  name="no_telp1" placeholder="Masukkan Nomor Telp 1" autocomplete="off" value="<?= $emp->no_telp1 ?>"  class="form-control no_hp">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>No Telp 2</label>
                                        <input type="text" maxlength="20"   name="no_telp2" placeholder="Masukkan Nomor Telp 2" autocomplete="off" value="<?= $emp->no_telp2 ?>"  class="form-control no_hp">
                                        </div>
                                                                        <div class="form-group col-12">
                                            <label>No Telp Darurat</label>
                                        <textarea  name="no_telp_darurat" class="form-control" ><?= $emp->no_telp_darurat ?></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Hubungan</label>
                           <select name="hubungan" class="form-control" >
                            <option value="">HUBUNGAN ...</option>
 <option value="ANAK" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'ANAK' ? 'selected' : '';
                            }
                            ?>>ANAK</option>
                            <option value="SAUDARA KANDUNG" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'SAUDARA KANDUNG' ? 'selected' : '';
                            }
                            ?>>SAUDARA KANDUNG</option>


                            <option value="ISTRI" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'ISTRI' ? 'selected' : '';
                            }
                            ?>>ISTRI</option>

                            <option value="ORANG TUA" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'ORANG TUA' ? 'selected' : '';
                            }
                            ?>>ORANG TUA</option>

                            <option value="SAUDARA" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'SAUDARA' ? 'selected' : '';
                            }
                            ?>>SAUDARA</option>
                            
                            <option value="KERABAT" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'KERABAT' ? 'selected' : '';
                            }
                            ?>>KERABAT</option>
                            
                            <option value="SUAMI" <?php
                            if (!empty($emp->hubungan)) {
                                echo $emp->hubungan == 'SUAMI' ? 'selected' : '';
                            }
                            ?>>SUAMI</option>
                            </select>
                                </div>
                                        <div class="form-group col-12">
                                            <label>Nomor Induk KTP</label>
                                        <input type="text" onkeypress="return hanyaAngka(event)" maxlength="17"  name="nomor_ktp" placeholder="Masukkan Nomor Induk KTP" autocomplete="off" value="<?= $emp->nomor_ktp ?>"  class="form-control">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Alamat Ktp</label>
                                        <textarea  name="alamat_ktp" class="form-control" ><?= $emp->alamat_ktp ?></textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Alamat Domisili</label>
                                        <textarea  name="alamat_domisili"  class="form-control" ><?= $emp->alamat_domisili ?></textarea>
                                        </div>
                                        <hr>
                                    <div class="form-group col-12">
                                            <label>Foto</label>
                                    
 
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
 
  <div class="image-upload-wrap"> 
    <input class="file-upload-input"  type='file' name="berkas" value="" onchange="readURL(this);" accept="image/*" />

    <div class="drag-text">
                <img  src="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $emp->foto ?>"  alt="" class="file-upload-image" />
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
                              <!--  <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Cv </strong></label>
                                             <input  type="file"  maxlength="50" name="cv" placeholder="Cv.Pdf" accept="application/pdf"  value=""  id="fileId" class="form-control">   
                        <?php if (!empty($emp->resume)): ?>                     
                        <a href="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $emp->resume ?>" target="_blank" style="text-decoration: underline;">Resume </a><?php endif; ?>
                                        </div>                     
                                    <div class="form-group col-12">
                                <button id="btn-file-reset-id"  class="btn btn-danger" type="button">Reset file</button>
                                        
                                    </div>-->
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
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="bank" placeholder="Masukkan Cabang Nama Bank" value="<?= $emp->bank ?>" autocomplete="off" value=""  class="form-control">
                                        </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atas Nama </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="ats_nama" placeholder="Atas Nama"  autocomplete="off" value="<?= $emp->ats_nama ?>"  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>No Rekening</label>
                                        <input type="text" maxlength="20"  name="no_rek" placeholder="Masukkan Nomor Rekening" autocomplete="off" value="<?= $emp->no_rek ?>"  class="form-control">
                                        </div>
                               <hr>   
                                 <h4 class="small font-weight-bold">Data Bpjs & Npwp </h4>  
                                <div class="form-group col-12">
                                            <label>No Bpjs Kesehatan</label>
                                        <input type="text" maxlength="20"  name="bpjs_kes" placeholder="Masukkan Nomor Bpjs Kesehatan" autocomplete="off" value="<?= $emp->bpjs_kes ?>"  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>No Bpjs Tenagakerja</label>
                                        <input type="text" maxlength="20"  name="bpjs_ket" placeholder="Masukkan Nomor Bpjs Tenagakerja" autocomplete="off" value="<?= $emp->bpjs_kes ?>"  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>NPWP</label>
                                        <input type="text" maxlength="20"  name="npwp" placeholder="Masukkan Nomor NPWP" autocomplete="off" value="<?= $emp->npwp ?>"  class="form-control">
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
                                            <label>No Induk Karyawan</label>
                                        <input type="text" maxlength="20"  name="EmployeeID" placeholder="Masukkan Induk Karyawan" autocomplete="off" value="<?= $emp->EmployeeID ?>"  class="form-control">
                                    </div>

                                <div class="form-group col-12">
                                            <label>Tanggal Bergabung</label>
                                        <input type="text" placeholder="yyyy-mm-dd" id="datepicker_2" name="tgl_bergabung" value="<?= $emp->tgl_bergabung ?>"  class="form-control">
                                        </div>
                                <div class="form-group col-12">
                                            <label>Status</label>
                                     <select name="perjanjian_kerja" class="form-control" onchange="showTgl('hidden_tgl', this)">

                                        <option value="">STATUS PEKERJA ...</option>
                                        <option value="PERCOBAAN" <?php
                                        if (!empty($emp->perjanjian_kerja)) {
                                            echo $emp->perjanjian_kerja == 'PERCOBAAN' ? 'selected' : '';
                                        }
                                        
                                        ?>>PERCOBAAN</option>
                                        <option value="KONTRAK" <?php
                                        if (!empty($emp->perjanjian_kerja)) {
                                            echo $emp->perjanjian_kerja == 'KONTRAK' ? 'selected' : '';
                                        }
                                        ?>>KONTRAK</option>
                                        <option value="TETAP" <?php
                                        if (!empty($emp->perjanjian_kerja)) {
                                            echo $emp->perjanjian_kerja == 'TETAP' ? 'selected' : '';
                                        }
                                        ?>>TETAP</option>
                                        <option value="HARIAN" <?php
                                        if (!empty($emp->perjanjian_kerja)) {
                                            echo $emp->perjanjian_kerja == 'HARIAN' ? 'selected' : '';
                                        }
                                        ?>>HARIAN</option>
                                         
                                    </select>

                                        </div>
                                        <div class="form-group col-12" id="hidden_tgl">
                                            <label>Akhir Kerja</label>
                                        <input type="text" placeholder="yyyy-mm-dd" id="datepicker_3" name="akhir_kerja" value="<?= $emp->akhir_kerja ?>"  class="form-control">
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
                                                if (!empty($emp->divisi)) {
                                                    echo $designation->id_div == $emp->id_div ? 'selected' : '';
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
                            <?php foreach ($spv as $spv) : ?>
                                <option value="<?php echo $spv->EmployeeID ?>" <?php
                                if (!empty($emp->supervisorID)) {
                                    echo $spv->EmployeeID == $emp->supervisorID ? 'selected' : '';
                                }
                                ?>><?php echo $spv->EmployeeID .' - '. $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select> 
                                    </div>
                                    <div class="form-group col-12">
                                            <label>Status</label>
                                        <select name="Active" class="form-control" onchange="showDiv('hidden_div', this)">
                              
                                        <option value="1" <?php
                                        if (!empty($emp->Active)) {
                                            echo $emp->Active == '1' ? 'selected' : '';
                                        }
                                        
                                        ?>>AKTIF</option>
                                        <option value="2" <?php
                                        if (!empty($emp->Active)) {
                                            echo $emp->Active == '2' ? 'selected' : '';
                                        }
                                        ?>>NON-AKTIF</option>
                                         
                                    </select>
                                    </div>
                                    <div class="form-group col-12" id="hidden_div">
                                            <label>Tgl Non-Aktif</label>
                                        <input type="text" placeholder="yyyy-mm-dd" id="datepicker_4" name="resign_date" value="<?= $emp->resign_date ?>"  class="form-control">
                                       
                                  
                                            <label>Alasan Non-Aktif</label>
                                        <textarea  name="alasan_resign" class="form-control" ><?= $emp->alasan_resign ?></textarea>
                                        </div>
                    <hr>
                    <input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Ubah Karyawan" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d  H:i:s');
                                ?>"> 
                    <input type="hidden" name="createdby" value="<?= $emp->createdby ?>">
                    <input type="hidden" name="createdtime" value="<?= $emp->createdtime ?>">
                    <input type="hidden" name="updateby" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
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
            <?php $this->load->view('partials/footer.php') ?>
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
    <?php $this->load->view('partials/js.php') ?>
<script type="text/javascript">
    function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 2 ? 'block' : 'none';
}
</script>

<script type="text/javascript">
    function showTgl(divId, element)
{
    document.getElementById(divId).style.display = element.value !== "TETAP" ? 'block' : 'none' ;
   
}
</script>
</body>

</html>