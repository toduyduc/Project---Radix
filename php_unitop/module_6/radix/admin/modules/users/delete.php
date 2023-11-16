<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
   
    $userId = $body['id'];
    $userDetailRows = getRows("SELECT id FROM users WHERE id=$userId");
    if($userDetailRows>0){
        // thực hiện xóa
        $deleteToken = delete('login_token',"user_id=$userId");
        if($deleteToken){
            $deleteUser = delete('users',"id=$userId");
            if($deleteUser){
                setFlashData('msg','Xóa người dùng thành công');
                setFlashData('msg_type','success');
                
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
        }else{
            setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }else{
        setFlashData('msg','Người dùng không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=users');