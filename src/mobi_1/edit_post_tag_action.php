<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Saving..</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/27
 * Time: 下午4:03
 */

@session_start();
if ($_SESSION['isadmin']=='1') {

    require_once("connect.php");
    $postid = $_GET['postid'];
    $tag = $_POST['tag'];
    $priority = $_POST['priority'];
    $query_update_tag="update post set priority='$priority', tag='$tag' where id='$postid'";
    
    
    
    mysql_query($query_update_tag);
    mysql_close();
    
    //echo "p :".$priority."  t: ".$tag."  id:  ".$postid;


}
header("location:check_posts.php");
?>

</body>
</html>
