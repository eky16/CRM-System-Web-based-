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
			<?php foreach ($hd_api as $key => $vn) : ?>
                  <?php   $token = $vn->akses_token;
                            $session = $vn->session_api; ?>
                     <?php  endforeach; ?>
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
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('leads/proses_tambah') ?>"  id="from1" name="form" method="POST">

								<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_barang"><strong>Kode Leads Project</strong></label>
											<input type="text" name="id_lsp" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?php  $decode =  random_string('numeric', 5);
                                            $code = "P".$decode; echo $code; ?>"  maxlength="8" readonly>
										</div>

											<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-6">
										<label>Date Create</label>
										<input type="text" readonly name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
		                                echo date('Y-m-d  H:i:s');
		                                ?>"  class="form-control">
											</div>
							       <input type="hidden" name="updateby" value="<?php echo  $this->session->login['nama'] ?>">
                             		<input type="hidden" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d  H:i:s');
                                ?>">
									</div>
								<div class="form-row">
										<div class="form-group col-md-4">
											<label for="kode_barang"><strong>Tgl Start Project</strong></label>
											<input type="date" name="tgl_start" placeholder="Masukkan Kode " autocomplete="off"  class="form-control"  value="<?php echo $kode_leadsproject; ?>" maxlength="8" >
										</div>
												<div class="form-group col-md-4">
											<label for="kode_barang"><strong>Tgl Serah Terima</strong></label>
											<input type="date" name="tgl_serah_terima" placeholder="Masukkan Kode " autocomplete="off"  class="form-control"  value="<?php echo $kode_leadsproject; ?>" maxlength="8" >
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
										<div class="form-group col-md-6">
											<label for="kode_barang"><strong>PM</strong> <i><span style="font-size: 11px;">Project manager</span></i></label>
						<select id="select-state" placeholder="project_manager" name="project_manager" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($pm as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($emp->supervisorID)) {
                                    echo $spv->EmployeeID == $emp->supervisorID ? 'selected' : '';
                                }
                                ?>><?php echo $spv->EmployeeID .' - '. $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select> 
            
										</div>
												<div class="form-group col-md-3">
											<label for="kode_barang"><strong>SM</strong> <i><span style="font-size: 11px;">Site manager</span></i></label>
														<select id="select-state" placeholder="site_manager" name="site_manager" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($sm as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($emp->supervisorID)) {
                                    echo $spv->EmployeeID == $emp->supervisorID ? 'selected' : '';
                                }
                                ?>><?php echo $spv->EmployeeID .' - '. $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select>
										</div>
									<div class="form-group col-md-3">
											<label for="kode_barang"><strong>SPV</strong> <i><span style="font-size: 11px;">Supervisor</span></i></label>
						<select id="select-state" placeholder="spv_manager" name="site_manager" class="form-control" >           
                             <option value="" >PILIH .....</option>
                            <?php foreach ($spv1 as $spv) : ?>
                                <option value="<?php echo $spv->nama_karyawan ?>" <?php
                                if (!empty($emp->supervisorID)) {
                                    echo $spv->EmployeeID == $emp->supervisorID ? 'selected' : '';
                                }
                                ?>><?php echo $spv->EmployeeID .' - '. $spv->nama_karyawan ?></option>
                                    <?php endforeach; ?>

                                   </select>	
										</div>
									</div>
									<div class="form-row">

										<div class="form-group col-md-3">
											<label for="nama_barang"><strong>Nama PIC</strong></label>
											<input type="text" name="nama_pic" placeholder="Masukkan Nama PIC" autocomplete="off" maxlength="50"  class="form-control" required>
										</div>
										<div class="form-group col-3">
											<label>No Telp</label>

											<input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
											    type = "number"
											    maxlength = "15" name="no_telp" placeholder="Masukkan No Tlp"  value=""  class="form-control">
										</div>
										<div class="form-group col-6">
											<label>Email</label>
											<input type="email" name="email" placeholder="Masukkan Email" autocomplete="off" value=" "  class="form-control">
										</div>
									</div>

									<div class="form-row">

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Project</strong></label>
											<input type="text" name="name" placeholder="Masukkan Nama Project" autocomplete="off" id="id-nama" maxlength="50"  class="form-control" >
											<input type="text" name="no" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?= $code;  ?>" maxlength="8" hidden>
										</div>
																				<script type="text/javascript">
											$("#id-nama").on({
    keydown: function(e) {
    if (e.which == 222 || e.which == 221 || e.which == 219 || e.which == 220 || e.which == 187)
        return false;
    },
    });
										</script>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Perusahaan</strong></label>
											<input type="text" name="nama_kantor" placeholder="Masukkan Nama Project" autocomplete="off" maxlength="50"  class="form-control" >
										</div>

										<div class="form-group col-6">
											<label>Alamat Project</label>
										<textarea  name="description" class="form-control" ><?php
			                            if (!empty($employee_info->alamat_project)) {
			                                echo $employee_info->alamat_project;
			                            }
			                            ?></textarea>
										</div>
										<div class="form-group col-6">
											<label>Alamat Perusahaan</label>
											<textarea  name="alamat_kantor" class="form-control" ><?php
			                            if (!empty($employee_info->alamat_kantor)) {
			                                echo $employee_info->alamat_kantor;
			                            }
			                            ?></textarea>
									</div>
									<hr>
									<div class="form-group col-6" >
											<label>Telp Perusahaan</label>
											<input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
											    type = "number"
											    maxlength = "15" name="tlp_kantor" placeholder="Masukkan No Tlp Kantor"  value=""  class="form-control">
										</div>
										<div class="form-group col-6" >
											<label>Status Project</label>
							<select id="select-state" placeholder="Status Project" name="status_project" class="form-control" required>           
			                 <option value="" >PILIH .....</option>
                            <?php foreach ($all_status_project as $status) : ?>
                                <option value="<?php echo $status->keterangan ?>" <?php
                                if (!empty($leads->keterangan)) {
                                    echo $status->keterangan == $leads->keterangan ? 'selected' : '';
                                }
                                ?>><?php echo $status->keterangan ?></option>
                                    <?php endforeach; ?>

			                       </select> 
										</div>
									</div>
					<input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Tambah Leads Project" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s'); ?>"> 
						
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

                                    <script>
                                        document.querySelector('#from1').addEventListener('submit', function(e) { 
                                            var form = this;
                                            var input = $('#from1').serialize();
                                            e.preventDefault();

                                            swal({
                                                title: "Are you sure?",
                                                text: "Project Akan Diintegrasikan dengan Accurate",
                                                icon: "warning",
                                                buttons: [
                                                    'No, cancel it!',
                                                    'Yes, I am sure!'
                                                    ],
                                                dangerMode: true,
                                            }).then(function(isConfirm) {
                                                if (isConfirm) {
                                                    swal({
                                                        title: 'Success!',
                                                        text: 'Project Berhasil Diintegrasikan Dengan Accurate, Sukses!',
                                                        icon: 'success'

                                                    }).then(function() {
                                                        $.ajax({ 
                                                            type: 'POST',
                                                            url: 'https://public.accurate.id/accurate/api/project/save.do?access_token=<?= $token;?>&session=<?= $session;?>',
                                                            data: JSON.stringify(input),
                                                            mode: 'no-cors',
                                                            dataType : 'JSON',
                      //    contentType: 'application/json; charset=utf-8',
                                                            success:function(data){
                                                                console.log(data)
                                                            }

                                                        })

                                                    }).then(function(data) {
                                                        window.setTimeout(function() { document.form.submit(); }, 1000);        
                                                    })
                                                }  else {
                                                    swal("Cancelled", "Project tidak ada perubahan :)", "error");
                                                }
                                            });
                                        });


                                    </script> <!-- selesai modal asset -->
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>