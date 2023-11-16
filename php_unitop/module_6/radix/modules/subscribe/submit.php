<?php
if(!defined("_INCODE")) die("unauthorized access...");
if(isPost()){
    $body = getBody(); 
    // echo '<pre>';
    // print_r($_SERVER);
    // echo '</pre>';
    $errors = [];
    // validate họ tên bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["fullname"]))){
        $errors["fullname"]["required"]="Họ tên không được để trống";
    }else{
        if(strlen(trim($body["fullname"]))<5){
            $errors["fullname"]["min"]="Họ tên phải >= 5 ký tự";
        }
    }

    // validate email : bắt buộc phải nhập,định dạng email, email duy nhất
    if(empty(trim($body["email"]))){
        $errors["email"]["required"]="Email bắt buộc phải nhập";

    }else{
        if(!isEmail(trim($body["email"]))){
            $errors["email"]["isEmail"]="Định dạng email không hợp lệ";
        }
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "fullname"=>trim($body['fullname']),
            "email"=>trim($body['email']),
            "status"=>0,
            "create_at"=>date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('subscribe',$dataInsert);
        if($insertStatus){
            setFlashData("msg","Đăng ký thành công");
            setFlashData("msg_type","success");
        }else{
            setFlashData("msg","Lỗi hệ thống vui lòng đăng ký lại sau !");
            setFlashData("msg_type","danger");
        }
    }else{
        setFlashData("msg","vui lòng kiểm tra nội dung nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
    }
    $urlBack = $_SERVER['HTTP_REFERER'].'#newsletter';
    redirect($urlBack,true); // back lại trạng trước
}