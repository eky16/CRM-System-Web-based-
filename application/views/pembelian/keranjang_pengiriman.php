<tr class="row-keranjang">


		
	
	<td class="nama_cst">
		<?= $this->input->post('nama_cst') ?>
		<input type="hidden" name="id_dt_hidden[]" value="<?= $this->input->post('id_dt') ?>">
		<input type="hidden" name="nama_cst_hidden[]" value="<?= $this->input->post('nama_cst') ?>">
	</td>
	<td class="detailName">
		<?= $this->input->post('detailName') ?>
		<input type="hidden" name="detailName_hidden[]" value="<?= $this->input->post('detailName') ?>">
	</td>
	<td class="quantity">
		<?= $this->input->post('quantity') ?>
		<input type="hidden" name="quantity_hidden[]" value="<?= $this->input->post('quantity') ?>">
	</td>
	<td class="warna">
		<?= $this->input->post('warna') ?>
		<input type="hidden" name="warna_hidden[]" value="<?= $this->input->post('warna') ?>">
	</td>
	<td class="detailNotes">
		<?= $this->input->post('detailNotes') ?>
		<input type="hidden" name="detailNotes_hidden[]" value="<?= $this->input->post('detailNotes') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('nama_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>