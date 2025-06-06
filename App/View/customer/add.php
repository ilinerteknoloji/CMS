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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= assets('css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <?= $data['navbar']; ?>
  <?= $data['sidebar']; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Müşteriler</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= _link(''); ?>">Keşfet</a></li>
              <li class="breadcrumb-item"><a href="<?= _link('musteri'); ?>">Keşfet</a></li>
              <li class="breadcrumb-item active">Ekle</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    <form id="customer">
      <div class="card-body">
        <div class="form-group">
          <label for="customer_name">Müşteri Adı</label>
          <input type="text" class="form-control" id="customer_name">
        </div>
        <div class="form-group">
          <label for="customer_surname">Müşteri Soyadı</label>
          <input type="text" class="form-control" id="customer_surname">
        </div>
        <div class="form-group">
          <label for="customer_company">Firma Adı</label>
          <input type="text" class="form-control" id="customer_company">
        </div>
        <div class="form-group">
          <label for="customer_phone">Sabit Hat</label>
          <input type="text" class="form-control" id="customer_phone">
        </div>
        <div class="form-group">
          <label for="customer_gsm">Telefon Numarası</label>
          <input type="text" class="form-control" id="customer_gsm">
        </div>
        <div class="form-group">
          <label for="customer_email">E-Mail</label>
          <input type="text" class="form-control" id="customer_email">
        </div>
        <div class="form-group">
          <label for="customer_address">Müşteri Adresi</label>
          <textarea class="form-control" id="customer_address"></textarea>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Müşteri Ekle</button>
      </div>
    </form>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

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
  const customer = document.getElementById('customer');
  customer.addEventListener('submit', (e) => {

    let customer_name = document.getElementById('customer_name').value;
    let customer_surname = document.getElementById('customer_surname').value;
    let customer_company = document.getElementById('customer_company').value;
    let customer_phone = document.getElementById('customer_phone').value;
    let customer_gsm = document.getElementById('customer_gsm').value;
    let customer_email = document.getElementById('customer_email').value;
    let customer_address = document.getElementById('customer_address').value;

    let formData = new FormData();
    formData.append('customer_name',customer_name);
    formData.append('customer_surname',customer_surname);
    formData.append('customer_company',customer_company);
    formData.append('customer_phone',customer_phone);
    formData.append('customer_gsm',customer_gsm);
    formData.append('customer_email',customer_email);
    formData.append('customer_address',customer_address);

    axios.post('<?= _link('musteri/ekle') ?>', formData)
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
