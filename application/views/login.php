 <!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('Login_v1') ?>/images/logo.png"/>

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('Login_v1') ?>/css/main.css">
<!--===============================================================================================-->

<!--===========Sweet Alert=========================================================================-->	
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>
<body> 
	<?php if ($this->session->flashdata('error')) { ?>
<script>
 swal("Gagal!", "Username Atau Password Salah!", "error");
</script>
     <?php } ?>
	<?php if ($this->session->flashdata('error01')) { ?>
<script>
 swal("Gagal!", "Sessi Berakhir, Login Kembali!", "error");
</script>
     <?php } ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
				
					<img src="<?= base_url('Login_v1') ?>/images/crm_logo.png" alt="IMG">
						<span class="login100-form-title">
						 
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="<?= base_url('login/proses_login') ?>">
					<!--<span class="login100-form-title">
							<img src="<?= base_url('Login_v1') ?>/images/logotulisan.png" width="200" height="100" alt="IMG">
					</span>-->

					<div class="wrap-input100 validate-input" data-validate = "Valid Username is required: ex@abc.xyz">
						<input class="input100" type="text" autocomplete name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-users" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" autocomplete name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						
					<select name="role" id="role" class="input100" required>
											<option value="">Masuk Sebagai</option>
													<option value="admin">Superadmin</option>
											
											<option value="karyawan">Karyawan</option>
					</select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>



				</form>
			</div>
		</div>
	</div>
	
	

<!--===============================================================================================-->	
	<script src="<?= base_url('Login_v1') ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('Login_v1') ?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('Login_v1') ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('Login_v1') ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('Login_v1') ?>/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url('Login_v1') ?>/js/main.js"></script>

</body>
</html>