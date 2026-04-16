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
<?php $tanggl = date('dmY', strtotime($_GET['tanggal']));?>
  <?php
  header("Content-Type:application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=CSA-MSA-GFY-".$tanggl.".xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="6"  align="center"><p align="center"><font size="13px"><strong>LIST PAYMENT - <?php echo date('d F, Y', strtotime($_GET['tanggal']));?> </strong><br><strong> <?php echo $_GET['header_payment']; ?></strong><br><strong><font color="red"> <?php echo $status; ?></font></strong></font><br>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">NO</font></th>
            <th  align="center" width="200"><font size="10px">NO SPK</font></th>
            <th  align="center" width="200"><font size="10px">PROJECT</font></th>
            <th align="center" width="300"><font size="10px">VENDOR</font></th>
            <th  align="center" width="130"><font size="10px">CASH</font></th>
            <th  align="center" width="300"><font size="10px">DESCRIPTION</font></th>
     
                
    </tr>
 <tbody>
  <?php
                                     $no = 1;
                                      foreach ($all_paym as $pay): ?> 
    <tr>

                <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
                <td  class="text" style="text-align: left; vertical-align: middle;"><?= $pay->no_spk ?></td>
                <td style="text-align: left; vertical-align: middle;"><?= $pay->nama_project ?></td>
                <td class="text" align="left"><?= $pay->nama_vendor ?>
                <br align="left"><?= $pay->atas_nama_bank ?>
                <br align="left"><?= $pay->norek_vendor .' - '. $pay->nama_bank_vendor ?></td>
                <td style="text-align: left; vertical-align: middle;"> <?php
                                             $hasil_rupiah = "Rp " . number_format($pay->total_payment,0,',','.');
                                              echo $hasil_rupiah; ?></td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $pay->note_payment ?></td>




    </tr>     <?php endforeach ?>
    </tbody> <?php foreach ($count as $pay): ?>
                                                            <tr>
                                            <td colspan="4" align="center"><font size="10px">TOTAL</font></td>
                                            <td colspan="1" align="left"><font size="10px">&nbsp;<?php
                                             $hasil_rupiah = "Rp " . number_format($pay->total_almount,0,',','.');
                                              echo $hasil_rupiah; ?></font></td>
                                            <td ></td>
                                         
                                         
                                                                              
                                        </tr>      <?php endforeach ?>
  </table>
</body>
</html>