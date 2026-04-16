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
					
				     <button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button> 
					</div>
				</div>
				<hr>
<?php

    $token1 = $hd_api->akses_token;
    $session2 = $hd_api->session_api;
    $no_po = $hd_pr->number_ ;

    $url = "https://public.accurate.id/accurate/api/purchase-order/list.do?fields=number,id,charField1,project,date&access_token=$token1&session=$session2&filter.keywords.val=" . urlencode($no_po);
        $response = file_get_contents($url);

        if ($response) {
            $data = json_decode($response, true);

            if ($data['s'] === true) {
                $results = $data['d'];

                // Tampilkan hasil pencarian
                foreach ($results as $result) {
                     $id_number = $result['number'] ;
                   $id_accurate =   $result['id'] ;
                    echo   "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Pesanan Pembelian <u><strong>$id_number</strong></u> Terhubung Dengan Accurate Online 
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                }
            }
            if (empty($results)) {
                echo 
                    "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Pesanan Pembelian <u><strong>$no_po</strong></u> Belum Terhubung Dengan Accurate Online
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
        } else {
            echo 
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          Gagal mengambil Data dari API Accurate Online
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
            </div>";
        }
    
    ?>
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
					                                                 <?php if(empty($results) and $gagal_terhubung !='gagal'):?>
                        <div class="float-left lingkaran1" title="Pembelian ini belum terhubung dengan Accurate Online"></div> &nbsp;
                        <?php endif ;?>
                        <?php if(!empty($results)):?>
                        <div class="float-left logo_sukses" title="Pembelian ini terhubung dengan Accurate Online"></div> &nbsp;
                        <?php endif ;?>
                           <?php if($gagal_terhubung =='gagal'):?>
                        <div class="float-left logo_gagal_trhubung" title="Gagal Mengambil Data dari Accurate Online"></div> &nbsp;
                        <?php endif ;?> 
					      	<a data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle"><font color="white"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Pdf</font></a>
					      	<div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
					      		<a href="<?= base_url('user/pembelian/export_pesanan_pembelian01/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; CSA</a>
					      		<a href="<?= base_url('user/pembelian/export_pesanan_pembelian02/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; MSA</a>
					      		<a href="<?= base_url('user/pembelian/export_pesanan_pembelian03/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;SPK CSA</a>
					      		<a href="<?= base_url('user/pembelian/export_pesanan_pembelian04/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;SPK MSA</a>
					      	</div>
					 <?php if($emp->department == 'Purchasing' AND $hd_pr->status_po == 9):?>
					<a data-toggle="modal" style="color:white" data-target="#right_modal_jadwal<?php echo $hd_pr->id ; ?>" class="btn btn-primary btn-sm"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Jadwalkan Ulang Pengiriman </a>


					<?php endif;?>    	
					<?php if($hd_pr->status_po == 6 OR $hd_pr->status_po == 10):?>
					<a href="<?= base_url('user/pembelian/list_pengiriman') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Pengiriman </a>
					<?php endif;?>
				<?php if($hd_pr->status_po == 9):?>
					<a href="<?= base_url('user/pembelian/list_klaim') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Komplain </a>
				<?php endif;?>
				<?php if($hd_pr->status_po == 7):?>
					<a href="<?= base_url('user/pembelian/list_selesai') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Pesanan Pembelian Selesai </a>
				<?php endif;?>
				 <?php if($emp->department == 'Purchasing' OR  $emp->department == 'IT'):?>
				 <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate_hd" class="btn btn-primary btn-sm "><i class="fa fa-pencil"></i>&nbsp;&nbsp;Ubah status </a>
				 <?php endif;?>
				</div></div>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate_hd" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Update Status Pesanan Pembelian  <?php echo $hd_pr->number_; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/pembelian/ubah_po_Hd_back') ?>" enctype="multipart/form-data" name="form" id="from2" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">ID Accurate</span></label>
                                             <input  type="text"   maxlength="50"  name="id" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $id_accurate ?>"  readonly class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Tanggal</span></label>
                                             <input  type="date"   maxlength="50"  name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $hd_pr->transDate ?>"  readonly class="form-control">
                                </div>
                              <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">No</span></label>
                                             <input  type="text "  readonly  name="number_" placeholder="" autocomplete="off" value="<?php echo $hd_pr->number_; ?>"  class="form-control">
                                              <input  type="text " hidden maxlength="50"  name="number_lama" placeholder="" autocomplete="off" value="<?php echo $hd_pr->number_; ?>"  class="form-control">
                                </div> 
                             <input  type="text "  readonly maxlength="50"  name="id_header" placeholder="" autocomplete="off" value="<?php echo $hd_pr->id; ?>"  class="form-control" hidden>
                              <input  type="text "  readonly   name="number_pr" placeholder="" autocomplete="off" value="<?php echo $hd_pr->number_pr; ?>"  class="form-control" hidden>                      
                                                                           <div class="form-group col-12">
                             <label>Pilih Status</label>
                            <select name="status_po" class="form-control" >
                            <option value="5" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == '5' ? 'selected' : '';
                            }
                            ?>>Persetujuan Direksi</option>
                            <option value="11" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == '11' ? 'selected' : '';
                            }
                            ?>>Persetujuan PM</option>
                           	<option value="4" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == '4' ? 'selected' : '';
                            }
                            ?>>Persetujuan Estimator</option>
                            </select>
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
                                      <script>
                                        document.querySelector('#from2').addEventListener('submit', function(e) { 
                                            var form = this;
                                          //  var input = $('#from2').serialize();
                                            e.preventDefault();

                                            swal({
                                                title: "Are you sure?",
                                                text: "Pesanan Pembelian Akan Dihapus dari Accurate Setelah Disetujui",
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
                                                        text: 'Pesanan Pembelian Berhasil Dihapus dari Accurate, Approved!',
                                                        icon: 'success'

                                                    }).then(function() {
                                                        $.ajax({ 
                                                            type: 'POST',
                                                            url: 'https://public.accurate.id/accurate/api/purchase-order/delete.do?access_token=<?= $token1;?>&session=<?= $session2;?>&id=<?= $id_accurate ?>',
                                                         //   data: JSON.stringify(input),
                                                         //   mode: 'no-cors',
                                                            dataType : 'JSON',
                      //    contentType: 'application/json; charset=utf-8',
                                                            success:function(data){
                                                                console.log(data)
                                                            }

                                                        })

                                                    }).then(function(data) {
                                                        window.setTimeout(function() { document.form.submit(); }, 1000);        
                                                    })
                                                }  else {
                                                    swal("Cancelled", "Pesanan Pembelian tidak ada perubahan :)", "error");
                                                }
                                            });
                                        });


                                    </script>

    </div>
  </div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-5">
									<div class="table-responsive">
								<table class="table table-borderless">
									<tr>
										<td><strong>No Permintaan</strong></td>
										<td width="5">:</td>
										<td><?= $hd_pr->number_pr ?></td>
									</tr>
								<tr>
										<td><strong>No Pesanan Pembelian</strong></td>
										<td width="5">:</td>
										<td><?= $hd_pr->number_ ?></td>
									</tr>
									<tr>
										<td><strong>Tanggal</strong></td>
										<td>:</td>
										<td><?= $hd_pr->transDate ?></td>
									</tr>
									<tr>
										<td><strong>Project</strong></td>
										<td>:</td>
										<td><?php if (!empty($hd_pr->nama_project)):?><?= $hd_pr->nama_project ?><?php endif ;?></td>
								
									</tr>
									<tr>
										<td><strong>Status</strong></td>
										<td>:</td>
										<td>     <?php $status_pr = $hd_pr->status_po  ?>
                                            <?php if ($status_pr == 1):?>
                                              <span class="badge badge-warning">PR- Menunggu Approval PM </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 2):?>
                                              <span class="badge badge-info">PR- Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 3):?>
                                            <span class="badge badge-info">Purchasing Mencari Supplier </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 4):?>
                                            <span class="badge badge-info">PR Settle -Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 5):?>
                                            <span class="badge badge-primary">PR Settle- Menunggu Approval Direksi</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 6):?>
                                            <span class="badge badge-primary">Menunggu Barang dikirim dari supplier</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 7):?>
                                            <span class="badge badge-success">Barang sudah diterima</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 8):?>
                                            <span class="badge badge-danger">Barang direject</span>
                                            <?php endif;?>
                                          	<?php if ($status_pr == 9):?>
                                            <span class="badge badge-secondary">Klaim, Barang Tidak Sesuai</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 10):?>
                                            <span class="badge badge-info">Proses Pengiriman Ulang </span>
                                            <?php endif;?></td>

									</tr>
									<tr>
										<td><strong>Deskripsi </strong></td>
										<td>:</td>
										<td><?php if (!empty($hd_pr->description)):?><?= $hd_pr->description ?><?php endif ;?></td>
									</tr>
									<tr>
										<td><strong>Pajak </strong></td>
										<td>:</td>
										<td><div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input"   <?php if($hd_pr->taxable == 'true'){echo 'checked';}?> disabled>Kena Pajak
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input"    <?php if($hd_pr->taxable == 'false'){echo 'checked';}?> disabled>Tidak Kena Pajak
  </label>
