<!DOCTYPE html>
<html>
<head>
   <?php $this->load->view('user/partials/head.php') ?>
<style type="text/css">
    .fc-sun { background-color:red; }
</style>

</head>
    <body id="page-top">

     <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('asst') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right"> 
              
                  
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
             <!--   <div class="card shadow">
                    <div class="card-header"><strong>DATA asset CASSA DESIGN</strong></div>

                    <div class="card-body">
                        <div class="table-responsive">
                         
                        </div>
                    </div>              
                </div> -->
                     <div class="row">
                        <div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow ">
                                <div class="card-header py-4">
                                        <div class="container">
                                            <div id="calendar"></div>
                                        </div>
                                </div>
                    
                            </div>
                        </div>
                    </div>
<!-- modal update -->

            <hr>
 
                </div>
            </div>
            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>    
    <?php  $divisi1 = $emp->department;?> 
 

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
            events:"<?php echo base_url(); ?>user/calendar/myload",
            selectable:true,
            selectHelper:true,

            select:function(start, end, allDay)
            {
                var title = prompt("Enter Event Title");
                 var divisi = "<?php echo $divisi1 ?>";
               // 
                if(title)
                {
                    
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD ");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD "); 
                    $.ajax({
                        url:"<?php echo base_url(); ?>user/calendar/myinsert",
                        type:"POST",
                        data:{title:title, start:start, end:end,divisi:divisi },
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Added Successfully");
                        }
                    })
                }
            },
            editable:true,
            eventResize:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                var title = event.title;

                var id = event.id;

                $.ajax({
                    url:"<?php echo base_url(); ?>user/calendar/myupdate",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Update");
                    }
                })
            },
            eventDrop:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end);
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"<?php echo base_url(); ?>user/calendar/myupdate",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated");
                    }
                })
            },
            eventClick: function(event) {

        //  $('#modalTitle').html(event.id);
            $('#modalBody').html(event.title);
             $('#ModalId').html(event.id);
            $('#fullCalModal').modal();

                $('.remove').click(function (events) {
                   var id = $('#ModalId').val();
                   if(confirm("Are you sure you want to remove it?"))
                                {
                                 //   var id = event.id;
                                    $.ajax({
                                        url:"<?php echo base_url(); ?>user/calendar/mydelete",
                                        type:"POST",
                                        data:{id:id},
                                        success:function()
                                        {
                                            calendar.fullCalendar('refetchEvents');
                                            alert('Event Removed');
                                        }
                                    })
                                }
                                $('#fullCalModal').modal('hide');
                                })
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
                <button  class="btn btn-primary remove">Remove</button>
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
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    </body>
</html>