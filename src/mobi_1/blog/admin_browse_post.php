


<!DOCTYPE HTML>
<html>
<head>
    <title>Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Style Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href='//fonts.googleapis.com/css?family=Raleway:400,600,700' rel='stylesheet' type='text/css'>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
    <link rel="stylesheet" href="css/reset.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/iscroll.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/hmt.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/swiper.min.js" type="text/javascript" ></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<?php

@session_start();
$postid=$_GET['postid'];
require_once("../connect.php");
$if='0';
if (!$_SESSION['userid'])
{

}
else {
    $userid = $_SESSION['userid'];

    $browsed_time=date("F j, Y, g:i a");



}
//get post info

$query_get_post_info="select * from post where id='$postid' and valid='1'";
$post_resource=mysql_query($query_get_post_info);
$post_results=mysql_fetch_array($post_resource,MYSQL_ASSOC);
$title=$post_results['title'];
$content=$post_results['content'];
$seen=$post_results['seen'];

//.....still
$pic1=$post_results['pic1'];
$pic2=$post_results['pic2'];
$pic3=$post_results['pic3'];
$created_time=$post_results['created_time'];

$location=$post_results['location'];
$sqm=$post_results['sqm'];
$old_p=$post_results['original_price'];
$new_p=$post_results['current_price'];

$show='';
if ($location!='')  $show.="<br><p style='color:orange'>Location: ".$location."</p>";
if ($sqm!='')  $show.="<br><p style='color:orange'>Square Meter: ".$sqm." ㎡</p>";
if ($old_p!='')  $show.="<br><p style='color:orange'>Original Price: ".$old_p." ¥</p>";
if ($new_p!='')  $show.="<br><p style='color:orange'>Current Price: ".$new_p." ¥</p>";

//get author info
$author=$post_results['author'];

$query_get_author_info="select * from user where id='$author'";
$author_res=mysql_query($query_get_author_info);
$author_info=mysql_fetch_array($author_res,MYSQL_ASSOC);
$author_nickname=$author_info['nickname'];
$author_signature=$author_info['signature'];
$author_pic=$author_info['headimg'];

//......still

//seen ++
$seen=$seen+1;
$query_reset_post_seen="update post set seen=seen+1 where id='$postid'";
mysql_query($query_reset_post_seen);



//get comment info
$query_comm_num="select count(*) from comment where valid='1' and postid='$postid'";
$comm_res=mysql_query($query_comm_num,$conn);

if (mysql_num_rows($comm_res))
{
    $rs=mysql_fetch_array($comm_res);
    $comment_num=$rs[0];
    //echo "<h1>comm ".$comment_num."</h1>";
}
else {$comment_num=0;//echo "<h1>comm 0</h1>";
}

$query_main_comment_info="select * from comment where valid='1' and postid='$postid' and formerid is null";
$comment_res=mysql_query($query_main_comment_info);



?>



<body>
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div class="header-tit">
        &nbsp;&nbsp;&nbsp;&nbsp;Post
    </div>
</header>
<!-- screening -->


