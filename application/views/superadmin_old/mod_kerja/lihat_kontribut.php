<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<style type="text/css">
 .conv   {text-transform: lowercase ;}
 p cap   { text-transform: capitalize; }
 .portlet {
    margin-bottom: 15px;
}

.btn-white {
    border-color: #cccccc;
    color: #333333;
    background-color: #ffffff;
}

.portlet {
    border: 1px solid;
}

.portlet .portlet-heading {
    padding: 0 15px;
}

.portlet .portlet-heading h4 {
    padding: 1px 0;
    font-size: 16px;
}

.portlet .portlet-heading a {
    color: #fff;
}

.portlet .portlet-heading a:hover,
.portlet .portlet-heading a:active,
.portlet .portlet-heading a:focus {
    outline: none;
}

.portlet .portlet-widgets .dropdown-menu a {
    color: #333;
}

.portlet .portlet-widgets ul.dropdown-menu {
    min-width: 0;
}

.portlet .portlet-heading .portlet-title {
    float: left;
}

.portlet .portlet-heading .portlet-title h4 {
    margin: 10px 0;
}

.portlet .portlet-heading .portlet-widgets {
    float: left;
    margin: 8px 0;
}

.portlet .portlet-heading .portlet-widgets .tabbed-portlets {
    display: inline;
}

.portlet .portlet-heading .portlet-widgets .divider {
    margin: 0 5px;
}

.portlet .portlet-body {
    padding: 15px;
    background: #fff;
}

.portlet .portlet-footer {
    padding: 19px 15px;
    background: #e0e7e8;
}

.portlet .portlet-footer ul {
    margin: 0;
}

.portlet-green,
.portlet-green>.portlet-heading {
    border-color: #16a085;
}

.portlet-green>.portlet-heading {
    color: #fff;
    background-color: #16a085;
}

.portlet-orange,
.portlet-orange>.portlet-heading {
    border-color: #f39c12;
}

.portlet-orange>.portlet-heading {
    color: #fff;
    background-color: #f39c12;
}

.portlet-blue,
.portlet-blue>.portlet-heading {
    border-color: #2980b9;
}

.portlet-blue>.portlet-heading {
    color: #fff;
    background-color: #2980b9;
}

.portlet-red,
.portlet-red>.portlet-heading {
    border-color: #e74c3c;
}

.portlet-red>.portlet-heading {
    color: #fff;
    background-color: #e74c3c;
}

.portlet-purple,
.portlet-purple>.portlet-heading {
    border-color: #8e44ad;
}

.portlet-purple>.portlet-heading {
    color: #fff;
    background-color: #8e44ad;
}

.portlet-default,
.portlet-dark-blue,
.portlet-default>.portlet-heading,
.portlet-dark-blue>.portlet-heading {
    border-color: #34495e;
}

.portlet-default>.portlet-heading,
.portlet-dark-blue>.portlet-heading {
    color: #fff;
    background-color: #34495e;
}

.portlet-basic,
.portlet-basic>.portlet-heading {
    border-color: #333;
}

.portlet-basic>.portlet-heading {
    border-bottom: 1px solid #333;
    color: #333;
    background-color: #fff;
}

@media(min-width:768px) {
    .portlet {
        margin-bottom: 30px;
    }
}

.img-chat{
width:40px;
height:40px;
}

.text-green {
    color: #16a085;
}

.text-orange {
    color: #f39c12;
}

