<?php
session_start();
include('config.php');
   if(empty($_COOKIE['id']))
   {
       header('location:index.php');
   }
   if (isset($_COOKIE['id'])) {
       $user_id = $_COOKIE['id'];
       $query = "SELECT * FROM users where id = $user_id";
       $user = $con->query($query);
       $userData = $user->fetch_assoc();
   }
$categoty_query="select * from categories";
$categoty_data_send=$con->query($categoty_query);
if(isset($_REQUEST['insert'])){
   $Title=$_REQUEST['title'];
    $description=$_REQUEST['descriptopn'];
    $category=$_REQUEST['category'];
    $image=$_FILES['image']['name'];
    $tmep=$_FILES['image']['tmp_name'];
    $dublicate=time().rand().$image;
    $extention=explode('.',$image);
   $orginale_extention= end($extention);
   $encription= Uniqid($dublicate).'.'.$orginale_extention;
    if(empty($Title) or empty($description) or empty($category) or empty($image)){
      $massage='<h4 style="color:red">Please Feelup All Section</h4>';
    }else if(in_array($orginale_extention,['JPG','jpg','png',"PNG"])==false){
        $massage='<h4 style="color:red">Only jpg or png image can upload</h4>';
    }else{
        $query="INSERT INTO `blogs`( `user_id`, `category_id`,`title`, `des`, `image`, `post`) VALUES ('$user_id','$category','$Title','$description','$encription','user')";
       $send=$con->query($query);
       if($send==true){
        move_uploaded_file($tmep,'frontend/image/'.$encription);
        header('location:profile.php');
       }
    }

}
$postdata="select * from blogs where user_id='$user_id' order By id DESC";
$post=$con->query($postdata);

?>
<!DOCTYPE html>

<html>

<head>

</head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="frontend/common/profile.css">
<link rel="stylesheet" href="frontend/common/a.css">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

<body>
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index.php">Home</a>
                <!-- Form -->
                <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" placeholder="Search" type="text">
                        </div>
                    </div>
                </form>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                <img style="height:35px;width: 40px;" alt="Image placeholder" src="<?php if(empty($userData['image'])){
                        echo"frontend/image/download.jpg";
                  }else{
                   echo "frontend/image/".$userData['image'];
                  }?>">
                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $userData['user_name']?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>Settings</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-calendar-grid-58"></i>
                                <span>Activity</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>Support</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#!" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(<?php if(isset($userData['image'])!=''){
                      echo "frontend/image/".$userData['image'];
                  }else{
                   echo"frontend/image/download.jpg";
                  }?>); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Hello <?php echo $userData['user_name']?></h1>
                        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                        <a href="profile_edit.php" class="btn btn-info">Edit profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                    <img style="height: 185px;width: 215px;" src="<?php if(empty($userData['image'])){
                        echo"frontend/image/download.jpg";
                  }else{
                   echo "frontend/image/".$userData['image'];
                  }?>" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        <div>
                                            <span class="heading">22</span>
                                            <span class="description">Friends</span>
                                        </div>
                                        <div>
                                            <span class="heading">10</span>
                                            <span class="description">Photos</span>
                                        </div>
                                        <div>
                                            <span class="heading">89</span>
                                            <span class="description">Comments</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                <?php echo $userData['user_name']?><span class="font-weight-light">, 27</span>
                                </h3>
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>Bucharest, Romania
                                </div>
                                <div class="h5 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>University of Computer Science
                                </div>
                                <hr class="my-4">
                                <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                                <a href="#">Show more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">My account</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <h6 class="heading-small text-muted mb-4">Add new Post</h6>
                                <div class="pl-lg-4">
                                    <?php if(isset($massage)){
                                        echo $massage;
                                        }?>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input name='title' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your Title">
                                    </div>
                                    <div class="form-group focused">
                                        <label>Description</label>
                                        <textarea name='descriptopn' rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..."></textarea>
                                    </div>
                                    <select name='category' class="form-select" aria-label="Default select example">
                                        <option value=''>Select any Categories</option>
                                    <?php while($data=$categoty_data_send->fetch_assoc()):?>
                                        <option value="<?php echo $data['id']?>"><?php echo $data['name']?></option>
                                        <?php endwhile?>
                                        </select>
                                    <div>
                                        <input name="image" style="margin-top: 10px;" type="file" name="" id="">
                                    </div>
                                    <div class="">
                                        <button name='insert' style="height: 44px;width: 81px; font-size: 19px;margin-top:10px;" type="submit" class="btn btn-sm btn-primary">POST</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card bg-secondary shadow" style="margin-top:10px">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">All Post</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="container bootstrap snippets bootdey ">
                                <?php while($allpost=$post->fetch_assoc()):
                                    if($allpost['status']==0){
                                        $opecity='style="opacity: 50%;"';
                                        $mas="<h4 style='color:red'>waiting For Admin Permision</h4>";
                                    }else{
                                        $opecity='';
                                        $mas="";
                                    }
                                    ?>
                                <div class="col-md-8" <?php if(isset($opecity)){
                                    echo $opecity;
                                }
                                    ?>>
                                    <div class="col-sm-12">
                                        <div class="panel panel-white post panel-shadow">
                                            <div class="post-heading">
                                                <div class="pull-left image">
                                                    <img src="<?php if(isset($userData['image'])!=''){
                      echo "frontend/image/".$userData['image'];
                  }else{
                   echo"frontend/image/download.jpg";
                  }?>" class="img-circle avatar" alt="user profile image">
                                                </div>
                                                <div class="pull-left meta">
                                                    <div class="title h5">
                                                        <a href="#"><b><?php echo $userData['user_name']?></b></a> Post <?php  if(isset($mas)){
                                                          echo $mas;  }?>
                                                    </div>
                                                    <h6 class="text-muted time">5 seconds ago</h6>
                                                </div>
                                            </div>
                                            <div class="post-image">
                                                <img style="max-height: 400px;" src="frontend/image/<?php echo $allpost['image'];?>" class="image" alt="image post">
                                            </div>
                                            <div class="post-description">
                                                <h4><?php echo $allpost['title'];?></h4>
                                                <p><?php echo $allpost['des'];?></p>
                                                <div class="stats">
                                                    <a href="#" class="btn btn-default stat-item">
                                                        <i class="fa fa-thumbs-up icon"></i>228
                                                    </a>
                                                    <a href="#" class="btn btn-default stat-item">
                                                        <i class="fa fa-share icon"></i>128
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6 m-auto text-center">
                <div class="copyright">
                    <p>Made with <a href="https://www.creative-tim.com/product/argon-dashboard" target="_blank">Argon Dashboard</a> by Creative Tim</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>