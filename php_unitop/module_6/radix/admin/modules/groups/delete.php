<?php
if(!defined("_INCODE")) die("unauthorized access...");

$body = getBody();
if(!empty($body)){
    $groupId = $body['id'];
    $userDetailRows = getRows("SELECT id FROM `groups` WHERE id=$groupId");
    if($userDetailRows>0){
        $userNum = getRows("SELECT id FROM `users` WHERE group_id=$groupId"); // kiểm tra trong bảng users còn người dùng không
        if($userNum>0){
            setFlashData('msg','Trong nhóm vẫn còn '.$userNum.' người dùng');
            setFlashData('msg_type','danger');
        }else{
            // thực hiện xóa
            $deleteGroup = delete('groups',"id=$groupId");
            if($deleteGroup){
                setFlashData('msg','Xóa nhóm người dùng thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
        }
    }else{
        setFlashData('msg','Nhóm người dùng không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=groups');