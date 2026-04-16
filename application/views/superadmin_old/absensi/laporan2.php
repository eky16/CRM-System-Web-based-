<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>

<style type="text/css">
    
table td {
  position: relative;
}

table td input {
  position: absolute;
  display: block;
  top:0;
  left:0;
  margin: 0;
  height: 100%;
  width: 100%;
  border: none;
  padding: 10px;
  box-sizing: border-box;
}


</style>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
    
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('asst') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?> </h1>
					</div>
					<div class="float-right "> 
						

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
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-header"><strong>Filter Tanggal!</strong></div>
                            <div class="card-body">
                                 <form action="<?= base_url('absensi/laporan2') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" >
                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"  name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"   name="dan_tanggal" value="<?php echo $_POST['dan_tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>

                    <?php if (!empty ($_POST['tanggal'])): ?>                     
                    <a href="<?php echo $url_cetak; ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>    <?php endif ?>
                                    </div>


                                </form>
                            </div>              
                        </div>
                    </div>
                </div>

				<div class="card shadow">
					
					<div class="card-body">
						<div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td width="1px">No</td>
                                        <td width="100px">Id</td>
                                        <td width="170px">Nama</td>
                                        <td align="center" >HK</td>
                                        <td align="center" style="text-align: center; vertical-align: middle;  background-color:#12f0e2;">H</td>
                                        <td align="center">LA</td>
                                        <td align="center">T</td>
                                        <td align="center">C</td>
                                        <td align="center">S</td>
                                        <td align="center">P</td>
                                 <!--   <td align="center">P_</td> -->
                                        
                                        <td align="center" style="text-align: center; vertical-align: middle;  background-color:#7FFFD4;">P.UM</td>
                                        <td align="center">A</td>
                                        <td align="center" style="text-align: center; vertical-align: middle;  background-color:#FFD700;">P.GJ</td>
                                        <td align="center">L</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($absensi as $absensi): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $absensi->EmployeeID ?></td>
                                            <td><?= $absensi->nama_karyawan ?></td>
                                            <td align="center"><?php
                            $date = $_POST['tanggal'];
                            $date1 = $_POST['dan_tanggal'];
                            $begin = new DateTime($date);
                            $end = new DateTime($date1);
                            $daterange     = new DatePeriod($begin, new DateInterval('P1D'), $end);
                            //mendapatkan range antara dua tanggal dan di looping
                            
                            $i=0;
                            $x     =    0;
                            $end     =    1;
                            $o = 1;
                            foreach($daterange as $date){
                            $daterange     = $date->format("Y-m-d");
                            $datetime     = DateTime::createFromFormat('Y-m-d', $daterange);
                            //Convert tanggal untuk mendapatkan nama hari
                            $day         = $datetime->format('D');
                            $dayy         = $datetime->format("Y-m-d");
                            //Check untuk menghitung yang bukan hari sabtu dan minggu
                            if($day!="Sun" && $day!="Sat"  && $dayy!="2020-12-25" && $dayy!="2021-01-01" && $dayy!="2021-02-12" && $dayy!="2021-03-11"  && $dayy!="2021-04-02"
                             && $dayy!="2021-05-13" && $dayy!="2021-05-14" && $dayy!="2021-05-26" 
                                && $dayy!="2021-06-01" && $dayy!="2021-07-20" && $dayy!="2021-08-10" 
                                && $dayy!="2021-08-17" && $dayy!="2021-10-19" ) {
                                //echo $i;
                                $x    +=    ($end-$i);
                            }
                            $end++;
                            $i++;
                            } 
                      
                               $x  +=    ($end-$i) ;
                               echo $x;
                            ?></td>

<td align="center"><?php $hadir = $absensi->hadir+$absensi->tugas_luar_kantor+$absensi->tugas_luar_kota+$absensi->hadir_lembur;
                         echo $hadir > 0 ? $hadir : ''; ?></td>
<td align="center"><?php $lupa_absen = $absensi->lupa_absen_datang + $absensi->lupa_absen_pulang;
                    echo $lupa_absen > 0 ? $lupa_absen : ''; ?></td>
<td align="center"><?php $telat = $absensi->telat;  echo $telat > 0 ? $telat : ''; ?></td>
<td align="center"><?php $cuti = $absensi->cuti; echo $cuti > 0 ? $cuti : ''; ?></td>
<td align="center"><?php $sakit = $absensi->sakit; echo $sakit > 0 ? $sakit : ''; ?></td>
<td align="center"><?php $pla = $absensi->pulang_awal_izin + $absensi->pulang_awal_tanpa_izin; echo $pla > 0 ? $pla : ''; ?></td>
<!--<td align="center"><?php $pla_pot =  $absensi->pulang_awal_potong; echo $pla_pot > 0 ? $pla_pot : ''; ?></td> -->

 <td align="center"><?php $pot_um = $lupa_absen +$telat+$cuti+$sakit+$pla; echo $pot_um > 0 ? $pot_um : ''; ?></td>
<td align="center"><?php $total_hk =  $x - ($hadir + $lupa_absen + $telat + $cuti + $sakit + $pla); 
                            
                            echo $total_hk > 0 ? $total_hk : ''; ?></td>                                         
<td align="center"><?php  echo $total_hk > 0 ? $total_hk : ''; ?></td>
<td align="center"><?php $lembur = $absensi->L1 + $absensi->L2 + $absensi->L3 + $absensi->L4 + $absensi->L5 + $absensi->L6 + $absensi->L7; echo $lembur > 0 ? $lembur : ''; ?></td>                                          
                            
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
						</div>
					</div>				
				</div> 
             
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
</body>
</html>