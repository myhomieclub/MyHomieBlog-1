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

require_once("connect.php");
mb_internal_encoding("UTF-8");
mysql_set_charset("utf8mb4");
mysql_query("set names utf8mb4");
$content=addslashes($_POST['content']);
if ($content!='') {
    $userid = $_SESSION['userid'];
    if ($userid!='') {
        $rec_msg = "This is a message sent from the server automatically. Your message has been sent and we will reply later. If it is important, Add our customer service Homey (Wechat ID: homey0701 ) to your friend and then discuss in detail. Thx for your supporting MyHomie.";

        $sent_time = date("F j, Y, g:i a");
        $query_1 = "insert into system_message(msg_from,msg_to,content,sent_time) values('$userid','system','$content','$sent_time')";
        mysql_query($query_1);

        $sent_time_2 = date("F j, Y, g:i a");
        $query = "insert into system_message(msg_from,msg_to,content,sent_time) values('system','$userid','$rec_msg','$sent_time_2')";
        mysql_query($query);
    }
}
mysql_close();

header("location:messages.php");

?>