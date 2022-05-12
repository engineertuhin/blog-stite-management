<?php
session_start();
include('config.php');
$query="select users.user_name,blogs.id,blogs.user_id,blogs.title,blogs.des,blogs.image,blogs.status,blogs.post,blogs.highlight,blogs.created_at,
categories.name from blogs left join users  on blogs.user_id=users.id left join categories on blogs.category_id=categories.id   WHERE blogs.status = 1 ORDER BY blogs.id DESC limit 4";
 $get=$con->query($query);
$data= $get->fetch_assoc();
$highlite="select users.user_name,blogs.id,blogs.user_id,blogs.title,blogs.des,blogs.image,blogs.status,blogs.post,blogs.highlight,blogs.created_at from blogs left join users  on blogs.user_id=users.id  WHERE blogs.status = 1 and blogs.highlight=1 ORDER BY blogs.id DESC limit 4";
$highlited=$con->query($highlite);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home</title>

    <?php include('frontend/common/css.php'); ?>
</head>

<body>
    <?php include('frontend/common/header.php'); ?>

    <div class="w3l-homeblock1 py-5">
        <div class="container pt-lg-5 pt-md-4">
            <!-- block -->
            <div class="row">
                <div class="col-lg-9">
                    <h3 class="section-title-left">Featured posts </h3>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 item">
                            <div class="card">
                                <div class="card-header p-0 position-relative">
                                    <a href="Post.php?id=<?php echo $data['id'] ?>">
                                        <img class="card-img-bottom d-block radius-image" src="frontend/image/<?php echo $data['image']?>" alt="Card image cap">
                                    </a>
                                </div>

                                <div class="card-body p-0 blog-details">
                                    <a href="Post.php?id=<?php echo $data['id']?>" class="blog-desc"><?php echo $data['title'] ?>
                                    </a>
                                    <p style="height:100px; display: block;line-height: 1.3em;-webkit-line-clamp: 5;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;"><?php echo $data['des'] ?></p>
                                    <div class="author align-items-center mt-3 mb-1">
                                        <a href="#author"><?php if(empty($data['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $data['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                                    </div>
                                    <ul class="blog-meta">
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> <?php $date=strtotime($data['created_at']);
                                            echo date('M/d/Y', $date);
                                            ?> </span>
                                        </li>
                                        <li class="meta-item blog-students">
                                            <span class="meta-value"> 6min read</span>
                                        </li>
                                    </ul>
                                    <a href="Allpost.php" class="btn btn-style btn-outline mt-4">All featured
                                        posts</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 mt-md-0 mt-5">
                            <div class="list-view list-view1">
                                <?php $i=0; while ( $all=$get->fetch_assoc()) {
                                    $i;
                                    if($i==0){
                                        $postion;
                                    }else{
                                        $postion='mt-5';
                                    }
                                   ?>
                                        <div class="grids5-info <?php echo $postion?>">
                                            <a href="Post.php?id=<?php echo $all['id'] ?>" class="d-block zoom"><img src="frontend/image/<?php echo $all['image']?>" alt="" class="img-fluid radius-image news-image"></a>
                                            <div class="blog-info align-self">
                                                <a href="Post.php?id=<?php echo $all['id'] ?>" class="blog-desc1"><?php echo $all['title'] ?>
                                                </a>
                                                <div class="author align-items-center mt-3 mb-1">
                                                    <a href="#author"><?php if(empty($all['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $all['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                                                </div>
                                                <ul class="blog-meta">
                                                    <li class="meta-item blog-lesson">
                                                        <span class="meta-value"> <?php $date=strtotime($data['created_at']);
                                            echo date('M/d/Y', $date);
                                            ?> </span>
                                                    </li>
                                                    <li class="meta-item blog-students">
                                                        <span class="meta-value"> 6min read</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                <?php 
                                $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 trending mt-lg-0 mt-5">
                    <h3 class="section-title-left">Trending </h3>
                    <?php foreach ( $get as $key => $value) {
                                   ?>
                    <div class="grids5-info">
                        <h4><?php echo $key+1 ?>.</h4>
                        <div class="blog-info">
                            <a href="Post.php?id=<?php echo $value['id'] ?>" class="blog-desc1"><?php echo $value['title']?>
                            </a>
                            <div class="author align-items-center mt-2 mb-1">
                                <a href="#author"><?php if(empty($value['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $value['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                            </div>
                            <ul class="blog-meta">
                                <li class="meta-item blog-lesson">
                                    <span class="meta-value"> <?php $date=strtotime($data['created_at']);
                                            echo date('M/d/Y', $date);
                                            ?> </span>
                                </li>
                                <li class="meta-item blog-students">
                                    <span class="meta-value"> 6min read</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php }?>
                 
                </div>
            </div>
            <!-- //block -->


            <!-- block -->
            <div class="item mt-5 pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="#blog-single">
                            <img class="card-img-bottom d-block radius-image" src="assets/images/p3.jpg" alt="Card image cap">
                        </a>
                    </div>
                    <div class="col-lg-6 blog-details align-self mt-lg-0 mt-sm-5 mt-4">
                        <a href="#blog-single" class="blog-desc-big">Your Blog Posts are Boring: 9 Tips for Making your
                            Writing more Interesting
                        </a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos blanditiis, odit non asperiores
                            possimus voluptas sit nihil nam id explicabo saepe sapiente excepturi similique, dicta
                            officia odio natus nemo. Ratione ipsa distinctio explicabo esse quod autem
                            veritatis, in fugit odio.</p>
                        <div class="author align-items-center mt-4 mb-1">
                            <a href="#author">Johnson smith</a> in <a href="#url">Design</a>
                        </div>
                        <ul class="blog-meta">
                            <li class="meta-item blog-lesson">
                                <span class="meta-value"> April 13, 2020 </span>
                            </li>
                            <li class="meta-item blog-students">
                                <span class="meta-value"> 6min read</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- //block-->

            <!-- block -->
            <div class="item mt-5 pt-lg-5">
                <h3 class="section-title-left">Today Highlights </h3>
                <div class="row">
                <?php foreach ( $highlited as $key => $value) { 
                    if($key<=1){
                       $postions;
                    }else{
                        $postions="mt-5";
                    }
                 
                    ?>
                    <div class="col-lg-5 col-md-6 <?php echo $postions?>">
                        <div class="list-view list-view1">
                            <div class="grids5-info">
                                <a href="Post.php?id=<?php echo $value['id'] ?>" class="d-block zoom"><img src="frontend/image/<?php echo $value['image']?>" alt="" class="img-fluid radius-image news-image"></a>
                                <div class="blog-info align-self">
                                    <a href="Post.php?id=<?php echo $value['id']?>" class="blog-desc1"><?php echo $value['title']?>
                                    </a>
                                    <div class="author align-items-center mt-3 mb-1">
                                        <a href="#author"><?php if(empty($value['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $value['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                                    </div>
                                    <ul class="blog-meta">
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> <?php $date=strtotime($value['created_at']);
                                            echo date('M/d/Y', $date);
                                            ?> </span>
                                        </li>
                                        <li class="meta-item blog-students">
                                            <span class="meta-value"> 6min read</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  }?>
                </div>
            </div>
            <!-- //block-->

            <!-- block -->
            <div class="row mt-5 pt-5">
                <div class="col-lg-9 most-recent">
                    <h3 class="section-title-left">Most Recent posts </h3>
                    <div class="list-view ">
                    <?php foreach ( $get as $key => $value) { 
                        if($key==0){
                            $pos;
                        }else{
                            $pos='mt-5';
                        }
        
                    ?>
                        <div class="grids5-info img-block-mobile <?php echo $pos;?>">
                            <div class="blog-info align-self">
                                <span class="category"><?php echo $value['name']?></span>
                                <a href="Post.php?id=<?php echo $value['id'] ?>" class="blog-desc mt-0"><?php echo $value['title']?>
                                </a>
                                <p style="height:62px; display: block;line-height: 1.3em;-webkit-line-clamp: 3;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;"><?php echo $value['des']?></p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <a href="#author"><?php if(empty($value['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $value['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                                </div>
                                <ul class="blog-meta">
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> <?php $date=strtotime($value['created_at']);
                                            echo date('M-d-Y', $date);
                                            ?> </span>
                                    </li>
                                    <li class="meta-item blog-students">
                                        <span class="meta-value"> 6min read</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="Post.php?id=<?php echo $value['id'] ?>" class="d-block zoom mt-md-0 mt-3"><img src="frontend/image/<?php echo $value['image']?>" alt="" class="img-fluid radius-image news-image"></a>
                        </div>
                    <?php  }?>
                    </div>
                    <!-- pagination -->
                    <div class="pagination-wrapper mt-5">
                        <ul class="page-pagination">
                            <li><span aria-current="page" class="page-numbers current">1</span></li>
                    
                            <li><a class="next" href="#url"><span class="fa fa-angle-right"></span></a></li>
                        </ul>
                    </div>
                    <!-- //pagination -->
                </div>
                <div class="col-lg-3 trending mt-lg-0 mt-5 mb-lg-5">
                    <div class="pos-sticky">
                        <h3 class="section-title-left">Trending </h3>
                        <?php foreach($get as $key=> $value){ ?>
                        <div class="grids5-info">
                            <h4><?php echo $key+1;?>.</h4>
                            <div class="blog-info">
                                <a href="Post.php?id=<?php echo $value['id'] ?>" class="blog-desc1"> <?php echo $value['title'];?>
                                </a>
                                <div class="author align-items-center mt-2 mb-1">
                                    <a href=""><?php if(empty($value['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $value['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                                </div>
                                <ul class="blog-meta">
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> <?php $date=strtotime($value['created_at']);
                                            echo date('M-d-Y', $date);
                                            ?> </span>
                                    </li>
                                    <li class="meta-item blog-students">
                                        <span class="meta-value"> 6min read</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                     <?php  }?>
                    </div>
                </div>
            </div>
            <!-- //block-->

            <!-- ad block -->
            <div class="ad-block text-center mt-5">
                <a href="#url"><img src="assets/images/ad.gif" class="img-fluid" alt="ad image" /></a>
            </div>
            <!-- //ad block -->

        </div>
    </div>
    <!-- //footer -->

    <!-- Template JavaScript -->
    <?php include('frontend/common/footer.php'); ?>
    <?php include('frontend/common/js.php'); ?>
</body>

</html>