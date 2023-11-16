<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $blog_categorieId = $body['id'];
    $blog_categorieDetail = firstRow("SELECT * FROM `blog_categories` WHERE id=$blog_categorieId");
    if(!empty($blog_categorieDetail)){
        // loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $blog_categorieDetail['create_at']=date('Y-m-d H:i:s');
        unset($blog_categorieDetail['update_at']);
        unset($blog_categorieDetail['id']);
        $duplicate = $blog_categorieDetail['duplicate'];
        $duplicate++;
        $name = $blog_categorieDetail['name'].'('.$duplicate.')';
        $blog_categorieDetail['name']=$name;
        $insertStatus = insert('blog_categories',$blog_categorieDetail); 
        if($insertStatus){
            setFlashData("msg","Nhân bản trang thành công");
            setFlashData("msg_type","success");
            update(
                'blog_categories',
                ['duplicate'=>$duplicate],
                "id=$blog_categorieId"
            );
            redirect('admin/?module=blog_categories');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=blog_categories');
        }
    }else{
        setFlashData('msg','trang không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=blog_categories');