<?php
session_start();
include('config.php');
$id= $_REQUEST['id'];

$query="select users.user_name,blogs.id,blogs.user_id,blogs.title,blogs.des,blogs.image,blogs.status,blogs.post,blogs.highlight,blogs.created_at,
categories.name from blogs left join users  on blogs.user_id=users.id left join categories on blogs.category_id=categories.id   WHERE blogs.status = 1 and blogs.id='$id'";
 $get=$con->query($query);
 $firstdata=$get->fetch_array();
 $query="select users.user_name,blogs.id,blogs.user_id,blogs.title,blogs.des,blogs.image,blogs.status,blogs.post,blogs.highlight,blogs.created_at,
 categories.name from blogs left join users  on blogs.user_id=users.id left join categories on blogs.category_id=categories.id   WHERE blogs.status = 1 ORDER BY blogs.id DESC limit 4";
  $get=$con->query($query);
 $data= $get->fetch_assoc();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Design Blog a Blog Category Bootstrap Responsive Website Template | Culture posts : W3layouts</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <?php include('frontend/common/css.php'); ?>
  </head>
  <body>
<!-- header -->
<?php include('frontend/common/header.php'); ?>
<div class="w3l-searchblock w3l-homeblock1 py-5">
    <div class="container py-lg-4 py-md-3">
        <!-- block -->
        <div class="row">
            <div class="col-lg-8 most-recent">
                <h3 class="section-title-left">Post</h3>
               
                <div class="row">
                    <div class="col-md-12 item">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="#blog-single">
                                    <img class="card-img-bottom d-block radius-image" src="frontend/image/<?php echo $firstdata['image']?>" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body p-0 blog-details">
                                <a href="#blog-single" class="blog-desc"><?php echo $firstdata['title']?>
                                </a>
                                <p><?php echo $firstdata['des']?>.</p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <a href="#author"><?php if(empty($firstdata['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $firstdata['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                                </div>
                                <ul class="blog-meta">
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> <?php $date=strtotime($firstdata['created_at']);
                                            echo date('M d Y', $date);
                                            ?>
                                    </li>
                                    <li class="meta-item blog-students">
                                        <span class="meta-value"> 6min read</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php foreach($get as $value){?>
                    <div class="col-lg-6 col-md-6 item mt-5 pt-lg-3">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="Post.php?id=<?php echo $value['id'] ?>">
                                    <img class="card-img-bottom d-block radius-image" src="frontend/image/<?php echo $value['image']?>" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body p-0 blog-details">
                                <a href="Post.php?id=<?php echo $value['id'] ?>" class="blog-desc"><?php echo $value['title']?>
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
                                        <span class="meta-value"><?php $date=strtotime($value['created_at']);
                                            echo date('M d Y', $date);
                                            ?>  </span>
                                    </li>
                                    <li class="meta-item blog-students">
                                        <span class="meta-value"> 6min read</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php }?>
                </div>

                <!-- pagination -->
                <div class="pagination-wrapper mt-5">
                    <ul class="page-pagination">
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="#url">2</a></li>
                        <li><a class="page-numbers" href="#url">3</a></li>
                        <li><a class="page-numbers" href="#url">4</a></li>
                        <li><a class="page-numbers" href="#url">....</a></li>
                        <li><a class="page-numbers" href="#url">15</a></li>
                        <li><a class="next" href="#url"><span class="fa fa-angle-right"></span></a></li>
                    </ul>
                </div>
                <!-- //pagination -->
            </div>
            <div class="col-lg-4 trending mt-lg-0 mt-5 mb-lg-5">
                <div class="pos-sticky">
                    <h3 class="section-title-left">Trending </h3>
                    <?php foreach($get as $key => $value) {?>
                    <div class="grids5-info">
                        <h4><?php echo $key+1; ?>.</h4>
                        <div class="blog-info">
                            <a href="Post.php?id=<?php echo $value['id'] ?>" class="blog-desc1"> <?php echo $value['title']?>
                            </a>
                            <div class="author align-items-center mt-2 mb-1">
                                <a href="#author"><?php if(empty($value['user_id'])){
                                           echo "Admin"; }else{
                                              echo  $value['user_name'];
                                           }?></a> in <a href="#url">Design</a>
                            </div>
                            <ul class="blog-meta">
                                <li class="meta-item blog-lesson">
                                    <span class="meta-value"> <?php $date=strtotime($value['created_at']);
                                            echo date('M d Y', $date);
                                            ?>  </span>
                                </li>
                                <li class="meta-item blog-students">
                                    <span class="meta-value"> 6min read</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                 <?php } ?>
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

<!-- footer -->
<?php include('frontend/common/footer.php'); ?>
    <?php include('frontend/common/js.php'); ?>
</body>

</html>