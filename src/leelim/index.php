<?php
session_start();

$_SESSION['csrf_keycode'] = rand();

require_once "./model/model.php";
require_once "./controller/controller.php";

$mvc = new MVCcontroller();

// PREPARE ALL VARIABLES INCLUDING THE USER SESSION
if(!isset($_SESSION['account']) && isset($_COOKIE['login_information'])){
    $mvc->login_from_cookies($_COOKIE['login_information']);
}
//
if($mvc->prepare_all(true)){
    include_once "./view/index.php";    
}