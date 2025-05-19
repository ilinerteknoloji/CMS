<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= assets('plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= assets('plugins/sweetalert2/sweetalert2.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= assets('css/adminlte.min.css') ?>">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b>CMS</b>Project</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Müşteri Yönetim Alanına Giriş Yapmak için Bilgilerinizi Doldurunuz.</p>

      <form id="login">
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="E-Posta">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Şifre">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js')?>"></script>
<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js" integrity="sha512-DdX/YwF5e41Ok+AI81HI8f5/5UsoxCVT9GKYZRIzpLxb8Twz4ZwPPX+jQMwMhNQ9b5+zDEefc+dcvQoPWGNZ3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  const login = document.getElementById('login');
  login.addEventListener('submit', (e) => {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    let formData = new FormData();
    formData.append('email',email);
    formData.append('password',password);

    console.log(email, password);

    axios.post('<?= $form_link; ?>', formData)
      .then(res => {
        
        if(res.data.redirect)
        {
          window.location.href = res.data.redirect;
        }
        Swal.fire(
          res.data.title,
          res.data.msg,
          res.data.status
        )

        console.log(res)})
      .catch((err) => { console.log(err)})

    e.preventDefault();
  });
</script>
</body>
</html>
