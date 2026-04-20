 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>"	>
			<!--	<div class="sidebar-brand-icon rotate-n-11">
					<img style="width: 60px;height: 60px" src="<?php echo base_url(); ?>img/logo01.png"  alt="" class="img-circle"/>
				</div>-->
				<div class="sidebar-brand-text mx-3">CRM</div>
			</a>
                 <br>
			<hr class="sidebar-divider my-0">

			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>
            <!--
            <li class="nav-item <?= $aktif == 'calendar' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('calendar') ?>">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Kalender</span></a>
            </li> -->

		<!--	<hr class="sidebar-divider">
			<div class="sidebar-heading">
				Master Data
			</div> -->
			<!-- Master Data -->
        <!--   	<li class="nav-item <?= $aktif == 'customer' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Customer</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Customer :</h6>
                    <a class="collapse-item" href="<?= base_url('customer/tambah') ?>">Tambah</a>
                    <a class="collapse-item" href="<?= base_url('customer') ?>">Lihat</a>
                     <a class="collapse-item" href="<?= base_url('customer/nonaktif') ?>">Non-Aktif</a>
                </div>
                </div>
            </li>-->

        <!--    <li class="nav-item <?= $aktif == 'customer' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Customer :</h6>
                    <a class="collapse-item" href="<?= base_url('customer/tambah') ?>">Tambah</a>
                    <a class="collapse-item" href="<?= base_url('customer') ?>">Lihat</a>
                     <a class="collapse-item" href="<?= base_url('customer/nonaktif') ?>">Non-Aktif</a>
                </div>
                </div>
            </li> -->

         <!--   <li class="nav-item <?= $aktif == 'sales' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Sales</span>
                </a>
                <div id="sales" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Sales :</h6>
                    <a class="collapse-item" href="<?= base_url('sales/tambah') ?>">Tambah</a>
                    <a class="collapse-item" href="<?= base_url('sales') ?>">Lihat</a>
                    <a class="collapse-item" href="<?= base_url('sales/nonaktif') ?>">Non-Aktif</a>
                </div>
                </div>
            </li>-->


            
             <!--   <li class="nav-item <?= $aktif == 'kendaraan' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kendaraan"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Kendaraan</span>
                </a>
                <div id="kendaraan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data kendaraan :</h6>
                    <a class="collapse-item" href="<?= base_url('kendaraan/tambah') ?>">Tambah</a>
                    <a class="collapse-item" href="<?= base_url('kendaraan') ?>">Lihat</a>
                     <a class="collapse-item" href="<?= base_url('kendaraan/nonaktif') ?>">Non-Aktif</a>
                </div>
                </div>
            </li>-->

        <!--    <li class="nav-item <?= $aktif == 'msa' ? 'active' : '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" id="droptog_approved1" data-target="#msa"
        aria-expanded="false" aria-controls="msa">
        <i class="fas fa-fw fa fa-list-alt"></i>
        <span>MSP (Actual)</span>
    </a>
    <div id="msa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('wo/master_schedule_produksi_actual_line1') ?>">MSP(Actual) Line 1</a>                
            <a class="collapse-item" href="<?= base_url('wo/master_schedule_produksi_actual_line2') ?>">MSP(Actual) Line 2</a>
            <a class="collapse-item" href="<?= base_url('wo/master_schedule_produksi_actual_line3') ?>">MSP(Actual) Line 3 </a>

           <a class="collapse-item laporan-msp-act" href="<?= base_url('wo/laporan_msp_act') ?>">Laporan MSP (Act) </a>
           <a class="collapse-item laporan-msp-act" href="<?= base_url('wo/laporan_msp_act_01') ?>">Laporan MSP (Act) 01</a>


    </div>
