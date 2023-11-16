<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}


$body = getBody();
if(!empty($body)){
    $pageId = $body['id'];
    $pageDetail = firstRow("SELECT * FROM `pages` WHERE id=$pageId");
    if(!empty($pageDetail)){
        // loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $pageDetail['create_at']=date('Y-m-d H:i:s');
        unset($pageDetail['update_at']);
        unset($pageDetail['id']);
        $duplicate = $pageDetail['duplicate'];
        $duplicate++;
        $title = $pageDetail['title'].'('.$duplicate.')';
        $pageDetail['title']=$title;
        $insertStatus = insert('pages',$pageDetail); 
        if($insertStatus){
            setFlashData("msg","Nhân bản trang thành công");
            setFlashData("msg_type","success");
            update(
                'pages',
                ['duplicate'=>$duplicate],
                "id=$pageId"
            );
            redirect('admin/?module=pages');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=pages');
        }
    }else{
        setFlashData('msg','trang không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=pages');