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
  header("Content-Disposition: attachment; filename=PENERIMAAN KOMPONEN MF " .$tanggl." Sd ".$dan_tanggl.".xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="8"  align="center"><p align="center"><font size="13px"><strong>PENERIMAAN KOMPONEN MF - <?php echo date('d F, Y', strtotime($_GET['tanggal']));?>  S/d <?php echo date('d F, Y', strtotime($_GET['dan_tanggal']));?>  </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="center" width="100"><font size="10px">Tanggal</font></th>
            <th  align="center" width="100"><font size="10px">No Terima</font></th>
            <th  align="center" width="200"><font size="10px">Nama Barang</font></th>
            <th  align="center" width="100"><font size="10px">Jumlah</font></th>
            <th  align="center" width="100"><font size="10px">Satuan</font></th>
            <th  align="center" width="100"><font size="10px">TTP A S</font></th>
            <th  align="center" width="100"><font size="10px">TTP A D</font></th>
            <th  align="center" width="100"><font size="10px">SMPG S</font></th>
            <th  align="center" width="100"><font size="10px">SMPG D</font></th>
            <th  align="center" width="100"><font size="10px">BLKG S</font></th>
            <th  align="center" width="100"><font size="10px">BLKG D</font></th>
            <th  align="center" width="100"><font size="10px">RACK</font></th>
            <th  align="center" width="100"><font size="10px">BOX</font></th>
            <th  align="center" width="100"><font size="10px">CHS.S STAT</font></th>
            <th  align="center" width="100"><font size="10px">CHS.S DIN</font></th>
            <th  align="center" width="100"><font size="10px">CHS.D DIN</font></th>
            <th  align="center" width="100"><font size="10px">TTP CHS S</font></th>
            <th  align="center" width="100"><font size="10px">TTP CHS D</font></th>
            <th  align="center" width="100"><font size="10px">CNTL S</font></th>
            <th  align="center" width="100"><font size="10px">CNTL D</font></th>
            <th  align="center" width="100"><font size="10px">PNGMN</font></th>
            <th  align="center" width="100"><font size="10px">RELL</font></th>
            <th  align="center" width="100"><font size="10px">SAMB. RELL</font></th>
            <th  align="center" width="100"><font size="10px">Ket.</font></th>
            <th  align="center" width="150"><font size="10px">Admin</font></th>
            <th  align="center" width="150"><font size="10px">Waktu</font></th>
     
                
    </tr>
 <tbody>
  <?php
  $no = 1;
  foreach ($pembayaran_mf as $row): ?> 
    <tr>

      <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
      <td  class="text" style="text-align: left; vertical-align: middle;"><?php echo date('Y-m-d', strtotime($row->tgl_terima)); ?></td>
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->no_terima_mf ?></td>
      <td style="text-align: left; vertical-align: middle;">
        <?= $row->nama_barang_mf ?>                         
      </td>
      <td style="text-align: left; vertical-align: middle;">
        <?= $row->jumlah_mf ?>
      </td> <!-- end kredit -->
      <td style="text-align: left; vertical-align: middle;"><?= $row->Satuan_mf ?> </td>

      <td style="text-align: left; vertical-align: middle;"><?= $row->ttpas ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->ttpad ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->smpgs ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->smpgd ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->blkgs ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->blkgd ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->rack ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->box ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->chss_stat ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->chss_din ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->chs_d_din ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->ttpchs_s ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->ttpchs_d ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->cntls ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->cntld ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->pngmn ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->rell ?> </td>
      <td style="text-align: left; vertical-align: middle;"><?= $row->samb_rell ?> </td>  
      <td style="text-align: left; vertical-align: middle;"><?= $row->ket_penerimaan_mf ?> </td>   
    
      <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->nama_petugas ?></td>
      <td class="text" align="left"><?= $row->tgl_terima ?>  <?= $row->jam_terima ?></td>





      </tr>
  <?php endforeach ?>
    </tbody> 
      
  </table>
</body>
</html>