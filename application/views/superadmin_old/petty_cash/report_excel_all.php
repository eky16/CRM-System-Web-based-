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
  header("Content-Disposition: attachment; filename=PETTY CASH " .$tanggl." Sd ".$dan_tanggl.".xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="9"  align="center"><p align="center"><font size="13px"><strong>PETTY CASH - <?php echo date('d F, Y', strtotime($_GET['tanggal']));?>  S/d <?php echo date('d F, Y', strtotime($_GET['dan_tanggal']));?>  </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">NO</font></th>
            <th  align="center" width="200"><font size="10px">Tgl Proses</font></th>
            <th  align="center" width="100"><font size="10px">Tgl Transaksi</font></th>
            <th align="center" width="100"><font size="10px">Id Transaksi</font></th>
            <th  align="center" width="100"><font size="10px">Status</font></th>
            <th  align="center" width="150"><font size="10px">Debit</font></th>
            <th  align="center" width="150"><font size="10px">Kredit</font></th>
            <th  align="center" width="150"><font size="10px">Saldo Akhir</font></th>
            <th  align="center" width="300"><font size="10px">Keterangan</font></th>
     
                
    </tr>
 <tbody>
  <?php
                                     $no = 1;
                                      foreach ($all_paym as $pay): ?> 
    <tr>

                <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
                <td  class="text" style="text-align: left; vertical-align: middle;"><?= $pay->date_petty_cash ?></td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $pay->tgl_transaksi_petty ?></td>
                <td class="text" align="left"><?= $pay->kode_pembayaran ?></td>
                <td class="text" align="left"><?= $pay->jenis_pety_cash ?></td>
                <!-- debit -->
                <td style="text-align: left; vertical-align: middle;">
                 <?php if ($pay->jenis_pety_cash == 'Isi Saldo') {
                  $hasil_rupiah = "Rp " . number_format($pay->nominal_pembayaran,0,',','.');
                                              echo $hasil_rupiah;
                 }if ($pay->jenis_pety_cash != 'Isi Saldo') {
                  $hasil_rupiah = "0";
                  echo $hasil_rupiah;
                 }
                 ?>                          
                </td>
                <!-- end debit -->
                <!-- Kredit -->
                <td style="text-align: left; vertical-align: middle;">
                    <?php if ($pay->jenis_pety_cash == 'Saldo Keluar') {
                  $hasil_rupiah = "Rp " . number_format($pay->nominal_pembayaran,0,',','.');
                   echo $hasil_rupiah;
                 }if ($pay->jenis_pety_cash != 'Saldo Keluar') {
                  $hasil_rupiah = "0";
                  echo $hasil_rupiah;
                 }
                 ?> 
                </td> <!-- end kredit -->
                <td style="text-align: left; vertical-align: middle;"> <?php
                                            if ($pay->jenis_pety_cash == 'Isi Saldo') {
                                              $saldo_akhir = $pay->saldo_before + $pay->nominal_pembayaran;
                                            }if ($pay->jenis_pety_cash == 'Saldo Keluar') {
                                              $saldo_akhir = $pay->saldo_before - $pay->nominal_pembayaran;
                                            }
                                             $hasil_rupiah = "Rp " . number_format($saldo_akhir,0,',','.');
                                              echo $hasil_rupiah; ?></td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $pay->noted_pety_cash ?></td>




    </tr>     <?php endforeach ?>
    </tbody> 
                                      <tr>
                                            <td colspan="5" align="center"><font size="10px">TOTAL</font></td>
                                            <!-- hitung total debit -->
                                      
                                            <?php foreach ($count as $pay): ?>
                                            <td colspan="1" align="left"><font size="10px">
                                              <?php
                                           
                                               $hasil_rupiah = "Rp " . number_format($pay->total_transaksi,0,',','.');
                                              echo $hasil_rupiah;
                                             
                                               
                                              ?></font></td><?php endforeach ?>
                                              <!-- selesai hitung total debit -->
                                              <!-- hitung total kredit -->
                                            <?php foreach ($count_kredit as $pay): ?>
                                            <td colspan="1" align="left"><font size="10px"><?php
                                             
                                               $hasil_rupiah = "Rp " . number_format($pay->total_transaksi,0,',','.');
                                              echo $hasil_rupiah;
                                              
                                              ?></font></td><?php endforeach ?>
                                              <!-- selesai hitung total debit -->
                                            <td ></td>
                                         
                                         
                                                                              
                                      </tr>      
  </table>
</body>
</html>