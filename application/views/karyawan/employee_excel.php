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
  header("Content-Disposition: attachment; filename=KARYAWAN CASSA .xls");
  ?>

 

  <table border="1">
    <tr>
    
      <th>EmployeeID</th>
      <th>NAMA</th>
      <th>NIK KTP</th>
      <th>KELAMIN</th>
      <th>TGL LAHIR</th>
      <th>STATUS</th>
      <th>NO TLP 1  </th>
      <th>NO TLP 2  </th>
      <th>NO TLP DARURAT </th>
      <th>HUBUNGAN</th>
      <th>EMAIL</th>
      <th>EMAIL KANTOR</th>
      <th>ALAMAT KTP</th>
      <th>ALAMAT DOMISILI</th>
      <th>STATUS KARYAWAN</th>
      <th>DIVISI</th>
      <th>JABATAN</th>
      <th>BERGABUNG</th>
      <th>AKHIR KERJA</th>
      <th>ID ATASAN</th>
      <th>LAMA BEKERJA</th>
      <th>NOREK</th>


     
                
    </tr>
 <tbody>
  <?php $i=1; foreach($emp as $emp) { ?>
    <tr>

                <td class="text"><?php echo $emp->EmployeeID; ?></td>
                <td><?php echo $emp->nama_karyawan; ?></td>
                <td class="text"><?php echo $emp->nomor_ktp; ?></td>
                <td ><?php echo $emp->gender; ?></td>
                <td class="text"><?php echo $emp->ulang_tahun; ?></td>
                <td><?php echo $emp->status_kawin; ?></td>
                <td class="text"><?php echo $emp->no_telp1; ?></td>
                <td class="text"><?php echo $emp->no_telp2; ?></td>
                <td class="text"><?php echo $emp->no_telp_darurat; ?></td>
                <td ><?php echo $emp->hubungan; ?></td>
                <td><?php echo $emp->email; ?></td>
                <td><?php echo $emp->email_kantor; ?></td>
                <td><?php echo $emp->alamat_ktp; ?></td>
                <td><?php echo $emp->alamat_domisili; ?></td>
                <td><?php echo $emp->perjanjian_kerja; ?></td>
                <td ><?php echo $emp->department; ?></td>
                <td ><?php echo $emp->divisi; ?></td>
                <td class="text"><?php echo $emp->tgl_bergabung; ?></td>
                <td class="text"><?php echo $emp->akhir_kerja; ?></td>
                <td ><?php echo $emp->supervisorID; ?></td>
                <td ><?php 
                                            $start_date = new DateTime($emp->tgl_bergabung);
                                            $end_date = new DateTime(date('Y-m-d'));
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            echo " " . $y . " tahun " . $m . " bulan " . $d . " hari";
                                            ?></td>
                <td class="text"><?php echo $emp->no_rek; ?></td>


    </tr> <?php $i++; } ?>
        </tbody>
  </table>
</body>
</html>