<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thêm người nhận tin"
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

    // validate họ tên bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["fullname"]))){
        $errors["fullname"]["required"]="Họ tên không được để trống";
    }else{
        if(strlen(trim($body["fullname"]))<5){
            $errors["fullname"]["min"]="Họ tên phải >= 5 ký tự";
        }
    }

    // validate email : bắt buộc phải nhập,định dạng email, email duy nhất
    if(empty(trim($body["email"]))){
        $errors["email"]["required"]="Email bắt buộc phải nhập";

    }else{
        if(!isEmail(trim($body["email"]))){
            $errors["email"]["isEmail"]="Định dạng email không hợp lệ";
        }
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "fullname"=>trim($body["fullname"]),
            "email"=>trim($body["email"]),
            "status"=>trim($body["status"]),
            "create_at"=> date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('subscribe',$dataInsert);
        
        if($insertStatus){
            setFlashData("msg","Thêm mới người nhận tin thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=subscribe&action=lists');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=subscribe&action=add');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=subscribe&action=add'); // load lại trang nhóm người dùng
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
                <label for="">Trạng thái</label>
                <select name="status" class="form-control">
                    <option  value="0">Chưa duyệt</option>
                    <option  value="1">Đẵ duyệt</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('subscribe','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);