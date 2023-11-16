<?php
if(!defined("_INCODE")) die("unauthorized access...");
$data = [
    "pageTitle"=>getOption('team_title')
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
$title = getOption('team_primary_title');
$teamBg = getOption('team_title_bg');
$desc = getOption('team_desc');
?>
        <!-- Start Team -->
		<section id="team" class="team section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
                            <?php if(!empty($teamBg)): ?>
                                <span class="title-bg"><?php echo $teamBg; ?></span>
                            <?php endif;
                            if(!empty($title)): ?>
							<h1><?php echo $title; ?></h1>
                            <?php endif; 
                            if(!empty($desc)){
                                echo html_entity_decode($desc);
                            }
                            ?>
							
						</div>
					</div>
				</div>
				<div class="row">
				<?php
                $teamJson = getOption('team_content');
                $teamArr=[];
                if(!empty($teamJson)){
                    $teamArr = json_decode($teamJson,true);
                }

                if(!empty($teamArr)){
                    foreach($teamArr as $key=>$item){    
                    ?>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Team -->
						<div class="single-team">
							<div class="t-head">
								<img src="<?php echo (!empty($item['image']))?$item['image']:false; ?>" alt="#">
								<div class="t-icon">
									<a href="team-single.html"><i class="fa fa-plus"></i></a>
								</div>
							</div>
							<div class="t-bottom">
								<p><?php echo (!empty($item['position']))?$item['position']:false; ?></p>
								<h2><?php echo (!empty($item['name']))?$item['name']:false; ?></h2>
								<ul class="t-social">
									<?php 
									if(!empty($item['facebook'])){
										echo '<li><a href="'.$item['facebook'].'"><i class="fa fa-facebook"></i></a></li>';
									}
									if(!empty($item['twitter'])){
										echo '<li><a href="'.$item['twitter'].'"><i class="fa fa-twitter"></i></a></li>';
									}
									if(!empty($item['linkedin'])){
										echo '<li><a href="'.$item['linkedin'].'"><i class="fa fa-linkedin"></i></a></li>';
									}
									if(!empty($item['behance'])){
										echo '<li><a href="'.$item['behance'].'"><i class="fa fa-behance"></i></a></li>';
									}
									?>			
								</ul>
							</div>
						</div>
						<!-- End Single Team -->
					</div>	
				<?php
					}
				}
				?>
				</div>
			</div>
		</section>
		<!--/ End Team -->
<?php
layout('footer','client');