<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/16
 * Time: 下午5:46
 */



@session_start();
require_once("connect.php");
$send_time=date("F j, Y, g:i a");
$userid=$_SESSION['userid'];

$query="update search set valid='0' where userid='$userid'";

mysql_query($query);
mysql_close();
header("location:search.php");

?>