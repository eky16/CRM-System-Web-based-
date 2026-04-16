<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
        <style>
        .removeRow
{
 background-color: #D1D1D1;
    color:#FFFFFF;
}
    /* The container */
    .container12 {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 6px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container12 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 15px;
      width: 15px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container12:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container12 input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container12 input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container12 .checkmark:after {
      left: 3px;
      top: 1px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(25deg);
      -ms-transform: rotate(25deg);
      transform: rotate(25deg);
    }

    </style>

  
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('pengeluaran') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">

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
                <div class="card shadow">
                    <div class="card-header"><strong>Detail Task</strong>
                          <div class="float-right">
                    
                </div></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="table-responsive">
                                <table class="table table-borderless" border="0">
                                       <?php  foreach ($all_department_info as $akey => $v_department_info) : ?>                                                       
                                <?php foreach ($v_department_info as $key => $v_department) : ?>
                                        <tr>
                                        <td width="150"><strong><font size="2px">Tanggal </font></strong></td>
                                        <td width="1">:</td>
                                
                                    <td><font size="2px"><?php echo $v_department->tgl_created ?></font></td>
                            
                                    </tr>
                                    <tr>
                                        <td width="150"><strong><font size="2px">Moderator </font></strong></td>
                                        <td width="1">:</td>
                                    <td><font size="2px"><?php echo $v_department->pembuat ?></font></td>
                                    </tr>
                                    <tr>
                                        <td width="150"><strong><font size="2px">Judul </font></strong></td>
                                        <td width="1">:</td>
                                    <td><font size="2px"><?php echo $v_department->status_task_sub ?></font></td>
                                    </tr>
                                    <tr>
                                        <td width="150"><strong><font size="2px">Deskripsi </font></strong></td>
                                        <td width="1">:</td>
                                
                                    <td><font size="2px"><?php echo $v_department->deskripsi_detail_sub ?></font></td>
                                    </tr>
                                    <tr>
                                        <td><strong><font size="2px">Proyek</font></strong></td>
                                        <td>:</td>
                                        <td><font size="2px"><?php echo $v_department->nama_proyek ?> <?php $kode_modul = $v_department->kode_modul ?></font></td>
                                    </tr>
                             <?php       $penerima = $v_department->nama_karyawan;
                                        $pembuat = $v_department->pembuat_task; ?> 
                                    <?php  endforeach; ?>   <?php endforeach; ?>
                                </table></div>
                            </div>
                        
                            <div class="col-md-6">
                                    <div class="float-left"> 
                                <a href="<?php echo base_url('mod_kerja/detail_kontribut/'.$kode_modul)?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                  <a  href="<?php echo base_url('dashboard')?>" class="btn btn-primary btn-sm"><i class="fa fa-home"></i>&nbsp;&nbsp;Dashboard</a>

                
                    </div><br><br>
                                <div class="table-responsive">
                                <table class="table table-bordered" border="0">
                                    <thead>
                                         <tr>
                                        <td width="150" align="center"><strong><font size="2px">Messsage </font></strong></td>
                                      
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                            <tr>
                                    <td width="150" align="left"><div class="media-body" id="show_data">
                                                </div>
                                    </br>
        <a  data-toggle="modal" style="color:white" data-target="#pesan_tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Message</a>
 
<div id="pesan_tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">TAMBAH PESAN</h4>
        </div>
 <form  id="input">  
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
    <input type="text" hidden name="firstname"  value="<?php
$myvalue = $this->session->login['nama'];
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>">  
    <input type="text" hidden name="jabatan"  value="<?php
$myvalue =  $this->session->login['jabatan'];
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>">                                      
 <input type="" hidden name="kode_modul"  value="<?php echo $kode_modul ?>">
                                             <input type="" hidden name="kode_modul_chat"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
                                </div>
                                        <div class="form-group col-md-12">
                                       <?php if($this->session->login['nama'] != $pembuat ): ?>     
                                             <textarea class="form-control"  hidden name="kepada3"  placeholder="Enter message..." ><?= $pembuat;?></textarea>
                                         <?php endif;?>
                                            <textarea class="form-control" hidden  name="kepada"  placeholder="Enter message..." ><?= $penerima;?></textarea>
                                     

                                </div>
                                     <div id="notif_penerima3"></div>
                                <div class="form-group col-md-12">
                             
                                            <label for="nama_barang"><strong>Pesan </strong></label>
                                             <textarea class="form-control" name="chat" placeholder="Enter message..." required  autofocus="autofocus"></textarea>
                                </div>

                                        <hr>

                                    <div class="form-group col-12">
                                         <button  type="button" id="simpan" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
   <script type="text/javascript">
    setInterval(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
        
      //  $('#mydata').dataTable();
         
        //fungsi tampil barang
        function tampil_data_barang(){
                var url = window.location.href;
                var id =    <?php echo $kode_modul ?>;
                var mybaseurl='<?php echo base_url(); ?>img/uploads/berkas1/';
               
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>user/mod_kerja/data_kontributor',

                async : false,
                dataType : 'json',
                data: {id:id},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html +='<textarea class="form-control" hidden name="kepada2[]"  placeholder="Enter message..." >'+data[i].penerima+'</textarea>';
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php echo $kode_modul ?>"  class="form-control" >'; 
                        html += '<input type="text"hidden  name="kode_modul_chats[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text" hidden  name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Comment Detail,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
                          html += '<input type="text" hidden  name="creat_at2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                          echo  date('Y-m-d  H:i:s'); ?>"  class="form-control" >';
                    }
                    $('#notif_penerima3').html(html);
                }

            });
        }

    }, 2000);


