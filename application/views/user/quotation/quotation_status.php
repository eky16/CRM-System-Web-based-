<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>
<?php error_reporting(0);  ?>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('mom') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right"> 
                
                            <a href="<?= base_url('user/quotation/tambah_quo') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
                    
                    </div>
                </div>
                <hr>

                <style>
.bg-h3 {
    background-color: #fff3cd !important; /* kuning muda */
}
.bg-h {
    background-color: #ffe5b4 !important; /* oranye lembut */
}
.bg-overdue {
    background-color: #f8d7da !important; /* merah */
}

.warning-icon {
    margin-left: 6px;
    font-size: 14px;
    color: #856404;
}
.bg-h .warning-icon {
    color: #b45309;
}
.bg-overdue .warning-icon {
    color: #721c24;
}
</style>

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
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/finish_"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
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



<hr>

<div class="card-header">
                        <div class="float-right"> 
         <?php if ($title == "Quotation Status") :?>   
                   <a href="<?= base_url('user/quotation/export_excel_permintaan_diproses') ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Export Excel</a> 
                <?php endif; ?>

                   <?php if ($title == "Quotation Order List") :?>       
                    </div><font color="blue"><strong>Quotation Order List</strong></font>  / <a  href="<?php echo base_url(); ?>user/quotation/list_permintaan_item"><strong>Item Sales Order</strong></a>/ <a  href="<?php echo base_url(); ?>user/quotation/list_history_permintaan"><strong>Riwayat Sales Order</strong></a></div>
                    <?php endif; ?>

                    <?php if ($title == "Estimation Completed") :?>       
                    </div><a  href="<?php echo base_url(); ?>user/quotation/list_quo_order"><strong>Quotation Order List</strong></a> / <a  href="<?php echo base_url(); ?>user/quotation/list_quotation_item"><strong>Quotation Follow Up</strong></a>/ <a  href="<?php echo base_url(); ?>user/quotation/quo_status"><font color="blue"><strong>Estimation Completed</strong></font></a> <!--<a  href="<?php echo base_url(); ?>user/quotation/quo_item_selesai"><strong>Estimation Completed</strong></a> --></div>     
                     <?php endif; ?>
                     
                       <?php if ($title == "Riwayat Permintaan Barang") :?> 
                    </div><a  href="<?php echo base_url(); ?>user/quotation/list_permintaan"><strong> List Sales Order</strong></a> / <font color="blue"><strong>Riwayat Sales Order</strong></font></div>
                     <?php endif; ?>

<style>

       /* Paksa warna merah marun ke elemen th dan semua state-nya */
    #dataTable thead th,
    table.dataTable thead th,
    .table thead th {
        background-color: #8B0000 !important;
        color: #ffffff !important;
        opacity: 1 !important;
        border: 1px solid #a00000 !important; /* Opsional: beri border merah sedikit terang */
    }

    /* Hilangkan background bawaan dari icon sorting DataTables */
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background-image: none !important; /* Jika icon bawaan mengganggu */
        background-color: #8B0000 !important;
    }
    
    /* Pastikan teks tetap putih saat di-hover */
    #dataTable thead th:hover {
        background-color: #a50000 !important; /* Merah sedikit lebih terang saat hover */
        color: #ffffff !important;
    }
    
    /* 1. Paksa Container agar tidak meluber */
    #content-wrapper {
        overflow-x: hidden; /* Mencegah seluruh halaman ikut geser */
    }

    /* 2. Styling Header Tabel (Marun) */
    #dataTable thead th {
        background-color: #8B0000 !important;
        color: #ffffff !important;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        text-transform: capitalize;
    }

    /* 3. Perbaikan Responsive Scroll */
    .table-responsive {
        width: 100% !important;
        margin: 0px;
        padding: 0px;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }

    #dataTable {
        width: 100% !important;
        margin: 0 auto;
    }

    /* Warna Status */
    .bg-h3 { background-color: #fff3cd !important; }
    .bg-h { background-color: #ffe5b4 !important; }
    .bg-overdue { background-color: #f8d7da !important; }
</style>

                    <div class="card-body">
<form id="formFilter" method="GET" style="margin-bottom:10px;">                   
     <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
        Dari: 
<input type="date" name="tgl_awal" id="tgl_awal" value="<?= $this->input->get('tgl_awal'); ?>">
        Sampai: 
<input type="date" name="tgl_akhir" id="tgl_akhir" value="<?= $this->input->get('tgl_akhir'); ?>">

        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <button type="button" id="resetFilter" class="btn btn-secondary btn-sm">Reset</button>
    </form>

<div id="table_quo" class="table-responsive">
        <?php $this->load->view('user/quotation/_table_quo'); ?>
    </div>
    </div>
                     
<!-- modal update -->
 

            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
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



<script>
$(document).ready(function() {

    // ===============================
    // INIT DATATABLE
    // ===============================
    function jalankanDataTable() {
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().clear().destroy();
        }

        let table = $('#dataTable').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            info: true,
            autoWidth: false,
            responsive: false,
            scrollX: true,
            order: [[2, "desc"]],
            destroy: true,
            stateSave: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            }
        });

        // 🔥 FIX WIDTH DI SINI (BENAR)
        setTimeout(function() {
            table.columns.adjust().draw();
        }, 100);
    }


    // WAJIB: jalankan pertama kali
    jalankanDataTable();


    // ===============================
    // FILTER (SUBMIT)
    // ===============================
    $(document).on('submit', '#formFilter', function(e) {
        e.preventDefault();

        console.log("FILTER JALAN");

        let data = $(this).serialize();

        $.ajax({
            url: "<?= base_url('user/quotation/ajax_filter_quo') ?>",
            type: "GET",
            data: data,
            cache: false,
            beforeSend: function() {
                $('#table_quo').html('<div class="text-center p-5">Loading...</div>');
            },
            success: function(response) {
                $('#table_quo').html(response);
                jalankanDataTable();
            }
        });
    });


    // ===============================
    // RESET (FIX 100%)
    // ===============================
    $(document).on('click', '#resetFilter', function(e) {
        e.preventDefault();

        console.log("RESET FIX 🔥");

        // reset form
        $('#formFilter')[0].reset();

        // reset flatpickr (kalau ada)
        if ($('#tgl_awal')[0]._flatpickr) {
            $('#tgl_awal')[0]._flatpickr.clear();
        }
        if ($('#tgl_akhir')[0]._flatpickr) {
            $('#tgl_akhir')[0]._flatpickr.clear();
        }

        // destroy table
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().clear().destroy();
        }

        // AJAX tanpa parameter
        $.ajax({
            url: "<?= base_url('user/quotation/ajax_filter_quo') ?>",
            type: "GET",
            data: {}, // 🔥 BENAR-BENAR KOSONG
            cache: false,
            beforeSend: function() {
                $('#table_quo').html('<div class="text-center p-5">Reset Data...</div>');
            },
            success: function(response) {
                $('#table_quo').html(response);
                jalankanDataTable();
            }
        });

        // bersihkan URL
        window.history.replaceState(null, null, window.location.pathname);
    });

});
</script>

<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>


</body>
</html>