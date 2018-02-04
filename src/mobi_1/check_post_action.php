<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Modifying Post Status..</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/12
 * Time: 下午5:40
 */
@session_start();
$userid=$_SESSION["userid"];
//collect data from database
require_once("connect.php");

if ($_SESSION['isadmin']=='1') {

    $postid = $_GET['postid'];
    $pass = $_GET['pass'];
    $query_modify = "update post set check_status='$pass' where id='$postid'";
    mysql_query($query_modify);
}

mysql_close();
header("location:check_posts.php");

?>

</body>
</html>
