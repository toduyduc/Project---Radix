			<?php
                    $homeFactJson = getOption('home_fact');
                    $homeFactArr=[];
                    $homeFactLeft = [];
                    $homeFactRight = [];
                    if(!empty($homeFactJson)){
                        $homeFactArr = json_decode($homeFactJson,true);
                        $homeFactLeft=json_decode($homeFactArr['left'],true);
                        $homeFactRight = json_decode($homeFactArr['right'],true);
                    }
                        
            ?>
		<!-- Fun Facts -->
		<section id="fun-facts" class="fun-facts section">
			<div class="container">	
				<div class="row">
					<div class="col-lg-5 col-12 wow fadeInLeft" data-wow-delay="0.5s">
						<?php if(!empty($homeFactLeft)): ?>
						<div class="text-content">
							<div class="section-title">
								<h1><span><?php echo (!empty($homeFactLeft['sub_title']))?$homeFactLeft['sub_title']:false; ?></span><?php echo (!empty($homeFactLeft['title']))?$homeFactLeft['title']:false; ?></h1>
								<?php echo (!empty($homeFactLeft['desc']))?html_entity_decode($homeFactLeft['desc']):false; ?>
								<a href="<?php echo (!empty($homeFactLeft['btn_link']))?$homeFactLeft['btn_link']:'#';?>" class="btn primary"><?php echo (!empty($homeFactLeft['btn_text']))?$homeFactLeft['btn_text']:false; ?></a>
							</div>
						</div>
						<?php endif; ?>
					</div>
					<div class="col-lg-7 col-12">
						<div class="row">	
						<?php
						if(!empty($homeFactRight)){
							foreach($homeFactRight as $key=>$item){
                        ?>
							<div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.6s">
								<!-- Single Fact -->
								<div class="single-fact">
									<div class="icon"><?php echo html_entity_decode($item['icon']);?></div>
									<div class="counter">
										<p><span class="count"><?php echo $item['number'];?></span><?php echo $item['unit'];?></p>
										<h4><?php echo $item['award'];?></h4>
									</div>
								</div>
								<!--/ End Single Fact -->
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
		<!--/ End Fun Facts -->