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
                <?php $this->load->view('partials/topbar.php', $this->data) ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"> Welcome To Alba</h1>
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
                       <!-- <div class="col-xl-12 col-md-6 mb-4">
                          <div class="card shadow mb-4">
                           
                               <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Papan Pengumuman <i class="fa fa-bullhorn" style="color:red"></i></h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                   
                                            <a class="dropdown-item" href="setting/tambah_p">Tambah</a>
                                            <a class="dropdown-item" href="setting/lihat_p">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            
           <div class="card-body ex3">
             <table class="table table"  width="100%" cellspacing="0">
                 <thead>
                                <tr>
                                    <th width="200">Dibuat</th> 
                                    <th>Uraian</th>
                                                                            
                                </tr>
                            </thead>
                  <tbody>   
                    <?php foreach ($pngumuman as $row): ?>                                
                                    <tr>
                                        <td><?= $row->created_p  ?> <i><font size="1"><?= $row->createdtime_p; ?></font></i></td>
                                        <td><?= $row->uraian  ?></td>   
                                                                            
                                    </tr>
                     <?php endforeach ?>                        
                        </tbody>
              </table>
                 

                                </div>
                            </div>
                        </div>-->

                    </div>
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                      <!--Start project
                  <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>
                   end this project-->

                        <!-- Earnings (Monthly) Card Example -->
                   <!-- Star project     <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>  End Project -->
                        <!-- Earnings (Monthly) Card Example -->
                       <!--StartProject <div class="col-xl-3 col-md-6 mb-4">
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
                        </div> EndProject-->
                      <!--StartProject  <div class="col-xl-3 col-md-6 mb-4">
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
                        </div> EndProject-->
                      <!--StartProject  <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>

                       
                        <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>

                      
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
                    </div> EndProject-->