</div>
</td>
									</tr>
									<tr>
										<td><strong>Pemasok</strong></td>
										<td>:</td>
										<td><?php if (!empty($hd_pr->Nama)):?><?= $hd_pr->Nama ?><?php endif ;?></td>
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
									  <tr>
                                        <td><strong>Berkas</strong></td>
                                        <td>:</td>
                                        <td><?php if (!empty($hd_pr->berkas_pdf)):?><a target="blank" href="<?php echo base_url(); ?>img/uploads/berkas_pembelian/<?= $hd_pr->berkas_pdf ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat Berkas</span></a>
                                           <?php endif ;?></td>
                   </tr>
									<tr>
										<td><strong>Status Pembayaran</strong></td>
										<td>:</td>
										<td><?php if ($hd_pr->sisa_pembayaran != 0):?> <span class="badge badge-warning">Proses Pembayaran</span> <?php endif ;?>
											<?php if ($hd_pr->sisa_pembayaran == 0):?><span class="badge badge-success">Proses Pembayaran telah selesai </span><?php endif ;?>
										</td>
									</tr>
									<tr>
										<td><strong>Total Pembayaran</strong></td>
										<td>:</td>
										<td> <?php
										$hasil_rupiah_total = "Rp " . number_format($hd_pr->total_tagihan,0,',','.');
										echo $hasil_rupiah_total; ?></td>
									</tr>
