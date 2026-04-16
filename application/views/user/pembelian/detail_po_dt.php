<?php ini_set('display_errors', 0); ?>
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
      font-size: 22px;Detail Id
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
.lingkaran1{
    width: 20px;
    height:20px;
    background: #dac52c;
    border-radius: 100%;
}
.logo_sukses{
    width: 20px;
    height:20px;
    background: #00FF00;
    border-radius: 100%;
}
.logo_gagal_trhubung{
    width: 20px;
    height:20px;
    background: #FF0000;
    border-radius: 100%;
}
    </style>

  
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('pengeluaran') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right">
                    
                     <button  class="btn btn-secondary btn-sm" onclick="window.close()"><i class="fa fa-times"></i> &nbsp;&nbsp;Tutup</button> 
                    </div>
                </div>
                <hr>
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <div class="card shadow">
                    <div class="card-header"><strong><?= $title ?> - <?= $hd_pr->created_po ?>, <?= $hd_pr->createdtime_po ?></strong>
                          <div class="float-right">
                     
                    <!--   <a data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle"><font color="white"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Pdf</font></a>
                        <div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
                        <a href="<?= base_url('user/pembelian/export_pesanan_pembelian01/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; CSA</a>
                        <a href="<?= base_url('user/pembelian/export_pesanan_pembelian02/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; MSA</a>
                        <a href="<?= base_url('user/pembelian/export_pesanan_pembelian03/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;SPK CSA</a>
                        <a href="<?= base_url('user/pembelian/export_pesanan_pembelian04/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;SPK MSA</a>
                        </div>  -->
                                            
                    <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate_hd" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Ubah Header </a> 
                  <!--  <a href="<?= base_url('user/pembelian/list_pesanan_pembelian') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Produksi </a> -->

                </div></div>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate_hd" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Detail Header <?php echo $hd_pr->number_; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/pembelian/ubah_po_Hd') ?>" enctype="multipart/form-data" id="from2" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">

                              <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">No</span></label>
                                             <input  type="text "    name="number_" placeholder="" autocomplete="off" value="<?php echo $hd_pr->number_; ?>"  class="form-control">
                                              <input  type="text " hidden maxlength="50"  name="number_lama" placeholder="" autocomplete="off" value="<?php echo $hd_pr->number_; ?>"  class="form-control">
                                </div> 
                             <input  type="text "  readonly maxlength="50"  name="id_header" placeholder="" autocomplete="off" value="<?php echo $hd_pr->id; ?>"  class="form-control" hidden>
                              <input  type="text "  readonly maxlength="50"  name="number_pr" placeholder="" autocomplete="off" value="<?php echo $hd_pr->number_pr; ?>"  class="form-control" hidden>
                            <div class="form-group col-md-12" >
                                            <label for="nama_barang"><span class="badge badge-success">Customer</span></label>
                                            <select name="kd_cst" class="form-control" >                             
                                                <?php foreach ($customer as $cst) : ?>
                                                    <option value="<?php echo $cst->kode_cst; ?>" 
                                                        <?php
                                                        if (!empty($hd_pr->kd_cst)) {
                                                            echo $cst->kode_cst == $hd_pr->kd_cst ? 'selected' : '';
                                                        }
                                                    ?>><?php echo $cst->nama_cst ?></option>                            
                                                <?php endforeach; ?>
                                            </select>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Sales</span></label>
                                       <select name="kd_sales" class="form-control" >                             
                                                                  <?php foreach ($sales as $sales) : ?>
                                                <option value="<?php echo $sales->kode_sales; ?>" 
                                                <?php
                                                if (!empty($hd_pr->kd_sales)) {
                                                    echo $sales->kode_sales == $hd_pr->kd_sales ? 'selected' : '';
                                                }
                                                ?>><?php echo $sales->nama_sales ?></option>                            
                                                    <?php endforeach; ?>
                                       </select>
                                </div>


                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Tanggal Kirim</span></label>
                                             <input  type="date"   maxlength="50"  name="shipDate" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $hd_pr->shipDate ?>"  class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Alamat Kirim</span></label>
                                             <textarea   maxlength="50"  name="toAddress"  autocomplete="off"   class="form-control"><?= $hd_pr->toAddress ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Keterangan</span></label>
                                             <textarea   maxlength="50"  name="description"  autocomplete="off"   class="form-control"><?= $hd_pr->description ?></textarea>
                                </div>
                     
        
                                                        <div class="form-group col-12">
      
                                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
       
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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                    <div class="table-responsive">
                                <table class="table table-borderless">

                                    <tr>
                                        <td><strong>ID</strong></td>
                                        <td width="5">:</td>
                                        <td><?= $hd_pr->number_pr ?></td>
                                    </tr>
                                <tr>
                                        <td><strong>No Pesanan Barang</strong></td>
                                        <td width="5">:</td>
                                        <td><?= $hd_pr->number_ ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Customer</strong></td>
                                        <td>:</td>
                                        <td><?= $hd_pr->nama_cst ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sales</strong></td>
                                        <td>:</td>
                                        <td><?= $hd_pr->nama_sales ?></td>
                                
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>:</td>
                                        <td>     <?php $status_pr = $hd_pr->status_po  ?>
                                            <?php if ($status_pr == "Forecast"):?>
                                              <span class="badge badge-warning"> Forecast </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Stok"):?>
                                              <span class="badge badge-info">Stok </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Produksi"):?>
                                            <span class="badge badge-info">Produksi </span>
                                            <?php endif;?></td>

                                    </tr>
                                    <tr>
                                        <td><strong>Deskripsi </strong></td>
                                        <td>:</td>
                                        <td><?php if (!empty($hd_pr->description)):?><?= $hd_pr->description ?><?php endif ;?></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Tanggal Kirim</strong></td>
                                        <td>:</td>
                                        <td><?php if (!empty($hd_pr->shipDate)):?><?= $hd_pr->shipDate ?><?php endif ;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat Kirim</strong></td>
                                        <td>:</td>
                                        <td><?php if (!empty($hd_pr->toAddress)):?><?= $hd_pr->toAddress ?><?php endif ;?></td>
                                    </tr>


                                </table>
                            </br>
                        </div>
                            </div>
                            
                            <div class="col-md-7">
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td width="155" colspan="3" align="center"><font size="2"><b>STATUS</b></font></td>
                                    
                                        </tr>
                                        <tr>
                                            <td width="155" ><font size="2">Waktu</font></td>
                                            <td width="250"><font size="2">Keterangan</font></td>
                                            <td width="200"><font size="2">Nama</font></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($his_pr as $row): ?>
                                            <tr>
                                                <td><font size="2"><?= $row->actiontime ?></font></td>
                                                <td><font size="2"><?= $row->status ?>
                                                         
                                                </font> </td>
                                                <td><font size="2"><?= $row->action_by ?></font> </td>
                                            </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table></div>
                            </div>
                        </div>
                        <hr>
