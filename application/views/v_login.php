<!DOCTYPE html>
<html lang="en">

<head>
  <title>Log In - Sewa Kapanpun Di Manapun</title>
  <link rel="icon" href="assets/images/app-logo.svg" type="image/x-icon">

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
  <meta name="author" content="Xiaoying Riley at 3rd Wave Media">

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- FontAwesome JS-->
  <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.min.js"></script>


  <!-- App CSS -->
  <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

  <style>
    .background-image {
      background-image: url('<?php echo base_url('assets/images/dsuser/hero_1_a.jpg'); ?>');
      background-size: cover;
      background-position: center;
      height: 100%;
    }

    #btn_signin {
      background-color: #51B37F;
      color: white;
      border: none;
    }

    #btn_signin:disabled {
      background-color: #7BD19B;
      color: white;
      opacity: 0.6;
      cursor: not-allowed;
    }
  </style>

</head>

<body class="app app-login p-0">
  <div class="row g-0 app-auth-wrapper">

    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5" id="loginForm">
      <div class="d-flex flex-column align-content-end">
        <div class="app-auth-body mx-auto">
          <h2 class="auth-heading text-center mb-5">Log In</h2>
          <?php if ($this->session->flashdata('error')): ?>
            <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
          <?php endif; ?>
          <div class="auth-form-container text-start">
            <form class="auth-form login-form" method="post" action="<?php echo site_url('login/authenticate'); ?>">
              <div class="email mb-3">
                <label class="sr-only" for="signin-username">Username</label>
                <input id="txusername" name="signin-username" type="text" class="form-control" placeholder="Username" required="required">
              </div>
              <div class="password mb-3">
                <label class="sr-only" for="signin-password">Password</label>
                <input id="txpassword" name="signin-password" type="password" class="form-control" placeholder="Password" required="required">
              </div>
              <div class="extra mt-3 row justify-content-between" style="margin-bottom: 30px;">
                <div class="col-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="RememberPassword" onclick="togglePasswordVisibility()">
                    <label class="form-check-label" for="RememberPassword">Lihat password</label>
                  </div>
                </div><!--//col-6-->
              </div>
              <div class="text-center">
                <button type="submit" class="btn app-btn-primary w-100" id="btn_signin" disabled>Log In</button>
              </div>
            </form>

            <div class="pt-2" style="text-align: right;">
              <a href="#" id="forgotPasswordLink" onclick="lupaPassword()" style="font-size: 0.9rem; color: #51B37F;">Lupa password?</a>
            </div>


            <div class="auth-option text-center pt-5">
              Belum punya akun? <a class="text-link" href="<?php echo base_url('signup'); ?>">Buat akun</a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5" id="forgotPasswordForm" style="display:none;">
      <div class="d-flex flex-column align-content-end">
        <div class="app-auth-body mx-auto">
          <h2 class="auth-heading text-center mb-4">Password Reset</h2>
          <div class="auth-intro mb-4 text-center">Masukkan alamat email Anda di bawah ini. Kami akan mengirimkan link reset ke email Anda</div>
          <div class="auth-form-container text-start">
            <form class="auth-form resetpass-form">
              <div class="email mb-3">
                <label class="sr-only" for="reg-email">Email</label>
                <input id="txemail" name="reg-email" type="email" class="form-control login-email" placeholder="Email" required="required">
              </div>
              <div class="text-center">
                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Reset Password</button>
              </div>
            </form>

            <div class="auth-option text-center pt-5">
              <a class="app-link" href="<?php echo base_url('login'); ?>" onclick="loginForm()">Log in</a>
              <span class="px-2">|</span>
              <a class="app-link" href="<?php echo base_url('signup'); ?>" onclick="signUpForm()">Sign up</a>
            </div>

          </div>
        </div>
      </div>
    </div> -->

    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5" id="forgotPasswordForm" style="display:none;">
      <div class="d-flex flex-column align-content-end">
        <div class="app-auth-body mx-auto">
          <h2 class="auth-heading text-center mb-4">Password Reset</h2>
          <div class="auth-intro mb-4 text-center">Masukkan alamat email Anda di bawah ini. Kami akan mengirimkan password Anda ke email Anda</div>
          <div class="auth-form-container text-start">
            <form class="auth-form resetpass-form" id="resetPasswordForm">
              <div class="email mb-3">
                <label class="sr-only" for="txemail">Email</label>
                <input id="txemail" name="reg-email" type="email" class="form-control login-email" placeholder="Email" required="required">
              </div>
              <div class="text-center">
                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Kirim Password</button>
              </div>
            </form>

            <div class="auth-option text-center pt-5">
              <a class="app-link" href="<?php echo base_url('login'); ?>" onclick="loginForm()">Log in</a>
              <span class="px-2">|</span>
              <a class="app-link" href="<?php echo base_url('signup'); ?>" onclick="signUpForm()">Sign up</a>
            </div>

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
    function myFunction() {
      var passwordField = document.getElementById("txpassword");
      if (passwordField.type === "password") {
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
      }
    }

    function validateForm() {
      var username = document.getElementById('txusername').value;
      var password = document.getElementById('txpassword').value;

      if (username !== '' && password !== '') {
        document.getElementById('btn_signin').disabled = false;
      } else {
        document.getElementById('btn_signin').disabled = true;
      }
    }

    document.getElementById('txusername').addEventListener('input', validateForm);
    document.getElementById('txpassword').addEventListener('input', validateForm);

    document.addEventListener('DOMContentLoaded', validateForm);

    function togglePasswordVisibility() {
      var passwordField = document.getElementById('txpassword');
      var checkbox = document.getElementById('RememberPassword');

      if (checkbox.checked) {
        passwordField.type = 'text';
      } else {
        passwordField.type = 'password';
      }
    }

    function lupaPassword() {
      document.getElementById('loginForm').style.display = 'none';
      document.getElementById('forgotPasswordForm').style.display = 'block';
    }

    function loginForm() {
      document.getElementById('forgotPasswordForm').style.display = 'none';
      document.getElementById('loginForm').style.display = 'block';
    }

    document.addEventListener("DOMContentLoaded", function() {
      const resetPasswordForm = document.getElementById("resetPasswordForm");
      const emailInput = document.getElementById("txemail");

      resetPasswordForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const email = emailInput.value.trim();

        if (email === "") {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email tidak boleh kosong!',
          });
          return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo site_url('login/reset_password'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
              Swal.fire({
                  icon: 'success',
                  title: 'Berhasil!',
                  text: response.message,
                })
                .then(() => {
                  window.location.href = "<?php echo site_url('login'); ?>";
                });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: response.message,
              });
            }
          }
        };

        xhr.send("email=" + encodeURIComponent(email));
      });
    });
  </script>
</body>

</html>