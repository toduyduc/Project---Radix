<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Cập nhật bình luận"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

// lấy userId
$userId = isLogin()['user_id'];

$body = getBody('get');
if(!empty($body['id'])){
    $commentId = $body['id'];
    $commentDetail = firstRow("SELECT comments.*,blog.title,users.fullname,users.email as user_email,`groups`.name as group_name FROM comments JOIN blog ON comments.blog_id=blog.id LEFT JOIN users ON comments.user_id=users.id LEFT JOIN `groups` ON users.group_id=`groups`.id WHERE comments.id = $commentId");
    // echo '<pre>'.print_r($commentDetail).'</pre>';
    if(!empty($commentDetail)){
        // nếu tồn tại thì gán giá trị $commentDetail vào flashData
        setFlashData('commentDetail',$commentDetail);
    }else{
        redirect('admin/?module=comments');
    }
}else{
    redirect('admin/?module=comments');
}

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    if(empty($commentDetail['user_id'])){
        // validate họ tên bắt buộc nhập
        if(empty(trim($body["name"]))){
            $errors["name"]["required"]="Họ tên bắt buộc phải nhập";
        }

        // validate email bắt buộc nhập 
        if(empty(trim($body["email"]))){
            $errors["email"]["required"]="Email bắt buộc phải nhập";
        }else{
            if(!isEmail(trim($body["email"]))){
                $errors["email"]["isEmail"]="Định dạng email không hợp lệ";
            }
        }
    }
    

    //validate nội dung
    if(empty(trim($body["content"]))){
        $errors["content"]["required"]="Nội dung bắt buộc phải nhập";
    }

    

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
            "content"=>trim($body["content"]),
            "status"=>$body["status"],
            "update_at"=> date('Y-m-d H:i:s')
        ];
        if(empty($commentDetail['user_id'])){
            $dataUpdate['name']=trim($body["name"]);
            $dataUpdate['email']=trim($body["email"]);
            $dataUpdate['website']=trim($body["website"]);
        }
        $condition = "id=$commentId";
        $updateStatus = update('comments',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa bình luận thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=comments');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=comments');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=comments&action=edit&id='.$commentId); // load lại blog nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$commentDetail = getFlashData("commentDetail");
if(!empty($commentDetail)){
    $old = $commentDetail;
}

?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <p><strong>Bình luận từ bài viết:</strong> <a target="_blank" href="<?php echo _WEB_HOST_ROOT.'/?module=blogs&action=detail&id='.old('blog_id',$old);; ?>"><?php echo old('title',$old); ?></a></p>
            <?php if(empty($commentDetail['user_id'])): ?>
            <h4>Thông tin cá nhân</h4>
            <div class="form-group">
                <label for="">Họ tên</label>
                <input type="text" class="form-control slug" name="name" value="<?php echo old('name',$old); ?>" placeholder="Họ tên...">
                <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control slug" name="email" value="<?php echo old('email',$old); ?>" placeholder="Email...">
                <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Website</label>
                <input type="text" class="form-control slug" name="website" value="<?php echo old('website',$old); ?>" placeholder="Website...">
            </div>
            <?php else:?>
            <h4>Thông tin người dùng</h4>
            <p><strong>- Họ tên:</strong> <?php echo $commentDetail['fullname']; ?></p>
            <p><strong>- Email:</strong> <?php echo $commentDetail['user_email']; ?></p>
            <p><strong>- Nhóm:</strong> <?php echo $commentDetail['group_name']; ?></p>
            <?php $commentReply=getComment($commentDetail['parent_id']); ?>
            <p><strong>- Trả lời:</strong> <?php echo (!empty($commentReply['name']))?$commentReply['name']:false; ?></p>
            <?php endif; ?>
            <h4>Chi tiết bình luận</h4>
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea rows="10" name="content" class="form-control" placeholder="Nhập nội dung..."><?php echo old('content',$old); ?></textarea>
                <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="">Chọn trạng thái</option>
                    <option value="1" <?php echo (old('status',$old)==1)?'selected':false; ?>>Đẵ duyệt</option>
                    <option value="0" <?php echo (old('status',$old)==0)?'selected':false; ?>>Chưa duyệt</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Cập nhật</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('comments','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);