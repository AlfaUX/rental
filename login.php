<?php
$judul_browser = "LOGIN MICROPHILE";
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $judul_browser; ?>
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="./dist/css/sweetalert2.min.css">
  <link rel="icon" type="image/x-icon" href="./dist/img/android.ico">
  <link rel="stylesheet" href="./dist/css/font-awesome.min.css">
  <link rel="stylesheet" href="./dist/css/ionicons.min.css">
  <link rel="stylesheet" href="./dist/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="./dist/css/_all-skins.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="dist/img/download.png" style="width: 150px;"><br>
      <a href="login.php"><b>Login</b> Akun</a>
    </div>
    <div class="login-box-body">
      <form id="loginForm" action="proseslogin.php" method="post" onsubmit="return cekLogin(this)">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Masukkan Username" data-hover-message="User" name="user"
            id="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Masukkan Password" data-hover-message="Password"
            name="pass" id="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div><br>
        <div class="row">
          <div class="col-xs-12">
            <button type="button" class="btn btn-primary btn-flat pull-left" onclick="autoFillAndSubmit()">Login
              Tamu</button>
            <button type="submit" class="btn btn-primary btn-flat pull-right">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script language="javascript">
    function cekLogin(form) {
      if (form.user.value == "") {
        swal('INFORMASI', 'Username tidak boleh kosong', 'error');
        form.user.focus();
        return (false);
      } else if (form.pass.value == "") {
        swal('INFORMASI', 'Password tidak boleh kosong', 'error');
        form.pass.focus();
        return (false);
      } else {
        return (true);
      }
    }
    function getUrlParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    document.addEventListener("DOMContentLoaded", function () {
      const showAlert = getUrlParam("showAlert");
      if (showAlert == "1") {
        swal('KESALAHAN', 'GAGAL LOGIN, SILAHKAN HUBUNGI ADMIN', 'error');
      } else if (showAlert === "2") {
        swal('KESALAHAN', 'GAGAL LOGIN, USERNAME ATAU PASSWORD SALAH!', 'error');
      }
    });
    function autoFillAndSubmit() {
      const usernameField = document.getElementById("username");
      const passwordField = document.getElementById("password");

      usernameField.value = "tamu";
      passwordField.value = "tamu";

      document.getElementById("loginForm").submit();
    }
  </script>
  <script src="./dist/js/jquery.min.js"></script>
  <script src="./dist/js/bootstrap.min.js"></script>
  <script src="./dist/js/sweetalert2.min.js"></script>
  <script src="./dist/js/validasi.js"></script>

  <script src="./dist/js/jquery.dataTables.min.js"></script>
  <script src="./dist/js/dataTables.bootstrap.min.js"></script>
  <script src="./dist/js/jquery.slimscroll.min.js"></script>
  <script src="./dist/js/fastclick.js"></script>
  <script src="./dist/js/adminlte.min.js"></script>
  <script src="./dist/js/demo.js"></script>
</body>

</html>