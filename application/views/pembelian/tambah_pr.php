<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>

</head>

<body id="page-top">
	<div id="wrapper">


		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('wo') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('wo/list_permintaan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('wo/proses_tambah_pr') ?>"  enctype="multipart/form-data" id="form-tambah" method="POST">
									<h5>Sales Order</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-2">
											<label>ID</label>
											<?php  $codek =  random_string('numeric', 3);
											$code = $codek ; ?>
											<input type="text" readonly name="number_pr" value="<?php $txt = sprintf("%05s", $kode_nik);
											$kodeTransaksi_pr = 'ID.'.$code.'.'.date('Y').'.'.date('m').'.'.$txt;
											echo $kodeTransaksi_pr;  ?>"  class="form-control">

										</div>
										<div class="form-group col-4">
											<label>No. Permintaan</label>
											<input type="text"  name="no_permintaan" placeholder="No Permintaan" value=""  class="form-control">

										</div> 
										<div class="form-group col-6">
											<label>Tanggal Pesanan</label>
											<input type="date" name="transDate" value="<?= date('Y-m-d') ?>"  class="form-control">
											<input type="text" hidden name="toAddress" value="-"  class="form-control">
										</div>

						
									</div>
									<div class="row">
							
										<div class="col-md-12">
										
											<div class="form-row">

											<div class="form-group col-6">
													<label for="project">Nama Customer</label>
													<select name="kd_cst" id="customer" class="form-control" required>
														 <option value="" >PILIH .....</option>
										            <?php foreach ($customer as $cst) : ?>
										                    <option value="<?php echo $cst->kode_cst ?>"
										          ><?php echo $cst->nama_cst ?></option>
										            <?php endforeach; ?>
													</select>

										</div>
										<div class="form-group col-6">
											<label for="project">Nama Sales</label>
											<select name="kd_sales" id="kd_sales" class="form-control" required>
												<option value="" >PILIH .....</option>
												<?php foreach ($sales as $sls) : ?>
													<option value="<?php echo $sls->kode_sales ?>"
														><?php echo $sls->nama_sales ?></option>
													<?php endforeach; ?>
												</select>

											</div>

												<div class="form-group col-6">
													<label for="nama_barang">Nama Barang</label>
											<input type="text" name="detailName" id="nama_barang" class=" form-control" list="nama_barang1" autocomplete="off"> 
											<datalist id="nama_barang1">
											<option value="">Pilih Barang</option>
														<?php foreach ($all_barang as $barang): ?>
														<option value="<?= $barang->Nama_Barang ?>"></option>
														<?php endforeach ?>
    										</datalist>
													
												</div>
											<div class="form-group col-6">
													<label for="warna">Warna Barang</label>
											<input type="text" name="warna" id="warna" class=" form-control" list="warna1" autocomplete="off"> 
											<datalist id="warna1" >
											<option value="">Pilih Warna</option>
														<?php foreach ($warna as $row): ?>
														<option value="<?= $row->nama_warna ?>"></option>
														<?php endforeach ?>
    										</datalist>
													
												</div>
												<div class="form-group col-6">
													<label>Kode Barang</label>
													<input type="text" id="itemNo" name="itemNo" value="" readonly class="form-control">
												</div>
												<div class="form-group col-6">
													<label>Jumlah</label>
													<input type="number" name="quantity" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-6">
													<label>Satuan</label>
											<input type="text" name="itemUnitName" readonly  id="sub_category" class=" form-control" list="category2" autocomplete="off"  > 
											<datalist id="category2">
											 <option value="">No Selected</option>
                                            <?php foreach ($satuan as $row): ?>
                                                <option value="<?= $row->nm_satuan ?>"></option>
                                            <?php endforeach ?>
    										</datalist>
												</div>

											<div class="form-group col-md-6">
	<label for="Status Packing">Status Packing</label>

<input type="text" name="status_packing"   id="status_packing" class=" form-control" list="status_packing1" autocomplete="off"  > 
	<datalist id="status_packing1">
		<option value="">-- Pilih Status Packing --</option>
		<option value="CKD">CKD</option>
		<option value="Built Up">Built Up</option>
	</datalist>
</div> 


												<div class="form-group col-6">
													<label>Keterangan</label>

													<textarea type="text" name="detailNotes" value="" class="form-control" > </textarea>
												</div>

											
								
												<div class="form-group col-2">
													<label for="">&nbsp;</label>
													<button  disabled type="button" class="btn btn-primary btn-block" id="tambah" onclick="doValidate();"><i class="fa fa-plus"></i></button>
												</div>
												<input type="hidden" name="satuan" value="">
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5>Detail Order</h5>
										<hr>
										<div class="table-responsive">
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
												<!--	<td width="15%">Pemasok</td> -->
													<td width="35%">Nama Barang</td>
													<td width="15%">Kode Barang</td>
													<td width="15%">Warna</td>
													<td width="8%">Qty</td>
													<td width="20%">File</td>
													<td width="20%">Pack</td>
													<td width="20%">Ket</td>
													<td width="5%">Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="7" align="center">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
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
	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

			$('#project').on('change', function(){
				$(this).prop('disabled', true)
				$('#reset').prop('disabled', false)
				$('input[name="project"]').val($(this).val())
			})

			$(document).on('click', '#reset', function(){
				$('#project').val('')
				$('#project').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="project"]').val('')
			})

			$('#nama_barang').on('change', function(){

				if($(this).val() == '') reset()
				else { 
					//const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					//var url_get_all_barang = '<?php echo base_url()?>pembelian/get_all_barang',
					$.ajax({
						url: '<?php echo base_url()?>wo/get_all_barang',
						type: 'POST',
						dataType: 'json',
						data: {Nama_Barang: $(this).val()},
						success: function(data){
							$('input[name="itemNo"]').val(data.Kode_Barang)
							$('input[name="quantity"]').val(1)
							//$('input[name="proyek"]').val(1)
							$('input[name="itemUnitName"]').val(data.Satuan)
							$('input[name="warna"]').val(data.Warna_barang)
							//$('input[name="max_hidden"]').val(data.stok)
							$('input[name="quantity"]').prop('readonly', false)
							$('input[name="itemUnitName"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					}).then(function() {
			var id = document.getElementById("itemNo").value;
			$.ajax({
                    url : "<?php echo site_url('wo/get_satuan_barang');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].subcategory_name+'>'+data[i].subcategory_name+'</option>';
                        }
                        $('#category2').html(html);

                    }
                });
						 })
				}
			})
			//  jadi inputan tadi di tampung variable di data keranjang , trus data itu di kirim ke wo/keranjang_barang

			$(document).on('click', '#tambah', function(e){
                
				const data_keranjang = {
					detailName: $('input[name="detailName"]').val(),
					itemNo: $('input[name="itemNo"]').val(),
					warna: $('input[name="warna"]').val(),
					quantity: $('input[name="quantity"]').val(),
					status_packing: $('input[name="status_packing"]').val(),
					itemUnitName: $('input[name="itemUnitName"]').val(),
					detailNotes: $('textarea[name="detailNotes"]').val(),
				}
			//	$('form :input').val('');
				$('input[name=status_packing').val('');
				$('textarea[name=detailNotes').val('');
				$('input[name=detailName').val('');
				$('input[name=itemNo').val('');
				$('input[name=warna').val('');
				$('input[name=quantity').val('');
				$('input[name=itemUnitName').val('');
				$('button#tambah').prop('disabled', true);
				if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.quantity)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
						url: "<?php echo site_url('wo/keranjang_barang');?>",
						type: 'POST',
						data: data_keranjang,
						success: function(data){
					

							$('table#keranjang tbody').append(data)
							$('tfoot').show()

							$('#total').html('<strong>' + hitung_total() + '</strong>')
							$('input[name="total_hidden"]').val(hitung_total())
						}
					})
				}
			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="itemNo"]').prop('disabled', true)
				$('select[name="detailName"]').prop('disabled', true)
				$('input[name="itemUnitName"]').prop('disabled', true)
				$('input[name="quantity"]').prop('disabled', true)
				$('textarea[name="detailNotes"]').prop('detailNotes', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#detailName').val('')
				$('input[name="itemNo"]').val('')
				$('input[name="status_packing"]').val('')
				$('input[name="quantity"]').val('')
				$('input[name="itemUnitName"]').val('') 
				$('textarea[name="detailNotes"]').val('')
				$('input[name="quantity"]').prop('readonly', true)
				$('input[name="itemUnitName"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
	        <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
</body>
</html>