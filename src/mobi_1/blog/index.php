<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Blog</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/reset.css">
    <script src="js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/iscroll.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script src="js/hmt.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/swiper.min.js" type="text/javascript" ></script>
</head>

<?php

$curr_url="index.php?".$_SERVER['QUERY_STRING'];
@session_start();
require_once("../connect.php");
$send_time=date("F j, Y, g:i a");
$userid=$_SESSION['userid'];
$sort=$_GET['sort'];
$sort_suffix="";

$case_insensitive_suffix=" COLLATE utf8mb4_general_ci ";


if ($sort=='low')   $sort_suffix=" and current_price is not null and current_price!=''  order by current_price+0 ";
if ($sort=='mine')  $sort_suffix=" and author='$userid' ";
if ($sort=='latest') $sort_suffix=" order by id desc ";
if ($sort=='seen') $sort_suffix=" order by seen desc ";
if ($sort=="high") $sort_suffix=" and current_price is not null and current_price!=''  order by current_price+0 desc ";
if ($sort=='ai') $sort_suffix=" order by seen and id desc ";
if ($sort_suffix=="")  $sort_suffix=" order by priority desc";


$city=$_GET['city'];
$city_suffix="";

if ($city!='')  $city_suffix=" and tag like '%".$city."%' ".$case_insensitive_suffix;

$category_suffix="";
$cate=$_GET['category'];
if ($cate!='') $category_suffix=" and category like '%".$cate."%' ".$case_insensitive_suffix;


$item_suffix="";
$item=$_GET['item'];
if ($item!='') $item_suffix=" and tag like '%".$item."%' ".$case_insensitive_suffix;

$per=6;
$limit_suffix=" limit 0,$per";


$keyword=$_GET['keyword'];
$keyword_suffix="";

if ($_GET['search']=='1' and $keyword!='') {
    $keyword_suffix = " and ( tag like '%" . $keyword . "%' ".$case_insensitive_suffix." or title like '%" . $keyword. "%' ".$case_insensitive_suffix." or content like '%" . $keyword. "%'  ".$case_insensitive_suffix." ) ";
    $query_is_redundant="select * from search where userid='$userid' and valid='1' and keyword='$keyword'";
    $t_r=mysql_query($query_is_redundant);
    $rs=mysql_fetch_array($t_r,MYSQL_ASSOC);

    if ($rs['id']=='')      //first time & will be recorded
    {

        $query="insert into search(userid,created_time,keyword) values('$userid','$send_time','$keyword') ";
        mysql_query($query);
    }

}
$query_get_posts=" select * from post where valid='1' and check_status='1' ".$item_suffix.$keyword_suffix.$category_suffix.$city_suffix.$sort_suffix.$limit_suffix;
$resource=mysql_query($query_get_posts,$conn);








?>

<body>
<header class="hasManyCity hasManyCitytwo" id="header">
    <a href="javascript:history.go(-1)" class="fl fanhui"><i class="iconfont icon-fanhui"></i></a>
    <div id="locaitonBtn" class="link-url locaitonBtn"></div>
    <div id="" class="searchBox">
        <a href="../search.php">
            <i class="icon-search"></i>
            <span>Search..</span>
        </a>
    </div>
</header>
<!-- screening -->
<div class="screening">
    <ul>
        <li class="Brand">Category</li>
        <li class="Regional">City</li>
        <li class="Sort">Sort By</li>
    </ul>
