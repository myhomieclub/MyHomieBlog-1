<!DOCTYPE HTML>
<html>
<head>
    <title>Authentication..</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: sss
 * Date: 2017/8/6
 * Time: 下午3:53
 */

//$appid = "wx24bf35040e89f35b";
$appid="wxbdc7bc1e209bdac4";
$secret="3273c0aed84cceb42125867afbced999";
//$secret = "a05f3fec81706f34d5b3e1189bd911ff";
$code = $_GET["code"];
$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$get_token_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);
$json_obj = json_decode($res,true);

//根据openid和access_token查询用户信息
$access_token = $json_obj['access_token'];
$openid = $json_obj['openid'];
$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);

//解析json
$user_obj = json_decode($res,true);
$_SESSION['user'] = $user_obj;
//print_r($user_obj);
//echo($user_obj);

//echo "imgurl: ".$user_obj["headimgurl"];

//show user info
/*
 echo("<h1>After Decipherment:</h1>");
 echo("<h3>openid(Wechat account): ".$user_obj['openid']."</h3>");
 echo("<h3>nickname: ".$user_obj['nickname']."</h3>");
 echo("<h3>sex: ".$user_obj['sex']."</h3>");
 echo("<h3>language: ".$user_obj['language']."</h3>");
 echo("<h3>city,province,country: ".$user_obj['city'].", ".$user_obj['province'].", ".$user_obj['country']."</h3>");
 echo("<h2>head img: </h2>");
 echo("<img src=\"".$user_obj["headimgurl"]."\"</img>");
 */

$openid=$user_obj['openid'];
$nickname=$user_obj['nickname'];
$sex=$user_obj['sex'];
$language=$user_obj['language'];
$cpc=$user_obj['city'].",".$user_obj['province'].",".$user_obj['country'];
$headimg=$user_obj['headimgurl'];

@session_start();
require_once("connect.php");
$send_time=date("F j, Y, g:i a");
mb_internal_encoding("UTF-8");
mysql_set_charset("utf8mb4");
mysql_query("set names utf8mb4");
$query_is_first="select * from user where openid='$openid'";
$rqst=mysql_query($query_is_first,$conn);


/*
 *
 * create table user(
 id int(11) not null primary key,
 openid varchar(50) unique,
 tel varchar(20),
 sex varchar(5),
 nickname varchar(30),
 headimg varchar(150),
 cpc varchar(50),
 school varchar(50),
 created_time varchar(30),
 signature varchar(50),
 password varchar(30)
 );
 *
 *
 *
 */






