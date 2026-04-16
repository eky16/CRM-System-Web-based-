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
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 

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
                 <?php if($title == "List Payment Waiting Approved"):?>   
					<div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>payment/finish_"> Cetak Laporan</a></font></strong></div>
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
<div class="card-header">
                        <div class="float-right"> 
                        <a  data-toggle="modal" style="color:white" data-target="#readme" class="btn btn-danger btn-sm"><i class="fa fa-book"></i>&nbsp;&nbsp;Read Me !!!</a>

                   <?php if ($title == "List Pesanan Pembelian") :?>       
                    </div><font color="blue"><strong>List Pesanan Pembelian</strong></font>  / <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a> / <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong></a> / <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian</strong></a></div>
                      <?php endif; ?>
                    <?php if ($title == "Pesanan Dalam Pengiriman") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> / <font color="blue"><strong>Pengiriman</strong></font> / <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong></a> / <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian</strong></a></div>
                     <?php endif; ?>
                    <?php if ($title == "Klaim Pesanan Pembelian") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> /  <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><font color="blue"><strong>Komplain</strong></font></a>  / <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian</strong></a></div>
                     <?php endif; ?>
                    <?php if ($title == "Riwayat Pesanan Pembelian") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> /  <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong> </a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><font color="blue"><strong>Riwayat Pesanan Pembelian ( PO )</strong></font> </a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai_spk"><strong>Riwayat Pesanan Pembelian ( SPK )</strong></a></div>
                     <?php endif; ?>
                    <?php if ($title == "Riwayat Pesanan Pembelian Spk") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> /  <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong> </a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian ( PO )</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai_spk"><font color="blue"><strong>Riwayat Pesanan Pembelian ( SPK )</strong></a></font>   </div>
                     <?php endif; ?>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td><font size="2px">Id</font></td>
										<td width="50"><font size="2px">Tanggal Kirim</font></td>
										<td width="200"><font size="2px">Project</font></td>
                                        <td width="150"><font size="2px">Pemasok</font></td>
                                        <td ><font size="2px">Status</font></td>
										<td width="100"><font size="2px">Aksi</font></td>
									
									</tr>
								</thead>
								<tbody id="show_data">
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
<!-- modal update -->
 <script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
         
        $('#dataTable').dataTable();
          
        //fungsi tampil barang
        function tampil_data_barang(){
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>pembelian/data_pembelian_spk',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+(i+1) +'</td>'+
                                '<td>'+data[i].number_+'</td>'+
                                '<td>'+data[i].shipDate+'</td>'+
                                '<td>'+data[i].nama_project+'</td>'+
                                '<td>'+data[i].vendorNo+'</td>'+
                              

                             '<td>' + (data[i].status_po == 1 ? '<span class="badge badge-warning">PR- Menunggu Approval PM</span>' : (data[i].status_po == 2 ? '<span class="badge badge-info">PR- Menunggu Approval Estimator</span>' : (data[i].status_po == 7 ? '<span class="badge badge-success">Barang sudah diterima</span>' : '')) ) + '</td>'+


                               '<td><a class="btn btn-success btn-sm" href="<?= base_url('pembelian/detail_po_dt_penerimaan/' ) ?>' + data[i].id + '">' + '<i class="fa fa-eye"></i>'+ ' Detail'+ '</a></td>'
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }
 
            });
        }
 
    });
 
</script>
<div id="readme" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">ALUR PESANAN PEMBELIAN</h4>
        </div>
 <form method="post" action="<?= base_url('mod_kerja/save_berkas_user') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
<!-- start isi -->
<p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">ALUR PESANAN PEMBELIAN ( PURCHASE ORDER )</span></strong></p>
<p class="MsoListParagraphCxSpFirst" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">1.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pesanan Pembelian yang telah dibuat oleh purchasing harus melalui 2 persetujuan sebelum data tsb masuk kedalam system accurate.</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l2 level2 lfo2;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">1.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Estimator.</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l2 level2 lfo2;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">2.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Direksi.</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">2.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pada tahap persetujuan direksi , data yang disetujui akan masuk ke dalam system Accurate online .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">3.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Setelah disetujui direksi , maka pesanan pembelian akan masuk pada tahap pengiriman barang oleh supplier .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">4.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pada tahap ini user yang meminta/yang menerima barang bisa mengecek kesesuain permintaan dengan barang yang dikirim oleh supplier .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level2 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">a.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Upload Gambar .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level2 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">b.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pilih Status Barang Sesuai atau Tidak.</span></p>
<p class="MsoListParagraphCxSpLast" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level2 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">c.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Kemudian Catatan jika diperlukan .</span></p>
<p class="MsoNormal" style="margin-left: 54.0pt;"><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Jika Barang tidak sesuai .</span></p>
<p class="MsoListParagraphCxSpFirst" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l1 level1 lfo3;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">a.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Jika barang yang dikirim tidak sesuai , maka status pesanan pembelian akan otomatis berubah menjadi proses klaim . pada tahap ini purchasing telah menerima notifikasi by system dan akan menjadwalkan ulang pengiriman barang yang tidak sesuai <span style="mso-spacerun: yes;">&nbsp;</span>( data transaksi akan masuk pada menu komplain).</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">5.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">( Untuk Purchasing ) klik menu complain kemudian klik detail , lihat data barang yang tidak sesuai pada table detail . kemudian proses penjadwalan ulang .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">6.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Setelah dijadwalkan ulang maka data tsb akan masuk pada menu pengiriman .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">7.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Setelah barang diterima maka cek satu persatu ( tahap 4 ) jika semua barang sesuai maka pilih tombol <em style="mso-bidi-font-style: normal;">selesaikan pesanan</em> untuk mengakhiri proses transaksi tsb.</span></p>
<p class="MsoListParagraphCxSpLast" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">8.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Untuk melihat Riwayat transaksi tsb , ada pada menu Riwayat Pesanan Pembelian .</span></p>
<!-- end isi -->
                                </div>

   
                                        <hr>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- end modal -->

			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>