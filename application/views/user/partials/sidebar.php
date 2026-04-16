 <?php error_reporting(0); ?>
 <style>
  .dropdown-toggle::after {
    content: "";
    display: inline-block;
    width: 0;
    height: 0;
    border-top: 20px solid transparent; /* Adjust this value to change the size of the arrow */
    border-bottom: 20px solid transparent; /* Adjust this value to change the size of the arrow */
    border-left: 20px solid #000; /* Adjust this value to change the color of the arrow */
    margin-left: 20px; /* Adjust this value to change the distance between the text and the arrow */
  }
</style>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user/dashboard') ?>"	>
			<!--	<div class="sidebar-brand-icon rotate-n-11">
					<img style="width: 70px;height: 70px" src="<?php echo base_url(); ?>img/crm_logo.png"  alt="" class="img-circle"/>
				</div>-->
				<div class="sidebar-brand-text mx-3">CRM</div>
			</a><br>
			<hr class="sidebar-divider my-0">

			<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>"> 
				<a class="nav-link" href="<?= base_url('user/dashboard') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>


            <hr class="sidebar-divider">    
            <div class="sidebar-heading">
                Customer Relationship Management
            </div>
           



  <?php if ($this->session->login['department'] == 'Estimator' OR $this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Engineering' OR $this->session->login['department'] == 'Marketing'):?>
<li class="nav-item <?= $aktif == 'quotation' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#quotation"
                    aria-expanded="true" aria-controls="quotation">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Progress</span>
                </a>
                 
                    
                <div id="quotation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Quotation :</h6>
                    <a class="collapse-item" href="<?= base_url('user/quotation/tambah_quo') ?>">Tambah Progress</a>
                    <a class="collapse-item" href="<?= base_url('user/quotation/list_quo_order') ?>">List Progress</a>
                   <!--<a class="collapse-item" href="<?= base_url('user/quotation/reminder_gamPenawaran') ?>">Follow Up Gambar Penawaran </a>-->
                    <a class="collapse-item" href="<?= base_url('user/quotation/quo_item_selesai') ?>">Selesai</a>
                </div>
                </div>
            </li>
            <?php endif; ?>

<?php if ($this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Marketing'):?>

<li class="nav-item <?= $aktif == 'customer' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Customer</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Customer :</h6>
                    <a class="collapse-item" href="<?= base_url('user/customer/tambah') ?>">Tambah</a>
                    <a class="collapse-item" href="<?= base_url('user/customer') ?>">Lihat</a>
                    <a class="collapse-item" href="<?= base_url('user/customer/nonaktif') ?>">Non-Aktif</a>
                </div>
                </div>
            </li>
            <?php endif; ?>


<?php if ($this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Marketing'):?>

 <li class="nav-item <?= $aktif == 'settings' ? 'active' : '' ?>">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" id="droptog_approved1" data-target="#settings"
                    aria-expanded="false" aria-controls="settings">
                    <i class="fas fa-fw fa fa-list-alt"></i>
                    <span>Settings</span>
                </a>

                <div id="settings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                                     <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       STATUS QUOTATION 
                        </a>
                    <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('user/quotation/tambah_status_quo') ?>">Tambah Status Quotation</a>
                          <a class="dropdown-item" href="<?= base_url('user/quotation/list_statusQuo') ?>">Lihat Status Quotation</a>
                         
                    </div>
                    </div>

                                 <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       SOURCE LEAD 
                        </a>
                    <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('user/quotation/tambah_srcLead') ?>">Tambah Source Lead</a>
                          <a class="dropdown-item" href="<?= base_url('user/quotation/list_srcLead') ?>">Lihat Source Lead</a>
                         
                         
                          <!--   <a class="dropdown-item" href="#">Link 3</a> -->
                    </div>
                  </div> 

                                 <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       SEGMENT 
                        </a>
                    <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('user/quotation/tambah_segment') ?>">Tambah Segment</a>
                          <a class="dropdown-item" href="<?= base_url('user/quotation/list_segment') ?>">Lihat Segment</a>
                          
                         
                          <!--   <a class="dropdown-item" href="#">Link 3</a> -->
                    </div>
                  </div> 
                                
                                 <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       SEGMENT BARANG
                        </a>
                    <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('user/quotation/tambah_segmentBarang') ?>">Tambah Segment Barang</a>
                          <a class="dropdown-item" href="<?= base_url('user/quotation/list_segmentBrg') ?>">Lihat Segment</a>
                          
                         
                          <!--   <a class="dropdown-item" href="#">Link 3</a> -->
                    </div>
                  </div> 
   
                                 <div class="dropdown dropright">
                        <a  class="collapse-item dropdown-toggle"  data-toggle="dropdown" href="#">
                       PRODUCT 
                        </a>
                    <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?= base_url('user/barang') ?>">Product</a>
                          <a class="dropdown-item" href="<?= base_url('user/barang/list_product') ?>">Lihat Product</a>
                          
                         
                          <!--   <a class="dropdown-item" href="#">Link 3</a> -->
                    </div>
                  </div> 
            </li>

            <?php endif; ?>

          
           
  <!--   MENU KARYAWAN -->
			<hr class="sidebar-divider">
	
			<div class="sidebar-heading">
			<strong>HRMS</strong>	
			</div>

				<li class="nav-item <?= $aktif == 'Employee' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Employee"
                    aria-expanded="false" aria-controls="Employee">
                    <i class="fas fa-fw fa-users"></i>
                    <span>PROFIL SAYA</span>
                </a>
                <div id="Employee" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                    <?php  $id = $this->session->login['kode']; ?>
                        <a class="collapse-item" href="<?= base_url('user/karyawan/detail/') ?><?= $id ?>">LIHAT</a>
                    </div>
                </div>
            </li>
         


            			<li class="nav-item ">
				<a class="nav-link" href="<?= base_url('logout') ?>">
					<i class="fas fa-fw fa fa-sign-out" style="color:red"></i>
					<span>LOG OUT</span></a>
			</li>

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
   url:"<?php echo base_url();?>user/dashboard/notif_pr_pm",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);

   $('#count_pr_pm').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_pm').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_pm').hide();

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
   url:"<?php echo base_url();?>user/dashboard/notif_pr_pm",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);

   $('#count_pr_pm2').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_pm2').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_pm2').hide();

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
   url:"<?php echo base_url();?>user/dashboard/notif_pr_pm3",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);

   $('#count_pr_pm3').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_pm3').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_pm3').hide();

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
   url:"<?php echo base_url();?>user/dashboard/notif_pr_estimator",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);
   $('#count_pr_estimator').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_estimator').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_estimator').hide();

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
   url:"<?php echo base_url();?>user/dashboard/notif_pr_purchase",
  method:"POST",
  data:{"view":view},
  dataType:"json",
  success:function(data)
  {
  // $('.show_data').html(data.notification);
   $('#count_pr_purchase').show();
   if(data.unseen_notification > 0)
   {
       
    $('#count_pr_purchase').html(data.unseen_notification);
   }  else if(data.unseen_notification == ''){

       $('#count_pr_purchase').hide();

   }
  }
 });
}
setInterval(function(){
 
 load_unseen_notification();;
 
},2000);
 
});
 
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--<script>
    $(document).ready(function() {
        console.log('jQuery is loaded'); // Memastikan jQuery dimuat

        // Ketika tombol "Laporan MSP (Act)" diklik
        $('.laporan-msp-act').on('click', function(event) {
            console.log('Button clicked'); // Memastikan event handler bekerja
            event.preventDefault(); // Mencegah tindakan default dari tautan

            // Tampilkan SweetAlert
            swal({
                title: "Fitur Masih Dalam Pengerjaan",
                text: "Fitur ini masih dalam pengerjaan. Silakan coba lagi nanti.",
                icon: "warning",
                buttons: [
                    'OK'
                ],
                dangerMode: true,
            });
        });

        // Ketika pengguna mengklik di luar modal, sembunyikan modal
        $(window).on('click', function(event) {
            if ($(event.target).is('#myModal')) {
                $('#myModal').css('display', 'none');
            }
        });
    });
</script>-->