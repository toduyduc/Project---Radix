<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thiết lập blog"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
if(isPost()){
    $allFields = getBody();
    if(!empty($allFields['blog_title'])){
        $data = [
            'blog_title'=>$allFields['blog_title'],
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
            <h5>Thiết lập blog</h5>
            <hr>
            <div class="form-group">
                <label for=""><?php echo getOption('blog_title','label'); ?></label>
                <input type="text" class="form-control" name="blog_title" value="<?php echo getOption('blog_title'); ?>" placeholder="<?php echo getOption('blog_title','label'); ?>...">
                <?php echo form_errors('blog_title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for=""><?php echo getOption('blog_per_page','label'); ?></label>
                <input type="number" class="form-control" name="blog_per_page" value="<?php echo getOption('blog_per_page'); ?>" placeholder="<?php echo getOption('blog_per_page','label'); ?>...">
                <?php echo form_errors('blog_per_page',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
           
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);