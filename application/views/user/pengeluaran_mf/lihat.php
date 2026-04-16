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
            <div id="content" data-url="<?= base_url('user/mf') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right">
                    <!--    <a href="<?= base_url('user/mf/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->

                    <?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
                        <a href="<?= base_url('user/mf/tambah_mf') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>

                    <?php endif; ?>
                        
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
                        <div class="card-header">
                            <div class="float-right"> 
                            <a  data-toggle="modal" style="color:white" data-target="#readme" class="btn btn-danger btn-sm"><i class="fa fa-book"></i>&nbsp;&nbsp;Read Me !!!</a>
                            </div>


                            <font color="blue"><strong>Data Pengeluaran</strong></font> / <a  href="<?php echo base_url(); ?>user/mf/list_pengeluaran_all_mf "><strong>All Data Pengeluaran MF</strong></a> / <a  href="<?php echo base_url(); ?>user/mf/laporan_pengeluaran "><strong> Laporan </strong></a></div>

                            <style>
    /* CSS untuk tabel */
    .colorful-table {
        border-collapse: collapse;
        width: 100%;
    }

    .colorful-table th,
    .colorful-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    /* CSS untuk warna sel tertentu */
    .color-Plum {
        background-color: Plum;
        color: black; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang merah */
    }

    .color-Brown {
        background-color: Brown;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang hijau */
    }
</style>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td class="color-Brown" >No</td>
                                        <td class="color-Brown" >No Keluar</td>
                                        <td class="color-Brown" >Nama</td>
                                        <td class="color-Brown" >Customer</td>
                                        <td class="color-Brown" >Tanggal Keluar</td>

                                        <?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
                                        <td class="color-Brown" >Aksi</td>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_pengeluaran_mf as $pengeluaran_mf): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $pengeluaran_mf->no_keluar ?></td>
                                            <td><?= $pengeluaran_mf->nama_petugas ?></td>
                                            <td><?= $pengeluaran_mf->nama_customer ?></td>
                                            <td><?= $pengeluaran_mf->tgl_keluar ?> <?= $pengeluaran_mf->jam_keluar ?></td>

                                            <?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
                                            <td>
                                                <a href="<?= base_url('user/mf/pengeluaran_detail_mf/' . $pengeluaran_mf->no_keluar) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                <a onclick="return confirm('Apakah Anda yakin ingin Hapus data Pengeluaran : <?= $pengeluaran_mf->no_keluar?>?')" href="<?= base_url('user/mf/hapus/' . $pengeluaran_mf->no_keluar) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>              
                </div>
                </div>
            </div>

            <!--Start Modal Readme-->

            <div id="readme" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">KOMPONEN MF</h4>
        </div>
 <form method="post" action="<?= base_url('mod_kerja/save_berkas_user') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Alba Unggul Metal</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
<!-- start isi -->
<style>
    /* CSS untuk tabel */
    .colorful-table {
        border-collapse: collapse;
        width: 100%;
    }

    .colorful-table th,
    .colorful-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    /* CSS untuk warna sel tertentu */
    .color-Crimson {
        background-color: Crimson;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang merah */
    }

    .color-green {
        background-color: green;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang hijau */
    }
</style>

