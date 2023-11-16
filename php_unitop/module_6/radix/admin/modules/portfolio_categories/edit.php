<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

//lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])){
    $portfolio_categorieId = $body['id'];
    //kiểm tra userId có tồn tại trong database hay không
    //nếu tồn tại => lấy ra thông tin 
    // nếu không tồn tại => chuyển hướng về trang list
    $portfolio_categorieDetail = firstRow("SELECT * FROM `portfolio_categories` WHERE id = $portfolio_categorieId");
    if(!empty($portfolio_categorieDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('portfolio_categorieDetail',$portfolio_categorieDetail);
    }else{
        redirect('admin/?module=portfolio_categories');
    }
}else{
    redirect('admin/?module=portfolio_categories');
}

if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi
    // validate tên danh mục bắt buộc nhập, và phải >=5 ký tự
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tên danh mục bắt buộc phải nhập";
    }else{
        if(strlen(trim($body["name"]))<4){
            $errors["name"]["min"]="Tên danh mục phải >= 4 ký tự";
        }

    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataUpdate = [
            "name"=>$body["name"],
            "update_at" => date('Y-m-d H:i:s')
        ];
        $condition = "id=$portfolio_categorieId";
        $updateStatus = update('portfolio_categories',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa danh mục thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=portfolio_categories');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=portfolio_categories');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=portfolio_categories&action=lists&id='.$portfolio_categorieId.'&view=edit'); // load lại trang danh mục
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$portfolio_categorieDetail = getFlashData("portfolio_categorieDetail");
if(!empty($portfolio_categorieDetail)){
    $old = $portfolio_categorieDetail;
}
?>

<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Tên danh mục..." value="<?php echo old('name',$old); ?>">
        <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
    </div>
    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>