</li> -->
     <!--   <li class="nav-item <?= $aktif == 'msp' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" id="droptog_approved1" data-target="#msp"
                    aria-expanded="false" aria-controls="msp">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>MSP</span>
    
                </a>
                <div id="msp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="<?= base_url('wo/master_schedule_produksi_line1') ?>">MSP Line 1</a>                
                    <a class="collapse-item" href="<?= base_url('wo/master_schedule_produksi_line2') ?>">MSP Line 2</a>
                   <a class="collapse-item" href="<?= base_url('wo/master_schedule_produksi_line3') ?>">MSP Line 3 </a>
                   <a class="collapse-item laporan-msp-act" href="<?= base_url('wo/laporan_msp') ?>">Laporan MSP </a>
                   <a class="collapse-item laporan-msp-act" href="<?= base_url('wo/laporan_msp_01') ?>">Laporan MSP 01 </a>
                    </div>
                </div>
            </li>-->

          <!--  <li class="nav-item <?= $aktif == 'master_wo' ? 'active' : '' ?>"> 
                <a class="nav-link" href="<?= base_url('wo/master_wo') ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Master Work Order</span></a>
            </li> -->

         <!--   <li class="nav-item <?= $aktif == 'pembelian' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" id="droptog_approved1" data-target="#pembelian"
                    aria-expanded="false" aria-controls="pembelian">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>Proses Order</span>
                </a>

                <div id="pembelian" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                   
                <a class="collapse-item" href="<?= base_url('wo/tambah') ?>">Tambah Sales Order</a>
                        

                <a class="collapse-item" href="<?= base_url('wo/list_permintaan') ?>">List Sales Order </a>
                    
            

                    <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       Produksi Line 1 
                        </a>
                    <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('wo/produksi_line1') ?>">Work Order</a>
                          <a class="dropdown-item" href="<?= base_url('wo/cutting_line1') ?>">Cutting</a>
                          <a class="dropdown-item" href="<?= base_url('wo/punching_line1') ?>">Punching</a>
                          <a class="dropdown-item" href="<?= base_url('wo/bending_line1') ?>">Bending</a>
                          <a class="dropdown-item" href="<?= base_url('wo/welding_line1') ?>">Welding</a>
                          <a class="dropdown-item" href="<?= base_url('wo/ps_line1') ?>">PS</a>
                          <a class="dropdown-item" href="<?= base_url('wo/fa_line1') ?>">FA</a>
                          <a class="dropdown-item" href="<?= base_url('wo/packing_line1') ?>">Packing</a>
                         
                    </div>
                  </div> 
                   <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       Produksi Line 2
                      </a>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('wo/produksi_line2') ?>">Work Order</a>
                          <a class="dropdown-item" href="<?= base_url('wo/cutting_line2') ?>">Cutting</a>
                          <a class="dropdown-item" href="<?= base_url('wo/punching_line2') ?>">Punching</a>
                          <a class="dropdown-item" href="<?= base_url('wo/bending_line2') ?>">Bending</a>
                          <a class="dropdown-item" href="<?= base_url('wo/welding_line2') ?>">Welding</a>
                          <a class="dropdown-item" href="<?= base_url('wo/ps_line2') ?>">PS</a>
                          <a class="dropdown-item" href="<?= base_url('wo/fa_line2') ?>">FA</a>
                          <a class="dropdown-item" href="<?= base_url('wo/packing_line2') ?>">Packing</a>

                      </div>
                  </div> 
                   <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       Produksi Line 3
                      </a>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('wo/produksi_line3') ?>">Work Order</a>
                          <a class="dropdown-item" href="<?= base_url('wo/cutting_line3') ?>">Cutting</a>
                          <a class="dropdown-item" href="<?= base_url('wo/punching_line3') ?>">Punching</a>
                          <a class="dropdown-item" href="<?= base_url('wo/bending_line3') ?>">Bending</a>
                          <a class="dropdown-item" href="<?= base_url('wo/welding_line3') ?>">Welding</a>
                          <a class="dropdown-item" href="<?= base_url('wo/ps_line3') ?>">PS</a>
                          <a class="dropdown-item" href="<?= base_url('wo/fa_line3') ?>">FA</a>
                          <a class="dropdown-item" href="<?= base_url('wo/packing_line3') ?>">Packing</a>
                      </div>
                  </div> 

                 
                    
                    <a class="dropdown-item" href="<?= base_url('wo/packing') ?>">Packing</a>


                    <a class="collapse-item" href="<?= base_url('wo/Forecast') ?>">Forecast</a>
                    <a class="dropdown-item" href="<?= base_url('wo/subcon') ?>">Subcon</a>
                    <a class="collapse-item" href="<?= base_url('wo/wh_fg') ?>">WH FG </a>
                    <a class="collapse-item" href="<?= base_url('wo/booking') ?>">Booking </a>
                    <a class="collapse-item" href="<?= base_url('wo/pengiriman') ?>">Siap Dikirim </a>
                    <a class="collapse-item" href="<?= base_url('wo/selesai') ?>">Selesai </a>
                    <a class="collapse-item" href="<?= base_url('wo/pesanan_dibatalkan') ?>">Dibatalkan </a> 
                 
                    <a class="collapse-item" href="<?= base_url('wo/list_selesai') ?>">Riwayat Pesanan Pembelian </a> 
                    <a class="collapse-item" href="<?= base_url('wo/list_history_permintaan') ?>">Riwayat Permintaan Barang</a>
                    <a class="collapse-item" href="<?= base_url('wo/list_pesanan_pembelian_reject') ?>">Reject</a> 
                    <a class="collapse-item" href="<?= base_url('wo/laporan_01') ?>">Laporan</a>
                  
                    </div>
                </div>
            </li> -->