<div class="table-responsive">
    <table class="colorful-table" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="color-Crimson" >No.</th>
                <th class="color-Crimson" >TYPE MF</th>
                <th class="color-Crimson" >QTY</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">TTP A S</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">TTP A D</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">SMPG S</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">SMPG D</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">BLKG S</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">BLKG D</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">RACK</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">BOX</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">CHS.S STAT</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">CHS.S DIN</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">CHS.D DIN</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">TTP CHS S</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">TTP CHS D</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">CNTL S</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">CNTL D</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">PNGMN</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">RELL</th>
                <th class="color-Crimson" style="writing-mode: vertical-lr; transform: rotate(180deg);">SAMB. RELL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>MF 4.18</td>
                <td>1-UNIT</td>
                <td>2</td><td>2</td>               
                <td>4</td><td>4</td>                
                <td>2</td><td>1</td>                
                <td>16</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>1</td><td>2</td>                
                <td>2</td><td>4</td>               
                <td>2</td><td>1</td>               
                <td>1</td><td>0</td>
                
            </tr>
            <tr>
                <td>2.</td>
                <td>MF 4.18</td>
                <td>2-UNIT</td><td>4</td>               
                <td>4</td><td>8</td>               
                <td>8</td><td>4</td>               
                <td>2</td><td>32</td>                
                <td>2</td><td>2</td>               
                <td>2</td><td>2</td>                
                <td>4</td><td>4</td>                
                <td>8</td><td>4</td>                
                <td>2</td><td>2</td>               
                <td>0</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>MF 4.18</td>
                <td>3-UNIT</td>
                <td>6</td><td>6</td>               
                <td>12</td><td>12</td>                
                <td>6</td><td>3</td>                
                <td>48</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>3</td><td>6</td>                
                <td>6</td><td>12</td>               
                <td>6</td><td>3</td>               
                <td>3</td><td>0</td>
                
            </tr>
            <tr>
                <td>4.</td>
                <td>MF 4.18</td>
                <td>4-UNIT</td>
                <td>8</td><td>8</td>               
                <td>16</td><td>16</td>                
                <td>8</td><td>4</td>                
                <td>64</td><td>3</td>                
                <td>34</td><td>4</td>                
                <td>4</td><td>8</td>                
                <td>8</td><td>16</td>               
                <td>8</td><td>4</td>               
                <td>4</td><td>0</td>
                
            </tr>
            <tr>
                <td>5.</td>
                <td>MF 4.18</td>
                <td>5-UNIT</td>
                <td>10</td><td>10</td>               
                <td>20</td><td>20</td>                
                <td>10</td><td>5</td>                
                <td>80</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>5</td><td>10</td>                
                <td>10</td><td>20</td>               
                <td>10</td><td>5</td>               
                <td>5</td><td>0</td>
                
            </tr>
             <tr>
                <td>6.</td>
                <td>MF 4.18</td>
                <td>6-UNIT</td>
                <td>12</td><td>12</td>               
                <td>24</td><td>24</td>                
                <td>12</td><td>6</td>                
                <td>96</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>6</td><td>12</td>                
                <td>12</td><td>24</td>               
                <td>12</td><td>6</td>               
                <td>6</td><td>0</td>
                
            </tr>
             <tr>
                <td>7.</td>
                <td>MF 4.18</td>
                <td>7-UNIT</td>
                <td>14</td><td>14</td>               
                <td>28</td><td>28</td>                
                <td>14</td><td>7</td>                
                <td>112</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>7</td><td>14</td>                
                <td>14</td><td>28</td>               
                <td>14</td><td>7</td>               
                <td>7</td><td>0</td>
                
            </tr>
            <tr>
                <td>8.</td>
                <td>MF 4.18</td>
                <td>8-UNIT</td>
                <td>16</td><td>16</td>               
                <td>32</td><td>32</td>                
                <td>16</td><td>8</td>                
                <td>128</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>8</td><td>16</td>                
                <td>16</td><td>32</td>               
                <td>16</td><td>8</td>               
                <td>8</td><td>0</td>
                
            </tr>
            <tr>
                <td>9.</td>
                <td>MF 4.18</td>
                <td>9-UNIT</td>
                <td>18</td><td>18</td>               
                <td>36</td><td>36</td>                
                <td>18</td><td>9</td>                
                <td>114</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>9</td><td>18</td>                
                <td>18</td><td>36</td>               
                <td>18</td><td>9</td>               
                <td>9</td><td>0</td>
                
            </tr>
            <tr>
                <td>10.</td>
                <td>MF 4.18</td>
                <td>10-UNIT</td>
                <td>20</td><td>20</td>               
                <td>40</td><td>40</td>                
                <td>20</td><td>10</td>                
                <td>160</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>10</td><td>20</td>                
                <td>20</td><td>40</td>               
                <td>20</td><td>10</td>               
                <td>10</td><td>0</td>
                
            </tr>
            <tr>
                <td>11.</td>
                <td>MF 4.22</td>
                <td>1-UNIT</td>
                <td>2</td><td>2</td>               
                <td>4</td><td>4</td>                
                <td>2</td><td>1</td>                
                <td>20</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>1</td><td>2</td>                
                <td>2</td><td>4</td>               
                <td>2</td><td>1</td>               
                <td>1</td><td>0</td>
                
            </tr>
            <tr>
                <td>12.</td>
                <td>MF 4.22</td>
                <td>2-UNIT</td>
                <td>4</td><td>4</td>               
                <td>8</td><td>8</td>                
                <td>4</td><td>2</td>                
                <td>40</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>2</td><td>4</td>                
                <td>4</td><td>8</td>               
                <td>4</td><td>2</td>               
                <td>2</td><td>0</td>                
            </tr>
            <tr>
                <td>13.</td>
                <td>MF 4.22</td>
                <td>3-UNIT</td>
                <td>6</td><td>6</td>               
                <td>12</td><td>12</td>                
                <td>6</td><td>3</td>                
                <td>60</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>3</td><td>6</td>                
                <td>6</td><td>12</td>               
                <td>6</td><td>3</td>               
                <td>3</td><td>0</td>                
            </tr>
            <tr>
                <td>14.</td>
                <td>MF 4.22</td>
                <td>4-UNIT</td>
                <td>8</td><td>8</td>               
                <td>16</td><td>16</td>                
                <td>8</td><td>4</td>                
                <td>80</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>4</td><td>8</td>                
                <td>8</td><td>16</td>               
                <td>8</td><td>4</td>               
                <td>4</td><td>0</td>                
            </tr>
            <tr>
                <td>15.</td>
                <td>MF 4.22</td>
                <td>5-UNIT</td>
                <td>10</td><td>10</td>               
                <td>20</td><td>20</td>                
                <td>10</td><td>5</td>                
                <td>100</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>5</td><td>10</td>                
                <td>10</td><td>20</td>               
                <td>10</td><td>5</td>               
                <td>5</td><td>0</td>                
            </tr>
            <tr>
                <td>16.</td>
                <td>MF 4.22</td>
                <td>6-UNIT</td>
                <td>12</td><td>12</td>               
                <td>24</td><td>24</td>                
                <td>12</td><td>6</td>                
                <td>120</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>6</td><td>12</td>                
                <td>12</td><td>24</td>               
                <td>12</td><td>6</td>               
                <td>6</td><td>0</td>                
            </tr>
            <tr>
                <td>17.</td>
                <td>MF 4.22</td>
                <td>7-UNIT</td>
                <td>14</td><td>14</td>               
                <td>28</td><td>28</td>                
                <td>14</td><td>7</td>                
                <td>140</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>7</td><td>14</td>                
                <td>14</td><td>28</td>               
                <td>14</td><td>7</td>               
                <td>7</td><td>0</td>                
            </tr>

            <tr>
                <td>18.</td>
                <td>MF 4.22</td>
                <td>8-UNIT</td>
                <td>16</td><td>16</td>               
                <td>32</td><td>32</td>                
                <td>16</td><td>8</td>                
                <td>160</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>8</td><td>16</td>                
                <td>16</td><td>32</td>               
                <td>16</td><td>8</td>               
                <td>8</td><td>0</td>                
            </tr>
            <tr>
                <td>19.</td>
                <td>MF 4.22</td>
                <td>9-UNIT</td>
                <td>18</td><td>18</td>               
                <td>36</td><td>36</td>                
                <td>18</td><td>9</td>                
                <td>180</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>9</td><td>18</td>                
                <td>18</td><td>36</td>               
                <td>18</td><td>9</td>               
                <td>9</td><td>0</td>                
            </tr>
            <tr>                            
                <td>20.</td>
                <td>MF 4.22</td>
                <td>10-UNIT</td>
                <td>20</td><td>20</td>               
                <td>40</td><td>40</td>                
                <td>20</td><td>10</td>                
                <td>200</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>10</td><td>20</td>                
                <td>20</td><td>40</td>               
                <td>20</td><td>10</td>               
                <td>10</td><td>0</td>                
            </tr>
            <tr>
                <td>21.</td>
                <td>MF 6.18</td>
                <td>1-UNIT</td>
                <td>2</td><td>4</td>               
                <td>4</td><td>8</td>                
                <td>2</td><td>2</td>                
                <td>24</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>2</td><td>2</td>                
                <td>4</td><td>4</td>               
                <td>4</td><td>0</td>               
                <td>1</td><td>1</td>                
            </tr>
            <tr>
                <td>22.</td>
                <td>MF 6.18</td>
                <td>2-UNIT</td>
                <td>4</td><td>8</td>               
                <td>8</td><td>16</td>                
                <td>4</td><td>4</td>                
                <td>48</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>4</td><td>4</td>                
                <td>8</td><td>8</td>               
                <td>8</td><td>4</td>               
                <td>2</td><td>2</td>                
            </tr>
            <tr>
                <td>23.</td>
                <td>MF 6.18</td>
                <td>3-UNIT</td>
                <td>6</td><td>12</td>               
                <td>12</td><td>24</td>                
                <td>6</td><td>6</td>                
                <td>72</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>6</td><td>6</td>                
                <td>12</td><td>12</td>               
                <td>12</td><td>6</td>               
                <td>3</td><td>3</td>                
            </tr>
            <tr>
                <td>24.</td>
                <td>MF 6.18</td>
                <td>4-UNIT</td>
                <td>8</td><td>16</td>               
                <td>16</td><td>32</td>                
                <td>8</td><td>8</td>                
                <td>96</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>8</td><td>8</td>                
                <td>16</td><td>16</td>               
                <td>16</td><td>8</td>               
                <td>4</td><td>4</td>                
            </tr>
            <tr>
                <td>25.</td>
                <td>MF 6.18</td>
                <td>5-UNIT</td>
                <td>10</td><td>20</td>               
                <td>20</td><td>40</td>                
                <td>10</td><td>10</td>                
                <td>120</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>10</td><td>10</td>                
                <td>20</td><td>20</td>               
                <td>20</td><td>10</td>               
                <td>5</td><td>5</td>                
            </tr>
            <tr>
                <td>26.</td>
                <td>MF 6.18</td>
                <td>6-UNIT</td>
                <td>12</td><td>24</td>               
                <td>24</td><td>48</td>                
                <td>12</td><td>12</td>                
                <td>144</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>12</td><td>12</td>                
                <td>24</td><td>24</td>               
                <td>24</td><td>12</td>               
                <td>6</td><td>6</td>                
            </tr>
            <tr>
                <td>27.</td>
                <td>MF 6.18</td>
                <td>7-UNIT</td>
                <td>14</td><td>28</td>               
                <td>28</td><td>56</td>                
                <td>14</td><td>14</td>                
                <td>168</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>14</td><td>14</td>                
                <td>28</td><td>28</td>               
                <td>28</td><td>14</td>               
                <td>7</td><td>7</td>                
            </tr>
            <tr>
                <td>28.</td>
                <td>MF 6.18</td>
                <td>8-UNIT</td>
                <td>16</td><td>32</td>               
                <td>32</td><td>64</td>                
                <td>16</td><td>16</td>                
                <td>192</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>16</td><td>16</td>                
                <td>32</td><td>32</td>               
                <td>32</td><td>16</td>               
                <td>8</td><td>8</td>                
            </tr>
            <tr>
                <td>29.</td>
                <td>MF 6.18</td>
                <td>9-UNIT</td>
                <td>18</td><td>36</td>               
                <td>36</td><td>72</td>                
                <td>18</td><td>18</td>                
                <td>216</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>18</td><td>18</td>                
                <td>36</td><td>36</td>               
                <td>36</td><td>18</td>               
                <td>9</td><td>9</td>                
            </tr>
            <tr>
                <td>30.</td>
                <td>MF 6.18</td>
                <td>10-UNIT</td>
                <td>20</td><td>40</td>               
                <td>40</td><td>20</td>                
                <td>20</td><td>20</td>                
                <td>240</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>20</td><td>20</td>                
                <td>40</td><td>40</td>               
                <td>40</td><td>20</td>               
                <td>10</td><td>10</td>                
            </tr>
            <tr>
                <td>31.</td>
                <td>MF 6.22</td>
                <td>1-UNIT</td>
                <td>2</td><td>4</td>               
                <td>4</td><td>8</td>                
                <td>2</td><td>2</td>                
                <td>30</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>2</td><td>2</td>                
                <td>4</td><td>4</td>               
                <td>4</td><td>2</td>               
                <td>1</td><td>1</td>                
            </tr>
            <tr>
                <td>32.</td>
                <td>MF 6.22</td>
                <td>2-UNIT</td>
                <td>4</td><td>8</td>               
                <td>8</td><td>16</td>                
                <td>4</td><td>4</td>                
                <td>60</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>4</td><td>4</td>                
                <td>8</td><td>8</td>               
                <td>8</td><td>4</td>               
                <td>2</td><td>2</td>                
            </tr>
            <tr>
                <td>33.</td>
                <td>MF 6.22</td>
                <td>3-UNIT</td>
                <td>6</td><td>12</td>               
                <td>12</td><td>24</td>                
                <td>6</td><td>6</td>                
                <td>90</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>6</td><td>6</td>                
                <td>12</td><td>12</td>               
                <td>12</td><td>6</td>               
                <td>3</td><td>3</td>                
            </tr>
            <tr>
                <td>34.</td>
                <td>MF 6.22</td>
                <td>4-UNIT</td>
                <td>8</td><td>16</td>               
                <td>16</td><td>32</td>                
                <td>8</td><td>8</td>                
                <td>120</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>8</td><td>8</td>                
                <td>16</td><td>16</td>               
                <td>16</td><td>8</td>               
                <td>4</td><td>4</td>                
            </tr>
            <tr>
                <td>35.</td>
                <td>MF 6.22</td>
                <td>5-UNIT</td>
                <td>10</td><td>20</td>               
                <td>20</td><td>40</td>                
                <td>10</td><td>10</td>                
                <td>150</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>10</td><td>10</td>                
                <td>20</td><td>20</td>               
                <td>20</td><td>10</td>               
                <td>5</td><td>5</td>                
            </tr>
            <tr>
                <td>36.</td>
                <td>MF 6.22</td>
                <td>6-UNIT</td>
                <td>12</td><td>24</td>               
                <td>24</td><td>48</td>                
                <td>12</td><td>12</td>                
                <td>180</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>12</td><td>12</td>                
                <td>24</td><td>24</td>               
                <td>24</td><td>12</td>               
                <td>6</td><td>6</td>                
            </tr>
            <tr>
                <td>37.</td>
                <td>MF 6.22</td>
                <td>7-UNIT</td>
                <td>14</td><td>28</td>               
                <td>28</td><td>56</td>                
                <td>14</td><td>14</td>                
                <td>210</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>14</td><td>14</td>                
                <td>28</td><td>28</td>               
                <td>28</td><td>14</td>               
                <td>7</td><td>7</td>                
            </tr>
            <tr>
                <td>38.</td>
                <td>MF 6.22</td>
                <td>8-UNIT</td>
                <td>16</td><td>32</td>               
                <td>32</td><td>64</td>                
                <td>16</td><td>16</td>                
                <td>240</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>16</td><td>16</td>                
                <td>32</td><td>32</td>               
                <td>32</td><td>16</td>               
                <td>8</td><td>8</td>                
            </tr>
            <tr>
                <td>39.</td>
                <td>MF 6.22</td>
                <td>9-UNIT</td>
                <td>18</td><td>36</td>               
                <td>36</td><td>72</td>                
                <td>18</td><td>18</td>                
                <td>270</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>18</td><td>18</td>                
                <td>36</td><td>36</td>               
                <td>36</td><td>18</td>               
                <td>9</td><td>9</td>                
            </tr>
            <tr>
                <td>40.</td>
                <td>MF 6.22</td>
                <td>10-UNIT</td>
                <td>20</td><td>40</td>               
                <td>40</td><td>80</td>                
                <td>20</td><td>20</td>                
                <td>300</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>20</td><td>20</td>                
                <td>40</td><td>40</td>               
                <td>40</td><td>20</td>               
                <td>10</td><td>10</td>                
            </tr>
            <tr>
                <td>41.</td>
                <td>MF 8.18</td>
                <td>1-UNIT</td>
                <td>2</td><td>6</td>               
                <td>4</td><td>12</td>                
                <td>2</td><td>3</td>                
                <td>32</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>3</td><td>2</td>                
                <td>6</td><td>4</td>               
                <td>6</td><td>2</td>               
                <td>1</td><td>2</td>                
            </tr>
            <tr>
                <td>42.</td>
                <td>MF 8.18</td>
                <td>2-UNIT</td>
                <td>4</td><td>12</td>               
                <td>8</td><td>24</td>                
                <td>4</td><td>6</td>                
                <td>64</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>6</td><td>4</td>                
                <td>12</td><td>8</td>               
                <td>12</td><td>4</td>               
                <td>2</td><td>4</td>                
            </tr>
            <tr>
                <td>43.</td>
                <td>MF 8.18</td>
                <td>3-UNIT</td>
                <td>6</td><td>18</td>               
                <td>12</td><td>36</td>                
                <td>6</td><td>9</td>                
                <td>96</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>9</td><td>6</td>                
                <td>18</td><td>12</td>               
                <td>18</td><td>6</td>               
                <td>3</td><td>6</td>                
            </tr>
            <tr>
                <td>44.</td>
                <td>MF 8.18</td>
                <td>4-UNIT</td>
                <td>8</td><td>24</td>               
                <td>16</td><td>48</td>                
                <td>8</td><td>12</td>                
                <td>128</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>12</td><td>8</td>                
                <td>24</td><td>16</td>               
                <td>24</td><td>8</td>               
                <td>4</td><td>8</td>                
            </tr>
            <tr>
                <td>45.</td>
                <td>MF 8.18</td>
                <td>5-UNIT</td>
                <td>10</td><td>30</td>               
                <td>20</td><td>60</td>                
                <td>10</td><td>15</td>                
                <td>160</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>15</td><td>10</td>                
                <td>30</td><td>20</td>               
                <td>30</td><td>10</td>               
                <td>5</td><td>10</td>                
            </tr>
            <tr>
                <td>45.</td>
                <td>MF 8.18</td>
                <td>5-UNIT</td>
                <td>10</td><td>30</td>               
                <td>20</td><td>60</td>                
                <td>10</td><td>15</td>                
                <td>160</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>15</td><td>10</td>                
                <td>30</td><td>20</td>               
                <td>30</td><td>10</td>               
                <td>5</td><td>10</td>                
            </tr>
            <tr>
                <td>46.</td>
                <td>MF 8.18</td>
                <td>6-UNIT</td>
                <td>12</td><td>36</td>               
                <td>24</td><td>72</td>                
                <td>12</td><td>18</td>                
                <td>192</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>18</td><td>12</td>                
                <td>36</td><td>24</td>               
                <td>36</td><td>12</td>               
                <td>6</td><td>12</td>                
            </tr>
            <tr>
                <td>47.</td>
                <td>MF 8.18</td>
                <td>7-UNIT</td>
                <td>14</td><td>42</td>               
                <td>28</td><td>84</td>                
                <td>14</td><td>21</td>                
                <td>224</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>21</td><td>14</td>                
                <td>42</td><td>28</td>               
                <td>42</td><td>14</td>               
                <td>7</td><td>14</td>                
            </tr>
            <tr>
                <td>48.</td>
                <td>MF 8.18</td>
                <td>8-UNIT</td>
                <td>16</td><td>48</td>               
                <td>32</td><td>96</td>                
                <td>16</td><td>24</td>                
                <td>256</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>24</td><td>16</td>                
                <td>48</td><td>32</td>               
                <td>48</td><td>16</td>               
                <td>8</td><td>16</td>                
            </tr>
            <tr>
                <td>49.</td>
                <td>MF 8.18</td>
                <td>9-UNIT</td>
                <td>18</td><td>54</td>               
                <td>36</td><td>108</td>                
                <td>18</td><td>27</td>                
                <td>288</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>27</td><td>18</td>                
                <td>54</td><td>36</td>               
                <td>54</td><td>18</td>               
                <td>9</td><td>18</td>                
            </tr>
            <tr>
                <td>50.</td>
                <td>MF 8.18</td>
                <td>10-UNIT</td>
                <td>20</td><td>60</td>               
                <td>40</td><td>120</td>                
                <td>20</td><td>30</td>                
                <td>320</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>30</td><td>20</td>                
                <td>60</td><td>40</td>               
                <td>60</td><td>20</td>               
                <td>10</td><td>20</td>                
            </tr>
            <tr>
                <td>51.</td>
                <td>MF 8.22</td>
                <td>1-UNIT</td>
                <td>2</td><td>6</td>               
                <td>4</td><td>12</td>                
                <td>2</td><td>3</td>                
                <td>40</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>3</td><td>2</td>                
                <td>6</td><td>4</td>               
                <td>6</td><td>2</td>               
                <td>1</td><td>2</td>                
            </tr>
            <tr>
                <td>52.</td>
                <td>MF 8.22</td>
                <td>2-UNIT</td>
                <td>4</td><td>12</td>               
                <td>8</td><td>24</td>                
                <td>4</td><td>6</td>                
                <td>80</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>6</td><td>4</td>                
                <td>12</td><td>8</td>               
                <td>12</td><td>4</td>               
                <td>2</td><td>4</td>                
            </tr>
            <tr>
                <td>53.</td>
                <td>MF 8.22</td>
                <td>3-UNIT</td>
                <td>6</td><td>18</td>               
                <td>12</td><td>36</td>                
                <td>6</td><td>9</td>                
                <td>120</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>9</td><td>6</td>                
                <td>18</td><td>12</td>               
                <td>18</td><td>6</td>               
                <td>3</td><td>6</td>                
            </tr>
            <tr>
                <td>54.</td>
                <td>MF 8.22</td>
                <td>4-UNIT</td>
                <td>8</td><td>24</td>               
                <td>16</td><td>48</td>                
                <td>8</td><td>12</td>                
                <td>160</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>12</td><td>8</td>                
                <td>24</td><td>16</td>               
                <td>24</td><td>8</td>               
                <td>4</td><td>8</td>                
            </tr>
            <tr>
                <td>55.</td>
                <td>MF 8.22</td>
                <td>5-UNIT</td>
                <td>10</td><td>30</td>               
                <td>20</td><td>60</td>                
                <td>10</td><td>15</td>                
                <td>200</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>15</td><td>10</td>                
                <td>30</td><td>20</td>               
                <td>30</td><td>10</td>               
                <td>5</td><td>10</td>                
            </tr>
            <tr>
                <td>56.</td>
                <td>MF 8.22</td>
                <td>6-UNIT</td>
                <td>12</td><td>36</td>               
                <td>24</td><td>72</td>                
                <td>12</td><td>18</td>                
                <td>240</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>18</td><td>12</td>                
                <td>36</td><td>24</td>               
                <td>36</td><td>12</td>               
                <td>6</td><td>12</td>                
            </tr>
            <tr>
                <td>57.</td>
                <td>MF 8.22</td>
                <td>7-UNIT</td>
                <td>14</td><td>42</td>               
                <td>28</td><td>84</td>                
                <td>14</td><td>21</td>                
                <td>280</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>21</td><td>14</td>                
                <td>42</td><td>28</td>               
                <td>42</td><td>14</td>               
                <td>7</td><td>14</td>                
            </tr>
            <tr>
                <td>58.</td>
                <td>MF 8.22</td>
                <td>8-UNIT</td>
                <td>16</td><td>48</td>               
                <td>24</td><td>72</td>                
                <td>16</td><td>18</td>                
                <td>240</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>18</td><td>16</td>                
                <td>38</td><td>24</td>               
                <td>38</td><td>16</td>               
                <td>8</td><td>16</td>                
            </tr>
            <tr>
                <td>59.</td>
                <td>MF 8.22</td>
                <td>9-UNIT</td>
                <td>18</td><td>54</td>               
                <td>36</td><td>108</td>                
                <td>18</td><td>27</td>                
                <td>360</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>27</td><td>18</td>                
                <td>54</td><td>36</td>               
                <td>54</td><td>18</td>               
                <td>9</td><td>18</td>                
            </tr>
            <tr>
                <td>60.</td>
                <td>MF 8.22</td>
                <td>10-UNIT</td>
                <td>20</td><td>60</td>               
                <td>40</td><td>120</td>                
                <td>20</td><td>30</td>                
                <td>400</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>30</td><td>20</td>                
                <td>60</td><td>40</td>               
                <td>60</td><td>20</td>               
                <td>10</td><td>20</td>                
            </tr>
            <tr>
                <td>61.</td>
                <td>MF 10.18</td>
                <td>1-UNIT</td>
                <td>2</td><td>8</td>               
                <td>4</td><td>16</td>                
                <td>2</td><td>4</td>                
                <td>40</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>4</td><td>2</td>                
                <td>8</td><td>4</td>               
                <td>8</td><td>2</td>               
                <td>1</td><td>3</td>                
            </tr>
            <tr>
                <td>62.</td>
                <td>MF 10.18</td>
                <td>2-UNIT</td>
                <td>4</td><td>16</td>               
                <td>8</td><td>32</td>                
                <td>4</td><td>8</td>                
                <td>80</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>8</td><td>4</td>                
                <td>16</td><td>8</td>               
                <td>16</td><td>4</td>               
                <td>2</td><td>6</td>                
            </tr>
            <tr>
                <td>63.</td>
                <td>MF 10.18</td>
                <td>3-UNIT</td>
                <td>6</td><td>24</td>               
                <td>12</td><td>48</td>                
                <td>6</td><td>12</td>                
                <td>120</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>12</td><td>6</td>                
                <td>24</td><td>12</td>               
                <td>24</td><td>6</td>               
                <td>3</td><td>9</td>                
            </tr>
            <tr>
                <td>64.</td>
                <td>MF 10.18</td>
                <td>4-UNIT</td>
                <td>8</td><td>32</td>               
                <td>16</td><td>64</td>                
                <td>8</td><td>16</td>                
                <td>160</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>16</td><td>8</td>                
                <td>32</td><td>16</td>               
                <td>32</td><td>8</td>               
                <td>4</td><td>12</td>                
            </tr>
            <tr>
                <td>65.</td>
                <td>MF 10.18</td>
                <td>5-UNIT</td>
                <td>10</td><td>40</td>               
                <td>20</td><td>80</td>                
                <td>10</td><td>20</td>                
                <td>200</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>20</td><td>10</td>                
                <td>40</td><td>20</td>               
                <td>40</td><td>10</td>               
                <td>5</td><td>15</td>                
            </tr>
            <tr>
                <td>66.</td>
                <td>MF 10.18</td>
                <td>6-UNIT</td>
                <td>12</td><td>48</td>               
                <td>24</td><td>96</td>                
                <td>12</td><td>24</td>                
                <td>240</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>24</td><td>12</td>                
                <td>48</td><td>24</td>               
                <td>48</td><td>12</td>               
                <td>6</td><td>18</td>                
            </tr>
            <tr>
                <td>67.</td>
                <td>MF 10.18</td>
                <td>7-UNIT</td>
                <td>14</td><td>56</td>               
                <td>28</td><td>112</td>                
                <td>14</td><td>28</td>                
                <td>280</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>28</td><td>14</td>                
                <td>56</td><td>28</td>               
                <td>56</td><td>14</td>               
                <td>7</td><td>21</td>                
            </tr>
            <tr>
                <td>68.</td>
                <td>MF 10.18</td>
                <td>8-UNIT</td>
                <td>16</td><td>64</td>               
                <td>32</td><td>128</td>                
                <td>16</td><td>32</td>                
                <td>320</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>32</td><td>16</td>                
                <td>64</td><td>32</td>               
                <td>64</td><td>16</td>               
                <td>8</td><td>24</td>                
            </tr>
            <tr>
                <td>69.</td>
                <td>MF 10.18</td>
                <td>9-UNIT</td>
                <td>18</td><td>72</td>               
                <td>36</td><td>144</td>                
                <td>18</td><td>36</td>                
                <td>360</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>36</td><td>18</td>                
                <td>72</td><td>36</td>               
                <td>72</td><td>18</td>               
                <td>9</td><td>27</td>                
            </tr>
            <tr>
                <td>70.</td>
                <td>MF 10.18</td>
                <td>10-UNIT</td>
                <td>20</td><td>80</td>               
                <td>40</td><td>160</td>                
                <td>20</td><td>40</td>                
                <td>400</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>40</td><td>20</td>                
                <td>80</td><td>40</td>               
                <td>80</td><td>20</td>               
                <td>10</td><td>30</td>                
            </tr>
            <tr>
                <td>71.</td>
                <td>MF 10.22</td>
                <td>1-UNIT</td>
                <td>2</td><td>8</td>               
                <td>4</td><td>16</td>                
                <td>2</td><td>4</td>                
                <td>50</td><td></td>                
                <td></td><td></td>                
                <td>4</td><td>2</td>                
                <td>8</td><td>4</td>               
                <td>8</td><td>2</td>               
                <td>1</td><td>3</td>                
            </tr>
            <tr>
                <td>72.</td>
                <td>MF 10.22</td>
                <td>2-UNIT</td>
                <td>4</td><td>16</td>               
                <td>8</td><td>32</td>                
                <td>4</td><td>8</td>                
                <td>100</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>8</td><td>4</td>                
                <td>16</td><td>8</td>               
                <td>16</td><td>4</td>               
                <td>2</td><td>6</td>                
            </tr>
            <tr>
                <td>73.</td>
                <td>MF 10.22</td>
                <td>3-UNIT</td>
                <td>6</td><td>24</td>               
                <td>12</td><td>48</td>                
                <td>6</td><td>12</td>                
                <td>150</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>12</td><td>6</td>                
                <td>24</td><td>12</td>               
                <td>24</td><td>6</td>               
                <td>3</td><td>9</td>                
            </tr>
            <tr>
                <td>74.</td>
                <td>MF 10.22</td>
                <td>4-UNIT</td>
                <td>8</td><td>32</td>               
                <td>16</td><td>64</td>                
                <td>8</td><td>16</td>                
                <td>200</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>16</td><td>8</td>                
                <td>32</td><td>16</td>               
                <td>32</td><td>8</td>               
                <td>4</td><td>12</td>                
            </tr>
            <tr>
                <td>75.</td>
                <td>MF 10.22</td>
                <td>5-UNIT</td>
                <td>10</td><td>40</td>               
                <td>20</td><td>80</td>                
                <td>10</td><td>20</td>                
                <td>250</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>20</td><td>10</td>                
                <td>40</td><td>20</td>               
                <td>40</td><td>10</td>               
                <td>5</td><td>15</td>                
            </tr>
            <tr>
                <td>76.</td>
                <td>MF 10.22</td>
                <td>6-UNIT</td>
                <td>12</td><td>48</td>               
                <td>24</td><td>96</td>                
                <td>12</td><td>24</td>                
                <td>300</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>24</td><td>12</td>                
                <td>48</td><td>24</td>               
                <td>48</td><td>12</td>               
                <td>6</td><td>18</td>                
            </tr>
            <tr>
                <td>77.</td>
                <td>MF 10.22</td>
                <td>7-UNIT</td>
                <td>14</td><td>56</td>               
                <td>28</td><td>112</td>                
                <td>14</td><td>28</td>                
                <td>350</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>28</td><td>14</td>                
                <td>56</td><td>28</td>               
                <td>56</td><td>14</td>               
                <td>7</td><td>21</td>                
            </tr>
            <tr>
                <td>78.</td>
                <td>MF 10.22</td>
                <td>8-UNIT</td>
                <td>16</td><td>64</td>               
                <td>32</td><td>128</td>                
                <td>16</td><td>32</td>                
                <td>400</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>32</td><td>16</td>                
                <td>64</td><td>32</td>               
                <td>64</td><td>16</td>               
                <td>8</td><td>24</td>                
            </tr>
            <tr>
                <td>79.</td>
                <td>MF 10.22</td>
                <td>9-UNIT</td>
                <td>18</td><td>72</td>               
                <td>36</td><td>144</td>                
                <td>18</td><td>36</td>                
                <td>450</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>36</td><td>18</td>                
                <td>72</td><td>36</td>               
                <td>72</td><td>18</td>               
                <td>9</td><td>27</td>                
            </tr>
            <tr>
                <td>80.</td>
                <td>MF 10.22</td>
                <td>10-UNIT</td>
                <td>20</td><td>80</td>               
                <td>40</td><td>160</td>                
                <td>20</td><td>40</td>                
                <td>500</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>40</td><td>20</td>                
                <td>80</td><td>40</td>               
                <td>80</td><td>20</td>               
                <td>10</td><td>30</td>                
            </tr>
            <tr>
                <td>81.</td>
                <td>MF 12.22</td>
                <td>1-UNIT</td>
                <td>2</td><td>10</td>               
                <td>4</td><td>20</td>                
                <td>2</td><td>5</td>                
                <td>60</td><td>1</td>                
                <td>1</td><td>1</td>                
                <td>5</td><td>2</td>                
                <td>10</td><td>4</td>               
                <td>10</td><td>2</td>               
                <td>1</td><td>4</td>                
            </tr>
            <tr>
                <td>82.</td>
                <td>MF 12.22</td>
                <td>2-UNIT</td>
                <td>4</td><td>20</td>               
                <td>8</td><td>40</td>                
                <td>4</td><td>10</td>                
                <td>120</td><td>2</td>                
                <td>2</td><td>2</td>                
                <td>10</td><td>4</td>                
                <td>20</td><td>8</td>               
                <td>20</td><td>4</td>               
                <td>2</td><td>8</td>                
            </tr>
            <tr>
                <td>83.</td>
                <td>MF 12.22</td>
                <td>3-UNIT</td>
                <td>6</td><td>30</td>               
                <td>12</td><td>60</td>                
                <td>6</td><td>15</td>                
                <td>180</td><td>3</td>                
                <td>3</td><td>3</td>                
                <td>15</td><td>6</td>                
                <td>30</td><td>12</td>               
                <td>30</td><td>6</td>               
                <td>3</td><td>12</td>                
            </tr>
            <tr>
                <td>84.</td>
                <td>MF 12.22</td>
                <td>4-UNIT</td>
                <td>8</td><td>40</td>               
                <td>16</td><td>80</td>                
                <td>8</td><td>20</td>                
                <td>240</td><td>4</td>                
                <td>4</td><td>4</td>                
                <td>20</td><td>8</td>                
                <td>40</td><td>16</td>               
                <td>40</td><td>8</td>               
                <td>4</td><td>16</td>                
            </tr>
            <tr>
                <td>85.</td>
                <td>MF 12.22</td>
                <td>5-UNIT</td>
                <td>10</td><td>50</td>               
                <td>20</td><td>100</td>                
                <td>10</td><td>25</td>                
                <td>300</td><td>5</td>                
                <td>5</td><td>5</td>                
                <td>25</td><td>10</td>                
                <td>50</td><td>20</td>               
                <td>50</td><td>10</td>               
                <td>5</td><td>20</td>                
            </tr>
            <tr>
                <td>86.</td>
                <td>MF 12.22</td>
                <td>6-UNIT</td>
                <td>12</td><td>60</td>               
                <td>24</td><td>120</td>                
                <td>12</td><td>30</td>                
                <td>360</td><td>6</td>                
                <td>6</td><td>6</td>                
                <td>30</td><td>12</td>                
                <td>60</td><td>24</td>               
                <td>60</td><td>12</td>               
                <td>6</td><td>24</td>                
            </tr>
            <tr>
                <td>87.</td>
                <td>MF 12.22</td>
                <td>7-UNIT</td>
                <td>14</td><td>70</td>               
                <td>28</td><td>140</td>                
                <td>14</td><td>35</td>                
                <td>420</td><td>7</td>                
                <td>7</td><td>7</td>                
                <td>35</td><td>14</td>                
                <td>70</td><td>28</td>               
                <td>70</td><td>14</td>               
                <td>7</td><td>28</td>                
            </tr>
            <tr>
                <td>88.</td>
                <td>MF 12.22</td>
                <td>8-UNIT</td>
                <td>16</td><td>80</td>               
                <td>32</td><td>160</td>                
                <td>16</td><td>40</td>                
                <td>480</td><td>8</td>                
                <td>8</td><td>8</td>                
                <td>40</td><td>16</td>                
                <td>80</td><td>32</td>               
                <td>80</td><td>16</td>               
                <td>8</td><td>32</td>                
            </tr>
            <tr>
                <td>89.</td>
                <td>MF 12.22</td>
                <td>9-UNIT</td>
                <td>18</td><td>90</td>               
                <td>36</td><td>180</td>                
                <td>18</td><td>45</td>                
                <td>540</td><td>9</td>                
                <td>9</td><td>9</td>                
                <td>45</td><td>18</td>                
                <td>90</td><td>36</td>               
                <td>90</td><td>18</td>               
                <td>9</td><td>36</td>                
            </tr>
            <tr>
                <td>90.</td>
                <td>MF 12.22</td>
                <td>10-UNIT</td>
                <td>20</td><td>100</td>               
                <td>40</td><td>200</td>                
                <td>20</td><td>50</td>                
                <td>600</td><td>10</td>                
                <td>10</td><td>10</td>                
                <td>50</td><td>20</td>                
                <td>100</td><td>40</td>               
                <td>100</td><td>20</td>               
                <td>10</td><td>40</td>                
            </tr>
            
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

<!-- end isi -->
                                </div>

   
                                        <hr>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- end modal -->

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