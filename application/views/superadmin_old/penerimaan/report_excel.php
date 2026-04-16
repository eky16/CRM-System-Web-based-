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
  <?php
  header("Content-Type:application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=PENERIMAAN BARANG " .$tanggl." Sd ".$dan_tanggl.".xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="9"  align="center"><p align="center"><font size="13px"><strong>PENERIMAAN BARANG - <?php echo date('d F, Y', strtotime($_GET['tanggal']));?>  S/d <?php echo date('d F, Y', strtotime($_GET['dan_tanggal']));?>  </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="center" width="100"><font size="10px">Tanggal</font></th>
            <th  align="center" width="100"><font size="10px">No Terima</font></th>
            <th align="center" width="200"><font size="10px">Supplier</font></th>
            <th  align="center" width="200"><font size="10px">Nama Barang</font></th>
            <th  align="center" width="100"><font size="10px">Jumlah</font></th>
            <th  align="center" width="100"><font size="10px">Satuan</font></th>
            <th  align="center" width="150"><font size="10px">Admin</font></th>
            <th  align="center" width="150"><font size="10px">Waktu</font></th>
     
                
    </tr>
 <tbody>
  <?php
                                     $no = 1;
                                      foreach ($pembayaran as $row): ?> 
    <tr>

                <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
                <td  class="text" style="text-align: left; vertical-align: middle;"><?php echo date('Y-m-d', strtotime($row->tgl_terima)); ?></td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->no_terima ?></td>
                
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->Nama ?></td>
                <td style="text-align: left; vertical-align: middle;">
                    <?= $row->nama_barang ?>                         
                </td>
                <td style="text-align: left; vertical-align: middle;">
                  <?= $row->jumlah ?>
                </td> <!-- end kredit -->
                <td style="text-align: left; vertical-align: middle;"><?= $row->satuan ?> </td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->nama_petugas ?></td>
                <td class="text" align="left"><?= $row->tgl_terima ?>  <?= $row->jam_terima ?></td>




    </tr>     <?php endforeach ?>
    </tbody> 
      
  </table>
</body>
</html>