<?php
include('../config.php');
if (isset($_POST['blogSubmit'])) {
    $category_id = $_POST['category'];

    $title = $_POST['title'];
    $des = $_POST['des'];
    $image=$_FILES['image']['name'];
    $tmep=$_FILES['image']['tmp_name'];
       $dublicate=time().rand().$image;
       $extention=explode('.',$image);
      $orginale_extention= end($extention);
      $encription= Uniqid($dublicate).'.'.$orginale_extention;
    if (isset($_POST['high']) == 'on') {
        $high = 1;
    } else {
        $high = 0;
    }
    $status = $_POST['status'];
    $sql = "INSERT INTO blogs (`category_id`,`title`, `des`, `image`, `status`, `post`, `highlight`) values('$category_id','$title', '$des','$encription','$status','Admin','$high')";

    if ($con->query($sql) == true) {
        $successMessage = "blog Added successfully";
        move_uploaded_file($tmep,'../frontend/image/'.$encription);
    } else {
        $errorMessage = $con->error;
    }
}

if (isset($_POST['blogEditSubmit'])) {
    $category_id = $_POST['category'];
    $title = $_POST['title'];
    $des = $_POST['des'];
    $post = $_POST['post'];
    $old=$_REQUEST['oldimage'];
    $image=$_FILES['image']['name'];
    $tmep=$_FILES['image']['tmp_name'];
       $dublicate=time().rand().$image;
       $extention=explode('.',$image);
      $orginale_extention= end($extention);
      $encription= Uniqid($dublicate).'.'.$orginale_extention;
      if(empty($image)){
        $newimage=$_REQUEST['oldimage'];
    }else{
        $newimage=$encription;
        unlink('../frontend/image/'.$old);
    }
    if (isset($_POST['high']) == 'on') {
        $high = 1;
    } else {
        $high = 0;
    }
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql = "UPDATE blogs set category_id = '$category_id', title = '$title', des = '$des',image='$newimage',status = '$status',post='$post', highlight = '$high' where id = $id ";

    if ($con->query($sql) == true) {
        $successMessage = "blog Updated successfully";
        move_uploaded_file($tmep,'../frontend/image/'.$encription);
    } else {
        $errorMessage = $con->error;
    }
}
if (isset($_POST['BlogDeleteSubmit'])) {
    $id = $_POST['id'];
    $imagedelete=$_REQUEST['deleteimage'];
    $sql = "DELETE from blogs where id = $id ";

    if ($con->query($sql) == true) {
        $successMessage = "blog Delete successfully";
        unlink('../frontend/image/'.$imagedelete);
    } else {
        $errorMessage = $con->error;
    }
}





$showSql1 = 'SELECT * FROM categories';
$data1 = $con->query($showSql1);
$categories = $data1->fetch_all(MYSQLI_ASSOC);

$showSql = 'SELECT bl.*, cat.name FROM categories as cat, blogs as bl where cat.id = bl.category_id ORDER BY ID DESC';
$data = $con->query($showSql);
$blogs = $data->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage blog</title>

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
                            <h1>Manage blog</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manage blog</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <?php if (isset($successMessage)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $successMessage ?>
                    </div>
                <?php }
                if (isset($errorMessage)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo isset($errorMessage) ? $errorMessage : '' ?>
                    </div>
                <?php } ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-left">
                                        <h3 class="card-title">Manage blog</h3>
                                    </div>
                                    <div class="float-right">
                                        <button type="button" class="btn btn-primary f-right" data-target="#blogModal" data-toggle="modal">Add blog</button>
                                    </div>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Category Name</th>
                                                <th>Title</th>
                                                <th>Post</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($blogs as $key => $blog) { ?>
                                                <tr>
                                                    <td><?php echo $key + 1 ?></td>
                                                    <td><?php echo $blog['name'] ?></td>
                                                    <td><?php echo $blog['title'] ?></td>
                                                    <td><?php echo $blog['post'] ?></td>
                                                    <td><?php echo $blog['des'] ?></td>

                                                    <td>
                                                        <?php if ($blog['status'] == 1) { ?>
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                                                Active
                                                            </button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
                                                                Inactive
                                                            </button>

                                                        <?php } ?>

                                                    </td>
                                                    <td><button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-editblog<?php echo $blog['id'] ?>">Edit</button><button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $blog['id'] ?>">Delete</button>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="modal-editblog<?php echo $blog['id'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit blog</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card card-primary">
                                                                    <!-- /.card-header -->
                                                                    <!-- form start -->
                                                                    <form method="POST" enctype="multipart/form-data">
                                                                        <div class="card-body">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Category
                                                                                    Name</label>
                                                                                <select class="form-control" name="category">
                                                                                    <option value="" disabled>Select
                                                                                        Category</option>

                                                                                    <?php foreach ($categories as $categroy) { ?>
                                                                                        <option <?php if ($categroy['id'] == $blog['category_id']) { ?> selected <?php } ?> value="<?php echo $categroy['id'] ?>">
                                                                                            <?php echo $categroy['name'] ?>
                                                                                        </option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name='post' value="<?php echo $blog['post'] ?>">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Title</label>
                                                                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter blog Name" value="<?php echo $blog['title'] ?>" required>
                                                                            </div>
                                                                            <input type="hidden" value="<?php echo $blog['id'] ?>" name="id" />
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">Description</label>
                                                                                <textarea class="form-control" name="des" id="exampleInputPassword1" placeholder=""><?php echo $blog['des'] ?></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">highlight</label>
                                                                                <input type="checkbox" name="high" <?php if ($blog['highlight'] == 1) { ?>checked <?php } ?> />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">Status</label>
                                                                                <select class="form-control" name="status">

                                                                                    <option value="1" selected>Active
                                                                                    </option>
                                                                                    <option value="0">In Active</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">Old Image</label>
                                                                               <img height="100px" width="100px" src="../frontend/image/<?php echo $blog['image'] ?>" alt="">
                                                                               <input type="hidden" value="<?php echo $blog['image'] ?>" name="oldimage">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">new Image</label>
                                                                                <input name='image' type="file" >
                                                                              
                                                                            </div>

                                                                        </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="blogEditSubmit">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <div class="modal fade" id="modal-delete<?php echo $blog['id'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Status Change</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    <p>Are You Sure Delete&hellip;</p>
                                                                    <input type="hidden" value="<?php echo $blog['id'] ?>" name="id" />
                                                                    <input type="hidden" name='deleteimage' value="<?php echo $blog['image'] ?>" name="id" />
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger" name="BlogDeleteSubmit">Delete</button>
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
                                <div class="modal fade" id="blogModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add blog</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-primary">
                                                    <!-- /.card-header -->
                                                    <!-- form start -->
                                                    <form method="POST" enctype="multipart/form-data">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Category Name</label>
                                                                <select class="form-control" name="category">
                                                                    <option value="" disabled selected>Select Category
                                                                    </option>

                                                                    <?php foreach ($categories as $categroy) { ?>
                                                                        <option value="<?php echo $categroy['id'] ?>">
                                                                            <?php echo $categroy['name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Title</label>
                                                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter blog Name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Description</label>
                                                                <textarea class="form-control" name="des" id="exampleInputPassword1" placeholder=""></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">highlight</label>
                                                                <input type="checkbox" name="high" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Status</label>
                                                                <select class="form-control" name="status">

                                                                    <option value="1" selected>Active</option>
                                                                    <option value="0">In Active</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">image</label>
                                                                <input type="file" class="form-control" name="image" id="exampleInputPassword1" >
                                                            </div>

                                                        </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="blogSubmit">Save</button>
                                            </div>
                                            </form>
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