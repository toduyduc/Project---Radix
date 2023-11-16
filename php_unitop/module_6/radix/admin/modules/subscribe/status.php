<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Trạng thái đăng ký nhận tin"
];
$body = getBody();
if(!empty($body['id']) && isset($body['status'])){
    $dataUpdate=[];
    if($body['status']==1){
        $dataUpdate = [
            'status'=>1,
            'update_at'=>date('Y-m-d H:i:s')
        ];
    }else{
        $dataUpdate = [
            'status'=>0,
            'update_at'=>date('Y-m-d H:i:s')
        ];
    }
    $updateStatus=update('subscribe',$dataUpdate,'id='.$body['id']);
    if($updateStatus){
        if($body['status']==1){
            $msg='Duyệt';
        }else{
            $msg='Bỏ duyệt';
        }
        setFlashData("msg","$msg trạng thái thành công");
        setFlashData("msg_type","success");
    }else{
        setFlashData("msg","Cập nhật trạng thái không thành công");
        setFlashData("msg_type","danger");
    }
    redirect('admin/?module=subscribe');
    
}else{
    setFlashData("msg","Lỗi hệ thống");
    setFlashData("msg_type","danger");
    redirect('admin/?module=subscribe');
}