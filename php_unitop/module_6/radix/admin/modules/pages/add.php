<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thêm trang"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

// lấy userId
$userId = isLogin()['user_id'];

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    // validate trang bắt buộc nhập
    if(empty(trim($body["title"]))){
        $errors["title"]["required"]="Tiêu đề trang bắt buộc phải nhập";
    }

    // validate slug bắt buộc nhập 
    if(empty(trim($body["slug"]))){
        $errors["slug"]["required"]="Đường dẫn tĩnh bắt buộc phải nhập";
    }

    //validate nội dung
    if(empty(trim($body["content"]))){
        $errors["content"]["required"]="Nội dung bắt buộc phải nhập";
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "title"=>trim($body["title"]),
            "slug"=>trim($body["slug"]),
            "content"=>trim($body["content"]),
            "user_id"=>$userId,
            "create_at"=> date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('pages',$dataInsert);
        
        if($insertStatus){
            setFlashData("msg","Thêm mới trang thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=pages&action=lists');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=pages&action=add');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=pages&action=add'); // load lại trang nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên trang</label>
                <input type="text" class="form-control slug" name="title" value="<?php echo old('title',$old); ?>" placeholder="Tên trang...">
                <?php echo form_errors('title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" value="<?php echo old('slug',$old); ?>" placeholder="Đường dẫn tĩnh...">
                <?php echo form_errors('slug',$errors,'<span class="errors">','</span>'); ?>
                <p class="render-link"><b>Link:</b> <span></span></p>
            </div>
           
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" ><?php echo old('content',$old); ?></textarea>
                <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('pages','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);