<?php if ($hd_pr->sisa_pembayaran != 0):?>
									<tr>
										<td><strong>Sisa Pembayaran</strong></td>
										<td>:</td>
										<td> <?php
										$hasil_rupiah_sisa = "Rp " . number_format($hd_pr->sisa_pembayaran,0,',','.');
										echo $hasil_rupiah_sisa; ?></td>
									</tr>
<?php endif ;?>
								</table>
                                   
<?php if (!empty($hs_header)):?>

    <a href="<?= base_url('user/pembelian/detail_po_dt_log/' . $hd_pr->id ) ?>" target="_blank" class="btn btn-outline-info btn-sm" style="color:black"> Riwayat Perubahan Data Header</a>
<?php endif;?>
<?php if (empty($hs_header)):?>
<a class="btn btn-outline-warning btn-sm" style="color:black"> Tidak Tersedia Riwayat Perubahan Data Header</a>

  </button>
<?php endif;?></div>
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
												<td><font size="2"><?= $row->status ?></font> </td>
												<td><font size="2"><?= $row->action_by ?></font> </td>
											</tr>
									<?php endforeach ?>
									</tbody>
								</table></div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											
											<td width="10"><strong>Id</strong></td>
                                            <td width="10"><strong>RaB</strong></td>
											<td><strong>Nama Barang</strong></td>
											<td width="100"><strong>Kode</strong></td>
											<td width="10"><strong>Jumlah</strong></td>
											<td  width="50"><strong>Satuan</strong></td>
											<td  width="50"><strong>Jenis</strong></td>
											<td width="130"><strong>Harga</strong></td>
											<td width="130"><strong>Total</strong></td>
											<td  width="200"><strong>Status</strong></td>

											
											<td width="100"><strong>Aksi</strong></td>
											</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($dt_pr as $row): ?>
											<tr>
												
									
												<td><?= $row->id_dt ?></td>
                                                              <td>
                                                <?php if(!empty($row->id_rap)):?>
                                                    
                                                    <a target="_blank" href="<?php echo base_url('user/leads/rab/'.$hd_pr->projectNo) ?>"><?= $row->id_rap ?> </a>
                                                <?php endif;?>
                                                </td>
												<td><?= $row->detailName ?></td>
													<td><?= $row->itemNo ?></td>
												<td align="center"><?= $row->quantity ?></td>
												<td><?= $row->itemUnitName ?></td>
												<td><?= $row->jenis_p_item ?></td>
												<td align="center"><?php if(!empty($row->unitPrice)):?>
												<?php
												$hasil_rupiah = "Rp " . number_format($row->unitPrice,0,',','.');
												echo $hasil_rupiah; ?> <?php endif;?></td>
												<td align="center"><?php if(!empty($row->unitPrice)):?>
													<?php 

													if (!empty($row->itemDiscPercent)) {
														$disc = $row->itemDiscPercent;
													}else{
														$disc = 0;
													}
													$harga = $row->unitPrice * $row->quantity;

													$hasilnya_disc = $harga * $disc / 100 ;
													$total_harga = $harga - $hasilnya_disc;

													$hasil_rupiah = "Rp " . number_format($total_harga,0,',','.');
													echo $hasil_rupiah;
													?><?php endif;?></td>
												<td align="center">
													 <?php $status_item = $row->status_item  ?>
                          <?php if ($status_item == 'SESUAI'):?>
                            <span class="badge badge-success">SESUAI </span>
                          <?php endif;?>
                          <?php if ($status_item == 'TIDAK SESUAI'):?>
                            <span class="badge badge-danger">TIDAK SESUAI</span>
                          <?php endif;?>
												</td>

												<td><a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat</a> </td>
											</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Detail Pesanan Pembelian <?php echo $row->id_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/pembelian/proses_klaim_po') ?>" enctype="multipart/form-data"   method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                         
                            <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                             <input  type="text" maxlength="50" readonly name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">ID Barang</span></label>
                                             <input  type="text "  readonly maxlength="50"  name="itemNo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->itemNo; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Gambar</span></label>
                                             <input  type="file"   maxlength="50"  name="berkas" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control">
                                </div>
                                <?php if(!empty($row->foto)):?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Lihat Gambar</span></label>
                                            <a href="<?php echo base_url(); ?>img/uploads/berkas1/<?= $row->foto ?>" target="_blank" style="text-decoration: underline;"><font size="2px" color="blue"><?= $row->foto ?></font></a>
                                </div>
                              <?php endif;?>

                             
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Status</span></label>
                                               <select id="combo_jenis" name="status_item" class="form-control" >
                                            <option value="SESUAI" <?php
			                                        if (!empty($row->status_item)) {
			                                            echo $row->status_item == 'SESUAI' ? 'selected' : '';
			                                        }
			                                        ?>>SESUAI</option>
			                                 			<option value="TIDAK SESUAI" <?php
			                                        if (!empty($row->status_item)) {
			                                            echo $row->status_item == 'TIDAK SESUAI' ? 'selected' : '';
			                                        }
			                                        ?>>TIDAK SESUAI</option>
                                            
                                            </select>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Catatan</span></label>
                                            <textarea class="form-control" name="status_item_noted"><?php echo $row->status_item_noted; ?></textarea>
                                </div>
                               <input type="text" name="id_header" placeholder="Id header po" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
                               <input type="text" name="id_dt" placeholder="Id detail po" autocomplete="off"  class="form-control"  value="<?php echo $row->no; ?>" hidden>
                               <input type="text" name="number_pr" placeholder="Number PR" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>

                                        <hr>

       <div class="form-group col-12">
      <?php if($hd_pr->status_po == 6 OR $hd_pr->status_po == 10):?>
                                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
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
</div>
										<?php endforeach ?>
									</tbody>
	<?php foreach ($dt_pr_count_estimator as $row): ?>
			<tr>
				<td colspan="8" align="right">Total</td>
				
				<td colspan="8"> <?php
				$hasil_rupiah = "Rp " . number_format($row->total_almount,0,',','.');
				echo $hasil_rupiah; ?></td>                                
			</tr>
						<tr>
				<td colspan="8" align="right">Disc</td>

				<td colspan="4">    <?php if($hd_pr->cashDiscount != 0):?>
				<?php
				$diskon = $hd_pr->cashDiscount ;
				$diskon_h = "Rp " . number_format($diskon,0,',','.');
				echo $diskon_h; ?>
			<?php else: ?>
				<?= '0' ?>
				<?php endif;?></td>                                
			</tr>
                                    <tr>

                                        <td colspan="8" align="right">VAT (11%)</td>

                                        <td colspan="4">    <?php if($hd_pr->taxable == 'true' AND $hd_pr->cashDiscount != 0):?>
                                        <?php
                                        $diskon_1 = $row->total_almount_true - $hd_pr->cashDiscount;
                                        $pajak_1 = $diskon_1 * 11 / 100 ;
                                        $pajak = "Rp " . number_format($pajak_1,0,',','.');
                                        echo $pajak; ?>
                        
        
                                        <?php elseif($hd_pr->taxable == 'true' AND $hd_pr->cashDiscount == 0):?>
                                        <?php
                                        $diskon_1 = $row->total_almount_true - $hd_pr->cashDiscount;
                                        $pajak_1 = $diskon_1 * 11 / 100 ;
                                        $pajak = "Rp " . number_format($pajak_1,0,',','.');
                                        echo $pajak; ?>
                                    <?php else: ?>
                                        <?= '0' ?>
                                        <?php endif;?>

                                        </td>


                                    </tr>

                                    <tr>
                                        <td colspan="8" align="right"> <b>Grand Total</b></td>

                                        <td colspan="4">  <b>
                                           <?php if($hd_pr->taxable == 'true'):?>

                                               <?php
                                        $diskon_1 = $row->total_almount_true - $hd_pr->cashDiscount;
                                        $pajak_1 = $diskon_1 * 11 / 100 ;
                                                $diskon = $hd_pr->cashDiscount ;
                                               $hasil_withpajak = $pajak_1 + $row->total_almount - $diskon; 
                                               $hasil = "Rp " . number_format($hasil_withpajak,0,',','.');
                                               echo $hasil; ?>
                                           <?php else: ?>
                                            <?php
                                             $diskon = $hd_pr->cashDiscount ;
                                            $total_harga_2 = $row->total_almount - $diskon; 
                                            $hasil_rupiah = "Rp " . number_format($total_harga_2,0,',','.');
                                            echo $hasil_rupiah; ?>
                                            <?php endif;?></b></td>                                
                                        </tr>

				<?php endforeach ?>
								</table> 
									<form action="<?= base_url('user/pembelian/finish_pesanan_pembelian') ?>" enctype="multipart/form-data" id="from_finish" method="POST">
							       <div class="form-group col-12">
							       
							       	  <input type="text" name="id" placeholder="Number PR" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>
							       	  <input type="text" name="number_pr" placeholder="Number PR" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr; ?>" hidden>
							       	   <input type="text" name="number_" placeholder="Number PR" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_; ?>" hidden>

												<?php
                        $persentasi=round($hd_pr->proses/$hd_pr->progres * 100,2); 
                         $persentasi;  ?>
                       <?php if($persentasi == 100 and $hd_pr->status_po == 10 OR $hd_pr->status_po == 6):?>
                       <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Selesaikan Pesanan</button>
                       <?php endif;?>

                       </div>
                    </form></div>
