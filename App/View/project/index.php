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
            <h1 class="m-0">Projeler</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= _link(''); ?>">Keşfet</a></li>
              <li class="breadcrumb-item active">Projeler</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Proje</th>
                      <th>Proje Sahibi</th>
                      <th>Durum</th>
                      <th>İlerleyiş</th>
                      <th style="width: 40px">Eylem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['projects'] as $key => $value): ?>
                    <tr id="row_<?= $value['id']?>">
                      <td><?= $value['title']?></td>
                      <td><?= $value['customer_name'] ? '<a href='._link('musteri/detay/'.$value['customer_id']).'>'.$value['customer_name'].'</a>': null;?></td>
                      <td><?= $value['status'] == 'a' ? 'Aktif' : 'Pasif';?></td>
                      <td>
                        <?= $value['progress'];?>%
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: <?= $value['progress'];?>%"></div>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button onclick="confirm('<?= $value['id'] ?>')" class="btn btn-sm btn-danger">Sil</button>
                          <a href="<?= _link('proje/guncelle/'.$value['id'])?>" class="btn btn-sm btn-info">Güncelle</a>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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

  function confirm(id)
  {
    Swal.fire({
      title: 'Silmek istediğinize emin misiniz?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Sil',
      denyButtonText: 'Silme',
    }).then((result) => {
      if(result.isConfirmed)
      {
        removeProject(id)
      }
      else if(result.isDenied)
      {
        Swal.fire('Silinmedi!', '', 'Silinmedi')
      }
    })
  }

  function removeProject(id)
  {
    let project_id = id;

    let formData = new FormData();
    formData.append('project_id',id);

    axios.post('<?= _link('proje/sil') ?>', formData)

      .then(res => {

        if(res.data.removed)
        {
          document.getElementById('row_'+res.data.removed).remove();
        }
        Swal.fire(
          res.data.title,
          res.data.msg,
          res.data.status
        )


        console.log(res)})
      .catch((err) => { console.log(err)})
  }
</script>
<script>

</script>
</body>
</html>
