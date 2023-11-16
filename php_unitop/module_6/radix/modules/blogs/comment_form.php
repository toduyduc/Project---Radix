<?php
if(!empty(getBody('get')['comment_id'])){
    $commentId = getBody('get')['comment_id'];
    $commentName= firstRow("SELECT name FROM comments WHERE id = $commentId");
}
if(!empty(isLogin()['user_id'])){
    $userId = isLogin()['user_id'];
}
if(isPost()){
   
        $body = getBody();
        $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
        if(empty($userId)){
            // validate họ tên bắt buộc nhập, và phải >=5 ký tự
            if(empty(trim($body["name"]))){
                $errors["name"]["required"]="Họ tên không được để trống";
            }else{
                if(strlen(trim($body["name"]))<5){
                    $errors["name"]["min"]="Họ tên phải >= 5 ký tự";
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

        }
        // validate comment bắt buộc nhập, và phải >=5 ký tự
        if(empty(trim($body["content"]))){
            $errors["content"]["required"]="Vui lòng nhập bình luận";
        }else{
            if(strlen(trim($body["content"]))<10){
                $errors["content"]["min"]="Bình luận phải >= 10 ký tự";
            }
        }

        $linkBlog = getLinkModule('blog',$id).'#comment-form';

        if(empty($errors)){ // không có lỗi xảy ra
            if(empty($userId)){
                // lưu tất cả thông tin vào cookie
                $commentInfo=[
                    "name"=>trim(strip_tags($body["name"])),
                    "email"=>trim(strip_tags($body["email"])),
                    "website"=>trim(strip_tags($body["website"]))
                ];
                setcookie('commentInfo',json_encode($commentInfo),time()+86400*365);
            }

            $dataInsert = [
                "content"=>trim(strip_tags($body["content"])),
                "parent_id"=>0,
                "blog_id"=>$id,
                "user_id"=>(!empty($userId))?$userId:NULL,
                "status"=>0,
                "create_at"=>date('Y-m-d H:i:s')
            ];
            
            if(empty($userId)){
                $dataInsert["name"]=trim(strip_tags($body["name"]));
                $dataInsert["email"]=trim(strip_tags($body["email"]));
                $dataInsert["website"]=trim(strip_tags($body["website"]));
            }

            if(!empty($commentId)){
                $dataInsert['parent_id']=$commentId;
                $dataInsert['status']=1;//bỏ duyệt khi trả lời
            }
            // echo '<pre>';
            // print_r($dataInsert);
            // echo '</pre>';
            
            //echo $linkBlog;
            $insertStatus = insert('comments',$dataInsert);
            if($insertStatus){
                if(!empty($commentId)){
                    setFlashData("msg","Đã trả lời bình luận của ".$commentName['name']);
                }else{
                    setFlashData("msg","Gửi bình luận thành công, quản trị viên sẽ duyệt bình luận của bạn trong thời gian sớm nhất");
                }
                
                setFlashData("msg_type","success");
                //redirect('?module=blogs&action=detail&id='.$id.'');
                redirect($linkBlog,true);
            }else{
                setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
                setFlashData("msg_type","danger");
                redirect($linkBlog,true);
            }
            redirect($linkBlog,true);
        }else{
            setFlashData("msg","vui lòng kiểm tra nội dung nhập vào !");
            setFlashData("msg_type","danger");
            setFlashData("errors",$errors);
            setFlashData("old",$body);
            // if(!empty($commentId)){
            //     redirect('?module=blogs&action=detail&id='.$id.'&comment_id='.$commentId);
            // }else{
            //     redirect($linkBlog,true);
            // }
            
        }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");

$commentInfo = [];
if(!empty($_COOKIE['commentInfo'])){
    $commentInfo = json_decode($_COOKIE['commentInfo'],true);
}

if(!empty($commentInfo)){
    $old = $commentInfo;
}else{
    $old = getFlashData("old");
}

?>
<div class="comments-form" id="comment-form">
    <h2 class="title"><?php echo (!empty($commentName['name']))?'Viết trả lời bình luận: '.$commentName['name'].'<a href="'._WEB_HOST_ROOT.'/?module=blogs&action=detail&id='.$id.'"> <i class="fa fa-window-close"></i> Hủy</a>':'Viết bình luận'; ?></h2>
    <?php
        // check admin login
        if(!empty($userId)){
            $userName = firstRow("SELECT fullname FROM users WHERE id=$userId");
            // echo '<pre>';
            // print_r($userName);
            // echo '</pre>';
            echo '<p>Bạn đang đăng nhập với tài khoản:<b> '.$userName['fullname'].'</b> - <a href="'._WEB_HOST_ROOT_ADMIN.'/?module=auth&action=logout">Đăng xuất</a></p>';
        }
        getMsg($msg,$msg_type);   // gọi hàm getMsg()
    ?>
    <!-- Contact Form -->
    <form class="form" method="post" action="">
        <div class="row">
            <?php if(empty($userId)): ?>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="text" name="name" value="<?php echo old('name',$old); ?>" placeholder="Họ và tên..." >
                    <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="text" name="email" value="<?php echo old('email',$old); ?>" placeholder="Email của bạn..." >
                    <?php echo form_errors('email',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="form-group">
                    <input type="url" name="website" value="<?php echo old('website',$old); ?>" placeholder="Website của bạn..." >
                </div>
            </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="content" rows="5" placeholder="Viết bình luận của bạn..." ><?php echo old('content',$old); ?></textarea>
                    <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group button">	
                    <button type="submit" class="btn primary">Gửi bình luận</button>
                </div>
            </div>
        </div>
    </form>
    <!--/ End Contact Form -->
</div>