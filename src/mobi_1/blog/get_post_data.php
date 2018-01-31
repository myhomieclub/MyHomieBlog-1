
<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/15
 * Time: 下午2:08
 */

header('content-type:application/json;charset=utf8');
@session_start();
require_once("../connect.php");
$send_time=date("F j, Y, g:i a");
$per=6;
$t=$_POST['time'];
$down_down=((int)$t)*$per;
$down=$down_down+$per;

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
$limit_suffix=" limit $down,$per";


$keyword=$_GET['keyword'];
$keyword_suffix="";

if ($_GET['search']=='1' and $keyword!='') {
    $keyword_suffix = " and ( tag like '%" . $keyword . "%' ".$case_insensitive_suffix." or title like '%" . $keyword. "%' ".$case_insensitive_suffix." or content like '%" . $keyword. "%'  ".$case_insensitive_suffix." ) ";


}

$query_get_posts="select * from post where valid='1' and check_status='1'".$item_suffix.$keyword_suffix.$category_suffix.$city_suffix.$sort_suffix.$limit_suffix;
$resource=mysql_query($query_get_posts,$conn);



//$query_get_posts="select * from post where valid='1' and check_status='1' limit $down,$per";
//$resource=mysql_query($query_get_posts,$conn);
$results=array();
while($row=mysql_fetch_assoc($resource))
{
    $results[]=$row;
}

echo json_encode($results);
mysql_free_result($resource);
mysql_close();


?>

