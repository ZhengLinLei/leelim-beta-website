<?php
session_start();

$_SESSION['csrf_keycode_backend'] = rand();

require_once "./model/model.php";
require_once "./controller/controller.php";

$mvc = new MVCcontroller();

// PREPARE ALL VARIABLES INCLUDING THE USER SESSION
if(!isset($_GET['template']) || (isset($_GET['template']) && $_GET['template'] != 'login')){ // PROTECT ALL WITHOUT LOGIN SECTION
    $mvc->account_middleware();
}
//
include_once "./view/index.php";