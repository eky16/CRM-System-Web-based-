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
  <?php error_reporting(0);  ?>
  <body id="page-top">

   <div id="wrapper">
      <!-- load sidebar -->
      <?php $this->load->view('partials/sidebar.php') ?>

      <div id="content-wrapper" class="d-flex flex-column">
         <div id="content" data-url="<?= base_url('mom') ?>">
            <!-- load Topbar -->
            <?php $this->load->view('partials/topbar.php') ?>

            <div class="container-fluid">
                <div class="clearfix">
                   <div class="float-left">
                      <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                  </div>
                  <div class="float-right"> 

                    <a href="<?= base_url('payment/add_pay/') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>

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
      <?php if($title == "List Payment Waiting Approved"):?>   
       <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a href="<?php echo base_url(); ?>payment/print_p"> Cetak Laporan</a></font></strong></div>        <?php endif;?>
       <div class="panel-body">
        <form method="post" action="<?= base_url('mom/lihat_filter') ?>" class="form-horizontal">  
            <div class="panel_controls">                         
        <!--          <div class="form-group">
               </br>

     <div class="col-sm-5">                             
                     <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                                <option value="" >PILIH .....</option>
                                <?php foreach ($all_leads_project as $lsp) : ?>
                                    <option value="<?php echo $lsp->id_lsp ?>"
                                     <?php $id_lsp = $_POST['id_lsp']; ?>
                                    <?php
                                    if (!empty($id_lsp)) {
                                        echo $lsp->id_lsp == $id_lsp ? 'selected' : '';
                                    }
                                    ?>><?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option>
                                        <?php endforeach; ?>

                            </select>  
                </div>
                </div>
              
            <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" class="btn btn-primary">Cari</button>  
                <a href="<?= base_url('mom/lihat_semua') ?>"> 
                <input type="button" class="btn btn-primary" value="Semua" \></a>                           
            </div> -->

        </div>
    </form>  
</div>  
<div class="card-body">

    <form action="<?= base_url('payment/update_payment_cek') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
        <div class="table-responsive">

         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <td width="1"><font size="2px">No</font></td>
                  <td width="50"><font size="2px">Tanggal</font></td>
                  <td><font size="2px">No Spk</font></td>
                  <td width="100"><font size="2px">Project</font></td>
                  <td><font size="2px" align="center" >Vendor</font></td>
                  <td width="60"><font size="2px">Jumlah</font></td>
                  <td width="60" align="center"><font size="2px">Keterangan</font></td>
                  <!--	<td>Pdf</td> -->
                  <td width="55"  style="text-align: center;"> 
                      <input type="checkbox" onclick="toggled(this);" >
                  </td>

              </tr>
          </thead>
          <tbody>
           <?php foreach ($all_paym as $pay): ?>
              <tr>
                 <td><font size="2px"><?= $no++ ?></font></td>
                 <td><font size="2px"><?= $pay->tgl_payment ?></font></td>
                 <td><font size="2px"><?= $pay->no_spk ?></font>
                   <input type="text" class="form-control" hidden  name="id_payment[]" value="<?= $pay->id_payment ?>" >                                 
                    </td>

               <td><font size="2px"><?= $pay->nama_project ?></font></td>
               <td><font size="2px">&nbsp;<?= $pay->nama_vendor ?>
               <br>&nbsp;<?= $pay->atas_nama_bank ?>
               <br>&nbsp;<?= $pay->norek_vendor .' - '. $pay->nama_bank_vendor ?></font></td>
               <td> <font size="2px">      <?php
               $hasil_rupiah = "" . number_format($pay->total_payment,0,',','.');
               echo $hasil_rupiah; ?></font></td>
               <td> <font size="2px"><?= $pay->note_payment ?></font></td>
               <td align="center">

                 <div class="form-check">

                  <label class="container12" > 
                      <input type="checkbox" name="status_approval[]" class="delete_checkbox" value="<?= $pay->id_payment ?>" >
                      <span class="checkmark"></span>
                  </label>
              </div> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              <?php if ($pay->status_approval == 1) : ?>
                <a  href="<?= base_url('payment/pending_payment/' . $pay->id_payment) ?>" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></a>
            <?php else: ?>
               <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('payment/hapus_laporan/' . $pay->id_payment) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
           <?php endif;?>
       </td>
    									<!--<td>
    										<a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $pay->id_payment; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Detail</a>
    											<?php if ($pay->status_approval != 3) : ?>
                                            <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('payment/hapus_laporan/' . $pay->id_payment) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                        <br> <br>
                                             <a  href="<?= base_url('payment/pending_payment/' . $pay->id_payment) ?>" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></a>   <a  href="<?= base_url('payment/apprved_payment/' . $pay->id_payment) ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>    <?php endif;?>
                                         </td> -->

                                     </tr>

                                 <?php endforeach ?>
                             </tbody>
                         </table>
                         <br>
                         <div class="form-group ">
                            <div class="bg-light text-right">
                             <button type='submit' class='btn btn-primary' onclick='archiveFunction()'>PROSES</button>
                             <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Delete</button>

                             <!--   <button  class='btn btn-danger' id="batal">BATAL</button> -->
                         </div></div>
                         <script type="text/javascript">
                            $("form").submit(function () {
                                var this_master = $(this);
                                this_master.find('input[type="checkbox"]').each( function () {
                                    var checkbox_this = $(this);
                                    if( checkbox_this.is(":checked") == true ) {
                                        checkbox_this.attr('value','3');
                                    } else {
                                        checkbox_this.prop('checked',true);
                                //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
                                    checkbox_this.attr('value','1');
                                    }
                                })
                            });

                        </script>
                        <script>
                            $(document).ready(function(){

                               $('.delete_checkbox').click(function(){
                                  if($(this).is(':checked'))
                                  {
                                     $(this).closest('tr').addClass('removeRow');
                                 }
                                 else
                                 {
                                     $(this).closest('tr').removeClass('removeRow');
                                 }
                             });

                               $('#delete_all').click(function(){
                                  var checkbox = $('.delete_checkbox:checked');
                                  if(checkbox.length > 0)
                                  {
                                     var checkbox_value = [];
                                     $(checkbox).each(function(){
                                        checkbox_value.push($(this).val());
                                    });
                                     $.ajax({
                                        url:"<?php echo base_url(); ?>payment/delete_all",
                                        method:"POST",
                                        data:{checkbox_value:checkbox_value}, 
                                        success:function()
                                        {
                                           $('.removeRow').fadeOut(1500);
                                       }
                                   })
                                 }
                                 else
                                 {
                                     alert('Select atleast one records');
                                 }
                             });

                           });
                       </script></form>
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
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}
</script>
<script type="text/javascript">
    function toggled(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>
<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>