<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

//lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])){
    $blog_categorieId = $body['id'];
    //kiểm tra userId có tồn tại trong database hay không
    //nếu tồn tại => lấy ra thông tin 
    // nếu không tồn tại => chuyển hướng về trang list
    $blog_categorieDetail = firstRow("SELECT * FROM `blog_categories` WHERE id = $blog_categorieId");
    if(!empty($blog_categorieDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('blog_categorieDetail',$blog_categorieDetail);
    }else{
        redirect('admin/?module=blog_categories');
    }
}else{
    redirect('admin/?module=blog_categories');
}

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
    // validate tên danh mục bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tên danh mục bắt buộc phải nhập";
    }else{
        if(strlen(trim($body["name"]))<4){
            $errors["name"]["min"]="Tên danh mục phải >= 4 ký tự";
        }
    }

    //validate slug
    if(empty(trim($body["slug"]))){
        $errors["slug"]["required"]="Đường dân tĩnh bắt buộc phải nhập";
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
            "name"=>trim($body["name"]),
            "slug"=>trim($body["slug"]),
            "update_at" => date('Y-m-d H:i:s')
        ];
        $condition = "id=$blog_categorieId";
        $updateStatus = update('blog_categories',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa danh mục thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=blog_categories');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=blog_categories');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=blog_categories&action=lists&id='.$blog_categorieId.'&view=edit'); // load lại trang danh mục
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$blog_categorieDetail = getFlashData("blog_categorieDetail");
if(!empty($blog_categorieDetail)){
    $old = $blog_categorieDetail;
}
?>

<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control slug" name="name" placeholder="Tên danh mục..." value="<?php echo old('name',$old); ?>">
        <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
    </div>
    <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug',$old); ?>">
        <?php echo form_errors('slug',$errors,'<span class="errors">','</span>'); ?>
        <p class="render-link"><b>Link:</b> <span></span></p>
    </div>
    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>