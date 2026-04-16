<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
    <style>
        .removeRow
        {
           background-color: #D1D1D1;
           color:#FFFFFF;
       }
       /* The container */
       .container12 {
          display: block;
          position: relative;
          padding-left: 35px;
          margin-bottom: 6px;
          cursor: pointer;
          font-size: 22px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
      }

      /* Hide the browser's default checkbox */
      .container12 input {
          position: absolute;
          opacity: 0;
          cursor: pointer;
          height: 0;
          width: 0;
      }

      /* Create a custom checkbox */
      .checkmark {
          position: absolute;
          top: 0;
          left: 0;
          height: 15px;
          width: 15px;
          background-color: #eee;
      }

      /* On mouse-over, add a grey background color */
      .container12:hover input ~ .checkmark {
          background-color: #ccc;
      }

      /* When the checkbox is checked, add a blue background */
      .container12 input:checked ~ .checkmark {
          background-color: #2196F3;
      }

      /* Create the checkmark/indicator (hidden when not checked) */
      .checkmark:after {
          content: "";
          position: absolute;
          display: none;
      }

      /* Show the checkmark when checked */
      .container12 input:checked ~ .checkmark:after {
          display: block;
      }

      /* Style the checkmark/indicator */
      .container12 .checkmark:after {
          left: 3px;
          top: 1px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(25deg);
          -ms-transform: rotate(25deg);
          transform: rotate(25deg);
      }

  </style>
</head>

