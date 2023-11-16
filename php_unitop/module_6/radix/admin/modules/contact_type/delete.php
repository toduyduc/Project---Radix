<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $contactTypeId = $body['id'];
    $userDetailRows = getRows("SELECT id FROM `contact_type` WHERE id=$contactTypeId");
    if($userDetailRows>0){
        // kiểm tra bảng contacts có dữ liệu không
        $contactsNum = getRows("SELECT id FROM `contacts` WHERE type_id=$contactTypeId"); // kiểm tra trong bảng users còn người dùng không
        if($contactsNum>0){
            setFlashData('msg','Trong phòng ban còn có'.$contactsNum.' liên hệ');
            setFlashData('msg_type','danger');
        }else{
            // thực hiện xóa
            $deletecontactType = delete('contact_type',"id=$contactTypeId");
            if($deletecontactType){
                setFlashData('msg','Xóa phòng ban thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
        }
    }else{
        setFlashData('msg','Phòng ban không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=contact_type');