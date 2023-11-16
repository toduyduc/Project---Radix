<?php
$title = getOption('home_partner_title');
$desc = getOption('home_partner_desc');
$titleBg = getOption('home_partner_title_bg');
?>
		<!-- Partners -->
		<section id="partners" class="partners section">
			<div class="container">
				<div class="row">
					<div class="col-12 wow fadeInUp">
						<div class="section-title">
							<?php if(!empty($titleBg)): ?>
							<span class="title-bg"><?php echo $titleBg; ?></span>
							<?php 
							endif;
							if(!empty($title)):?>
							<h1><?php echo $title; ?></h1>
							<?php endif;
							if(!empty($desc)):
								echo html_entity_decode($desc);
							endif; 
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="partners-inner">
							<div class="row no-gutters">
							<?php
									$homePartnerJson = getOption('home_partner_content');
									$homePartnerArr=[];
									if(!empty($homePartnerJson)){
										$homePartnerArr = json_decode($homePartnerJson,true);
									}

								if(!empty($homePartnerArr)){

									foreach($homePartnerArr as $key=>$item){
							?>
										<!-- Single Partner -->
										<div class="col-lg-2 col-md-3 col-12">
											<div class="single-partner">
												<a href="<?php echo (!empty($item['link']))?$item['link']:false; ?>" target="_blank"><img src="<?php echo (!empty($item['logo']))?$item['logo']:false; ?>" alt="#"></a>
											</div>
										</div>
										<!--/ End Single Partner -->
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
		<!--/ End Partners -->