.text-red {
    color: #e74c3c;
}                
</style>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
    

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('asst') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">



                           <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                 
                                            <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800">Task</h1>
                    </div>
                    <div class="float-right"> 

                            <a href="<?= base_url('mod_kerja/detail_kontribut/'.basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])) ?>" class="btn btn-info btn-sm"><i class="fa fa-refresh "></i>&nbsp;&nbsp;Refres</a>
                             <a href="<?= base_url('mod_kerja/lihat_semua/') ?>" class="btn btn-primary btn-sm"><i class="fa fa-home "></i>&nbsp;&nbsp;Home</a>  
                            <button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>
                
                    </div>
                </div>
                                </div>

               
                    <div >
                    <div class="table-responsive">
                            <table class="table table-bordered"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th class="col-sm-1">Kode</th>  
                                    <th>Task</th>
                                     <th class="col-sm-2">Status</th>
                                       <th class="col-sm-1">Berkas</th>
                                        <!-- <th class="col-sm-1">Lihat</th> -->                                            
                                </tr>
                            </thead>
                                  <tbody> 
                                    <?php  foreach ($all_department_info as $akey => $v_department_info) : ?>                                                       
                                <?php foreach ($v_department_info as $key => $v_department) : ?>

                                    <tr>
                                        <td><?php echo $v_department->kode_modul ?></td>
                                        <td><?php echo $v_department->tugas ?></td>
                                        <td>

                                        <?php if ($v_department->status_tugas == 3) : ?>
                                            <input type="checkbox" checked="checked" disabled="disabled" /> Selesai
                                        <?php elseif($v_department->status_tugas == 2) : ?>
                                        <input type="checkbox"  disabled="disabled" /> Proses
                                      <?php elseif($v_department->status_tugas == 1) : ?>
                                        <input type="checkbox"  disabled="disabled" /> Menunggu
                                       <?php endif; ?></td>                                                
             <td align="center">  
                                                <?php if(!empty($v_department->berkas_file)
                                                AND $v_department->status_tugas == 3): ?>  <a target="blank" href="<?php echo base_url(); ?>img/uploads/<?= $v_department->berkas_file ?>" title="Menuju halaman google" class="btn btn-warning btn-sm"> View   </a> <?php endif; ?> </td>
                                    <!-- <td align="center"><a target="blank" href="<?= base_url('mod_kerja/detail_sub/' . $v_department->id_sub) ?>" class="btn btn-primary btn-sm">Lihat </a></td> -->
                                    </tr>
                                    <?php  endforeach; ?>   <?php endforeach; ?>
        
                                                           
                        </tbody>
                            </table>
                        </div>
  <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800">&nbsp;&nbsp;&nbsp;Detail Task</h1>
                    </div>
                <div class="float-right"> 
                               
                  <a  data-toggle="modal" style="color:white" data-target="#right_modal" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 
                    </div><br><br>
   <!--  tabel sub task -->  
<div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                        
                                            <td width="10"><strong><font size="2px">No</font></strong></td>
                                                        <td width="70"><strong><font size="2px">Tanggal</font></strong></td>
                                                        <td width="40"><strong>
                                                            <font size="2px">Id</font>
                                                        </strong></td>
                                                        <td width="200"><strong><font size="2px">Judul</font></strong></td>
                                                        <td width="200"><strong><font size="2px">Deskripsi</font></strong></td>
                                                        <td width="20"><strong><font size="2px">Moderator</font></strong></td>
                                                        <td width="250"><strong><font size="2px">Pesan</font></strong></td>
                    
                                            </td>
                                        </tr>
                                    </thead>
                                            <tbody>
                                               <?php
                                               $no = 1;
                                               if (!empty($dt_sub)): foreach ($dt_sub as $row) : ?>
                                                <tr>
                                                    <td><font size="2px"><?= $no++ ?> </font></td>
                                                    <td><font size="2px"><?= $row->tgl_created ?> </font></td>
                                                    <td><font size="2px"><?= $row->kode_create ?> </font></td>
                                                    <td align="left"><font size="2px"><?= $row->status_task_sub ?> </font></td>
                                                    <td><font size="2px"><?= $row->deskripsi_detail_sub ?></font></td>
                                                    <td><font size="2px"><?= $row->pembuat ?></font>
                                                    </td>
                                                    <?php $kode_pesan = $row->kode_create ?>
                                                    <td><div id="show_data_chatttt-<?= $row->kode_create; ?>"></div>
                                                        <br>
<form  id="input-<?= $row->kode_create; ?>">  
<input type="text" hidden name="firstname"  value="<?php
$myvalue = $this->session->login['nama'];
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>">  
<input type="text" hidden name="jabatan"  value="<?php
$myvalue = $this->session->login['jabatan'];
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>">                                      
<input type="" hidden name="kode_modul"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
<input type="" hidden  name="kode_modul_chat"  value="<?= $row->kode_create; ?>">
</div>
<div class="form-group col-md-12">
   <?php if($this->session->login['nama'] != $info_modul->createdby ): ?>     
     <textarea class="form-control" hidden  name="kepada3"  placeholder="Enter message..." ><?= $info_modul->createdby;?></textarea>
 <?php endif;?>
 <textarea class="form-control" hidden  name="kepada"  placeholder="Enter message..." ><?= $info_modul->nama_karyawan;?></textarea>

