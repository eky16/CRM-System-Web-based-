<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        .file-upload {
            background-color: #A9A9A9;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: #A9A9A9;
            border: none;
            padding: 7px;
            border-radius: 4px;
            border-bottom: 4px solid #A9A9A9;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #adade2;
            color: #636367;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #636367;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #eff0f5;
            border: 4px dashed #3336ff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #aaabc2;
            padding: 10px 0;
        }

        .file-upload-image {
            width: 70%;
            height: auto;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 50%;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 200;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        #hidden_div {
            display: none;
        }

        #hidden_tgl {
            display: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>


        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('mom/lihat_semua') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                            <?php if (isset($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>
                        </div>
                    </div>
                    <hr>
                    <form action="<?= base_url('user/karyawan/proses_ubah_password' . $emp->id) ?>" enctype="multipart/form-data" id="form-tambah" method="POST" onsubmit="return validation(this)">


                     
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $emp->nama_karyawan . ' - '.$emp->divisi. ' '.$emp->department; ?></h6>
                                </div>
                                    <div class="card-body">

                                        <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NIK </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->kode ?>" readonly class="form-control">
                                </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label for="nama_karyawan"><strong>Nama</strong></label>
                                            <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="nama_karyawan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->nama_karyawan ?>" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Username </strong></label>
                                             <input type="text" maxlength="50" name="username" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->username ?>"  class="form-control">
                                </div>

                                        <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Password </strong></label>
                                             <input type="text" maxlength="50" name="password" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->password ?>"  class="form-control">
                                </div>

                                        
                                       
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
            <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>

    <?php $this->load->view('user/partials/js.php') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('.ubah-password').on('click', function(event) {
        event.preventDefault(); // Mencegah tindakan default dari tautan
        alert('Fitur ....');
    });
});
</script>

</body>
</html>
