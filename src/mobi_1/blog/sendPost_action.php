<!DOCTYPE HTML>
<html>
<head>
<title>Posting..</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>


<?php
    /**
     * Created by PhpStorm.
     * User: sss
     * Date: 2017/8/13
     * Time: 上午10:54
     */
    
    

    
    @session_start();
    require_once("../connect.php");
    
    $title=htmlspecialchars($_POST['title'],ENT_QUOTES);
    $content=htmlspecialchars($_POST['content'],ENT_QUOTES);
    $original_price=$_POST['original_price'];
    $current_price=$_POST['current_price'];
    $sqm=$_POST['sqm'];
    $location=htmlspecialchars($_POST['location'],ENT_QUOTES);
    $category=$_POST['category'];
    
    $content=nl2br($content);
    
    
    $userid=$_SESSION['userid'];
    
    $send_time=date("F j, Y, g:i a");
    
    $savedir="";
    $savedir2="";
    $savedir3="";
    
    $savePath="postimg/";
    
    $accessToken=$_POST['access'];
    
    
    if ($_POST['pic1'] != "") {
        //生成随机文件名
        $rnd_5=random(5);
        $file_name = $savePath . date("YmdHis") . $userid .$rnd_5;
        //头像上传
        
        $filetype = ".jpg";
        
        $id=$_POST['pic1'];
        $str = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$accessToken&media_id=$id";
        $a = file_get_contents($str);
        
        
        $file_name = $file_name . $filetype;
        $savedir = $file_name;
        
        $resource=fopen($savedir,'w+');
        fwrite($resource,$a);
        fclose($resource);
        
    }
    
    if ($_POST['pic2'] != "") {
        //生成随机文件名
        $rnd_5=random(5);
        $file_name = $savePath . date("YmdHis") . $userid .$rnd_5;
        //头像上传
        
        $filetype = ".jpg";
        
        $id=$_POST['pic2'];
        $str = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$accessToken&media_id=$id";
        $a = file_get_contents($str);
        
        
        $file_name = $file_name . $filetype;
        $savedir2 = $file_name;
        
        $resource=fopen($savedir2,'w+');
        fwrite($resource,$a);
        fclose($resource);
        
    }
    
    
    if ($_POST['pic3'] != "") {
        //生成随机文件名
        $rnd_5=random(5);
        $file_name = $savePath . date("YmdHis") . $userid .$rnd_5;
        //头像上传
        
        $filetype = ".jpg";
        
        $id=$_POST['pic3'];
        $str = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$accessToken&media_id=$id";
        $a = file_get_contents($str);
        
        $file_name = $file_name . $filetype;
        $savedir3 = $file_name;
        
        $resource=fopen($savedir3,'w+');
        fwrite($resource,$a);
        fclose($resource);
        
    }
    
    function random($length,$chars='0123456789'){
        $hash='';
        $max=strlen($chars)-1;
        for($i=0;$i<$length;$i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }
    mb_internal_encoding("UTF-8");
    mysql_set_charset("utf8mb4");
    mysql_query("set names utf8mb4");
    $query_post="insert into post(author,pic1,pic2,pic3,title,content,category,location,original_price,current_price,sqm,created_time) values('$userid','$savedir','$savedir2','$savedir3','$title','$content','$category','$location','$original_price','$current_price','$sqm','$send_time')";
    if ($userid!='' and  $title!='' and $content!='') {
        mysql_query($query_post);
        
        
        echo "<script>alert('Post Sent! Your post will be displayed after manual check!');</script>";
        echo "<script>location.href='../center.php';</script>";
        exit;
        
    }
    else {
        echo "<script>alert('Error! ');</script>";
        echo "<script>location.href='sendPost.php';</script>";
        exit;
        
    }
    mysql_close();
    
    ?>

</body>
</html>