</div>
<div id="11112-<?= $row->kode_create; ?>"></div>
<div class="form-group col-md-12" >

 <textarea class="form-control" id="configreset" name="chat" placeholder="Enter message..." required  autofocus="autofocus"></textarea>
</div>
<div class="form-group col-12">
    <button  type="button" id="simpan_chat_detail-<?= $row->kode_create; ?>" class="btn btn-primary"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Kirim</button>
</form>


<script type="text/javascript">
    $(document).ready(function(){

        $('#simpan_chat_detail-<?= $row->kode_create; ?>').on('click', function(){

          var input = $('#input-<?= $row->kode_create; ?>').serialize();
          $.ajax({
              url: '<?php echo base_url()?>mod_kerja/saved_sub_task',
              type: 'POST',
              data : input,
              dataType : 'JSON',
              success:function(data){
               console.log(data)
           } 
       })
          $('#input-<?= $row->kode_create; ?>').trigger("reset");
      })
    });

</script>

<a data-toggle="modal" style="color:white" data-target="#detail_task_file<?= $row->kode_create; ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>&nbsp;&nbsp;File</a>
<script type="text/javascript">
    setInterval(function(){
        tampil_data(); 

        function tampil_data(){

           // var id = document.getElementById("code_p").innerHTML;
           var id = "<?php echo $kode_pesan ?>";
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
                    var idChat =data[i].kode_created;
                    html +='<a class="pull-left" href="#">'+'</a>'+
                        '<div class="media-heading"><font size="2px" color="blue">'+ data[i].username +"</font>&nbsp;"+'<font size="2px">' +"[" +data[i].waktu_chat +"]"+":"+"&nbsp;"+data[i].chat +
                        '<a href="<?php echo base_url(); ?>img/uploads/berkas1/'+data[i].berkas +'" target="_blank" style="text-decoration: underline;"><font size="2px" color="blue">'+data[i].berkas +'</font></a>'
                        +'</a></font>'  +' </font><span class="small pull-right">'+
                        '<span>'+'</div>';         
                }
                $('#show_data_chatttt-' + idChat).html(html);
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
            var id = url.substring(url.lastIndexOf('/') + 1);
            var mybaseurl='<?php echo base_url(); ?>img/uploads/berkas1/';
            var idChat = "<?= $row->kode_create; ?>";
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
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text"  hidden name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden  name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Add File,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
                        html += '<input type="text"  hidden name="creat_at2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                        echo  date('Y-m-d  H:i:s'); ?>"  class="form-control" >';
                    }
                    $('#11112-' + idChat).html(html);
                }

            });
        }

    }, 2000);


</script>  

</td>
</tr>


<!-- modal -->
<div  class="modal modal-right fade" id="detail_task_file<?= $row->kode_create; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah File Detail Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
     <form method="post" action="<?= base_url('mod_kerja/save_berkas_dt_tsk_kontribut') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
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
<input type="" hidden name="kode_modul_chat"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
<input type="" hidden name="kode_dt_tsk"  value="<?= $row->kode_create; ?>">
</div>
<div class="form-group col-md-12">
 <?php if($this->session->login['nama'] != $info_modul->createdby ): ?>     
   <textarea class="form-control" hidden name="kepada3"  placeholder="Enter message..." ><?= $info_modul->createdby;?></textarea>
<?php endif;?>  
<textarea class="form-control" hidden  name="kepada"  placeholder="Enter message..." ><?= $info_modul->nama_karyawan;?></textarea>

</div>
<div id="notif_penerima_detail"></div> 
<div class="form-group col-md-12">
    <label ><strong>Berkas </strong></label>
    <input type="file" class="form-control" name="berkas"  value="" required>
</div>

<hr>

<div class="form-group col-12">
    <button type="submit"  class="btn btn-primary"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Kirim</button>

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
            var id = url.substring(url.lastIndexOf('/') + 1);
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
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text" hidden  name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Add File,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
                        html += '<input type="text"  hidden name="creat_at2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                        echo  date('Y-m-d  H:i:s'); ?>"  class="form-control" >';
                    }
                    $('#notif_penerima_detail').html(html);
                }

            });
        }

    }, 2000);


</script>     
  
                 

</div>
</div></form>

<div class="modal-footer modal-footer-fixed">
 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>

</div> <!-- end modal log proyek -->
<?php endforeach; ?>
<?php else : ?>
    <td colspan="7" align="center">
        <strong>There is no data to display</strong>
    </td>

<?php endif; ?>


