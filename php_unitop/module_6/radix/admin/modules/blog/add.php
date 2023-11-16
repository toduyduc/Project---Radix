<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thêm blog"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

// lấy userId
$userId = isLogin()['user_id'];


if(isPost()){
    // validate form
    $body = getBody();  // lấy tất cả dl trong form
    $errors = []; // khai báo mảng lưu trữ tất cả các lỗi

    // validate blog bắt buộc nhập
    if(empty(trim($body["title"]))){
        $errors["title"]["required"]="Tiêu đề blog bắt buộc phải nhập";
    }

    // validate slug bắt buộc nhập 
    if(empty(trim($body["slug"]))){
        $errors["slug"]["required"]="Đường dẫn tĩnh bắt buộc phải nhập";
    }

    //validate nội dung
    if(empty(trim($body["content"]))){
        $errors["content"]["required"]="Nội dung bắt buộc phải nhập";
    }

    //validate chuyên mục
    if(empty(trim($body["category_id"]))){
        $errors["category_id"]["required"]="Chuyên mục bắt buộc phải chọn";
    }

    //validate ảnh đại diện thumbnail
    if(empty(trim($body["thumbnail"]))){
        $errors["thumbnail"]["required"]="Ảnh đại diện bắt buộc phải chọn";
    }

    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "title"=>trim($body["title"]),
            "slug"=>trim($body["slug"]),
            "category_id"=>trim($body["category_id"]),
            "content"=>trim($body["content"]),
            "thumbnail"=>$body["thumbnail"],
            "description"=>trim($body["description"]),
            "user_id"=>$userId,
            "create_at"=> date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('blog',$dataInsert);
        
        if($insertStatus){
            setFlashData("msg","Thêm mới blog thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=blog');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=blog');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=blog&action=add'); // load lại blog nhóm người dùng
    }
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");

// câu lệnh truy vấn lấy  dữ liêu trong bảng blog_categories
$allBlog_categorie = getData("SELECT id, `name` FROM blog_categories ORDER BY `name`");
?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input type="text" class="form-control slug" name="title" value="<?php echo old('title',$old); ?>" placeholder="Tiêu đề...">
                <?php echo form_errors('title',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control render-slug" name="slug" value="<?php echo old('slug',$old); ?>" placeholder="Đường dẫn tĩnh...">
                <?php echo form_errors('slug',$errors,'<span class="errors">','</span>'); ?>
                <p class="render-link"><b>Link:</b> <span></span></p>
            </div>

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" class="form-control" placeholder="Mô tả..."><?php echo old('description',$old); ?></textarea>
                <?php echo form_errors('description',$errors,'<span class="errors">','</span>'); ?>
            </div>
           
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" ><?php echo old('content',$old); ?></textarea>
                <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Chuyên mục</label>
                <select name="category_id" class="form-control">
                    <option value="">Chọn chuyên mục</option>
                    <?php
                        if(!empty($allBlog_categorie)){
                            foreach($allBlog_categorie as $item){
                            ?>
                                <option <?php echo (old('category_id',$old)==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                            <?php
                            }
                        }
                    ?>
                    
                </select>
                <?php echo form_errors('category_id',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="thumbnail" value="<?php echo old('thumbnail',$old); ?>" placeholder="Đường dẫn ảnh...">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <?php echo form_errors('thumbnail',$errors,'<span class="errors">','</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('blog','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);