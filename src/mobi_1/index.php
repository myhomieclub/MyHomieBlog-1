<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Home</title>
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

        <script src="js/geolocation.js" type="text/javascript" ></script>

	</head>




	<body>
		<header class="hasManyCity" id="header">
			<div id="locationCity" class="cityBtn">city</div>
			<div id="locaitonBtn"  class="link-url locaitonBtn"></div>
			<div id="" class="searchBox">
				<a href="search.php">
					<i class="icon-search"></i>
					<span> Search..</span>
				</a>
			</div>
			<!--<div id="" class="qrcodeBtn"></div>-->
		</header>
		<div id="container">		
			<div id="main">
				<div id="scroller">
					<section class="banner">
						<div class="swiper-container swiper-container1">
							<div class="swiper-wrapper bannerwidth">
								<div class="swiper-slide ">
									<a href="#">
										<img src="img/zjut1.jpg">
									</a>
								</div>
								<div class="swiper-slide swiper-slide-duplicate">
									<a href="#">
										<img src="img/chinamobile1.jpg">
									</a>
								</div>
								<div class="swiper-slide swiper-slide-duplicate">
									<a href="#">
										<img src="img/workout1.jpg">
									</a>
								</div>
								<!--	only 3 divs can be showed	-->
							</div>
							<div class="swiper-pagination swiper-pagination1">
							</div>
						</div>
					</section>
					
					<section class="slider">
						<div class="swiper-container swiper-container2">
							<div class="swiper-wrapper tuangouwidth">
								<div class="swiper-slide swiper-slide-duplicate">
									<ul class="icon-list">
										<li class="icon">
											<a href="blog/index.php?category=2nd-hand">
												<span class="icon-circle">
													<img src="img/a2.png">
												</span>
												<span class="icon-desc">2nd-hand</span>
											</a>
										</li>
                                        <li class="icon">
                                            <a href="blog/index.php?category=recommend">
												<span class="icon-circle">
													<img src="img/b2.png">
												</span>
                                                <span class="icon-desc">Recommended</span>
                                            </a>
                                        </li>
                                        <li class="icon">
                                            <a href="blog/index.php?category=question">
												<span class="icon-circle">
													<img src="img/a1.png">
												</span>
                                                <span class="icon-desc">Q&A</span>
                                            </a>
                                        </li>
                                        <li class="icon">
                                            <a href="blog/index.php?category=skill">
												<span class="icon-circle">
													<img src="img/marketing-promote.png">
												</span>
                                                <span class="icon-desc">Marketing</span>
                                            </a>
                                        </li>
                                        <li class="icon">
                                            <a href="hsk_login.html">
												<span class="icon-circle">
													<img src="img/test.png">
												</span>
                                                <span class="icon-desc">HSK</span>
                                            </a>
                                        </li>

										<li class="icon">
											<a href="blog/index.php">
												<span class="icon-circle">
													<img src="img/event.png">
												</span>
												<span class="icon-desc">Event</span>
											</a>
										</li>
										<!--<li class="icon">
											<a href="hotel.html">
												<span class="icon-circle">												
													<img src="img/a6.png">
												</span>
												<span class="icon-desc">酒店</span>
											</a>
										</li>
										<li class="icon">
											<a href="tourism.html">
												<span class="icon-circle">
													<img src="img/a7.png">
												</span>
												<span class="icon-desc">旅游</span>
											</a>
										</li>
										<li class="icon">
											<a href="piaowu.html">
												<span class="icon-circle">
													<img src="img/a8.png">
												</span>
												<span class="icon-desc">票务</span>
											</a>
										</li>-->
									</ul>
								</div>
								<!--<div class="swiper-slide swiper-slide-duplicate">
									<ul class="icon-list">
                                        <li class="icon">
                                            <a href="blog/index.php?category=intern">
												<span class="icon-circle">
													<img src="img/internship.png">
												</span>
                                                <span class="icon-desc">Internship</span>
                                            </a>
                                        </li>
                                        <li class="icon">
                                            <a href="blog/index.php?category=rent">
												<span class="icon-circle">
													<img src="img/b6.png">
												</span>
                                                <span class="icon-desc">Rental Info</span>
                                            </a>
                                        </li>-->
										<!--<li class="icon">
											<a href="mall.html">
												<span class="icon-circle">
													<img src="img/b2.png">
												</span>
												<span class="icon-desc">百货商城</span>
											</a>
										</li>
										<li class="icon">
											<a href="jifen-mall.html">
												<span class="icon-circle">
													<img src="img/b3.png">
												</span>
												<span class="icon-desc">积分商城</span>
											</a>
										</li>
										<li class="icon">
											<a href="farm.html">
												<span class="icon-circle">
													<img src="img/b4.png">
												</span>
												<span class="icon-desc">农家乐</span>
											</a>
										</li>
										<li class="icon">
											<a href="renting.html">
												<span class="icon-circle">												
													<img src="img/b5.png">
												</span>
												<span class="icon-desc">租车</span>
											</a>
										</li>
										<li class="icon">
											<a href="hand.html">
												<span class="icon-circle">												
													<img src="img/b6.png">
												</span>
												<span class="icon-desc">二手房</span>
											</a>
										</li>
										<li class="icon">
											<a href="self-pay.html">
												<span class="icon-circle">
													<img src="img/b7.png">
												</span>
												<span class="icon-desc">生活缴费</span>
											</a>
										</li>
										<li class="icon">
											<a href="category.html">
												<span class="icon-circle">
													<img src="img/b8.png">
												</span>
												<span class="icon-desc">分类信息</span>
											</a>
										</li>-->
									<!--</ul>
								</div>
							</div>-->
							<!--<div class="swiper-pagination swiper-pagination2">
							</div>-->
						</div>
					</section>
				</div>
							
				<div id="index" class="page-center-box">
					<div>				
						<!--首页限时抢购开始-->
						<div class="sy_title"><span class="left">2nd-hand Goods</span>
							<div class="sy_limit_buy_time ">
								<em class="ico"></em>
								Recommended | Most Seen
								<a href="blog/index.php?category=2nd-hand" class="fr morethree ">More&gt;&gt;</a>
								<!--<span class="time" remaintime="1442800030">
									<span>00</span>天
									<span>00</span>时
									<span>00</span>分
									<span>00</span>秒
								</span>-->
							</div>
						</div>
						<div class="sy_limit_buy mb10">
							<div class="locatLabel_switch swiper-container5 swiper-container-horizontal swiper-container-free-mode swiper-container-android">
								<div class="swiper-wrapper">

                                    <?php



                                    @session_start();



                                    require_once("connect.php");
                                    $secondary_query="select * from post where valid='1' and check_status='1' and category like '2nd-hand%' order by seen desc limit 0,6";
                                    $res_sec=mysql_query($secondary_query);


                                    while ($row1=mysql_fetch_array($res_sec,MYSQL_ASSOC)) {



                                        $postid=$row1['id'];
                                        $title=$row1['title'];
                                        $pic1=$row1['pic1'];

                                        ?>


                                        <div class="box swiper-slide">
                                            <a href="blog/singlepage.php?postid=<?php echo $postid  ?>">
                                                <img src="blog/<?php echo $pic1  ?>" width="" height="">
                                                <p class="txt_center overflow_clear"><?php echo $title  ?></p>
                                                <p class="txt_center fontcl1"><?php echo $row1['current_price']  ?>
                                                    <small class="ml10">
                                                        <del class="black9"><?php echo $row1['original_price']  ?></del>
                                                    </small>
                                                </p>
                                            </a>
                                        </div>
                                        <?php



                                    }

