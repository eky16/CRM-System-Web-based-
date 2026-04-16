<!DOCTYPE html>
<html>
<head>
  <title><?= $ket ?></title>
</head>
<body>
<style type="text/css">
  body{
    font-family: sans-serif;
  }
  table{
    margin: 20px auto;
    border-collapse: collapse;
  }
  table th,
  table td{
    border: 1px solid #3c3c3c;
    padding: 3px 8px;

  }
  a{
    background: blue;
    color: #fff;
    padding: 8px 10px;
    text-decoration: none;
    border-radius: 2px;
  }
  .num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
  </style>
<?php $tanggl = date('Y-m-d', strtotime($_GET['tanggal']));?>
<?php $dan_tanggl = date('Y-m-d', strtotime($_GET['dan_tanggal']));?>

<?php $jenis_tanggl = $_GET['jenis_tanggal']; ?>


  <?php
  header("Content-Type:application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=JADWAL PRODUKSI " .$tanggl." Sd ".$dan_tanggl." .xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="8"  align="center"><p align="center"><font size="13px"><strong>JADWAL PRODUKSI  - <?php echo date('d F, Y', strtotime($_GET['tanggal']));?>  S/d <?php echo date('d F, Y', strtotime($_GET['dan_tanggal']));?>  </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="center" width="200"><font size="10px">No. WO</font></th>
            <th  align="center" width="200"><font size="10px">Tgl Pesan</font></th>
            <th  align="center" width="200"><font size="10px">Tgl Kirim</font></th>
            <th  align="center" width="200"><font size="10px">Customer</font></th>
            <th  align="center" width="200"><font size="10px">Nama Barang</font></th>
            <th  align="center" width="100"><font size="10px">Jumlah</font></th>
            <th  align="center" width="100"><font size="10px">Satuan</font></th>
            <th  align="center" width="100"><font size="10px">Cut.</font></th>
            <th  align="center" width="100"><font size="10px">Pun.</font></th>
            <th  align="center" width="100"><font size="10px">Ben.</font></th>
            <th  align="center" width="100"><font size="10px">Wel.</font></th>
            <th  align="center" width="100"><font size="10px">PS</font></th>
            <th  align="center" width="100"><font size="10px">FA</font></th>
            <th  align="center" width="100"><font size="10px">Pac.</font></th>

            <th  align="center" width="100"><font size="10px">Status</font></th>
            
                
    </tr>
 <tbody>
  <?php
  $no = 1;
  foreach ($all_pr as $row): ?> 
        <tr>

      <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->no_wo ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->transDate ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tanggal_kirim ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->nama_cst ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->detailName ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->quantity ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->itemUnitName ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_cutting ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_punching ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_bending ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_welding ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_ps ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_fa ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->tgl_rencana_packing ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?=  $row->status_qr  ?> - <?=  $row->status_line  ?></td>


      </tr>
      
  <?php endforeach ?>
    </tbody> 
      
  </table>
</body>
</html>