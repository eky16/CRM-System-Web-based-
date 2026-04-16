<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Penawaran Harga</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        .header {
            width: 100%;
        }

        .header td {
            vertical-align: top;
        }

        .line {
            border-bottom: 2px solid black;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid black;
            padding: 5px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .mt-10 {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<table width="100%" style="border-bottom:3px double black; border-collapse: collapse;">
    <tr>
        <td style="padding-bottom: 5px; text-align: left;">
            <img src="<?= FCPATH . 'img/AUM_BLACK2.png' ?>" width="100" style="vertical-align: middle; margin-right: 5px;">
            <span style="font-size: 22px; font-weight: bold; vertical-align: middle; display: inline-block;">
                PT ALBA UNGGUL METAL
            </span>
        </td>

        <td rowspan="2" style="text-align: right; vertical-align: middle; width: 120px;">
            <img src="<?= FCPATH . 'img/amtivo_logo.png' ?>" width="130">
        </td>
    </tr>

    <tr>
        <td style="border:none; line-height: 1.1; font-size: 12px; padding-top: 0px; padding-bottom: 5px;">
        <span style="display: block; margin-top: -5px;"> Jl. Industri Raya III Blok AC No.2 Kawasan Industri Jatake - Cikupa - Tangerang<br>
            Telp: (021) 59301445 (Hunting) Fax : (021) 59301440<br>
            Website : www.albaunggulmetal.co.id &nbsp; Email : cs@albaunggulmetal.co.id
        </span>
    </td>
    </tr>
</table>



<div class="line"></div>

<!-- INFO -->


<table>
    <tr>
        <td width="60px">No</td>
        <td width="10px">:</td>
        <td>148.10/I/SP/AUM/25/REV-5</td>
    </tr>
    <tr>
        <td>Lamp</td>
        <td>:</td>
        <td>Gambar</td>
    </tr>
    <tr>
        <td>Hal</td>
        <td>:</td>
        <td>Penawaran Harga</td>
    </tr>
</table>

<p class="mt-10">Dengan Hormat,</p>

<p>
    Bersama ini kami mengajukan penawaran harga barang sebagai berikut:
</p>

<!-- TABLE -->
<table class="table-bordered">
    <thead>
        <tr class="text-center" style="background-color: #f2f2f2;"> <th width="5%" style="vertical-align: middle;">No</th>
    <th style="vertical-align: middle;">Spesifikasi</th>
    <th width="10%" style="vertical-align: middle;">Qty</th>
    <th width="20%" style="vertical-align: middle;">Harga Satuan</th>
    <th width="20%" style="vertical-align: middle;">Total</th>
</tr>
    </thead>
    <tbody>
        <?php $no = 1; $grand_total = 0; ?>
        <?php foreach ($dt_quo as $row): 
            $total = $row->quantity * $row->harga;
            $grand_total += $total;
        ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td>
                <strong><?= $row->detailName_quo ?></strong><br>

                Notes : <?= $row->detailNotes_quo ?>
            </td>
            <td class="text-center"><?= $row->quantity ?></td>
            <td class="text-right">Rp <?= number_format($row->harga,0,',','.') ?></td>
            <td class="text-right">Rp <?= number_format($total,0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>

        <!-- TOTAL -->
        <tr>
    <td colspan="4" class="text-right"><strong>Total Harga Barang</strong></td>
    <td class="text-right"><strong>Rp <?= number_format($grand_total, 0, ',', '.') ?></strong></td>
    <td></td> <td></td> </tr>

<tr>
    <td colspan="4" class="text-right"><strong>Biaya Pengiriman</strong></td>
    <td class="text-right">Rp <?= number_format($cetak_biaya_kirim ?? 0, 0, ',', '.') ?></td>
    <td></td> 
    <td></td>
</tr>

<tr>
    <td colspan="4" class="text-right"><strong>Biaya Pemasangan</strong></td>
    <td class="text-right">Rp <?= number_format($cetak_biaya_penanganan ?? 0, 0, ',', '.') ?></td>
    <td></td>
    <td></td>
</tr>

<tr style="background-color: #eee;">
    <td colspan="4" class="text-right"><strong>Netto Price</strong></td>
    <td class="text-right" style="border-top: 2px solid black;">
        <strong>Rp <?= number_format($grand_total + ($cetak_biaya_kirim ?? 0) + ($cetak_biaya_penanganan ?? 0), 0, ',', '.') ?></strong>
    </td>
</tr>
    </tbody>
</table>

<!-- KONDISI -->
<p class="mt-10"><strong>Kondisi:</strong></p>
<ul>
    <li>Harga diatas Netto  franko Jakarta (Exclude PPN)</li>
    <li>Pelaksanaan setelah PO dan uang muka diterima</li>
    <li>Pembayaran uang muka 50%, pelunasan 50% sebelum barang dikirim</li>
    <li>Surat penawaran tidak mengikat, harga sewaktu-waktu</li>
    <li>Barang yang sudah dipesan tidak dapat dibatalkan</li>
</ul>
<br>
<p style="text-indent: 30px;">
    Demikian penawaran harga ini kami sampaikan, atas perhatian dan kerjasama yang baik, kami ucapkan terimakasih.
</p>
<br>

<p>Hormat Kami,</p>

<br><br>

<strong><?= $this->session->login['nama'] ?? 'ADMIN' ?></strong>

</body>
</html>