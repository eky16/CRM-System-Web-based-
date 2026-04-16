<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>

</head>

<body id="page-top">
	<div id="wrapper">


		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/wo') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/wo/pengiriman') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/wo/proses_tambah_pengiriman') ?>" id="form-tambah" method="POST">
									<h5>Jadwal Kirim Barang</h5>
									<hr>

									<div class="form-row">
										<div class="form-group col-2">
											<label>ID</label>
											<?php  $codek =  random_string('numeric', 3);
											$code = $codek ; ?>
											<input type="text" readonly name="kode_pengiriman" value="<?php $txt = sprintf("%05s", $kode_nik);
											$kodeTransaksi_pr = 'P/'.$code.'/'.date('Y').'.'.date('m').'/'.$txt;
											echo $kodeTransaksi_pr;  ?>"  class="form-control">

										</div>
										<div class="form-group col-4">
											<label for="project">No.Kendaraan</label>
											<select name="no_kendaraan" id="no_kendaraan" class="form-control" required>
												<option value="" >PILIH .....</option>
												<?php foreach ($kendaraan as $row) : ?>
													<option value="<?php echo $row->nomor_kendaraan ?>"
														><?php echo $row->nama_kendaraan ?> - <?php echo $row->nomor_kendaraan ?></option>
													<?php endforeach; ?>
												</select>

											</div>
										<div class="form-group col-6">
											<label>Tanggal Pengiriman</label>
											<input type="date" id="tanggal_kirim" name="tgl_kiriman" value=""  class="form-control">
										</div>
										<div class="form-group col-6">
											<label for="project">Nama Supir</label>
											<select name="nama_supir" id="nama_supir" class="form-control" required>
												<option value="" >PILIH .....</option>
												<?php foreach ($supir as $row) : ?>
													<option value="<?php echo $row->nama_karyawan ?>"
														><?php echo $row->nama_karyawan ?></option>
													<?php endforeach; ?>
												</select>

											</div>
											<div class="form-group col-6">
												<label for="project">Nama Kenek</label>
												<select name="nama_kenek" id="nama_kenek" class="form-control" required>
													<option value="" >PILIH .....</option>
													<?php foreach ($kenek as $row) : ?>
													<option value="<?php echo $row->nama_karyawan ?>"
														><?php echo $row->nama_karyawan ?></option>
													<?php endforeach; ?>
													</select>

												</div>
									</div>
									<hr>
									<div class="row">
							
										<div class="col-md-12">
										
											<div class="form-row">

										<div class="form-group col-2">
													<label for="nama_barang">Kode Barang</label>
											<input type="text" name="id_dt" id="id_dt" class=" form-control" list="id_dt1" autocomplete="off"> 
											<datalist id="id_dt1">
											<option value="">Pilih Barang</option>
														
    										</datalist>
													
												</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <script>
        $(document).ready(function(){
            $('tfoot').hide()

            $(document).keypress(function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            })
// ambil data pengiriman dengan ajak berdasarkan tanggal kirim yang dipilih
var inputElement = document.getElementById("tanggal_kirim");
inputElement.addEventListener("change", function() {
  var id2 = inputElement.value;
            $.ajax({
                    url : "<?php echo site_url('user/wo/get_data_barang_kirim_by_date');?>",
                    method : "POST",
                    data : {id2: id2},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                      
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_dt+'>'+data[i].detailName+' ( '+data[i].quantity+'  '+data[i].itemUnitName+') - '+data[i].warna+'</option>';

                        }
                        $('#id_dt1').html(html);
                    }
                })
});  
        })
    </script>
     <div class="form-group col-4">
    	<label for="warna">Customer</label>
    	<input type="text" name="nama_cst" id="nama_cst" class=" form-control"  autocomplete="off" readonly> 
    </div>
    <div class="form-group col-6">
    	<label for="warna">Nama Barang</label>
    	<input type="text" name="detailName" id="detailName" class=" form-control"  autocomplete="off" readonly> 
    </div>
    <div class="form-group col-6">
    	<label>Qty</label>
    	<input type="text" id="quantity" name="quantity" value="" readonly class="form-control">
    </div>
    <div class="form-group col-6">
    	<label>Warna</label>
    	<input type="text" name="warna" value="" class="form-control" readonly >
    </div>
    <div class="form-group col-3">
    	<label>ID Permintaan</label>
    	<input type="text" name="number_request" readonly  id="number_request" class=" form-control"  autocomplete="off"  > 
    </div>
    <div class="form-group col-3">
    	<label>No. Sistem</label>
    	<input type="text" name="number_po" readonly  id="number_po" class=" form-control"  autocomplete="off"  readonly> 
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
										<h5>Detail Pengiriman</h5>
										<hr>
										<div class="table-responsive">
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
												<!--	<td width="15%">Pemasok</td> -->
													<td width="25%">Customer</td>
													<td width="35%">Nama Barang</td>
													<td width="10%">Jumlah</td>
													<td width="15%">Warna</td>	
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
				$('#id_dt').val('')
				$('#detailName').val('')
				$('input[name="nama_cst"]').val('')
				$('input[name="itemUnitName"]').val('')
				$('input[name="quantity"]').val('') 
				$('input[name="warna"]').val('') 
				$('input[name="number_po"]').val('') 
				$('input[name="number_request"]').val('') 
				$('textarea[name="detailNotes"]').val('')
			})

			$('#id_dt').on('change', function(){

				if($(this).val() == '') reset()
				else { 
					//const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					//var url_get_all_barang = '<?php echo base_url()?>user/pembelian/get_all_barang',
					$.ajax({
						url: '<?php echo base_url()?>user/wo/get_data_barang_permintaan',
						type: 'POST',
						dataType: 'json',
						data: {id_dt: $(this).val()},
						success: function(data){
							$('input[name="nama_cst"]').val(data.nama_cst)
							$('input[name="detailName"]').val(data.detailName)
							$('input[name="warna"]').val(data.warna)
							$('input[name="quantity"]').val(data.quantity  + ' - ' + data.itemUnitName);
							$('input[name="number_po"]').val(data.number_po)
							$('input[name="number_request"]').val(data.number_request)
							//$('input[name="max_hidden"]').val(data.stok)
							$('input[name="quantity"]').prop('readonly', true)
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

			$(document).on('click', '#tambah', function(e){

				const data_keranjang = {
					id_dt: $('input[name="id_dt"]').val(),
					nama_cst: $('input[name="nama_cst"]').val(),
					detailName: $('input[name="detailName"]').val(),
					warna: $('input[name="warna"]').val(),
					quantity: $('input[name="quantity"]').val(),
					number_po: $('input[name="number_po"]').val(),
					number_request: $('input[name="number_request"]').val(),
					detailNotes: $('textarea[name="detailNotes"]').val(),
				}
			//	$('form :input').val('');
				$('input[name=id_dt').val('');
				$('input[name=nama_cst').val('');
				$('input[name=detailName').val('');
				$('input[name=warna').val('');
				$('input[name=quantity').val('');
				$('input[name=number_po').val('');
				$('input[name=number_request').val('')
				$('textarea[name=detailNotes').val('');
				$('button#tambah').prop('disabled', true);
				if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.quantity)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
						url: "<?php echo site_url('user/wo/keranjang_pengiriman');?>",
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
				$('input[name="nama_cst"]').val('')
				$('input[name="itemUnitName"]').val('')
				$('input[name="quantity"]').val('') 
				$('input[name="warna"]').val('') 
				$('input[name="number_po"]').val('') 
				$('input[name="number_request"]').val('') 
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