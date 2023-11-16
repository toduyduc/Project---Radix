<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $blogId = $body['id'];
    $blogDetailRows = getRows("SELECT id FROM `blog` WHERE id=$blogId");
    if($blogDetailRows>0){
            // thực hiện xóa
            $deleteblog = delete('blog',"id=$blogId");
            if($deleteblog){
                setFlashData('msg','Xóa blog thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
    }else{
        setFlashData('msg','blog không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=blog');