<?php
if(!defined("_INCODE")) die("unauthorized access...");
$data = [
    "pageTitle"=>getOption('service_title')
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
?>
        <!-- Services -->
		<section id="services" class="services archives section">
			<div class="container">
				<div class="row">
					<div class="col-12">
                        <div class="section-title">
							<span class="title-bg"><?php echo getOption('home_service_title_bg'); ?></span>
							<h1><?php echo getOption('home_service_title'); ?></h1>
							<p><?php echo html_entity_decode(getOption('home_service_desc')); ?><p>
						</div>
					</div>
				</div>
                <?php
                $serviceLists = getData('SELECT * FROM services');
                // echo '<pre>';
                // print_r($serviceLists);
                // echo '</pre>';
                //die();
                if(!empty($serviceLists)):
                ?>
				<div class="row">
                <?php
                    foreach($serviceLists as $item){
                ?>
					<div class="col-lg-4 col-md-6 col-12">
						<!-- Single Service -->
                                <div class="single-service">
                                    <?php echo html_entity_decode($item['icon']); ?>
                                    <h2><a href="<?php echo getLinkModule('services',$item['id']); ?>"><?php echo $item['name']; ?></a></h2>
                                    <?php echo html_entity_decode($item['description']); ?>
                                </div>     
						<!-- End Single Service -->
					</div>
                <?php
                    }
                ?>
					
				</div>
                <?php endif; ?>
			</div>
		</section>
		<!--/ End Services -->
<?php
require_once _WEB_PATH_ROOT.'/modules/home/contents/partner.php';
layout('footer','client');