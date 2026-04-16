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
                                <form action="<?= base_url('mod_kerja/create') ?>" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Kode</strong></label>
                                            <input type="text" name="kode_modul" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php  $code =  random_string('numeric', 5);
                                            echo "TSK".$code ?>"  class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Nama Karyawan</strong></label>
            <select id="select-state" placeholder="Pilih Karyawan" name="email" class="form-control" required>           
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
            <select id="select-state" placeholder="Pilih Proyek" name="nama_proyek" class="form-control" required>           
                             <option value="" >PILIH .....</option>
                    <?php foreach ($proyek->result() as $row) :?>
                                <option value="<?php echo $row->nama_project;?>"><?php echo $row->nama_project;?></option>
                            <?php endforeach;?>>

                                   </select> 
                                        </div>
                         <div class="form-group col-md-12">
                                            <label for="department"><strong>Due Date</strong></label>
                                            <input type="date" name="tempo"  placeholder="Masukkan Nama Department" autocomplete="off" value=""  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="stok"><strong>Tugas</strong></label>
                                            <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <textarea  name="tugas[]" class="form-control m-input" placeholder="Tugas" autocomplete="off"></textarea>
                        </div>

                    </div>
                     <div id="newRow"></div>
                   <!--    <button id="addRow" type="button" class="btn btn-info">Tambah Tugas</button> -->
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Kosongkan Semua Tugas </button>
                                    </div>
                                     <script type="text/javascript">
        // add row
        var maxAppend = 0;
        $("#addRow").click(function () {
             if (maxAppend >= 10)
                {
                alert("Maksimal 10 Task Dalam 1 Modul");
            } else {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<textarea   name="tugas[]"  class="form-control m-input" placeholder="Tugas" autocomplete="off"></textarea>';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

              maxAppend++;
            $('#newRow').append(html);
        }
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