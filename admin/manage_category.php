<?php 
    include('../config.php');
    if(isset($_POST['categorySubmit'])){
        $name = $_POST['name'];
        $des = $_POST['des'];
        $status = $_POST['status'];
        $sql = "INSERT INTO categories (name, des, status) values('$name', '$des', $status)";

        if($con->query($sql) == true){
            $successMessage = "Category Added successfully";
        }else{
            $errorMessage = "Something is wrong";
        }
    }

    if(isset($_POST['categoryChange'])){
        $name = $_POST['name'];
        $des = $_POST['des'];
        $status = $_POST['status'];
        $id = $_POST['id'];
        $sql = "UPDATE categories SET name = '$name', des = '$des', status = $status where id = $id";

        if($con->query($sql) == true){
            $successMessage = "Category Updated successfully";
        }else{
            $errorMessage = "Something is wrong";
        }
    }



    $showSql = 'SELECT * FROM categories';
    $data = $con->query($showSql);
    $categories = $data->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Category</title>

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
                            <h1>Manage Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manage Category</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <?php if(isset($successMessage)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage ?>
                </div>
                <?php }if(isset($errorMessage)){ ?>
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
                                        <h3 class="card-title">Manage Category</h3>
                                    </div>
                                    <div class="float-right">
                                        <button type="button" class="btn btn-primary f-right"
                                            data-target="#categoryModal" data-toggle="modal">Add Category</button>
                                    </div>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($categories as $key=>$category) { ?>
                                            <tr>
                                                <td><?php echo $key + 1 ?></td>
                                                <td><?php echo $category['name'] ?></td>
                                                <td><?php echo $category['des'] ?></td>

                                                <td>
                                                    <?php if($category['status'] == 1) { ?>
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#modal-default">
                                                        Active
                                                    </button>
                                                    <?php } else { ?>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modal-default">
                                                        Inactive
                                                    </button>

                                                    <?php } ?>

                                                </td>
                                                <td><button type="button"
                                                        class="btn btn-block btn-success" data-toggle="modal"
                                                        data-target="#modal-editCategory<?php echo $category['id'] ?>">Edit</button><button
                                                        type="button" class="btn btn-block btn-danger">Delete</button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="modal-editCategory<?php echo $category['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Category</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card card-primary">
                                                        <!-- /.card-header -->
                                                        <!-- form start -->
                                                        <form method="POST">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Name</label>
                                                                    <input type="text" class="form-control" name="name"
                                                                        id="exampleInputEmail1"
                                                                        placeholder="Enter Category Name" value="<?php echo $category['name'] ?>" required>
                                                                </div>
                                                                <input type="hidden" value="<?php echo $category['id'] ?>" name="id">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Description</label>
                                                                    <textarea class="form-control" name="des"
                                                                        id="exampleInputPassword1"
                                                                        placeholder=""><?php echo $category['des'] ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Status</label>
                                                                    <select class="form-control" name="status">

                                                                        <option value="1" <?php echo ($category['status'] == 1) ? 'selected' : ''?>>Active</option>
                                                                        <option value="0" <?php echo ($category['status'] == 0) ? 'selected' : ''?>>In Active</option>
                                                                    </select>
                                                                </div>

                                                            </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        name="categoryChange">Save Changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                            <?php } ?>

                                            </tfoot>
                                    </table>
                                </div>

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Status Change</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are You Sure Cheange Status&hellip;</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- add user in admin -->
                                <div class="modal fade" id="categoryModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Category</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-primary">
                                                    <!-- /.card-header -->
                                                    <!-- form start -->
                                                    <form method="POST">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="exampleInputEmail1"
                                                                    placeholder="Enter Category Name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Description</label>
                                                                <textarea class="form-control" name="des"
                                                                    id="exampleInputPassword1"
                                                                    placeholder=""></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Status</label>
                                                                <select class="form-control" name="status">

                                                                    <option value="1" selected>Active</option>
                                                                    <option value="0">In Active</option>
                                                                </select>
                                                            </div>

                                                        </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"
                                                    name="categorySubmit">Save</button>
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