<?php
  $userId = isLogin()['user_id'];
  $userFullname = firstRow("SELECT fullname FROM users WHERE id=$userId");
  if(!empty($userFullname)){
      $userFullname = $userFullname['fullname'];
      
  } 

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="brand-link">
      <span class="brand-text font-weight-light font-weight-bold">Radix</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo _WEB_HOST_ROOT_ADMIN_TEMPLATES;?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo getLinkAdmin('users','profile'); ?>" class="d-block"><?php echo $userFullname; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- trang tổng quan -  begin -->
          <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo (activeMenuSidebar('dashboard') || !isset(getBody()['module']))?'active':false;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tổng quan
              </p>
            </a>
          </li>
          
          <!-- trang tổng quan -  end -->

          <?php
          
          if(checkCurrentPermission('lists','services')):
          ?>
          <!-- quản lý dịch vụ begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('services'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('services'))?'active':false;?>">
            <i class="nav-icon fab fa-servicestack"></i>
              <p>
                Quản lý dịch vụ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=services'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php if(checkCurrentPermission('add','services')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=services&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              <?php endif; ?>
              
            </ul>
          </li>
          <!-- quản lý dịch vụ end -->
        <?php endif; ?>

         <!-- nhóm người dùng - begin-->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('groups'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('groups'))?'active':false;?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Nhóm người dùng
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=groups'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=groups&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>

            </ul>
          </li>
          <!-- nhóm người dùng - end-->

          <?php
          if(checkCurrentPermission('lists','users')):
          ?>
          <!-- Quản lý người dùng - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('users'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('users'))?'active':false;?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Quản lý người dùng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=users'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php if(checkCurrentPermission('add','users')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=users&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <!-- Quản lý người dùng - end -->
          <?php endif; ?>

          <?php if(checkCurrentPermission('lists','contacts')): ?>
          <!-- Quản lý liên hệ - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('contacts') || activeMenuSidebar('contact_type'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('contacts') || activeMenuSidebar('contact_type'))?'active':false;?>">
              <i class="nav-icon far fa-id-card"></i>
              <p>
                Quản lý liên hệ <span class="badge badge-danger"> <?php echo getCountContacts(); ?></span>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=contacts'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách <span class="badge badge-danger"><?php echo getCountContacts(); ?></span></p>
                  
                </a>
              </li>
              <?php if(checkCurrentPermission('lists','contact_type')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=contact_type'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý phòng ban</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <!-- Quản lý liên hệ - end -->
          <?php endif;?>

          <?php if(checkCurrentPermission('lists','comments')): ?>
          <!-- Quản lý bình luận - begin -->
          <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=comments'; ?>" class="nav-link <?php echo (activeMenuSidebar('comments'))?'active':false;?>">
              <i class="nav-icon fas fa-solid fa-comment-dots"></i>
              <p>
                Quản lý bình luận <span class="badge badge-danger"><?php echo getCountComments(); ?></span>
              </p>
            </a>
          </li>
          <!-- Quản lý bình luận - end -->
          <?php endif;?>

          <?php if(checkCurrentPermission('lists','subscribe')): ?>
          <!-- Quản lý đăng ký nhận tin - begin -->
          <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=subscribe'; ?>" class="nav-link <?php echo (activeMenuSidebar('subscribe'))?'active':false;?>">
              <i class="nav-icon fas fa-regular fa-folder-open"></i>
              <p>
                Quản lý đăng ký nhận tin <span class="badge badge-danger"><?php echo getCountSubscribe(); ?></span>
              </p>
            </a>
          </li>
          <!-- Quản lý đăng ký nhận tin - end -->
          <?php endif; ?>

          <?php
          if(checkCurrentPermission('lists','pages')):
           ?>
          <!-- Quản lý pages - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('pages'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('pages'))?'active':false;?>">
            <i class="nav-icon fas fa-file"></i>
              <p>
                Quản lý trang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=pages'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php if(checkCurrentPermission('add','pages')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=pages&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <!-- Quản lý pages - end -->
          <?php endif; ?>

          <?php if(checkCurrentPermission('lists','portfolios')): ?>
          <!-- Quản lý portfolios - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories'))?'active':false;?>">
            <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Quản lý dự án
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=portfolios'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách dự án</p>
                </a>
              </li>
              <?php if(checkCurrentPermission('add','portfolios')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=portfolios&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm dự án mới</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('lists','portfolio_categories')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=portfolio_categories'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục dự án</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <!-- Quản lý portfolios - end -->
          <?php endif; ?>

          <?php if(checkCurrentPermission('lists','blog')): ?>
          <!-- Quản lý blog va blog_categories - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('blog') || activeMenuSidebar('blog_categories'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('blog') || activeMenuSidebar('blog_categories'))?'active':false;?>">
            <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Quản lý blog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách blog</p>
                </a>
              </li>
              <?php if(checkCurrentPermission('add','blog')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog&action=add'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm blog mới</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('lists','blog_categories')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=blog_categories'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục blog</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <!-- Quản lý bloc-categories - end -->
          <?php endif;?>
          
          <!-- cấu hình website - begin -->
          <li class="nav-item has-treeview <?php echo (activeMenuSidebar('options'))?'menu-open':false;?> ">
            <a href="#" class="nav-link <?php echo (activeMenuSidebar('options'))?'active':false;?>">
            <i class="nav-icon fas fa-cog"></i>
              <p>
                Thiết lập
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkCurrentPermission('general','options')): ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=general'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập chung</p>
                </a>
              </li>
              <?php endif; 
              if(checkCurrentPermission('header','options')):
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=header'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập header</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('footer','options')):
                ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=footer'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập footer</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('home','options')): 
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=home'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập trang chủ</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('about','options')):
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=about'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập giới thiệu</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('team','options')):
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=team'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập Team</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('service','options')):
                ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=service'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập dịch vụ</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('portfolio','options')):
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=portfolio'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập dự án</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('blog','options')):
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=blog'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập blog</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('contact','options')):
              ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=contact'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập liên hệ</p>
                </a>
              </li>
              <?php endif;
              if(checkCurrentPermission('menu','options')):
                ?>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=options&action=menu'; ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết lập menu</p>
                </a>
              </li>
              <?php endif;?>
            </ul>
          </li>
          <!-- cấu hình website - end -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">