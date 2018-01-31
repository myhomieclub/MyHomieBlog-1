<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Add/Update Address</title>
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
		<script src="js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/iscroll.js"></script>
		<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
		<script src="js/hmt.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src="js/swiper.min.js" type="text/javascript" ></script>
	</head>

    <?php

    @session_start();
    $userid=$_SESSION["userid"];
    //collect data from database
    require_once("connect.php");


    $address_id=$_GET['address_id'];
    $query_get_address="select * from address where valid='1' and id='$address_id'  and userid='$userid'";
    $result = mysql_query($query_get_address);
    $info=mysql_fetch_array($result);
    $name=$info['name'];
    $tel=$info['tel'];
    $address=$info['address'];
    $default=$info['default'];



    ?>


	<body>
		<header class="hasManyCity hasManyCitytwo" id="header">
			<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
			<div class="header-tit">
				Add/Update Address
			</div>
			<a onclick="document.forms[0].submit()" href="#" class="fr baocun">Save</a>
		</header>
        <form action="add_address_action.php?address_id=<?php echo $address_id ?>" method="post">
		<div id="container">
		    <div id="main" class="mui-clearfix add-address">
		    	<div class="plist clearfloat data">
					<ul>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Name</p>
								<input type="text" class="fr shuru" style="-webkit-user-select: text" name="name"  value="<?php echo $name ?>" placeholder="Name" />
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Phone Number</p>
								<input type="text" class="fr shuru" style="-webkit-user-select: text" name="tel"  value="<?php echo $tel ?>" placeholder="Phone Number" />
							</a>
						</li>
						<!--<li class="clearfloat">
							<a href="#">
								<p class="fl">所在地区</p>
								<i class="fr iconfont icon-jiantou1"></i>
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">街道</p>
								<i class="fr iconfont icon-jiantou1"></i>
							</a>
						</li>-->
					</ul>
				</div>
				<textarea name="address" rows="4" cols="" style="-webkit-user-select: text"  placeholder="Please write your detailed address." class="textare box-s"><?php echo $address ?></textarea>
                <input type="hidden" id="default" name="default" value="0">
		    	<div class="address-btn clearfloat">
		    		<span class="szwmr fl">Set to Default</span>
		    		<a href="#" class="toggle toggle--on fr"></a>
		    	</div>
		    </div>
		</div>
        </form>
	</body>
	<!--默认按钮-->



	<script type="text/javascript">
	$('.toggle').click(function(e){
	
		var toggle = this;
		
		e.preventDefault();

		var default_value=document.getElementById("default").value;
		if (default_value=="0") {default_value="1";alert("on!");}
        else {default_value="0";alert("off!");}

        document.getElementById("default").value=default_value;


		$(toggle).toggleClass('toggle--on').toggleClass('toggle--off').addClass('toggle--moving');
	
		setTimeout(function(){
			$(toggle).removeClass('toggle--moving');
		}, 200)
		
	});
	</script>
</html>