<?php   $cek_jabatan    = $emp->divisi.' '.$emp->department;
$cek_status_pr  = $hd_pr->status_po; ?>
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <?php if($cek_jabatan == 'Staff Qs' and $cek_status_pr == 4 ):?>
                                            <th width="5%" style="text-align: center;"> <input type="checkbox" onclick="toggled(this);" >   </th>
                                        <?php endif;?>
                                        <?php if($cek_jabatan == 'Manager Project' and $cek_status_pr == 11 ):?>
                                            <th width="5%" style="text-align: center;"> <input type="checkbox" onclick="toggled(this);" >   </th>
                                        <?php endif;?>
                                            <td width="10"><strong>Id</strong></td>
                                            <td width="250"><strong>Nama Barang</strong></td>
                                            <td width="10"><strong>QR Code</strong></td>
                                            <td width="10"><strong>Jumlah</strong></td>
                                            <td  width="50"><strong>Satuan</strong></td>
                                            <td  width="50"><strong>Warna</strong></td>
                                            <td  width="100"><strong>Gambar Kerja</strong></td>
                                            
                                            <td width="50"><strong>Status</strong></td>
                                            <td width="50"><strong>Progres</strong></td>
                                            
                                            <td width="100"><strong>Aksi</strong></td>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
               
                                        <?php foreach ($dt_pr as $row): ?>
                                            <tr>
                                              

                                                <td><?= $row->id_dt ?>  <input type="text" class="form-control"   name="no[]" value="<?= $row->no ?>" hidden> </td>
                                                
                                                <td><?= $row->detailName ?></td>
                                                <td><?= $row->qr_code ?></td>
                                                <td align="center"><?= $row->quantity ?></td>
                                                <td><?= $row->itemUnitName ?></td>
                                                <td><?= $row->warna ?></td>
                                                <td align="center"> <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a><?php endif ;?></td>
                                                 <td align="center">
                                                 <?php $status_pr = $row->status_qr  ?>
                                            <?php if ($status_pr == "Cutting"):?>
                                              <span class="badge badge-info"> CUTTING </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Punching"):?>
                                              <span class="badge badge-info">PUNCHING </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Bending"):?>
                                            <span class="badge badge-info">BENDING </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Welding"):?>
                                            <span class="badge badge-info">WELDING </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "PS"):?>
                                            <span class="badge badge-info">PS </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "FA"):?>
                                            <span class="badge badge-info">FA </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Packing"):?>
                                            <span class="badge badge-info">PACKING </span>
                                            <?php endif;?> </td>
                                        <td align="center">
                                                 <?php $status_pr = $row->status_qr  ?>
                                            <?php if ($status_pr == "Cutting"):?>
                                                <?php $hasil =round(1/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Punching"):?>
                                               <?php $hasil =round(2/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Bending"):?>
                                             <?php $hasil =round(3/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Welding"):?>
                                             <?php $hasil =round(4/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?>
                                            <?php if ($status_pr == "PS"):?>
                                             <?php $hasil =round(5/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?>
                                            <?php if ($status_pr == "FA"):?>
                                            <?php $hasil =round(6/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?>
                                            <?php if ($status_pr == "Packing"):?>
                                            <?php $hasil =round(7/7*100,2);
                                                        echo $hasil."%"; ?>
                                            <?php endif;?> </td>
                                                <td>
                                                    <a  data-toggle="modal" style="color:white" data-target="#modal_update_dt<?php echo $row->no; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat </a>
                                                </td>

                                            </tr>

<div  class="modal modal-right fade" id="modal_update_dt<?php echo $row->no; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Update Permintaan Barang <?php echo $row->no; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('user/pembelian/ubah_po_dtt') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 
<input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
<input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
<input type="text" name="no" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->no; ?>" hidden>
<input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>
                                              <div class="modal-body">
                                               <!-- Content Column -->

                                               <div class="col-lg-12 mb-4">

                                                <!-- Project Card Example -->
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
                                                            <input  type="text "  readonly maxlength="50"  name="itemNo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->itemNo; ?>"  class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                                            <input  type="text" maxlength="240"  name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>"  class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Warna Barang </span></label>
                                                            <input  type="text" maxlength="240"  name="warna" placeholder="Masukkan Warna Barang" autocomplete="off" value="<?php echo $row->warna; ?>"  class="form-control">

                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"> <span class="badge badge-success">Jumlah</span></label>
                                                            <input  type="text "    maxlength="50"  name="quantity" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $row->quantity  ; ?>"  class="form-control">
                                                        </div> 
                                                         <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
                                                            <textarea   name="detailNotes" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->detailNotes; ?></textarea>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">QR Code </span></label>
                                                            <input  type="text" maxlength="240"  name="qr_code" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->qr_code; ?>"  class="form-control">

                                                        </div> 
                                                         <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Gambar Kerja </span></label>
                                                            <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?>
                                                            <input  type="file" maxlength="240"  name="gambar_kerja" placeholder="Upload File" autocomplete="off" value="<?php echo $row->gambar_kerja; ?>"  class="form-control">
                                                        </div>  
                                                        <div class="form-group col-md-12">
                                                                <label for="itemUnitName"> <span class="badge badge-success">Satuan </span></label>
                                                                <input type="text" name="itemUnitName" value="<?= $row->itemUnitName ?>"  class=" form-control" list="category2" autocomplete="off">
                                                                <datalist id="category2">
                                                                    <option value="">No Selected</option>
                                                                      <?php foreach ($satuan as $row): ?>
                                                                    <option value="<?= $row->nm_satuan ?>"></option>
                                                                <?php endforeach ?>
                                                                </datalist>
                                                            </div> 

<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

<input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>"  class="form-control" hidden>

<hr>

<div class="form-group col-12">

  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>

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

                                        <?php endforeach ?>

                                    </tbody>
   
                                </table>
                                       
                                </form> </div>

                            </div>
<?php foreach ($hitung_persentasi_dt as $row): ?>
   <?php
    $persentasi=round($row->e_approved/$row->progres * 100,2); 
    $persentasi;  ?>
<?php endforeach ?> 

<div class="form-group col-12">
     <div class="bg-light text-right"> 
<form action="<?= base_url('user/pembelian/proses_approve_po') ?>"  enctype="multipart/form-data" id="from1" method="POST">

    <input type="text" name="id" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>
    <input type="text" name="number_" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_; ?>" hidden>
    <input type="text" name="number_pr" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr; ?>" hidden>


    <?php if($cek_status_pr == 'Produksi' and $persentasi == 100):?>
    <input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="wh_fg" hidden>
    <input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="Produksi Selesai, No. WO <?php echo $hd_pr->number_; ?>" hidden>  
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Produksi Selesai</button>
    <?php endif;?>

    <?php if($cek_status_pr == 'Produksi' and $persentasi != 100):?>
    <input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="wh_fg" hidden>
    <input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="Produksi Selesai, No. WO <?php echo $hd_pr->number_; ?>" hidden>  
    <button type="disable" class="btn btn-primary" disabled><i class="fa fa-save"></i>&nbsp;&nbsp;<?= $persentasi ?>%</button>
    <?php endif;?>
 
 </form>
</div>

</p>
 </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
<!-- modal update System --> 



<!-- end modal tambah item -->
            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('user/partials/js.php') ?>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
    url:"<?php echo base_url(); ?>user/pembelian/delete_detail_p0",
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
    document.querySelector('#from1').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Anda Sudah Yakin?",
          text: "Status Produksi akan diubah!",
          icon: "warning",
          buttons: [
            'Tidak !!',
            'Ya, Proses !!!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Success!',
              text: 'Approved!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", " tidak ada perubahan :)", "error");
          }
        });
    });
  </script>
   <script>
    document.querySelector('#from2').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Data akan diubah!",
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
              text: 'Data Berhasil diubah!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Data tidak diupdate :)", "error");
          }
        });
    });
  </script>
  <script type="text/javascript">
    function toggled(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>
</body>
</html>