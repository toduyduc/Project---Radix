<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập chung"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
if(isPost()){
    $allFields = getBody();
    $countUpdate = 0;
    if(!empty($allFields)){
        foreach($allFields as $field=>$value){
            $condition = "opt_key = '$field'";
            $dataUpdate = [
                'opt_value'=>trim($value)
            ];
            $updateStatus=update('options',$dataUpdate,$condition);
            if($updateStatus){
                $countUpdate++;
            }
        }
    }
    if($countUpdate>0){
        setFlashData("msg",'Đã cập nhật thành công '.$countUpdate.' bản ghi');
        setFlashData("msg_type","success");
    }else{
        setFlashData("msg","Cập nhật không thành công !");
        setFlashData("msg_type","danger");
    }
    redirect(getPathAdmin());
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
            <h5>Thông tin website</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('general_sitename','label'); ?></label>
                <input type="text" class="form-control" name="general_sitename" value="<?php echo getOption('general_sitename'); ?>" placeholder="<?php echo getOption('general_sitename','label'); ?>...">
                <?php echo form_errors('general_sitename',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_sitedesc','label'); ?></label>
                <textarea type="text" class="form-control" name="general_sitedesc" placeholder="<?php echo getOption('general_sitedesc','label'); ?>..."><?php echo getOption('general_sitedesc'); ?></textarea>
                <?php echo form_errors('general_sitedesc',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Thông tin liên hệ</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('general_hotline','label'); ?></label>
                <input type="text" class="form-control" name="general_hotline" value="<?php echo getOption('general_hotline'); ?>" placeholder="Hotline...">
                <?php echo form_errors('hotline',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_email','label'); ?></label>
                <input type="text" class="form-control" name="general_email" value="<?php echo getOption('general_email'); ?>" placeholder="Email...">
                <?php echo form_errors('general_email',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_time','label'); ?></label>
                <input type="text" class="form-control" name="general_time" value="<?php echo getOption('general_time'); ?>" placeholder="Thời gian làm việc...">
                <?php echo form_errors('general_time',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_address','label'); ?></label>
                <input type="text" class="form-control" name="general_address" value="<?php echo getOption('general_address'); ?>" placeholder="Địa chỉ công ty...">
                <?php echo form_errors('general_address',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <h5>Mạng xã hội</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('general_twitter','label'); ?></label>
                <input type="text" class="form-control" name="general_twitter" value="<?php echo getOption('general_twitter'); ?>" placeholder="<?php echo getOption('general_twitter','label');?>...">
                <?php echo form_errors('general_twitter',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_facebook','label'); ?></label>
                <input type="text" class="form-control" name="general_facebook" value="<?php echo getOption('general_facebook'); ?>" placeholder="<?php echo getOption('general_facebook','label');?>...">
                <?php echo form_errors('general_facebook',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_linkedin','label'); ?></label>
                <input type="text" class="form-control" name="general_linkedin" value="<?php echo getOption('general_linkedin'); ?>" placeholder="<?php echo getOption('general_linkedin','label');?>...">
                <?php echo form_errors('general_linkedin',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_behance','label'); ?></label>
                <input type="text" class="form-control" name="general_behance" value="<?php echo getOption('general_behance'); ?>" placeholder="<?php echo getOption('general_behance','label');?>...">
                <?php echo form_errors('general_behance',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('general_youtube','label'); ?></label>
                <input type="text" class="form-control" name="general_youtube" value="<?php echo getOption('general_youtube'); ?>" placeholder="<?php echo getOption('general_youtube','label');?>...">
                <?php echo form_errors('general_youtube',$errors,'<span class="errors">','</span>'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);