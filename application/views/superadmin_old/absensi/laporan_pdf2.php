<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <style>
            
            .payment_history td
            {
                padding: 5px 0px 0px 5px; text-align: left;
                font-size: 10px;
            }

             @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 4cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }
                header {
                position: fixed;
                top: 0.9cm;
                left: 2cm;
                right: 2cm;
                height: 4cm;

                /** Extra personal styles **/
                color: black;
                text-align: center;
                line-height: 0.5cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 2cm; 
                right: 2cm;
                height: 2cm;

                /** Extra personal styles **/
               
                color: black;
                text-align: center;
                line-height: 0.5cm;
            }

        </style>
    </head>

    <body style="width: 100%;">
            <header>
        <div style="width: 100%; border-bottom: 2px solid black;">
            
            <table style="width: 100%; vertical-align: middle;">
                <tr>
                    <?php
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info) {
                            ?>
                            <td style="width: 35px; border: 0px;">
                                <img style="width: 80px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                            </td>
                            <td style="border: 0px;">
                                <p style="margin-left: 10px; font: 14px lighter; font-weight:bold;"><?php echo $info->name ?></p>
                                <p style="margin-left: 10px; font: 14px lighter;"><?php echo $ket?></p>
                            </td>
                            <?php
                        }
                    } else {
                        ?>
                        <td style="width: 35px; border: 1px;">
                            <img  style="width: 100px;height: 100px" src="<?php echo base_url() ?>img/logo.png" alt="Logo" class="img-circle tengah"/>
                            &nbsp;&nbsp;<font size="12px"> <?php echo $ket?> </font>
                          
                        </td>
                    
                        <?php
                    }
                    ?>
                </tr>
            </table>
      
              </div> </header>
                
      
              
<table border="1" cellspacing="0" style=" /*border: 1px solid blue;*/ padding: 5px 0;">
        
                 <tr class="payment_history">                                            
                        <td width="10px" style="text-align: center; vertical-align: middle;" ><strong>NO </strong></td>                     
                        <td width="75px" style="text-align: center; vertical-align: middle;" ><strong> DIVISI </strong></td>                
                        <td width="130px" style="text-align: center; vertical-align: middle;" ><strong>NAMA</strong></td>    
                       
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>HK</strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle;  background-color:#12f0e2;" ><strong>H </strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>LA</strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>T</strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>C </strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>S</strong></td> 
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>P</strong></td>  
                        <td width="30px" style="text-align: center; vertical-align: middle;  background-color:#7FFFD4;" ><strong>P.UM</strong></td>

                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>A</strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle; background-color:#FFD700;" ><strong>P.GJ</strong></td>
                        <td width="30px" style="text-align: center; vertical-align: middle;" ><strong>L</strong></td>
                    </tr>
                
                 <?php $no = 1; if (!empty($absensi)):foreach ($absensi as $data => $absensi): ?>
                      <tr class="payment_history"> 
                      <td><?= $no++ ?></td>
                    <td ><?= $absensi->department ?></td>
                    <td><?= $absensi->nama_karyawan ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?php
                            $date = $_GET['tanggal'];
                            $date1 = $_GET['dan_tanggal'];
                            $begin = new DateTime($date);
                            $end = new DateTime($date1);
                            $daterange     = new DatePeriod($begin, new DateInterval('P1D'), $end);
                            //mendapatkan range antara dua tanggal dan di looping
                            
                            $i=0;
                            $x     =    0;
                            $end     =    1;
                            $o = 1;
                            foreach($daterange as $date){
                            $daterange     = $date->format("Y-m-d");
                            $datetime     = DateTime::createFromFormat('Y-m-d', $daterange);
                            //Convert tanggal untuk mendapatkan nama hari
                            $day         = $datetime->format('D');
                            $dayy         = $datetime->format("Y-m-d");
                            //Check untuk menghitung yang bukan hari sabtu dan minggu
                            if($day!="Sun" && $day!="Sat"  && $dayy!="2020-12-25" && $dayy!="2021-01-01" && $dayy!="2021-02-12" && $dayy!="2021-03-11"  && $dayy!="2021-04-02"
                             && $dayy!="2021-05-13" && $dayy!="2021-05-14" && $dayy!="2021-05-26" 
                                && $dayy!="2021-06-01" && $dayy!="2021-07-20" && $dayy!="2021-08-10" 
                                && $dayy!="2021-08-17" && $dayy!="2021-10-19" ) {
                                //echo $i;
                                $x    +=    ($end-$i);
                            }
                            $end++;
                            $i++;
                            } 
                      
                               $x  +=    ($end-$i) ;
                               echo $x;
                            ?></td>

<td style="text-align: center; vertical-align: middle;"><?php $hadir = $absensi->hadir+$absensi->tugas_luar_kantor+$absensi->tugas_luar_kota+$absensi->hadir_lembur;
                         echo $hadir > 0 ? $hadir : ''; ?></td>
<td style="text-align: center; vertical-align: middle;"><?php $lupa_absen = $absensi->lupa_absen_datang + $absensi->lupa_absen_pulang;
                    echo $lupa_absen > 0 ? $lupa_absen : ''; ?></td>
<td style="text-align: center; vertical-align: middle;"><?php $telat = $absensi->telat;  echo $telat > 0 ? $telat : ''; ?></td>
<td style="text-align: center; vertical-align: middle;"><?php $cuti = $absensi->cuti; echo $cuti > 0 ? $cuti : ''; ?></td>
<td style="text-align: center; vertical-align: middle;"><?php $sakit = $absensi->sakit; echo $sakit > 0 ? $sakit : ''; ?></td>
<td style="text-align: center; vertical-align: middle;"><?php $pla = $absensi->pulang_awal_izin + $absensi->pulang_awal_tanpa_izin; echo $pla > 0 ? $pla : ''; ?></td>
<!--<td align="center"><?php $pla_pot =  $absensi->pulang_awal_potong; echo $pla_pot > 0 ? $pla_pot : ''; ?></td> -->

 <td align="center" style="text-align: center; vertical-align: middle;"><?php $pot_um = $lupa_absen +$telat+$cuti+$sakit+$pla; echo $pot_um > 0 ? $pot_um : ''; ?></td>
<td align="center" style="text-align: center; vertical-align: middle;"><?php $total_hk =  $x - ($hadir + $lupa_absen + $telat + $cuti + $sakit + $pla); 
                            
                            echo $total_hk > 0 ? $total_hk : ''; ?></td>                                         
<td align="center" style="text-align: center; vertical-align: middle;"><?php  echo $total_hk > 0 ? $total_hk : ''; ?></td>                                       
 <td style="text-align: center; vertical-align: middle;"><?php $lembur = $absensi->L1 + $absensi->L2 + $absensi->L3 + $absensi->L4 + $absensi->L5 + $absensi->L6 ; echo $lembur > 0 ? $lembur : ''; ?></td>                                          
</tr>
                                    <?php endforeach ?>  <?php endif; ?>
                </table>
      
                <br/> 
                <br/> 
                <br/>              
       

    </body>
</html>