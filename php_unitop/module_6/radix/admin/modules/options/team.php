<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập Team"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
if(isPost()){
    $allFields = getBody();
    $teamContentArr=[];
    if(!empty($allFields)){
        $teamContent = $allFields['team_content'];
        if(!empty($teamContent['name'])){
            foreach($teamContent['name'] as $key=>$value){
                $teamContentArr[]=[
                    'name'=>$value,
                    'position'=>isset($teamContent['position'][$key])?$teamContent['position'][$key]:'',
                    'image'=>isset($teamContent['image'][$key])?$teamContent['image'][$key]:'',
                    'facebook'=>isset($teamContent['facebook'][$key])?$teamContent['facebook'][$key]:'',
                    'twitter'=>isset($teamContent['twitter'][$key])?$teamContent['twitter'][$key]:'',
                    'behance'=>isset($teamContent['behance'][$key])?$teamContent['behance'][$key]:'',
                    'linkedin'=>isset($teamContent['linkedin'][$key])?$teamContent['linkedin'][$key]:''
                ];
            }
            $teamContentJson = json_encode($teamContentArr);
        }
        //echo $teamContentArr;
        // echo '<pre>';
        // print_r($teamContentArr);
        // echo '</pre>';
        // die();
        $data = [
            'team_title'=>$allFields['team_title'],
            'team_primary_title'=>$allFields['team_primary_title'],
            'team_title_bg'=>$allFields['team_title_bg'],
            'team_desc'=>$allFields['team_desc'],
            'team_content'=>$teamContentJson
        ];
    }
    
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
            <h5>Thiết lập Team</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('team_title','label'); ?></label>
                <input type="text" class="form-control" name="team_title" value="<?php echo getOption('team_title'); ?>" placeholder="<?php echo getOption('team_title','label'); ?>...">
                <?php echo form_errors('team_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Thiết lập chung</h5>
            <div class="form-group">
                <label for=""><?php echo getOption('team_primary_title','label'); ?></label>
                <input type="text" class="form-control" name="team_primary_title" value="<?php echo getOption('team_primary_title'); ?>" placeholder="<?php echo getOption('team_primary_title','label'); ?>...">
                <?php echo form_errors('team_primary_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('team_title_bg','label'); ?></label>
                <input type="text" class="form-control" name="team_title_bg" value="<?php echo getOption('team_title_bg'); ?>" placeholder="<?php echo getOption('team_title_bg','label'); ?>...">
                <?php echo form_errors('team_title_bg',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('team_desc','label'); ?></label>
                <textarea type="text" class="editor form-control" name="team_desc" placeholder="<?php echo getOption('team_desc','label'); ?>..."><?php echo getOption('team_desc'); ?></textarea>
                <?php echo form_errors('team_desc',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Danh sách đội ngũ</h5>
            <div class="team-wrapper">
            <?php
                $teamJson = getOption('team_content');
                $teamArr=[];
                if(!empty($teamJson)){
                    $teamArr = json_decode($teamJson,true);
                }

                if(!empty($teamArr)){
                    foreach($teamArr as $key=>$item){    
                    ?>
                        <div class="team-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Tên thành viên</label>
                                                <input type="text" class="form-control" name="team_content[name][]" value="<?php echo ($item['name'])?$item['name']:false;?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Chức vụ</label>
                                                <input type="text" class="form-control" name="team_content[position][]" value="<?php echo ($item['position'])?$item['position']:false;?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Ảnh</label>
                                                <div class="row ckfinder-group">
                                                    <div class="col-10">
                                                        <input type="text" class="form-control image-render" name="team_content[image][]" placeholder="Đường dẫn ảnh..." value="<?php echo ($item['image'])?$item['image']:false;?>"> 
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Facebook</label>
                                                <input type="text" class="form-control" name="team_content[facebook][]" value="<?php echo ($item['facebook'])?$item['facebook']:false;?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Twitter</label>
                                                <input type="text" class="form-control" name="team_content[twitter][]" value="<?php echo ($item['twitter'])?$item['twitter']:false;?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Behance</label>
                                                <input type="text" class="form-control" name="team_content[behance][]" value="<?php echo ($item['behance'])?$item['behance']:false;?>">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Linkedin</label>
                                                <input type="text" class="form-control" name="team_content[linkedin][]" value="<?php echo ($item['linkedin'])?$item['linkedin']:false;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
                                </div>
                            </div>
                        </div><!--  end. team-item -->
                    <?php
                    }
                }
            ?>
            </div><!--  end. team-wrapper -->
            <p style="padding-top: 10px;"><button class="btn btn-warning add-team" type="button">Thêm thành viên</button></p>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);