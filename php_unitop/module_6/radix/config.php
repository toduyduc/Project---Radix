<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//thiết lập hằng số cho client
const _MODULE_DEFAULT = "home";
const _ACTION_DEFAULT = "lists";

// thiết lập hằng số cho admin
const _MODULE_DEFAULT_ADMIN = 'dashboard';


const _INCODE = true;  // ngăn chặn truy cập trái phép trực tiếp vào file

// thiết lập host
define("_WEB_HOST_ROOT",'http://'.$_SERVER["HTTP_HOST"].'/php_unitop/module_6/radix');// địa chỉ trang chủ
define("_WEB_HOST_TEMPLATES",_WEB_HOST_ROOT.'/templates/client');

define('_WEB_HOST_ROOT_ADMIN',_WEB_HOST_ROOT.'/admin');

define('_WEB_HOST_ROOT_ADMIN_TEMPLATES',_WEB_HOST_ROOT.'/templates/admin');

// thiết lập path
define("_WEB_PATH_ROOT",__DIR__);
define("_WEB_PATH_TEMPLATES",_WEB_PATH_ROOT.'\templates');

// thiết lập kết nối đên database
const _HOST = "localhost";
const _USER = "root";
const _PASS = "";
const _DB = "phponline_radix";
const _DRIVER = "mysql";
//thiết lập debug
const _DEBUG = true;

//thiết lập số bản ghi được hiển thị tối đa trên trang list
const _PER_PAGE = 5;