</div>
<!-- End screening -->
<!-- Category -->
<div class="Category-eject">
    <ul class="Category-w" id="Catagory-w">
        <li  id="Categorytw" onclick="Categorytw(this);mytest(this)">2nd-hand</li>
        <li  id="Categorytw1" onclick="Categorytw(this);mytest(this)">Events</li>
        <li  id="Categorytw2" onclick="Categorytw(this);mytest(this)">Recommendations</li>
        <li  id="Categorytw3" onclick="Categorytw(this);mytest(this)">Q&A</li>
        <li  id="Categorytw4" onclick="Categorytw(this);mytest(this)">Marketing</li>
        <li  id="Categorytw5" onclick="Categorytw(this);mytest(this)">Internship</li>
    </ul>
    <ul class="Category-t" id="Categoryt">
        <li onclick="Categoryt(this);location.href='index.php?category=2nd-hand';">Any Goods</li>
        <li onclick="Categoryt(this);location.href='index.php?category=2nd-hand&item=school';">School Things</li>
        <li onclick="Categoryt(this);location.href='index.php?category=2nd-hand&item=cloth';">Clothes</li>
        <li onclick="Categoryt(this);location.href='index.php?category=2nd-hand&item=elec';">Electronics</li>
        <li onclick="Categoryt(this);location.href='index.php?category=2nd-hand&item=transport';">Transportation</li>
        <li onclick="Categoryt(this);location.href='index.php?category=2nd-hand&item=sundr';">Sundries</li>
    </ul>
    <ul class="Category-t" id="Categoryt1">
        <li onclick="Categoryt1(this);location.href='index.php?category=Event';">Any Eevent</li>
        <li onclick="Categoryt1(this);location.href='index.php?category=Event&item=sport';">Play Sports</li>
        <li onclick="Categoryt1(this);location.href='index.php?category=Event&item=sightseeing';">Go Sightseeing</li>
        <li onclick="Categoryt1(this);location.href='index.php?category=Event&item=board';">Board Game</li>
    </ul>
    <ul class="Category-t" id="Categoryt2">
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend';">Any Recommendations</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=restaurant';">Restaurants</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=ticket';">Tickets</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=tour';">Tourism</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=entertain';">Entertainment</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=transport';">Transportation</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=culture';">Culture</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=entertain';">Entertainment</li>
        <li onclick="Categoryt2(this);location.href='index.php?category=Recommend&item=comm';">Communication</li>
    </ul>
    <ul class="Category-t" id="Categoryt3">
        <li onclick="Categoryt3(this);location.href='index.php?category=Q&A';">Any Questions</li>
        <li onclick="Categoryt3(this);location.href='index.php?category=Q&A&item=official';">About The Blog</li>
        <li onclick="Categoryt3(this);location.href='index.php?category=Q&A&item=it';">IT</li>
        <li onclick="Categoryt3(this);location.href='index.php?category=Q&A&item=Lang';">Languages</li>
    </ul>
    <ul class="Category-t" id="Categoryt4">
        <li onclick="Categoryt4(this);location.href='index.php?category=Marketing';">Marketing</li>
        <li onclick="Categoryt4(this);location.href='index.php?category=Marketing&item=food';">Food</li>
        <li onclick="Categoryt4(this);location.href='index.php?category=Marketing&item=art';">Arts</li>
        <li onclick="Categoryt4(this);location.href='index.php?category=Marketing&item=sport';">Sports</li>
    </ul>

    <ul class="Category-t" id="Categoryt5">
        <li onclick="Categoryt5(this);location.href='index.php?category=Intern';">Any Internship</li>
    </ul>

    <!--<ul class="Category-t" id="Categoryt5">
        <li onclick="Categoryt5(this);location.href='index.php';">Any Posts</li>
        <li onclick="Categoryt5(this);location.href='index.php?category=2nd-hand';">Any 2nd-hand Goods</li>
        <li onclick="Categoryt5(this);location.href='index.php?category=Recommend';">Any Recommendations</li>
        <li onclick="Categoryt5(this);location.href='index.php?category=Q&A';">Any Q&A</li>
        <li onclick="Categoryt5(this);location.href='index.php?category=Marketing';">Any Marketing</li>
        <li onclick="Categoryt5(this);location.href='index.php?category=Event';">Any Events</li>
    </ul>-->





    <!--
    <ul class="Category-w" id="Categorytw">
        <li onclick="Categorytw(this)">全部品牌</li>
        <li onclick="Categorytw(this)">奥迪</li>
        <li onclick="Categorytw(this)">丰田</li>
        <li onclick="Categorytw(this)">本田</li>
        <li onclick="Categorytw(this)">大众</li>
        <li onclick="Categorytw(this)">别克</li>
        <li onclick="Categorytw(this)">标志</li>
        <li onclick="Categorytw(this)">东风悦达起亚</li>
        <li onclick="Categorytw(this)">东风</li>
        <li onclick="Categorytw(this)">奔驰</li>
        <li onclick="Categorytw(this)">玛莎拉蒂</li>
        <li onclick="Categorytw(this)">保时捷</li>
        <li onclick="Categorytw(this)">广汽传祺</li>
    </ul>
    <ul class="Category-t" id="Categoryt">
        <li onclick="Categoryt(this)">奥迪A6</li>
        <li onclick="Categoryt(this)">奥迪A6L</li>
        <li onclick="Categoryt(this)">奥迪A4</li>
        <li onclick="Categoryt(this)">奥迪A4L</li>
        <li onclick="Categoryt(this)">奥迪A5</li>
        <li onclick="Categoryt(this)">奥迪A8</li>
        <li onclick="Categoryt(this)">奥迪A8L</li>
        <li onclick="Categoryt(this)">奥迪A3</li>
        <li onclick="Categoryt(this)">奥迪Q5</li>
        <li onclick="Categoryt(this)">奥迪Q7</li>
        <li onclick="Categoryt(this)">奥迪TT</li>
        <li onclick="Categoryt(this)">奥迪R8</li>
    </ul>
    <ul class="Category-s" id="Categorys">
        <li onclick="Categorys(this)">发动机(/进排气系统/燃油系统/冷却系统等)</li>
        <li onclick="Categorys(this)">变速箱</li>
        <li onclick="Categorys(this)">离合器</li>
        <li onclick="Categorys(this)">转向</li>
        <li onclick="Categorys(this)">制动</li>
        <li onclick="Categorys(this)">传动/前后桥</li>
        <li onclick="Categorys(this)">悬挂/车架/车厢</li>
        <li onclick="Categorys(this)">轮胎/钢圈/轮毂</li>
        <li onclick="Categorys(this)">暖风/柴暖/空调系统</li>
        <li onclick="Categorys(this)">汽车电器/电子/传感器</li>
        <li onclick="Categorys(this)">汽车电脑/电子控制单元系统</li>
        <li onclick="Categorys(this)">汽车光电/汽车影音/电子防盗系统</li>
        <li onclick="Categorys(this)">驾驶室/装饰件</li>
        <li onclick="Categorys(this)">轴承/密封件/橡胶件/标准件</li>
        <li onclick="Categorys(this)">汽车润滑/油/脂/液/汽车用品</li>
        <li onclick="Categorys(this)">汽保工具/设备工具/维修设备</li>
        <li onclick="Categorys(this)">液压件/齿轮齿件/挂车/工程机专用件</li>
        <li onclick="Categorys(this)">其他</li>
    </ul>
    -->
