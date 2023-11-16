<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập dịch vụ"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
if(isPost()){
    $allFields = getBody();
    if(!empty($allFields['service_title'])){
        $data = [
            'service_title'=>$allFields['service_title'],
        ];
        updateOption($data);
    }

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
            <h5>Thiết lập dịch vụ</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('service_title','label'); ?></label>
                <input type="text" class="form-control" name="service_title" value="<?php echo getOption('service_title'); ?>" placeholder="<?php echo getOption('service_title','label'); ?>...">
                <?php echo form_errors('service_title',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);