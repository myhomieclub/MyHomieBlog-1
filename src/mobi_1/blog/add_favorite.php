<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/18
 * Time: 下午2:17
 */

@session_start();
$postid=$_GET['postid'];
require_once("../connect.php");
if (!$_SESSION['userid'])
{

}
else {
    $userid = $_SESSION['userid'];

    $browsed_time=date("F j, Y, g:i a");
//browse record
    $query_favorite="insert into favorite(userid,postid,created_time) values('$userid','$postid','$browsed_time')";
    mysql_query($query_favorite);

    mysql_close();



}

header("location:singlepage.php?postid=$postid");


?>