</div>
<!-- End Category -->
<!-- grade -->
<div class="grade-eject">
    <ul class="grade-w" id="gradew">
        <li id="gradetw" onclick="grade1(this);mytest1(this)">Zhejiang Province</li>
        <li id="gradetw1" onclick="grade1(this);mytest1(this)">Jiangsu Province</li>
        <li id="gradetw2" onclick="grade1(this);mytest1(this)">Others</li>
    </ul>
    <ul class="grade-t" id="gradet">
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=zhejiang';">Any city in Zhejiang</li>
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=hangzhou';">Hangzhou</li>
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=shaoxing';">Shaoxing</li>
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=ningbo';">Ningbo</li>
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=jinhua';">Jinhua</li>
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=wenzhou';">Wenzhou</li>
        <li onclick="gradet1(this);location.href='<?php echo $curr_url  ?>&city=others,zhejiang';">Others in Zhejiang</li>
    </ul>
    <ul class="grade-t" id="gradet1">
        <li onclick="gradet2(this);location.href='<?php echo $curr_url  ?>&city=jiangsu';">Any city in Jiangsu</li>
        <li onclick="gradet2(this);location.href='<?php echo $curr_url  ?>&city=nanjing';">Nanjing</li>
        <li onclick="gradet2(this);location.href='<?php echo $curr_url  ?>&city=suzhou';">Suzhou</li>
        <li onclick="gradet2(this);location.href='<?php echo $curr_url  ?>&city=others,jiangsu';">Others in Jiangsu</li>
    </ul>
    <ul class="grade-t" id="gradet2">
        <li onclick="gradet3(this);location.href='<?php echo $curr_url  ?>&city=beijing';">Beijing</li>
        <li onclick="gradet3(this);location.href='<?php echo $curr_url  ?>&city=shanghai';">Shanghai</li>
        <li onclick="gradet3(this);location.href='<?php echo $curr_url  ?>&city=guangzhou';">Guangzhou</li>
        <li onclick="gradet3(this);location.href='<?php echo $curr_url  ?>&city=shenzhen';">SHenzhen</li>
        <li onclick="gradet3(this);location.href='<?php echo $curr_url  ?>&city=others,others';">Others</li>
    </ul>
    <!--<ul class="grade-s" id="grades">
        <li onclick="grades(this)">全秦皇岛</li>
        <li onclick="grades(this)">海港区</li>
        <li onclick="grades(this)">山海关区</li>
        <li onclick="grades(this)">北戴河区</li>
        <li onclick="grades(this)">青龙满族自治区</li>
        <li onclick="grades(this)">昌黎县</li>
        <li onclick="grades(this)">抚宁县</li>
        <li onclick="grades(this)">卢龙县</li>
        <li onclick="grades(this)">其他区</li>
        <li onclick="grades(this)">经济技术开发区</li>
    </ul>-->
