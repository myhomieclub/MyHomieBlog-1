<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Profile Management</title>
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
	<body>



	<script type="text/javascript">
        function displayImg()
        {
            var img = document.getElementById("imgUser");
            var file = document.getElementById("file_UserPic");
            img.src = window.URL.createObjectURL(file.files[0]);
        }




	</script>


    <?php

    @session_start();
    $userid=$_SESSION["userid"]  ;
    $password=$_SESSION["password"] ;
    $headimg=$_SESSION["headimg"];
    $tel=$_SESSION["tel"];
    $nickname=$_SESSION["nickname"];
    $sex=$_SESSION["sex"];
    $school=$_SESSION["school"];
    $signature=$_SESSION["signature"];
    $openid=$_SESSION["openid"];

    $ds=$_SESSION['default_address'];

    $wechat_binding="NO";
    if ($openid!='') $wechat_binding="YES";

    ?>

		<header class="hasManyCity hasManyCitytwo" id="header">
			<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
			<div class="header-tit">
				&nbsp;&nbsp;&nbsp;&nbsp;Profile Management
			</div>		
		</header>
		<form action="settings_action.php" method="post" enctype="multipart/form-data">
		<div id="container">
			<div id="main">
		    	<div class="plist clearfloat data">
					<ul>
						<li class="clearfloat touxiang">
							<a href="#">
								<p class="fl">Photo</p>
								<i class="fr"><input onchange="javascript:displayImg();" name="headimg" id="file_UserPic" type="file" style="-webkit-user-select: text" accept="image/gif,image/jpg,image/png,image/jpeg" placeholder="Change a pic"><img id="imgUser" style="width:50px; height:50px; position: absolute; right:10px; top: 60px;" src="<?php echo $headimg ?>"/></i>
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">User ID</p>
								<label class="fr shuru"><?php echo $userid ?></label>
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Nick Name</p>
								<input type="text" style="-webkit-user-select: text" class="fr shuru" name="nickname"  value="" placeholder="<?php echo $nickname ?>" />
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Signature</p>
								<input type="text" style="-webkit-user-select: text" class="fr shuru" name="signature"  value="" placeholder="<?php echo $signature ?>" />
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Password</p>
								<input type="text" style="-webkit-user-select: text" class="fr shuru" name="password"  value="" placeholder="<?php echo $password ?>" />
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">School</p>
								<input type="text" style="-webkit-user-select: text" class="fr shuru" name="school"  value="" placeholder="<?php echo $school ?>" />
							</a>
						</li>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Telephone</p>
								<input type="tel" style="-webkit-user-select: text" class="fr shuru" name="tel"  value="" placeholder="<?php echo $tel ?>" />
							</a>
						</li>
						<!--<li class="clearfloat">Pingfeng Campus,ZJUT
							<a href="#">
								<p class="fl">gender</p>
								<select style="-webkit-user-select: text">
									<option name="gender" value="male"> male
									<option name="gender" value="female"> female
								</select>
							</a>
						</li>-->
						<li class="clearfloat">
							<a href="address.php">
								<p class="fl">Place of Delivery</p>
								<input type="text" style="-webkit-user-select: text" class="fr shuru" name=""  value="" placeholder="<?php echo $ds ?>" />
							</a>
						</li>
					</ul>
				</div>
				<p class="setuptit box-s">Binding Info</p>
				<div class="plist plistwo clearfloat data">
					<ul>
						<li class="clearfloat">
							<a href="#">
								<p class="fl">Wechat</p>
								<span class="fr"><?php echo $wechat_binding ?></span>
							</a>
						</li>
						<!--<li class="clearfloat">
							<a href="#">
								<p class="fl">Facebook</p>
								<input type="text" class="fr shuru" name="" id="" value="NO" placeholder="" />
							</a>
						</li>-->
						<li class="clearfloat">
							<a href="#">
								<p class="fl">QQ</p>
								<span class="fr">NO</span>
							</a>
						</li>
					</ul>
				</div>
				<a  href="#" class="center-btn db ra3" onclick="document.forms[0].submit()">Save</a>
			</div>
	    </div>
	</form>
	</body>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js" ></script>
	<script src="js/fastclick.js"></script>
	<script src="js/mui.min.js"></script>
	<script type="text/javascript" src="js/hmt.js" ></script>
</html>
