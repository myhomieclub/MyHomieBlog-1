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
$address_id=$_GET['address_id'];

$query_delete_address="update address set valid='0' where id='$address_id' and userid='$userid' and valid='1'";
mysql_query($query_delete_address);

header("location:center.php");

mysql_close();
?>

</body>
</html>
