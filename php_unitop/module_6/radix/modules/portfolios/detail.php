<?php
if(!defined("_INCODE")) die("unauthorized access...");

if(!empty(getBody()['id'])){
    $id = getBody()['id'];

    // thực hiện truy vấn với bảng portfolios
    $sql = "SELECT portfolios.*,portfolio_categories.name as cate_name FROM portfolios JOIN portfolio_categories ON portfolios.portfolio_category_id=portfolio_categories.id  AND portfolios.id = $id";
    $portfolioDetail = firstRow($sql);

    $portfolioImages = getData("SELECT image FROM portfolio_images JOIN portfolios ON portfolio_images.portfolio_id=portfolios.id AND portfolio_id=$id");
    // echo '<pre>';
    // print_r($portfolioImages);
    // echo '</pre>';
    $count = 0;

    if(empty($portfolioDetail)){
        loadError();
    }
}else{
    loadError();// load giao dien 404
}

$data = [
    "pageTitle"=>$portfolioDetail['name'],
    "itemParent"=>'<li class="active"><a href="'._WEB_HOST_ROOT.'?module=portfolios&action=lists"><i class="fa fa-clone"></i> '.getOption('portfolio_title').'</a></li>'
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
?>

        <!-- Services -->
		<section id="services" class="services archives section">
			<div class="container">
				<h1 class="text-small"><?php echo $portfolioDetail['name']; ?></h1>
                <div class="portfolio-meta">
                    Chuyên mục: <b><?php echo $portfolioDetail['cate_name']; ?></b> | Thời gian: <?php echo getDateFormat($portfolioDetail['create_at'],'d/m/Y H:m:s'); ?>
                </div>
                <hr> 
                <div>
                    <?php echo html_entity_decode($portfolioDetail['content']); ?>
                </div>
                
                <div class="row" style="margin-top:15px;">
                <?php if(!empty($portfolioDetail['video'])): ?>
                    <div class="col-6">
                        <h3>Video</h3>
                        <hr>
                        <?php 
                        $videoId = getYoutubeId($portfolioDetail['video']);
                        if(!empty($videoId)){
                            echo '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$videoId.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                        }
                         ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($portfolioDetail['thumbnail']) && !empty($portfolioDetail['video'])): ?>
                    <div class="col-6">
                <?php else: ?>
                    <div class="col-12">
                <?php endif; 
                    if(!empty($portfolioImages)):
                ?>
                        <h3>Ảnh dự án</h3>
                        <hr>
                        <div>
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php if(!empty($portfolioImages)){
                                        foreach($portfolioImages as $item){
                                            $count++;
                                            ?>
                                            <div class="carousel-item <?php echo ($count==1)?'active':'';?>">
                                                <a href="<?php echo (!empty($item['image']))?$item['image']:false; ?>" data-fancybox="gallery"><img src="<?php echo (!empty($item['image']))?$item['image']:false; ?>" class="d-block w-100" alt="..."></a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Trước</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Sau</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                
			</div>
		</section>
		<!--/ End Services -->
<?php
layout('footer','client');