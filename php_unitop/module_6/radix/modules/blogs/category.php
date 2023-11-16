<?php
if(!defined("_INCODE")) die("unauthorized access...");
if(!empty(getBody()['id'])){
    $id = getBody()['id'];
    $category = firstRow("SELECT * FROM blog_categories WHERE id=$id");
    if(empty($category)){
        loadError();// load giao dien 404
    }
}else{
    loadError();// load giao dien 404
}
$data = [
    "pageTitle"=>$category['name'],
    "itemParent"=>'<li class="active"><a href="'._WEB_HOST_ROOT.'?module=blogs&action=lists"><i class="fa fa-clone"></i> '.getOption('blog_title').'</a></li>'
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
//xử lý thuật toán phân trang
$allBlogNumber = getRows("SELECT * FROM `blog` WHERE category_id = $id");// lấy số lượng bản ghi blog
//1. xác định được số lượng bản ghi trên 1 blog

$perPage = 1; // mỗi blog có 3 bản ghi
if(!empty(getOption('blog_per_page'))){
    $perPage = getOption('blog_per_page');
}

//2. tính số blog
$maxPage = ceil($allBlogNumber/$perPage); //hàm ceil: làm tròn lên

//3. xử lý sô blog dưạ vào phương thức get
if(!empty(getBody()["page"])){
    $page = getBody()["page"];
    if($page<1 || $page>$maxPage){
        $page = 1;
    }
}else{
    $page = 1;
}
$offset = ($page-1)*$perPage;

// truy vấn blog
$listBlog = getData("SELECT title,view_count,thumbnail,description,blog.create_at,name,blog.id as blog_id,blog_categories.id as category_id FROM blog join blog_categories on blog.category_id=blog_categories.id AND category_id=$id ORDER BY blog.create_at DESC LIMIT $offset,$perPage");
?>
		<!-- Blogs Area -->
		<section class="blogs-main archives section">
			<div class="container">
				<div class="row">
                <?php
                if(!empty($listBlog)){
                    foreach($listBlog as $item){
                ?>
					<div class="col-lg-4 col-md-6 col-12">
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
										<span><i class="fa fa-bolt"></i><a href="<?php echo getLinkModule('blog_categories',$item['category_id']); ?>"><?php echo (!empty($item['name']))?$item['name']:false; ?></a></span>
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
                }else{
                    echo '<div class="alert alert-info text-center">Không có bài viết</div>';
                }
                ?>
                
				</div>
                <?php 
                // bước giới hạn ô chuyển blog
                    $begin = $page - 2;
                    if($begin < 1){
                        $begin = 1;
                    }
                    $end = $page + 2;
                    if($end>$maxPage){
                        $end = $maxPage;
                    }
                if($maxPage>1):
                ?>
				<div class="row">
					<div class="col-12">
						<!-- Start Pagination -->
						<div class="pagination-main">
							<ul class="pagination">
                                <?php
                                $categoryLink = getLinkModule('blog_categories',$id);
                                if($page>1){
                                    $prevPage = $page-1;

                                    $paginationLink = str_replace('.html','-page-'.$prevPage,$categoryLink);
                                    echo '<li class="prev"><a href="'.$paginationLink.'"><i class="fa fa-angle-double-left"></i></a></li>';
                                }
                                ?>
								
                                <?php
                                for($index=$begin; $index<=$end;$index++){ 
                                    $paginationLink = str_replace('.html','-page-'.$index,$categoryLink);
                                ?>
								<li class="<?php echo ($index==$page)?'active':false; ?>"><a href="<?php echo$paginationLink;?>"><?php echo $index; ?></a></li>
								<?php 
                                } 
                                if($page<$maxPage){
                                    $lastPage = $page+1;
                                    $paginationLink = str_replace('.html','-page-'.$lastPage,$categoryLink);
                                    echo '<li class="next"><a href="'.$paginationLink.'"><i class="fa fa-angle-double-right"></i></a></li>';
                                }
                                ?>
								
							</ul>
						</div>
						<!--/ End Pagination -->
					</div>
				</div>	
                <?php endif; ?>		
			</div>
		</section>
		<!--/ End Blogs Area -->
<?php
layout('footer','client');