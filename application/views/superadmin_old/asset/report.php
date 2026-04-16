<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-3.min.css" rel="stylesheet">

<style type="text/css">
	body {
				margin-top: 0.1cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 0cm;
              background-image: url("<?= base_url('Login_v1') ?>/images/logo.png"); 
			  background-position:center center;   
			  background-repeat: no-repeat;
			  opacity: 0.2; 
		}
.table-bordered1{border:0px solid #C0C0C0}
.ft17{font: 8px 'Century Gothic';line-height: 0px;}
</style>
</head>
<body>
	<div id="page_1">
	<div class="row">
	<table border="0" cellspacing="0" style="width: 670px; /*border: 1px solid blue;*/ padding: 5px 0;">
			<thead>
				<tr> 
					                        <td style="border: 0px;" align="center">
 <img style="width: 100px;height: 100px" src="<?php echo base_url(); ?>img/logo.png"  alt="" class="img-circle"/></td>
				</tr>
				<tr>
					<td width="100px" height="17" style="font: 11px 'Century Gothic';line-height: 0px; text-align: center;"> <font color="black"><em>Ruko Sentra Niaga Blok. K No. 7 Greenlake City Duri Kosambi Cengkareng Jakarta Barat</em></font></td>
				</tr>
				<tr>
					<td width="100px" style="font: 11px 'Century Gothic';line-height: 0px; text-align: center;"> <font color="black"><em>p. 021 2972 5261  e. cassadesign@gmail.com  w. www.cassadesign.com</em></font></td>
				</tr>

			</thead>
		</table>
	
	</div>
	<hr>

	<div class="row">

		<table class="table table-bordered1" id="dataTable" width="100%" cellspacing="0" border="0" >
			<thead>
				<tr>
					<td width="100px"> <font color="black">ID / Project</font></td>
					<td width="15px">:</td>
					<td><font color="black"><?= $all_Mom->nama_project ?></font></td> 

				</tr>
				<tr>
					<td width="100px"> <font color="black">Date</font></td>
					<td width="15px">:</td>
					<td><font color="black"><?= $all_Mom->tanggal ?></font></td>
				</tr>
				<tr>
					<td width="100px"> <font color="black">Location</font></td>
					<td width="15px">:</td>
					<td><font color="black"><?= $all_Mom->lokasi ?></font></td>
				</tr>
				<tr>
					<td width="100px"> <font color="black">Partisipant</font></td>
					<td width="15px">:</td>
					<td><font color="black"><?= $all_Mom->partisipasi ?></font></td>
				</tr>
				<tr>
					<td width="100px"> <font color="black">Agenda</font></td>
					<td width="15px">:</td>
					<td><font color="black"><?= $all_Mom->agenda ?></font></td>
				</tr>
			</thead>
		</table>
	</div>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td style="text-align: center; vertical-align: middle;"><font color="black">Discussion</font></td> 
				</tr>
			</thead>
			<tbody>
					<tr>
						<td style="font: 14px"> <font color="black"><?= $all_Mom->diskusi ?></font></td>
					</tr>
			</tbody>
		</table>
	</div></div>
</body>
</html>