<!DOCTYPE HTML>
<html>
<head>
    <title>Saving..</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/12
 * Time: 上午11:37
 */

/*
 *
 *
 *    $_SESSION["userid"] = $userid;
    $_SESSION["password"] = $password;
    $_SESSION["headimg"] = $headimg;
    $_SESSION["tel"] = $tel;
    $_SESSION["nickname"] = $nickname;
    $_SESSION["sex"] = $sex;
    $_SESSION["school"] = $school;
    $_SESSION["signature"] =$signature;
    $_SESSION["openid"] = $openid;
 */


@session_start();
require_once("connect.php");
mb_internal_encoding("UTF-8");
mysql_set_charset("utf8mb4");
mysql_query("set names utf8mb4");

$nickname=addslashes($_POST['nickname']);
$password=$_POST['password'];
$signature=addslashes($_POST['signature']);
$school=addslashes($_POST['school']);
$tel=$_POST['tel'];

$userid=$_SESSION['userid'];

$send_time=date("F j, Y, g:i a");
$savePath="headimg/";
if ($_FILES['headimg']['name'] != "") {
//生成随机文件名

    $file_name = $savePath . date("YmdHis") . $userid;
//头像上传
    $oldfilename = $_FILES['headimg']['name'];
    $filetype = ".jpg";
    $filetype = substr($oldfilename, strrpos($oldfilename, "."), strlen($oldfilename) - strrpos($oldfilename, "."));
    if (($filetype != '.gif') && ($filetype != '.jpg') && ($filetype != '.GIF') && ($filetype != '.JPG') && ($filetype != '.PNG') && ($filetype != '.png')
        && ($filetype != '.jpeg') && ($filetype != '.JPEG') && ($filetype != '.PJPEG') && ($filetype != '.pjpeg')
    ) {
        echo '<h1 style="font-size: 100px;">' . "您的文件格式为:" . $filetype . '</h1>';
        echo "<script>alert('文件类型错误或地址错误');</script>";
        echo "<script>location.href='setup.php';</script>";
        exit;
    }
    if ($_FILES['headimg']['size'] > 100000000) {
        echo "<script>alert('文件太大，不能上传');</script>";
        echo "<script>location.href='setup.php';</script>";
        exit;
    }
    $file_name = $file_name . $filetype;
    $savedir = $file_name;
    if (move_uploaded_file($_FILES['headimg']['tmp_name'], $savedir)) {
        $file_name = basename($savedir);


        //put the old headimg to the history record

        if ($_SESSION['headimg']!='')
        {
            $query_save="insert into headimg(userid,img,created_time) values('$userid','$savedir','$send_time')";
            mysql_query($query_save);
        }


        //update the headimg in user info
        $query_update_headimg="update user set headimg='$savedir' where id='$userid'";
        mysql_query($query_update_headimg);




    } else {
        echo "<script>alert('错误，无法将附件写入服务器！本次上传失败');</script>";
        echo "<script>location.href='setup.php';</script>";
        exit;
    }

}


if ($nickname!='')
{
    $query_update_nickname="update user set nickname='$nickname' where id='$userid'";
    mysql_query($query_update_nickname);
}
if ($password!='')
{
    $query_update_password="update user set password='$password' where id='$userid'";
    mysql_query($query_update_password);
}
if ($school!='')
{
    $query_update_school="update user set school='$school' where id='$userid'";
    mysql_query($query_update_school);
}
if ($signature!='')
{
    $query_update_signature="update user set signature='$signature' where id='$userid'";
    mysql_query($query_update_signature);
}
if ($tel!='')
{
    $query_update_tel="update user set tel='$tel' where id='$userid'";
    mysql_query($query_update_tel);
}


    mysql_close();

header("location:center.php");


?>

</body>
</html>
