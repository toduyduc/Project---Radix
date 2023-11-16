<?php 
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}

$data = [
    "pageTitle"=>"Cập nhật dự án"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

//lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])){
    $portfolioId = $body['id'];
    $portfolioDetail = firstRow("SELECT * FROM `portfolios` WHERE id = $portfolioId");

    // truy vấn lấy thư viện ảnh
    $galleryDetailArr = getData("SELECT * FROM portfolio_images WHERE portfolio_id=$portfolioId");
    $galleryData  = [];
    $galleryIdArr = [];// lưu trữ id gallery trong database
    if(!empty($galleryDetailArr)){
        foreach($galleryDetailArr as $gallery){
            $galleryData[] = $gallery['image'];
            $galleryIdArr[]=$gallery['id'];
        }
        
    }
    // echo '<pre>';
    // print_r($galleryData);
    // echo '</pre>';
    if(!empty($portfolioDetail)){
        // nếu tồn tại thì gán giá trị $userDetail vào flashData
        setFlashData('portfolioDetail',$portfolioDetail);
    }else{
        redirect('admin/?module=portfolios');
    }
}else{
    redirect('admin/?module=portfolios');
}


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

    //validate ảnh dự án
    $galleryArr = [];
    if(!empty($body['gallery'])){
        $galleryArr = $body['gallery'];
    }
    
    // echo '<pre>';
    // print_r($galleryArr);
    // echo '</pre>';
    // die();
    if(!empty($galleryArr)){
        foreach($galleryArr as $key=>$item){
            if(empty(trim($item))){
                $errors["gallery"]["required"][$key]="Vui lòng chọn ảnh";
            }
        }
        
    }

    if(is_null($galleryArr)){
        $galleryArr=[];
    }
    //validate ảnh đại diện
    if(empty(trim($body["thumbnail"]))){
        $errors["thumbnail"]["required"]="Vui lòng chọn ảnh đại diện";
    }
    
    if(empty($errors)){ // không có lỗi xảy ra
        if(count($galleryArr)>count($galleryData)){
            //insert những ảnh còn thiếu và update những ảnh đã thay đổi
            if(!empty($galleryData)){
                foreach($galleryData as $key=>$item){
                    $dataImages = [
                        'image'=>$galleryArr[$key],
                        "update_at"=> date('Y-m-d H:i:s')
                    ];
                    //update thư viện ảnh
                    $condition = "id='".$galleryIdArr[$key]."'";
                    update('portfolio_images',$dataImages,$condition);
                }
            }else{
                $key=-1;
            }
            
            for($index = $key+1;$index<count($galleryArr);$index++){
                $dataImages = [
                    'image' => $galleryArr[$index],
                    'portfolio_id' => $portfolioId,
                    "update_at"=> date('Y-m-d H:i:s')
                ];
                //insert ảnh còn thiếu
                insert('portfolio_images',$dataImages);
            }
        }elseif(count($galleryArr)<count($galleryData)){
            foreach($galleryArr as $key=>$item){
                $dataImages = [
                    'image'=>$item
                ];
                
                //update thư viện ảnh
                $condition = "id='".$galleryIdArr[$key]."'";
                update('portfolio_images',$dataImages,$condition);
            }
            if(is_null($key)){
                $key=-1;
            }
            for($index = $key+1;$index<count($galleryData);$index++){
                //delete ảnh còn thừa
                $condition = "id='".$galleryIdArr[$index]."'";
                delete('portfolio_images',$condition);
                // echo '<pre>';
                // print_r($dataImages);
                // echo '</pre>';
            }
            //die();
        }else{
            foreach($galleryData as $key=>$item){
                $dataImages = [
                    'image'=>$galleryArr[$key],
                    "update_at"=> date('Y-m-d H:i:s')
                ];
                //update thư viện ảnh
                //$condition = "image='$item'";
                $condition = "id='".$galleryIdArr[$key]."'";
                update('portfolio_images',$dataImages,$condition);
            }
        }

        $dataUpdate = [
            "name"=>trim($body["name"]),
            "slug"=>trim($body["slug"]),
            "content"=>trim($body["content"]),
            "description"=>trim($body["description"]),
            "video"=>trim($body["video"]),
            "portfolio_category_id"=>trim($body["portfolio_category_id"]),
            "thumbnail"=>trim($body["thumbnail"]),
            "update_at"=> date('Y-m-d H:i:s')
        ];
        $condition = "id=$portfolioId";
        $updateStatus = update('portfolios',$dataUpdate,$condition);
        
        if($updateStatus){
            setFlashData("msg","Sửa dự án thành công");
            setFlashData("msg_type","success");
            redirect('admin/?module=portfolios');
        }else{
            setFlashData("msg","Hệ thống đang gặp sự cố, vui lòng thử lại sau !");
            setFlashData("msg_type","danger");
            redirect('admin/?module=portfolios&action=edit');
        }
    }else{
        // nếu có lỗi xảy ra
        setFlashData("msg","vui lòng kiểm tra dữ liệu nhập vào !");
        setFlashData("msg_type","danger");
        setFlashData("errors",$errors);
        setFlashData("old",$body);
        redirect('admin/?module=portfolios&action=edit&id='.$portfolioId.'');
    }

}


$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
$portfolioDetail = getFlashData("portfolioDetail");
// echo '<pre>';
// print_r($portfolioDetail);
// echo '</pre>';
if(!empty($portfolioDetail)){
    $old = $portfolioDetail;
    $old['gallery'] = $galleryData;
}

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
                        $oldGallery = old('gallery',$old);
                        if(!empty($oldGallery)){
                            if(is_array($errors)){
                                $galleryErrors = $errors['gallery'];
                            }
                            
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Cập nhật</button>
            <a class="btn btn-success" type="submit" href="<?php echo getLinkAdmin('portfolios','lists');  ?>"><i class="fas fa-chevron-left"></i> Quay lại</a>
        </form>
    </div>
</section>
<?php
layout('footer','admin',$data);
// hướng dẫn xử lý lỗi "Trying to access array offset on value of type bool in" trong php