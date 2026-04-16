
<tr class="row-keranjang">

	<td class="detailName">
		<?= $this->input->post('detailName') ?>
		<input type="hidden" name="detailName_hidden[]" value="<?= $this->input->post('detailName') ?>">
	</td>
	<td class="itemNo">
		<?= $this->input->post('itemNo') ?>
		<input type="hidden" name="itemNo_hidden[]" value="<?= $this->input->post('itemNo') ?>">
	</td>
	<td class="warna">
		<?= $this->input->post('warna') ?>
		<input type="hidden" name="warna_hidden[]" value="<?= $this->input->post('warna') ?>">
	</td>
	<td class="quantity">
		<?= $this->input->post('quantity') ?> - <?= $this->input->post('itemUnitName') ?>
		<input type="hidden" name="quantity_hidden[]" value="<?= $this->input->post('quantity') ?>">
		<input type="hidden" name="itemUnitName_hidden[]" value="<?= $this->input->post('itemUnitName') ?>">
	</td>
	<td class="file" >
		<input type="file" class="form-control" name="berkas[]" >
	</td>
	<td class="status_packing">
		<?= $this->input->post('status_packing') ?>
		<input type="hidden" name="status_packing_hidden[]" value="<?= $this->input->post('status_packing') ?>">
	</td>
	<td class="detailNotes">
		<?= strtoupper($this->input->post('detailNotes')) ?>
		<input type="hidden" name="detailNotes_hidden[]" value="<?= $this->input->post('detailNotes') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('nama_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>