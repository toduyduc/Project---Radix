<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập trang chủ"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
//updateOption();
if(isPost()){

    $homeSlideJson = '';
    if(!empty(getBody()['home_slide'])){
        $homeSlide = getBody()['home_slide'];
        $homeSlideArr = [];
        // echo '<pre>';
        // print_r($homeSlideArr);
        // echo '</pre>';
        // die();
        if(!empty($homeSlide['slide_title'])){
            
            foreach($homeSlide['slide_title'] as $key=>$value){
                $homeSlideArr[] = [
                    'slide_title'=>$value,
                    'slide_button_text'=>isset($homeSlide['slide_button_text'][$key])?$homeSlide['slide_button_text'][$key]:'',
                    'slide_button_link'=>isset($homeSlide['slide_button_link'][$key])?$homeSlide['slide_button_link'][$key]:'',
                    'slide_video'=>isset($homeSlide['slide_video'][$key])?$homeSlide['slide_video'][$key]:'',
                    'slide_image_1'=>isset($homeSlide['slide_image_1'][$key])?$homeSlide['slide_image_1'][$key]:'',
                    'slide_image_2'=>isset($homeSlide['slide_image_2'][$key])?$homeSlide['slide_image_2'][$key]:'',
                    'slide_bg'=>isset($homeSlide['slide_bg'][$key])?$homeSlide['slide_bg'][$key]:'',
                    'slide_desc'=>isset($homeSlide['slide_desc'][$key])?$homeSlide['slide_desc'][$key]:'',
                    'slide_position'=>isset($homeSlide['slide_position'][$key])?$homeSlide['slide_position'][$key]:'left'
                ];
            
            }
        }
        
        
        $homeSlideJson = json_encode($homeSlideArr);
    }

    $homeAbout = [];
    if(!empty(getBody()['home_about'])){
        $homeAbout['information'] = json_encode(getBody()['home_about']);
    }
    
    $SkillJson = [];
    if(!empty(getBody()['home_about']['skill'])){
        $aboutSkill = getBody()['home_about']['skill'];
        $SkillArr = [];
        
        if(!empty($aboutSkill['name'])){
            foreach($aboutSkill['name'] as $key=>$value){
                $SkillArr[]=[
                    'name'=>$value,
                    'value'=>isset($aboutSkill['value'][$key])?$aboutSkill['value'][$key]:'',
                ];
                
            }
            $SkillJson = json_encode($SkillArr);
        }
    }
    $homeAbout['skill'] = $SkillJson;
    $homeAboutJson = json_encode($homeAbout);


    $homeFact = [];
    if(!empty(getBody()['home_fact']['left'])){
        $homeFact['left'] = json_encode(getBody()['home_fact']['left']);
    }

    $factJson = [];
    if(!empty(getBody()['home_fact']['right'])){
        $factRight = getBody()['home_fact']['right'];
        $factArr = [];
        
        if(!empty($factRight['icon'])){
            foreach($factRight['icon'] as $key=>$value){
                $factArr[]=[
                    'icon'=>$value,
                    'number'=>isset($factRight['number'][$key])?$factRight['number'][$key]:'',
                    'unit'=>isset($factRight['unit'][$key])?$factRight['unit'][$key]:'',
                    'award'=>isset($factRight['award'][$key])?$factRight['award'][$key]:''
                ];
                
            }
            $factJson = json_encode($factArr);
        }
    }
    $homeFact['right'] = $factJson;
    $homeFactJson = json_encode($homeFact);


    $partnerJson = '';
    $partnerArr = [];
    if(!empty(getBody()['home_partner_content'])){
        $partner = getBody()['home_partner_content'];
        //die();
        if(!empty($partner['logo'])){
            foreach($partner['logo'] as $key=>$item){
                $partnerArr[]=[
                    'logo'=>$item,
                    'link'=>isset($partner['link'][$key])?$partner['link'][$key]:''
                ];
            }
 
            $partnerJson = json_encode($partnerArr);
        }
    }

    //echo $partnerJson;
    //echo $home;
    // echo '<pre>';
    // print_r($partnerArr);
    // echo '</pre>';

    //die();

    $data = [
        'home_slide'=>$homeSlideJson,
        'home_about'=>$homeAboutJson,
        'home_fact'=>$homeFactJson,
        'home_partner_content'=>$partnerJson
    ];
    updateOption($data);
}

$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");

