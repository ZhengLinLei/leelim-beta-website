<?php
$mvc = new MVCcontroller();
// ROUTE 分类
/*==========================*/
if(!isset($_GET["template"])){
    // HOME
    $mvc->include_template();
}else{
    // ELSE
    $mvc->include_template($_GET["template"]);
}