?>
<!--

									<div class="box swiper-slide">
										<a href="#">
											<img src="img/thumb_566813906046a.jpg" width="" height="">
											<p class="txt_center overflow_clear">title</p>
											<p class="txt_center fontcl1">¥50<small class="ml10"><del class="black9">￥60</del></small></p>
										</a>
									</div>

									<div class="box swiper-slide">
										<a href="#">
											<img src="img/thumb_566813906046a.jpg" width="" height="">
											<p class="txt_center overflow_clear">title</p>
											<p class="txt_center fontcl1">¥50<small class="ml10"><del class="black9">￥60</del></small></p>
										</a>
									</div>
									<div class="box swiper-slide">
										<a href="#">
											<img src="img/thumb_566813906046a.jpg" width="" height="">
											<p class="txt_center overflow_clear">title</p>
											<p class="txt_center fontcl1">¥50<small class="ml10"><del class="black9">￥60</del></small></p>
										</a>
									</div>
									<div class="box swiper-slide">
										<a href="#">
											<img src="img/thumb_566813906046a.jpg" width="" height="">
											<p class="txt_center overflow_clear">title</p>
											<p class="txt_center fontcl1">¥50<small class="ml10"><del class="black9">￥60</del></small></p>
										</a>
									</div>-->
								</div>
							</div>
	
						</div>
						<!--首页限时抢购结束-->
											
						<!--热门商家-->
						<div class="sy_title">
							<span class="left">Recommendations</span>
							<a href="blog/index.php?category=recommend" class="fr morethree">More&gt;&gt;</a>
						</div>
						<div class="sy_hot_seller">
							<div class="sy_limit_buy mb10">
								<div class="locatLabel_switch swiper-container6 swiper-container-horizontal swiper-container-free-mode swiper-container-android">
									<div class="swiper-wrapper">

                                        <?php
                                        $rec_query="select * from post where valid='1' and check_status='1' and category like 'Recommend%' order by seen desc limit 0,6";
                                        $res_rec=mysql_query($rec_query);



                                        while ($row2=mysql_fetch_array($res_rec,MYSQL_ASSOC)) {

                                            $postid=$row2['id'];
                                            $title=$row2['title'];
                                            $pic1=$row2['pic1'];

                                            ?>

                                            <div class="box swiper-slide">
                                                <a href="blog/singlepage.php?postid=<?php echo $postid  ?>">
                                                    <img src="blog/<?php echo $pic1  ?>" width="114" height="114">
                                                    <p class="txt_center overflow_clear"><?php echo $title  ?></p>
                                                    <p class="fontcl2"><?php echo $row2['location']  ?>
                                                        <!--<small class="ml10 fr black9">seen 134</small>-->
                                                    </p>
                                                </a>
                                            </div>

                                            <?php
                                        }

