<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $portfolioId = $body['id'];
    $portfolioDetailRows = getRows("SELECT id FROM `portfolios` WHERE id=$portfolioId");
    if($portfolioDetailRows>0){
            // thực hiện xóa thư viện ảnh trong bảng portfolio_images
            delete('portfolio_images','portfolio_id='.$portfolioId);

            // thực hiện xóa
            $deleteportfolio = delete('portfolios',"id=$portfolioId");
            if($deleteportfolio){
                setFlashData('msg','Xóa dự án thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
    }else{
        setFlashData('msg','dự án không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=portfolios');