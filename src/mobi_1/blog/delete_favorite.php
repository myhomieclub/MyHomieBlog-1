<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/18
 * Time: 下午3:21
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
    $query_favorite="update favorite set valid='0' where userid='$userid' and postid='$postid' and valid='1'";
    mysql_query($query_favorite);

    mysql_close();



}

header("location:singlepage.php?postid=$postid");


?>