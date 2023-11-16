<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Thêm dự án"
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

    // validate dự án bắt buộc nhập
    if(empty(trim($body["name"]))){
        $errors["name"]["required"]="Tiêu đề dự án bắt buộc phải nhập";
    }

    // validate slug bắt buộc nhập 
    if(empty(trim($body["slug"]))){
        $errors["slug"]["required"]="Đường dẫn tĩnh bắt buộc phải nhập";
    }

    //validate nội dung
    if(empty(trim($body["content"]))){
        $errors["content"]["required"]="Nội dung bắt buộc phải nhập";
    }

    //validate link video
    if(empty(trim($body["video"]))){
        $errors["video"]["required"]="Video bắt buộc phải nhập đường dẫn";
    }

    //validate link video
    if(empty(trim($body["video"]))){
        $errors["video"]["required"]="Video bắt buộc phải nhập đường dẫn";
    }

    //validate danh mục
    if(empty(trim($body["portfolio_category_id"]))){
        $errors["portfolio_category_id"]["required"]="Danh mục bắt buộc phải chọn";
    }

    //validate ảnh đại diện
    if(empty(trim($body["thumbnail"]))){
        $errors["thumbnail"]["required"]="Ảnh đại diện bắt buộc phải chọn";
    }

    //validate ảnh dự án
    $galleryArr = $body['gallery'];
    if(!empty($galleryArr)){
        foreach($galleryArr as $key=>$item){
            if(empty(trim($item))){
                $errors["gallery"]["required"][$key]="Vui lòng chọn ảnh";
            }
        }
    }
    
    if(empty($errors)){ // không có lỗi xảy ra
        $dataInsert = [
            "name"=>trim($body["name"]),
            "slug"=>trim($body["slug"]),
            "content"=>trim($body["content"]),
            "user_id"=>$userId,
            "description"=>trim($body["description"]),
            "video"=>trim($body["video"]),
            "portfolio_category_id"=>trim($body["portfolio_category_id"]),
            "thumbnail"=>trim($body["thumbnail"]),
            "create_at"=> date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('portfolios',$dataInsert);
        
        if($insertStatus){

            // xử lý thêm ảnh
            $currentId = insertId(); //gọi hàm lấy id vừa insert
            if(!empty($galleryArr)){
                foreach($galleryArr as $key=>$item){
                    $dataImages=[
                        'portfolio_id'=>$currentId,
                        'image'=>trim($item),
                        'create_at'=>date('Y-m-d H:i:s')
                    ];
                    insert('portfolio_images',$dataImages);
                }
            }
            setFlashData("msg","Thêm mới dự án thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=portfolios');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=portfolios&action=add');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=portfolios&action=add');
    }

}

$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
// truy vấn lấy danh sách danh mục
$allCate = getData("SELECT * FROM portfolio_categories ORDER BY `name`");

?>
<section class="content">
    <div class="container-fluid">
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
                
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên dự án</label>
                <input type="text" class="form-control slug" name="name" value="<?php echo old('name',$old); ?>" placeholder="Tên dự án...">
                <?php echo form_errors('name',$errors,'<span class="errors">','</span>'); ?>
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
            </div>
           
            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor" ><?php echo old('content',$old); ?></textarea>
                <?php echo form_errors('content',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Link video</label>
                <input type="url" name="video" class="form-control" placeholder="Link video..." value="<?php echo old('video',$old); ?>"></input>
                <?php echo form_errors('video',$errors,'<span class="errors">','</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Danh mục</label>
                <select name="portfolio_category_id"  class="form-control">
                    <option value="" >Chọn danh mục</option>
                    <?php
                        if(!empty($allCate)){
                            foreach($allCate as $item){
                                ?>
                                <option <?php echo (!empty(old('portfolio_category_id',$old))&&old('portfolio_category_id',$old)==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>" ><?php echo $item['name']; ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
                <?php echo form_errors('portfolio_category_id',$errors,'<span class="errors">','</span>'); ?>
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
            <div class="form-group">
                <label for="">Ảnh dự án</label>
                <div class="gallery-images">
                    <?php
                        $oldGallery=[];
                        $oldGallery = old('gallery',$old);
                        if(!empty($oldGallery)){
                            $galleryErrors = $errors['gallery'];
                            foreach($oldGallery as $key=>$item){
                                ?>
                                    <div class="gallery-item">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="row ckfinder-group">
                                                    <div class="col-10">
                                                        <input type="text" class="form-control image-render" name="gallery[]" value="<?php echo (!empty($item))?$item:false; ?>" placeholder="Đường dẫn ảnh...">
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                                    </div>
                                                </div>
                                                <?php
                                                    echo (!empty($galleryErrors['required'][$key]))?'<span class="errors">'.$galleryErrors['required'][$key].'</span>':false;
                                                ?>
                                            </div>
                                            <div class="col-1">
                                                <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>

                                    </div> <!-- end gallery-item -->

                                <?php
                            }
                        }
                    ?>
                </div>
                <p style="margin-top: 10px">
                    <a href="#" class="btn btn-warning btn-sm add-gallery">Thêm ảnh</a>
                </p>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('portfolios','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);