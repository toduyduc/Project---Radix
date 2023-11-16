<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])){
    $groupId = $body['id'];
    //kiểm tra userId có tồn tại trong database hay không
    //nếu tồn tại => lấy ra thông tin 
    // nếu không tồn tại => chuyển hướng về trang list
    $groupDetail = firstRow("SELECT * FROM `groups` WHERE id = $groupId");
    if(!empty($groupDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('groupDetail',$groupDetail);
    }else{
        redirect('admin/?module=groups');
    }
}else{
    redirect('admin/?module=groups');
}

$data = [
    "pageTitle"=>"Phân quyền: ".$groupDetail['name']
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);



if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    // echo '<pre>';
    // print_r($body['permissions']);
    // echo '</pre>';
    $errors = [];

    if(empty($errors)){
        $permissionJson='';
        if(!empty($body['permissions'])){
            $permissionJson = json_encode($body['permissions']);
        }
        
        $dataUpdate = [
            "permission"=>trim($permissionJson),
            "update_at"=>date('Y-m-d H:i:s')
        ];
        $updateStatus = update('groups',$dataUpdate,"id=$groupId");
        if($updateStatus){
            setFlashData("msg","Sửa phân quyền người dùng thành công");
            setFlashData("msg_type","success");
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        
    }
    redirect('admin/?module=groups&action=permission&id='.$groupId); // load lại trang phan quyen
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$groupDetail = getFlashData("groupDetail");
if(!empty($groupDetail)){
    $old = $groupDetail;
}

$moduleList = getData("SELECT * FROM modules");

if(!empty($old['permission'])){
    $permissionJson = $old['permission'];
    $permissionArr = json_decode($old['permission'],true);
//     echo '<pre>';
// print_r($permissionArr);    
// echo '</pre>';
}

?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <table class="table table-bordered permission-lists">
                <thead>
                    <tr>
                        <th width="25%">Module</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($moduleList)):
                            foreach($moduleList as $item): 
                                $actions= $item["actions"];
                                $actionArr = json_decode($actions,true);
                                
                            ?>
                            
                    <tr>
                        <td>
                            <strong><?php echo $item['title']; ?></strong>
                        </td>
                        <td>
                            <div class="row">
                                <?php if(!empty($actionArr)):
                                    foreach($actionArr as $roleKey=>$roleItem): ?>
                                <div class="col-3">
                                    <input type="checkbox" name="<?php echo 'permissions['.$item['name'].'][]'; ?>" value="<?php echo $roleKey;?>" id="<?php echo $item['name'].'_'.$roleKey;?>" <?php echo (!empty($permissionArr[$item['name']]) && in_array($roleKey,$permissionArr[$item['name']]))?'checked':false; ?> >
                                    <label for="<?php echo $item['name'].'_'.$roleKey;?>"><?php echo $roleItem; ?></label>
                                </div>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td>Không có dữ liệu !</td> 
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="<?php echo getLinkAdmin("groups","lists") ;?>" type="submit" class="btn btn-success">Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);