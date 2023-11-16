<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}
$checkPermissionAdd = checkCurrentPermission('add');
$checkPermissionEdit = checkCurrentPermission('edit');
$checkPermissionDelete = checkCurrentPermission('delete');
$checkPermissionDuplicate = checkCurrentPermission('duplicate');

$data = [
    "pageTitle"=>"Danh sách phòng ban"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

// xử lý lọc dữ liệu
$view = 'add'; //mặc định ở trang add
$id = 0; // mặc định id


$body = getBody('get');
// xử lý lọc theo từ khóa
$filter = '';
if(!empty($body['keyword'])){
    $keyword = trim($body['keyword']);
    $filter="WHERE name LIKE '%$keyword%'";
}
if(!empty($body['view'])){
    $view=$body['view'];
}
if(!empty($body['id'])){
    $id = $body['id'];
}


// xử lý phân trang
// lấy số lượng bản ghi danh mục  blog
$allContactTypeNumber = getRows("SELECT * FROM `contact_type` $filter");
//1. xác định được số bản ghi trên 1 trang
$perPage = _PER_PAGE; // mỗi trang có 3 bản ghi

//2. tính số trang
$maxPage = ceil($allContactTypeNumber/$perPage); //hàm ceil: làm tròn lên

//3. xử lý sô trang dưạ vào phương thức get
if(!empty(getBody()["page"])){
    $page = getBody()["page"];
    if($page<1 || $page>$maxPage){
        $page = 1;
    }
}else{
    $page = 1;
}

//4. tính toán offset trong limit dựa vào biến $page
/**
 * $page = 1 => offset = 0 =($page-1)*$perpage
 * $page =2 => offset = 3=($page-1)*$perpage
 * $page =3 => offset = 6=($page-1)*$perpage
 * 
 */
$offset = ($page-1)*$perPage;
//truy vấn lấy tất cả bản ghi dữ liệu nhóm người dùng
$listContactType = getData("SELECT *,(SELECT COUNT(`contacts`.id) FROM contacts WHERE `contacts`.type_id =`contact_type`.id) AS contact_count FROM `contact_type` $filter ORDER BY create_at DESC LIMIT $offset,$perPage");

//xủ lý query string tìm kiếm với phân trang
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=contact_type','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
?>
    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <?php
            getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <div class="row">
            <div class="col-6">
                <?php 
                    if(!empty($view) && !empty($id)){
                        if($checkPermissionEdit){
                            require_once 'edit.php';
                        }  
                    }else{
                        if($checkPermissionAdd){
                            require 'add.php';
                        }
                        
                    }

                ?>
            </div>
            <div class="col-6">
                <h4>Danh sách phòng ban</h4>
                <form action="" method="get">
                    <div class="row">
                        <div class="col-9">
                            <input type="search" class="form-control" name="keyword" placeholder="Nhập tên phòng ban..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="module" value="contact_type">
                </form>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th>Tên phòng ban</th>
                            <th width="17%">Sl contact</th>
                            <th width="20%">Thời gian</th>
                            <?php if($checkPermissionEdit): ?>
                            <th width="10%">Sửa</th>
                            <?php endif;
                            if($checkPermissionDelete):
                            ?>
                            <th width="10%">Xóa</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if(!empty($listContactType)):
                                foreach($listContactType as $key=>$item):
                        ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td>
                                <a href="<?php echo getLinkAdmin("contact_type","",['id'=>$item['id'],'view'=>'edit']); ?>"><?php echo $item['name']; ?></a>
                                <?php if($checkPermissionDuplicate): ?> 
                                <a class="btn btn-danger btn-sm" style="padding: 0 5px;" href="<?php echo getLinkAdmin("contact_type","duplicate",['id'=>$item['id']]); ?>"> Nhân bản</a>
                                <?php endif;?>
                            </td>
                            <td><?php echo $item['contact_count']; ?></td>
                            <td><?php echo (!empty($item['name']))?getDateFormat($item["create_at"],'d/m/Y H:m:s'):'' ; ?></td>
                            <?php if($checkPermissionEdit): ?>
                            <td><a href="<?php echo getLinkAdmin("contact_type","",['id'=>$item['id'],'view'=>'edit']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                            <?php endif;
                            if($checkPermissionDelete):
                            ?>
                            <td><a href="<?php echo getLinkAdmin("contact_type","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                            <?php endif;?>
                        </tr>
                        <?php
                            endforeach; else:
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Không có Danh sách phòng ban</td>
                        </tr>
                            <?php endif;?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                    <ul class="pagination">
                        <?php
                            if($page>1){
                                $prevPage = $page-1;
                                echo '<li class="page-item"><a class="page-link" href="?module=contact_type'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
                            }
                        ?>
                        <?php 
                        // bước giới hạn ô chuyển trang
                            $begin = $page - 2;
                            if($begin < 1){
                                $begin = 1;
                            }
                            $end = $page + 2;
                            if($end>$maxPage){
                                $end = $maxPage;
                            }
                            for($index=$begin; $index<=$end;$index++){ 
                        ?>
                        <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=contact_type<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                        <!-- thêm active vào class để tô màu cho ô chuyển trang -->
                        <?php }?>
                        <?php
                            if($page<$maxPage){
                                $lastPage = $page+1;
                                echo '<li class="page-item"><a class="page-link" href="?module=contact_type'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                            }
                        ?>
                        
                    </ul>
                </nav>
            </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);