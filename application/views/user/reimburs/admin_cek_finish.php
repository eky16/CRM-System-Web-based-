<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
</head>
<?php error_reporting(0);  ?>
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
                <div class="card shadow">
                    <div class="card-header"><strong><?= $tittle ?></strong></div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th width="1px">No</th>
                                    <th >Tanggal</th> 
                                    <th class="col-sm-1">Kode</th>
                                    <th class="col-sm-2">Karyawan</th>
                                    <th width="250"> Project</th>
                                    
                                    <th >Total Reimburs</th> 
                                    <th width="50">Status</th> 

                        
                                    <th width="50" align="center">Aksi</th>     
                                </tr>
                            </thead>
                                <tbody id="show_data">
                                    
                                </tbody>
                            </table>
                        </div> </div>      

     
                            
                </div>
                </div>
            </div>
 <script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
         
        $('#dataTable').dataTable();
          
        //fungsi tampil barang
        function tampil_data_barang(){
            $.ajax({
                type  : 'post',
                url   : '<?php echo base_url()?>user/reimburs/data_reimburs_finish',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
var harga = data[i].total_reimburs;
var hargaRupiah = '';

if (harga != null && !isNaN(harga)) {
  hargaRupiah = 'Rp ' + parseFloat(harga).toLocaleString('id-ID');
} else {
  hargaRupiah = '-';
}
var Success ='Success';
                        html += '<tr>'+
                                '<td><font size="2px">'+(i+1) +'</font></td>'+
                                '<td><font size="2px">'+data[i].tanggal_reimbus+'</font></td>'+
                                '<td><font size="2px">'+data[i].kode_reimbus+'</font></td>'+
                                '<td><font size="2px">'+data[i].user_reimbus+'</font></td>'+
                                '<td><font size="2px">'+data[i].name_project+'</font></td>'+
                                '<td width="150"><font size="2px">'+ hargaRupiah +'</font></td>'+
                                '<td align="center"><span class="badge badge-success"> <font size="2px">'+ Success +'</font></span></td>'+

                               '<td width="50"><a class="btn btn-success btn-sm"  href="<?= base_url('user/reimburs/detailss/' ) ?>' + data[i].kode_reimbus + '">' + '<i class="fa fa-eye"></i>'+ ' Detail'+ '</a></td>'
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }
 
            });
        }
 
    });
 
</script>
            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('user/partials/js.php') ?>
        <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>