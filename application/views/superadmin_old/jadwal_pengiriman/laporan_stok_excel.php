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
      <th>Stok</th>
      <th>Satuan</th>
      <th>Harga</th>



     
                
    </tr>
 <tbody>
  <?php $i=1;
        $no=1; foreach($all_barang as $barang) { ?>
    <tr>
                <td><?php echo $no++; ?></td>
                <td class="text"><?php echo $barang->kode_barang; ?></td>
                <td><?php echo $barang->nama_barang; ?></td>
                <td class="text"><?php echo $barang->stok; ?></td>
                <td > <?= strtoupper($barang->satuan) ?></td>
                <td class="text"><?php
                                             $hasil_rupiah = "Rp " . number_format($barang->hrg_brg,2,',','.');
                                              echo $hasil_rupiah; ?></td>

    </tr> <?php $i++; } ?>
        </tbody>
  </table>
</body>
</html>