<!--
			<li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('barang') ?>">
					<i class="fas fa-fw fa-box"></i>
					<span>Master Data Leads</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'customer' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('customer') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Customer</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'supplier' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('supplier') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Master Supplier</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'petugas' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('petugas') ?>">
					<i class="fas fa-fw fa-users"></i>
					<span>Master Petugas</span></a>
			</li>	
                 -->
			<!-- Divider -->

<!--  MENU MODUL MOM
				<li class="nav-item <?= $aktif == 'mom' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mom"
                    aria-expanded="false" aria-controls="mom">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Minutes Of Meeting</span>
                </a>
                <div id="mom" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data M O M:</h6>
                        <a class="collapse-item" href="<?= base_url('mom/lihat_semua') ?>">M O M</a>
                        <a class="collapse-item" href="<?= base_url('mom/lihat_semua_goal') ?>">M O M GOAL</a>
                        <a class="collapse-item" href="<?= base_url('mom/lihat_nogoal') ?>">M O M TIDAK</a>
                    </div>
                </div>
            </li>
END MENU MODUL MOM -->
    <!--  MENU MODUL laporan
				<li class="nav-item <?= $aktif == 'laporan_proyek' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan_proyek"
                    aria-expanded="false" aria-controls="laporan_proyek">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Laporan</span>
                </a>
                <div id="laporan_proyek" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    
                        <a class="collapse-item"  href="<?= base_url('mom/laporan_proyek') ?>"> Proyek</a> 
                      <div class="dropdown dropright">
    <a  class="collapse-item" data-toggle="dropdown" href="#">
      Progres Harian
    </a>
    <div class="dropdown-menu">
    	<a class="dropdown-item" href="<?= base_url('mod_kerja/tambah_') ?>">Tambah</a>
      <a class="dropdown-item" href="<?= base_url('mod_kerja/progress_view') ?>">Proses</a>
      <a class="dropdown-item" href="<?= base_url('mod_kerja/progress_finish') ?>">Selesai</a>
    </div>
  </div> 
                    </div>
                </div>
            </li>
END MENU MODUL laporan -->
	<!--  MENU MODUL KERJA
 				<li class="nav-item <?= $aktif == 'mod_kerja' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mod_kerja"
                    aria-expanded="false" aria-controls="mod_kerja">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>Task</span>
                </a>
                <div id="mod_kerja" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       <a class="collapse-item" href="<?= base_url('mod_kerja/tambah') ?>">Tambah</a>
                        <a class="collapse-item" href="<?= base_url('mod_kerja/lihat_semua') ?>">Menunggu</a>
                        <a class="collapse-item" href="<?= base_url('mod_kerja/proses') ?>">Proses</a>
                        <a class="collapse-item" href="<?= base_url('mod_kerja/mykontribusi') ?>">Kontribusi</a>
                        <a class="collapse-item" href="<?= base_url('mod_kerja/modul_finish') ?>">Selesai</a>
                    </div>
                </div>
            </li> END MENU MODUL KERJA -->
