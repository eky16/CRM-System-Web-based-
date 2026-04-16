<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        scrollX: true,
    });
});
</script>



<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
        "lengthMenu": [ 5,10, 25, 50, 75, 10
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<?php error_reporting(0);  ?>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
				
                            <a href="<?= base_url('user/quotation/tambah_quo') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
					
					</div>
				</div>
				<hr>

                <style>
.bg-h3 {
    background-color: #fff3cd !important; /* kuning muda */
}
.bg-h {
    background-color: #ffe5b4 !important; /* oranye lembut */
}
.bg-overdue {
    background-color: #f8d7da !important; /* merah */
}

.warning-icon {
    margin-left: 6px;
    font-size: 14px;
    color: #856404;
}
.bg-h .warning-icon {
    color: #b45309;
}
.bg-overdue .warning-icon {
    color: #721c24;
}
</style>

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
                 <?php if($title == "List Payment Waiting Approved"):?>   
					<div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/finish_"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
   <div class="panel-body">
    <form method="post" action="<?= base_url('mom/lihat_filter') ?>" class="form-horizontal">  
        <div class="panel_controls">                         
    <!--          <div class="form-group">
           </br>

 <div class="col-sm-5">                             
                 <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($all_leads_project as $lsp) : ?>
                                <option value="<?php echo $lsp->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $lsp->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option>
                                    <?php endforeach; ?>

                        </select>  
            </div>
            </div>
          
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-primary">Cari</button>  
            <a href="<?= base_url('mom/lihat_semua') ?>"> 
            <input type="button" class="btn btn-primary" value="Semua" \></a>                           
        </div> -->

    </div>
    </form>  
</div>  

<hr>

<div class="card-header">
                        <div class="float-right"> 
         <?php if ($title == "Kemajuan Pesanan Sales Order") :?>   
                   <a href="<?= base_url('user/quotation/export_excel_permintaan_diproses') ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Export Excel</a> 
                <?php endif; ?>

                   <?php if ($title == "Quotation Order List") :?>       
                    </div><font color="blue"><strong>Quotation Order List</strong></font>  / <a  href="<?php echo base_url(); ?>user/quotation/list_permintaan_item"><strong>Item Sales Order</strong></a>/ <a  href="<?php echo base_url(); ?>user/quotation/list_history_permintaan"><strong>Riwayat Sales Order</strong></a></div>
                    <?php endif; ?>

                    <?php if ($title == "Quotation Follow Up") :?>       
                    </div><a  href="<?php echo base_url(); ?>user/quotation/list_quo_order"><strong>Quotation Order List</strong></a> / <font color="blue"><strong>Quotation Follow Up</strong></font>/ <a  href="<?php echo base_url(); ?>user/quotation/quo_status"><strong>Estimation Completed</strong></a> <!--<a  href="<?php echo base_url(); ?>user/quotation/quo_item_selesai"><strong>Estimation Completed</strong></a> --></div>     
                     <?php endif; ?>
                     
                       <?php if ($title == "Riwayat Permintaan Barang") :?> 
                    </div><a  href="<?php echo base_url(); ?>user/quotation/list_permintaan"><strong> List Sales Order</strong></a> / <font color="blue"><strong>Riwayat Sales Order</strong></font></div>
                     <?php endif; ?>

                      <style>
    /* CSS untuk tabel */
    .colorful-table {
        border-collapse: collapse;
        width: 100%;
    }

    .colorful-table th,
    .colorful-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    /* CSS untuk warna sel tertentu */
    .color-Plum {
        background-color: Plum;
        color: black; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang merah */
    }

    .color-Brown {
        background-color: Brown;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang hijau */
    }
</style>

					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td class="color-Brown" width="1"><font size="2px"><strong>No</strong></font></td>
										<td class="color-Brown" width="50"><font size="2px"><strong>ID</strong></font></td>
										<td class="color-Brown" width="50"><font size="2px"><strong>Tgl Pesan</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Tgl Follow Up</strong></font></td>
										<td class="color-Brown" width="150"><font size="2px"><strong>Customer</strong></font></td>
                                        <td class="color-Brown"><font size="2px"><strong>Nama Barang</strong></font></td>
                                        
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Sales</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Segment</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Status Proses</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Status Harga</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Status Gambar</strong></font></td>
                                       
										<td class="color-Brown" width="50"><font size="2px"><strong>Aksi</strong></font></td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_quo as $row): ?>