?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
 
            <h5>Thiết lập slide</h5>
            <hr>
            <div class="slide-wrapper">
            <?php
                    $homeSlideJson = getOption('home_slide');
                    if(!empty($homeSlideJson)){
                        $homeSlideArr = json_decode($homeSlideJson,true);
                        if(!empty($homeSlideArr)){
                            foreach($homeSlideArr as $item){
                                ?>
                                    <div class="slide-item">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Tiêu đề</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_title][]" value="<?php echo $item['slide_title']; ?>" placeholder="Tiêu đề..."> </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Nút xem thêm</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_button_text][]" value="<?php echo $item['slide_button_text']; ?>" placeholder="Link của nút thêm..."> </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Link nút xem thêm</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_button_link][]" value="<?php echo $item['slide_button_link']; ?>" placeholder="Link của nút thêm..."> </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Link video</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_video][]" value="<?php echo $item['slide_video']; ?>" placeholder="Link video youtube..."> </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Ảnh 1</label>
                                                            <div class="row ckfinder-group">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control image-render" name="home_slide[slide_image_1][]" value="<?php echo $item['slide_image_1']; ?>" placeholder="Đường dẫn ảnh 1..."> </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Ảnh 2</label>
                                                            <div class="row ckfinder-group">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control image-render" name="home_slide[slide_image_2][]" value="<?php echo $item['slide_image_2']; ?>" placeholder="Đường dẫn ảnh 2..."> </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Ảnh nền</label>
                                                            <div class="row ckfinder-group">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control image-render" name="home_slide[slide_bg][]" value="<?php echo $item['slide_bg']; ?>" placeholder="Đường dẫn ảnh nền..."> </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Mô tả</label>
                                                            <textarea class="form-control" name="home_slide[slide_desc][]" placeholder="Mô tả slide..."><?php echo $item['slide_desc']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Vị trí</label>
                                                            <select class="form-control" name="home_slide[slide_position][]" id="">
                                                                <option <?php echo ($item['slide_position']=='left')?'selected':false; ?> value="left">Trái</option>
                                                                <option <?php echo ($item['slide_position']=='right')?'selected':false; ?> value="right">Phải</option>
                                                                <option <?php echo ($item['slide_position']=='center')?'selected':false; ?> value="center">Giữa</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1"> <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> </div>
                                        </div>
                                    </div>
                                    <!--  end slide-item -->
                                <?php
                            }
                        }
                    }
                ?>
            </div>
            
            <p style="padding-top: 10px;"><button class="btn btn-warning add-slide" type="button">Thêm slide</button></p>
            <hr>

            <h5>Thiết lập slide</h5>
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
                        // echo '<pre>';
                        // print_r($homeAboutSkill);
                        // echo '</pre>';
                        // die();
            ?>
            
            <div class="form-group">
                <label for="">Tiêu đề nền</label>
                <input type="text" class="form-control" name="home_about[title_bg]" value="<?php echo ($homeAboutInformation['title_bg'])?$homeAboutInformation['title_bg']:false;?>" placeholder="Tiêu đề nền...">
            </div>

            <hr>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="home_about[desc]" class="editor"><?php echo ($homeAboutInformation['desc'])?$homeAboutInformation['desc']:false; ?></textarea>
            </div>

            <div class="form-group">
                <label for="">Hình ảnh</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="home_about[image]" value="<?php echo ($homeAboutInformation['image'])?$homeAboutInformation['image']:false; ?>" placeholder="Đường dẫn ảnh...">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Link video</label>
                <input type="text" class="form-control" name="home_about[video]" value="<?php echo ($homeAboutInformation['video'])?$homeAboutInformation['video']:false; ?>" placeholder="Link video...">
            </div>

            <div class="form-group">
                <label for="">Nội dung giới thiệu</label>
                <textarea name="home_about[content]"  class="editor"><?php echo ($homeAboutInformation['content'])?$homeAboutInformation['content']:false; ?></textarea>
            </div>
            <h5>Thiết lập năng lực</h5>
            <div class="skill-wrapper">
                <?php
                        if(!empty($homeAboutSkill)){

                            foreach($homeAboutSkill as $key=>$item){
                                ?>
                                <div class="skill-item">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Tên năng lực</label>
                                                        <input type="text" class="form-control" name="home_about[skill][name][]" value="<?php echo $item['name'];?>" placeholder="Tên năng lực...">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Giá trị</label>
                                                        <input type="text" class="ranger form-control" name="home_about[skill][value][]" value="<?php echo $item['value'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
                                        </div>
                                    </div>
                                </div><!--  end. skill-item -->
                                <?php
                            }
                        }
                ?>
            </div><!--  end. skill-swapper -->
            <p style="padding-top: 10px;"><button class="btn btn-warning add-skill" type="button">Thêm năng lực</button></p>
            <h5>Thiết lập dịch vụ</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('home_service_title_bg','label'); ?></label>
                <input type="text" class="form-control" name="home_service_title_bg" value="<?php echo getOption('home_service_title_bg'); ?>" placeholder="<?php echo getOption('home_service_title_bg','label');?>...">
                <?php echo form_errors('home_service_title_bg',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_service_title','label'); ?></label>
                <input type="text" class="form-control" name="home_service_title" value="<?php echo getOption('home_service_title'); ?>" placeholder="<?php echo getOption('home_service_title','label');?>...">
                <?php echo form_errors('home_service_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_service_desc','label'); ?></label>
                <textarea name="home_service_desc" class="editor"><?php echo getOption('home_service_desc'); ?></textarea>
                <?php echo form_errors('home_service_desc',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Thiết lập thành tựu</h5>
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
                        // echo '<pre>';
                        // print_r($homeFactArr);
                        // echo '</pre>';
                        // die();
            ?>
            <hr>
            <div class="form-group">
                <label for="">Tiêu đề chính</label>
                <input type="text" class="form-control" name="home_fact[left][title]" value="<?php echo (!empty($homeFactLeft['title']))?$homeFactLeft['title']:false; ?>" placeholder="Tiêu đề chính...">
            </div>
            <div class="form-group">
                <label for="">Tiêu đề phụ</label>
                <input type="text" class="form-control" name="home_fact[left][sub_title]" value="<?php echo (!empty($homeFactLeft['sub_title']))?$homeFactLeft['sub_title']:false; ?>" placeholder="Tiêu đề phụ...">
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="home_fact[left][desc]" class="editor"><?php echo (!empty($homeFactLeft['desc']))?$homeFactLeft['desc']:false; ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Nội dung nút</label>
                <input type="text" class="form-control" name="home_fact[left][btn_text]" value="<?php echo (!empty($homeFactLeft['btn_text']))?$homeFactLeft['btn_text']:false; ?>" placeholder="Nội dung nút...">
            </div>
            <div class="form-group">
                <label for="">Link nút</label>
                <input type="text" class="form-control" name="home_fact[left][btn_link]" value="<?php echo (!empty($homeFactLeft['btn_link']))?$homeFactLeft['btn_link']:false; ?>" placeholder="Link nút...">
            </div>
            <h5>Thiết lập thành tích</h5>
            <div class="fact-wrapper">
            <?php
                if(!empty($homeFactRight)){
                    foreach($homeFactRight as $key=>$item){
                        ?>
                        <div class="fact-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label for="">Icon thành tích</label>
                                                <input type="text" class="form-control" name="home_fact[right][icon][]" value="<?php echo $item['icon'];?>" placeholder="Icon thành tích...">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Số thành tích</label>
                                                <input type="text" class="form-control" name="home_fact[right][number][]" value="<?php echo $item['number'];?>" placeholder="Số lượng thành tích...">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Đơn vị Số lượng</label>
                                                <input type="text" class="form-control" name="home_fact[right][unit][]" value="<?php echo $item['unit'];?>" placeholder="Đơn vị đo số lượng thành tích...">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Giải thưởng</label>
                                                <input type="text" class="form-control" name="home_fact[right][award][]" value="<?php echo $item['award'];?>" placeholder="Giải thưởng...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
                                </div>
                            </div>
                        </div><!--  end. skill-item -->
                        <?php
                    }
                }
            ?>
            </div><!--  end. skill-swapper -->
            <p style="padding-top: 10px;"><button class="btn btn-warning add-fact" type="button">Thêm năng lực</button></p>
            <h5>Thiết lập dự án</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('home_Portfolio_title','label'); ?></label>
                <input type="text" class="form-control" name="home_Portfolio_title" value="<?php echo getOption('home_Portfolio_title'); ?>" placeholder="<?php echo getOption('home_Portfolio_title','label');?>...">
                <?php echo form_errors('home_Portfolio_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_Portfolio_title_bg','label'); ?></label>
                <input type="text" class="form-control" name="home_Portfolio_title_bg" value="<?php echo getOption('home_Portfolio_title_bg'); ?>" placeholder="<?php echo getOption('home_Portfolio_title_bg','label');?>...">
                <?php echo form_errors('home_Portfolio_title_bg',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_Portfolio_desc','label'); ?></label>
                <textarea name="home_Portfolio_desc" class="editor"><?php echo getOption('home_Portfolio_desc'); ?></textarea>
                <?php echo form_errors('home_Portfolio_desc',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_Portfolio_more_link','label'); ?></label>
                <input type="text" class="form-control" name="home_Portfolio_more_link" value="<?php echo getOption('home_Portfolio_more_link'); ?>" placeholder="<?php echo getOption('home_Portfolio_more_link','label');?>...">
                <?php echo form_errors('home_Portfolio_more_link',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_Portfolio_more_text','label'); ?></label>
                <input type="text" class="form-control" name="home_Portfolio_more_text" value="<?php echo getOption('home_Portfolio_more_text'); ?>" placeholder="<?php echo getOption('home_Portfolio_more_text','label');?>...">
                <?php echo form_errors('home_Portfolio_more_text',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Thiết lập kêu gọi hành động</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('home_cta_title','label'); ?></label>
                <input type="text" class="form-control" name="home_cta_title" value="<?php echo getOption('home_cta_title'); ?>" placeholder="<?php echo getOption('home_cta_title','label');?>...">
                <?php echo form_errors('home_cta_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_cta_content','label'); ?></label>
                <textarea name="home_cta_content" class="editor"><?php echo getOption('home_cta_content'); ?></textarea>
                <?php echo form_errors('home_cta_content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_cta_btn_text','label'); ?></label>
                <input type="text" class="form-control" name="home_cta_btn_text" value="<?php echo getOption('home_cta_btn_text'); ?>" placeholder="<?php echo getOption('home_cta_btn_text','label');?>...">
                <?php echo form_errors('home_cta_btn_text',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_cta_btn_link','label'); ?></label>
                <input type="text" class="form-control" name="home_cta_btn_link" value="<?php echo getOption('home_cta_btn_link'); ?>" placeholder="<?php echo getOption('home_cta_btn_link','label');?>...">
                <?php echo form_errors('home_cta_btn_link',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <h5>Thiết lập blog</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('home_blog_title','label'); ?></label>
                <input type="text" class="form-control" name="home_blog_title" value="<?php echo getOption('home_blog_title'); ?>" placeholder="<?php echo getOption('home_blog_title','label');?>...">
                <?php echo form_errors('home_blog_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_blog_desc','label'); ?></label>
                <textarea name="home_blog_desc" class="editor"><?php echo getOption('home_blog_desc'); ?></textarea>
                <?php echo form_errors('home_blog_desc',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_blog_title_bg','label'); ?></label>
                <input type="text" class="form-control" name="home_blog_title_bg" value="<?php echo getOption('home_blog_title_bg'); ?>" placeholder="<?php echo getOption('home_blog_title_bg','label');?>...">
                <?php echo form_errors('home_blog_title_bg',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Thiết lập đối tác</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('home_partner_title','label'); ?></label>
                <input type="text" class="form-control" name="home_partner_title" value="<?php echo getOption('home_partner_title'); ?>" placeholder="<?php echo getOption('home_partner_title','label');?>...">
                <?php echo form_errors('home_partner_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_partner_desc','label'); ?></label>
                <textarea name="home_partner_desc" class="editor"><?php echo getOption('home_partner_desc'); ?></textarea>
                <?php echo form_errors('home_partner_desc',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('home_partner_title_bg','label'); ?></label>
                <input type="text" class="form-control" name="home_partner_title_bg" value="<?php echo getOption('home_partner_title_bg'); ?>" placeholder="<?php echo getOption('home_partner_title_bg','label');?>...">
                <?php echo form_errors('home_partner_title_bg',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <?php
                    $homePartnerJson = getOption('home_partner_content');
                    $homePartnerArr=[];
                    if(!empty($homePartnerJson)){
                        $homePartnerArr = json_decode($homePartnerJson,true);
                    }
                    // echo $homePartnerJson;
                    // echo '<pre>';
                    // print_r($homePartnerArr);
                    // echo '</pre>';
            ?>
            <div class="partner-wrapper">
            <?php
                        if(!empty($homePartnerArr)){

                            foreach($homePartnerArr as $key=>$item){
                                ?>
                                <div class="partner-item">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Ảnh đối tác</label>
                                                        <div class="row ckfinder-group">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control image-render" name="home_partner_content[logo][]" value="<?php echo $item['logo']; ?>" placeholder="Đường dẫn ảnh..."> </div>
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Link đối tác</label>
                                                        <input type="text" class="form-control" name="home_partner_content[link][]" value="<?php echo $item['link'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
                                        </div>
                                    </div>
                                </div><!--  end. skill-item -->
                                <?php
                            }
                        }
                ?>
            </div><!--  end. skill-swapper -->
            <p style="padding-top: 10px;"><button class="btn btn-warning add-partner" type="button">Thêm đối tác</button></p>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);
?>