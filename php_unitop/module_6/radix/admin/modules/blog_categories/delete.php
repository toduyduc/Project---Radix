<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $blog_categorieId = $body['id'];
    $userDetailRows = getRows("SELECT id FROM `blog_categories` WHERE id=$blog_categorieId");
    if($userDetailRows>0){
        // kiểm tra bảng blog có dự án không
        $portfoliosNum = getRows("SELECT id FROM `blog` WHERE category_id=$blog_categorieId"); // kiểm tra trong bảng users còn người dùng không
        if($portfoliosNum>0){
            setFlashData('msg','Trong danh mục '.$portfoliosNum.' dự án');
            setFlashData('msg_type','danger');
        }else{
            // thực hiện xóa
            $deleteblog_categorie = delete('blog_categories',"id=$blog_categorieId");
            if($deleteblog_categorie){
                setFlashData('msg','Xóa danh mục thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
        }
    }else{
        setFlashData('msg','danh mục không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=blog_categories');