<!-- MENU Payment ADMIN 

                <li class="nav-item <?= $aktif == 'list_payment' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#list_pay"
                    aria-expanded="false" aria-controls="list_pay">
                    <i class="fas fa-fw fas fa-book-open"></i>
                    <span>List Pembayaran  </span> <span class="badge badge-danger badge-counter" id="count_pay">
                  </span>
                </a>
                <div id="list_pay" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('payment/add_pay') ?>">Tambah</a>
                        <a class="collapse-item" href="<?= base_url('payment') ?>"> Lihat</span></a>
                        <a class="collapse-item" href="<?= base_url('payment/pending_') ?>">Menunggu</a>
                        <a class="collapse-item" href="<?= base_url('payment/finish') ?>">Disetujui</a>
                        <a class="collapse-item" href="<?= base_url('payment/finishh') ?>">Selesai</a>
                        <a class="collapse-item" href="<?= base_url('payment/d_vend') ?>">Data Vendor</a>
                    </div>
                </div>
            </li>
             <script>
 
$(document).ready(function(){
 
 //updating the view with notifications using ajax

function load_unseen_notification(view = '')
 
{

 $.ajax({
 
   url:"<?php echo base_url();?>user/dashboard/user_notifi_payment",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
   $('#count_pay').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pay').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pay').hide();
   }
  }
 });
}
setInterval(function(){
 
 load_unseen_notification();;
 
}, 2000);
 
});
 
</script> END Payment REMBES -->
<!-- MENU Payment Petty Cash
             <li class="nav-item <?= $aktif == 'petty_cash' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#petty_cash"
                    aria-expanded="false" aria-controls="petty_cash">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>Petty Cash</span>
                </a>
                <div id="petty_cash" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                    <a class="collapse-item" href="<?= base_url('petty_cash') ?>">Lihat</a>
                    <a class="collapse-item" href="<?= base_url('petty_cash/riwayat') ?>">Riwayat</a>

                    </div>
                </div>
            </li> END Petty Cash -->

        

<!--  Barang -->

       <!--  <li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" id="droptog_approved1" data-target="#barang"
                    aria-expanded="false" aria-controls="barang">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>Barang Stok</span>
    
                </a>
                <div id="barang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="<?= base_url('barang') ?>">Stock Finish Good</a>                     
                    <a class="collapse-item" href="<?= base_url('penerimaan') ?>">Transaksi Penerimaan</a>
            
                    <a class="collapse-item" href="<?= base_url('barang/list_pengeluaran') ?>">Transaksi Pengeluaran </a>
                    <a class="collapse-item" href="<?= base_url('barang/item_selesai_forecast') ?>">Riwayat Forecast -> Stok </a>
                    </div>
                </div>
            </li>-->
<!--  Jadwal Pengiriman 

         <li class="nav-item <?= $aktif == 'schedul_kirim' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" id="droptog_approved1" data-target="#schedul_kirim"
                    aria-expanded="false" aria-controls="schedul_kirim">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>Jadwal Pengiriman</span>
                </a>
                <div id="schedul_kirim" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="<?= base_url('jadwal_pengiriman/tambah') ?>">Tambah Jadwal</a>                     
                    <a class="collapse-item" href="<?= base_url('jadwal_pengiriman') ?>">Menunggu</a>
                    <a class="collapse-item" href="<?= base_url('jadwal_pengiriman/disetujui') ?>">Disetujui</a>
                    <a class="collapse-item" href="<?= base_url('jadwal_pengiriman/ditolak') ?>">Ditolak</a>
                    </div>
                </div>
            </li>
    and  Jadwal Pengiriman -->
 <!-- MENU KARYAWAN -->

<!-- MENU KARYAWAN -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
			<strong>DATA</strong>	
			</div>


				<li class="nav-item <?= $aktif == 'Employee' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Employee"
                    aria-expanded="false" aria-controls="Employee">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data User</span>
                </a>
                <div id="Employee" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                        <a class="collapse-item" href="<?= base_url('karyawan/lihat_semua') ?>">Aktif</a>
                        <a class="collapse-item" href="<?= base_url('karyawan/lihat_user') ?>">User Login</a>
                        <a class="collapse-item " href="<?= base_url('dept/lihat_semua') ?>"> <i class="fas fa-fw fa-bars"></i>Department</a>
                    </div>
                </div>
            </li><!-- END MENU KARYAWAN -->

