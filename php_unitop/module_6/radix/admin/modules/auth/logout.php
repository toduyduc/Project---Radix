<?php
if(!defined("_INCODE")) die("unauthorized access...");
if(isLogin()){
    $token = getSession('loginToken');
    delete('login_token',"token='$token'");
    removeSession('loginToken');
    if(!empty($_SERVER['HTTP_REFERER'])){
        redirect($_SERVER['HTTP_REFERER'],true);
    }else{
        redirect("admin/?module=auth&action=login");
    }
    
}