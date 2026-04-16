<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('user/riwayat_stok_2') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right">
                    <!--    <a href="<?= base_url('user/pengeluaran/export_detail/' . $pengeluaran->no_keluar) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
                    <button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button> 
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
                    <div class="card-header"><strong><?= $title ?> - <?= $pengeluaran->no_keluar ?></strong></div>
                    <div class="card-body">
                    <!--        <div class="row">
                            <div class="col-md-6">
                            <table class="table table-borderless">
                                    <tr>
                                        <td><strong>No Keluar</strong></td>
                                        <td>:</td>
                                        <td><?= $pengeluaran->no_keluar ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Admin</strong></td>
                                        <td>:</td>
                                        <td><?= $pengeluaran->nama_petugas ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Waktu </strong></td>
                                        <td>:</td>
                                        <td><?= $pengeluaran->tgl_keluar ?> - <?= $pengeluaran->jam_keluar ?></td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                        <hr>-->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td width="1"><strong>No</strong></td>
                                            <td><strong>Waktu</strong></td>
                                            <td width="100"><strong>In</strong></td>
                                             <td width="100"><strong>Out</strong></td>
                                            <td><strong>Ready</strong></td>
                                           
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php $no = 1; // Inisialisasi nomor urut ?>
    <?php foreach ($all_detail_pengeluaran as $detail_pengeluaran): ?>
        <?php foreach ($all_detail_penerimaan as $detail_penerimaan): ?>
            <?php if ($detail_pengeluaran->nama_barang == $detail_penerimaan->nama_barang): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $detail_pengeluaran->tgl_keluar ?> - <?= $detail_pengeluaran->jam_keluar ?></td>
                    <td><?= $detail_penerimaan->tgl_terima ?> - <?= $detail_penerimaan->jam_terima ?></td>
                    <td><font size="2px"><?= $detail_pengeluaran->total_in ?></font></td>
                    <td>
                        <?php
                        $total_out = 0;
                        foreach ($out_barang as $out) {
                            if (!empty($out) && $detail_pengeluaran->Nama_Barang == $out->nama_barang) {
                                $total_out += $out->total_out;
                            }
                        }
                        echo $total_out;
                        ?>
                    </td>
                    <td align="center"><font size="2px"><?= $row->Stok ?></font></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</tbody>
                                    
                                </table>
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
    <?php $this->load->view('user/partials/js.php') ?>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>