</tbody>
                                </table> </div>
                                <!-- end tabel sub task -->  
                        <div class="table-responsive">
                      <table class="table table-bordered" align="left" width="50%" cellspacing="0">
                                 <thead>
                                <tr>
                                   
                                     <th width="180">Tanggal</th> 
                                    <th width="100">Dibuat</th> 
                                   <th width="100">Penerima</th> 
                                    <th width="100">Proyek</th> 
                                     <th width="100">Kontributor</th>
                                    <th width="180">Waktu</th>
                                     <th class="col-sm-1,5">Pesan</th>                                            
                                </tr>
                            </thead>
                                  <tbody> 
             
                                    <tr>
                                        <td  width="50" style="font-size: 12px">
                                            Created Date :<?php echo $info_modul->createdtime ?>
                                           <p><font color="blue"> Due Date :<?php echo $info_modul->tempo ?></font></p>
                                            </td>
                                         <td style="font-size: 12px" class="conv">
                                           
<?php
$myvalue = $info_modul->createdby;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>

                                         </td>
                                        <td style="font-size: 12px">
 <?php
$myvalue = $info_modul->nama_karyawan;
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>
<p style="font-size: 9px"><i> (<?php echo $info_modul->department ?>)</i></p>
                                        </td>
                                        <td style="font-size: 12px"><?php echo $info_modul->nama_proyek ?></td>
                                             <td style="font-size: 12px"><div class="media-body" id="show_data2">
                                                </div> </td>

                                        <td style="font-size: 12px">
                                         <p>Idle : <?php if($info_modul->tgl_proses == '0000-00-00 00:00:00') : ?>     
                                            <?php 
                                             date_default_timezone_set('Asia/Jakarta');
                                            $start_date = new DateTime($info_modul->createdtime);
                                            $end_date =new DateTime(date('Y-m-d H:i:s'));
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            $h = $end_date->diff($start_date)->h;
                                            $i = $end_date->diff($start_date)->i;
                                            $s = $end_date->diff($start_date)->s;
                                            echo " " . $d . "d " . $h . "h " . $i . "m";
                                            ?>  <?php endif; ?></p>
                                         <p>Response : <?php if($info_modul->tgl_proses != '0000-00-00 00:00:00') : ?>     
                                            <?php 
                                            $start_date = new DateTime($info_modul->createdtime);
                                            $end_date = new DateTime($info_modul->tgl_proses);
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            $h = $end_date->diff($start_date)->h;
                                            $i = $end_date->diff($start_date)->i;
                                            $s = $end_date->diff($start_date)->s;
                                            echo " " . $d . "d " . $h . "h " . $i . "m";
                                            ?>  <?php endif; ?></p>
                                         <p>Process :   <?php   $persentasi=round($info_modul->proses/$info_modul->progres * 100,2); 
                                            if($info_modul->tgl_proses != '0000-00-00 00:00:00'  and $persentasi != '100') : ?>     
                                            <?php  
                                            date_default_timezone_set('Asia/Jakarta');
                                            $start_date = new DateTime($info_modul->tgl_proses);
                                            $end_date = new DateTime(date('Y-m-d H:i:s'));
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            $h = $end_date->diff($start_date)->h;
                                            $i = $end_date->diff($start_date)->i;
                                            $s = $end_date->diff($start_date)->s;
                                            echo " " . $d . "d " . $h . "h " . $i . "m";
                                            ?>
                                           <?php endif; ?> 
                                            <?php if($info_modul->tgl_proses != '0000-00-00 00:00:00' and $persentasi == '100') : ?>     
                                            <?php 
                                            $start_date = new DateTime($info_modul->tgl_proses);
                                            $end_date = new DateTime($info_modul->tgl_end_task);
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            $h = $end_date->diff($start_date)->h;
                                            $i = $end_date->diff($start_date)->i;
                                            $s = $end_date->diff($start_date)->s;
                                            echo " " . $d . "d " . $h . "h " . $i . "m";
                                            ?> <?php endif; ?></p>
                                       
                                        </div></td>
                                        <td> <div class="media-body" id="show_data">
                                                </div> </br>
        <a  data-toggle="modal" style="color:white" data-target="#pesan_tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Message</a>

        <a  data-toggle="modal" style="color:white" data-target="#berkas_tambah" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>&nbsp;&nbsp;File</a>
                            
        <a  data-toggle="modal" style="color:white" data-target="#kontribusi_tambah" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Kontributor</a>
                                            </td>                                                

                                    </tr>
                                    
                        </tbody>
                            </table>
                     <div >

                    </div>
 <?php if (!empty($info_modul->berkas_task)): ?>                  
       <div class="table-responsive">
                            <table class="table table-bordered"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th align="center" class="col-sm-1">Foto</th>  
                                                                    
                                </tr>
                            </thead>
                                  <tbody> 
                
                                    <tr>
                                       <td align="center">    <a target="blank" href="<?php echo base_url(); ?>img/uploads/berkas1/<?= $info_modul->berkas_task ?>" title="Menuju halaman google">    <img id="myImg"  src="<?php echo base_url(); ?>img/uploads/berkas1/<?= $info_modul->berkas_task ?>"  style="width:10%;cursor:zoom-in"> </a></td>
                                                                   

                                    </tr> 
                               
        
                                                           
                        </tbody>
                            </table>
                        </div><?php endif; ?>
                        </div> 
                    </div>




                </div>
            </div>
        </div>
         <!-- end isi -->
  
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
$myvalue = $this->session->login['jabatan'];
$arr = explode(' ',trim($myvalue));
echo $arr[0]; // will print Test
?>">                                      
                                             <input type="" hidden name="kode_modul_chat"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
                                </div>
                                        <div class="form-group col-md-12">
                                       <?php if($this->session->login['nama'] != $info_modul->nama_karyawan ): ?>     
                                             <textarea class="form-control" hidden name="kepada3"  placeholder="Enter message..." ><?= $info_modul->createdby;?></textarea>
                                         <?php endif;?>
                                            <textarea class="form-control"  hidden name="kepada"  placeholder="Enter message..." ><?= $info_modul->nama_karyawan;?></textarea>
                                     

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
                var id = url.substring(url.lastIndexOf('/') + 1);
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
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text"  hidden name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Comment,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
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
                              <!-- modal pesan -->
 
