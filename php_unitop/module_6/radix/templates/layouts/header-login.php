<?php
if(!defined("_INCODE")) die("unauthorized access...");

autoRemoveTokenLogin();
?>
<html>
<head>
    <title><?php echo !empty($data["pageTitle"])?$data["pageTitle"]:"unicode"; ?></title>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/style.css?ver=<?php echo rand(); ?>">
</head>
<body>
