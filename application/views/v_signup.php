<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sign Up - Sewa Kapanpun Di Manapun</title>
	<link rel="icon" href="assets/images/app-logo.svg" type="image/x-icon">

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<style>
		.background-image {
			background-image: url('<?php echo base_url('assets/images/dsuser/hero_1_a.jpg'); ?>');
			background-size: cover;
			background-position: center;
			height: 100%;
		}

		#btn_signup {
			background-color: #51B37F;
			color: white;
			border: none;
		}

		#btn_signup:disabled {
			background-color: #7BD19B;
			color: white;
			opacity: 0.6;
			cursor: not-allowed;
		}
	</style>

</head>

<body class="app app-signup p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<h2 class="auth-heading text-center mb-4">Sign Up</h2>
					<div class="auth-form-container text-start mx-auto">
						<form class="auth-form auth-signup-form" method="post" action="<?php echo site_url('signup/register'); ?>">
							<div class="email mb-3">
								<label class="sr-only" for="signup-name">Username</label>
								<input id="signup-name" name="signup-name" type="text" class="form-control signup-name" placeholder="Username" required="required">
								<small class="text-danger" id="username-error"></small>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Email</label>
								<input id="signup-email" name="signup-email" type="email" class="form-control signup-email" placeholder="Email" required="required">
								<small class="text-danger" id="email-error"></small>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Password</label>
								<input id="signup-password" name="signup-password" type="password" class="form-control signup-password" placeholder="Password" required="required">
							</div>
							<div class="extra mt-3 row justify-content-between" style="margin-bottom: 30px;">
								<div class="col-6">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="RememberPassword" onclick="myFunction()">
										<label class="form-check-label" for="RememberPassword">Lihat password</label>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100" id="btn_signup" disabled>Sign Up</button>
							</div>
						</form>
						<div class="auth-option text-center pt-5">Sudah punya akun? <a class="text-link" href="<?php echo base_url('login'); ?>">Masuk disini</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-5 col-lg-6 h-100 background-image">
			<div class="background-holder">
			</div>
			<div class="background-mask"></div>
			<div class="background-overlay p-3 p-lg-5">
			</div>
		</div>
	</div>

	<script>
		// $(document).ready(function() {
		// 	function validateForm() {
		// 		var username = $('#signup-name').val();
		// 		var email = $('#signup-email').val();
		// 		var password = $('#signup-password').val();
		// 		var usernameError = $('#username-error').text();
		// 		var emailError = $('#email-error').text();

		// 		if (username !== '' && email !== '' && password !== '' && usernameError === '' && emailError === '') {
		// 			$('#btn_signup').prop('disabled', false);
		// 		} else {
		// 			$('#btn_signup').prop('disabled', true);
		// 		}
		// 	}

		// 	$('#signup-name').on('input', function() {
		// 		var username = $(this).val();

		// 		$.ajax({
		// 			url: '<?php echo base_url('signup/check_username'); ?>',
		// 			method: 'POST',
		// 			data: {
		// 				username: username
		// 			},
		// 			success: function(response) {
		// 				var data = JSON.parse(response);
		// 				if (data.status === 'exists') {
		// 					$('#username-error').text('Username sudah ada');
		// 				} else {
		// 					$('#username-error').text('');
		// 				}
		// 				validateForm();
		// 			}
		// 		});
		// 	});

		// 	$('#signup-email').on('input', function() {
		// 		var email = $(this).val();
		// 		var emailError = $('#email-error');
		// 		var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

		// 		if (emailPattern.test(email)) {
		// 			emailError.text('');
		// 		} else {
		// 			emailError.text('Format email tidak valid');
		// 		}
		// 		validateForm();
		// 	});

		// 	$('#signup-password').on('input', function() {
		// 		validateForm();
		// 	});
		// });


		// function myFunction() {
		// 	var x = document.getElementById("signup-password");
		// 	if (x.type === "password") {
		// 		x.type = "text";
		// 	} else {
		// 		x.type = "password";
		// 	}
		// }

		$(document).ready(function() {
			function validateForm() {
				var username = $('#signup-name').val();
				var email = $('#signup-email').val();
				var password = $('#signup-password').val();
				var usernameError = $('#username-error').text();
				var emailError = $('#email-error').text();

				if (username !== '' && email !== '' && password !== '' && usernameError === '' && emailError === '') {
					$('#btn_signup').prop('disabled', false);
				} else {
					$('#btn_signup').prop('disabled', true);
				}
			}

			$('#signup-name').on('input', function() {
				var username = $(this).val();

				$.ajax({
					url: '<?php echo base_url('signup/check_username'); ?>',
					method: 'POST',
					data: {
						username: username
					},
					success: function(response) {
						var data = JSON.parse(response);
						if (data.status === 'exists') {
							$('#username-error').text('Username telah dipakai');
						} else {
							$('#username-error').text('');
						}
						validateForm();
					}
				});
			});

			$('#signup-email').on('input', function() {
				var email = $(this).val();
				var emailError = $('#email-error');
				var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

				if (emailPattern.test(email)) {
					emailError.text('');
				} else {
					emailError.text('Format email tidak valid');
				}

				$.ajax({
					url: '<?php echo base_url('signup/check_email'); ?>',
					method: 'POST',
					data: {
						email: email
					},
					success: function(response) {
						var data = JSON.parse(response);
						if (data.status === 'exists') {
							$('#email-error').text('Email sudah terdaftar');
						} else {
							$('#email-error').text('');
						}
						validateForm();
					}
				});
			});

			$('#signup-password').on('input', function() {
				validateForm();
			});
		});

		function myFunction() {
			var x = document.getElementById("signup-password");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>
</body>

</html>