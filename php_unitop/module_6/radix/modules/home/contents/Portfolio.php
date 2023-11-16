<?php
$titleBg = getOption('home_Portfolio_title_bg');
$title = getOption('home_Portfolio_title');
$desc = getOption('home_Portfolio_desc');
$moreLink = getOption('home_Portfolio_more_link');
$moreText = getOption('home_Portfolio_more_text');


// truy vấn danh mục dự án
$portfolioCategories = getData('SELECT * FROM portfolio_categories ORDER BY name ASC');

// truy vấn danh sách dự án
$portfolios = getData('SELECT * FROM portfolios ORDER BY name ASC');
// echo '<pre>';
// print_r($portfolios);
// echo '</pre>';
?>
        <!-- Portfolio -->
		<section id="portfolio" class="portfolio section">
			<div class="container">
				<div class="row">
					<div class="col-12 wow fadeInUp">
						<div class="section-title">
                            <?php if(!empty($titleBg)): ?>
							<span class="title-bg"><?php echo $titleBg; ?></span>
                            <?php endif;
                            if(!empty($title)):
                            ?>
							<h1><?php echo $title; ?></h1>
                            <?php endif;
                            if(!empty($desc)):
                             ?>
							<?php echo html_entity_decode($desc); ?>
                            <?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<!-- portfolio Nav -->
						<div class="portfolio-nav">
							<ul class="tr-list list-inline" id="portfolio-menu">
								<li data-filter="*" class="cbp-filter-item active">Tất cả dự án<div class="cbp-filter-counter"></div></li> 
                                <?php if(!empty($portfolioCategories)){
                                    foreach($portfolioCategories as $key=>$item){
                                        echo '<li data-filter=".category_'.$item['id'].'" class="cbp-filter-item">'.$item['name'].'<div class="cbp-filter-counter"></div></li>';
                                    }
                                } ?>
								
							</ul>  		
						</div>
						<!--/ End portfolio Nav -->
					</div>
				</div>
				<div class="portfolio-inner">
					<div class="row">	
						<div class="col-12">	
							<div id="portfolio-item">
                                <?php 
                                if(!empty($portfolios)){
                                    foreach($portfolios as $item){
                                        ?>
                                        <!-- Single portfolio -->
                                        <div class="cbp-item website category_<?php echo $item['portfolio_category_id'];?> printing">
                                            <div class="portfolio-single">
                                                <div class="portfolio-head">
                                                    <img src="<?php echo $item['thumbnail']; ?>" alt="#"/>
                                                </div>
                                                <div class="portfolio-hover">
                                                    <h4><a href="<?php echo getLinkModule('portfolios',$item['id']); ?>"><?php echo $item['name']; ?></a></h4>
                                                    <p><?php echo $item['description'];?></p>
                                                    <div class="button">
                                                        <?php
                                                        if(!empty($item['video'])){
                                                            ?>
                                                            <a href="<?php echo $item['video']; ?>" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <a class="primary" data-fancybox="gallery" href="<?php echo $item['thumbnail']; ?>"><i class="fa fa-search"></i></a>
                                                        <a href="<?php echo getLinkModule('portfolios',$item['id']); ?>"><i class="fa fa-link"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ End portfolio -->	
                                        <?php
                                    }
                                }
                                ?>			
							</div>
						</div>
						<div class="col-12">
                            <?php if(!empty($moreLink) && !empty($moreText) && empty($isPortfolioPage)): ?>
							<div class="button">
								<a class="btn primary" href="<?php echo $moreLink; ?>"><?php echo $moreText; ?></a>
							</div>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End portfolio -->