<body id="page-top">
        <?php if ($this->session->flashdata('error_stok')) { ?>
<script>
 swal("Gagal!", "Status Quotation Tidak Boleh Kosong!!", "error");
</script>
     <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>

     <?php } ?>
        <?php if ($this->session->flashdata('error_update')) { ?>

     <?php } ?>
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('user/quotation') ?>">
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
                      <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>List Permintaan Barang</strong>
                                <div class="float-right">
                                        


                <!--  <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data </a> -->
                              <!--      <a href="<?= base_url('user/quotation/list_quo_get?id='.$hd_quo->id.'&no_quo='.$hd_quo->number_pr) ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Ambil Data  </a> -->
                                </div></div>

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><button type="button"  name="delete_all" id="delete_all" class="btn btn-danger btn-xs"><font size="2px"><i class="fa fa-trash"></i></font></button></th>
                                                    <th width="5">No</th>
                                                    <th width="200" align="center" scope="col" class="column-primary" data-header="Leads">Nama Barang</th >
                                                    
                                                    <th  align="center" scope="col" width="30">Status</th >
                                                    <th  align="center" scope="col" width="30">File</th >                                                   
                                                <!--    <th  align="center" scope="col" width="30">Gambar Penawaran</th >-->
                                                    <th  align="center" scope="col" width="50">Proses</th >
                                                    <th  align="center" scope="col" width="50">Aksi</th >

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                foreach ($dt_quo_all as $row): ?>
                                                    <tr> <?php $number = $no++; ?>

                                                    <td align="center"><input type="checkbox" class="delete_checkbox_daily" value="<?php echo $row->id_quo_dt ; ?>" /></td>
                                                    <td data-header="No"><?= $number ?></td>
                                                    <td data-header="Kode"><?= $row->detailName_quo ?></td>
                                                    
                                                    <td data-header="Project"><?= $row->status_qr_quo ?></td>
                                                    <td data-header="Project">
                                                         <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?>
                                                    </td>
                                                    
                                               <!--     <td data-header="Project">
                                                         <?php if (!empty($row->gambar_penawaran)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_penawaran/<?= $row->gambar_penawaran ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?>
                                                    </td>-->
                                                  <td align="center" >
                                                    <?php  $cek_status = $row->status_proses_quo ?>
                                                    <?php if($cek_status == 3): ?>
                                                        <?= "SELESAI"  ?>
                                                    <?php endif;?>
                                                    <?php if($cek_status == 2): ?>
                                                        <?= "PROSES"  ?>
                                                    <?php endif;?>
                                                    <?php if($cek_status == " "): ?>
                                                        <?= "TIDAK"  ?>
                                                    <?php endif;?>
                                                     <?php if($cek_status == ""): ?>
                                                        <?= "TIDAK"  ?>
                                                    <?php endif;?>
                                                </td>

                                                <td  align="center">
                                             <?php if($cek_status != 3): ?> 
                                                    <a  data-toggle="modal" style="color:white" data-target="#update_nonRAP<?php echo $row->id_quo_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ubah</a>
                                          <?php endif;?>
      
                                                <?php if($cek_status == 3): ?>  
                                                   <button class="btn btn-success btn-sm" disabled> SELESAI</button>
                                               <?php endif;?>
                                           </td>

                                       </tr>
<!-- modal update System --> 

<div  class="modal modal-right fade" id="update_nonRAP<?php echo $row->id_quo_dt ; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Update Permintaan Barang, ID <?php echo $row->id_quo_dt ; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('user/quotation/ubah_quo_dt_prosesto_est') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 

<input type="hidden" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" >

<input type="text" name="id_quo_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_quo_dt; ?>" hidden>
<input type="text" name="no_qt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request_quo; ?>" hidden>
<input type="text" name="nama_customer" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->customer; ?>" hidden>
                                              <div class="modal-body">
                                               <!-- Content Column -->

                                               <div class="col-lg-12 mb-4">

                                                <!-- Project Card Example -->
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">

                                                    </div>
<div class="card-body"><?php $Kode_Barang = $row->item_no; ?>
<div class="form-group col-md-12" id=customer-<?= $row->id_quo_dt; ?>>
    <label for="nama_barang"><span class="badge badge-success">Customer </span></label>
    <input  type="text" readonly maxlength="240"  name="customer" placeholder="" autocomplete="off" value="<?php echo $row->nama_cst; ?>"  class="form-control" >
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
    <input  type="text "  readonly maxlength="50"  name="item_no" id="item_no-<?= $row->id_quo_dt ;?>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->item_no; ?>"  class="form-control">
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
    <input  type="text" maxlength="240"  name="detailName_quo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName_quo; ?>"  class="form-control">
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"> <span class="badge badge-success">Jumlah </span></label>
    <input  type="text "    maxlength="50"  name="quantity" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $row->quantity  ; ?>"  class="form-control" readonly>
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Pilih Status </span></label>
    <select name="status_qr_quo" id="combo_status-<?= $row->id_dt; ?>" class="form-control">
    <option value="" <?= $row->status_qr_quo == '' ? 'selected' : ''; ?>>Pilih Status</option>

    <option value="Bisa Estimasi" <?= $row->status_qr_quo == 'Bisa Estimasi' ? 'selected' : ''; ?>>
    Bisa Estimasi
    </option>

    <option value="Tidak Bisa Estimasi" <?= $row->status_qr_quo == 'Tidak Bisa Estimasi' ? 'selected' : ''; ?>>
    Tidak Bisa Estimasi
    </option>
 
</select>
</div> 

<div class="form-group col-md-12" id=BisaEstimasi-<?= $row->id_dt; ?>>
    <label for="Harga"> <span class="badge badge-info">Harga</span></label>
    <input  type="text "  id="bisaEstimasi-<?= $row->id_quo_dt;?>"  maxlength="50"  name="estimasi_harga" placeholder="Tidak Ada Data" autocomplete="off" value=""  class="form-control" >
</div> 


<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Keterangan</span></label>
    <textarea name="detailNotes_quo" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->detailNotes_quo; ?></textarea>
</div>
                                                     
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Status Prosess </span></label>
    <select name="status_proses_quo" class="form-control" >
    <option value=" " <?php
        if (!empty($row->status_proses_quo)) {
                echo $row->status_proses_quo == '' ? 'selected' : '';
            }
            ?>>TIDAK</option>
    <option value="2" <?php 
        if (!empty($row->status_proses_quo)) {
                echo $row->status_proses_quo == '2' ? 'selected' : '';
            }
            ?>>YA</option>
            </select>
</div>


<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

<input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>"  class="form-control" hidden>

<hr>

<div class="form-group col-12">
<?php if ($row->status_proses_quo != 2) : ?>
  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
<?php endif;?>
<?php if ($row->status_proses_quo == 2 AND $row->status_qr != 'Stok') : ?>
  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
<?php endif;?>
<?php if ($row->status_proses_quo == 2 AND $row->status_qr == 'Stok') : ?>
  <button type="submit" disabled class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Sudah Diproses </button>
<?php endif;?>
</div>
</div>
<hr>
</div>
</div>

<!-- Color System -->
<div class="modal-footer modal-footer-fixed">
 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>

</div>
</div></form>


</div>
</div>
<!-- modal update PR  --> 
<?php endforeach ?>

</script>
</tbody>

</table>
</div>
<!-- modal tambah item -->
<!--<div  class="modal modal-right fade" id="right_modalupdate" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title"> Tambah Permintaan Barang </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('user/wo/tambah_item_new_po') ?>" enctype="multipart/form-data" id="from2" method="POST">
      <div class="modal-body">
        

         <div class="col-lg-12 mb-4">

           
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                </div>
                <div class="card-body">

                    <div class="form-group col-md-12">
                        <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                        <input type="text" name="detailName_quo" maxlength="240" id="nama_barang2" class=" form-control" list="nama_barang1" autocomplete="off">
                        <datalist id="nama_barang1">
                            <option value="">Pilih Barang</option>
                            <?php foreach ($all_barang as $barang): ?>
                                <option value="<?= $barang->Nama_Barang ?>"></option>
                            <?php endforeach ?>
                        </datalist>
                    </div>
                    <input type="text" name="kd_cst_quo"  autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->kd_cst_quo; ?>" hidden>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
                        <input  type="text "  readonly maxlength="50"  id="item_no" name="item_no" placeholder="Kode Barang" autocomplete="off" value=""  class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"> <span class="badge badge-success">Jumlah</span></label>
                        <input  type="text " readonly   maxlength="50"  name="quantity" placeholder="Masukkan Jumlah Barang" autocomplete="off" value=""  class="form-control">
                        </div> 
                        <div class="form-group col-md-12">
                            <label for="nama_barang"> <span class="badge badge-success">Satuan</span></label>
                            <input type="text" name="itemUnitName" readonly  id="sub_category" class=" form-control" list="category3" autocomplete="off" >
                            <datalist id="category3">
                                <option value="">No Selected</option>
                                <?php foreach ($satuan as $row): ?>
                                    <option value="<?= $row->nm_satuan ?>"></option>
                                <?php endforeach ?>
                            </datalist>
                        </div> 

    <script>
        $(document).ready(function(){
            $('tfoot').hide()

            $(document).keypress(function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            })

            $('#nama_barang2').on('change', function(){

                if($(this).val() == '') reset()
                else { 
                    //const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
                    //var url_get_all_barang = '<?php echo base_url()?>user/pembelian/get_all_barang',
                    $.ajax({
                        url: '<?php echo base_url()?>pembelian/get_all_barang',
                        type: 'POST',
                        dataType: 'json',
                        data: {Nama_Barang: $(this).val()},
                        success: function(data){
                            $('input[name="item_no"]').val(data.Kode_Barang)
                            $('input[name="quantity"]').val(1)
                            //$('input[name="proyek"]').val(1)
                            $('input[name="itemUnitName"]').val(data.Satuan)
                            //$('input[name="max_hidden"]').val(data.stok)
                            $('input[name="quantity"]').prop('readonly', false)
                            $('input[name="itemUnitName"]').prop('readonly', false)
                            $('button#tambah').prop('disabled', false)

                            $('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
                            
                            $('input[name="jumlah"]').on('keydown keyup change blur', function(){
                                $('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
                            })
                        }
                    })
                }
            })
        })
    </script>
                   
                    <div class="form-group col-md-12">
                        <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
                        <textarea   name="detailNotes_quo" placeholder="detailNotes_quo" autocomplete="off"  class="form-control"></textarea>
                    </div>
                    <input  type="text" maxlength="240"  name="status_proses_quo" placeholder="Warna Barang" autocomplete="off" value=" "  autocomplete="off"  class="form-control" hidden>

                    <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->id;?>" hidden>
                    <input type="text" name="id_quo_dt " placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->number_quo;?>" hidden>

                    <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                    <input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
                    echo date('Y-m-d H:i:s');
                ?>"  class="form-control" hidden>

                <hr>

                <div class="form-group col-12">

                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
 
              </div>
          </div>
          <hr>
      </div>
  </div> 

  
  <div class="modal-footer modal-footer-fixed">
   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>

</div>
</div></form>


</div>
</div>-->
<!-- end modal tambah item -->
</div>
</div>
</div>
</br>
 <div class="col-lg-6 mb-4">
  <form action="<?= base_url('user/quotation/save_quo_sattle') ?>" id="form" method="POST" enctype="multipart/form-data" name="formcek2">
  
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Alba Unggul</h6>
        </div>
        <div class="card-body">
            <div class="form-group col-12">
                <input type="text" readonly name="id" value="<?= $hd_quo->id ?>"  class="form-control" hidden>
                <label>Tanggal Permintaan</label>
                <input type="date"  name="trans_Date" value="<?= $hd_quo->trans_Date ?>"  readonly class="form-control">
            </div>
            <div class="form-group col-12">
                <label>ID</label>
                <input type="text" readonly name="number_quo" value="<?= $hd_quo->number_quo ?>"  class="form-control">
            </div>

            <div class="form-group col-12">
                <label>Customer</label>
                <input type="text" readonly name="" value="<?= $hd_quo->customer ?>"  class="form-control">
                <input type="text" readonly hidden name="kd_cst_quo" value="<?= $hd_quo->kd_cst_quo ?>"  class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Sales</label>
                <input type="text" readonly name="" value="<?= $hd_quo->sales ?>"  class="form-control">
                <input type="text" readonly  name="kdSales" value="<?= $hd_quo->kdSales ?>"  class="form-control" hidden>
            </div>



    </div>
</div>
</div> <!-- Panel 1 System -->

<?php $txt = sprintf("%04s", $generate_kode_wo);
//$kodeTransaksi_po = 'PO.'.date('Y').'.'.date('m').'.'.$txt;
$kodeTransaksi_csa = 'QT'.'/'.date('Y').'/'.date('m').'/'.$txt;
?>
<?php $txt = sprintf("%04s", $generate_kode_stok);
//$kodeTransaksi_po = 'PO.'.date('Y').'.'.date('m').'.'.$txt;
$kodeTransaksi_stok = 'Quo'.'/'.date('Y').'/'.date('m').'/'.$txt;
?>
<div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Alba Unggul</h6>
        </div>
        <div class="card-body">

            <div class="form-group col-12">
                <label>Tanggal</label>
                <input type="date" name="trans_Date" value="<?= date('Y-m-d')?>"  class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Nomor Proses</label>
                <select id="combo_jenis" name="jenis_pembayaran" class="form-control" required>

                    <option value="QT">QT</option>
                    
                </select>
            </div>
            <div class="form-group col-12" id=qt>
                <label>No. Proses</label>  
                <input type="text"   name="number_1" value="<?= $kodeTransaksi_csa ?>"  class="form-control">
                <!--    <input type="text" readonly  name="typeAutoNumber" value="16"  class="form-control" hidden> -->
            </div>
         
<script>
    $(document).ready(function(){ 

      $("select[id=combo_jenis]").on("change", function() { 
        if ($(this).val() === "QT") { 
            $("div[id=qt]").show().find('input, textarea').prop('disabled', false);
           
        } 
        
    }); 
      $("select[id=combo_jenis]").trigger("change");


  });
</script> 

</div>
</div>
                        
<?php foreach ( $dt_quo as $row): ?>
   <input type="text" readonly  name="detailName_quo[]" value="<?= $row->detailName_quo ?>"  class="form-control" hidden>
   <?php $kode_barang =  $row->item_no ?>    
   <input type="text" readonly  name="item_no[]" value="<?= $kode_barang ?>"  class="form-control" hidden>

   <input type="text"  placeholder="Harga satuan" name="status_proses_quo[]" value="3"  class="form-control" hidden>
   <input type="text"  placeholder="Harga satuan" name="status_quo[]" value="3"  class="form-control" hidden>
   <input type="text"  name="detailNotes_quo[]" value="<?= $row->detailNotes_quo ?>"  class="form-control" hidden>
   <input type="text"  name="id_quo_dt[]" value="<?= $row->id_quo_dt  ?>"  class="form-control" hidden>
   <input type="text"  placeholder="Estimasi Harga" name="estimasi_harga[]" value="<?= $row->estimasi_harga ?>"  class="form-control" hidden>
   
<?php endforeach ?>                     
</div> <!-- Panel 2 System -->

<hr>
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <?php if(!empty($dt_quo)):?>


                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Kosongkan Inputan</button>
                <?php else:?>
               <button type="submit" disabled class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Tidak ada data yang perlu di proses</button>

           <?php endif;?>

       </div>
   </div>
</div> <!-- Panel 1 System -->
</div>
</div>  </form> 
<!-- load footer -->
<?php $this->load->view('user/partials/footer.php') ?>
</div>
</div>
<script>


    document.querySelector('#form').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();



      swal({
          title: "Sudah Yakin ?",
          text: "Data Akan Disimpan!",
          icon: "warning",
          buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
          ],
          dangerMode: true,
      }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Success!',
              text: 'Data Berhasil Disimpan!',
              icon: 'success'
          }).then(function() {
              form.submit();
          });
      } else {
        swal("Cancelled", "Data tidak ada perubahan :)", "error");
    }
})
  
});
</script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}
</script>

