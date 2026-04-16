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
  header("Content-Disposition: attachment; filename=Laporan Stok .xls");
  ?>

 

  <table border="1">
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <td>Warna</td>
      <td>Minimum</td>
      <td>Maximum</td>
      <th>Stok</th>
      <th>Satuan</th>



     
                
    </tr>
 <tbody>
  <?php $i=1;
        $no=1; foreach($all_barang as $barang) { ?>
    <tr>
                <td><?php echo $no++; ?></td>
                <td class="text"><?php echo $barang->Kode_Barang; ?></td>
                <td><?php echo $barang->Nama_Barang; ?></td>
                <td><?php echo $barang->Warna_barang; ?></td>
                <td class="text"><?php echo $barang->Min; ?></td>
                <td class="text"><?php echo $barang->Max; ?></td>
                <td class="text"><?php echo $barang->Stok; ?></td>
                <td > <?= strtoupper($barang->Satuan) ?></td>

    </tr> <?php $i++; } ?>
        </tbody>
  </table>
</body>
</html>