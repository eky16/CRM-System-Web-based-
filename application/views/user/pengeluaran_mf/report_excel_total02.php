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
  header("Content-Disposition: attachment; filename=LAPORAN PENGELUARAN BARANG.xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="6"  align="center"><p align="center"><font size="13px"><strong>LAPORAN PENGELUARAN BARANG   </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th align="center" width="250"><font size="10px">Proyek</font></th>
            <th  align="center" width="200"><font size="10px">Nama Barang</font></th>
            <th  align="center" width="100"><font size="10px">Jumlah</font></th>
            <th  align="center" width="100"><font size="10px">Satuan</font></th>
            <th  align="center" width="200"><font size="10px">Harga Total</font></th>
     
                
    </tr>
 <tbody>
  <?php
                                     $no = 1;
                                      foreach ($pembayaran as $row): ?> 
    <tr>

      <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>

      <td class="text" align="left"><?= $row->project_name ?></td>
      <td style="text-align: left; vertical-align: middle;">
        <?= $row->nama_barang ?>                         
      </td>
      <td style="text-align: left; vertical-align: middle;">
        <?= $row->total_pemakaian ?>
      </td> <!-- end kredit -->
      <td style="text-align: left; vertical-align: middle;"><?= $row->satuan ?> </td>
      <td><?php
      $hasil_rupiah = "Rp " . number_format($row->harga_total_k,0,',','.');
      echo $hasil_rupiah; ?></td>



    </tr>     <?php endforeach ?>
    </tbody> 
                                     <?php foreach ($grand_total as $row): ?>


                                <tr>
                                </br>
                                <td colspan="5" align="right"> <b>Grand Total</b></td>

                                <td >  <b>
                                  <?php

                                  $hasil = "Rp " . number_format($row->harga_total,0,',','.');
                                  echo $hasil; ?>
                              </b></td>                                
                          </tr>

                      <?php endforeach ?>
  </table>
</body>
</html>