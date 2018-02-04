<?php

$location=$_POST['address'];
$longitude=$_POST['lng'];
$latitude=$_POST['lat'];

if ($location){
    session_start();

    $_SESSION['location'] = $location;
    $_SESSION['longitude'] = $longitude;
    $_SESSION['latitude'] = $latitude;

    echo "upload success";
}else{
    session_start();

    print_r($_SESSION['location']);
}