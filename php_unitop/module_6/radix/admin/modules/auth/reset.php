<?php
if(!defined("_INCODE")) die("unauthorized access...");

$data = [
    "pageTitle"=>"Đặt lại mật khẩu"
];
layout('header-login','admin');
echo '<div class="container"><br>';
$token = getBody()['token']; // lấy mã thông báo
if(!empty($token)){
    $tokenQuery = firstRow("SELECT id,fullname,email FROM users WHERE forget_token='$token'"); // lấy phần tử có mã token trùng với activeToken trong database
    if(!empty($tokenQuery)){
        $user_id = $tokenQuery["id"];
        $email = $tokenQuery["email"];

        if(isPost()){
            $body = getBody();
            $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
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
            if(empty($errors)){
                // xử lý mật khẩu
                 $passwordHash= password_hash($body["password"],PASSWORD_DEFAULT);
                $dataUpdate = [
                    "password" => $passwordHash,
                    "forget_token"=> null,
                    "update_at" => date('Y-m-d H:i:s')
                ];
                $updateStatus = update('users',$dataUpdate,"id = $user_id");
                if($updateStatus){
                    setFlashData("msg","Đổi mật khẩu thành công");
                    setFlashData("msg_type","success");
                    // thực hiện gửi email khi đổi mật khẩu thành công
                    $subject = 'THONG BAO DOI MAT KHAU THANH CONG';
                    $content = "Chúc mừng bạn đã đổi mật khẩu thành công <br>";
                    $content.= "Đăng nhập tại:<br>";
                    $content.=_WEB_HOST_ROOT.'?module=auth&action=login <br>';
                    $content.='Trân trọng !';
                    sendMail($email,$subject,$content);
                    redirect("admin/?module=auth&action=login");
                }else{
                    setFlashData("msg","Lỗi hệ thống bạn không thể đổi mật khẩu lúc này, vui lòng thử lại sau");
                    setFlashData("msg_type","danger");
                    redirect("?module=auth&action=login");
                }
            }else{
                setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
                setFlashData("msg_type","danger");
                setFlashData("errors",$errors);
                redirect('?module=auth&action=reset&token='.$token);
            }
        }
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
        ?>
            <div class="row">
                <div class="col-6" style = "margin:20px auto; ">
                    <h2 class="text-center"><?php echo !empty($data["pageTitle"])?$data["pageTitle"]:"unicode"; ?></h2>
                    <?php 
                    echo '<div class="text-center"><br>';
                        getMsg($msg,$msg_type);
                    echo '</div>';
                    ?>
                    <form action= "" method="post">
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới">
                            <?php echo form_errors('password',$errors,'<span class="errors">','</span>').'<br>'; ?>
                            <label for="">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                            <?php echo form_errors('confirm_password',$errors,'<span class="errors">','</span>'); ?>
                        </div>
                            <button type="submit" class="btn btn-primary btn-block" style="width:100%; margin-top: 3%">Xác nhận</button>
                            <p class="text-center" style="margin-top:20px"><a href="?module=auth&action=login">Đăng nhập</a></p>
                            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
                            <input type="hidden" name="token" value="<?php echo $token; ?>"> 
                            <!--dòng ở trên dùng để tránh lỗi khi post dữ liệu (chi tiết bài 104) -->
                    </form>

                </div>

            </div>
        <?php
    }else{
        getMsg("Liên kết không tồn tại hoặc đã hết hạn","danger");
    }
}else{
    getMsg("Liên kết không tồn tại hoặc đã hết hạn","danger");
}
echo '</div>';
layout('header-footer','admin');