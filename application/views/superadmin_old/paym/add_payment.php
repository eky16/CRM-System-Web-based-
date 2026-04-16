<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
      

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                            <div class="card-body">
    <form action="<?= base_url('payment/save_laporan2') ?>" id="form-tambah" method="POST" enctype="multipart/form-data">

                                <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label ><strong>Metode Pembayaran</strong></label>
                                            <select name="header_payment" class="form-control" required>
                            <option value="">PILIH ...</option>

                            <option value="CAHAYA SELARAS AGUNG,PT" <?php
                            if (!empty($pay->header_payment)) {
                                echo $pay->header_payment == 'CAHAYA SELARAS AGUNG,PT' ? 'selected' : '';
                            }
                            ?>>CAHAYA SELARAS AGUNG,PT</option>
                            <option value="VIA BCA 1988" <?php
                            if (!empty($pay->header_payment)) {
                                echo $pay->header_payment == 'VIA BCA 1988' ? 'selected' : '';
                            }
                            ?>>VIA BCA 1988</option>

                            <option value="VIA BCA 3701" <?php
                            if (!empty($pay->header_payment)) {
                                echo $pay->header_payment == 'VIA BCA 3701' ? 'selected' : '';
                            }
                            ?>>VIA BCA 3701</option>
                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                        <label>Tanggal Pembayaran</label>
                                        <input type="date"  name="tgl_payment" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                            </div>

                                    </div>
                                    <div class="form-row">
                                    </div>
                                         <div>

<div id="newRow"></div>
<div id="newRow2"></div>
                    <button id="addRow" type="button" class="btn btn-info">Tambah</button>
</div></br>
 
                                    <div class="form-row">

 <script type="text/javascript">
        // add row


        $("#addRow").click(function () {
            var html = '';

                                 
            html += '<div id="inputFormRow">';
            html += '<div class="form-row">';
            html += '<div class="form-group col-md-3">';

            html += '<label>No Spk</label>';
            html += ' <input type="text" name="no_spk[]" placeholder="No Spk" autocomplete="off" value=""  class="form-control" required>';
            html += '</div>';

             html += '<div class="form-group col-3" id="vendor">';
            html += '<label>Proyek</label>';     
            html += '<select id="select-state" placeholder="" name="project_payment[]" class="form-control" required>';
            html += '<option value="" >PILIH .....</option>';
            html += '<?php foreach ($proyek as $prk) : ?>
                    <option value="<?php echo $prk->id_lsp ?>"';
            html += ' <?php
                                if (!empty($pay->project_payment)) {
                                    echo $prk->id_lsp == $pay->project_payment ? 'selected' : '';
                                }
                                ?>><?php echo $prk->nama_project ?></option>';
            html += ' <?php endforeach; ?>';
            html += '</select>';
            html += '   </div>';

            html += '<div class="form-group col-3" id="vendor">';
            html += '<label>Vendor & No Rekening</label>';     
            html += '<select id="select-state" placeholder="" name="vendor[]" class="form-control" required>';
            html += '<option value="" >PILIH .....</option>';
            html += '<?php foreach ($vendor as $vn) : ?>
                    <option value="<?php echo $vn->id_ven ?>"';
            html += '  <?php
                        if (!empty($pay->vendor)) {
                        echo $vn->id_ven == $pay->vendor ? 'selected' : '';
                        } ?>><?php echo $vn->nama_vendor .' - '.$vn->norek_vendor ?></option>';
            html += ' <?php endforeach; ?>';
            html += '</select>';
            html += '   </div>';
            html += '<div class="form-group col-3" >';
            html += ' <label>Jumlah</label>';
            html += ' <input type="text" name="almount[]" placeholder="Jumlah Pembayaran" autocomplete="off" value="" onkeypress="return hanyaAngka(event)"  class="form-control">';
            html += '  </div>';
            html += '<div class="form-group col-3" >';
            html += ' <label>Potongan Pajak</label>';
            html += ' <input type="text" name="total_pajak[]" placeholder="Jumlah Pajak" autocomplete="off" value="" onkeypress="return hanyaAngka(event)"  class="form-control">';
            html += '  </div>';
            html += '<div class="form-group col-3" >';
            html += ' <label>Dibayarkan</label>';
            html += ' <input type="text" name="total_payment[]" placeholder="Jumlah pembayaran akhir" autocomplete="off" value="" onkeypress="return hanyaAngka(event)"  class="form-control">';
            html += '  </div>';
            html += '<div class="form-group col-5" >';
            html += ' <label>Keterangan</label>';
            html += ' <textarea  name="note_payment[]" placeholder="Keterangan Pembayaran" autocomplete="off"    class="form-control"></textarea>';
            html += '  </div>';

             html += '<div class="form-group col-md-1">';
               html += '<label> Remove</label>';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
            html += '</div>';
            html += '</div>';


            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
                
                                
                                    </div>
                    <input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Tambah M O M" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s'); ?>">                                   
                        
                                    <div class="form-row">
                        
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