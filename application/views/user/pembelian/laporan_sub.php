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
<?php $project = $_GET['project'];?>
  <?php
  header("Content-Type:application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=Pesanan Pembelian .$project.xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="7"  align="center"><p align="center"><font size="13px"><strong> Laporan Pesanan Pembelian  - <?php echo $_GET['jenis'];?>   </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="center" width="100"><font size="10px">Tanggal</font></th>
            <th  align="center" width="150"><font size="10px">No Pesanan</font></th>
            <th align="center" width="200"><font size="10px">Project</font></th>
            <th  align="center" width="200"><font size="10px">Pemasok</font></th>
            <th  align="center" width="100"><font size="10px">Pajak</font></th>
            <th  align="center" width="100"><font size="10px">Jenis</font></th>
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
                 <?php if ($row->taxable == 'true'):?>
                                                        <span class="badge badge-warning">Y</span>
                                                    <?php endif;?>
                                                    <?php if ($row->taxable == 'false'):?>
                                                        <span class="badge badge-info">N </span>
                                                        <?php endif;?>
                </td> <!-- end kredit -->
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->jenis_pembelian_item ?></td>
                <td style="text-align: left; vertical-align: middle;">   <?php if ($row->taxable == 'true'):?>
                                        <?php
                                            $diskon = $row->total_harga_p - $row->cashDiscount;
                                            $hasil_pajak = $diskon * 11/100 ;
                                            $hasil_pajak1 = $diskon + $hasil_pajak ;
                                            $hasil_rupiah = 'Rp '. number_format($hasil_pajak1,0,',','.');
                                            echo $hasil_rupiah; 
                                        ?>
                                         <?php endif;?>
                                        <?php if ($row->taxable == 'false'):?>
                                        <?php
                                            $diskon = $row->total_harga_np - $row->cashDiscount;
                                            $hasil_rupiah = 'Rp '. number_format($diskon,0,',','.');
                                            echo $hasil_rupiah; 
                                        ?>           
                                        <?php endif;?></td>


    </tr>     <?php endforeach ?>
    </tbody> 
        <?php foreach ($grand_total as $row): ?>


                                    <tr>
                                        <td colspan="7" align="right"> <b>Grand Total</b></td>

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