<!-- MENU IZIN
			<li class="nav-item <?= $aktif == 'izin' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#izin"
                    aria-expanded="false" aria-controls="izin">
                    <i class="fas fa-fw fas fa-book-open"></i>
                    <span>Izin</span>
                </a>
                <div id="izin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                        <a class="collapse-item" href="<?= base_url('izin') ?>"> Atasan</a>
                        <a class="collapse-item" href="<?= base_url('izin/hrd') ?>">Hrd</a>
                        <a class="collapse-item" href="<?= base_url('izin/disetujui') ?>">Disetujui</a>
                        <a class="collapse-item" href="<?= base_url('izin/ditolak') ?>">Ditolak</a>
                    </div>
                </div>
            </li>END MENU IZIN -->
<!-- MENU REMBES 
			<li class="nav-item <?= $aktif == 'rembes' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rembes"
                    aria-expanded="false" aria-controls="rembes">
                    <i class="fas fa-fw fas fa-book-open"></i>
                    <span>Reimbursement</span>
                </a>
                <div id="rembes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="<?= base_url('reimburs/tambah_r') ?>"> Tambah</a>
                        <a class="collapse-item" href="<?= base_url('reimburs') ?>"> Proses</a>
                        <a class="collapse-item" href="<?= base_url('reimburs/finish') ?>">Transfer</a>
                         <a class="collapse-item" href="<?= base_url('reimburs/rfinish') ?>">Selesai</a>
                          <a class="collapse-item" href="<?= base_url('reimburs/laporan_01') ?>">Laporan</a>
                    </div>
                </div>
            </li> END MENU REMBES -->
<!-- MENU ABSENSI 
			<li class="nav-item <?= $aktif == 'absensi' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#absensi"
                    aria-expanded="false" aria-controls="absensi">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Absensi</span>
                </a>
                <div id="absensi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                    <a class="collapse-item" href="<?= base_url('absensi') ?>">Harian</a>
                    <a class="collapse-item" href="<?= base_url('absensi/lihat_divisi') ?>">Divisi</a>
                    <a class="collapse-item" href="<?= base_url('absensi/laporan1') ?>">Filter Absensi Karyawan</a>
                    <a class="collapse-item" href="<?= base_url('absensi/laporan3') ?>">Absensi Periode</a>
                    <a class="collapse-item" href="<?= base_url('absensi/laporan2') ?>">Hitung Absensi Periode</a>
                    </div>
                </div>
            </li> END MENU ABSENSI -->
<!-- MENU asset 
				<li class="nav-item <?= $aktif == 'asset' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#asset"
                    aria-expanded="false" aria-controls="asset">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Asset</span>
                </a>
                <div id="asset" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                        <a class="collapse-item " href="<?= base_url('asset/lihat_semua') ?>">Tersedia</a>
                         <a class="collapse-item " href="<?= base_url('asset/terpakai') ?>">Terpakai</a>
                         <a class="collapse-item " href="<?= base_url('asset/lihat_semua_rusak') ?>">Rusak/Perbaikan</a>
                    </div>
                </div>
            </li>END MENU asset -->
				
<!-- MENU PENGUMUMAN 
            <li class="nav-item <?= $aktif == 'pengumuman' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengumuman"
                    aria-expanded="false" aria-controls="pengumuman">
                    <i class="fa fa-bullhorn"></i>
                    <span>Pengumuman</span>
                </a>
                <div id="pengumuman" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item " href="<?= base_url('setting/tambah_p') ?>"> <i class="fas fa-fw fa-edit"></i>Tambah</a>
                <a class="collapse-item" href="<?= base_url('setting/lihat_p') ?>"> <i class="fas fa-bullhorn"></i> Pengumuman Aktif</a>
                <a class="collapse-item " href="<?= base_url('setting/lihat_n') ?>"> <i class="far fa-bell-slash"></i>Pengumuman Non - Aktif</a> 

                    </div>
                </div>
            </li> END MENU PENGUMUMAN -->
