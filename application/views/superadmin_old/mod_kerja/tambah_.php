<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
 
<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('barang') ?>">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                            <div class="card-body">
                                <form action="<?= base_url('mod_kerja/create_') ?>" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Kode</strong></label>
                                            <input type="text" name="kode_daily" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php  $code =  random_string('numeric', 5);
                                            echo "LPH".$code ?>"  class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Nama Karyawan</strong></label>
            <select id="select-state" placeholder="Pilih Karyawan" name="karyawan" class="form-control" required>           
                             <option value="" >PILIH .....</option>
                    <?php foreach ($employee->result() as $row) :?>
                                <option value="<?php echo $row->email;?>"><?php echo $row->nama_karyawan;?></option>
                            <?php endforeach;?>>

                                   </select> 
                                        </div>
                                    </div>
                                 <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="department"><strong> Proyek</strong></label>
            <select id="select-state" placeholder="Pilih Proyek" name="proyek" class="form-control" required>           
                             <option value="" >PILIH .....</option>
                    <?php foreach ($proyek->result() as $row) :?>
                                <option value="<?php echo $row->nama_project;?>"><?php echo $row->nama_project;?></option>
                            <?php endforeach;?>>

                                   </select> 
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Jumlah Foto</strong></label>
                                            <input type="number" name="jumlah_foto"  placeholder="Jumlah Foto Perhari" autocomplete="off" value=""  class="form-control" required>
                                        </div>
                                    

                         <div class="form-group col-md-12">
                                            <label for="department"><strong>Durasi Pekerjaan</strong></label>
                                            <input type="date" name="durasi"  placeholder="Masukkan Nama Department" autocomplete="off" value=""  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="stok"><strong>Keterangan</strong></label>
                                            <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <textarea  name="keterangan" class="form-control m-input" placeholder="Keterangan" autocomplete="off"></textarea>
                        </div>

                    </div>
                     
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Kosongkan Semua Tugas </button>
                                    </div>
                                    
                                </form>
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
    <?php $this->load->view('partials/js.php') ?>
</body>
</html>