<!DOCTYPE html>
<html>
<head>
  <title>LAPORAN MASTER FORECAST</title>
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
       <th>Tgl Pesanan</th>
      <th width="150">No WO</th>
      <th width="300">Pemesan</th>
      <th width="300">Nama Barang</th>
      <th>Qty</th> 
      <th>Tgl Kirim</th>
      <th>Tgl Selesai</th>
      <th width="150">Status</th>                  
      <th width="300">keterangan</th>
        
    </tr>
 <tbody>
  <?php $i=1;
        $no=1; foreach($all_barang as $row) { ?>
    <tr>
                <td><?php echo $no++; ?></td>
                <td class="text"><?php echo $row->transDate; ?></td>
                <td class="text"><?php echo $row->no_wo; ?></td>
                <td class="text"><?php echo $row->nama_cst; ?></td>
                <td class="text"><?php echo $row->detailName; ?></td>
                <td class="text"><?php echo $row->quantity ; ?> - <?php echo $row->itemUnitName ; ?></td>
                <td class="text"><?php echo $row->tanggal_kirim; ?></td>
                <td class="text"><?php echo $row->tgl_perkiraan; ?></td>
                <td align="center"><font size="2px">
                                            <span class="badge badge-info"> <?=  $row->status_qr  ?> -  <?=  $row->status_line  ?> </span>
                                            </font></td>               
                            
                <td class="text"><?php echo $row->detailNotes; ?></td>

    </tr> <?php $i++; } ?>
        </tbody>
  </table>
</body>
</html>