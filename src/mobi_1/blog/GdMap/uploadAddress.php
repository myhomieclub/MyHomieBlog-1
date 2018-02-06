<?php

$city = $_POST['city'];
$location=$_POST['address'];
$longitude=$_POST['lng'];
$latitude=$_POST['lat'];

$type = $_GET['type'];

if ($city || $location){
    session_start();

    $_SESSION['city'] = $city;
    $_SESSION['location'] = $location;
    $_SESSION['longitude'] = $longitude;
    $_SESSION['latitude'] = $latitude;

    echo "upload success";
}

if ($type) {
	session_start();

	switch ($type) {
		case 'city':
			print_r($_SESSION['city']);
			break;

		case 'location':
			print_r($_SESSION['location']);
			break;
		
		default:
			# code...
			break;
	}
}