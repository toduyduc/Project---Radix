<?php
$data = [
    "pageTitle"=>"Đổi mật khẩu"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

$userId = isLogin()['user_id'];
$userDetail = firstRow("SELECT * FROM users WHERE id=$userId");
if(!empty($userDetail)){
    // nếu tồn tại thì gán giá trị $userDetail vào flashData
    setFlashData('userDetail',$userDetail);
}else{
    redirect('admin/?module=users&action=change_password');
}

//xử lý cập nhật thông tin cá nhân
if(isPost()){
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    // validate mật khẩu bắt buộc nhập, và phải trùng với mật khẩu trong database
    if(empty(trim($body["old_password"]))){
        $errors["old_password"]["required"]="Vui lòng nhập mật khẩu cũ !";
    }else{
        $oldPassword = trim($body["old_password"]);
        $hashPassword = $userDetail["password"];
        if(!password_verify($oldPassword,$hashPassword)){
            $errors["old_password"]["match"]='Mật khẩu cũ không chính xác !';
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
        $errors["confirm_password"]["required"]="Xác nhận mật khẩu mới không được để trống";
    }else{
        $password = trim($body["password"]);
        $confirm_password = trim($body["confirm_password"]);
        if($confirm_password != $password){
            $errors["confirm_password"]["match"]="Xác nhận mật khẩu mới không khớp";
        }
    }

    if(empty($errors)){
        $dataUpade = [
            "password"=>password_hash($body["password"],PASSWORD_DEFAULT),
            "update_at"=> date('Y-m-d H:i:s')
        ];

        $condition = "id=$userId";
        $updateStatus = update('users',$dataUpade,$condition);
        if($updateStatus){
            // thực hiện gửi email khi đổi mật khẩu thành công
            $email = $userDetail['email'];
            $subject = 'THONG BAO DOI MAT KHAU THANH CONG';
            $content = "Chúc mừng bạn đã đổi mật khẩu thành công. Hiện tại bạn có thể đăng nhập với mật khẩu mới<br>";
            $content.="Nếu không phải bạn vui lòng liên hệ với chúng tôi<br>";
            $content.='Trân trọng !';
            $statusSendmail = sendMail($email,$subject,$content);
            if($statusSendmail){
                setFlashData("msg","Đổi mật khẩu thành công. Bạn có thể đăng nhập ngay bây giờ");
                setFlashData("msg_type","success");
                redirect('admin/?module=auth&action=logout');
            }else{
                setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
                setFlashData("msg_type","danger");
            }
            
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
        }
    }else{
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
       
    }
    redirect('admin/?module=users&action=change_password');
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");

?>

    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <form action="" method="post">
                <?php
                    getMsg($msg,$msg_type);   // gọi hàm getMsg()
                ?>
           
                <div class="form-group">
                    <label for="">Mật khẩu cũ</label>
                    <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu cũ...">
                    <?php echo form_errors('old_password',$errors,'<span class="errors">','</span>'); ?>
                </div>

                <div class="form-group">
                    <label for="">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới...">
                    <?php echo form_errors('password',$errors,'<span class="errors">','</span>'); ?>
                </div>

                <div class="form-group">
                    <label for="">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Xác nhận mật khẩu mới...">
                    <?php echo form_errors('confirm_password',$errors,'<span class="errors">','</span>'); ?>
                </div>
               
            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
        </form>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);