<!-- MENU SETTING 
			<li class="nav-item <?= $aktif == 'setting' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#seting"
                    aria-expanded="false" aria-controls="seting">
                    <i class="fas fa-fw fas fa-book-open"></i>
                    <span>Setting</span>
                </a>
                <div id="seting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item " href="<?= base_url('dept/lihat_semua') ?>"> <i class="fas fa-fw fa-bars"></i>Department</a>
                <a class="collapse-item" href="<?= base_url('setting') ?>"> <i class="fas fa-fw fa-edit"></i> Jatah Cuti</a>
  				<a class="collapse-item " href="<?= base_url('izin/lihat_semua') ?>"> <i class="fas fa-fw fa-bars"></i>kategori Izin</a>
                <a class="collapse-item " href="<?= base_url('setting/sop') ?>"> <i class="fas fa-poll-h"></i>&nbsp;Sop Modul</a>
                <a class="collapse-item " href="<?= base_url('setting/show_api_key') ?>"> <i class="far fa-bell-slash"></i>Api Key Accurate Online</a> 
                <?php if($this->session->login['nama'] == 'Superadmin'):?>
                <a class="collapse-item " href="<?= base_url('absensi/insert_holiday') ?>"> <i class="far fa-bell-slash"></i>Hari Libur</a> 
                <?php endif;?>	
                    </div>
                </div>
            </li> END MENU SETTING -->
        	<li class="nav-item <?= $aktif == 'backup' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('backup/database_backup') ?>">
					<i class="fas fa-fw fa-database"></i>
					<span>Backup Database</span></a>
			</li>
            <li class="nav-item ">
				<a class="nav-link" href="<?= base_url('logout') ?>">
					<i class="fas fa-fw fa fa-sign-out" style="color:red"></i>
					<span>LOG OUT</span></a>
			</li>

          <!--  <hr class="sidebar-divider">
             <?php if ($this->session->login['role'] == 'admin'): ?>
                 <div class="sidebar-heading">
                      Pengaturan
                 </div>
                 <li class="nav-item <?= $aktif == 'pengguna' ? 'active' : '' ?>">
                     <a class="nav-link" href="<?= base_url('pengguna') ?>">
                         <i class="fas fa-fw fa-users"></i>
                         <span>Manajemen Pengguna</span>
                     </a>
                 </li>
             <?php endif; ?> -->

<!--
			<li class="nav-item <?= $aktif == 'penerimaan' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('penerimaan') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Penerimaan</span></a>
			</li>

			<li class="nav-item <?= $aktif == 'pengeluaran' ? 'active' : '' ?>">
				<a class="nav-link" href="<?= base_url('pengeluaran') ?>">
					<i class="fas fa-fw fa-file-invoice"></i>
					<span>Transaksi Pengeluaran</span></a>
			</li>

			<hr class="sidebar-divider">
			<?php if ($this->session->login['role'] == 'admin'): ?>
				
				<div class="sidebar-heading">
					Pengaturan
				</div>

				

				<li class="nav-item <?= $aktif == 'toko' ? 'active' : '' ?>">
					<a class="nav-link" href="<?= base_url('toko') ?>">
						<i class="fas fa-fw fa-building"></i>
						<span>Profil Perusahaan</span></a>
				</li>
				<!-- Divider -->
			<?php endif; ?>
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>
<script>
 
$(document).ready(function(){
 
 //updating the view with notifications using ajax

function load_unseen_notification(view = '')
{
 $.ajax({
   url:"<?php echo base_url();?>user/dashboard/notif_pr_direksi",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);
   $('#count_pr_direksi').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_direksi').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_direksi').hide();

   }
  }
 });
}
setInterval(function(){
 
 load_unseen_notification();;
 
},2000);
 
});
 
</script>

<script>
 
$(document).ready(function(){
 
 //updating the view with notifications using ajax

function load_unseen_notification(view = '')
{
 $.ajax({
   url:"<?php echo base_url();?>user/dashboard/notif_pr_direksi",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);
   $('#count_pr_direksi2').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_direksi2').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_direksi2').hide();

   }
  }
 });
}
setInterval(function(){
 
 load_unseen_notification();;
 
},2000);
 
});
 
</script>