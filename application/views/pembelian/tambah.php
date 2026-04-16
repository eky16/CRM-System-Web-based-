<!--<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                            <div class="card-body">
    <form action="<?= base_url('pembelian/save_purchase_order') ?>" id="form-tambah" method="POST" enctype="multipart/form-data">

                                <div class="form-row">
                                        <div class="form-group col-3">
                                        <label>Tanggal</label>
                                        <input type="date"  name="transDate" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                            </div>
                                    <div class="form-group col-3">
                                        <label>No</label>
                                        <input type="text" readonly name="number_pr" value="<?php $txt = sprintf("%05s", $kode_nik);
                                        $kodeTransaksi_pr = 'PR.'.date('Y').'.'.date('m').'.'.$txt;
                                        echo $kodeTransaksi_pr;  ?>"  class="form-control">
                                    <input type="text" hidden name="number_" value="<?php 
                                    $kodeTransaksi_po = 'PO.'.date('Y').'.'.date('m').'.'.$txt;
                                        echo $kodeTransaksi_po;  ?>"  class="form-control">
                                            </div>

             <div class="form-group col-5" id="vendor">
            <label>Proyek</label> 
        <input type="text" id="autouser"  name=" " value=""  class="form-control">   
             </div>
                        <div class="form-group col-5" id="vendor">
                        <input type="text" class="form-control" id="userid" value='0' >
                        </div>
<input type="text" hidden name="toAddress" value="-"  class="form-control">
                                    </div>
                                    <div class="form-row">
                                    </div>
                                         <div>

<div id="newRow"></div>
 <button id="addRow" type="button" class="btn btn-info">Tambah</button>
</div></br>
 <div class="form-row">

 <script type="text/javascript">
        // add row


        $("#addRow").click(function () {
            var html = '';

                                 
            html += '<div id="inputFormRow">';
            html += '<div class="form-row">';
            html += '<div class="form-group col-md-4">';
            html += '<label>Nama Barang</label>';
            html += ' <input type="text" name="detailName[]" placeholder="Nama Barang" autocomplete="off" value=""  class="form-control" required>';
            html += '</div>';

            html += '<div class="form-group col-2" >';
            html += ' <label>Kode Barang</label>';
            html += ' <input type="text" name="quantity[]" readonly placeholder="Kode Barang" autocomplete="off" value="" onkeypress="return hanyaAngka(event)"  class="form-control">';
            html += '  </div>';

            html += '<div class="form-group col-2" >';
            html += ' <label>Jumlah</label>';
            html += ' <input type="text" name="quantity[]" placeholder="Jumlah barang" autocomplete="off" value="" onkeypress="return hanyaAngka(event)"  class="form-control">';
            html += '  </div>';

            html += '<div class="form-group col-3" >';
            html += ' <label>Satuan</label>';
            html += ' <input type="text" name="quantity[]" placeholder="Jumlah barang" autocomplete="off" value="" onkeypress="return hanyaAngka(event)"  class="form-control">';
            html += '  </div>';

            html += '<div class="form-group col-4" >';
            html += ' <label>Keterangan</label>';
            html += ' <textarea  name="detailNotes[]" placeholder="Keterangan " autocomplete="off"    class="form-control"></textarea>';
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
  <script type='text/javascript'>
  $(document).ready(function(){
  
     $( "#autouser" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>pembelian/userList",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#autouser').val(ui.item.label); // display the selected text
       $('#userid').val(ui.item.value); // save selected id to input
       return false;
      },
      focus: function(event, ui){
         $( "#autouser" ).val( ui.item.label );
         $( "#userid" ).val( ui.item.value );
         return false;
       },
     });

  });
  </script>
</body>
</html>