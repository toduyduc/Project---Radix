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
    $serviceDetail = firstRow("SELECT * FROM `services` WHERE id=$serviceId");
    if(!empty($serviceDetail)){
        // loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $serviceDetail['create_at']=date('Y-m-d H:i:s');
        unset($serviceDetail['update_at']);
        unset($serviceDetail['id']);
        $duplicate = $serviceDetail['duplicate'];
        $duplicate++;
        $name = $serviceDetail['name'].'('.$duplicate.')';
        $serviceDetail['name']=$name;
        $insertStatus = insert('services',$serviceDetail); 
        if($insertStatus){
            setFlashData("msg","Nhân bản dịch vụ thành công");
            setFlashData("msg_type","success");
            update(
                'services',
                ['duplicate'=>$duplicate],
                "id=$serviceId"
            );
            redirect('admin/?module=services');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=services');
        }
    }else{
        setFlashData('msg','Dịch vụ không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=lists');