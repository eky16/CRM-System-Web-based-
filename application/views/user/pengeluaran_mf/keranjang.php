<tr class="row-keranjang">
	<td class="Nama_mf">
		<?= $this->input->post('Nama_mf') ?>
		<input type="hidden" name="nama_barang_mf_hidden[]" value="<?= $this->input->post('Nama_mf') ?>">
	</td>
	<td class="Kode_mf">
		<?= $this->input->post('Kode_mf') ?>
		<input type="hidden" name="Kode_mf_hidden[]" value="<?= $this->input->post('Kode_mf') ?>">
	</td>
	<td class="jumlah_mf">
		<?= $this->input->post('jumlah_mf') ?>
		<input type="hidden" name="jumlah_mf_hidden[]" value="<?= $this->input->post('jumlah_mf') ?>">
	</td>
	<td class="Satuan_mf">
		<?= $this->input->post('Satuan_mf') ?>
		<input type="hidden" name="Satuan_mf_hidden[]" value="<?= $this->input->post('Satuan_mf') ?>">
	</td>

	<td class="ttpas">
		<?= $this->input->post('ttpas') ?>
		<input type="hidden" name="ttpas_hidden[]" value="<?= $this->input->post('ttpas') ?>">
	</td>
	<td class="ttpad">
		<?= $this->input->post('ttpad') ?>
		<input type="hidden" name="ttpad_hidden[]" value="<?= $this->input->post('ttpad') ?>">
	</td>
	<td class="smpgs">
		<?= $this->input->post('smpgs') ?>
		<input type="hidden" name="smpgs_hidden[]" value="<?= $this->input->post('smpgs') ?>">
	</td>
	<td class="smpgd">
		<?= $this->input->post('smpgd') ?>
		<input type="hidden" name="smpgd_hidden[]" value="<?= $this->input->post('smpgd') ?>">
	</td>
	<td class="blkgs">
		<?= $this->input->post('blkgs') ?>
		<input type="hidden" name="blkgs_hidden[]" value="<?= $this->input->post('blkgs') ?>">
	</td>
	<td class="blkgd">
		<?= $this->input->post('blkgd') ?>
		<input type="hidden" name="blkgd_hidden[]" value="<?= $this->input->post('blkgd') ?>">
	</td>
	<td class="rack">
		<?= $this->input->post('rack') ?>
		<input type="hidden" name="rack_hidden[]" value="<?= $this->input->post('rack') ?>">
	</td>
	<td class="box">
		<?= $this->input->post('box') ?>
		<input type="hidden" name="box_hidden[]" value="<?= $this->input->post('box') ?>">
	</td>
	<td class="chss_stat">
		<?= $this->input->post('chss_stat') ?>
		<input type="hidden" name="chss_stat_hidden[]" value="<?= $this->input->post('chss_stat') ?>">
	</td>
	<td class="chss_din">
		<?= $this->input->post('chss_din') ?>
		<input type="hidden" name="chss_din_hidden[]" value="<?= $this->input->post('chss_din') ?>">
	</td>
	<td class="chs_d_din">
		<?= $this->input->post('chs_d_din') ?>
		<input type="hidden" name="chs_d_din_hidden[]" value="<?= $this->input->post('chs_d_din') ?>">
	</td>
	<td class="ttpchs_s">
		<?= $this->input->post('ttpchs_s') ?>
		<input type="hidden" name="ttpchs_s_hidden[]" value="<?= $this->input->post('ttpchs_s') ?>">
	</td>
	<td class="ttpchs_d">
		<?= $this->input->post('ttpchs_d') ?>
		<input type="hidden" name="ttpchs_d_hidden[]" value="<?= $this->input->post('ttpchs_d') ?>">
	</td>
	<td class="cntls">
		<?= $this->input->post('cntls') ?>
		<input type="hidden" name="cntls_hidden[]" value="<?= $this->input->post('cntls') ?>">
	</td>
	<td class="cntld">
		<?= $this->input->post('cntld') ?>
		<input type="hidden" name="cntld_hidden[]" value="<?= $this->input->post('cntld') ?>">
	</td>
	<td class="pngmn">
		<?= $this->input->post('pngmn') ?>
		<input type="hidden" name="pngmn_hidden[]" value="<?= $this->input->post('pngmn') ?>">
	</td>
	<td class="rell">
		<?= $this->input->post('rell') ?>
		<input type="hidden" name="rell_hidden[]" value="<?= $this->input->post('rell') ?>">
	</td>
	<td class="samb_rell">
		<?= $this->input->post('samb_rell') ?>
		<input type="hidden" name="samb_rell_hidden[]" value="<?= $this->input->post('samb_rell') ?>">
	</td>

		<td class="ket_keluar_mf">
		<?= strtoupper($this->input->post('ket_keluar_mf')) ?>
		<input type="hidden" name="ket_keluar_mf_hidden[]" value="<?= $this->input->post('ket_keluar_mf') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('Nama_mf') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>