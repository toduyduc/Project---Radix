<?php
if(!defined("_INCODE")) die("unauthorized access...");
$data = [
    "pageTitle"=>"Liên hệ"
];
layout('header','client',$data);
layout('Breadcrumb','client',$data);
$title = getOption('contact_primary_title');
$contactBg = getOption('contact_title_bg');
$desc = getOption('contact_desc');

// truy vấn lấy phòng ban
$contactTypeLists = getData("SELECT * FROM contact_type ORDER BY name ASC");

if(isPost()){
    //xử lý gửi liên hệ
    $body = getBody();
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
    // validate họ tên bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["fullname"]))){
        $errors["fullname"]["required"]="Họ tên không được để trống";
    }else{
        if(strlen(trim($body["fullname"]))<5){
            $errors["fullname"]["min"]="Họ tên phải >= 5 ký tự";
        }
    }

    // validate email : bắt buộc phải nhập,định dạng email, email duy nhất
    if(empty(trim($body["email"]))){
        $errors["email"]["required"]="Email bắt buộc phải nhập";

    }else{
        if(!isEmail(trim($body["email"]))){
            $errors["email"]["isEmail"]="Định dạng email không hợp lệ";
        }
    }
    if(empty($errors)){
        if(!empty($body)){
            $dataContact=[
                "fullname"=>trim($body['fullname']),
                "email"=>trim($body['email']),
                "type_id"=>$body['type_id'],
                "message"=>trim($body['message']),
                "status"=>0,
                "create_at"=>date('Y-m-d H:i:s')
            ];
            $contactStatus = insert('contacts',$dataContact);
            if($contactStatus){
                setFlashData("msg","Gửi liên hệ thành công, chúng tôi sẽ liên hệ với bạn sớm nhất !");
                setFlashData("msg_type","success");

				// gửi email liên hệ cho admin
				$getNameDepartment= firstRow("SELECT name FROM contact_type WHERE id=".$dataContact['type_id']);
				// echo '<pre>';
				// print_r($getNameDepartment);
				// echo '</pre>';
				
                $subjectDepartment = 'THONG BAO CO KHACH HANG GUI LIEN HE';
				$contentDepartment = '<b>Liên hệ gửi đến từ </b>: '.$dataContact['fullname'].'<br>';
				$contentDepartment.='<b>Email: </b>'.$dataContact['email'].'<br>';
				$contentDepartment.='<b>Phòng ban: </b>'.$getNameDepartment['name'].'<br>';
				$contentDepartment.='<b>Nội dung: </b>'.$dataContact['message'];
				sendMail('dduy8195@gmail.com',$subjectDepartment,$contentDepartment);
            }else{
                setFlashData("msg","Gửi liên hệ không thành công !");
                setFlashData("msg_type","danger");
            }
            redirect('lien-he.html');
        }
    }else{
        setFlashData("msg","vui lòng kiểm tra nội dung nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
    }

    
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
// echo '<pre>';
// print_r($contactList);
// echo "</pre>";
?>
		<!-- Start Contact -->
		<section id="contact-us" class="contact-us section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<span class="title-bg"><?php echo (!empty($contactBg))?$contactBg:false; ?></span>
                            <?php echo (!empty($title))?'<h1>'.$title.'</h1>':false; ?>
							<?php echo (!empty($desc))?html_entity_decode($desc):false; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="contact-main">
                        <?php getMsg($msg,$msg_type); ?>
							<div class="row">
								<!-- Contact Form -->
                                
								<div class="col-lg-8 col-12">

									<div class="form-main">
										<div class="text-content">
											<h2>Send Message Us</h2>
										</div>
										<form class="form" method="post">
											<div class="row">
												<div class="col-lg-6 col-12">
													<div class="form-group">
														<input type="text" name="fullname" placeholder="Full Name" value="<?php echo old('fullname',$old); ?>">
                                                        <?php echo form_errors('fullname',$errors,'<span class="errors">','</span>'); ?>
													</div>
												</div>
												<div class="col-lg-6 col-12">
													<div class="form-group">
														<input type="email" name="email" placeholder="Your Email" value="<?php echo old('email',$old); ?>">
                                                        <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
													</div>
												</div>
                                                <?php if(!empty($contactTypeLists)):?>
												<div class="col-12">
													<div class="form-group">
														<select name="type_id">
                                                        <?php
                                                        foreach($contactTypeLists as $key=>$item){
                                                            echo '<option class="option" value="'.$item['id'].'">'.$item['name'].'</option>';
                                                        }
                                                        ?>
														</select>
													</div>
												</div>
                                                <?php endif;?>
												<div class="col-lg-12 col-12">
													<div class="form-group">
														<textarea name="message" rows="6" placeholder="Type Your Message" ><?php echo old('message',$old); ?></textarea>
													</div>
												</div>
												<div class="col-lg-12 col-12">
													<div class="form-group button">	
														<button type="submit" class="btn primary">Submit Message</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<!--/ End Contact Form -->
								<!-- Contact Address -->
								<div class="col-lg-4 col-12">
									<div class="contact-address">
										<!-- Address -->
										<div class="contact">
											<h2>Our Contact Address</h2>
											<ul class="address">
												<li><i class="fa fa-paper-plane"></i><span>Address: </span> <?php echo getOption('general_address');?></li>
												<li><i class="fa fa-phone"></i><span>Phone: </span><?php echo getOption('general_hotline');?></li>
												<li class="email"><i class="fa fa-envelope"></i><span>Email: </span><a href="#"><?php echo getOption('general_email');?></a></li>
											</ul>
										</div>
										<!--/ End Address -->
										<!-- Social -->
										<ul class="social">
                                            <?php if(!empty(getOption('general_facebook'))):?>
											    <li class="active"><a target="blank" href="<?php echo getOption('general_facebook');?>"><i class="fa fa-facebook"></i>Like Us facebook</a></li>
                                            <?php endif;
                                            if(!empty(getOption('general_twitter'))):
                                            ?>
											<li><a target="blank" href="<?php echo getOption('general_twitter');?>"><i class="fa fa-twitter"></i>Follow Us twitter</a></li>
                                            <?php endif;
                                            if(!empty(getOption('general_linkedin'))):
                                            ?>
											<li><a target="blank" href="<?php echo getOption('general_linkedin');?>"><i class="fa fa-linkedin"></i>Follow Us linkedin</a></li>
                                            <?php endif;
                                            if(!empty(getOption('general_behance'))):
                                            ?>
											<li><a target="blank" href="<?php echo getOption('general_behance');?>"><i class="fa fa-behance"></i>Follow Us behance</a></li>
                                            <?php endif; ?>
										</ul>
										<!--/ End Social -->
									</div>
								</div>
								<!--/ End Contact Address -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Contact -->
        <?php
        require_once _WEB_PATH_ROOT.'/modules/home/contents/partner.php';
layout('footer','client');