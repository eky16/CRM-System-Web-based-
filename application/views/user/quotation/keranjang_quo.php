
<tr class="row-keranjang_quo">

	<td class="detailName_quo">
		<?= $this->input->post('detailName_quo') ?>
		<input type="hidden" name="detailName_quo_hidden[]" value="<?= $this->input->post('detailName_quo') ?>">
	</td>
	<td class="item_no">
		<?= $this->input->post('item_no') ?>
		<input type="hidden" name="item_no_hidden[]" value="<?= $this->input->post('item_no') ?>">
	</td>
	<td class="kategori_barang">
		<?= $this->input->post('kategori_barang') ?>
		<input type="hidden" name="kategori_barang_hidden[]" value="<?= $this->input->post('kategori_barang') ?>">
	</td>
	<td class="quantity">
		<?= $this->input->post('quantity') ?>
		<input type="hidden" name="quantity_hidden[]" value="<?= $this->input->post('quantity') ?>">
	</td>
	<td class="segment_barang">
		<?= $this->input->post('segment_barang') ?>
		<input type="hidden" name="segment_barang_hidden[]" value="<?= $this->input->post('segment_barang') ?>">
	</td>
	<td class="jenis_furniture">
		<?= $this->input->post('jenis_furniture') ?>
		<input type="hidden" name="jenis_furniture_hidden[]" value="<?= $this->input->post('jenis_furniture') ?>">
	</td>
	<td class="harga">
		<?= $this->input->post('harga') ?>
		<input type="hidden" name="harga_hidden[]" value="<?= $this->input->post('harga') ?>">
	</td>
	<td class="diskon_persen">
		<?= $this->input->post('diskon_persen') ?>
		<input type="hidden" name="diskon_persen_hidden[]" value="<?= $this->input->post('diskon_persen') ?>">
	</td>
	<td class="diskon_rupiah">
		<?= $this->input->post('diskon_rupiah') ?>
		<input type="hidden" name="diskon_rupiah_hidden[]" value="<?= $this->input->post('diskon_rupiah') ?>">
	</td>
	<td class="follow_up_date">
		<?= $this->input->post('follow_up_date') ?>
		<input type="hidden" name="follow_up_date_hidden[]" value="<?= $this->input->post('follow_up_date') ?>">
	</td>
	
	<td class="file" >
		<input type="file" class="form-control" name="berkas[]" >
	</td>
	
	<td class="detailNotes_quo">
		<?= strtoupper($this->input->post('detailNotes_quo')) ?>
		<input type="hidden" name="detailNotes_quo_hidden[]" value="<?= $this->input->post('detailNotes_quo') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('nama_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>