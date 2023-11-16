<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$body = getBody();
if(!empty($body)){
    $commentId = $body['id'];
    $commentDetailRows = getRows("SELECT id FROM `comments` WHERE id=$commentId");
    if($commentDetailRows>0){
        $commentData = getData("SELECT * FROM comments");

        $commentIdArr = getCommentReply($commentData,$commentId);
        $commentIdArr[]=$commentId;
        $commentIdStr = implode(',',$commentIdArr);
       
        $condition = "id IN($commentIdStr)";
        // echo '<pre>';
        // print_r($commentIdArr);
        // echo '</pre>';
        
        // thực hiện xóa
        $deletecomment = delete('comments',$condition);
        if($deletecomment){
            setFlashData('msg','Xóa bình luận thành công');
            setFlashData('msg_type','success');
        }else{
            setFlashData('msg','lỗi hệ thống vui lòng thử lại sau');
            setFlashData('msg_type','danger');
        }
    }else{
        setFlashData('msg','Bình luận không tồn tại trên hệ thống');
        setFlashData('msg_type','danger');
    }
}else{
    setFlashData('msg','liên kết không tồn tại');
    setFlashData('msg_type','danger');
}
redirect('admin/?module=comments');