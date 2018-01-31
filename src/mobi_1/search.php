<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Search</title>
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
    require_once("connect.php");

    $userid=$_SESSION['userid'];
    $query_get_history="select * from search where userid='$userid' and valid='1'";
    $resource=mysql_query($query_get_history);
    $query_top_search="select keyword from search GROUP by keyword ORDER BY search_count DESC limit 6";
    $result_top=mysql_query($query_top_search);

    ?>





	<body>
    <header class="hasManyCity hasManyCitytwo" id="header">
        <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
        <div class="header-tit">
            Search...
        </div>
    </header>
    <br><br><br><br>
		<div id="container">
			<section class="searchBar wap">
				<div class="searchBox">
					<form action="blog/index.php?search=1" method="get">
                        <input type="hidden" name="search" value="1">
						<input type="search" id="keyword" name="keyword" placeholder="Search.." style="-webkit-user-select: text" autocomplete="off">
					</form>
				</div>
				<div class="voiceBtn"></div>
			</section>

			<section class="hotBox">
				<div class="title" style="color:black">Top Searches</div>
				<ul class="hotKeyUl">
                    <?php

                    while($row_top=mysql_fetch_array($result_top,MYSQL_ASSOC)) {


                        $keyword_top=$row_top['keyword'];



                        ?>


                        <li><a href="blog/index.php?search=1&keyword=<?php echo $keyword_top ?>"><?php echo $keyword_top ?></a></li>


                        <?php

                    }
                    mysql_close();
                    ?>


                    <!--<li>
						<a href="blog/index.php?search=1&keyword=book">Book</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=fridge">Fridge</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=tour">Tourism</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=lang">Language</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=microwave">Microwave</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=question">Question</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=restaurant">Restaurant</a>
					</li>
					<li>
						<a href="blog/index.php?search=1&keyword=phone">Phone</a>
					</li>-->
				</ul>
			</section>

<script type="text/javascript">

    function check_delete()
    {
        if (confirm("Are u sure to delete?"))
        {
            return true;
        }
        else return false;
    }


</script>



			<section class="historyBox" style="">
				<div class="title" style="color:black">Search History</div>
				<ul>

                    <?php

                    while($row=mysql_fetch_array($resource,MYSQL_ASSOC)) {


                        $keyword=$row['keyword'];



                        ?>


                        <li class="link-url"><a href="blog/index.php?search=1&keyword=<?php echo $keyword ?>"><?php echo $keyword ?></a></li>


                        <?php

                    }
                    mysql_close();
                    ?>

					<li class="clear"><a href="delete_search_history.php" onclick="return check_delete();" id="clear_search_history">Clear Search History</a></li>
				</ul>
			</section>
		</div>
	</body>
</html>