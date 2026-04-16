<!DOCTYPE html>
<html>
<head>
  <title><?= $ket ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
<?php $type_barang_pesanan = $_GET['type_barang_pesanan']; ?>
  <?php
  header("Content-Type:application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=LAPORAN PENGIRIMAN SELESAI " .$tanggl." Sd ".$dan_tanggl.".xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="8"  align="center"><p align="center"><font size="13px"><strong>PENGIRIMAN SELESAI - <?php echo date('d F, Y', strtotime($_GET['tanggal']));?>  S/d <?php echo date('d F, Y', strtotime($_GET['dan_tanggal']));?>  </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="middle" width="50"><font size="10px">ID</font></th>
            <th  align="center" width="100"><font size="10px">Tgl Kirim</font></th>
            <th  align="center" width="100"><font size="10px">Tgl Pesanan</font></th>
            <th  align="center" width="200"><font size="10px">ID Kirim</font></th>
            <th  align="center" width="100"><font size="10px">Customer</font></th>
            <th  align="center" width="100"><font size="10px">WO</font></th>
            <th  align="center" width="150"><font size="10px">Nama Barang</font></th>
            <th  align="center" width="150"><font size="10px">Status Packing</font></th>
            <th  align="center" width="150"><font size="10px">Qty</font></th>
            <th  align="center" width="150"><font size="10px">Jenis</font></th>
            <th  align="center" width="150"><font size="10px">Status</font></th>

     
                
    </tr>
 <tbody>
  <?php
  $no = 1;
  foreach ($all_pr as $row): ?> 
    <tr>

      <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
      
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->number_request ?></td>
      <td style="text-align: left; vertical-align: middle;">
        <?= $row->tanggal_kirim ?>                         
      </td>
      <td style="text-align: left; vertical-align: middle;">
        <?= $row->transDate ?>
      </td> <!-- end kredit -->
      <td style="text-align: left; vertical-align: middle;"><?= $row->id_kiriman ?> </td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->nama_cst ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->no_wo ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->detailName ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->status_packing ?></td>
      <td class="" style="text-align: left; vertical-align: middle;"><?= $row->quantity ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->type_barang_pesanan ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->status_qr ?></td>

      </tr>
  <?php endforeach ?>
  <tr>
                <td colspan="8" align="right"><strong>Total Qty:</strong></td>
                <td><strong><?= $total_qty ?></strong></td>
                <td colspan="2"></td>
            </tr>
    </tbody> 
      
  </table>
</body>
</html>