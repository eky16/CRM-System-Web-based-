<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>


    <script type="text/javascript">
// 1 detik = 1000
window.setTimeout("waktu()",1000);  
function waktu() {   
var tanggal = new Date();  
setTimeout("waktu()",1000);
document.getElementById("jam").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();  
document.getElementById("jam_datang").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
document.getElementById("jam_pulang").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
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
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>

<body id="page-top"> 


	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"> <i></i>       
                Welcome To CRM <br>
        <!--Start Project  <a href="<?= base_url('user/absensi') ?>" class="btn btn-info btn-sm"><i class="fa fa-bars"></i>&nbsp;&nbsp;Silahkan Absen </a> End Project-->
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
                      <!-- Start project  <div class="col-xl-12 col-md-6 mb-4">
                          <div class="card shadow mb-4">
                                
                                <div  
                                   class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Papan Pengumuman <i class="fa fa-bullhorn" style="color:red"></i></h6>
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
                                        <td><?= $row->created_p  ?><i><font size="1"> <?= $row->createdtime_p; ?></font></i></td>
                                        <td><?= $row->uraian  ?></td>   
                                                                            
                                    </tr>
                     <?php endforeach ?>                        
                        </tbody>
              </table>
                 

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800">Izin & Tugas Saya <i></i></h1>
                        </div>
                   
                    </div>
                       <hr style="height:2px;border-width:0;color:red;background-color:#cacad3">
                                        <div class="row">

                       -->
              
                    </div>
                 <div class="clearfix">
        <div class="float-left">

            <h1 class="h3 m-0 text-gray-800"><i></i></h1>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="row">
                 <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a target="_blank" href="quotation/quo_status"> Total Quotation</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kpi->total_quo ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="quotation/hitung_partList_required">   <i class="fas   fa fa-tasks fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a target="_blank" href="quotation/quo_status"> Sudah ada gambar  </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kpi->sudah_gambar  ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="quotation/quotation_akan_diproses">   <i class="fas   fa fa-tasks fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a target="_blank" href="quotation/list_quotation_item"> Sudah ada estimasi  </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $kpi->sudah_estimasi ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="quotation/estimasi_selesai">   <i class="fas   fa fa-tasks fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a target="_blank" href="quotation/quo_status"> Sudah lengkap</a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kpi->lengkap ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="quotation/hitung_partList_required">   <i class="fas   fa fa-tasks fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a target="_blank" href="quotation/list_quotation_item"> Tidak Bisa Estimasi </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $tidak_bisa_estimasi ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="quotation/list_quotation_item">   <i class="fas   fa fa-tasks fa-2x text-gray-000"></i></a>
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
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> <a target="_blank" href="quotation/list_quotation_item"> Overdue Estimasi/Gambar </a></div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $overdue ?></div>
                                </div>
                                <div class="col-auto">
                                <a target="_blank" href="quotation/estimasi_dalam_proses">   <i class="fas   fa fa-tasks fa-2x text-gray-000"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>



            <div class="col-lg-12">

                <canvas id="pesananChart" width="800" height="400" style="width: 800px; height: 400px;"></canvas>


            </div>
        </div>
    </div>
</div>



<!-- START PESANAN<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pesananData = <?php echo json_encode($pesanan_per_bulan); ?>; // Ini  menghasilkan objek JavaScript dari PHP

        // Ubah string JSON menjadi objek JavaScript dengan JSON.parse
        const pesananObj = JSON.parse(pesananData);

        // Labels untuk 12 bulan
        const labels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Array untuk menyimpan setiap jenis barang
        const jenisBarang = [];

        // Ambil setiap jenis barang yang ada pada data
        Object.values(pesananObj).forEach(bulanData => {
            Object.keys(bulanData).forEach(jenis_barang => {
                if (!jenisBarang.includes(jenis_barang)) {
                    jenisBarang.push(jenis_barang);
                }
            });
        });

        // Definisikan warna untuk setiap jenis barang
        const warnaBarang = {
            'AD': 'rgba(255, 99, 132, 1)',       // Merah Muda
            'DP': 'rgba(54, 162, 235, 1)',       // Biru
            'FC': 'rgba(75, 192, 192, 1)',       // Cyan
            'LC': 'rgba(153, 102, 255, 1)',      // Ungu
            'SC': 'rgba(255, 206, 86, 1)',       // Kuning
            'SD': 'rgba(255, 159, 64, 1)',       // Jingga
            'SDG': 'rgba(255, 159, 64, 0.5)',      // Merah Muda (sama dengan SD)
            'SR': 'rgba(153, 102, 255, 0.5)',       // Biru (sama dengan LC)
            'SP': 'rgba(54, 162, 235, 0.5)',       // Cyan (sama dengan DP)
            'AD-G': 'rgba(255, 99, 132, 0.5)',    // Ungu (sama dengan AD)
            'MF': 'rgba(201, 203, 207, 1)',      // Abu-abu
            'BARANG LAIN-LAIN': 'rgba(0, 0, 0, 0.7)', // HITAM
            // Tambahkan jenis barang dan warna sesuai kebutuhan
        };

        const borderColorBarang = {
            'AD': 'rgba(255, 99, 132, 1)',
            'DP': 'rgba(54, 162, 235, 1)',
            'FC': 'rgba(75, 192, 192, 1)',
            'LC': 'rgba(153, 102, 255, 1)',
            'SC': 'rgba(255, 206, 86, 1)',
            'SD': 'rgba(255, 159, 64, 1)',
            'SDG': 'rgba(255, 159, 64, 0.5)',
            'SR': 'rgba(255, 159, 64, 0.5)',
            'SP': 'rgba(255, 159, 64, 0.5)',
            'AD-G': 'rgba(255, 159, 64, 0.5)',
            'MF': 'rgba(255, 159, 64, 0.5)',
            'BARANG LAIN-LAIN': 'rgba(201, 203, 207, 1)',
            // Tambahkan jenis barang dan warna sesuai kebutuhan
        };

        // Persiapkan array untuk data bulan-bulan yang ada
        const datasets = jenisBarang.map(jenis => {
            return {
                label: jenis,
                data: labels.map((bulan, index) => {
                    const bulanIndex = index + 1; // Bulan dalam data mulai dari 1 sampai 12
                    const bulanData = pesananObj[bulanIndex.toString()] || {};
                    return bulanData[jenis] !== undefined ? parseInt(bulanData[jenis], 10) : 0;
                }),
                backgroundColor: warnaBarang[jenis], // Gunakan warna yang ditentukan
                borderColor: borderColorBarang[jenis],
                borderWidth: 1
                //barThickness: 1 // Atur lebar garis sekat (20 adalah contoh nilai, sesuaikan sesuai preferensi Anda)
            };
        });

        const ctx = document.getElementById('pesananChart').getContext('2d');
        const pesananChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 5, // Mengatur interval tick pada sumbu y
                            callback: function(value) {
                                return value; // Menampilkan nilai pada sumbu y
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Pesanan Berdasarkan Type Barang',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y !== null ? context.parsed.y : '';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>  -->

  <!--START GRAFI PENGIRIMAN  <hr style="height:2px;border-width:0;color:red;background-color:#cacad3">
    <div class="row">
        <div class="col-lg-12">
             <canvas id="pengirimanChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const pengirimanData = <?php echo json_encode($pengiriman_per_bulan); ?>; // Ini  menghasilkan objek JavaScript dari PHP

        // Ubah string JSON menjadi objek JavaScript dengan JSON.parse
        const pengirimanObj = JSON.parse(pengirimanData);

        // Labels untuk 12 bulan
        const labels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Array untuk menyimpan setiap jenis barang
        const jenisPesanan = [];

        // Ambil setiap jenis barang yang ada pada data
        Object.values(pengirimanObj).forEach(bulanData => {
            Object.keys(bulanData).forEach(jenis_pesanan => {
                if (!jenisPesanan.includes(jenis_pesanan)) {
                    jenisPesanan.push(jenis_pesanan);
                }
            });
        });

        // Definisikan warna untuk setiap jenis barang
        const warnaBarang = {
            'KHUSUS': 'rgba(153, 102, 255, 0.8)',       // Merah Muda
            'STANDAR': 'rgba(54, 162, 235, 0.8)',       // Biru
            'PINTU': 'rgba(255, 99, 132, 0.8)',       // merah muda

            // Tambahkan jenis barang dan warna sesuai kebutuhan
        };

        const borderColorBarang = {
            'KHUSUS': 'rgba(153, 102, 255, 0.8)',       // Merah Muda
            'STANDAR': 'rgba(54, 162, 235, 0.8)',       // Biru
            'PINTU': 'rgba(255, 99, 132, 0.8)',       // merah muda
            
            // Tambahkan jenis barang dan warna sesuai kebutuhan
        };

        // Persiapkan array untuk data bulan-bulan yang ada
        const datasets = jenisPesanan.map(jenis01 => {
            return {
                label: jenis01,
                data: labels.map((bulan01, index) => {
                    const bulanIndex = index + 1; // Bulan dalam data mulai dari 1 sampai 12
                    const bulanData = pengirimanObj[bulanIndex.toString()] || {};
                    return bulanData[jenis01] !== undefined ? parseInt(bulanData[jenis01], 10) : 0;
                }),
                backgroundColor: warnaBarang[jenis01], // Gunakan warna yang ditentukan
                borderColor: borderColorBarang[jenis01],
                borderWidth: 1
                //barThickness: 1 // Atur lebar garis sekat (20 adalah contoh nilai, sesuaikan sesuai preferensi Anda)
            };
        });

        const ctx = document.getElementById('pengirimanChart').getContext('2d');
        const pengirimanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 5, // Mengatur interval tick pada sumbu y
                            callback: function(value) {
                                return value; // Menampilkan nilai pada sumbu y
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Pengiriman Berdasarkan Jenis Pesanan',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y !== null ? context.parsed.y : '';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script> -->


 <hr style="height:2px;border-width:0;color:red;background-color:#cacad3">
                        <!-- Earnings (Monthly) Card Example -->
                       <!-- <div class="col-lg-8 mb-4">
 <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Barang Dibawah Stok Minimum</h6>
    </div>
    <div class="card-body ex3">
      <table class="table table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th >Kode</th>
            <th >Barang</th>  
            <th>Min</th>
            <th>Stok</th>                                            
          </tr>
        </thead>
        <tbody> 
          <?php foreach ($all_barang as $barang): ?>                     
            <tr>
              <td><?= $barang->Kode_Barang ?></td>
              <td><?= $barang->Nama_Barang ?></td>
              <td><?= $barang->Nama_Barang ?></td>
              <td><?= $barang->Min?></td>
              <td><?php 
                   if(empty($barang->Stok)){
                       echo 0;
                   }else{
                     //cek jumlah stok jika stok kurang dari min atau stok lebih dari max maka                tampilkan warna merah
                     if ($barang->Stok < $barang->Min OR $barang->Stok > $barang->Max){
                      echo '<span style="color: red;">' . $barang->Stok . ' ' .$barang->Satuan                . '</span>';
                     }else
                      // jika bukan
                     {
                       echo $barang->Stok . ' ' .$barang->Satuan;
                     }
                   }
                    ?></td>
              <td>
                <a href="<?= base_url('user/barang/ubah/' . $barang->No) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/barang/hapus_stok/' . $barang->No) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
 </div>
</div>

				</div>
			</div> -->

			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
     <script src="<?= base_url('sb-admin') ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('sb-admin') ?>/js/demo/chart-pie-demo.js"></script>
</body>
</html>