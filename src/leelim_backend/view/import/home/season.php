<?php
    $mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['product']){
    $mvc->include_modules('error/403');
}else{
    if(!isset($_GET['type'])){
        $mvc->include_modules('home/season/empty');
    }else{
        $key = ['gallery', 'tag'];
        if(!in_array($_GET['type'], $key)){
            $mvc->include_modules('error/404');
        }else{
            $mvc->include_modules('home/season/'.$_GET['type']);
        }
    }
}