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
    $contactTypeDetail = firstRow("SELECT * FROM `contact_type` WHERE id=$contactTypeId");
    if(!empty($contactTypeDetail)){
        // loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $contactTypeDetail['create_at']=date('Y-m-d H:i:s');
        unset($contactTypeDetail['update_at']);
        unset($contactTypeDetail['id']);
        $duplicate = $contactTypeDetail['duplicate'];
        $duplicate++;
        $name = $contactTypeDetail['name'].'('.$duplicate.')';
        $contactTypeDetail['name']=$name;
        $insertStatus = insert('contact_type',$contactTypeDetail); 
        if($insertStatus){
            setFlashData("msg","Nhân bản phòng ban thành công");
            setFlashData("msg_type","success");
            update(
                'contact_type',
                ['duplicate'=>$duplicate],
                "id=$contactTypeId"
            );
            redirect('admin/?module=contact_type');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=contact_type');
        }
    }else{
        setFlashData('msg','phòng ban không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=contact_type');