<script> 
    function validateForm2() {

        if (document.forms["formcek2"]["pemasok"].value == "") {
            alert("Pemasok Tidak Boleh Kosong");
            document.forms["formcek2"]["pemasok"].focus();
            return false;
        }
        if (document.forms["formcek2"]["departmentName"].value == "") {
            alert("Department Tidak Boleh Kosong");
            document.forms["formcek2"]["departmentName"].focus();
            return false;
        }
        if (document.forms["formcek2"]["branchName"].value == "") {
            alert("Cabang Tidak Boleh Kosong");
            document.forms["formcek2"]["branchName"].focus();
            return false;
        }

    }
</script>
<script>
    $(document).ready(function(){

       $('.delete_checkbox_daily').click(function(){
          if($(this).is(':checked'))
          {
             $(this).closest('tr').addClass('removeRow');
         }
         else
         {
             $(this).closest('tr').removeClass('removeRow');
         }
     });

       $('#delete_all').click(function(){
          var checkbox = $('.delete_checkbox_daily:checked');
          if(checkbox.length > 0)
          {
             var checkbox_value = [];
             $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });
             $.ajax({
                url:"<?php echo base_url(); ?>user/quotation/delete_detail_quo",
                method:"POST",
                data:{checkbox_value:checkbox_value},
                success:function()
                {
                   $('.removeRow').fadeOut(1500);
               }
           })
         }
         else
         {
             alert('Select atleast one records');
         }
     });

   });
