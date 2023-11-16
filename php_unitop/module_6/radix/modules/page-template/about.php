<?php
if(!defined("_INCODE")) die("unauthorized access...");
$data = [
    "pageTitle"=>getOption('about_title')
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
require_once _WEB_PATH_ROOT.'/modules/home/contents/about.php';
require_once _WEB_PATH_ROOT.'/modules/home/contents/partner.php';
?>

		

<?php
layout('footer','client');