</br>
<?php if (!empty($hs_price)):?>
  <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   Riwayat Perubahan Harga
  </button>
<?php endif;?>
<?php if (empty($hs_price)):?>
  <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Tidak Tersedia Riwayat Perubahan Harga
  </button>
<?php endif;?>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTablec" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th >No</th >
                                            <th  align="center" scope="col">Tanggal</th >
                                            <th >Id</th >
                                            <th  align="center" scope="col" class="column-primary" data-header="Leads">Nama Barang</th >
                                            <th  align="center" scope="col">Harga Lama</th >
                                            <th  align="center" scope="col">Harga Baru</th >
                                            <th  align="center" scope="col">Keterangan</th >
                                            <th  align="center" scope="col">By</th >
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $no = 1;
                                        foreach ($hs_price as $row): ?>
                                            <tr> <?php $number = $no++; ?>
                                            <td data-header="No"><?= $number ?></td>
                                            <td width="100"><?= $row->waktu_ubah ?></td>
                                            <td width="50"><?= $row->id_po ?></td>
                                            <td data-header="Project"><?= $row->nama_barang ?></td>
                                            <td width="130">
                                                <?php
                                                $old_price = "Rp " . number_format($row->harga_lama,0,',','.');
                                                echo $old_price; ?> 
                                            </td>
                                            <td width="130">
                                                <?php
                                                $new_price = "Rp " . number_format($row->harga_baru,0,',','.');
                                                echo $new_price; ?> 
                                            </td>
                                            <td width="200"><?= $row->keterangan_ ?></td>
                                            <td width="150"><?= $row->action_byy ?></td>

                                        </tr>
                                    <?php endforeach ?>
                  
                                </tbody>
                            </table>
                        </div>
  </div>
