<!DOCTYPE html>
<html lang="en">
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, orientation=landscape">
	<?php $this->load->view('user/partials/head.php') ?>
	<style type="text/css">
@media only screen and (max-device-width: 480px) and (orientation: landscape) {
  /* CSS yang akan diterapkan ketika perangkat memiliki lebar maksimum 480px dan berada dalam mode landscape */
  /* Misalnya, mengubah ukuran font atau mengubah tata letak elemen */
  body {
    font-size: 18px;
  }
  
  /* Contoh lain */
  .container {
    display: flex;
    flex-direction: row;
  }
}
	</style>

</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/jadwal_pengiriman') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Gunakan Mode Lanscape untuk melihat Kalender</strong></div>
							<div class="card-body">
								
  										<div class="container">
                                            <div id="calendar"></div>
                                        </div>

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
    <?php  $divisi1 = $emp->department;?> 
 
<script type="text/javascript">
function detectOrientation() {
  if (window.orientation === 0 || window.orientation === 180) {
    // Potret
    alert("Gunakan Mode Landscape untuk mengakses halaman ini !!!");
  } else if (window.orientation === 90 || window.orientation === -90) {
    // Landscape
   // alert("Landscape");
  }
}

// Panggil fungsi detectOrientation saat halaman dimuat
detectOrientation();

// Gunakan event listener untuk mendeteksi perubahan orientasi
window.addEventListener("orientationchange", detectOrientation);

</script>
<script>
   //  var divisi = $divisi1 ;

    $(document).ready(function(){

        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            }, 
            events:"<?php echo base_url(); ?>user/calendar/myload_sch",
            selectable:true,
            selectHelper:true,


            editable:true,

            eventClick: function(event) {

        //  $('#modalTitle').html(event.id);
            $('#modalBody').html(event.title);
             $('#ModalId').html(event.id);
            $('#fullCalModal').modal();

                },


        });
       
    });
             
    </script>
  
    <div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
               <div id="modalBody" class="modal-body"></div> 
            <textarea hidden id="ModalId"/> </textarea>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <?php $this->load->view('user/partials/js.php') ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script
</body>
</html>