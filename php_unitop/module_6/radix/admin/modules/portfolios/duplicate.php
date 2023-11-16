<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $portfolioId = $body['id'];
    $portfolioDetail = firstRow("SELECT * FROM `portfolios` WHERE id=$portfolioId");
    if(!empty($portfolioDetail)){
        // loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $portfolioDetail['create_at']=date('Y-m-d H:i:s');
        unset($portfolioDetail['update_at']);
        unset($portfolioDetail['id']);
        $duplicate = $portfolioDetail['duplicate'];
        $duplicate++;
        $name = $portfolioDetail['name'].'('.$duplicate.')';
        $portfolioDetail['name']=$name;
        $insertStatus = insert('portfolios',$portfolioDetail); 
        if($insertStatus){
            setFlashData("msg","Nhân bản dự án thành công");
            setFlashData("msg_type","success");
            update(
                'portfolios',
                ['duplicate'=>$duplicate],
                "id=$portfolioId"
            );
            redirect('admin/?module=portfolios');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=portfolios');
        }
    }else{
        setFlashData('msg','Dự án không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=portfolios');