<!-- technology-left -->
<div class="technology">
    <div class="container">
        <div class="col-md-9 technology-left">
            <div class="agileinfo">

                <br>
                <h2 class="w3">Detailed page</h2>
                <div class="single">


                    <?php  if ($pic1!='') echo "<img src='$pic1' class='img-responsive'><br>";
                    if ($pic2!='') echo "<img src='$pic2' class='img-responsive'><br>";
                    if ($pic3!='') echo "<img src='$pic3' class='img-responsive'><br>";
                    ?>

                    <div class="b-bottom">
                        <h5 class="top"><?php echo $title ?></h5>
                        <p class="sub"><?php echo $content ?></p>
                        <p><a class="span_link" href="#" style="color:red"><span class="glyphicon glyphicon-calendar"></span><?php echo $created_time ?></a><a class="span_link" href="#" style="color:red"><span class="glyphicon glyphicon-comment"></span><?php echo $comment_num ?></a><a class="span_link" href="#" style="color:red"><span class="glyphicon glyphicon-eye-open"></span><?php echo $seen ?> </a></p>
                        <?php echo $show ?>
                    </div>
                </div>
                <div class="response">
                    <h4>Author</h4>
                    <div class="media response-info">
                        <div class="media-left response-text-left">
                            <a href="#">
                                <img src="../<?php echo $author_pic ?>" class="img-responsive" alt="">
                            </a>
                        </div>
                        <div class="media-body response-text-right">
                            <p><?php echo $author_signature ?></p>
                            <ul>
                                <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $author_nickname ?></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>


                <div class="response">
                    <h4>Responses</h4>

                    <?php

                    while ($row = mysql_fetch_array($comment_res, MYSQL_ASSOC)) {

                        $commentatorid=$row['author'];
                        $pic=$row['pic'];
                        $content=$row['content'];
                        $no=$row['id'];
                        $created_time=$row['created_time'];

                        //get commentator's name & pic
                        $query_get_c_info="select * from user where id='$commentatorid'";
                        $res_c=mysql_query($query_get_c_info);
                        $result_c=mysql_fetch_array($res_c,MYSQL_ASSOC);

                        $headimg="../".$result_c['headimg'];
                        $name=$result_c['nickname'];


                        ?>

                        <div class="media response-info">
                            <div class="media-left response-text-left">
                                <a href="#">
                                    <img src="<?php echo $headimg  ?>" class="img-responsive" alt="">
                                </a>
                            </div>
                            <div class="media-body response-text-right">
                                <?php if ($pic!='') echo "<img src='$pic' class='img-responsive'>"; ?>
                                <p><?php echo $content ?></p>
                                <ul>
                                    <li><?php echo $created_time ?></li>
                                    <li><a href="#"><?php echo $name ?></a></li>
                                    <li><a onclick="reply_scroll(<?php echo $no  ?>)">Reply</a></li>
                                </ul>

                                <?php

                                $query_get_r="select * from comment where postid='$postid' and valid='1' and formerid='$no'";
                                $res_r=mysql_query($query_get_r);
                                while ($result_r = mysql_fetch_array($res_r, MYSQL_ASSOC)) {


                                    $r_commentatorid=$result_r['author'];
                                    $r_pic=$result_r['pic'];
                                    $r_content=$result_r['content'];
                                    $r_no=$result_r['id'];
                                    $r_created_time=$result_r['created_time'];

                                    //get commentator's name & pic
                                    $query_get_r_info="select * from user where id='$r_commentatorid'";
                                    $res_r_info=mysql_query($query_get_r_info);
                                    $result_r_info=mysql_fetch_array($res_r_info,MYSQL_ASSOC);

                                    $r_headimg="../".$result_r_info['headimg'];
                                    $r_name=$result_r_info['nickname'];



                                    ?>

                                    <div class="media response-info">
                                        <div class="media-left response-text-left">
                                            <a href="#">
                                                <img src="<?php echo $r_headimg  ?>" class="img-responsive" alt="">
                                            </a>
                                        </div>
                                        <div class="media-body response-text-right">
                                            <?php if ($r_pic!='') echo "<img src='$r_pic' class='img-responsive'>"; ?>
                                            <p><?php echo $r_content ?></p>
                                            <ul>
                                                <li><?php echo $r_created_time ?></li>
                                                <li><a href="#"><?php echo $r_name ?></a></li>

                                            </ul>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>

                                    <?php
                                }
                                ?>


                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php


                    }
                    mysql_close();
                    ?>

                    <!--<div class="media response-info">
                        <div class="media-left response-text-left">
                            <a href="#">
                                <img src="images/sin1.jpg" class="img-responsive" alt="">
                            </a>
                        </div>
                        <div class="media-body response-text-right">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <ul>
                                <li>Jul 22, 2016</li>
                                <li><a href="#">John Doe</a></li>
                                <li><a href="#" onclick="reply_scroll(23)">Reply</a></li>
                            </ul>
                            <div class="media response-info">
                                <div class="media-left response-text-left">
                                    <a href="#">
                                        <img src="images/sin2.jpg" class="img-responsive" alt="">
                                    </a>
                                </div>
                                <div class="media-body response-text-right">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <ul>
                                        <li>Aug 01, 2016</li>
                                        <li><a href="#">John Doe</a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="media response-info">
                                <div class="media-left response-text-left">
                                    <a href="#">
                                        <img src="images/sin2.jpg" class="img-responsive" alt="">
                                    </a>
                                </div>
                                <div class="media-body response-text-right">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <ul>
                                        <li>Aug 01, 2016</li>
                                        <li><a href="#">John Doe</a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>-->
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- technology-right -->
       <!-- <div class="col-md-3 technology-right">


            <div class="blo-top1">

                <div class="tech-btm">
                    <div class="search-1">
                        <form action="#" method="post">
                            <input type="search" name="Search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
                            <input type="submit" value=" ">
                        </form>
                    </div>
                    <h4>Popular Posts </h4>
                    <div class="blog-grids">
                        <div class="blog-grid-left">
                            <a href="singlepage.php"><img src="images/t2.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="blog-grid-right">

                            <h5><a href="singlepage.php">Pellentesque dui Maecenas male</a> </h5>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="blog-grids">
                        <div class="blog-grid-left">
                            <a href="singlepage.php"><img src="images/m2.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="blog-grid-right">

                            <h5><a href="singlepage.php">Pellentesque dui Maecenas male</a> </h5>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="blog-grids">
                        <div class="blog-grid-left">
                            <a href="singlepage.php"><img src="images/f2.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="blog-grid-right">

                            <h5><a href="singlepage.php">Pellentesque dui Maecenas male</a> </h5>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="blog-grids">
                        <div class="blog-grid-left">
                            <a href="singlepage.php"><img src="images/t3.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="blog-grid-right">

                            <h5><a href="singlepage.php">Pellentesque dui Maecenas male</a> </h5>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="blog-grids">
                        <div class="blog-grid-left">
                            <a href="singlepage.php"><img src="images/m3.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div class="blog-grid-right">

                            <h5><a href="singlepage.php">Pellentesque dui Maecenas male</a> </h5>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="insta">
                        <h4>Instagram</h4>
                        <ul>

                            <li><a href="singlepage.php"><img src="images/t1.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/m1.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/f1.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/m2.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/f2.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/t2.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/f3.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/t3.jpg" class="img-responsive" alt=""></a></li>
                            <li><a href="singlepage.php"><img src="images/m3.jpg" class="img-responsive" alt=""></a></li>
                        </ul>
                    </div>

                    <p>Lorem ipsum ex vix illud nonummy, novum tation et his. At vix scripta patrioque scribentur, at pro</p>

                </div>



            </div>


        </div>
        <div class="clearfix"></div>-->
        <!-- technology-right -->
    </div>
</div>
<input type="hidden" id="save_f" value="<?php echo $if  ?>">












</body>
<script src="js/other.js" type="text/javascript"></script>
</html>






