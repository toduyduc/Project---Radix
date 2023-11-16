<?php
if(!defined("_INCODE")) die("unauthorized access...");
$data = [
    "pageTitle"=>getOption('portfolio_title')
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
$isPortfolioPage = true;
require_once _WEB_PATH_ROOT.'/modules/home/contents/Portfolio.php';
layout('footer','client');