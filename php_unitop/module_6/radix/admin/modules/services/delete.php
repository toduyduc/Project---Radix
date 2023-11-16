<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $serviceId = $body['id'];
    $serviceDetailRows = getRows("SELECT id FROM `services` WHERE id=$serviceId");
    if($serviceDetailRows>0){
            // thực hiện xóa
            $deleteService = delete('services',"id=$serviceId");
            if($deleteService){
                setFlashData('msg','Xóa dịch vụ thành công');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type','danger');
            }
    }else{
        setFlashData('msg','Dịch vụ không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=services');