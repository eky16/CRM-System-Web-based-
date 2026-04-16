<tr class="row-keranjang">

	<td class="no_spk">
		<?= $this->input->post('no_spk') ?>
		<input type="hidden" name="no_spk_hidden[]" value="<?= $this->input->post('no_spk') ?>">
	</td>
	<td class="id_project">
		<?= $this->input->post('id_project2') ?>
		<input type="hidden" name="id_project_hidden[]" value="<?= $this->input->post('id_project') ?>">
	</td>
	<td class="vendor">
		<?= $this->input->post('vendor_name') ?>
		<input type="hidden" name="vendor_hidden[]" value="<?= $this->input->post('vendor') ?>">
	</td>
	<td class="sisa_pembayaran">
		<?= $this->input->post('sisa_pembayaran') ?>
		<input type="hidden" name="sisa_pembayaran_hidden[]" value="<?= $this->input->post('sisa_pembayaran') ?>">
	</td>
	<td class="pajak">
		<?= strtoupper($this->input->post('pajak')) ?>
		<input type="hidden" name="pajak_hidden[]" value="<?= $this->input->post('pajak') ?>">
	</td>
		<td class="dibayarkan">
		<?= strtoupper($this->input->post('dibayarkan')) ?>
		<input type="hidden" name="dibayarkan_hidden[]" value="<?= $this->input->post('dibayarkan') ?>">
	</td>
		<td class="detailNotes">
		<?= strtoupper($this->input->post('detailNotes')) ?>
		<input type="hidden" name="detailNotes_hidden[]" value="<?= $this->input->post('detailNotes') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('nama_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>