<hr style="height:2px;border-width:0;color:red;background-color:#cacad3"> <!-- start hrms info -->
                  <!--  <div class="row">

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
                       
                        <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>

                        
                        <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>
                      
                        <div class="col-xl-3 col-md-6 mb-4">
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
                                <a target="_blank" href="absensi">   <i class="fas fa fa-calendar-check-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a target="_blank" href="mod_kerja/lihat_semua">TASK </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_modulkerja ?> </div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="mod_kerja/lihat_semua">   <i class="fas fa fa-clipboard fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a target="_blank" href="mod_kerja/proses">TASK PROSES</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_modulkerjaproses ?> </div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="mod_kerja/proses">   <i class="fas fa fa-clipboard fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a target="_blank" href="mod_kerja/modul_finish"> TASK SELESAI </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_modulkerja_finish ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="mod_kerja/modul_finish">   <i class="fas fa fa-check-square-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> <a target="_blank" href="reimburs"> REIMBURS PENDING</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $reimbursment_count ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="reimburs">   <i class="fa fa-envelope-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="reimburs"> REIMBURS PROSES</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $reimbursment_count2 ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="reimburs">   <i class="fa fa-envelope-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a target="_blank" href="reimburs/finish"> REIMBURS PROSES TRANSFER</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $reimbursment_count3 ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="reimburs/finish">   <i class="fa fa-credit-card fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="reimburs/rfinish"> REIMBURS SELESAI </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $reimbursment_count4 ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="reimburs/rfinish">   <i class="fa fa-file-text-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="payment"> PAYMENT APPROVAL </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $payment_count2 ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="payment">   <i class="fa fa-spinner fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="payment"> PAYMENT PENDING </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $payment_count3 ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="payment">   <i class="fa fa-circle-o-notch fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="payment/finish"> PAYMENT APPROVED </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $payment_count4 ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="payment/finish">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="pembelian/list_permintaan"> PERMINTAAN BARANG </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $permintaan_barang ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="pembelian/list_permintaan">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="pembelian/list_pesanan_pembelian"> PESANAN PEMBELIAN </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_pembelian ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="pembelian/list_pesanan_pembelian">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="pembelian/list_pengiriman"> DALAM PENGIRIMAN </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dalam_pengiriman ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="pembelian/list_pengiriman">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="pembelian/list_klaim"> KLAIM BARANG TIDAK SESUAI </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $klaim_barang ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="pembelian/list_klaim">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <div class="col-xl-6 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="pembelian/list_history_permintaan"> RIWAYAT PERMINTAAN BARANG </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $purchasing_data_finish ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="pembelian/list_history_permintaan">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a target="_blank" href="pembelian/list_selesai"> RIWAYAT PESANAN PEMBELIAN </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $purchasing_data_finishpo ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="pembelian/list_selesai">   <i class="fa fa-check-square-o fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div> <!-- end hrms info --> 
                   <div class="row">

                        <!-- Area Chart -->
                      <!-- Start karyawan habis masa kerja  <div class="col-xl-8 col-lg-5">
                            <div class="card shadow mb-4">
                                
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Karyawan Habis Masa Kerja
                                    </h6>
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
                                
                                                 <div class="card-body ex3">
               <ul class="leave_apps ">           
                                    <li>
                                        <a  >
                                            <h5>
 
                                        <?php foreach ($masa_kerja as $masa_kerja): ?>
                                         <a  target="blank" href="<?php echo base_url() ?>karyawan/ubah/<?php echo $masa_kerja->id ?>">
                                         <small ><?= $masa_kerja->nama_karyawan ?></small> - <font size="2"> <?= $masa_kerja->divisi.' '.$masa_kerja->department; ?></font>
                                      <font size="3">
                                      <small style="color:red"  class="apps_category"><?php  $awal  = new DateTime($masa_kerja->akhir_kerja);
                                        $akhir = new DateTime(date('Y-m-d')); // waktu sekarang
                                        $diff  = date_diff( $awal, $akhir );
                                        $hasil1 =  'LEBIH'.' '. $diff->days.'  '. 'HARI ';
                                        $hasil2 =   $diff->days.'  '. 'HARI ';
                                        ?>
                                        <?php if($awal < $akhir):?>
                                          <?=  $hasil1; ?>
                                        <?php else :?>
                                          <?=  $hasil2; ?>
                                        <?php endif ;?>


                                         </small> </font>
                                     <i><font size="2">HABIS <?= $masa_kerja->perjanjian_kerja; ?></font></i>  <i><font size="1"><?= $masa_kerja->akhir_kerja; ?></font></i>  

                                          <hr style="height:1px;border-width:auto;color:red;background-color:#cacad3">
                                         

                                            <?php endforeach ?>
                                            </h5>

                                     
                                        </a></a>
                                    </li>
                          
                        </ul>

                                </div>
                            </div>
                        </div> End karyawan habis masa kerja -->

                        <!-- Pie Chart -->
                      <!--StartProject  <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                               
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
                                
                                <div class="card-body ex3" id="show_data">
               <ul class="leave_apps">           
                                    <li>
                                        <a>
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
                        </div>-->
                    </div>
                    <div class="row">

                        <!-- Content Column -->
                      <!--StartProject  <div class="col-lg-8 mb-4">

                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Asset Wajib Pajak</h6>
                                </div>
                                <div class="card-body ex3">
         
              <table class="table table"  width="100%" cellspacing="0">
                 <thead>
                                <tr>
                                    <th >Asset</th>
                                    <th >Pajak</th>  
                                    <th>Masa Berlaku</th>
                                     <th>Aksi</th>                                            
                                </tr>
                            </thead>
                  <tbody>              <?php foreach ($wajib_pajak as $wp): ?>                     
                                    <tr>
                                        <td><?= $wp->nama_asset  ?></td>
                                        <td><?= $wp->tgl_pajak  ?></td>
                                        <td><?php  $awal  = new DateTime($wp->tgl_pajak);
                                    $akhir = new DateTime(date('Y-m-d')); // waktu sekarang
                                    $diff  = date_diff( $awal, $akhir );
                                    echo   $diff->days.'  '. 'HARI '; ?></td>   
                                   <td align="center"><a target="blank" href="<?= base_url('asset/detail/' . $wp->id_asset) ?>" class="btn btn-primary btn-sm">Lihat</a></td>                                             
                                    </tr>
                                    <?php endforeach ?>
                                                           
                        </tbody>
              </table>
                 
                                </div>
                            </div>

                          


                        </div> EndProject-->

                      <!-- Illustrations  <div class="col-lg-4 mb-4">

                            
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
                            </div> --> 

                            <!-- Approach
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
                    </div> -->
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

<script type="text/javascript">
    setInterval(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
        
      //  $('#mydata').dataTable();
         
        //fungsi tampil barang
        function tampil_data_barang(){
             //   var url = window.location.href;
              //  var id = url.substring(url.lastIndexOf('/') + 1);
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>dashboard/data_log',
                async : false,
                dataType : 'json',  
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html +='<ul class="leave_apps">'+'<li>'+'<a>'+'<h5>'+
                                '<small >'+ data[i].ket+'</small>'+
                                '<i><font size="1">'+'&nbsp;'+data[i].user+'&nbsp;'+data[i].waktu+'</font></i>'+
                                ' <hr style="height:1px;border-width:auto;color:red;background-color:#cacad3">'+'</h5>'+'</a>'+'</li>'+'</ul>';

              
                                   
                    }
                    $('#show_data').html(html);
                }

            });
        }

    }, 2000);


</script>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
     <script src="<?= base_url('sb-admin') ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('sb-admin') ?>/js/demo/chart-pie-demo.js"></script>
</body>
</html>