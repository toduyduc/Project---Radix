<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}


if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
    // validate phòng ban bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tên phòng ban bắt buộc phải nhập";
    }else{
        if(strlen(trim($body["name"]))<4){
            $errors["name"]["min"]="Tên phòng ban phải >= 4 ký tự";
        }
    }

    

    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "name"=>$body["name"],
            "create_at"=> date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('contact_type',$dataInsert);
        
        if($insertStatus){
            setFlashData("msg","Thêm mới phòng ban thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=contact_type');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=contact_type');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=contact_type'); // load lại trang nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
?>

<h4>Thêm phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên phòng ban</label>
        <input type="text" class="form-control" name="name" placeholder="Tên phòng ban..." value="<?php echo old('name',$old); ?>">
        <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
    </div>
    
    <button class="btn btn-primary" type="submit">Thêm mới</button>
    <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('blog_categories','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
</form>