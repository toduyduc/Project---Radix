<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Sửa liên hệ"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

$body = getBody('get');
if(!empty($body['id'])){
    $contactId = $body['id'];
    $contactDetail = firstRow("SELECT * FROM `contacts` WHERE id = $contactId");
    if(!empty($contactDetail)){
        // nếu tồn tại thì gán giá trị $contactDetail vào flashData
        setFlashData('contactDetail',$contactDetail);
    }else{
        redirect('admin/?module=contacts');
    }
}else{
    redirect('admin/?module=contacts');
}

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    // validate họ tên bắt buộc nhập
    if(empty(trim($body["fullname"]))){
        $errors["fullname"]["required"]="Họ tên bắt buộc phải nhập";
    }

    // validate email : bắt buộc phải nhập
    if(empty(trim($body["email"]))){
        $errors["email"]["required"]="Email bắt buộc phải nhập";
    }

    //validate nội dung
    if(empty(trim($body["message"]))){
        $errors["message"]["required"]="Nội dung bắt buộc phải nhập";
    }

    //validate phòng ban
    if(empty(trim($body["type_id"]))){
        $errors["type_id"]["required"]="Phòng ban bắt buộc phải chọn";
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
            "fullname"=>trim($body["fullname"]),
            "email"=>trim($body["email"]),
            "type_id"=>trim($body["type_id"]),
            "message"=>trim($body["message"]),
            "status"=>$body["status"],
            "note"=>trim($body["note"]),
            "update_at"=> date('Y-m-d H:i:s')
        ];
        $condition = "id=$contactId";
        $updateStatus = update('contacts',$dataUpdate,$condition);
        if($updateStatus){
            setFlashData("msg","Sửa liên hệ thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=contacts');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=contacts');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=contacts&action=edit&id='.$contactId); // load lại blog nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$contactDetail = getFlashData("contactDetail");
if(!empty($contactDetail)){
    $old = $contactDetail;
}
// câu lệnh truy vấn lấy  dữ liêu trong bảng contact_type (phòng ban)
$allContact_type = getData("SELECT id, `name` FROM contact_type ORDER BY `name`");
?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Họ tên</label>
                <input type="text" class="form-control" name="fullname" value="<?php echo old('fullname',$old); ?>" placeholder="Họ tên...">
                <?php echo form_errors('fullname',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo old('email',$old); ?>" placeholder="Email...">
                <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
            </div>
           
            <div class="form-group">
                <label for="">Nội dung</label>
                
                <?php echo form_errors('message',$errors,'<span class="errors">','</span>'); ?>
            </div><textarea rows="10" name="message" class="form-control" placeholder="Nhập nội dung..."><?php echo old('message',$old); ?></textarea>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="">Phòng ban</label>
                        <select name="type_id" class="form-control">
                            <option value="">Chọn phòng ban</option>
                            <?php
                                if(!empty($allContact_type)){
                                    foreach($allContact_type as $item){
                                    ?>
                                        <option <?php echo (old('type_id',$old)==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php
                                    }
                                }
                            ?>
                        </select>
                         <?php echo form_errors('type_id',$errors,'<span class="errors">','</span>'); ?>
                    </div>
                    <div class="col-6">
                        <label for="">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option <?php echo (old('status',$old)==0)?'selected':false; ?> value="0">Chưa xử lý</option>
                            <option <?php echo (old('status',$old)==1)?'selected':false; ?> value="1">Đã xử lý</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Ghi chú</label>
                <textarea rows="10" name="note" class="form-control" placeholder="Ghi chú..."><?php echo old('note',$old); ?></textarea>
               
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('contacts','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);