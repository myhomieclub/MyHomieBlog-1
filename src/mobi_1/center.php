<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Profile</title>
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
$nickname=$_SESSION['nickname'];
$signature=$_SESSION['signature'];
$headimg=$_SESSION['headimg'];
$userid=$_SESSION['userid'];
    require_once("connect.php");


    //posts num
    $query_posts="select count(*) from post where author='$userid' and check_status='1' and valid='1'";
    $rqst=mysql_query($query_posts,$conn);
    if (mysql_num_rows($rqst)) {
        $result_posts = mysql_fetch_array($rqst);
        $posts = $result_posts[0];
    }else{
        $posts=0;
    }

    //comments num
    $query_comments="select count(comment.id) from comment,post where comment.author='$userid' and comment.postid=post.id and check_status='1' and comment.valid='1' and post.valid='1'";
    $rqst2=mysql_query($query_comments,$conn);
    if (mysql_num_rows($rqst2)) {
        $result_comments = mysql_fetch_array($rqst2);
        $comments = $result_comments[0];
    }else{
        $comments=0;
    }

    //unread_messages_num
    $query_msg="select count(*) from system_message where msg_to='$userid' and msg_read='0'";
    $rqst3=mysql_query($query_msg,$conn);
    if (mysql_num_rows($rqst3)) {
        $result_msg = mysql_fetch_array($rqst3);
        $msgs = $result_msg[0];
    }else{
        $msgs=0;
    }


    $admin_check="select * from admin where userid='$userid'";

    $rqst_admin=mysql_query($admin_check);
    $result_admin=mysql_fetch_array($rqst_admin,MYSQL_ASSOC);
    $id_admin=$result_admin['id'];
    if ($id_admin!='')  {$isadmin=true;$_SESSION['isadmin']='1';}
    else {$isadmin=false;}


mysql_close();

    ?>


    <!-- 显示未读消息的数量-->
    <?php
        function get_data($to_id){

        $ch=curl_init();
        $timeout=10;
        $url="www.smartsupremesoft.com:55151/get_chat_list.php?to_id=$to_id";

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_ENCODING,'gzip');
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $json=mb_convert_encoding(curl_exec($ch),'utf-8');

        return json_decode($json);


    }

    if ($_SESSION['userid']!=''){
        $data=get_data($_SESSION['userid']);
        $data=json_decode(json_encode($data),true);
        $number=0;
        for ($i=0;$i<count($data);$i++){
            $number = $number+$data[$i]['number'];
        }
    }
    ?>
	<body>
		<!--header star--
		<header class="hasManyCity hasManyCitytwo" id="header">
			<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
			<div class="header-tit">
				Profile
			</div>
			<a href="setup.php" class="fr shoucang sousuo"><i class="iconfont icon-shezhi"></i></a>
			<a href="messages.php" class="fr shoucang sousuo"><i class="iconfont icon-kefu1"></i></a>
		</header>
	    -header end-->
	    <div id="container">		
			<div id="main">
			    <div class="warp clearfloat">
			    	<div class="h-top clearfloat box-s">
			    		<div class="tu clearfloat fl">
							<a href="setup.php">
			    			<img src="<?php echo $headimg ?>"/>
							</a>
			    		</div>
			    		<div class="content clearfloat fl">
			    			<p class="hname"><?php echo $nickname ?></p>
			    			<p class="hsig"><?php echo $signature ?></p>
			    		</div>
			    		<div class="right clearfloat fl">
			    		    <a href="setup.php" class="fr shoucang sousuo"><i class="iconfont icon-shezhi"></i></a>
		                	<!--a href="messages.php" class="fr shoucang sousuo"><i class="iconfont icon-kefu1"></i></a-->
			    		</div>
			    		<div class="h-bottom clearfloat">
			    			<samp></samp>
			    			<ul>
			    				<li>
			    					<a href="records_myposts.php">
				    					<p><?php echo $posts?></p>
				    					<span>My Posts</span>
			    					</a>
			    				</li>
			    				<li>
			    					<a href="records_mycomments.php">
				    					<p><?php echo $comments?></p>
				    					<span>My Comments</span>
			    					</a>
			    				</li>
			    				<li>
			    					<a href="ChatHistory.php">
				    					<p><?php echo $number?></p>
				    					<span>Unread Messages</span>
			    					</a>
			    				</li>
			    			</ul>
			    		</div>
			    	</div>
			    	<div class="cashlist clearfloat">
			    		<ul>
                            <li class="box-s">
                                <a href="manage_posts.php">
                                    <p class="fl">My Posts</p>
                                    <i class="iconfont icon-jiantou1 fr"></i>
                                </a>
                            </li>
			    			<li class="box-s">
			    				<a href="records_mycomments.php">
			    					<p class="fl">My Comments</p>
			    					<i class="iconfont icon-jiantou1 fr"></i>
			    				</a>
			    			</li>
			    			<li class="box-s">
			    				<a href="records_received_comments.php">
			    					<p class="fl">Received Comments</p>
			    					<i class="iconfont icon-jiantou1 fr"></i>
			    				</a>
			    			</li>
			    			<li class="box-s">
			    				<a href="messages.php">
			    					<p class="fl">System Messages</p>
			    					<i class="iconfont icon-jiantou1 fr"></i>
			    				</a>
			    			</li>
			    			<li class="box-s">
			    				<a href="#">
			    					<p class="fl">About MyHomie</p>
			    					<i class="iconfont icon-jiantou1 fr"></i>
			    				</a>
			    			</li>
                            <?php if ($isadmin==true){ ?>
                            <li class="box-s">
                                <a href="admin_functions.php">
                                    <p class="fl">Admin Management</p>
                                    <i class="iconfont icon-jiantou1 fr"></i>
                                </a>
                            </li>

                            <?php } ?>
			    		</ul>
			    	</div>			    	
			    	<!--<a href="login.html" class="center-btn db ra3">Login</a>-->
			    </div>
			</div>
		</div>
	    
		<!--footer star-->
	    <footer id="footer">
			<div>
				<a href="index.php">
					<div class="icon i-1"></div>
					<p>Home</p>
				</a>
			</div>
            <div>
                <a href="blog/index.php">
                    <div class="icon i-5"></div>
                    <p>Blog</p>
                </a>
            </div>
            <div>
                <a href="blog/sendPost.php">
                    <div class="icon i-2"></div>
                    <p>Post</p>
                </a>
            </div>
			<div>
				<a href="favorite_records.php">
					<div class="icon i-3"></div>
					<p>Favorite</p>
				</a>
			</div>
			<div>
				<a href="center.php">
					<div class="icon i-4 on"></div>
					<p>Me</p>
				</a>
			</div>			
		</footer>
		<!--footer end-->
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
