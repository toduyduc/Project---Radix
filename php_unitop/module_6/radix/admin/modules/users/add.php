<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thêm người dùng"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

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

    // validate nhóm người dùng: bắt buộc phải chọn nhóm
    if(empty(trim($body["group_id"]))){
        $errors["group_id"]["required"]="Vui lòng chọn nhóm người dùng";

    }

    // validate email : bắt buộc phải nhập,định dạng email, email duy nhất
    if(empty(trim($body["email"]))){
        $errors["email"]["required"]="Email bắt buộc phải nhập";

    }else{
        if(!isEmail(trim($body["email"]))){
            $errors["email"]["isEmail"]="Định dạng email không hợp lệ";
        }else{
            $email = trim($body["email"]);
            $sql = "SELECT * FROM users WHERE email = '$email'";
            if(getRows($sql)>0){  // kiểm tra trong database đã tồn tại email hay chưa
                $errors["email"]["unique"] = "Địa chỉ email đã tồn tại";
            }
        }
    }


    // validate password : bắt buộc phải nhập, <= 8 ký tự
    if(empty(trim($body["password"]))){
        $errors["password"]["required"]="Mật khẩu không được để trống";

    }else{
        if(strlen(trim($body["password"]))<8){
            $errors["password"]["min"]="Mật khẩu không được dới 8 ký tự";
        }
    }

    // confirm_password : bắt buộc phải nhập , phải giống password
    if(empty(trim($body["confirm_password"]))){
        $errors["confirm_password"]["required"]="Xác nhận mật khẩu không được để trống";
    }else{
        $password = trim($body["password"]);
        $confirm_password = trim($body["confirm_password"]);
        if($confirm_password != $password){
            $errors["confirm_password"]["match"]="Xác nhận mật khẩu không khớp";
        }
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "email"=>$body["email"],
            "fullname"=>$body["fullname"],
            "group_id"=>$body["group_id"],
            "password"=> password_hash($body["password"],PASSWORD_DEFAULT),
            "status"=>$body["status"],
            "create_at"=> date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('users',$dataInsert);
        
        if($insertStatus){
            setFlashData("msg","Thêm mới người dùng thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=users');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=users&action=add');
        }
        
    }else{
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=users&action=add');
    }
}
// lấy danh sách nhóm
$allGroups = getData("SELECT id,`name` FROM groups ORDER BY `name`");
// echo '<pre>';
// print_r($allGroups);
// echo '</pre>';

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
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Họ tên</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo old('fullname',$old); ?>" placeholder="Họ tên...">
                    <?php echo form_errors('fullname',$errors,'<span class="errors">','</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Nhóm người dùng</label>
                    <select name="group_id" class="form-control">
                        <option value="">Chọn nhóm người dùng</option>
                        <?php
                        if(!empty($allGroups)){
                            foreach($allGroups as $item){
                            ?>
                                <option <?php echo (old('group_id',$old)==$item['id'])?'selected':false; ?> value="<?php echo $item['id'];?>"><?php echo $item['name']; ?></option>
                            <?php
                            }
                        }
                        ?>
                        
                    </select>
                    <?php echo form_errors('group_id',$errors,'<span class="errors">','</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo old('email',$old); ?>" placeholder="Email...">
                    <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu...">
                        <?php echo form_errors('password',$errors,'<span class="errors">','</span>'); ?>
                </div>
                <div class="form-group">
                        <label for="">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu...">
                        <?php echo form_errors('confirm_password',$errors,'<span class="errors">','</span>'); ?>
                </div>
                <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option <?php echo (old('status',$old)==0)?'selected':false; ?> value="0">Chưa kích hoạt</option>
                            <option <?php echo (old('status',$old)==1)?'selected':false; ?> value="1">Đã kích hoạt</option>
                        </select>
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('users','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);