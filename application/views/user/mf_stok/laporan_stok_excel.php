<!DOCTYPE html>
<html>
<head>
  <title>DATA KOMPONEN MF</title>
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
      <td>Stock</td>
      <td>Satuan</td>
      <td>TTP A S</td>
      <th>TTP A D</th>
      <th>SMPG S</th>
      <th>SMPG D</th>
      <th>BLKG S</th>
      <th>BLKG D</th>
      <th>RACK</th>
      <th>BOX</th>
      <th>CHS.S STAT</th>
      <th>CHS.S DIN</th>
      <th>CHS.D DIN</th>
      <th>TTP CHS S</th>
      <th>TTP CHS D</th>
      <th>CNTL S</th>
      <th>CNTL D</th>
      <th>PNGMN</th>
      <th>RELL</th>
      <th>SAMB. RELL</th>



     
                
    </tr>
 <tbody>
  <?php $i=1;
        $no=1; foreach($all_komponen as $komponen) { ?>
    <tr>
                <td><?php echo $no++; ?></td>
                <td class="text"><?php echo $komponen->kode_mf; ?></td>
                <td><?php echo $komponen->nama_mf; ?></td>
                <td><?php echo $komponen->warna_mf; ?></td>
                <td class="text"><?php echo $komponen->stok_mf; ?></td>
                <td > <?= strtoupper($komponen->satuan_mf) ?></td>
                <td class="text"><?php echo $komponen->TTP_A_S; ?></td>
                <td class="text"><?php echo $komponen->TTP_A_D; ?></td>
                <td class="text"><?php echo $komponen->SMPG_S; ?></td>
                <td class="text"><?php echo $komponen->SMPG_D; ?></td>
                <td class="text"><?php echo $komponen->BLKG_S; ?></td>
                <td class="text"><?php echo $komponen->BLKG_D; ?></td>
                <td class="text"><?php echo $komponen->RACK; ?></td>
                <td class="text"><?php echo $komponen->BOX; ?></td>
                <td class="text"><?php echo $komponen->CHS_S_STAT; ?></td>
                <td class="text"><?php echo $komponen->CHS_S_DIN; ?></td>
                <td class="text"><?php echo $komponen->CHS_D_DIN; ?></td>
                <td class="text"><?php echo $komponen->TTP_CHS_S; ?></td>
                <td class="text"><?php echo $komponen->TTP_CHS_D; ?></td>
                <td class="text"><?php echo $komponen->CNTL_S; ?></td>
                <td class="text"><?php echo $komponen->CNTL_D; ?></td>
                <td class="text"><?php echo $komponen->PNGMN; ?></td>
                <td class="text"><?php echo $komponen->RELL; ?></td>
                <td class="text"><?php echo $komponen->SAMB_RELL; ?></td>

    </tr> <?php $i++; } ?>
        </tbody>
  </table>
</body>
</html>