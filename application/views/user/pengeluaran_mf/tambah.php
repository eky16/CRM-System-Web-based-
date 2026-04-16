<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/mf') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h6 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/mf/list_pengeluaran_mf') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/mf/proses_kurang_mf') ?>" id="form-tambah" method="POST">
									<h5>Data Admin</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-2">
											<label>No. Keluar</label>
											<input type="text" name="no_keluar" value="KL.<?= time() ?>"  class="form-control">
										</div>
										<div class="form-group col-3">
											<label>Kode </label>
											<input type="text" name="kode_petugas" value="<?= $this->session->login['kode'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-3">
											<label>Nama </label>
											<input type="text" name="nama_petugas" value="<?= $this->session->login['nama'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Tanggal Keluar</label>
											<input type="text" name="tgl_keluar" value="<?= date('Y-m-d') ?>" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Jam</label>
											<input type="text" name="jam_keluar" value="<?= date('H:i:s') ?>" readonly class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<h5>Data Projek</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-8">
													<label for="nama_customer">Nama Customer</label>
													<select name="nama_customer" id="customer" class="form-control" required>
														 <option value="" >PILIH .....</option>
										            <?php foreach ($customer as $cst) : ?>
										                    <option value="<?php echo $cst->nama_cst ?>"
										          ><?php echo $cst->nama_cst ?></option>
										            <?php endforeach; ?>
													</select>

										</div>												
											</div>
										</div>

									

										<div class="col-md-8">
											<h5>Data Barang</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-5">
													<label for="Nama_mf">Nama Barang</label>
				
											<input type="text" name="Nama_mf" id="Nama_mf" class=" form-control" list="Nama_mf1" autocomplete="off"> 
											<datalist id="Nama_mf1">
											<option value="">Pilih Barang</option>
														<?php foreach ($all_komponen as $komponen): ?>
														<option value="<?= $komponen->nama_mf ?>"></option>
														<?php endforeach ?>
    										</datalist>	
												</div>
												<div class="form-group col-3">
													<label>Kode Barang</label>
													<input type="text" name="Kode_mf" value="" readonly class="form-control">
												</div>
												<div class="form-group col-3">
													<label>Jumlah</label>
													<input type="number" name="jumlah_mf" value="" class="form-control" readonly min='1'>
												</div>

												<div class="form-group col-3">
													<label>Satuan</label>
													<input type="text" name="Satuan_mf" value="" class="form-control"  readonly>
												</div>

												<div class="form-group col-3">
													<label>TTP A S</label>
													<input type="number" name="ttpas" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>TTP A D</label>
													<input type="number" name="ttpad" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>SMPG S</label>
													<input type="number" name="smpgs" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>SMPG D</label>
													<input type="number" name="smpgd" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>BLKG S</label>
													<input type="number" name="blkgs" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>BLKG D</label>
													<input type="number" name="blkgd" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>RACK</label>
													<input type="number" name="rack" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>BOX</label>
													<input type="number" name="box" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>CHS.S STAT</label>
													<input type="number" name="chss_stat" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>CHS.S DIN</label>
													<input type="number" name="chss_din" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>CHS.D DIN</label>
													<input type="number" name="chs_d_din" value="" class="form-control" readonly min='1'>
												</div>
												
												<div class="form-group col-3">
													<label>TTP CHS S</label>
													<input type="number" name="ttpchs_s" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>TTP CHS D</label>
													<input type="number" name="ttpchs_d" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>CNTL S</label>
													<input type="number" name="cntls" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>CNTL D</label>
													<input type="number" name="cntld" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>PNGMN</label>
													<input type="number" name="pngmn" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>RELL</label>
													<input type="number" name="rell" value="" class="form-control" readonly min='1'>
												</div>
												<div class="form-group col-3">
													<label>SAMB. RELL</label>
													<input type="number" name="samb_rell" value="" class="form-control" readonly min='1'>
												</div>

												<div class="form-group col-7">
													<label>Keterangan</label>
													<textarea class="form-control" name="ket_keluar_mf"> </textarea>
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
												<input type="hidden" name="satuan" value="">
											</div>
										</div>
									</div>
									<div class="keranjang">
										<div class="table-responsive">
										<h5>Detail Pengeluaran</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<td width="25%">Nama Barang</td>
													<td width="15%">Kode Barang</td>
													<td width="15%">Jumlah</td>
													<td width="10%">Satuan</td>
													<td width="15%">TTP A S</td>
													<td width="15%">TTP A D</td>
													<td width="15%">SMPG S</td>
													<td width="15%">SMPG D</td>
													<td width="15%">BLKG S</td>
													<td width="15%">BLKG D</td>
													<td width="15%">RACK</td>
													<td width="15%">BOX</td>
													<td width="15%">CHS.S STAT</td>
													<td width="15%">CHS.S DIN</td>
													<td width="15%">CHS.D DIN</td>
													<td width="15%">TTP CHS S</td>
													<td width="15%">TTP CHS D</td>
													<td width="15%">CNTL S</td>
													<td width="15%">CNTL D</td>
													<td width="15%">PNGMN</td>
													<td width="15%">RELL</td>
													<td width="15%">SAMB. RELL</td>
													<td width="20%">Keterangan</td>
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


			$('#nama_customer').on('change', function(){
				$(this).prop('disabled', true)
				$('#reset').prop('disabled', false)
				$('input[name="nama_customer"]').val($(this).val())
			})

			$(document).on('click', '#reset', function(){
				$('#nama_customer').val('')
				$('#nama_customer').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="nama_customer"]').val('')
			})

			$('#Nama_mf').on('change', function(){

				if($(this).val() == '') reset()
				else {
					$.ajax({
						url : "<?php echo site_url('user/mf/get_all_barang');?>",
						type: 'POST',
						dataType: 'json',
						data: {Nama_mf: $(this).val()},
						success: function(data){
							$('input[name="Kode_mf"]').val(data.kode_mf)
							$('input[name="jumlah_mf"]').val(0)
							$('input[name="ttpas"]').val(0)
							$('input[name="ttpad"]').val(0)
							$('input[name="smpgs"]').val(0)
							$('input[name="smpgd"]').val(0)
							$('input[name="blkgs"]').val(0)
							$('input[name="blkgd"]').val(0)
							$('input[name="rack"]').val(0)
							$('input[name="box"]').val(0)
							$('input[name="chss_stat"]').val(0)
							$('input[name="chss_din"]').val(0)
							$('input[name="chs_d_din"]').val(0)
							$('input[name="ttpchs_s"]').val(0)
							$('input[name="ttpchs_d"]').val(0)
							$('input[name="cntls"]').val(0)
							$('input[name="cntld"]').val(0)
							$('input[name="pngmn"]').val(0)
							$('input[name="rell"]').val(0)
							$('input[name="samb_rell"]').val(0)
							
							$('input[name="Satuan_mf"]').val(data.satuan_mf)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah_mf"]').prop('readonly', false)
							$('input[name="ttpas"]').prop('readonly', false)
							$('input[name="ttpad"]').prop('readonly', false)
							$('input[name="smpgs"]').prop('readonly', false)
							$('input[name="smpgd"]').prop('readonly', false)
							$('input[name="blkgs"]').prop('readonly', false)
							$('input[name="blkgd"]').prop('readonly', false)
							$('input[name="rack"]').prop('readonly', false)
							$('input[name="box"]').prop('readonly', false)
							$('input[name="chss_stat"]').prop('readonly', false)
							$('input[name="chss_din"]').prop('readonly', false)
							$('input[name="chs_d_din"]').prop('readonly', false)
							$('input[name="ttpchs_s"]').prop('readonly', false)
							$('input[name="ttpchs_d"]').prop('readonly', false)
							$('input[name="cntls"]').prop('readonly', false)
							$('input[name="cntld"]').prop('readonly', false)
							$('input[name="pngmn"]').prop('readonly', false)
							$('input[name="rell"]').prop('readonly', false)
							$('input[name="samb_rell"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah_mf"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah_mf"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah_mf"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					})
				}
			})

			$(document).on('click', '#tambah', function(e){
			
				const data_keranjang = {
					Nama_mf: $('input[name="Nama_mf"]').val(),
					Kode_mf: $('input[name="Kode_mf"]').val(),
					jumlah_mf: $('input[name="jumlah_mf"]').val(),					
					ttpas: $('input[name="ttpas"]').val(),
					ttpad: $('input[name="ttpad"]').val(),
					smpgs: $('input[name="smpgs"]').val(),
					smpgd: $('input[name="smpgd"]').val(),
					blkgs: $('input[name="blkgs"]').val(),
					blkgd: $('input[name="blkgd"]').val(),
					rack: $('input[name="rack"]').val(),
					box: $('input[name="box"]').val(),
					chss_stat: $('input[name="chss_stat"]').val(),
					chss_din: $('input[name="chss_din"]').val(),
					chs_d_din: $('input[name="chs_d_din"]').val(),
					ttpchs_s: $('input[name="ttpchs_s"]').val(),
					ttpchs_d: $('input[name="ttpchs_d"]').val(),
					cntls: $('input[name="cntls"]').val(),
					cntld: $('input[name="cntld"]').val(),
					pngmn: $('input[name="pngmn"]').val(),
					rell: $('input[name="rell"]').val(),
					samb_rell: $('input[name="samb_rell"]').val(),
					hrg_brg: $('input[name="hrg_brg"]').val(),
					Satuan_mf: $('input[name="Satuan_mf"]').val(),
					
					ket_keluar_mf: $('textarea[name="ket_keluar_mf"]').val(),

				}
				//$('select[name=Nama_mf').val('');
				if(parseInt($('input[name="max_hidden"]').val()) < parseInt(data_keranjang.jumlah_mf)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else {
					$.ajax({
						url: "<?php echo site_url('user/mf/keranjang_barang');?>",
						type: 'POST',
						data: data_keranjang,
						success: function(data){
							if($('input[name="Nama_mf"]').val() == data_keranjang.Nama_mf) $('option[value="' + data_keranjang.Nama_mf + '"]').hide()
							reset()

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

				$('option[value="' + $(this).data('Nama-mf') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="Kode_mf"]').prop('disabled', true)
				$('select[name="Nama_mf"]').prop('disabled', true)
				$('input[name="Satuan_mf"]').prop('disabled', true)
				$('input[name="jumlah_mf"]').prop('disabled', true)
				$('input[name="ttpas"]').prop('disabled', true)
				$('input[name="ttpad"]').prop('disabled', true)
				$('input[name="smpgs"]').prop('disabled', true)
				$('input[name="smpgd"]').prop('disabled', true)
				$('input[name="blkgs"]').prop('disabled', true)
				$('input[name="blkgd"]').prop('disabled', true)
				$('input[name="rack"]').prop('disabled', true)
				$('input[name="box"]').prop('disabled', true)
				$('input[name="chss_stat"]').prop('disabled', true)
				$('input[name="chss_din"]').prop('disabled', true)
				$('input[name="chs_d_din"]').prop('disabled', true)
				$('input[name="ttpchs_s"]').prop('disabled', true)
				$('input[name="ttpchs_d"]').prop('disabled', true)
				$('input[name="cntls"]').prop('disabled', true)
				$('input[name="cntld"]').prop('disabled', true)
				$('input[name="pngmn"]').prop('disabled', true)
				$('input[name="rell"]').prop('disabled', true)
				$('input[name="samb_rell"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#Nama_mf').val('')
				$('textarea[name="ket_keluar_mf"]').val('')
				$('input[name="hrg_brg"]').val('')
				
				$('input[name="Kode_mf"]').val('')
				$('input[name="jumlah_mf"]').val('')
				$('input[name="ttpas"]').val('')
				$('input[name="ttpad"]').val('')
				$('input[name="smpgs"]').val('')
				$('input[name="smpgd"]').val('')
				$('input[name="blkgs"]').val('')
				$('input[name="blkgd"]').val('')
				$('input[name="rack"]').val('')
				$('input[name="box"]').val('')
				$('input[name="chss_stat"]').val('')
				$('input[name="chss_din"]').val('')
				$('input[name="chs_d_din"]').val('')
				$('input[name="ttpchs_s"]').val('')
				$('input[name="ttpchs_d"]').val('')
				$('input[name="cntls"]').val('')
				$('input[name="cntld"]').val('')
				$('input[name="pngmn"]').val('')
				$('input[name="rell"]').val('')
				$('input[name="samb_rell"]').val('')
				$('input[name="Satuan_mf"]').val('')
				$('input[name="jumlah_mf"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>

	<script>
    // Dapatkan elemen input jumlah
    var jumlahInput = document.querySelector('input[name="jumlah_mf"]');
    // Dapatkan elemen input nama barang MF
    var namaMFInput = document.getElementById('Nama_mf');
    
    // Tambahkan event listener untuk mengikuti perubahan pada input jumlah
    jumlahInput.addEventListener('input', function() {
        // Dapatkan nilai input jumlah
        var jumlahValue = parseInt(jumlahInput.value);
        // Dapatkan nilai input nama barang MF
        var namaMFValue = namaMFInput.value;

        // Set nilai untuk masing-masing input sesuai kondisi yang diberikan
       if ((jumlahValue === 1) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 2;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 4;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 1;
            document.querySelector('input[name="rack"]').value = 16;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 1;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 2;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 2;
            document.querySelector('input[name="pngmn"]').value = 1;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }

        if ((jumlahValue === 2) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 4;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 8;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 2;
            document.querySelector('input[name="rack"]').value = 34;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 2;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 4;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 4;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 6;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 12;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 3;
            document.querySelector('input[name="rack"]').value = 48;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 3;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 6;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 6;
            document.querySelector('input[name="pngmn"]').value = 3;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 8;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 16;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 4;
            document.querySelector('input[name="rack"]').value = 64;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 4;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 8;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 8;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 10;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 20;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 5;
            document.querySelector('input[name="rack"]').value = 80;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 5;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 10;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 10;
            document.querySelector('input[name="pngmn"]').value = 5;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 12;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 24;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 6;
            document.querySelector('input[name="rack"]').value = 96;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 6;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 12;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 12;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 14;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 28;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 7;
            document.querySelector('input[name="rack"]').value = 112;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 7;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 14;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 14;
            document.querySelector('input[name="pngmn"]').value = 7;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 16;
            document.querySelector('input[name="smpgs"]').value = 48;
            document.querySelector('input[name="smpgd"]').value = 32;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 8;
            document.querySelector('input[name="rack"]').value = 128;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 8;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 16;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 16;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 18;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 36;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 9;
            document.querySelector('input[name="rack"]').value = 144;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 9;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 18;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 18;
            document.querySelector('input[name="pngmn"]').value = 9;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 4.18-LG' || namaMFValue === 'MF 4.18-DG' || namaMFValue === 'MF 4.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 20;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 40;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 10;
            document.querySelector('input[name="rack"]').value = 160;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 10;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 20;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 20;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 2;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 4;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 1;
            document.querySelector('input[name="rack"]').value = 20;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 1;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 2;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 2;
            document.querySelector('input[name="pngmn"]').value = 1;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 4;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 8;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 2;
            document.querySelector('input[name="rack"]').value = 40;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 2;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 4;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 4;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 6;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 12;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 3;
            document.querySelector('input[name="rack"]').value = 60;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 3;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 6;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 6;
            document.querySelector('input[name="pngmn"]').value = 3;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 8;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 16;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 4;
            document.querySelector('input[name="rack"]').value = 80;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 4;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 8;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 8;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 10;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 20;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 5;
            document.querySelector('input[name="rack"]').value = 100;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 5;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 10;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 10;
            document.querySelector('input[name="pngmn"]').value = 5;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 12;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 24;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 6;
            document.querySelector('input[name="rack"]').value = 120;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 6;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 12;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 12;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 14;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 28;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 7;
            document.querySelector('input[name="rack"]').value = 140;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 7;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 14;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 14;
            document.querySelector('input[name="pngmn"]').value = 7;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 16;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 32;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 8;
            document.querySelector('input[name="rack"]').value = 160;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 8;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 16;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 16;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 18;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 36;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 9;
            document.querySelector('input[name="rack"]').value = 180;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 9;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 18;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 18;
            document.querySelector('input[name="pngmn"]').value = 9;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 4.22-LG' || namaMFValue === 'MF 4.22-DG' || namaMFValue === 'MF 4.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 20;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 40;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 10;
            document.querySelector('input[name="rack"]').value = 200;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 10;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 20;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 20;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 0;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 4;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 8;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 2;
            document.querySelector('input[name="rack"]').value = 24;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 2;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 4;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 4;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 1;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 8;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 16;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 4;
            document.querySelector('input[name="rack"]').value = 48;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 4;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 8;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 8;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 2;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 12;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 24;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 6;
            document.querySelector('input[name="rack"]').value = 72;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 6;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 12;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 12;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 3;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 16;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 32;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 8;
            document.querySelector('input[name="rack"]').value = 96;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 8;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 16;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 16;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 4;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 20;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 40;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 10;
            document.querySelector('input[name="rack"]').value = 120;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 10;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 20;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 20;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 5;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 24;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 48;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 12;
            document.querySelector('input[name="rack"]').value = 144;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 12;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 24;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 24;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 6;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 28;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 56;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 14;
            document.querySelector('input[name="rack"]').value = 168;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 14;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 28;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 28;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 7;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 32;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 64;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 16;
            document.querySelector('input[name="rack"]').value = 192;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 16;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 32;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 32;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 8;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 36;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 72;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 18;
            document.querySelector('input[name="rack"]').value = 216;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 18;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 36;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 36;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 9;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 6.18-LG' || namaMFValue === 'MF 6.18-DG' || namaMFValue === 'MF 6.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 40;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 80;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 20;
            document.querySelector('input[name="rack"]').value = 240;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 20;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 40;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 40;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 10;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 4;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 8;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 2;
            document.querySelector('input[name="rack"]').value = 30;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 2;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 4;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 4;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 1;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 8;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 16;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 4;
            document.querySelector('input[name="rack"]').value = 60;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 4;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 8;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 8;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 2;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 12;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 24;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 6;
            document.querySelector('input[name="rack"]').value = 90;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 6;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 12;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 12;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 3;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 16;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 32;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 8;
            document.querySelector('input[name="rack"]').value = 120;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 8;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 16;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 16;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 4;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 20;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 40;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 10;
            document.querySelector('input[name="rack"]').value = 150;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 10;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 20;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 20;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 5;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 24;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 48;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 12;
            document.querySelector('input[name="rack"]').value = 180;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 12;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 24;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 24;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 6;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 28;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 56;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 14;
            document.querySelector('input[name="rack"]').value = 210;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 14;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 28;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 28;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 7;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 32;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 64;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 16;
            document.querySelector('input[name="rack"]').value = 240;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 16;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 32;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 32;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 8;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 36;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 72;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 18;
            document.querySelector('input[name="rack"]').value = 270;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 18;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 36;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 36;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 9;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 36;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 72;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 18;
            document.querySelector('input[name="rack"]').value = 270;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 18;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 36;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 36;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 9;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 6.22-LG' || namaMFValue === 'MF 6.22-DG' || namaMFValue === 'MF 6.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 40;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 80;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 20;
            document.querySelector('input[name="rack"]').value = 300;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 20;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 40;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 40;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 10;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 6;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 12;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 3;
            document.querySelector('input[name="rack"]').value = 32;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 3;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 6;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 6;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 2;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 6;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 12;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 3;
            document.querySelector('input[name="rack"]').value = 32;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 3;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 6;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 6;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 2;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 18;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 36;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 9;
            document.querySelector('input[name="rack"]').value = 96;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 9;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 18;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 18;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 6;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 24;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 48;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 12;
            document.querySelector('input[name="rack"]').value = 128;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 12;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 24;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 24;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 8;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 30;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 60;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 15;
            document.querySelector('input[name="rack"]').value = 160;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 15;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 30;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 30;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 10;
        }
         if ((jumlahValue === 6) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 36;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 72;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 18;
            document.querySelector('input[name="rack"]').value = 192;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 18;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 36;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 36;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 12;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 42;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 84;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 21;
            document.querySelector('input[name="rack"]').value = 224;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 21;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 42;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 42;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 14;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 48;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 96;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 24;
            document.querySelector('input[name="rack"]').value = 256;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 24;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 48;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 48;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 16;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 54;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 108;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 27;
            document.querySelector('input[name="rack"]').value = 288;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 27;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 54;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 54;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 18;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 8.18-LG' || namaMFValue === 'MF 8.18-DG' || namaMFValue === 'MF 8.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 60;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 120;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 30;
            document.querySelector('input[name="rack"]').value = 320;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 30;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 60;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 60;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 20;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 6;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 12;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 3;
            document.querySelector('input[name="rack"]').value = 40;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 3;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 6;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 6;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 2;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 12;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 24;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 6;
            document.querySelector('input[name="rack"]').value = 80;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 6;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 12;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 12;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 4;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 18;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 36;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 9;
            document.querySelector('input[name="rack"]').value = 120;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 9;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 18;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 18;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 6;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 24;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 48;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 12;
            document.querySelector('input[name="rack"]').value = 160;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 12;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 24;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 24;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 8;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 30;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 60;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 15;
            document.querySelector('input[name="rack"]').value = 200;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 15;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 30;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 30;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 10;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 36;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 72;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 18;
            document.querySelector('input[name="rack"]').value = 240;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 18;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 36;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 36;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 12;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 42;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 84;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 21;
            document.querySelector('input[name="rack"]').value = 280;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 21;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 42;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 42;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 14;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 48;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 96;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 24;
            document.querySelector('input[name="rack"]').value = 320;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 24;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 48;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 48;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 16;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 54;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 108;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 27;
            document.querySelector('input[name="rack"]').value = 360;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 27;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 54;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 54;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 18;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 8.22-LG' || namaMFValue === 'MF 8.22-DG' || namaMFValue === 'MF 8.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 60;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 120;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 30;
            document.querySelector('input[name="rack"]').value = 400;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 30;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 60;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 60;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 20;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 8;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 16;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 4;
            document.querySelector('input[name="rack"]').value = 40;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 4;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 8;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 8;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 3;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 16;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 32;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 8;
            document.querySelector('input[name="rack"]').value = 80;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 8;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 16;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 16;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 6;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 24;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 48;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 12;
            document.querySelector('input[name="rack"]').value = 120;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 12;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 24;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 24;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 9;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 32;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 64;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 16;
            document.querySelector('input[name="rack"]').value = 160;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 16;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 32;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 32;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 12;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 40;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 80;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 20;
            document.querySelector('input[name="rack"]').value = 200;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 20;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 40;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 40;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 15;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 48;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 96;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 24;
            document.querySelector('input[name="rack"]').value = 240;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 24;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 48;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 48;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 18;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 56;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 112;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 28;
            document.querySelector('input[name="rack"]').value = 280;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 28;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 56;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 56;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 21;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 64;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 128;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 32;
            document.querySelector('input[name="rack"]').value = 320;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 32;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 64;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 64;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 24;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 72;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 144;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 36;
            document.querySelector('input[name="rack"]').value = 360;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 36;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 72;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 72;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 27;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 10.18-LG' || namaMFValue === 'MF 10.18-DG' || namaMFValue === 'MF 10.18-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 80;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 160;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 40;
            document.querySelector('input[name="rack"]').value = 400;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 40;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 80;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 80;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 30;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 8;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 16;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 4;
            document.querySelector('input[name="rack"]').value = 50;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 4;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 8;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 8;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 3;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 16;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 32;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 8;
            document.querySelector('input[name="rack"]').value = 100;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 8;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 16;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 16;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 6;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 24;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 48;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 12;
            document.querySelector('input[name="rack"]').value = 150;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 12;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 24;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 24;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 9;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 32;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 64;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 16;
            document.querySelector('input[name="rack"]').value = 200;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 16;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 32;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 32;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 12;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 40;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 80;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 20;
            document.querySelector('input[name="rack"]').value = 250;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 20;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 40;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 40;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 15;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 48;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 96;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 24;
            document.querySelector('input[name="rack"]').value = 300;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 24;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 48;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 48;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 18;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 56;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 112;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 28;
            document.querySelector('input[name="rack"]').value = 350;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 28;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 56;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 56;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 21;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 64;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 128;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 32;
            document.querySelector('input[name="rack"]').value = 400;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 32;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 64;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 64;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 24;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 72;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 144;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 36;
            document.querySelector('input[name="rack"]').value = 450;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 36;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 72;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 72;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 27;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 10.22-LG' || namaMFValue === 'MF 10.22-DG' || namaMFValue === 'MF 10.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 80;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 160;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 40;
            document.querySelector('input[name="rack"]').value = 500;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 40;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 80;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 80;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 30;
        }
        if ((jumlahValue === 1) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 2;
            document.querySelector('input[name="ttpad"]').value = 10;
            document.querySelector('input[name="smpgs"]').value = 4;
            document.querySelector('input[name="smpgd"]').value = 20;
            document.querySelector('input[name="blkgs"]').value = 2;
            document.querySelector('input[name="blkgd"]').value = 5;
            document.querySelector('input[name="rack"]').value = 60;
            document.querySelector('input[name="box"]').value = 1;
            document.querySelector('input[name="chss_stat"]').value = 1;
            document.querySelector('input[name="chss_din"]').value = 1;
            document.querySelector('input[name="chs_d_din"]').value = 5;
            document.querySelector('input[name="ttpchs_s"]').value = 2;
            document.querySelector('input[name="ttpchs_d"]').value = 10;
            document.querySelector('input[name="cntls"]').value = 4;
            document.querySelector('input[name="cntld"]').value = 10;
            document.querySelector('input[name="pngmn"]').value = 2;
            document.querySelector('input[name="rell"]').value = 1;
            document.querySelector('input[name="samb_rell"]').value = 4;
        }
        if ((jumlahValue === 2) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 4;
            document.querySelector('input[name="ttpad"]').value = 20;
            document.querySelector('input[name="smpgs"]').value = 8;
            document.querySelector('input[name="smpgd"]').value = 40;
            document.querySelector('input[name="blkgs"]').value = 4;
            document.querySelector('input[name="blkgd"]').value = 10;
            document.querySelector('input[name="rack"]').value = 120;
            document.querySelector('input[name="box"]').value = 2;
            document.querySelector('input[name="chss_stat"]').value = 2;
            document.querySelector('input[name="chss_din"]').value = 2;
            document.querySelector('input[name="chs_d_din"]').value = 10;
            document.querySelector('input[name="ttpchs_s"]').value = 4;
            document.querySelector('input[name="ttpchs_d"]').value = 20;
            document.querySelector('input[name="cntls"]').value = 8;
            document.querySelector('input[name="cntld"]').value = 20;
            document.querySelector('input[name="pngmn"]').value = 4;
            document.querySelector('input[name="rell"]').value = 2;
            document.querySelector('input[name="samb_rell"]').value = 8;
        }
        if ((jumlahValue === 3) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 6;
            document.querySelector('input[name="ttpad"]').value = 30;
            document.querySelector('input[name="smpgs"]').value = 12;
            document.querySelector('input[name="smpgd"]').value = 60;
            document.querySelector('input[name="blkgs"]').value = 6;
            document.querySelector('input[name="blkgd"]').value = 15;
            document.querySelector('input[name="rack"]').value = 180;
            document.querySelector('input[name="box"]').value = 3;
            document.querySelector('input[name="chss_stat"]').value = 3;
            document.querySelector('input[name="chss_din"]').value = 3;
            document.querySelector('input[name="chs_d_din"]').value = 15;
            document.querySelector('input[name="ttpchs_s"]').value = 6;
            document.querySelector('input[name="ttpchs_d"]').value = 30;
            document.querySelector('input[name="cntls"]').value = 12;
            document.querySelector('input[name="cntld"]').value = 30;
            document.querySelector('input[name="pngmn"]').value = 6;
            document.querySelector('input[name="rell"]').value = 3;
            document.querySelector('input[name="samb_rell"]').value = 12;
        }
        if ((jumlahValue === 4) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 8;
            document.querySelector('input[name="ttpad"]').value = 40;
            document.querySelector('input[name="smpgs"]').value = 16;
            document.querySelector('input[name="smpgd"]').value = 80;
            document.querySelector('input[name="blkgs"]').value = 8;
            document.querySelector('input[name="blkgd"]').value = 20;
            document.querySelector('input[name="rack"]').value = 240;
            document.querySelector('input[name="box"]').value = 4;
            document.querySelector('input[name="chss_stat"]').value = 4;
            document.querySelector('input[name="chss_din"]').value = 4;
            document.querySelector('input[name="chs_d_din"]').value = 20;
            document.querySelector('input[name="ttpchs_s"]').value = 8;
            document.querySelector('input[name="ttpchs_d"]').value = 40;
            document.querySelector('input[name="cntls"]').value = 16;
            document.querySelector('input[name="cntld"]').value = 40;
            document.querySelector('input[name="pngmn"]').value = 8;
            document.querySelector('input[name="rell"]').value = 4;
            document.querySelector('input[name="samb_rell"]').value = 16;
        }
        if ((jumlahValue === 5) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 10;
            document.querySelector('input[name="ttpad"]').value = 50;
            document.querySelector('input[name="smpgs"]').value = 20;
            document.querySelector('input[name="smpgd"]').value = 100;
            document.querySelector('input[name="blkgs"]').value = 10;
            document.querySelector('input[name="blkgd"]').value = 25;
            document.querySelector('input[name="rack"]').value = 300;
            document.querySelector('input[name="box"]').value = 5;
            document.querySelector('input[name="chss_stat"]').value = 5;
            document.querySelector('input[name="chss_din"]').value = 5;
            document.querySelector('input[name="chs_d_din"]').value = 25;
            document.querySelector('input[name="ttpchs_s"]').value = 10;
            document.querySelector('input[name="ttpchs_d"]').value = 50;
            document.querySelector('input[name="cntls"]').value = 20;
            document.querySelector('input[name="cntld"]').value = 50;
            document.querySelector('input[name="pngmn"]').value = 10;
            document.querySelector('input[name="rell"]').value = 5;
            document.querySelector('input[name="samb_rell"]').value = 20;
        }
        if ((jumlahValue === 6) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 12;
            document.querySelector('input[name="ttpad"]').value = 60;
            document.querySelector('input[name="smpgs"]').value = 24;
            document.querySelector('input[name="smpgd"]').value = 120;
            document.querySelector('input[name="blkgs"]').value = 12;
            document.querySelector('input[name="blkgd"]').value = 30;
            document.querySelector('input[name="rack"]').value = 360;
            document.querySelector('input[name="box"]').value = 6;
            document.querySelector('input[name="chss_stat"]').value = 6;
            document.querySelector('input[name="chss_din"]').value = 6;
            document.querySelector('input[name="chs_d_din"]').value = 30;
            document.querySelector('input[name="ttpchs_s"]').value = 12;
            document.querySelector('input[name="ttpchs_d"]').value = 60;
            document.querySelector('input[name="cntls"]').value = 24;
            document.querySelector('input[name="cntld"]').value = 60;
            document.querySelector('input[name="pngmn"]').value = 12;
            document.querySelector('input[name="rell"]').value = 6;
            document.querySelector('input[name="samb_rell"]').value = 24;
        }
        if ((jumlahValue === 7) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 14;
            document.querySelector('input[name="ttpad"]').value = 70;
            document.querySelector('input[name="smpgs"]').value = 28;
            document.querySelector('input[name="smpgd"]').value = 140;
            document.querySelector('input[name="blkgs"]').value = 14;
            document.querySelector('input[name="blkgd"]').value = 35;
            document.querySelector('input[name="rack"]').value = 420;
            document.querySelector('input[name="box"]').value = 7;
            document.querySelector('input[name="chss_stat"]').value = 7;
            document.querySelector('input[name="chss_din"]').value = 7;
            document.querySelector('input[name="chs_d_din"]').value = 35;
            document.querySelector('input[name="ttpchs_s"]').value = 14;
            document.querySelector('input[name="ttpchs_d"]').value = 70;
            document.querySelector('input[name="cntls"]').value = 28;
            document.querySelector('input[name="cntld"]').value = 70;
            document.querySelector('input[name="pngmn"]').value = 14;
            document.querySelector('input[name="rell"]').value = 7;
            document.querySelector('input[name="samb_rell"]').value = 28;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 80;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 160;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 40;
            document.querySelector('input[name="rack"]').value = 480;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 40;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 80;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 80;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 32;
        }
        if ((jumlahValue === 8) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 16;
            document.querySelector('input[name="ttpad"]').value = 80;
            document.querySelector('input[name="smpgs"]').value = 32;
            document.querySelector('input[name="smpgd"]').value = 160;
            document.querySelector('input[name="blkgs"]').value = 16;
            document.querySelector('input[name="blkgd"]').value = 40;
            document.querySelector('input[name="rack"]').value = 480;
            document.querySelector('input[name="box"]').value = 8;
            document.querySelector('input[name="chss_stat"]').value = 8;
            document.querySelector('input[name="chss_din"]').value = 8;
            document.querySelector('input[name="chs_d_din"]').value = 40;
            document.querySelector('input[name="ttpchs_s"]').value = 16;
            document.querySelector('input[name="ttpchs_d"]').value = 80;
            document.querySelector('input[name="cntls"]').value = 32;
            document.querySelector('input[name="cntld"]').value = 80;
            document.querySelector('input[name="pngmn"]').value = 16;
            document.querySelector('input[name="rell"]').value = 8;
            document.querySelector('input[name="samb_rell"]').value = 32;
        }
        if ((jumlahValue === 9) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 18;
            document.querySelector('input[name="ttpad"]').value = 90;
            document.querySelector('input[name="smpgs"]').value = 36;
            document.querySelector('input[name="smpgd"]').value = 180;
            document.querySelector('input[name="blkgs"]').value = 18;
            document.querySelector('input[name="blkgd"]').value = 45;
            document.querySelector('input[name="rack"]').value = 540;
            document.querySelector('input[name="box"]').value = 9;
            document.querySelector('input[name="chss_stat"]').value = 9;
            document.querySelector('input[name="chss_din"]').value = 9;
            document.querySelector('input[name="chs_d_din"]').value = 45;
            document.querySelector('input[name="ttpchs_s"]').value = 18;
            document.querySelector('input[name="ttpchs_d"]').value = 90;
            document.querySelector('input[name="cntls"]').value = 36;
            document.querySelector('input[name="cntld"]').value = 90;
            document.querySelector('input[name="pngmn"]').value = 18;
            document.querySelector('input[name="rell"]').value = 9;
            document.querySelector('input[name="samb_rell"]').value = 36;
        }
        if ((jumlahValue === 10) && (namaMFValue === 'MF 12.22-LG' || namaMFValue === 'MF 12.22-DG' || namaMFValue === 'MF 12.22-GM')) {
            document.querySelector('input[name="ttpas"]').value = 20;
            document.querySelector('input[name="ttpad"]').value = 100;
            document.querySelector('input[name="smpgs"]').value = 40;
            document.querySelector('input[name="smpgd"]').value = 200;
            document.querySelector('input[name="blkgs"]').value = 20;
            document.querySelector('input[name="blkgd"]').value = 50;
            document.querySelector('input[name="rack"]').value = 600;
            document.querySelector('input[name="box"]').value = 10;
            document.querySelector('input[name="chss_stat"]').value = 10;
            document.querySelector('input[name="chss_din"]').value = 10;
            document.querySelector('input[name="chs_d_din"]').value = 50;
            document.querySelector('input[name="ttpchs_s"]').value = 20;
            document.querySelector('input[name="ttpchs_d"]').value = 100;
            document.querySelector('input[name="cntls"]').value = 40;
            document.querySelector('input[name="cntld"]').value = 100;
            document.querySelector('input[name="pngmn"]').value = 20;
            document.querySelector('input[name="rell"]').value = 10;
            document.querySelector('input[name="samb_rell"]').value = 40;
        }
    });
</script>
</body>
</html>