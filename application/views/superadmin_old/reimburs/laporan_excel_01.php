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
  header("Content-Disposition: attachment; filename=Reimbursement .$project.xls");
  header("Expires: 0");header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  ?>



  <table border="1">
      <TR >
  
       <th width="315" colspan="6"  align="center"><p align="center"><font size="13px"><strong> LAPORAN REIMBURSEMENT  - <?php echo $_GET['project'];?>   </strong>&nbsp;</p></th>
  </TR>

  <br>
    <tr>
    
            <th  align="middle" width="50"><font size="10px">No</font></th>
            <th  align="center" width="100"><font size="10px">Tanggal</font></th>
            <th  align="center" width="150"><font size="10px">ID</font></th>
            <th align="center" width="200"><font size="10px">Karyawan</font></th>
            <th  align="center" width="200"><font size="10px">Proyek</font></th>
            <th  align="center" width="150"><font size="10px">Total</font></th>
     
                
    </tr>
 <tbody>
  <?php
                                     $no = 1;
                                      foreach ($mdl as $row): ?> 
    <tr>

                <td class="text" style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
                <td  class="text" style="text-align: left; vertical-align: middle;"><?php echo date('Y-m-d', strtotime($row->tanggal_reimbus)); ?></td>
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->kode_reimbus ?></td>
                
                <td class="text" style="text-align: left; vertical-align: middle;"><?= $row->user_reimbus ?></td>
                <td style="text-align: left; vertical-align: middle;">
                    <?= $row->name_project ?>                         
                </td>

                <td style="text-align: left; vertical-align: middle;"> <?php
                                             $hasil_rupiah = "Rp " . number_format($row->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?></td>


    </tr>     <?php endforeach ?>
    </tbody> 
        <?php foreach ($grand_total as $row): ?>


                                    <tr>
                                        <td colspan="5" align="right"> <b>Grand Total</b></td>

                                        <td colspan="1" align="left">  <b>
                                        <?php
                                             $hasil_rupiah = "Rp " . number_format($row->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?>
</b></td>                                
                                        </tr>

                <?php endforeach ?>      
  </table>
</body>
</html>