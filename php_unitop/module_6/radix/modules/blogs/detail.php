<?php
if(!defined("_INCODE")) die("unauthorized access...");


if(!empty(getBody('get')['id'])){
    $id = getBody('get')['id'];
    setView($id); //tăng view
    $blog = firstRow("SELECT blog.*,blog_categories.name,fullname,groups.name as group_name,users.about_content,contact_facebook,contact_twitter,contact_linkedin,contact_pinterest,(SELECT count(id) FROM blog WHERE user_id=users.id) as blog_count,users.email FROM blog JOIN blog_categories ON blog.category_id = blog_categories.id JOIN users ON blog.user_id=users.id JOIN groups ON users.group_id = groups.id AND blog.id=$id");
    // echo '<pre>';
    // print_r($blog);
    // echo '</pre>';

    if(empty($blog)){
        loadError();// load giao dien 404
    }
}else{
    loadError();// load giao dien 404
}

$parentBreadcrumb = '<li class="active"><a href="'._WEB_HOST_ROOT.'?module=blogs&action=lists"><i class="fa fa-clone"></i> '.getOption('blog_title').'</a></li>';
$parentBreadcrumb.='<li class="active"><a href="'._WEB_HOST_ROOT.'?module=blogs&action=category&id='.$blog['category_id'].'"><i class="fa fa-clone"></i> '.$blog['name'].'</a></li>';
$data = [
    "breadCrumbName"=>$blog['name'],
    "pageTitle"=>getLimitText($blog['title'],5),
    "itemParent"=>$parentBreadcrumb
];
//die();
layout('header','client',$data);
layout('Breadcrumb','client',$data);

// truy van tât cả các bài viết
$allBlog = getData("SELECT * FROM blog ORDER BY create_at DESC");
$currentKey = array_search($id,array_column($allBlog,'id')); // xử lý chuyển bài viết

//lấy ảnh đại diện qua web trung gian gravatar
$userEmail = $blog['email'];
// $hashGravatar = md5($userEmail);
//echo $hashGravatar;
// $avatarUrl = 'https://www.gravatar.com/avatar/'.$hashGravatar;
//echo $avatarUrl;
?>
		<!-- Blogs Area -->
		<section class="blogs-main archives single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Single Blog -->
								<div class="single-blog">
									<div class="blog-head">
                                        <?php if(!empty($blog['thumbnail'])): ?>
										<img src="<?php echo $blog['thumbnail']; ?>" alt="#">
                                        <?php endif; ?>
									</div>
									<div class="blog-inner">
										<div class="blog-top">
											<div class="meta">
                                                <?php if(!empty($blog['name'])): ?>
												    <span><i class="fa fa-bolt"></i><a href="<?php echo _WEB_HOST_ROOT.'/?module=blogs&action=category&id='.$blog['category_id'];?>"><?php echo $blog['name']; ?></a></span>
                                                <?php endif; ?>
                                                <?php if(!empty($blog['create_at'])): ?>
												<span><i class="fa fa-calendar"></i><?php echo getDateFormat($blog['create_at'],'d-m-Y H:i:s'); ?></span>
                                                <?php endif; ?>
                                                <?php if(!empty($blog['view_count'])): ?>
												<span><i class="fa fa-eye"></i><a href="#"><?php echo $blog['view_count']; ?></a></span>
                                                <?php endif; ?>
											</div>
											
                                            <ul class = "social-sha">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            </ul>
										</div>
										<h2><?php echo (!empty($blog['title']))?$blog['title']:false; ?></h2>
										<?php if(!empty($blog['content'])){
                                            echo html_entity_decode($blog['content']);
                                        } ?>
										<div class="bottom-area">
											<!-- Next Prev -->
											<ul class="arrow">
                                                <?php if($currentKey>0): ?>
												<li class="prev"><a href="<?php echo _WEB_HOST_ROOT.'/?module=blogs&action=detail&id='.($allBlog[$currentKey-1]['id']); ?>"><i class="fa fa-angle-double-left"></i>Bài trước</a></li>
                                                <?php endif; ?>
                                                <?php if($currentKey<count($allBlog)-1): ?>
												<li class="next"><a href="<?php echo _WEB_HOST_ROOT.'/?module=blogs&action=detail&id='.($allBlog[$currentKey+1]['id']); ?>">Bài sau<i class="fa fa-angle-double-right"></i></a></li>
                                                <?php endif; ?>
											</ul>
											<!--/ End Next Prev -->
										</div>
									</div>
								</div>
								<!-- End Single Blog -->
							</div>
							<div class="col-12">
								<div class="author-details">
									<div class="author-left">
										<img src="<?php echo getAvartar($userEmail); ?>" alt="#">
                                        <?php if(!empty($blog['fullname']) && !empty($blog['group_name'])): ?>
										<h4><?php echo $blog['fullname']; ?><span><?php echo $blog['group_name']; ?></span></h4>
                                        <?php endif;
                                        if(!empty($blog['blog_count'])):
                                        ?>
										<p><a href="#"><i class="fa fa-pencil"></i><?php echo $blog['blog_count']; ?> posts</a></p>
                                        <?php endif; ?>
									</div>
									<div class="author-content">
										<?php if(!empty($blog['about_content'])){
                                                echo '<p>'.$blog['about_content'].'</p>';
                                        }?>
										<ul class="social-sha">
                                            <?php if(!empty($blog['contact_facebook'])): ?>
											<li><a href="<?php echo $blog['contact_facebook']; ?>" target="blank"><i class="fa fa-facebook"></i></a></li>
                                            <?php endif; ?>
                                            <?php if(!empty($blog['contact_twitter'])): ?>
											<li><a href="<?php echo $blog['contact_twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                                            <?php endif; ?>
                                            <?php if(!empty($blog['contact_linkedin'])): ?>
											<li><a href="<?php echo $blog['contact_linkedin']; ?>"><i class="fa fa-linkedin"></i></a></li>
                                            <?php endif; ?>
                                            <?php if(!empty($blog['contact_pinterest'])): ?>
											<li><a href="<?php echo $blog['contact_pinterest']; ?>"><i class="fa fa-pinterest"></i></a></li>
                                            <?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-12">
								<?php require_once _WEB_PATH_ROOT.'/modules/blogs/comment_lists.php'; ?>
							</div>
							<div class="col-12">
								<?php require_once _WEB_PATH_ROOT.'/modules/blogs/comment_form.php'; ?>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</section>
		<!--/ End Blogs Area -->
<?php
layout('footer','client');