<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">


		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/payment') ?>">
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
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/payment/proses_tambah_pembayaran_po') ?>" id="form-tambah" method="POST">
									<h5>Payment</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-4">
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

										<div class="form-group col-4">
											<label>Tanggal</label>
											<input type="date" name="transDate" value="<?= date('Y-m-d') ?>"  class="form-control">
										</div>

						
									</div>
									<div class="row">
							
										<div class="col-md-12">
										
											<div class="form-row">


												<div class="form-group col-4">
													<label for="no_spk">No Spk</label>
											<input type="text" name="no_spk" id="no_spk" class=" form-control" list="nama_barang1">
											<datalist id="nama_barang1">
											<option value="">Pilih Barang</option>
														<?php foreach ($all_barang as $barang): ?>
														<option value="<?= $barang->id_paym_po ?>"></option>
														<?php endforeach ?>
    										</datalist>
													
												</div>

												<div class="form-group col-2">
													<label>Proyek Id</label>
													<input type="text" id="id_project" name="id_project" value=""  class="form-control" list="list_proyek">
												<datalist id="list_proyek">
											<option value="">Pilih Proyek</option>
														<?php foreach ($proyek as $prk): ?>
														<option value="<?= $prk->id_lsp ?>"><?= $prk->nama_project ?></option>
														<?php endforeach ?>
    										</datalist>
												</div>
												<div class="form-group col-3">
													<label>Proyek Name</label>
													<input type="text" readonly id="list_proyek2" name="id_project2" value=""  class="form-control" list="category2">
													<datalist id="category2">
														<option value="">Pilih Proyek</option>
														<?php foreach ($proyek as $prk): ?>
															<option value="<?= $prk->nama_project ?>"><?= $prk->nama_project ?></option>
														<?php endforeach ?>
													</datalist>
												</div>
												<div class="form-group col-3">
													<label>Vendor Id</label>
													<input type="text" name="vendor" id="id_vendor" value="" class="form-control"   list="list_vendor">
													<datalist id="list_vendor">
														<option value="">Pilih Vendor</option>
														<?php foreach ($vendor as $vn): ?>
															<option value="<?= $vn->id_ven ?>"><?php echo $vn->nama_vendor .' - '.$vn->norek_vendor ?></option>
														<?php endforeach ?>
													</datalist>
												</div>
											<div class="form-group col-4">
													<label>Vendor Name</label>
													<input type="text" readonly id="list_proyek3" name="vendor_name" value=""  class="form-control" list="vendor_list">
													<datalist id="vendor_list">
														<option value="">Pilih Proyek</option>
														<?php foreach ($proyek as $prk): ?>
															<option value="<?= $prk->nama_project ?>"><?= $prk->nama_project ?></option>
														<?php endforeach ?>
													</datalist>
												</div>
												<div class="form-group col-4">
													<label>Jumlah</label>
											<input type="text" name="sisa_pembayaran"   id="sub_category" class=" form-control" list="">
											<!--<datalist id="category2">
											<option value="">No Selected</option>
    										</datalist> -->
												</div>
												<div class="form-group col-4">
													<label>Pajak</label>
													<input type="number" name="pajak" value="" class="form-control"  min='1'>
												</div>
												<div class="form-group col-4">
													<label>Dibayarkan</label>
													<input type="number" name="dibayarkan" value="" class="form-control"  min='1'>
												</div>
												<div class="form-group col-5">
													<label>Keterangan</label>

													<textarea type="text" name="detailNotes" value="" class="form-control" > </textarea>
												</div>
								
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button   type="button" class="btn btn-primary btn-block" id="tambah" ><i class="fa fa-plus"></i></button>
												</div>
												<input type="hidden" name="satuan" value="">
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5>Detail Order</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
												<!--	<td width="15%">Pemasok</td> -->
													<td width="15%">No. Spk</td>
													<td width="15%">Proyek</td>
													<td width="15%">Vendor</td>
													<td width="15%">Jumlah</td>
													<td width="10%">Pajak</td>
													<td width="15%">Dibayarkan</td>
													<td width="50%">Keterangan</td>
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
								</form>
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

			$('#no_spk').on('change', function(){

				if($(this).val() == '') reset()
				else { 
					//const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					//var url_get_all_barang = '<?php echo base_url()?>user/pembelian/get_all_barang',
					$.ajax({
						url: '<?php echo base_url()?>pembelian/get_kode_pembayaran',
						type: 'POST',
						dataType: 'json',
						data: {id_pembayaran: $(this).val()},
						success: function(data){
							//$('input[name="itemNo"]').val(data.id_paym_po)
							//$('input[name="quantity"]').val(0)
							$('input[name="id_project"]').val(data.id_project)
							//$('input[name="id_project2"]').val(data.nama_project)
							$('input[name="sisa_pembayaran"]').val(data.sisa_pembayaran)
							$('input[name="dibayarkan"]').val(data.sisa_pembayaran)
							//$('input[name="max_hidden"]').val(data.stok)
							$('input[name="vendor"]').prop('readonly', false)
							$('input[name="sisa_pembayaran"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					}).then(function() {
			var id = document.getElementById("id_project").value;
			$.ajax({
                    url : "<?php echo site_url('pembelian/get_sub_category_project');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].nama_project+'>'+data[i].nama_project+'</option>';
                            $('input[name="id_project2"]').val(data[i].nama_project);
                        }
                        $('#category2').html(html);

                    }
                });
						 })
				}
			})

			$('#id_project').on('change', function(){

				if($(this).val() == '') reset()
				else { 
					//const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					//var url_get_all_barang = '<?php echo base_url()?>user/pembelian/get_all_barang',
			var id = document.getElementById("id_project").value;
			$.ajax({
                    url : "<?php echo site_url('pembelian/get_sub_category_project');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].nama_project+'>'+data[i].nama_project+'</option>';
                            $('input[name="id_project2"]').val(data[i].nama_project);
                        }
                        $('#category2').html(html);

                    }
                });
						
				}
			})

			$('#id_vendor').on('change', function(){

				if($(this).val() == '') reset()
				else { 
					//const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					//var url_get_all_barang = '<?php echo base_url()?>user/pembelian/get_all_barang',
			var id = document.getElementById("id_vendor").value;
			$.ajax({
                    url : "<?php echo site_url('pembelian/get_name_vendor_by_id');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].nama_vendor+'>'+data[i].nama_vendor+'</option>';
                            $('input[name="vendor_name"]').val(data[i].nama_vendor +'- '+data[i].nama_bank_vendor+'  '  + data[i].norek_vendor);
                        }
                        $('#vendor_list').html(html);

                    }
                });
						
				}
			})			
			$(document).on('click', '#tambah', function(e){
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_payment'
				const data_keranjang = {
					no_spk: $('input[name="no_spk"]').val(),
					id_project: $('input[name="id_project"]').val(),
					vendor: $('input[name="vendor"]').val(),
					sisa_pembayaran: $('input[name="sisa_pembayaran"]').val(),
					pajak: $('input[name="pajak"]').val(),
					dibayarkan: $('input[name="dibayarkan"]').val(),
					id_project2: $('input[name="id_project2"]').val(),
					vendor_name: $('input[name="vendor_name"]').val(),
					detailNotes: $('textarea[name="detailNotes"]').val(),
				}
			//	$('form :input').val('');
				$('textarea[name=detailNotes').val('');
				$('input[name=no_spk').val('');
				$('input[name=id_project').val('');
				$('input[name=id_project2').val('');
				$('input[name=vendor_name').val('');
				$('input[name=itemNo').val('');
				$('input[name=vendor').val('');
				$('input[name=pajak').val('');
				$('input[name=dibayarkan').val('');
				$('input[name=sisa_pembayaran').val('');
				$('button#tambah').prop('disabled', false);
				if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.vendor)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
						url: url_keranjang_barang,
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
				$('input[name="itemNo"]').prop('disabled', false)
				$('select[name="no_spk"]').prop('disabled', false)
				$('input[name="sisa_pembayaran"]').prop('disabled', false)
				$('input[name="vendor"]').prop('disabled', false)
				$('textarea[name="detailNotes"]').prop('detailNotes', false)
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
				$('input[name="vendor"]').val('')
				$('input[name="no_spk"]').val('') 
				$('textarea[name="detailNotes"]').val('')
				$('input[name="vendor"]').prop('readonly', false)
				$('input[name="sisa_pembayaran"]').prop('readonly', false)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>