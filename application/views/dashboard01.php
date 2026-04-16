<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
    <script type="text/javascript">
// 1 detik = 1000
window.setTimeout("waktu()",1000);  
function waktu() {   
var tanggal = new Date();  
setTimeout("waktu()",1000);  
document.getElementById("jam").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
}
</script>
  <script language="JavaScript">
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
    </script>


    <style type="text/css">
      .leave_apps{
    list-style: none;  
    margin-left: -42px;
    margin-top: -9px;
}
.ex3 {
  height: 338px;
  width: auto;

  overflow-y: auto;
}
    </style>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800">Welcome <i><?php echo  $this->session->login['akses'] ?></i></h1>
						</div>
                        <div class="float-right " id='jam'>
                           
                        </div>
                        <div class="float-right" >
                            <h1 class="h3 m-0 text-gray-800"><script language='JavaScript'>document.write(tanggallengkap);</script>
                        </div>
					</div>
				 <hr style="height:2px;border-width:0;color:red;background-color:#cacad3">
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

			            <!-- Earnings (Monthly) Card Example -->
			            <!-- <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-primary shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="leads"> DATA LEADS PROJECT </a> </div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_leads ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <a target="_blank" href="leads"> <i class="fas fa-box fa-2x text-gray-000"></i></a>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div> -->

			            <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">LEADS PROJECT PENDING</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pending ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas  fa-handshake fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">LEADS PROJECT TENDER</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tender ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-handshake fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">LEADS PROJECT ON GOING</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ongoing ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas  fa-binoculars fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">LEADS PROJECT FINISH</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $finish ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-check fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">LEADS PROJECT LOOSE</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $loose ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-remove  fa-2x text-gray-000"></i>
                                </div> 
                              </div>
                            </div>
                          </div>
                        </div>
			            <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-success shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="mom/lihat_semua">M O M BERJALAN </a></div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_mom ?></div>
			                    </div>
			                    <div class="col-auto">
			                    <a target="_blank" href="mom/lihat_semua">  <i class="fas fa-handshake fa-2x text-gray-000"></i></a>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div> -->

			            <!-- Earnings (Monthly) Card Example -->
			            <!-- <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-info shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a target="_blank" href="mom/lihat_semua_goal">M O M GOAL</a></div>
			                      <div class="row no-gutters align-items-center">
			                        <div class="col-auto">
			                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_mom_goal ?></div>
			                        </div>
			                      </div>
			                    </div>
			                    <div class="col-auto">
			                    <a target="_blank" href="mom/lihat_semua_goal">  <i class="fas fa fa-check fa-2x text-gray-000"></i></a>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div> -->

			            <!-- Pending Requests Card Example -->
			            <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-warning shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> <a target="_blank" href="mom/lihat_nogoal"> TIDAK GOAL</a></div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_no_goal ?></div>
			                    </div>
			                    <div class="col-auto">
			                     <a target="_blank" href="mom/lihat_nogoal">  <i class="fas fa-close fa-2x text-gray-000"></i></a>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div>
			        </div>

<hr style="height:2px;border-width:0;color:red;background-color:#cacad3"> <!-- start hrms info -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="izin"> PERSETUJUAN ATASAN </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $izin_atasan ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="izin">   <i class="fas   fa fa-spinner fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="izin/hrd"> PERSETUJUAN HRD </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $izin_hrd ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="izin/hrd">   <i class="fas   fa fa-paper-plane fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="izin/disetujui"> TELAH DISETUJUI </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $izin_disetujui ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="izin/disetujui">   <i class="fas fa fa-thumbs-up fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="izin/ditolak"> DITOLAK </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $izin_ditolak ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="izin/ditolak">   <i class="fas fa fa-times-circle-o fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<hr style="height:2px;border-width:0;color:red;background-color:#cacad3">
                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="karyawan/lihat_semua"> KARYAWAN AKTIF </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employee_aktif ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="karyawan/lihat_semua">   <i class="fas fa-users fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->

                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">KARYAWAN PERCOBAAN</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employee_percobaan ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-hourglass fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">KARYAWAN KONTRAK</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employee_kontrak ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-handshake fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">KARYAWAN TETAP</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employee_tetap ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas  fa-user fa-2x text-gray-000"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a target="_blank" href="karyawan/lihat_semua_nonaktif"> KARYAWAN NON-AKTIF</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employee_nonaktif ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="karyawan/lihat_semua_nonaktif">   <i class="fas fa fa-times-circle fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                                  <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a target="_blank" href="absensi"> ABSENSI HARI INI </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_absen ?> / <?= $employee_aktif ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="absensi">   <i class="fas fa fa-times-circle fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4"> -->

                       
