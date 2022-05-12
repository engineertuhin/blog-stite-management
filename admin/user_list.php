<?php
include('../config.php');


if (isset($_POST['accept'])) {
  $id = $_POST['id'];
  $updateQueryaccept = "UPDATE users set status = 1 WHERE id = $id";
  if ($con->query($updateQueryaccept) == true) {
    $acceptMsg = "User Accepted";
  }
}

if (isset($_POST['unaccept'])) {
  $id = $_POST['id'];
  $updateQueryaccept = "UPDATE users set status = 0 WHERE id = $id";
  if ($con->query($updateQueryaccept) == true) {
    $acceptMsg = "User unaccepted";
  }
}

$query = "SELECT * FROM users";
$data = $con->query($query);
$users = $data->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User List</title>

  <?php include('common/css.php') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include('common/header.php') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <?php include('common/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User List</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="float-left">
                    <h3 class="card-title">User List</h3>
                  </div>
                  <div class="float-right">
                    <button type="button" class="btn btn-primary f-right" data-target="#userModal" data-toggle="modal">Add User</button>
                  </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $key => $user) { ?>
                        <tr>
                          <td><?php echo $key + 1 ?></td>
                          <td><?php echo $user['user_name'] ?></td>
                          <td><?php echo $user['email'] ?></td>
                          <td><?php if ($user['status'] == 1) { ?>
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-accept<?php echo $user['id'] ?>">
                                Active
                              </button>
                            <?php } else { ?>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-unaccept<?php echo $user['id'] ?>">
                                Inactive
                              </button>
                            <?php } ?>
                          </td>
                          <td><button type="button" class="btn btn-block btn-success">Edit</button><button type="button" class="btn btn-block btn-danger">Delete</button></td>
                        </tr>

                        <div class="modal fade" id="modal-accept<?php echo $user['id'] ?>">
                          <div class="modal-dialog">
                            <form method="POST">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Status Change</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Are You Sure Unaccept&hellip;</p>
                                  <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="unaccept" class="btn btn-primary">Unaccept</button>
                                </div>
                              </div>
                            </form>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="modal-unaccept<?php echo $user['id'] ?>">
                          <div class="modal-dialog">
                            <form method="POST">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Status Change</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Are You Sure Accept&hellip;</p>
                                  <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="accept" class="btn btn-primary">Accept</button>
                                </div>
                              </div>
                            </form>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      <?php } ?>

                      </tfoot>
                  </table>
                </div>


                <!-- add user in admin -->
                <div class="modal fade" id="userModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card card-primary">
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form>
                            <div class="card-body">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- end user modal in admin        /.modal-dialog -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <?php include('common/footer.php') ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php include('common/js.php') ?>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>