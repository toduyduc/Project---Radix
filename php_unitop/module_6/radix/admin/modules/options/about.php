<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập giới thiệu"
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
            <h5>Thiết lập tiêu đề</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('about_title','label'); ?></label>
                <input type="text" class="form-control" name="about_title" value="<?php echo getOption('about_title'); ?>" placeholder="<?php echo getOption('about_title','label'); ?>...">
                <?php echo form_errors('about_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);