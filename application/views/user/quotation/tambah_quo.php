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
						<a href="<?= base_url('user/quotation/list_quo_order') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/quotation/proses_tambah_quo') ?>"  enctype="multipart/form-data" id="form-tambah" method="POST">
									<h5>Progress Order</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-2">
											<label>ID</label>
											<?php  $codek =  random_string('numeric', 3);
											$code = $codek ; ?>
											<input type="text" readonly name="number_quo" value="<?php $txt = sprintf("%05s", $kode_nik);
											$kodeTransaksi_quo = 'ID_P.'.$code.'.'.date('Y').'.'.date('m').'.'.$txt;
											echo $kodeTransaksi_quo;  ?>"  class="form-control">

										</div>
										
										<div class="form-group col-2">
											<label>Tanggal Progress</label>
											<input type="date" name="trans_Date" value="<?= date('Y-m-d') ?>"  class="form-control">
											<input type="text" hidden name="toAddress" value="-"  class="form-control">
										</div>

						
									</div>
									<div class="row">
							
										<div class="col-md-12">
										
											<div class="form-row">

											<div class="form-group col-6">
													<label for="project">Nama Customer</label>
													<select name="kd_cst_quo" id="customer" class="form-control" required>
														 <option value="" >PILIH .....</option>
										            <?php foreach ($customer as $cst) : ?>
										                    <option value="<?php echo $cst->kode_cst ?>"
										          ><?php echo $cst->nama_cst ?></option>
										            <?php endforeach; ?>
													</select>

										</div>
										<div class="form-group col-6">
											<label for="project">Nama Sales</label>

											<select name="kdSales" id="kdSales" class="form-control" required>
                           <option value="" >PILIH .....</option>
                            <?php foreach ($sales as $row) : ?>
                                <option value="<?php echo $row->EmployeeID ?>">
                                    <?php echo $row->nama_karyawan ?>
                                </option>
                              <?php endforeach; ?>
                          </select>
											</div>

												
												

                                        <div class="form-group col-md-6">
	                                        <label for="Kategori Customer">Kategori Customer</label>

                                            <input type="text" name="kategori_cust"   id="kategori_cust" class=" form-control" list="kategori_cust1" autocomplete="off"  > 
	                                            <datalist id="kategori_cust1">
		                                            <option value="">-- Pilih Kategori Customer --</option>
		                                            <option value="New Customer">New Customer</option>
		                                            <option value="Repeat Order">Repeat Order</option>
	                                            </datalist>
                                            </div>

                                            <div class="form-group col-6">
													<label for="segment">Segment</label>
											<input type="text" name="nama_segment" id="nama_segment" class=" form-control" list="segment1" autocomplete="off"> 
											<datalist id="segment1">
											<option value="">Pilih Segment</option>
														<?php foreach ($segment as $row): ?>
														<option value="<?= $row->segment ?>"></option>
														<?php endforeach ?>
    										</datalist>
													
												</div>

	                                        <div class="form-group col-6">
													<label for="segmentBarang">Segment Barang</label>
											<input type="text" name="segment_barang" id="segment_barang" class=" form-control" list="segmentBrg" autocomplete="off">
											<input type="hidden" name="kd_segment" id="kd_segment">
 
											    <datalist id="segmentBrg">
                                                    <?php foreach ($segBrg as $row): ?>
                                                        <option 
                                                            value="<?= $row->segment_barang ?>"
                                                            data-kode="<?= $row->kd_segment ?>">
                                                        </option>
                                                    <?php endforeach ?>
                                                </datalist>													
											</div>

										

                                            <div class="form-group col-6" id="jenisFurnitureGroup" style="display:none;">
                                                 <label><span class="badge badge-success">Jenis Furniture</span></label>

                                                 <input type="text" name="jenis_furniture" id="jenis_furniture" class="form-control" list="listFurniture" autocomplete="off">
                                                  <datalist id="listFurniture">
                                                      <option value="Furniture"></option>
                                                      <option value="Non Furniture"></option>
                                                  </datalist>
                                              </div>



											<div class="form-group col-6">
                                               <label for="item">Nama Barang</label>
                                               <input type="text" name="detailName_quo" id="item" class="form-control" list="item1" autocomplete="off">
                                               <datalist id="item1">
                                                    <option value="">Pilih Barang</option>
                                                <?php foreach ($all_barang as $barang): ?>
                                                      <option value="<?= $barang->item ?>"></option>
                                                    <?php endforeach ?>
                                                  </datalist>
                                                </div>

                                                <div class="form-group col-6" >
                                                  <label>Kode Barang</label>
                                                  <input type="text" id="item_no" name="item_no" value="" readonly class="form-control">
                                                </div>

                                            <div class="form-group col-6">
                                              <label>Kategori Barang</label>
                                              <input type="text" id="kategori_barang" name="kategori_barang" value="" readonly class="form-control">
                                            </div>

                                            <div class="form-group col-6">
                                              <label>Jumlah</label>
                                              <input type="number" id="quantity" name="quantity" value="" class="form-control" readonly min="1">
                                            </div>

											                               
