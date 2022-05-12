    <?php
    include('config.php');

    if (isset($_COOKIE['id'])) {
        $user_id = $_COOKIE['id'];
        $query = "SELECT * FROM users where id = $user_id";
        $user = $con->query($query);
        $userData = $user->fetch_assoc();
    }




    ?>
    <!-- header -->
    <header class="w3l-header">
        <!--/nav-->
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <span class="fa fa-pencil-square-o"></span> Technology Blog</a>
                <!-- if logo is image enable this   
						<a class="navbar-brand" href="#index.html">
							<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
						</a> -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item @@contact__active">
                            <a class="nav-link" href="Allpost.php">All Post</a>
                        </li>
                        <li class="nav-item @@contact__active">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>

                    <!--/search-right-->
                    <div class="search-right mt-lg-0 mt-2">
                        <a href="#search" title="search"><span class="fa fa-search" aria-hidden="true"></span></a>
                        <!-- search popup -->
                        <div id="search" class="pop-overlay">
                            <div class="popup">
                                <h3 class="hny-title two">Search here</h3>
                                <form action="#" method="Get" class="search-box">
                                    <input type="search" placeholder="Search for blog posts" name="search" required="required" autofocus="">
                                    <button type="submit" class="btn">Search</button>
                                </form>
                                <a class="close" href="#close">×</a>
                            </div>
                        </div>
                        <!-- /search popup -->
                    </div>
                    <!--//search-right-->

                    <!-- author -->


                    <!-- // author-->
                    <div class="header-author d-flex ml-lg-4 pl-2 mt-lg-0 mt-3">
                        <?php if (!empty($_COOKIE['id'])) { ?>
                            <div class="header-author d-flex ml-lg-4 pl-2 mt-lg-0 mt-3">
                                <a class="img-circle img-circle-sm" href="profile.php">
                                    <img src="<?php if(empty($userData['image'])){
                        echo"frontend/image/download.jpg";
                  }else{
                   echo "frontend/image/".$userData['image'];
                  }?>" class="img-fluid" alt="...">
                                </a>
                                <div class="align-self ml-3">
                                    <a href="profile.php">
                                        <h5><?php echo $userData['user_name'] ?></h5>
                                    </a>
                                    <span>Blog Writer</span>
                                </div>
                            </div>
                            <li class="nav-item @@contact__active">

                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item @@contact__active">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php } ?>
                    </div>
                </div>

                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
                <!-- //toggle switch for light and dark theme -->
            </div>
        </nav>
        <!--//nav-->
    </header>
    <!-- //header -->