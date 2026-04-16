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
  <?php
  header("Content-Type:application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=Pesanan Pembelian.xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="7"  align="center"><p align="center"><font size="13px"><strong> LAPORAN PESANAN PEMBELIAN  TANGGAL <?php echo $_GET['tanggal'];?> S/d <?php echo $_GET['dan_tanggal'];?>  </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="center" width="100"><font size="10px">Tanggal</font></th>
            <th  align="center" width="150"><font size="10px">No Pesanan</font></th>
            <th align="center" width="200"><font size="10px">Project</font></th>
            <th  align="center" width="200"><font size="10px">Pemasok</font></th>
            <th  align="center" width="300"><font size="10px">Nama Barang</font></th>
            <th  align="center" width="100"><font size="10px">Qty</font></th>
            <th  align="center" width="100"><font size="10px">Harga</font></th>
            <th  align="center" width="150"><font size="10px">Total</font></th>
     
                
    </tr>
 <tbody>
  <?php
                                     $no = 1;
                                      foreach ($mdl as $row): ?> 
    <tr>

                <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
                <td  class="text" style="text-align: left; vertical-align: middle;"><?php echo date('Y-m-d', strtotime($row->shipDate)); ?></td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->number_ ?></td>
                
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->nama_project ?></td>
                <td style="text-align: left; vertical-align: middle;">
                    <?= $row->vendorNo ?>                         
                </td>
                <td style="text-align: left; vertical-align: middle;">
                    <?= $row->detailName ?>                         
                </td>
                <td style="text-align: left; vertical-align: middle;">
                    <?= $row->quantity ?> - <?= $row->itemUnitName ?>                         
                </td>
                 <td style="text-align: left; vertical-align: middle;">
                  <?php
                                             $hasil_rupiah = number_format($row->unitPrice,0,',','.');
                                              echo $hasil_rupiah; ?>                       
                </td>
                <td style="text-align: left; vertical-align: middle;">
                  <?php
                                             $hasil_rupiah2 = number_format($row->total_harga,0,',','.');
                                              echo $hasil_rupiah2; ?>                       
                </td>
    </tr>     <?php endforeach ?>
    </tbody> 
        <?php foreach ($grand_total as $row): ?>


                                    <tr>
                                        <td colspan="8" align="right"> <b>Grand Total</b></td>

                                        <td colspan="1" align="left">  <b>
                                                     <?php

                                          $hasil = "Rp " . number_format($row->harga_total,0,',','.');
                                          echo $hasil; ?>
</b></td>                                
                                        </tr>

                <?php endforeach ?>      
  </table>
</body>
</html>