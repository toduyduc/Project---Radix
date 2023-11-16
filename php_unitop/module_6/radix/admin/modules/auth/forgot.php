<?php
if(!defined("_INCODE")) die("unauthorized access...");

$data = [
    "pageTitle"=>"Quên mật khẩu"
];
layout("header-login",'admin',$data);
// kiểm tra trạng thái đăng nhập
if(isLogin()){
    redirect('?module=users');
}
// xử lý đăng nhập
if(isPost()){
    $body = getBody();
    if(!empty($body['email'])){
        $email = $body['email'];
        $queryUser = firstRow("SELECT id FROM users WHERE email = '$email'");
        if(!empty($queryUser)){
            $user_id = $queryUser['id'];

            // tạo forgotToken
            $forgotToken = sha1(uniqid().time());
            $dataUpdate=[
                'forget_token'=>$forgotToken
            ];
            $updateStatus = update("users",$dataUpdate,"id = $user_id");
            if($updateStatus){
                // tạo link khôi phục
                $linkReset = _WEB_HOST_ROOT_ADMIN.'?module=auth&action=reset&token='.$forgotToken.'';

                // thiết lập gửi mail
                $subject = "Yeu cau khoi phuc password";

                $content = 'chào bạn: '.$email.'<br>';
                $content.='Chúng tôi được yêu cầu khôi phục mật khẩu từ bạn. vui lòng click vào link sau để khôi phục: <br>';
                $content.=$linkReset.'<br>';
                $content.='trân trọng';
                
                // tiến hành gửi mail
                $sendStatus = sendMail($email,$subject,$content);
                if($sendStatus){
                    setFlashData("msg","vui long kiểm tra email để xem hướng dẫn đặt lại mật khẩu");
                    setFlashData("msg_type","success");
                }else{
                    setFlashData("msg","Lỗi hệ thống vui lòng thử lại sau");
                    setFlashData("msg_type","danger");
                }
            }
        }else{
            setFlashData("msg","Địa chỉ email không tồn tại trong hệ thống");
            setFlashData("msg_type","danger");
        }
    }else{
        setFlashData("msg","Bạn chưa nhập email");
        setFlashData("msg_type","danger");
    }
    redirect("admin/?module=auth&action=forgot");
}


$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
//require_once ""._WEB_PATH_TEMPLATES."/layouts/header-login.php";

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
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Địa chỉ email">
                
            </div>
                <button type="submit" class="btn btn-primary btn-block" style="width:100%; margin-top: 3%">Xác nhận</button>
                <p class="text-center" style="margin-top:20px"><a href="?module=auth&action=login">Login</a></p>
               
        </form>

    </div>

</div>
<?php
layout("footer-login",'admin');