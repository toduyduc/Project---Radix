<?php
if(!defined("_INCODE")) die("unauthorized access...");

if(!empty(getBody()['id'])){
    $id = getBody()['id'];

    // thực hiện truy vấn với bảng services
    $sql = "SELECT * FROM services WHERE id = $id";
    $serviceDetail = firstRow($sql);
    //echo $serviceDetail['content'];
    // echo '<pre>';
    // print_r($serviceDetail);
    // echo '</pre>';
    if(empty($serviceDetail)){
        loadError();
    }
}else{
    loadError();// load giao dien 404
}

$data = [
    "pageTitle"=>$serviceDetail['name'],
    "itemParent"=>'<li class="active"><a href="'._WEB_HOST_ROOT.'?module=services&action=lists"><i class="fa fa-clone"></i> '.getOption('service_title').'</a></li>'
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
?>

        <!-- Services -->
		<section id="services" class="services archives section">
			<div class="container">
				<h1 class="text-small"><?php echo $serviceDetail['name']; ?></h1>
                <hr>
                <div class="content">
                    <?php
                         echo html_entity_decode($serviceDetail['content']);
                    ?>
                </div>
			</div>
		</section>
		<!--/ End Services -->
<?php
layout('footer','client');