</div>
                    </div> <!-- end hrms info -->
                   <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Karyawan Habis Masa Kerja</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                                 <div class="card-body ex3">
               <ul class="leave_apps ">           
                                    <li><!-- start message -->
                                        <a  >
                                            <h5>

                                        <?php foreach ($masa_kerja as $masa_kerja): ?>
                                         <a  target="blank" href="<?php echo base_url() ?>karyawan/ubah/<?php echo $masa_kerja->id ?>">
                                         <small ><?= $masa_kerja->nama_karyawan ?></small> - <font size="2"> <?= $masa_kerja->divisi.' '.$masa_kerja->department; ?></font>
                                      <font size="3">
                                      <small style="color:red"  class="apps_category">(<?php  $awal  = new DateTime($masa_kerja->akhir_kerja);
                                    $akhir = new DateTime(date('Y-m-d')); // waktu sekarang
                                    $diff  = date_diff( $awal, $akhir );
                                    echo   $diff->days.'  '. 'HARI '; ?>)</small> </font>
                                     <i><font size="2">HABIS <?= $masa_kerja->perjanjian_kerja; ?></font></i>

                                          <hr style="height:1px;border-width:auto;color:red;background-color:#cacad3">
                                         

                                            <?php endforeach ?>
                                            </h5>

                                     
                                        </a></a>
                                    </li>
                          
                        </ul>

                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Log</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body ex3">
               <ul class="leave_apps ">           
                                    <li><!-- start message -->
                                        <a  >
                                            <h5>

                                        <?php foreach ($log as $log): ?>
                                         <small ><?= $log->ket  ?></small> <i><font size="1"><?= $log->user.' '.$log->waktu; ?></font></i>
                                          <hr style="height:1px;border-width:auto;color:red;background-color:#cacad3">
                                         

                                            <?php endforeach ?>
                                            </h5>

                                     
                                        </a>
                                    </li>
                          
                        </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations --> 
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
         
              <table class="table table"  width="100%" cellspacing="0">
                 <thead>
                                <tr>
                                    <th >Asset</th>
                                    <th >Pajak</th>  
                                    <th>Masa Berlaku</th>                                            
                                </tr>
                            </thead>
                  <tbody>                                                        
                                    <tr>
                                        <td>c</td>
                                        <td>c</td>
                                        <td>c</td>                                                
                                    </tr>
                                   
                                                           
                        </tbody>
              </table>
                 
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>
			    <!--    <div class="row">
			          	<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Profil Toko</strong></div>
								<div class="card-body">
									<strong>Nama Toko : </strong><br>
									<input  type="text" value="<?= $toko->nama_toko ?>" readonly class="form-control mt-2 mb-2">
									<strong>Nama Pemilik : </strong><br>
									<input  type="text" value="<?= $toko->nama_pemilik ?>" readonly class="form-control mt-2 mb-2">
									<strong>No Telepon : </strong><br>
									<input  type="text" value="<?= $toko->no_telepon ?>" readonly class="form-control mt-2 mb-2">
									<strong>Alamat : </strong><br>
									<input  type="text" value="<?= $toko->alamat ?>" readonly class="form-control mt-2">
								</div>				
							</div>
			          	</div>
			          	<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>User Sedang Login</strong></div>
								<div class="card-body">
									<strong>Nama : </strong><br>
									<input type="text" value="<?= $this->session->login['nama'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Username : </strong><br>
									<input type="text" value="<?= $this->session->login['username'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Role : </strong><br>
									<input type="text" value="<?= $this->session->login['role'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Jam Login : </strong><br>
									<input type="text" value="<?= $this->session->login['jam_masuk'] ?>" readonly class="form-control mt-2">
								</div>				
							</div>
			          	</div>
			        </div> -->

				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
     <script src="<?= base_url('sb-admin') ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('sb-admin') ?>/js/demo/chart-pie-demo.js"></script>
</body>
</html>