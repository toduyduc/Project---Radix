<?php
if(!defined("_INCODE")) die("unauthorized access...");


//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}


$body = getBody();
if(!empty($body)){
    $pageId = $body['id'];
    $pageDetailRows = getRows("SELECT id FROM `pages` WHERE id=$pageId");
    if($pageDetailRows>0){
            // thực hiện xóa
            $deletepage = delete('pages',"id=$pageId");
            if($deletepage){
                setFlashData('msg','Xóa trang thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
    }else{
        setFlashData('msg','trang không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=pages');