</script>                      

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- end modal -->
                                            </tr>
                                
                                    </tbody>
                                </table></div>
                            </div>

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
    <script type="text/javascript">
$(document).ready(function(){
    
    $('#simpan').on('click', function(){ 
         $('#pesan_tambah').modal('hide');
        
         //$(this).find('form').trigger('reset');
  var input = $('#input').serialize();
  $.ajax({
      url: '<?php echo base_url()?>mod_kerja/saved_sub_task',
      type: 'POST',
      data : input,
      dataType : 'JSON',
      success:function(data){
       console.log(data)
      } 
   })
  $('#pesan_tambah form')[0].reset();
 })
});

</script>
    <script type="text/javascript">
    setInterval(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
        
      //  $('#mydata').dataTable();
         
        //fungsi tampil barang
        function tampil_data_barang(){
                var url = window.location.href;
                var id = url.substring(url.lastIndexOf('/') + 1);
                var mybaseurl='<?php echo base_url(); ?>img/uploads/berkas1/';
               
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>mod_kerja/data_chat_sub',

                async : false,
                dataType : 'json',
                data: {id:id},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){ 
                        html +='<a class="pull-left" href="#">'+'</a>'+
                                '<div class="media-heading"><font size="2px" color="blue">'+ data[i].username +"</font>&nbsp;"+'<font size="2px">' +"[" +data[i].waktu_chat +"]"+":"+"&nbsp;"+data[i].chat+'</a></font>'  +' </font><span class="small pull-right">'+
                                '<span>'+'</div>';         


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
<script type="text/javascript">
    setInterval(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
        
      //  $('#mydata').dataTable();
         
        //fungsi tampil barang
        function tampil_data_barang(){
                var url = window.location.href;
                var id = <?php echo $kode_modul ?>;
                var mybaseurl='<?php echo base_url(); ?>img/uploads/berkas1/';
               
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>user/mod_kerja/data_kontributor',

                async : false,
                dataType : 'json',
                data: {id:id},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html +='<textarea class="form-control"  name="kepada2[]"  placeholder="Enter message..." >'+data[i].penerima+'</textarea>';
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php echo $kode_modul ?>"  class="form-control" >'; 
               
                        html += '<input type="text"   name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Add Comment,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
                          html += '<input type="text" hidden  name="creat_at2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                          echo  date('Y-m-d  H:i:s'); ?>"  class="form-control" >';
                    }
                    $('#notif_penerima').html(html);
                }

            });
        }

    }, 2000);


</script>   
<script type="text/javascript">
    setInterval(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
        
      //  $('#mydata').dataTable();
         
        //fungsi tampil barang
        function tampil_data_barang(){
                var url = window.location.href;
                var id =    <?php echo $kode_modul ?>;
                var mybaseurl='<?php echo base_url(); ?>img/uploads/berkas1/';
               
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>mod_kerja/data_kontributor',

                async : false,
                dataType : 'json',
                data: {id:id},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html +='<a class="pull-left" href="#">'+'</a>'+
                                '<div class="media-heading"><font size="2px" >'+ data[i].penerima+'</font></div>';         
                    }
                    $('#show_data2').html(html);

                }

            });
        }

    }, 2000);


</script>
</body>
</html>