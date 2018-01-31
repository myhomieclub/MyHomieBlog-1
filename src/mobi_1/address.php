<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Address Management</title>
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

    <script type="text/javascript">

        function delete_confirm()
        {
            var returnValue=confirm("It's irreversible! Are you sure to delete?");
            if (returnValue==true)
            {
                return true;
            }
            else return false;
        }

    </script>



<?php

@session_start();
$userid=$_SESSION["userid"];
//collect data from database
require_once("connect.php");
$query_get_address="select * from address where valid='1' and userid='$userid'";
$result = mysql_query($query_get_address);




?>

	<body>
		<header class="hasManyCity hasManyCitytwo" id="header">
			<a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
			<div class="header-tit">
				Address Management
			</div>
		</header>
		<div id="container">
		    <div id="main" class="mui-clearfix contaniner">

                <?php
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

                    $address_id=$row['id'];
                $isDefault=$row['isDefault'];
                $default_word="";
                if ($isDefault=='1') $default_word="Default";

                $name=$row['name'];
                $tel=$row['tel'];
                $address=$row['address'];


                ?>


		    	<div class="addlist clearfloat">
		    		<div class="top clearfloat box-s">
		    			<ul>
		    				<li>
		    					<span class="fl"><?php echo $name ?></span>
		    					<span class="fr"><?php echo $tel ?></span>
		    				</li>
		    				<li>
                                <?php echo $address ?>
		    				</li>
		    			</ul>
		    		</div>
		    		<div class="bottom clearfloat box-s">
		    			<section class="shopcar clearfloat">
		    				<div class="list listtwo clearfloat">
								<div class="xuan xuantwo clearfloat fl">

				    			</div>
			    			
							<span class="mradd fl"><?php echo $default_word ?></span>
							<div class="right fr clearfloat">
								<a href="delete-address.php?address_id=<?php echo $address_id ?>" class="fr" onclick="javascript:return delete_confirm()">
									<i class="iconfont icon-lajixiang icon-shanchutwo"></i>
									Delete
								</a>
								<a href="add-address.php?address_id=<?php echo $address_id ?>" class="fr">
									<i class="iconfont icon-bianji bianjittt"></i>
									Edit
								</a>							
							</div>
							</div>
						</section>
		    		</div>
		    	</div>

                    <?php
                }

                mysql_free_result($result);
                mysql_close();






                ?>
		    	<!--
		    	<div class="addlist clearfloat">
		    		<div class="top clearfloat box-s">
		    			<ul>
		    				<li>
		    					<span class="fl">John Doe</span>
		    					<span class="fr">1303505****</span>
		    				</li>
		    				<li>
								Pinfeng campus,ZJUT,Hangzhou,Zhejiang,China
		    				</li>
		    			</ul>
		    		</div>
		    		<div class="bottom clearfloat box-s">
		    			<section class="shopcar clearfloat">
		    				<div class="list listtwo clearfloat">
								<div class="xuan xuantwo clearfloat fl">
				    				<div class="radio" > 
									    <label>
									        <input type="checkbox" name="sex" value="" />
									        <div class="option"></div>
									    </label>
									</div>
				    			</div>-->
			    			
							<!--<span class="mradd fl">Default</span>-->
							<!--<div class="right fr clearfloat">
								<a href="#" class="fr">
									<i class="iconfont icon-lajixiang icon-shanchutwo"></i>
									Delete
								</a>
								<a href="#" class="fr">
									<i class="iconfont icon-bianji bianjittt"></i>
									Edit
								</a>							
							</div>
							</div>
						</section>
		    		</div>
		    	</div>-->
		    	

		    	
		    </div>
		    <a href="add-address.php" class="address-add fl">
	     		Add New Address
	     	</a>
	    </div>
	    
	</body>	
</html>