<div  class="modal modal-right fade" id="right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Sub Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="post" action="<?= base_url('mod_kerja/save_berkas_detail_sub_kontribut') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                      <div class="form-group col-md-12">
                                       <?php if($this->session->login['nama'] != $info_modul->nama_karyawan ): ?>     
                                             <textarea class="form-control" hidden name="kepada3"  placeholder="Enter message..." ><?= $info_modul->createdby;?></textarea>
                                         <?php endif;?>
                                            <textarea class="form-control"  hidden name="kepada"  placeholder="Enter message..." ><?= $info_modul->nama_karyawan;?></textarea>
                                     

                                </div>
                                <input  type="text" maxlength="50"  hidden name="kode_create" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php  $code =  random_string('numeric', 5);
                                            echo 'TSKDT'.$code ?>"  class="form-control">
                                <input  type="text" maxlength="50" readonly hidden name="kd_modul" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control">
            
                                 <div id="notif_penerima_sub"></div> 
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Judul </label>
                                             <input hidden type="text" maxlength="50" readonly  name="tgl_created" placeholder="Judul" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?>"  class="form-control">
                                        <input  type="text" maxlength="50" name="status_task_sub" placeholder="Judul" autocomplete="off" value=""  class="form-control" required>

                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Deskripsi </label>
                                            <textarea class="form-control"  name="deskripsi_detail_sub"> </textarea>
                                </div>
                                
                                <input type="text" name="operator" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

         

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div> <!-- end modal Sub Task -->
<div id="kontribusi_tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">TAMBAH KONTRIBUSI</h4>
        </div>
  <form  id="input_kontributor">  
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
                                <input type="" hidden name="kode_modul_kontribusi"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">       
                                </div>
                                                       <div class="form-group col-md-12">
                                       <?php if($this->session->login['nama'] != $info_modul->createdby ): ?>     
                                             <textarea class="form-control" hidden name="kepada3"  placeholder="Enter message..." ><?= $info_modul->createdby;?></textarea>
                                        <?php endif;?>  
                                        <textarea class="form-control" hidden  name="kepada"  placeholder="Enter message..." ><?= $info_modul->nama_karyawan;?></textarea>
                                                 
                                </div>
                                <div id="notif_penerima2"></div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Karyawan </strong></label>
                                            <select id="select-state" placeholder="Pilih Karyawan" name="penerima" class="form-control" required>           
                             <option value="" >PILIH .....</option>
                    <?php foreach ($employee->result() as $row) :?>
                                <option value="<?php echo $row->nama_karyawan;?>"><?php echo $row->nama_karyawan;?></option>
                            <?php endforeach;?>>

                                   </select> 
                                </div>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="button" id="simpan_kontributor" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
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
                var id = url.substring(url.lastIndexOf('/') + 1);
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
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text" hidden  name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Add Contribut,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
                          html += '<input type="text" hidden  name="creat_at2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                          echo  date('Y-m-d  H:i:s'); ?>"  class="form-control" >';
                    }
                    $('#notif_penerima2').html(html);
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
  </div>
