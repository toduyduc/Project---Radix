<?php 
if(!defined("_INCODE")) die("unauthorized access...");

$data = [
    "pageTitle"=>"Cập nhật dữ liệu nhóm người dùng"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

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

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
    // validate họ tên bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tên nhóm bắt buộc phải nhập";
    }else{
        if(strlen(trim($body["name"]))<4){
            $errors["name"]["min"]="Họ tên phải >= 4 ký tự";
        }

    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
            "name"=>$body["name"],
            "update_at" => date('Y-m-d H:i:s')
        ];
        $condition = "id=$groupId";
        $updateStatus = update('groups',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa nhóm người dùng thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=groups&action=lists');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=groups&action=lists');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=groups&action=edit&id='.$groupId.''); // load lại trang nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$groupDetail = getFlashData("groupDetail");
if(!empty($groupDetail)){
    $old = $groupDetail;
}
?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên nhóm</label>
                <input type="text" class="form-control" name="name" value="<?php echo old('name',$old); ?>" placeholder="Tên nhóm...">
                <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật nhóm người dùng</button>
            
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);