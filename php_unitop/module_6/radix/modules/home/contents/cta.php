<?php
$homeCtaTitle = getOption('home_cta_title');
$homeCtaContent = getOption('home_cta_content');
$homeCtaBtnText = getOption('home_cta_btn_text');
$homeCtaBtnLink = getOption('home_cta_btn_link');
?>
<!-- Call To Action -->
		<section class="call-to-action section" data-stellar-background-ratio="0.9">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12 wow fadeInUp">
						<div class="call-to-main">
                            <?php if(!empty($homeCtaTitle)): ?>
							<h2><?php echo $homeCtaTitle; ?></h2>
                            <?php endif; 
                            if(!empty($homeCtaContent)):
                            ?>
							<p><?php echo html_entity_decode($homeCtaContent); ?></p>
                            <?php endif;?>
							<a href="<?php echo (!empty($homeCtaBtnLink))?$homeCtaBtnLink:'#';?>" class="btn"><?php echo (!empty($homeCtaBtnText))?$homeCtaBtnText:'Buy This Theme'; ?></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Call To Action -->