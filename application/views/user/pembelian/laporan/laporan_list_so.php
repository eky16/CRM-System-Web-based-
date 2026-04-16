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
  header("Content-Disposition: attachment; filename=List Sales Order  .xls");
  ?>

<?php
setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'Indonesian'); // Atur bahasa Indonesia
$tanggal = strftime('%A, %d %B %Y'); // Format tanggal dalam bahasa Indonesia
?>

 <TR >
  
       <th width="315" colspan="8" align="left">
    <p align="left">
        <font size="13px">
            <strong>
                PESANAN BARANG / RENCANA PRODUKSI<br>
                Hari/Tanggal: <?php echo ucfirst($tanggal); ?> <!-- Menampilkan hari -->
            </strong>
        </font>
    </p>
</th>
 <p align="right">
        <font size="13px">
            <strong>
                FORM  : FM.MRKT-01<br>
                REVISI: 1-14/02/08<br>
                HAL   : ..../....<br>
            </strong>
        </font>
    </p>
       
  </TR>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
    <th rowspan="2">No</th>
    <th rowspan="2">No.So</th>
    <th rowspan="2">Pemesan</th>
    <th rowspan="2">No.PO</th>
    <th rowspan="2">Tanggal Input</th>
    <th rowspan="2">Nama Barang</th>
    <th rowspan="2">Status Packing</th>
    <th rowspan="2">Merk</th>
    <th rowspan="2">Qty</th>
    <th rowspan="2">Warna</th>
    <th colspan="2">Dikirim Tgl</th>
    <th rowspan="2">Status Produksi</th>
    <th rowspan="2">Terima Gambar</th>
    <th rowspan="2">Keterangan</th>
    <th colspan="4">Konfirmasi Pengiriman</th>
</tr>
    <tr>
        <th>SS-PO</th>
        <th>EXP</th>
        <th>Nama</th>
        <th>Sales</th>
        <th>Tgl</th>
        <th>Jam</th>
    </tr>


 <tbody>
  <?php $i=1;
        $no=1; foreach($all_barang as $row) { 
           ?>

    <tr>

                <td><?php echo $no++; ?></td>
                <td class="text" style="mso-number-format:'\@';"><?php echo $row->no_so; ?></td>
                <td class="text"><?php echo $row->nama_cst; ?></td>
                <td class="text"><?php echo $row->no_permintaan; ?></td>
                <td class="text"><?php echo $row->createdtime_po; ?></td>
                <td class="text"><?php echo $row->detailName; ?> </td>
                <td class="text"><?php echo $row->status_packing; ?> </td>
                <td class="text"><?php echo $row->merk; ?> </td>
                <td class="text"><?php echo $row->quantity ; ?></td>
                <td class="text"><?php echo $row->warna; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text"><?php echo $row->detailNotes; ?></td>
                <td></td>
                <td><?php echo $row->nama_sales; ?></td>
                <td></td>
                <td></td>                  
                
                

    </tr> <?php $i++; } ?>
        </tbody>
  </table>
   <br><br>
<div style="width: 100%; display: flex; justify-content: flex-end; margin-top: 20px;">
  <table border="0">
    <tr>
    <td colspan="9"></td>
      <td align="center"><strong>PPIC</strong></td>
      <td colspan="2" align="center"><strong>MARKETING</strong></td>
    </tr>
    <tr>
    <td colspan="9"></td>
      <td align="center" rowspan="3"><br><br>( .......... )</td>
      <td align="center" rowspan="3"><br><br>( .......... )</td>
      <td align="center" rowspan="3"><br><br>( .......... )</td>
    </tr>
  </table>
</div>

</body>
</html>