if (mysql_num_rows($rqst) == 0) {
    //user login for the first time

    //create info in server

    $userid=random_userid();
    $userpassword=random(8,'0123456789abcdghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    /*if (put_file_from_url_content($headimg, $send_time.$userid.".png","headimg/"))
    {
        echo "save file ok";
    }
    else {
        echo "save file failed";
    }*/
    //getImage($headimg,$);
    //$new_path="headimg/".$send_time.$userid.".jpg";
    //echo "upload:".getImage($headimg,"headimg/",$send_time.$userid.".png");
    //put_img($new_path);
    $new_path=saveImg($headimg,"headimg/",$userid);
    $query_insert_user="insert into user(id,openid,sex,nickname,headimg,cpc,created_time,password)" .
        "values('$userid','$openid','$sex','$nickname','$new_path','$cpc','$send_time','$userpassword')";

    if (mysql_query($query_insert_user,$conn))
    {
        //echo "insert done";
    }else{
        //echo "insert failed";
    }


    $_SESSION["userid"] = $userid;
    $_SESSION["password"] = $userpassword;
    $_SESSION["headimg"] = $headimg;
    $_SESSION["tel"] = "Not Set";
    $_SESSION["nickname"] = $nickname;
    $_SESSION["sex"] = $sex;
    $_SESSION["school"] = "Not Set";
    $_SESSION["signature"] ="Not Set";
    $_SESSION["openid"] = $openid;
    $_SESSION['default_address']="Not Set";



} else {



    //user already has a account





    //get data from server
    $user = mysql_fetch_array($rqst, MYSQL_ASSOC);
    $headimg=$user['headimg'];
    $userid=$user['id'];
    $sex=$user['sex'];
    $password=$user['password'];
    $tel=$user['tel'];
    $nickname=$user['nickname'];
    $school=$user['school'];
    $signature=$user['signature'];

    //get default address
    $query_get_d_s="select * from address where userid='$userid' and valid='1' and isDefault='1'";
    $res_ds=mysql_query($query_get_d_s);
    $ds=mysql_fetch_array($res_ds,MYSQL_ASSOC);
    $default_address=$ds['address'];



    $admin_check="select * from admin where userid='$userid'";

    $rqst_admin=mysql_query($admin_check);
    $result_admin=mysql_fetch_array($rqst_admin,MYSQL_ASSOC);
    $id_admin=$result_admin['id'];
    if ($id_admin!='')  {$_SESSION['isadmin']='1';}



    $_SESSION["userid"] = $userid;
    $_SESSION["password"] = $password;
    $_SESSION["headimg"] = $headimg;
    $_SESSION["tel"] = $tel;
    $_SESSION["nickname"] = $nickname;
    $_SESSION["sex"] = $sex;
    $_SESSION["school"] = $school;
    $_SESSION["signature"] =$signature;
    $_SESSION["openid"] = $openid;
    $_SESSION['default_address']=$default_address;


    ///echo "恭喜您，登录成功！<br>";
    //echo "用户名: " . $user['username'];
    //echo "请尊贵的会员用户<a href='index.php'>返回主页</a>浏览更多功能<br>";

}

//save login record

$login_ip=get_real_ip();

$query_login_record="insert into login_record(userid,login_time,login_ip) values('$userid','$send_time','$login_ip')";
if (mysql_query($query_login_record,$conn))
{
    //echo "insert record done".mysql_error();

}else{
    //;
}


//login n to home page




mysql_close($conn);





function random_userid()
{
    $result=random(8,'0123456789');

    return $result;

}

function random($length,$chars='0123456789'){
    $hash='';
    $max=strlen($chars)-1;
    for($i=0;$i<$length;$i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

function saveImg($url,$savePath,$userid) {
    $v = '';

    $header = array("Connection: Keep-Alive", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Pragma: no-cache", "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3", "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:29.0) Gecko/20100101 Firefox/29.0");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $v);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    $content = curl_exec($ch);
    $curlinfo = curl_getinfo($ch);
    //echo "string";
    //print_r($curlinfo);
    //关闭连接
    curl_close($ch);
    if ($curlinfo['http_code'] == 200) {
        if ($curlinfo['content_type'] == 'image/jpeg') {
            $exf = '.jpg';
        } else if ($curlinfo['content_type'] == 'image/png') {
            $exf = '.png';
        } else if ($curlinfo['content_type'] == 'image/gif') {
            $exf = '.gif';
        }
        $filename =$savePath.date("YmdHis") . $userid . $exf;
        file_put_contents($filename, $content);
    }
    return $filename;
}
function put_img($url,$filename)
{
    $ch = curl_init();
    $httpheader = array(

        'Connection' => 'keep-alive',
        'Pragma' => 'no-cache',
        'Cache-Control' => 'no-cache',
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,/;q=0.8',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36',
        'Accept-Encoding' => 'gzip, deflate, sdch',
        'Accept-Language' => 'zh-CN,zh;q=0.8,en;q=0.6,zh-TW;q=0.4'
    );
    $options = array(
        CURLOPT_HTTPHEADER => $httpheader,
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array( $ch , $options );
    $result = curl_exec( $ch );
    curl_close($ch);
    file_put_contents( $filename, $result );
}


function getImage($url,$save_dir='',$filename='',$type=0){
    if(trim($url)==''){
        return array('file_name'=>'','save_path'=>'','error'=>1);
    }
    if(trim($save_dir)==''){
        $save_dir='./';
    }
    if(trim($filename)==''){//保存文件名
        $ext=strrchr($url,'.');
        if($ext!='.gif'&&$ext!='.jpg'){
            return array('file_name'=>'','save_path'=>'','error'=>3);
        }
        $filename=time().$ext;
    }
    if(0!==strrpos($save_dir,'/')){
        $save_dir.='/';
    }
    //创建保存目录
    if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
        return array('file_name'=>'','save_path'=>'','error'=>5);
    }
    //获取远程文件所采用的方法
    if($type){
        $ch=curl_init();
        $timeout=5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $img=curl_exec($ch);
        curl_close($ch);
    }else{
        ob_start();
        readfile($url);
        $img=ob_get_contents();
        ob_end_clean();
    }
    //$size=strlen($img);
    //文件大小
    $fp2=@fopen($save_dir.$filename,'a');
    fwrite($fp2,$img);
    fclose($fp2);
    unset($img,$url);
    return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
}





function put_file_from_url_content($url, $saveName, $path) {
    // 设置运行时间为无限制
    set_time_limit ( 0 );

    $url = trim ( $url );
    $curl = curl_init ();
    // 设置你需要抓取的URL
    curl_setopt ( $curl, CURLOPT_URL, $url );
    // 设置header
    curl_setopt ( $curl, CURLOPT_HEADER,false );
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; SeaPort/1.2; Windows NT 5.1; SV1; InfoPath.2)");  //模拟浏览器访问

    curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');

    curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');
    // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
    // 运行cURL，请求网页
    $file = curl_exec ( $curl );
    // 关闭URL请求
    curl_close ( $curl );
    // 将文件写入获得的数据
    $filename = $path . $saveName;
    $write = @fopen ( $filename, "a" );
    if ($write == false) {
        echo "cant open";
        //return false;
    }
    if (fwrite ( $write, $file ) == false) {
        echo "cant write";
        return false;
    }
    if (fclose ( $write ) == false) {
        echo "cant close";
        // return false;
    }
}

function get_real_ip(){
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}


?>

<?php

header("Location:index.php");

?>


</body>
</html>