<?php
$bgClass        = '';
$icon           = '';
$deadlineStatus = 'normal';
//echo '<pre>';
//print_r($row);
//die;
// Pastikan follow up date ada dan masih ada yang belum
if (
    (
        $row->total_estimasi == 0 ||
        $row->total_gambar == 0
    )
    && !empty($row->follow_up_date)
) {
    // Tanggal hari ini
    $today = new DateTime('today');

    // Tanggal follow up
    $followUpDate = new DateTime($row->follow_up_date);

    // Hitung status
    if (function_exists('hitungStatusFollowUp')) {
        $result = hitungStatusFollowUp($followUpDate, $today);

        $deadlineStatus = $result['status'] ?? 'normal';
        $bgClass        = $result['class']  ?? '';
        $icon           = $result['icon']   ?? '';
    }
}
?>

										<tr data-deadline="<?= $deadlineStatus  ?>">

											<td><font size="1px"><?= $no++ ?></font></td>
											<td><font size="2px"><?= $row->number_quo ?></font>
                                            </td>
											<td ><font size="2px"><?= $row->trans_Date ?></font></td>


                                            <td class="<?= $bgClass ?>"> <?= $row->follow_up_date ?>
                                               <?= $icon ?>
                                            </td> 

											<td><font size="2px"><?= $row->nama_cst ?></font></td>
                                            <td align="left"><font size="2px"><?= $row->detailName_quo ?>
                                             </td>
                                            
                                            <td><font size="2px"><?= $row->nama_karyawan ?></font></td>
                                           
                                            <td><font size="2px"><?= $row->nama_segment ?></font></td>
                                            <td><font size="2px"><?= $row->status_qr_quo ?></font></td>

                                            <td style="text-align:center;"><?= ($row->total_estimasi > 0) 
                                                 ? "<span style='color:green; font-size:18px;'>✔</span>" 
                                                 : "<span style='color:red; font-size:18px;'>✖</span>"; ?>
                                            </td>

                                            <td style="text-align:center;"><?= ($row->total_gambar > 0) 
                                                 ? "<span style='color:green; font-size:18px;'>✔</span>" 
                                                 : "<span style='color:red; font-size:18px;'>✖</span>"; ?>
                                            </td>



											<td><font size="2px">
                                                    <a  target="blank" href="<?= base_url('user/quotation/detail_quo/' . $row->id ) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a></font>
												</td>

                                                
										
										</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pindahkan <?php echo $row->number_pr; ?> ke Tabel Riwayat Permintaan Barang </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/pembelian/move_pr') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                Dibuat : <?php echo $row->created_po; ?>, <?php echo $row->createdtime_po; ?>
                                </div>
                                <div class="card-body">


          <input  type="text" hidden readonly name="id" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->id; ?>"  class="form-control" >
          <input  type="text" hidden readonly name="number_pr" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->number_pr; ?>"  class="form-control" >


										<div class="form-group col-12">
											<label>Progres Pemesanan Barang</label>
											 <input type="text" name="" placeholder="Tambah Laporan Proyek" autocomplete="off" readonly class="form-control" required value=" <?php 
                                                   $persentasi=round($row->proses/$row->progres * 100,2); 
                                                   echo "$persentasi% Dari" . " ".$row->progres." "."Pesanan Pembelian";
                                                 ?>" >
									</div>

                                    <div class="form-group col-12">
                                        <button type="submit"  class="btn btn-success"><i class="fa fa-history"></i>&nbsp;&nbsp;Proses </button>
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
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
<!-- modal update -->
 

			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
    <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>

    <script>
document.getElementById('filterDeadline').addEventListener('change', function () {
    const filterValue = this.value;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const deadline = row.getAttribute('data-deadline');

        if (filterValue === 'all') {
            row.style.display = '';
        } else {
            if (deadline === filterValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
</script>


	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>