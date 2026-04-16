<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>


img {
  width: 100%;
  max-width: 480px;
  height: auto;
}
.container {
  position: relative;
  text-align: center;
  color: white;
}

.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}

.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

.bottom-right {
  position: absolute;
  bottom: 9px;
  right: 10px;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

div.example {
  background-color: silver;
  padding: 0px;
opacity: 1;
}


.map-responsive{

    overflow:hidden;

    padding-bottom:56.25%;

    position:relative;

    width:250px;

}

.map-responsive iframe{

    left:0;

    top:0;

    height:100%;
    width:100%;

    position:absolute;

}
 


</style>
</head>
<body>


<div class="container">

  <img src="<?php echo base_url(); ?>img/uploads/foto_kehadiran/<?= $absensi->foto2 ?>" alt="Snow" >

  <div class="bottom-right ">
    <div class="example">
     Absen Pulang  <?= $absensi->cek_out ?>
    </div>
 


<div class="map-responsive">
<iframe  id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $absensi->lokasi_cekout; ?>&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>


</div>
 


  </div>
</div>

</body>
</html> 
  