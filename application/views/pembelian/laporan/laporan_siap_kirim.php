<!DOCTYPE html>
<html>
<head>
  <title>LAPORAN</title>
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
  header("Content-Disposition: attachment; filename=" . $title . ".xls");

  ?>

 

  <table border="1">
    <tr>
      <th>No</th>
      <th width="300">Pemesan</th>
      <th width="150">No WO</th>
      <th>Tgl Pesan</th>
      <th width="300">Nama Barang</th>
      <th>Warna</th>
      <th>Qty</th>
      <th>Tgl Kirim</th>
      <th>Status Pesanan</th>
      <th width="300">keterangan</th>
        
    </tr>
 <tbody>
  <?php $i=1;
        $no=1; foreach($all_barang as $row) { ?>
    <tr>
                <td><?php echo $no++; ?></td>
                <td class="text"><?php echo $row->nama_cst; ?></td>
                <td class="text"><?php echo $row->number_; ?></td>
                <td class="text"><?php echo $row->transDate; ?></td>
                <td class="text"><?php echo $row->detailName; ?></td>
                <td class="text"><?php echo $row->warna; ?></td>
                <td class="text"><?php echo $row->quantity ; ?> - <?php echo $row->itemUnitName ; ?></td>
                <td class="text"><?php echo $row->tanggal_kirim; ?></td>
                <td class="text">  <?php $status_pr = $row->status_qr  ?>
                        <?php if ($status_pr == "Stok" and $row->number_po != ""):?>
                          <span class="badge badge-primary"> Stok </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Forecast" and $row->number_po != ""):?>
                          <span class="badge badge-primary"> Forecast </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Produksi" and $row->number_po != ""):?>
                          <span class="badge badge-warning"> Menunggu Produksi </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Cutting"):?>
                          <span class="badge badge-info"> CUTTING </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Punching"):?>
                          <span class="badge badge-info">PUNCHING </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Bending"):?>
                          <span class="badge badge-info">BENDING </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Welding"):?>
                          <span class="badge badge-info">WELDING </span>
                        <?php endif;?>
                        <?php if ($status_pr == "PS"):?>
                          <span class="badge badge-info">PS </span>
                        <?php endif;?>
                        <?php if ($status_pr == "FA"):?>
                          <span class="badge badge-info">FA </span>
                        <?php endif;?>
                        <?php if ($status_pr == "Packing"):?>
                          <span class="badge badge-info">PACKING </span>
                          <?php endif;?>
                          <?php if ($status_pr == "WH FG"):?>
                          <span class="badge badge-primary">WH FG </span>
                          <?php endif;?>
                          <?php if ($status_pr == "Selesai"):?>
                          <span class="badge badge-success">SELESAI </span>
                          <?php endif;?>
                          <!-- jika barang Ready DAN tanggal kirim kosong tampilkan status Ready -->
                          <?php if ($status_pr == "Ready" and $row->tanggal_kirim == ""):?>
                          <span class="badge badge-primary">Ready </span>
                          <?php endif;?> 
                          <!-- jika barang Ready DAN tanggal kirim tidak kosong tampilkan status Siap Dikirim -->
                          <?php if ($status_pr == "Ready" and $row->tanggal_kirim != ""):?>
                          <span class="badge badge-primary">Siap Dikirim </span>
                          <?php endif;?> 
                        </td>
                <td class="text"><?php echo $row->detailNotes; ?></td>

    </tr> <?php $i++; } ?>
        </tbody>
  </table>
</body>
</html>