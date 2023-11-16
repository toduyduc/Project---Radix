<?php
if(!defined("_INCODE")) die("unauthorized access...");

autoRemoveTokenLogin();
?>
<html>
<head>
    <title><?php echo !empty($data["pageTitle"])?$data["pageTitle"]:"unicode"; ?></title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES; ?>/assets/dist/css/auth.css?ver=<?php echo rand(); ?>">
</head>
<body>
