<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập header"
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
            <h5>Thiết lập tìm kiếm</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('header_search','label'); ?></label>
                <input type="text" class="form-control" name="header_search" value="<?php echo getOption('header_search'); ?>" placeholder="<?php echo getOption('header_search','label');?>...">
                <?php echo form_errors('header_search',$errors,'<span class="errors">','</span>'); ?>
            </div>
            
            <h5>Thiết lập khác</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('header_quote_text','label'); ?></label>
                <input type="text" class="form-control" name="header_quote_text" value="<?php echo getOption('header_quote_text'); ?>" placeholder="<?php echo getOption('header_quote_text','label');?>...">
                <?php echo form_errors('header_quote_text',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('header_quote_link','label'); ?></label>
                <input type="text" class="form-control" name="header_quote_link" value="<?php echo getOption('header_quote_link'); ?>" placeholder="<?php echo getOption('header_quote_link','label');?>...">
                <?php echo form_errors('header_quote_link',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('header_logo','label'); ?></label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="header_logo" value="<?php echo getOption('header_logo'); ?>" placeholder="<?php echo getOption('header_logo','label');?>...">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_errors('header_logo',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('header_favicon','label'); ?></label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="header_favicon" value="<?php echo getOption('header_favicon'); ?>" placeholder="<?php echo getOption('header_favicon','label');?>...">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_errors('header_favicon',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);