<div id="berkas_tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">TAMBAH BERKAS</h4>
        </div>
 <form method="post" action="<?= base_url('mod_kerja/save_berkas_kontribut') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
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
                                             <input type="" hidden name="kode_modul_chat"  value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>">
                                </div>
                                    <div class="form-group col-md-12">
                                       <?php if($this->session->login['nama'] != $info_modul->createdby ): ?>     
                                             <textarea class="form-control" hidden name="kepada3"  placeholder="Enter message..." ><?= $info_modul->createdby;?></textarea>
                                        <?php endif;?>  
                                        <textarea class="form-control" hidden  name="kepada"  placeholder="Enter message..." ><?= $info_modul->nama_karyawan;?></textarea>
                                                 
                                </div>
                                <div id="notif_penerima"></div> 
                                <div class="form-group col-md-12">
                                            <label ><strong>Berkas </strong></label>
                                        <input type="file" class="form-control" name="berkas"  value="" required>
                                </div>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
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
                var id = url.substring(url.lastIndexOf('/') + 1);
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
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text" hidden  name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Add File,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
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
                var id = url.substring(url.lastIndexOf('/') + 1);
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
                        html += '<input type="text" hidden name="kode_modul_chat2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';  
                        html += '<input type="text" hidden  name="firstname2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama']; ?>"  class="form-control" >';
                        html += '<input type="text" hidden name="noted2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="Add detail,Task Id <?= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>"  class="form-control" >';
                          html += '<input type="text" hidden  name="creat_at2[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                          echo  date('Y-m-d  H:i:s'); ?>"  class="form-control" >';
                    }
                    $('#notif_penerima_sub').html(html);
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
                var url = window.location.href;
                var id = url.substring(url.lastIndexOf('/') + 1);
                var mybaseurl='<?php echo base_url(); ?>img/uploads/berkas1/';
               
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>mod_kerja/data_barang',

                async : false,
                dataType : 'json',
                data: {id:id},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){ 
                        html +='<a class="pull-left" href="#">'+'</a>'+
                                '<div class="media-heading"><font size="2px" color="blue">'+ data[i].username +"</font>&nbsp;"+'<font size="2px">' +"[" +data[i].waktu_chat +"]"+":"+"&nbsp;"+data[i].chat +
                                    '<a href="<?php echo base_url(); ?>img/uploads/berkas1/'+data[i].berkas +'" target="_blank" style="text-decoration: underline;"><font size="2px" color="blue">'+data[i].berkas +'</font></a>'
                                     +'</a></font>'  +' </font><span class="small pull-right">'+
                                '<span>'+'</div>';         


                    }
                    $('#show_data').html(html);
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
                var id = url.substring(url.lastIndexOf('/') + 1);
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
                                '<div class="media-heading">'+ data[i].penerima+'</div>';         
      


                    }
                    $('#show_data2').html(html);

                }

            });
        }

    }, 2000);


</script>

<script type="text/javascript">
$(document).ready(function(){
    
    $('#simpan').on('click', function(){
         $('#pesan_tambah').modal('hide');
        
         //$(this).find('form').trigger('reset');
  var input = $('#input').serialize();
  $.ajax({
      url: '<?php echo base_url()?>mod_kerja/saved',
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

$(document).ready(function(){
    
    $('#simpan_kontributor').on('click', function(){
         $('#kontribusi_tambah').modal('hide');
        
         //$(this).find('form').trigger('reset');
  var input = $('#input_kontributor').serialize();
//var input = new input_file($('form')[0]);
  $.ajax({
      url: '<?php echo base_url()?>mod_kerja/saved_kontributor',
      type: 'POST',
      data : input,
      dataType : 'JSON',
      success:function(data){
       console.log(data)
      } 
   })
  $('#kontribusi_tambah form')[0].reset();
 })
});
</script>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});
    </script>
</body>
</html>