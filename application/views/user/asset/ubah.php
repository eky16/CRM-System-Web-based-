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
                    <form action="<?= base_url('asset/proses_tambah') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" onsubmit="return validation(this)">
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
                                            <label for="nama_barang"><strong>Kode Asset </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_asset" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $asst->kode_asset ?>"  class="form-control">
                                </div>
<input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Ubah Asset" maxlength="8" hidden>
                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
                                    <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Asset </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="nama_asset" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $asst->nama_asset ?>"  class="form-control">
                                        </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Tgl Pajak </strong></label>
                                             <input type="date" maxlength="50"  name="kode_asset" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $asst->tgl_pajaks ?>"  class="form-control">
                                </div>
                                        <div class="form-group col-12">
                                            <label>Keterangan</label>
                                        <textarea  name="keterangan_asset" class="form-control" ><?= $asst->keterangan_asset ?></textarea>
                                        </div>

                                        <hr>
                                    <div class="form-group col-12">
                                            <label>Foto</label>
                                    

  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="gambar_asset" onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
        <img  src="<?php echo base_url(); ?>img/uploads/foto_asset/<?= $asst->gambar_asset ?>"  alt="" class="file-upload-image" />
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
                                                        <div class="form-group col-12">
                                            <label>Status</label>
                            <select name="status" class="form-control" required>
                            <option value="">STATUS ...</option>
                            <option value="TERSEDIA" <?php
                            if (!empty($asst->status)) {
                                echo $asst->status == 'TERSEDIA' ? 'selected' : '';
                            }
                            ?>>TERSEDIA</option>
                            <option value="TIDAK TERSEDIA" <?php
                            if (!empty($asst->status)) {
                                echo $asst->status == 'TIDAK TERSEDIA' ? 'selected' : '';
                            }
                            ?>>TIDAK TERSEDIA</option>
                            <option value="RUSAK" <?php
                            if (!empty($asst->status)) {
                                echo $asst->status == 'RUSAK' ? 'selected' : '';
                            }
                            ?>>RUSAK</option>
                            <option value="PERBAIKAN" <?php
                            if (!empty($asst->status)) {
                                echo $asst->status == 'PERBAIKAN' ? 'selected' : '';
                            }
                            ?>>PERBAIKAN</option>
                            </select>
                                </div>
                                        </div>
             <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Kosongkan Semua</button>
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
  

                            <!-- Approach -->

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

</body>

</html>