</div>
							</div>

<!-- modal update System --> 
<div  class="modal modal-right fade" id="right_modal_jadwal<?php echo $hd_pr->id; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Jadwalkan Ulang Pengiriman - <?php echo $hd_pr->number_; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/pembelian/proses_pengiriman_ulang') ?>" enctype="multipart/form-data"   method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                             <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">No Permintaan Barang</span></label>
                                             <input  type="text "  readonly maxlength="50"  name="number_pr" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $hd_pr->number_pr; ?>"  class="form-control">
                                </div>
                            <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">No. Pesanan Pembelian </span></label>
                                             <input  type="text" maxlength="50" readonly name="number_" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $hd_pr->number_; ?>"  class="form-control">
                                </div>
                            <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Pemasok </span></label>
                                             <input  type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $hd_pr->Nama; ?>"  class="form-control">
                                </div>
                              <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Tanggal Pengiriman </span></label>
                                             <input  type="date" maxlength="50"  name="shipDate" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control">
                                </div>
                               <input type="text" name="id_header" placeholder="Id header po" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>

                                        <hr>

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
</div></div>
<div class="form-group col-12">
	 <div class="bg-light text-right"> 
<form action="<?= base_url('user/pembelian/proses_approve_po') ?>" enctype="multipart/form-data" id="from1" method="POST">

	<input type="text" name="id" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>
	<input type="text" name="number_" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_; ?>" hidden>
	<input type="text" name="number_pr" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr; ?>" hidden>
	<?php  	$cek_jabatan 	= $emp->divisi.' '.$emp->department;
			$cek_status_pr 	= $hd_pr->status_po; ?>

	<?php if($cek_jabatan == 'Manager Project' and $cek_status_pr == 1):?>
	<input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="2" hidden>
	<input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="PM Mengetahui" hidden>  
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;PM Approve</button>
	 <?php endif;?>

	<?php if($cek_jabatan == 'Staff Qs' and $cek_status_pr == 2):?>
	<input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="3" hidden>
	<input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="Estimator Mengetahui" hidden>  
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Estimator Approve</button>
	<?php endif;?>
		<?php if($cek_jabatan == 'Staff Qs' and $cek_status_pr == 4):?>
	<input type="text" name="status_po" placeholder="" autocomplete="off"  class="form-control"  value="5" hidden>
	<input type="text" name="status" placeholder="" autocomplete="off"  class="form-control"  value="Estimator Mengetahui, No Pesanan <?php echo $hd_pr->number_; ?>" hidden>  
	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Estimator Approve</button>
	<?php endif;?>
    	<?php if($cek_jabatan == 'Manager Purchasing' or $cek_jabatan == 'Staff Purchasing' and $cek_status_pr == 3):?>
	 <a  onclick="return confirm('Lanjut ?')" href="<?= base_url('user/pembelian/kelengkapan_pr/' . $hd_pr->id ) ?>"  class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Lengkapi Data PR</a>
	<?php endif;?> 	
 </form>
</div>
 </div>
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script> 
        function validateForm2() {
            if (document.forms["from_cek"]["combo_jenis"].value == "") {
                alert("Status Klaim Tidak Boleh Kosong");
                document.forms["from_cek"]["combo_jenis"].focus();
                return false;
            }
        }
</script>
 <script>
    document.querySelector('#from_finish').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Setelah ini anda tidak bisa  mengajukan komplain lagi!",
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
              text: 'Pesanan Pembelian Diselesaikan!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Pesanan Pembelian tidak ada perubahan :)", "error");
          }
        });
    });
  </script>
</body>
</html>