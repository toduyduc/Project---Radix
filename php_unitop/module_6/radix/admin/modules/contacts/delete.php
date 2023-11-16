<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $contactId = $body['id'];
    $contactDetailRows = getRows("SELECT id FROM `contacts` WHERE id=$contactId");
    if($contactDetailRows>0){
            // thực hiện xóa
            $deleteContact = delete('contacts',"id=$contactId");
            if($deleteContact){
                setFlashData('msg','Xóa liên hệ thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','Lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
    }else{
        setFlashData('msg','Liên hệ không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','Liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=contacts');