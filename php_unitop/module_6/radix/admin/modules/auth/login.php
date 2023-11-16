<?php
if(!defined("_INCODE")) die("unauthorized access...");
//setSession('key','value');
$data = [
    "pageTitle"=>"Đăng nhập"
];
layout("header-login",'admin',$data);
// kiểm tra trạng thái đăng nhập
if(isLogin()){
    redirect('admin');
}
// xử lý đăng nhập
if(isPost()){
    $body = getBody();
    if(trim(!empty($body["email"])) && trim(!empty($body["password"]))){
        //kiểm tra đăng nhập
        $email = $body["email"];
        $password = $body["password"];

        // truy vấn thông tin user theo email
        $userQuery = firstRow("SELECT id,password FROM users WHERE email = '$email' AND status = '1'");
        if($userQuery){
            $userId = $userQuery["id"];
        }
        
        if(!empty($userQuery)){
            $passwordHash = $userQuery['password'];
            if(password_verify($password,$passwordHash)){ // so sánh mật khẩu nhập vào và mật khẩu đã được mã hóa trong sql có khớp không
                // tạo token login
                $tokenLogin = sha1(uniqid().time());
                // Insert dữ liệu vào bảng login_token
                $dataToken = [
                    "user_id" => $userId,
                    "token" => $tokenLogin,
                    "create_at" => date('Y-m-d H:i:s')
                ];

                $insertTokenStatus = insert('login_token',$dataToken);
                if($insertTokenStatus){
                    // Insert token thành công

                    // tạo session lưu token
                    setSession('loginToken',$tokenLogin);
                    //chuyển hướng qua trang quản lý user
                    redirect('admin');
                }else{
                    setFlashData("msg","Lỗi hệ thống, bạn không thể đăng nhập vào lúc này !");
                    setFlashData("msg_type","danger");
                    //redirect('?module=auth&action=login');
                }

            }else{
                setFlashData("msg","Mật khẩu không chính xác");
                setFlashData("msg_type","danger");
                setFlashData("old",$body);
            }
        }else{
            setFlashData("msg","Email không tồn tại trong hệ thống hoặc chưa được kích hoạt");
            setFlashData("msg_type","danger");
            //redirect('?module=auth&action=login');
        }
    }else{
        setFlashData("msg","vui lòng nhập email và mật khẩu");
        setFlashData("msg_type","danger");
        //redirect('?module=auth&action=login');
    }
    redirect('admin/?module=auth&action=login');
}

$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$old = getFlashData("old");
?>
<div class="row">
    <div class="col-6" style = "margin:20px auto; ">
        <h2 class="text-center">Đăng nhập</h2>
        <?php getMsg($msg,$msg_type); ?>
        <form action= "" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo old('email',$old); ?>" placeholder="Địa chỉ email">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
            </div>
                <button type="submit" class="btn btn-primary btn-block" style="width:100%; margin-top: 3%">Login</button>
                <p class="text-center" style="margin-top:20px"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
             
        </form>

    </div>

</div>
<?php
layout("footer-login",'admin');