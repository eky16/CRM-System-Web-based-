<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
<style media="screen">
.btn-md {
    padding: 1rem 2.4rem;
    font-size: .94rem;
    display: none;
}
.swal2-popup {
    font-family: inherit;
    font-size: 1.2rem;}
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>
    <?php if ($this->session->flashdata('success')) { ?>
<script>
    swal("Sukses!", "<?= $this->session->flashdata('success') ?>", "success");
</script>
     <?php } ?>
    <?php if ($this->session->flashdata('info')) { ?>
<script>
    swal("Sukses!", "<?= $this->session->flashdata('info') ?>", "info");
</script>
     <?php } ?>
         <?php if ($this->session->flashdata('error')) { ?>
<script>
 swal("Gagal!", "<?= $this->session->flashdata('error') ?>", "error");
</script>    <?php } ?>

 
<div class="card-header">
           

	<div class="card-body">
 <?php
                    $attributes = array('id' => 'button');
                    echo form_open('user/pembelian/cek_id', $attributes); ?>
                    <div id="sourceSelectPanel" style="display:none">
                        
                        <select id="sourceSelect" style="max-width:100px"></select>
                    </div>
                    <div>
                        <video id="video" width="500" height="400" style="border: 1px solid gray"></video>
                    </div>
                    <textarea hidden="" name="id_karyawan" id="result" readonly></textarea>
                    <span>  <input type="submit"  id="button" class="btn btn-success btn-md" value="Cek Kehadiran"></span>
                    <?php echo form_close(); ?>
	
    </div>
</div>

 


			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>sb-admin/zxing/zxing.min.js"></script>
<script type="text/javascript">
window.addEventListener('load', function () {
    let selectedDeviceId;
    let audio = new Audio("assets/audio/beep.mp3");
    const codeReader = new ZXing.BrowserQRCodeReader()
    console.log('ZXing code reader initialized')
    codeReader.getVideoInputDevices()
    .then((videoInputDevices) => {
        const sourceSelect = document.getElementById('sourceSelect')
        selectedDeviceId = videoInputDevices[0].deviceId
        if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
                const sourceOption = document.createElement('option')
                sourceOption.text = element.label
                sourceOption.value = element.deviceId
                sourceSelect.appendChild(sourceOption)
            })
            sourceSelect.onchange = () => {
                selectedDeviceId = sourceSelect.value;
            };
            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
        }
        codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
            console.log(result)
            document.getElementById('result').textContent = result.text
            if(result != null){
                audio.play();
            }
            $('#button').submit();
        }).catch((err) => {
            console.error(err)
            document.getElementById('result').textContent = err
        })
        console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
    })
    .catch((err) => {
        console.error(err)
    })
})
</script>
</body>
</html>