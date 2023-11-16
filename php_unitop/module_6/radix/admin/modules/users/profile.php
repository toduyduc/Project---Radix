<?php
$data = [
    "pageTitle"=>"Cập nhật thông tin cá nhân"
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
    redirect('admin/?module=users&action=profile');
}

//xử lý cập nhật thông tin cá nhân
if(isPost()){
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    // validate họ tên bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["fullname"]))){
        $errors["fullname"]["required"]="Họ tên không được để trống !";
    }else{
        if(strlen(trim($body["fullname"]))<5){
            $errors["fullname"]["min"]="Họ tên phải >= 5 ký tự !";
        }

    }

    // validate email : bắt buộc phải nhập,định dạng email, email duy nhất
    if(empty(trim($body["email"]))){
        $errors["email"]["required"]="Email bắt buộc phải nhập !";

    }else{
        if(!isEmail(trim($body["email"]))){
            $errors["email"]["isEmail"]="Định dạng email không hợp lệ !";
        }else{
            $email = trim($body["email"]);
            $sql = "SELECT * FROM users WHERE email = '$email' AND id<>$userId";
            if(getRows($sql)>0){  // kiểm tra trong database đã tồn tại email hay chưa
                $errors["email"]["unique"] = "Địa chỉ email đã tồn tại";
            }
        }
    }

    if(empty($errors)){
        $dataUpade = [
            "email"=>$body["email"],
            "fullname"=>$body["fullname"],
            "contact_facebook"=>$body["contact_facebook"],
            "contact_twitter"=>$body["contact_twitter"],
            "contact_linkedin"=>$body["contact_linkedin"],
            "contact_pinterest"=>$body["contact_pinterest"],
            "about_content"=>$body["about_content"],
            "update_at"=> date('Y-m-d H:i:s')
        ];

        $condition = "id=$userId";
        $updateStatus = update('users',$dataUpade,$condition);
        if($updateStatus){
            setFlashData("msg","Cập nhật thông tin thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=users&action=profile');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
        }
    }else{
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        
    }
    //redirect('admin/?module=users&action=profile');
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$userDetail = getFlashData("userDetail");
if(!empty($userDetail && empty($old))){
    $old = $userDetail;
}
?>

    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <form action="" method="post">
        <?php
                    getMsg($msg,$msg_type);   // gọi hàm getMsg()
                ?>
            <div class="row">
                
                <div class="col-6">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Họ và tên..." value="<?php  echo old('fullname',$old); ?>">
                    <?php echo form_errors('fullname',$errors,'<span class="errors">','</span>'); ?>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email..." value="<?php  echo old('email',$old); ?>">
                    <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="">Facebook</label>
                    <input type="text" class="form-control" name="contact_facebook" placeholder="facebook..." value="<?php  echo old('contact_facebook',$old); ?>">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" class="form-control" name="contact_twitter" placeholder="twitter..." value="<?php  echo old('contact_twitter',$old); ?>">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="">Linkedin</label>
                    <input type="text" class="form-control" name="contact_linkedin" placeholder="linkedin..." value="<?php  echo old('contact_linkedin',$old); ?>">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label for="">Pinterest</label>
                    <input type="text" class="form-control" name="contact_pinterest" placeholder="Pinterest..." value="<?php  echo old('contact_pinterest',$old); ?>">
                </div>
                </div>
                <div class="col-12">
                <div class="form-group">
                    <label for="">Nội dung giới thiệu</label>
                    <textarea name="about_content" class="form-control" placeholder="Nội dung giới thiệu..." ><?php  echo old('about_content',$old); ?></textarea>
                </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);