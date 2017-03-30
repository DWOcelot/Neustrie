<?php

//pretty arrays
function debug($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

//generate token
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//check if user connected. Need table 'user' with id, pseudo, role
//BOOL, return true or false
function isLogged()
{
	if(!empty($_SESSION['user']) && !empty($_SESSION['user']['id']) && !empty($_SESSION['user']['pseudo']) && !empty($_SESSION['user']['role']) && !empty($_SESSION['user']['ip'])) {

    $ip = $_SERVER['REMOTE_ADDR'];
    if($ip == $_SESSION['user']['ip']) {
      return true;
    }
	}
	return false;
}

//check if user is connected & admin. Need table 'user' with id, pseudo, role. Need role lower case
//BOOl, return true or false
function isAdmin()
{
	if(!empty($_SESSION['user']) && !empty($_SESSION['user']['id']) && !empty($_SESSION['user']['pseudo']) && !empty($_SESSION['user']['role']) && !empty($_SESSION['user']['ip'])) {
		if($_SESSION['user']['role'] == 'admin') {
      $ip = $_SERVER['REMOTE_ADDR'];
      if($ip == $_SESSION['user']['ip']) {
        return true;
      }
		}
	}
	return false;
}


//SHOW JSON FOR AJAX REQUESTS
function showJson($data) {
  header("Content-type: application/json");
  $json = json_encode($data, JSON_PRETTY_PRINT);
  if ($json) {
    die($json);
  } else {
    die("error in json encoding");
  }
}