?><!--

										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>-->
									</div>
								</div>
							</div>
						</div>
						<!--热门商家end-->
						
						<!--广告轮播-->
						<div class="banner">
							<div class="flexslider guanggao">
								<ul class="slides">
									<li>
										<a href="#" title="广告1">
											<img src="img/chinamobile1.jpg" alt="家居广告1" width="100%">
										</a>
									</li>
									<li class="flex-active-slide">
										<a href="#" title="广告2">
											<img src="img/zjut1.jpg" alt="家居广告2" width="100%">
										</a>
									</li>
								</ul>
							</div>
						</div>
						<!--广告轮播end-->

                        <!--热门商家-->
                        <div class="sy_title">
                            <span class="left">Q&A</span>
                            <a href="blog/index.php?category=Q&A" class="fr morethree">More&gt;&gt;</a>
                        </div>
                        <div class="sy_hot_seller">
                            <div class="sy_limit_buy mb10">
                                <div class="locatLabel_switch swiper-container6 swiper-container-horizontal swiper-container-free-mode swiper-container-android">
                                    <div class="swiper-wrapper">

                                        <?php
                                        $rec_query_1_q="select * from post where valid='1' and check_status='1' and category like 'Q&A%' order by seen desc limit 0,6";
                                        $res_rec_1_q=mysql_query($rec_query_1_q);



                                        while ($row2_1_q=mysql_fetch_array($res_rec_1_q,MYSQL_ASSOC)) {

                                        $postid=$row2_1_q['id'];
                                        $title=$row2_1_q['title'];
                                        $pic1=$row2_1_q['pic1'];

                                        ?>

                                        <div class="box swiper-slide">
                                            <a href="blog/singlepage.php?postid=<?php echo $postid  ?>">
                                                <img src="blog/<?php echo $pic1  ?>" width="114" height="114">
                                                <p class="txt_center overflow_clear"><?php echo $title  ?></p>
                                                <p class="fontcl2"><?php echo $row2_1_q['seen'].' seen'  ?>
                                                    <!--<small class="ml10 fr black9">seen 134</small>-->
                                                </p>
                                            </a>
                                        </div>

                                        <?php
                                        }

                                        ?><!--

										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--热门商家end-->

                        <!--热门商家-->
                        <div class="sy_title">
                            <span class="left">Events</span>
                            <a href="blog/index.php?category=Event" class="fr morethree">More&gt;&gt;</a>
                        </div>
                        <div class="sy_hot_seller">
                            <div class="sy_limit_buy mb10">
                                <div class="locatLabel_switch swiper-container6 swiper-container-horizontal swiper-container-free-mode swiper-container-android">
                                    <div class="swiper-wrapper">

                                        <?php
                                        $rec_query_1="select * from post where valid='1' and check_status='1' and category like 'Event%' order by seen desc limit 0,6";
                                        $res_rec_1=mysql_query($rec_query_1);



                                        while ($row2_1=mysql_fetch_array($res_rec_1,MYSQL_ASSOC)) {

                                        $postid=$row2_1['id'];
                                        $title=$row2_1['title'];
                                        $pic1=$row2_1['pic1'];

                                        ?>

                                        <div class="box swiper-slide">
                                            <a href="blog/singlepage.php?postid=<?php echo $postid  ?>">
                                                <img src="blog/<?php echo $pic1  ?>" width="114" height="114">
                                                <p class="txt_center overflow_clear"><?php echo $title  ?></p>
                                                <p class="fontcl2"><?php echo $row2_1['location']  ?>
                                                    <!--<small class="ml10 fr black9">seen 134</small>-->
                                                </p>
                                            </a>
                                        </div>

                                        <?php
                                        }

                                        ?><!--

										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>
										<div class="box swiper-slide">
											<a href="#">
												<img src="img/thumb_5745110bbc27c.jpg" width="114" height="114">
												<p class="txt_center overflow_clear">菲诗小铺</p>
												<p class="fontcl2">Hangzhou<small class="ml10 fr black9">seen 134</small></p>
											</a>
										</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--热门商家end-->


					</div>
				</div>
			</div>
		</div>
		<footer id="footer">
			<div>
				<a href="index.php">
					<div class="icon i-1 on"></div>
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
					<div class="icon i-4"></div>
					<p>Me</p>
				</a>
			</div>			
		</footer>		
	</body>
	<script src="js/other.js" type="text/javascript" charset="utf-8"></script>
</html>



