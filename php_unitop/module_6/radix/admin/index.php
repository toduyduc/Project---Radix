<?php
session_start();
ob_start();
require_once "../config.php";
require_once "../includes/phpmailer/PHPMailer.php";
require_once "../includes/phpmailer/SMTP.php";
require_once "../includes/phpmailer/Exception.php";
require_once "../includes/permailink.php";
require_once "../includes/functions.php";
require_once "../includes/connect.php";
require_once "../includes/database.php";
require_once "../includes/session.php";
require_once "../includes/permissions.php";
ini_set('display_errors',0);
error_reporting(0);

$module = _MODULE_DEFAULT_ADMIN;
$action = _ACTION_DEFAULT;

// if(!getSession('reload')){
//     removeSession('debug_error');
// }
set_exception_handler("setException");
set_error_handler("setErrorHandler");
loadExceptionError();

if(!empty($_GET["module"])){
    if(is_string($_GET["module"])){
        $module = trim($_GET["module"]);
    }
}

if(!empty($_GET["action"])){
    if(is_string($_GET["action"])){
        $action = trim($_GET["action"]);
    }
}
$path = 'modules/'.$module.'/'.$action.'.php';
if(file_exists($path)){ //  hàm này phải đưa path vào mới dùng được, đưa host vào thì không dùng đc
    require_once $path;
}else{
    require_once "modules/errors/404.php";
}