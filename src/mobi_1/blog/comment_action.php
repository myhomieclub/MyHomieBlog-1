<html>
<head>
    <title>Commenting..</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/14
 * Time: 上午11:15
 */


@session_start();

require_once("../connect.php");
$postid=$_GET['postid'];
$return_page="singlepage.php?postid=".$postid;
mb_internal_encoding("UTF-8");
mysql_set_charset("utf8mb4");
mysql_query("set names utf8mb4");

$send_time=date("F j, Y, g:i a");
$content=$_POST['content'];
    
if (!$_SESSION['userid'])
{
    echo "<script>alert('Please login first!');</script>";
    echo "<script>location.href='$return_page';</script>";
    exit;
}
else if ($content!=''){
    $userid = $_SESSION['userid'];
    $content=htmlspecialchars($content, ENT_QUOTES);
$content=nl2br($content);
    $reply=$_POST['reply'];


    $savedir="";

    $savePath="commentimg/";

    if ($_FILES['comment_pic']['name'] != "") {
//生成随机文件名

        $file_name = $savePath . date("YmdHis") . $userid;
//头像上传
        $oldfilename = $_FILES['comment_pic']['name'];
        $filetype = ".jpg";
        $filetype = substr($oldfilename, strrpos($oldfilename, "."), strlen($oldfilename) - strrpos($oldfilename, "."));
        if (($filetype != '.gif') && ($filetype != '.jpg') && ($filetype != '.GIF') && ($filetype != '.JPG') && ($filetype != '.PNG') && ($filetype != '.png')
            && ($filetype != '.jpeg') && ($filetype != '.JPEG') && ($filetype != '.PJPEG') && ($filetype != '.pjpeg')
        ) {
            echo '<h1 style="font-size: 100px;">' . "您的文件格式为:" . $filetype . '</h1>';
            echo "<script>alert('文件类型错误或地址错误');</script>";
            echo "<script>location.href='$return_page';</script>";
            exit;
        }
        if ($_FILES['comment_pic']['size'] > 100000000) {
            echo "<script>alert('文件太大，不能上传');</script>";
            echo "<script>location.href='$return_page';</script>";
            exit;
        }
        $file_name = $file_name . $filetype;
        $savedir = $file_name;
        if (move_uploaded_file($_FILES['comment_pic']['tmp_name'], $savedir)) {
            $file_name = basename($savedir);


        } else {
            echo "<script>alert('错误，无法将附件写入服务器！本次上传失败');</script>";
            echo "<script>location.href='$return_page';</script>";
            exit;
        }

    }
    //echo "<script>alert('a!');</script>";
if ($reply!='') $query="insert into comment(postid,author,formerid,pic,created_time,content) values('$postid','$userid','$reply','$savedir','$send_time','$content')";
    else $query="insert into comment(postid,author,pic,created_time,content) values('$postid','$userid','$savedir','$send_time','$content')";
    //echo "<script>alert('$query');</script>";
    mysql_query($query);
    mysql_close();
    echo "<script>alert('Success!');</script>";
    echo "<script>location.href='$return_page';</script>";
    exit;







}






?>
</body>
</html>