<!--<div class="row">
                                              <div class="form-group col-4">
                                                <label>Harga Pricelist (Rp)</label>
                                                <input type="text" id="harga_view" class="form-control" placeholder="Masukkan harga">
                                                <input type="hidden" name="harga" id="harga">
                                              </div>

                                              <div class="form-group col-4">
                                                <label>Diskon (%)</label>
                                                <input type="number" id="diskon_persen" name="diskon_persen" class="form-control" placeholder="Masukkan diskon %" min="0" max="100">
                                              </div>

                                              <div class="form-group col-4">
                                                <label>Diskon (Rp)</label>
                                                <input type="text" id="diskon_rupiah_view" class="form-control" readonly>
                                                <input type="hidden" name="diskon_rupiah" id="diskon_rupiah">
                                            </div>
                                            </div> -->


											
												<div class="form-group col-6">
													<label>Keterangan</label>

													<textarea type="text" name="detailNotes_quo" value="" class="form-control" > </textarea>
												</div>

												<div class="form-group col-2">
											<label>Tanggal Follow-up</label>
											<input type="date" name="follow_up_date" value="<?= date('Y-m-d') ?>"  class="form-control">
											<input type="text" hidden name="toAddress" value="-"  class="form-control">
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
													<td width="25%">Nama Barang</td>
													<td width="25%">Kode Barang</td>
													<td width="15%">Kategori Barang</td>
													<td width="20%">Jumlah</td>
													<td width="20%">Segment Barang</td>
													<td width="20%">Jenis Furniture</td>
													<td width="20%">Harga Pricelist</td>
													<td width="20%">Diskon (%)</td>
													<td width="20%">Diskon (Rp)</td>
													<td width="15%">Tanggal Follow Up</td>
													<td width="15%">File</td>
													

													<td width="15%">Ket</td>
													<td width="5%">Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="13" align="center">
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
				$('#project').val('')
				$('#project').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="project"]').val('')
			})

			$('#item').on('change', function(){

				if($(this).val() == '') reset()
				else { 
					//const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					//var url_get_all_barang = '<?php echo base_url()?>user/pembelian/get_all_barang',
					$.ajax({
						url: '<?php echo base_url()?>user/quotation/get_all_barang',
						type: 'POST',
						dataType: 'json',
						data: {item: $(this).val()},
						success: function(data){
							$('input[name="item_no"]').val(data.kode_product)
							$('input[name="quantity"]').val(1)
							$('input[name="kategori_barang"]').val(data.kategori)					

							//$('input[name="proyek"]').val(1)
							//$('input[name="segment_barang"]').val(data.Satuan)
							//$('input[name="warna"]').val(data.Warna_barang)
							//$('input[name="max_hidden"]').val(data.stok)
							$('input[name="quantity"]').prop('readonly', false)
							//$('input[name="segment_barang"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					}).then(function() {
			var id = document.getElementById("item_no").value;
			$.ajax({
                    url : "<?php echo site_url('user/wo/get_satuan_barang');?>",
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
					detailName_quo: $('input[name="detailName_quo"]').val(),
					kategori_barang: $('input[name="kategori_barang"]').val(),
					item_no: $('input[name="item_no"]').val(),
					quantity: $('input[name="quantity"]').val(),
					segment_barang: $('input[name="segment_barang"]').val(),
					jenis_furniture: $('input[name="jenis_furniture"]').val(),
					detailNotes_quo: $('textarea[name="detailNotes_quo"]').val(),
					harga: $('input[name="harga"]').val(),
					diskon_persen: $('input[name="diskon_persen"]').val(),
         	        diskon_rupiah: $('input[name="diskon_rupiah"]').val(),
         	        follow_up_date: $('input[name="follow_up_date"]').val(),


				} // reset semua input setelah menambahkan ke keranjang

			//	$('form :input').val('');
				$('textarea[name=detailNotes_quo').val('');
				$('input[name=detailName_quo').val('');
				$('input[name=item_no').val('');
				$('input[name=quantity').val('');
				$('input[name=segment_barang').val('');
				$('input[name=jenis_furniture').val('');
				$('input[name=kategori_barang').val('');
				$('input[name=harga').val('');
				$('#harga_view').val(''); // view

				$('input[name=diskon_persen').val('');
				$('input[name=diskon_rupiah').val('');
				$('#diskon_rupiah_view').val(''); // view

				$('input[name=follow_up_date').val('');


				$('button#tambah').prop('disabled', true);
				if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.quantity)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
						url: "<?php echo site_url('user/quotation/keranjang_barang_quo');?>",
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
				$(this).closest('.row-keranjang_quo').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="item_no"]').prop('disabled', true)
				$('select[name="detailName_quo"]').prop('disabled', true)
				$('input[name="segment_barang"]').prop('disabled', true)
				//$('input[name="jenis_furniture"]').prop('disabled', true)

				$('input[name="quantity"]').prop('disabled', true)
				$('textarea[name="detailNotes_quo"]').prop('detailNotes_quo', true)
				$('input[name="harga"]').prop('harga', true)
				$('input[name="diskon_persen"]').prop('diskon_persen', true)
				$('input[name="diskon_rupiah"]').prop('diskon_rupiah', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#detailName_quo').val('')
				$('input[name="item_no"]').val('')
				//$('input[name="nama_segment"]').val('')
				$('input[name="harga"]').val('')
				$('#harga_view').val('')         // view

				$('input[name="diskon_persen"]').val('')
				$('input[name="diskon_rupiah"]').val('')
                $('#diskon_rupiah_view').val('')        // view

				//$('input[name="kategori_cust"]').val('')
				//$('input[name="quantity"]').val('')
				//$('input[name="segment_barang"]').val('') 
			    $('input[name="jenis_furniture"]').val('') 

				$('textarea[name="detailNotes_quo"]').val('')
				$('input[name="quantity"]').prop('readonly', true)
				$('input[name="kategori_barang"]').val('')
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

    <script>
 

  // hapus semua karakter selain angka
function bersihkanAngka(str) {
    return str.replace(/[^\d]/g, '');
}

// format ribuan
function formatRibuan(angka) {
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// hitung diskon
function hitungDiskon() {
    let harga = parseInt(document.getElementById("harga").value) || 0;
    let diskonPersen = parseFloat(document.getElementById("diskon_persen").value) || 0;

    let diskonRupiah = harga * diskonPersen / 100;

    // tampilkan view dengan titik ribuan
    document.getElementById("diskon_rupiah_view").value = formatRibuan(Math.round(diskonRupiah).toString());

    // simpan angka asli untuk database
    document.getElementById("diskon_rupiah").value = Math.round(diskonRupiah);
}

// format harga saat mengetik
document.getElementById("harga_view").addEventListener("input", function(e){
    let angka = bersihkanAngka(e.target.value);

    // tampilkan dengan titik ribuan
    e.target.value = formatRibuan(angka);

    // simpan angka asli di hidden
    document.getElementById("harga").value = angka;

    // hitung diskon otomatis
    hitungDiskon();
});

// hitung diskon saat persen berubah
document.getElementById("diskon_persen").addEventListener("input", function(){
    hitungDiskon();
});</script>

<script>
document.getElementById("segment_barang").addEventListener("input", function() {

    let input = this.value;
    let options = document.querySelectorAll("#segmentBrg option");
    let kdInput = document.getElementById("kd_segment");
    let jenisGroup = document.getElementById("jenisFurnitureGroup");

    kdInput.value = "";
    jenisGroup.style.display = "none";

    options.forEach(function(option) {
        if (option.value === input) {
            let kode = option.getAttribute("data-kode");
            kdInput.value = kode;

            // Jika kode SB82431 (Custom)
            if (kode === "SB82431") {
                jenisGroup.style.display = "block";
            }
        }
    });
});
</script>



</body>
</html>