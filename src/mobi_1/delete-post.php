<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Deleting..</title>
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
$post_id=$_GET['postid'];

$query_delete_post="update post set valid='0' where id='$post_id' and author='$userid' and valid='1'";
mysql_query($query_delete_post);

header("location:center.php");

mysql_close();
?>

</body>
</html>
