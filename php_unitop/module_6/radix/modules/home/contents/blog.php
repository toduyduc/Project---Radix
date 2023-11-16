<?php
$homeBlogTitle = getOption('home_blog_title');
$homeBlogDesc = getOption('home_blog_desc');
$homeBlogTitleBg = getOption('home_blog_title_bg');

// truy vấn blog
$listBlog = getData('SELECT blog.id as blog_id,title,view_count,thumbnail,description,blog.create_at,name FROM blog join blog_categories on blog.category_id=blog_categories.id ORDER BY blog.create_at DESC LIMIT 0,10');
// echo '<pre>';
// print_r($listBlog);
// echo '</pre>';
?>
<!-- Blogs Area -->
		<section class="blogs-main section">
			<div class="container">
				<div class="row">
					<div class="col-12 wow fadeInUp">
						<div class="section-title">
                            <?php if(!empty($homeBlogTitleBg)): ?>
							<span class="title-bg"><?php echo $homeBlogTitleBg; ?></span>
                            <?php endif; 
                            if(!empty($homeBlogTitle)):
                            ?>
							<h1><?php echo $title; ?></h1>
                            <?php endif; 
                            if(!empty($homeBlogDesc)):
                                echo html_entity_decode($homeBlogDesc);
                            endif; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="row blog-slider">
                        <?php
                            if(!empty($listBlog)){
                                foreach($listBlog as $item){
                                ?>
                                    <div class="col-lg-4 col-12">
                                        <!-- Single Blog -->
                                        <div class="single-blog">
                                            <div class="blog-head">
                                                <img src="<?php echo (!empty($item['thumbnail']))?$item['thumbnail']:false; ?>" alt="#">
                                            </div>
                                            <div class="blog-bottom">
                                                <div class="blog-inner">
                                                    <h4><a href="<?php echo getLinkModule('blog',$item['blog_id']); ?>"><?php echo (!empty($item['title']))?$item['title']:false; ?></a></h4>
                                                    <p><?php echo (!empty($item['description']))?$item['description']:false; ?></p>
                                                    <div class="meta">
                                                        <span><i class="fa fa-bolt"></i><a href="#"><?php echo (!empty($item['name']))?$item['name']:false; ?></a></span>
                                                        <span><i class="fa fa-calendar"></i><?php echo (!empty($item['create_at']))?getDateFormat($item["create_at"],'d/m/Y'):false; ?></span>
                                                        <span><i class="fa fa-eye"></i><a href="#"><?php echo (!empty($item['view_count']))?$item['view_count']:false; ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Blog -->
                                    </div>
                                <?php
                                }
                            }
                        ?>

							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Blogs Area -->