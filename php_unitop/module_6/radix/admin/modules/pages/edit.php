<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}


$data = [
    "pageTitle"=>"Cập nhật dữ liệu trang người dùng"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

//lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])){
    $pageId = $body['id'];
    //kiểm tra userId có tồn tại trong database hay không
    //nếu tồn tại => lấy ra thông tin 
    // nếu không tồn tại => chuyển hướng về trang list
    $pagesDetail = firstRow("SELECT * FROM `pages` WHERE id = $pageId");
    if(!empty($pagesDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('pagesDetail',$pagesDetail);
    }else{
        redirect('admin/?module=pages');
    }
}else{
    redirect('admin/?module=pages');
}

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
        $dataUpdate = [
           "title"=>trim($body["title"]),
            "slug"=>trim($body["slug"]),
            "content"=>trim($body["content"]),
            "update_at" => date('Y-m-d H:i:s')
        ];
        $condition = "id=$pageId";
        $updateStatus = update('pages',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa trang thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=pages');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=pages');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=pages&action=edit&id='.$pageId.''); // load lại trang nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$pagesDetail = getFlashData("pagesDetail");
if(!empty($pagesDetail)){
    $old = $pagesDetail;
}
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
            <button type="submit" class="btn btn-primary">Cập nhật trang</button>
            
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);