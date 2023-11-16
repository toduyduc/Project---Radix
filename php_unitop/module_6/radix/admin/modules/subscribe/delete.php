<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $subscribeId = $body['id'];
    $subscribeDetailRows = getRows("SELECT id FROM subscribe WHERE id=$subscribeId");
    if($subscribeDetailRows>0){
            // thực hiện xóa
            $deleteSubscribe = delete('subscribe',"id=$subscribeId");
            if($deleteSubscribe){
                setFlashData('msg','Xóa người nhận tin thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
    }else{
        setFlashData('msg','Thông tin không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=subscribe');