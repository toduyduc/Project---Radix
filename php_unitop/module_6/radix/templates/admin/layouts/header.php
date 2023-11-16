<?php
if(!defined("_INCODE")) die("unauthorized access...");

// kiểm tra đăng nhập
if(!isLogin()){
    redirect('admin/?module=auth&action=login');
}else{
    $userId = isLogin()['user_id'];
    $userFullname = firstRow("SELECT fullname FROM users WHERE id=$userId");
    if(!empty($userFullname)){
        $userFullname = $userFullname['fullname'];
        
    }
}


saveActivity(); // lưu lại hoạt động cuối cùng của user
autoRemoveTokenLogin();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo (!empty($data['pageTitle']))?$data['pageTitle']:false; ?> - Quản trị website</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/summernote/summernote-bs4.css">
  <!-- css slider -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
  <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/style.css?ver=<?php echo rand(); ?>">
  <script type="text/javascript"src="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/ckeditor/ckeditor.js"></script>
  <script type="text/javascript"src="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/ckfinder/ckfinder.js"></script>
  <?php head(); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> Hi, <?php echo $userFullname; ?>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a class="nav-link" href="<?php echo getLinkAdmin('users','profile'); ?>">
            <i class="fas fa-angle-right mr-2"></i>
            Thông tin cá nhân
          </a>
          <a class="nav-link" href="<?php echo getLinkAdmin('auth','logout'); ?>">
            <i class="fas fa-angle-right mr-2"></i>
            Đăng xuất
          </a>
          <a class="nav-link"  href="<?php echo  getLinkAdmin('users','change_password') ?>">
            <i class="fas fa-angle-right mr-2"></i>
            Đổi mật khẩu
          </a>
         
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->