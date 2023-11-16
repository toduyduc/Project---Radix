<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập liên hệ"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

updateOption();


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
            <h5>Thiết lập liên hệ</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('contact_title','label'); ?></label>
                <input type="text" class="form-control" name="contact_title" value="<?php echo getOption('contact_title'); ?>" placeholder="<?php echo getOption('contact_title','label'); ?>...">
                <?php echo form_errors('contact_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <h5>Thiết lập chung</h5>
            <div class="form-group">
                <label for=""><?php echo getOption('contact_primary_title','label'); ?></label>
                <input type="text" class="form-control" name="contact_primary_title" value="<?php echo getOption('contact_primary_title'); ?>" placeholder="<?php echo getOption('contact_primary_title','label'); ?>...">
                <?php echo form_errors('contact_primary_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('contact_title_bg','label'); ?></label>
                <input type="text" class="form-control" name="contact_title_bg" value="<?php echo getOption('contact_title_bg'); ?>" placeholder="<?php echo getOption('contact_title_bg','label'); ?>...">
                <?php echo form_errors('contact_title_bg',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('contact_desc','label'); ?></label>
                <textarea type="text" class="editor form-control" name="contact_desc" placeholder="<?php echo getOption('contact_desc','label'); ?>..."><?php echo getOption('contact_desc'); ?></textarea>
                <?php echo form_errors('contact_desc',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);