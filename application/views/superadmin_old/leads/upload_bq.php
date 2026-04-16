<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
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
                        <a href="<?= base_url('leads') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                    </div>
                </div>
                <hr>
                 					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"> <strong><?php echo anchor('img/format_upload.xls");', 'Download Format');?> </strong>
                        </div>
                            <div class="card-body">
            <form method="post" action="<?= base_url('leads/importExcel') ?>" enctype="multipart/form-data">

                                <div class="form-row">
                                	<?php  $codek =  random_string('numeric', 7);
                                    $code = $codek ; ?>
		
									<input type="text" name="kode" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?php $txt = sprintf("%05s");
                                        $kodeTransaksi_pr = 'RAB'.$code;
                                        echo $kodeTransaksi_pr;  ?>" maxlength="5" hidden>
                                        <div class="form-group col-md-3">
                                            <label for="kode_barang"><strong>File </strong><i><span style="font-size: 11px; color: red;">Excel 97-2003 Worksheet (.xls )</span></i></label>
                                            <input type="file" name="file" placeholder="Masukkan Kode "  class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        </div>
                                        <div class="form-group col-md-4">
                                        	<label for="kode_barang"><strong>Pyoyek</strong> <i><span style="font-size: 11px;">Pilih proyek</span></i></label>
                                        	<select name="project" id="project" class="form-control" required>
                                        		<option value="" >PILIH .....</option>
                                        		<?php foreach ($proyek as $prk) : ?>
                                        			<option value="<?php echo $prk->projectNo ?>"
                                        				><?php echo $prk->project_name ?></option>
                                        			<?php endforeach; ?>
                                        		</select>

                                        	</div>
                                            <div class="form-group col-md-4">
                                        	<label for="kode_barang"><strong>Deskripsi</strong> <i><span style="font-size: 11px;">Pilih proyek</span></i></label>
                              <select name="jenis_rap" id="jenis_rap"  class="form-control"  required>
                            <option value="">PILIH</option>
                            <option value="Preliminaries" <?php
                            if (!empty($row->jenis_p_item)) {
                                echo $row->jenis_p_item == 'Preliminaries' ? 'selected' : '';
                            }
                            ?>>Preliminaries</option>
                            <option value="ME" <?php
                            if (!empty($row->jenis_p_item)) {
                                echo $row->jenis_p_item == 'ME' ? 'selected' : '';
                            }
                            ?>>ME</option>
                            <option value="Sipil" <?php
                            if (!empty($row->jenis_p_item)) {
                                echo $row->jenis_p_item == 'Sipil' ? 'selected' : '';
                            }
                            ?>>Sipil</option>
                            <option value="Furniture" <?php
                            if (!empty($row->jenis_p_item)) {
                                echo $row->jenis_p_item == 'Furniture' ? 'selected' : '';
                            }
                            ?>>Furniture</option>
                            <option value="DLL" <?php
                            if (!empty($row->jenis_p_item)) {
                                echo $row->jenis_p_item == 'DLL' ? 'selected' : '';
                            }
                            ?>>DLL</option>
                            </select>
                                        		
                                        	</div>
                                    </div>

                        
                                    <div class="form-row">
                        
                                    <hr>
                                    <div class="form-group">
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
            <!-- load footer -->

            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('user/partials/js.php') ?>
</body>
</html>