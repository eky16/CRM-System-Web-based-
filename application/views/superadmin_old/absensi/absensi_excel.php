<!DOCTYPE html>
<html>
<head>
  <title>DATA KARYAWAN</title>
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
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=ABSENSI CASSA .xls");
  ?>

 

  <table border="1">
    <tr>
    
      <th>NO</th>
      <th>EMPLOYEE ID</th>
      <th>NAMA</th>
      <th>HARI</th>
      <th>TGL</th>
      <th>DATANG  </th>
      <th>PULANG </th>
      <th>KET</th>



     
                
    </tr>
 <tbody>
 <?php $no = 1; if (!empty($absensi)):foreach ($absensi as $data => $v_application): ?>
    <tr>

            <td width="15px" style="text-align: center; vertical-align: middle;" ><?php echo $no++; ?> </td> 
                        <td class="text" width="85px" style="text-align: center; vertical-align: middle;" ><?php echo $v_application->EmployeeID; ?> </td>  
                        <td width="146px" style="font-weight:bold;"><?php echo $v_application->nama_karyawan ; ?></td>
                        
                        <td width="63px" style="text-align: center; vertical-align: middle;" >
                         <?php 
                                $daftar_hari = array(
                                 'Sunday' => 'MINGGU',
                                 'Monday' => 'SENIN',
                                 'Tuesday' => 'SELASA',
                                 'Wednesday' => 'RABU',
                                 'Thursday' => 'KAMIS',
                                 'Friday' => 'JUMAT',
                                 'Saturday' => 'SABTU'
                                );
                                $date="$v_application->tanggal";
                                $namahari = date('l', strtotime($date));
                                echo $daftar_hari[$namahari]; ?></td>
                        <td class="text" width="50px" style="text-align: center; vertical-align: middle;" ><?php echo date('d-m-Y', strtotime($v_application->tanggal)); ?></td>
                    

                        <td width="51px" style="text-align: center; vertical-align: middle; font-weight:bold;" ><?php  
                            $att_in = $v_application->cek_in ;
                            echo $att_in > 0 ? $att_in : ' ';
                              ?>
                            </td>
                
                        <td width="40px" style="text-align: center; vertical-align: middle; font-weight:bold;" ><?php  
                            $att_out = $v_application->cek_out ;
                            echo $att_out > 0 ? $att_out : ' ';
                              ?></td>
        
                        <td width="71px" style="text-align: center; vertical-align: middle;" ><?php echo $v_application->jenis; ?> </td>


    </tr>      <?php endforeach; ?>
                    <?php endif; ?>
        </tbody>
  </table>
</body>
</html>