</script>

<script>

function formatRupiah(angka){
    return angka.replace(/\D/g,'')
                .replace(/\B(?=(\d{3})+(?!\d))/g,'.');
}

// format saat mengetik
$(document).on("keyup","input[id^='bisaEstimasi']",function(){
    $(this).val(formatRupiah($(this).val()));
});


// sebelum form disubmit hapus titik
$("form").on("submit", function(){

    $("input[name='estimasi_harga']").each(function(){

        let angka = $(this).val().replace(/\./g,'');
        $(this).val(angka);

    });

});

</script>


<script>
    //jika status yang di pilih adalah Bisa Estimasi maka tampilkan kolom harga untuk di input
  $(document).ready(function() {
    $("select[id=combo_status-<?= $row->id_dt; ?>]").on("change", function() {
      const selectedValue = $(this).val();
      const customer = '<?= $row->nama_cst; ?>';
      const hargaDiv = $("div[id=BisaEstimasi-<?= $row->id_dt; ?>]");
     

      if ((selectedValue === "Bisa Estimasi" )) {
        hargaDiv.show().find('input, textarea').prop('', true).prop('', false);
       
      } else {
        hargaDiv.hide().find('input, textarea').prop('', true).prop('', true);
      
      }
    });

    $("select[id=combo_status-<?= $row->id_dt; ?>]").trigger("change");
  });
</script>


<?php $this->load->view('user/partials/js.php') ?>

</body>
</html>