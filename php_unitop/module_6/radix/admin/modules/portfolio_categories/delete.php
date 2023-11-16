<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $portfolio_categorieId = $body['id'];
    $userDetailRows = getRows("SELECT id FROM `portfolio_categories` WHERE id=$portfolio_categorieId");
    if($userDetailRows>0){
        // kiểm tra bảng portfolios có dự án không
        $portfoliosNum = getRows("SELECT id FROM `portfolios` WHERE portfolio_category_id=$portfolio_categorieId"); // kiểm tra trong bảng users còn người dùng không
        if($portfoliosNum>0){
            setFlashData('msg','Trong danh mục '.$portfoliosNum.' dự án');
            setFlashData('msg_type','danger');
        }else{
            // thực hiện xóa
            $deleteportfolio_categorie = delete('portfolio_categories',"id=$portfolio_categorieId");
            if($deleteportfolio_categorie){
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
redirect('admin/?module=portfolio_categories');