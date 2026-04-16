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
                        <td width="85px" style="text-align: center; vertical-align: middle;" ><strong>EMPLOYEE ID </strong></td>                
                        <td width="146px" style="text-align: center; vertical-align: middle;" ><strong>NAMA</strong></td>    
                       
                        <td width="63px" style="text-align: center; vertical-align: middle;" ><strong>HARI</strong></td>
                        <td width="50px" style="text-align: center; vertical-align: middle;" ><strong>TGL </strong></td>
                        <td width="51px" style="text-align: center; vertical-align: middle;" ><strong>DATANG</strong></td>
                        <td width="40px" style="text-align: center; vertical-align: middle;" ><strong>PULANG</strong></td>
                        <td width="50px" style="text-align: center; vertical-align: middle;" ><strong>LEMBUR </strong></td>
                        <td width="71px" style="text-align: center; vertical-align: middle;" ><strong>KET</strong></td> 
                        
                
                    </tr>
                
                 <?php $no = 1; if (!empty($absensi)):foreach ($absensi as $data => $v_application): ?>
                      <tr class="payment_history"> 
                        <td width="15px" style="text-align: center; vertical-align: middle;" ><?php echo $no++; ?> </td> 
                        <td width="85px" style="text-align: center; vertical-align: middle;" ><?php echo $v_application->EmployeeID; ?> </td>  
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
                        <td width="50px" style="text-align: center; vertical-align: middle;" ><?php echo date('d-m-Y', strtotime($v_application->tanggal)); ?></td>
                    

                        <td width="51px" style="text-align: center; vertical-align: middle; font-weight:bold;" ><?php  
                            $att_in = $v_application->cek_in ;
                            echo $att_in > 0 ? $att_in : ' ';
                              ?>
                            </td>
                
                        <td width="40px" style="text-align: center; vertical-align: middle; font-weight:bold;" ><?php  
                            $att_out = $v_application->cek_out ;
                            echo $att_out > 0 ? $att_out : ' ';
                              ?></td>
                        <td width="50px" style="text-align: center; vertical-align: middle;   ">
                        <?php  
                            $othour = $v_application->out ;
                            echo $othour > 0 ? $othour : ' ';
                              ?>  </td> 
                        <td width="71px" style="text-align: center; vertical-align: middle;" ><?php echo $v_application->jenis; ?> </td>
                                        
                        </tr>            
                                           
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
      
                <br/> 
                <br/> 
                <br/>              
       

    </body>
</html>