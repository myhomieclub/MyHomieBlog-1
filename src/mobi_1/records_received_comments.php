<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Records of Received Comments</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
		<link rel="stylesheet" href="css/reset.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/iscroll.js"></script>
		<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
		<script src="js/hmt.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src="js/swiper.min.js" type="text/javascript" ></script>
	</head>



    <?php

    @session_start();


    $userid = $_SESSION['userid'];
    require_once("connect.php");


    $query_get_posts_records = "select post.id,post.title,user.nickname,comment.created_time from post,user,comment where comment.postid=post.id and post.author='$userid' and comment.author=user.id and comment.valid='1' and post.valid='1' and post.check_status='1' order by comment.id desc; ";
    $result = mysql_query($query_get_posts_records);





    ?>
	<body>
		<!--header starselect post.title,user.nickname,comment.created_time from post,user,comment where comment.postid=post.id and post.author='8538187' and comment.author=user.id and comment.valid='1' and post.valid='1' and post.check_status='1';-->
		<header class="hasManyCity hasManyCitytwo" id="header">
			<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
			<div class="header-tit">
				Records of Received Comments
			</div>		
		</header>
	    <!--header end-->
	    <div id="container">		
			<div id="main">
			    <div class="warp warpthree clearfloat">
			    	<div class="account clearfloat">
			    		<div class="top clearfloat">
			    			<ul>
			    				<li class="box-s">Title</li>
			    				<li>Commented By</li>
			    				<li>Time</li>
			    			</ul>
			    		</div>
			    		<div class="list clearfloat box-s">


                            <?php
                            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {


                            $postid=$row['id'];
                            ?>

                                <a href="blog/singlepage.php?postid=<?php echo $postid ?>">
                                    <div class="shang clearfloat">
                                        <ul style="height:auto">
                                            <li class="box-s" style="font-size:.1rem;height:auto"><?php echo $row['title'] ?>
                                            </li>
                                            <li style="height:auto"><?php echo $row['nickname'] ?></li>
                                            <li style="font-size:.1rem;height:auto"><?php echo $row['created_time'] ?></li>
                                        </ul>
                                    </div>
                                </a>

                                <?php
                            }

                            mysql_free_result($result);
                            mysql_close();






                            ?>
							<!--<a href="#">
								<div class="shang clearfloat">
									<ul style="height:auto">
										<li class="box-s" style="font-size:.1rem;height:auto"  >this is a good one </li>
										<li style="height:auto">Bill Gates</li>
										<li style="font-size:.1rem;height:auto">2016-07-23 13:29:47</li>
									</ul>
								</div>
							</a>
							<a href="#">
								<div class="shang clearfloat">
									<ul style="height:auto">
										<li class="box-s" style="font-size:.1rem;height:auto"  >I need help with Java</li>
										<li style="height:auto">Mohammed</li>
										<li style="font-size:.1rem;height:auto">2016-07-23 13:29:47</li>
									</ul>
								</div>
							</a>
							<a href="#">
								<div class="shang clearfloat">
									<ul style="height:auto">
										<li class="box-s" style="font-size:.1rem;height:auto"  >I need help with my Chinese.( Title can be shown totally.) </li>
										<li style="height:auto">Serfano Sebastaiani</li>
										<li style="font-size:.1rem;height:auto">2016-07-23 13:29:47</li>
									</ul>
								</div>
							</a>-->
							<!--
			    			<div class="bottom clearfloat">
			    				<span class="fl">2016-07-10 </span>
			    				<p class="fr">剩余积分：7400</p>
			    			</div>-->
			    		</div>	    		
			    	</div>
			    </div>
			</div>
		</div>
	
	</body>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js" ></script>
	<script src="js/mui.min.js"></script>
	<script src="js/others.js"></script>
	<script type="text/javascript" src="js/hmt.js" ></script>
	<script src="slick/slick.js" type="text/javascript" ></script>
	<!--插件-->
	<link rel="stylesheet" href="css/swiper.min.css">
	<script src="js/swiper.jquery.min.js"></script>
</html>