</div>
<!-- End grade -->
<!-- Category -->
<div class="Sort-eject Sort-height">
    <ul class="Sort-Sort" id="Sort-Sort">
        <li onclick="Sorts(this);location.href='<?php echo $curr_url  ?>&sort=ai';">Intelligent Sort</li>
        <li onclick="Sorts(this);location.href='<?php echo $curr_url  ?>&sort=mine';">My Posts</li>
        <li onclick="Sorts(this);location.href='<?php echo $curr_url  ?>&sort=seen';">Popular First</li>
        <li onclick="Sorts(this);location.href='<?php echo $curr_url  ?>&sort=latest';">Latest</li>
        <li onclick="Sorts(this);location.href='<?php echo $curr_url  ?>&sort=low';">Lowest Price</li>
        <li onclick="Sorts(this);location.href='<?php echo $curr_url  ?>&sort=high';">Highest Price</li>
    </ul>
</div>
<!-- End Category -->
<div id="container">
    <div id="main">
        <div class="guess-like">
            <dl class="list" id="dl">



                <?php


                while ($row = mysql_fetch_array($resource, MYSQL_ASSOC)) {


                    $postid=$row['id'];
                    $pic1=$row['pic1'];
                    $title=$row['title'];
                    $content=$row['content'];
                    $curr_price=$row['current_price'];
                    $category=$row['category'];
                    $seen=$row['seen'];
                    $symbol="";
                    if ($curr_price!='') $symbol="¥";







                    ?>


                    <dd>
                        <dl class="list">
                            <dd>
                                <a href="singlepage.php?postid=<?php echo $postid ?>" class="react">
                                    <div class="dealcard">
                                        <div class="dealcard-img imgbox">
                                            <span></span>
                                            <img src="<?php echo $pic1 ?>"/>
                                        </div>
                                        <div class="dealcard-block-right">
                                            <div class="dealcard-brand single-line"><?php echo $title ?></div>
                                            <div class="title text-block"><?php echo $content ?>
                                            </div>
                                            <div class="price">
                                                <span class="strong"><?php echo $curr_price ?></span>
                                                <span class="strong-color"><?php echo $symbol ?></span>
                                                <span class="tag"><?php echo $category ?></span>
                                                <span class="line-right">seen <?php echo $seen ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </dd>
                        </dl>
                    </dd>
                    <?php

                }

                ?>
                <!--
                <dd>
                    <dl class="list">
                        <dd>
                            <a href="singlepage.php" class="react">
                                <div class="dealcard">
                                    <div class="dealcard-img imgbox">
                                        <span></span>
                                        <img src="img/1.jpg"/>
                                    </div>
                                    <div class="dealcard-block-right">
                                        <div class="dealcard-brand single-line">hello this is title</div>
                                        <div class="title text-block">this is the contentthis is the contentthis is the contentthis is the contentthis is the contentthis is the contentthis is the contentthis is the contentthis is the contentthis is the content</div>
                                        <div class="price">
                                            <span class="strong"></span>
                                            <span class="strong-color"></span>
                                            <span class="tag">Need Help</span>
                                            <span class="line-right">
                                            seen 300
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </dd>
                    </dl>
                </dd>-->



                <div id="load_main">


                </div>


                <dd id="load" class="db">
                    <a class="react"  href="javascript:load_ajax();">
                        <div class="moreone">Load More..</div>
                    </a>
                </dd>


                <script>
                    function load_ajax(){

                        var t=$("#time").val();

                        $.post("get_post_data.php?<?php echo $_SERVER['QUERY_STRING'] ?>",
                            {
                                time:""+t


                            },function(data){

                                // alert(data);

                                for (var i=0;i<data.length;i++)
                                {
                                    var title=data[i]['title'];
                                    var pic1=data[i]['pic1'];
                                    var content=data[i]['content'];
                                    var seen=data[i]['seen'];
                                    var symbol='';
                                    var curr_price=data[i]['current_price'];
                                    if (curr_price!='') symbol='¥';
                                    var postid=data[i]['id'];
                                    var category=data[i]['category'];

                                    var modified_content='<dd><dl class="list"><dd><a href="singlepage.php?postid='+postid+'" class="react"><div class="dealcard"><div class="dealcard-img imgbox"><span></span>'
                                        +'<img src="'+pic1+'"/></div> <div class="dealcard-block-right"> <div class="dealcard-brand single-line">'+title+'</div> <div class="title text-block">'+content+'</div>'
                                        +'<div class="price"> <span class="strong">'+curr_price+'</span> <span class="strong-color">'+symbol+'</span> <span class="tag">'+category+'</span>'
                                        +'<span class="line-right">seen '+seen+'</span> </div> </div> </div> </a> </dd> </dl> </dd>';

                                    //var c=$("#load_main").html();
                                    $("#load_main").append(modified_content);


                                }


                                var new_t=parseInt(t)+1;
                                $("#time").val(new_t);


                            });




                    }
                </script>




            </dl>

        </div>
    </div>
</div>
<input type="hidden" id="time" value="0">
</body>
<script src="js/other.js" type="text/javascript"></script>
</html>
