<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Cập nhật dữ liệu dịch vụ người dùng"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

//lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])){
    $serviceId = $body['id'];
    //kiểm tra userId có tồn tại trong database hay không
    //nếu tồn tại => lấy ra thông tin 
    // nếu không tồn tại => chuyển hướng về trang list
    $servicesDetail = firstRow("SELECT * FROM `services` WHERE id = $serviceId");
    if(!empty($servicesDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('servicesDetail',$servicesDetail);
    }else{
        redirect('admin/?module=services');
    }
}else{
    redirect('admin/?module=services');
}

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    // validate dịch vụ bắt buộc nhập
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tên dịch vụ bắt buộc phải nhập";
    }

    // validate slug bắt buộc nhập 
    if(empty(trim($body["slug"]))){
        $errors["slug"]["required"]="Đường dẫn tĩnh bắt buộc phải nhập";
    }

    // validate icon bắt buộc nhập 
    if(empty(trim($body["icon"]))){
        $errors["icon"]["required"]="Icon bắt buộc phải nhập";
    }

    //validate nội dung
    if(empty(trim($body["content"]))){
        $errors["content"]["required"]="Nội dung bắt buộc phải nhập";
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
           "name"=>trim($body["name"]),
            "slug"=>trim($body["slug"]),
            "icon"=>trim($body["icon"]),
            "description"=>trim($body["description"]),
            "content"=>trim($body["content"]),
            "update_at" => date('Y-m-d H:i:s')
        ];
        $condition = "id=$serviceId";
        $updateStatus = update('services',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa dịch vụ thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=services&action=lists');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=services&action=lists');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=services&action=edit&id='.$serviceId.''); // load lại trang nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$servicesDetail = getFlashData("servicesDetail");
if(!empty($servicesDetail)){
    $old = $servicesDetail;
}
?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên dịch vụ</label>
                <input type="text" class="form-control slug" name="name" value="<?php echo old('name',$old); ?>" placeholder="Tên dịch vụ...">
                <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" value="<?php echo old('slug',$old); ?>" placeholder="Đường dẫn tĩnh...">
                <?php echo form_errors('slug',$errors,'<span class="errors">','</span>'); ?>
                <p class="render-link"><b>Link:</b> <span></span></p>
            </div>
            <div class="form-group">
                <label for="">Icon</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="icon" value="<?php echo old('icon',$old); ?>" placeholder="Đường dẫn ảnh hoặc mã icon...">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_errors('icon',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Mô tả ngắn</label>
                <textarea name="description" class="form-control editor" placeholder="Mô tả ngắn..."><?php echo old('description',$old); ?></textarea>
                <?php echo form_errors('description',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" ><?php echo old('content',$old); ?></textarea>
                <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật dịch vụ</button>
            
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);