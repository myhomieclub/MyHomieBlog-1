<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Sending Messages..</title>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/22
 * Time: 下午2:09
 */
@session_start();
if ($_SESSION['isadmin']=='1') {
    require_once("connect.php");

    mb_internal_encoding("UTF-8");
    mysql_set_charset("utf8mb4");
    mysql_query("set names utf8mb4");

    $content = addslashes($_POST['content']);
    if ($content != '') {
        $userid = $_GET['userid'];
        if ($userid != '') {

            $sent_time = date("F j, Y, g:i a");
            $query_1 = "insert into system_message(msg_from,msg_to,content,sent_time) values('system','$userid','$content','$sent_time')";
            mysql_query($query_1);

        }
    }
    mysql_close();
}
header("location:admin_pm.php?msg_to=$userid");

?>