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
 * Date: 2017/8/12
 * Time: 下午4:47
 */

@session_start();
$userid=$_SESSION["userid"];
//collect data from database
require_once("connect.php");
$address_id=$_GET['address_id'];

// defense mode off         can be implemented ..
//$query_get_address="select * from address where valid='1' and id='$address_id'  and userid='$userid'";

$name=addslashes($_POST['name']);
$tel=$_POST['tel'];
$address=addslashes($_POST['address']);
$default=$_POST['default'];


if ($address_id!='')            //update info
{

    $query_update_address="update address set name='$name',tel='$tel',address='$address',isDefault='$default' where id='$address_id' and userid='$userid' and valid='1'";
    mysql_query($query_update_address);
    //echo "add0 ".$address_id;
}
else{                           //insert info

    $created_time=date("F j, Y, g:i a");

    $prev_id_query="select max(id) from address";
    $res=mysql_query($prev_id_query);
    if (mysql_num_rows($res))
    {
        $rs=mysql_fetch_array($res);
        $prev_id=$rs[0];
    }else{
        $prev_id=0;
    }

    $query_insert_address="insert into address(userid,name,tel,address,isDefault,created_time) values('$userid','$name','$tel','$address','$default','$created_time')";
    mysql_query($query_insert_address);

    $address_id=$prev_id+1;



}

//search for the other default option (or none) and turn it off
if ($default=='1') {

    $query_reset_default = "update address set isDefault='0' where userid='$userid' and id!='$address_id' and isDefault='1' and valid='1'";
    mysql_query($query_reset_default);
    //echo "add2 ".$address_id;
}

header("location:center.php");
mysql_close();
?>

</body>
</html>

