<?php
$homeAboutJson = getOption('home_about');
$homeAboutArr=[];
$homeAboutInformation = [];
$homeAboutSkill = [];
if(!empty($homeAboutJson)){
	$homeAboutArr = json_decode($homeAboutJson,true);
	
	$homeAboutInformation=json_decode($homeAboutArr['information'],true);
	unset($homeAboutInformation['skill']);
	$homeAboutSkill = json_decode($homeAboutArr['skill'],true);
}
?>
		<!-- About Us -->
		<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title wow fadeInUp">
							<span class="title-bg"><?php echo (!empty($homeAboutInformation['title_bg']))?$homeAboutInformation['title_bg']:false; ?></span>
							<?php echo (!empty($homeAboutInformation['desc']))?html_entity_decode($homeAboutInformation['desc']):false;?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-12 wow fadeInLeft" data-wow-delay="0.6s">
						<!-- Video -->
						<?php if(!empty($homeAboutInformation['video']) && !empty($homeAboutInformation['image'])):?>
						<div class="about-video">
							<div class="single-video overlay">
								<a href="<?php echo $homeAboutInformation['video']; ?>" class="video-popup mfp-fade"><i class="fa fa-play"></i></a>
								<img src="<?php echo $homeAboutInformation['image'];?>" alt="#">
							</div>
						</div>
						<?php endif; ?>
						<!--/ End Video -->
					</div>
					<div class="col-lg-6 col-12 wow fadeInRight" data-wow-delay="0.8s">
						<!-- About Content -->
						<div class="about-content">
							<?php
							echo (!empty($homeAboutInformation['content']))?html_entity_decode($homeAboutInformation['content']):false;
							?>
						</div>
						<!--/ End About Content -->
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="progress-main">
							<div class="row">
								<?php
								if(!empty($homeAboutSkill)){
									foreach($homeAboutSkill as $key=>$item){
								?>
								<div class="col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.4s">
									<!-- Single Skill -->
									<div class="single-progress">
										<h4><?php echo $item['name']; ?></h4>
										<div class="progress">
											<div class="progress-bar" role="progressbar" style="width: <?php echo $item['value'];?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="percent"><?php echo $item['value'];?>%</span></div>
										</div>
									</div>
									<!--/ End Single Skill -->
								</div>
								<?php
									}
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End About Us -->