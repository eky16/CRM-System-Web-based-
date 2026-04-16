<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">
		#hidden_div { 
    display: none;
}
	</style>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

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
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('leads/proses_ubah/' . $leads->id_lsp) ?>" id="form-tambah" method="POST">
								<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_barang"><strong>Kode Leads Project</strong></label>
											<input type="text" name="id_lsp" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?= $leads->id_lsp ?>" maxlength="8" readonly>
										</div>
											<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $leads->createdby ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-6">
										<label>Date Create</label>
										<input type="text" readonly name="createdtime" value="<?= $leads->createdtime ?>"  class="form-control">
											</div>
							       <input type="hidden" name="updateby" value="<?php echo  $this->session->login['nama'] ?>">
                             		<input type="hidden" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d  H:i:s');
                                ?>">
									</div>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="kode_barang"><strong>Tgl Start Project</strong></label>
											<input type="date" name="tgl_start" placeholder="Masukkan Kode " autocomplete="off"  class="form-control"  value="<?= $leads->tgl_start ?>" maxlength="8" >
										</div>
												<div class="form-group col-md-4">
											<label for="kode_barang"><strong>Tgl Serah Terima</strong></label>
											<input type="date" name="tgl_serah_terima" placeholder="Masukkan Kode " autocomplete="off"  class="form-control"  value="<?= $leads->tgl_serah_terima ?>" maxlength="8" >
										</div>
										<div class="form-group col-md-4">
											<label for="kode_barang"><strong>Designer</strong></label>
						<select id="select-state" placeholder="Designer" name="designerBy" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($dn as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($leads->designerBy)) {
                                    echo $spv->nama_karyawan == $leads->designerBy ? 'selected' : '';
                                }
                                ?>><?php echo  $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select> 
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label for="kode_barang"><strong>PM</strong> <i><span style="font-size: 11px;">Project manager</span></i></label>
						<select id="select-state" placeholder="project_manager" name="project_manager" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($pm as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($leads->project_manager)) {
                                    echo $spv->nama_karyawan == $leads->project_manager ? 'selected' : '';
                                }
                                ?>><?php echo  $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select> 
            
										</div>
												<div class="form-group col-md-4">
											<label for="kode_barang"><strong>SM</strong> <i><span style="font-size: 11px;">Site manager</span></i></label>
														<select id="select-state" placeholder="site_manager" name="site_manager" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($sm as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($leads->site_manager)) {
                                    echo $spv->nama_karyawan == $leads->site_manager ? 'selected' : '';
                                }
                                ?>><?php echo $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select>
										</div>
									<div class="form-group col-md-4">
											<label for="kode_barang"><strong>SPV</strong> <i><span style="font-size: 11px;">Supervisor</span></i></label>
						<select id="select-state" placeholder="spv_manager" name="spv_manager" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($spv1 as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($leads->spv_manager)) {
                                    echo $spv->nama_karyawan == $leads->spv_manager ? 'selected' : '';
                                }
                                ?>><?php echo  $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select>	
										</div>
									</div>

									<div class="form-row">

										<div class="form-group col-md-3">
											<label for="nama_barang"><strong>Nama PIC</strong></label>
											<input type="text" name="nama_pic" placeholder="Masukkan Nama PIC" autocomplete="off" value="<?= $leads->nama_pic ?>" maxlength="50"  class="form-control" required>
										</div>
										<div class="form-group col-3">
											<label>No Telp</label>

											<input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
											    type = "number"
											    maxlength = "15" name="no_telp" placeholder="Masukkan No Tlp"  value="<?= $leads->no_telp ?>"  class="form-control">
										</div>
										<div class="form-group col-6">
											<label>Email</label>
											<input type="email" name="email" placeholder="Masukkan Email" autocomplete="off" value="<?= $leads->email ?>"  class="form-control">
										</div>
									</div>

									<div class="form-row">

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Project</strong></label>
											<input type="text" name="nama_project" placeholder="Masukkan Nama Project" autocomplete="off" maxlength="50"  class="form-control" value="<?= $leads->nama_project ?>" required>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Perusahaan</strong></label>
											<input type="text" name="nama_kantor" placeholder="Masukkan Nama Perusahaan" autocomplete="off" maxlength="50" value="<?= $leads->nama_kantor ?>"  class="form-control" >
										</div>
										<div class="form-group col-6">
											<label>Alamat Project</label>
										<textarea  name="alamat_project" class="form-control" ><?= $leads->alamat_project ?></textarea>
										</div>
										<div class="form-group col-6">
											<label>Alamat Perusahaan</label>
											<textarea  name="alamat_kantor" class="form-control" ><?= $leads->alamat_kantor ?></textarea>
									</div>
									<div class="form-group col-6" >
											<label>Telp Perusahaan</label>
											<input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
											    type = "number"
											    maxlength = "15" name="tlp_kantor" placeholder="Masukkan No Tlp Kantor"  value="<?= $leads->tlp_kantor ?>"  class="form-control">
										</div>
										<div class="form-group col-6" >
											<label>Status Project</label>
							<select id="status_proyek" placeholder="Status Project" name="status_project" class="form-control" onchange="showDiv('hidden_div', this)" required>           
			                 <option value="" >PILIH .....</option>
                            <?php foreach ($all_status_project as $status) : ?>
                                <option value="<?php echo $status->keterangan ?>" <?php
                                if (!empty($leads->status_project)) {
                                    echo $status->keterangan == $leads->status_project ? 'selected' : '';
                                }
                                ?>><?php echo $status->keterangan ?></option>
                                    <?php endforeach; ?>

			                       </select> 

			             

										</div>
									<div class="form-group col-12" id="tgl_retensi">
											<label>Tanggal Retensi</label>
									<input type="date" name="tanggal_retensi" placeholder="Masukkan Kode " autocomplete="off"  class="form-control"  value="<?= $leads->tanggal_retensi ?>" maxlength="8" >
									</div>
									<div class="form-group col-12" id="ket_lose">
										<label>Keterangan</label>
										<textarea  name="keterangan_loose" class="form-control" ><?php
										if (!empty($emp->keterangan_loose)) {
											echo $emp->keterangan_loose ;
										}
									?></textarea>
								</div>
							</div>
	<script>
$(document).ready(function(){ 

  $("select[id=status_proyek]").on("change", function() { 
if ($(this).val() === "RETENSI") { 
        $("div[id=tgl_retensi]").show().find('input, textarea').prop('disabled', false);
        $("div[id=ket_lose]").hide().find('input, textarea').prop('disabled', true);
    } 
if ( $(this).val() === "LOOSE") { 
    $("div[id=tgl_retensi]").hide().find('input, textarea').prop('disabled', true);
    $("div[id=ket_lose]").show().find('input, textarea').prop('disabled', false);
    } 
if ( $(this).val() != "RETENSI") { 
    $("div[id=tgl_retensi]").hide().find('input, textarea').prop('disabled', true);
    } 
if ( $(this).val() != "LOOSE") { 
    $("div[id=ket_lose]").hide().find('input, textarea').prop('disabled', false);
    } 
  }); 
  $("select[id=status_proyek]").trigger("change");

});
</script>								
					<input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Ubah Leads Project" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s'); ?>"> 						
									<div class="form-row">
						
									<hr>
									<div class="form-group  ">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>

				</div>
			</div>
<script type="text/javascript">
    function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == "LOOSE" ? 'block' : 'none' ;
   
}
</script>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>