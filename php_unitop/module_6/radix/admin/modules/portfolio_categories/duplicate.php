<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $portfolio_categorieId = $body['id'];
    $portfolio_categorieDetail = firstRow("SELECT * FROM `portfolio_categories` WHERE id=$portfolio_categorieId");
    if(!empty($portfolio_categorieDetail)){
        // loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $portfolio_categorieDetail['create_at']=date('Y-m-d H:i:s');
        unset($portfolio_categorieDetail['update_at']);
        unset($portfolio_categorieDetail['id']);
        $duplicate = $portfolio_categorieDetail['duplicate'];
        $duplicate++;
        $name = $portfolio_categorieDetail['name'].'('.$duplicate.')';
        $portfolio_categorieDetail['name']=$name;
        $insertStatus = insert('portfolio_categories',$portfolio_categorieDetail); 
        if($insertStatus){
            setFlashData("msg","Nhân bản trang thành công");
            setFlashData("msg_type","success");
            update(
                'portfolio_categories',
                ['duplicate'=>$duplicate],
                "id=$portfolio_categorieId"
            );
            redirect('admin/?module=portfolio_categories');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=portfolio_categories');
        }
    }else{
        setFlashData('msg','trang không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=portfolio_categories');