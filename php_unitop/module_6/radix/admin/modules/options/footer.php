<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập Footer"
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
            <h5>Thiết lập cột 1</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_1_title','label'); ?></label>
                <input type="text" class="form-control" name="footer_1_title" value="<?php echo getOption('footer_1_title'); ?>" placeholder="<?php echo getOption('footer_1_title','label');?>...">
                <?php echo form_errors('footer_1_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_1_content','label'); ?></label>
                <textarea name="footer_1_content" class="editor"><?php echo getOption('footer_1_content'); ?></textarea>
                <?php echo form_errors('footer_1_content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            
            <h5>Thiết lập cột 2</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_2_title','label'); ?></label>
                <input type="text" class="form-control" name="footer_2_title" value="<?php echo getOption('footer_2_title'); ?>" placeholder="<?php echo getOption('footer_2_title','label');?>...">
                <?php echo form_errors('footer_2_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_2_content','label'); ?></label>
                <textarea name="footer_2_content" class="editor"><?php echo getOption('footer_2_content'); ?></textarea>
                <?php echo form_errors('footer_2_content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            
            <h5>Thiết lập cột 3</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_3_title','label'); ?></label>
                <input type="text" class="form-control" name="footer_3_title" value="<?php echo getOption('footer_3_title'); ?>" placeholder="<?php echo getOption('footer_3_title','label');?>...">
                <?php echo form_errors('footer_3_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_3_twitter','label'); ?></label>
                <input type="text" class="form-control" name="footer_3_twitter" value="<?php echo getOption('footer_3_twitter'); ?>" placeholder="<?php echo getOption('footer_3_twitter','label');?>...">
                <?php echo form_errors('footer_3_twitter',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <h5>Thiết lập cột 4</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_4_title','label'); ?></label>
                <input type="text" class="form-control" name="footer_4_title" value="<?php echo getOption('footer_4_title'); ?>" placeholder="<?php echo getOption('footer_4_title','label');?>...">
                <?php echo form_errors('footer_4_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_4_content','label'); ?></label>
                <textarea name="footer_4_content" class="editor"><?php echo getOption('footer_4_content'); ?></textarea>
                <?php echo form_errors('footer_4_content',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <h5>Thiết lập bản quyền</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_copyright','label'); ?></label>
                <textarea name="footer_copyright" class="editor"><?php echo getOption('footer_copyright'); ?></textarea>
                <?php echo form_errors('footer_copyright',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);