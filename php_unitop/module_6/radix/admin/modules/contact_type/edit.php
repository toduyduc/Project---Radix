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
    $contactTypeId = $body['id'];
    //kiểm tra userId có tồn tại trong database hay không
    //nếu tồn tại => lấy ra thông tin 
    // nếu không tồn tại => chuyển hướng về trang list
    $contactTypeDetail = firstRow("SELECT * FROM `contact_type` WHERE id = $contactTypeId");
    if(!empty($contactTypeDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('contactTypeDetail',$contactTypeDetail);
    }else{
        redirect('admin/?module=contact_type');
    }
}else{
    redirect('admin/?module=contact_type');
}

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
    // validate tên phòng ban bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tên phòng ban bắt buộc phải nhập";
    }else{
        if(strlen(trim($body["name"]))<4){
            $errors["name"]["min"]="Tên phòng ban phải >= 4 ký tự";
        }
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
            "name"=>trim($body["name"]),
            "update_at" => date('Y-m-d H:i:s')
        ];
        $condition = "id=$contactTypeId";
        $updateStatus = update('contact_type',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa phòng ban thành công");
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
        redirect('admin/?module=contact_type&action=lists&id='.$contactTypeId.'&view=edit'); // load lại trang phòng ban
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$contactTypeDetail = getFlashData("contactTypeDetail");
if(!empty($contactTypeDetail)){
    $old = $contactTypeDetail;
}
?>

<h4>Cập nhật phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên phòng ban</label>
        <input type="text" class="form-control" name="name" placeholder="Tên phòng ban..." value="<?php echo old('name',$old); ?>">
        <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
    </div>
    
    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>