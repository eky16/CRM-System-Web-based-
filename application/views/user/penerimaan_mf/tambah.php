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
			<div id="content" data-url="<?= base_url('user/penerimaan_mf') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/penerimaan_mf') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/penerimaan_mf/proses_tambah_mf') ?>" id="form-tambah" method="POST">
									<h5>Data Admin</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-2">
											<label>No. Terima</label>
											<input type="text" name="no_terima" value="TR-MF.<?= time() ?>"  class="form-control">
										</div>
										<div class="form-group col-3">
											<label>NIK</label>
											<input type="text" name="kode_petugas" value="<?= $this->session->login['kode'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-3">
											<label>Nama</label>
											<input type="text" name="nama_petugas" value="<?= $this->session->login['nama'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Tanggal Terima</label>
											<input type="text" name="tgl_terima" value="<?= date('Y-m-d') ?>" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Jam</label>
											<input type="text" name="jam_terima" value="<?= date('H:i:s') ?>" readonly class="form-control">
										</div>
									</div>
									<div class="row">

										<div class="col-md-12">
											<h5>Data Barang</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-3">
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

												
												<div class="form-group col-6">
													<label>Keterangan</label>
													<textarea class="form-control" name="ket_penerimaan_mf"> </textarea>
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="keranjang">
										<div class="table-responsive">
										<h5>Detail Penerimaan</h5>
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

			$('#nama_supplier').on('change', function(){
				$(this).prop('disabled', true)
				$('#reset').prop('disabled', false)
				$('input[name="nama_supplier"]').val($(this).val())
			})

			$(document).on('click', '#reset', function(){
				$('#nama_supplier').val('')
				$('#nama_supplier').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="nama_supplier"]').val('')
			})

			$('#Nama_mf').on('change', function(){

				if($(this).val() == '') reset()
				else {
					$.ajax({
						url : "<?php echo site_url('user/penerimaan_mf/get_all_barang');?>",
						type: 'POST',
						dataType: 'json',
						data: {Nama_mf: $(this).val()},
						success: function(data){
							$('input[name="Kode_mf"]').val(data.kode_mf)
							$('input[name="jumlah_mf"]').val(1)
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
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
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
					Satuan_mf: $('input[name="Satuan_mf"]').val(),
					hrg_brg: $('input[name="hrg_brg"]').val(),
					ket_penerimaan_mf: $('textarea[name="ket_penerimaan_mf"]').val(),
				}

				$.ajax({
					url: "<?php echo site_url('user/penerimaan_mf/keranjang_barang');?>",
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
				$('textarea[name="ket_penerimaan_mf"]').val('')
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
</body>
</html>