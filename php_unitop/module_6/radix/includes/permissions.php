<?php

// kiểm tra permission tương ứng với module, action
function checkPermission($permissionData,$module,$role='lists'){
    if(!empty($permissionData[$module])){
        $roleArr = $permissionData[$module];
        if(!empty($roleArr) && in_array($role,$roleArr)){
            return true;
        } 
    }
    return false;
}

// lấy group_id hiện tại của users đăng nhập
function getGroupId(){
    // lấy userId
    $userId = isLogin()['user_id'];
    $groupRow = firstRow("SELECT group_id FROM users WHERE id=$userId");
    if(!empty($groupRow)){
        $groupId = $groupRow['group_id'];
        return $groupId;
    }
    return false;

}

// lấy mảng permission trong bảng groups
function getPermissionData($groupId){
    $groupRow = firstRow("SELECT permission FROM `groups` WHERE id=$groupId");
    if(!empty($groupRow )){
        $permissionArr = json_decode($groupRow['permission'],true);
        return $permissionArr;
    }
    return false;
}

// check phân quyền
function checkCurrentPermission($role='',$module=''){
    $groupId = getGroupId();
    $permissionData = getPermissionData($groupId);
    $body = getBody('get');
    
    $currentModule=null;
    if(!empty($body['module'])){
        $currentModule = $body['module'];
    }
    $action = 'lists';
    if(!empty($body['action'])){
        $action = $body['action'];
    }elseif(!empty($body['view'])){
        $action = $body['view'];
    }
     
    // echo '<pre>';
    // print_r($action);
    // echo '</pre>';
    if(!empty($role)){
        $action = $role;
    }
    if(!empty($module)){
        $currentModule = $module;
    }
    if(!empty($action)){
        $checkPermission = checkPermission($permissionData,$currentModule,$action);
        return $checkPermission;
    }
    return false;
}

function rederectPermission($url='/admin'){
    setFlashData("msg","Bạn không được quyền truy cập vào trang này !");
    setFlashData("msg_type","danger");
    redirect($url);
}