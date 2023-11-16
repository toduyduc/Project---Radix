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
$checkPermissionStatus = checkCurrentPermission('status');

$data = [
    "pageTitle"=>"Danh sách đăng ký nhận tin"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
// xử lý lọc dữ liệu
$filter='';
if(isGet()){
    $body = getBody();
    // xử lý lọc theo từ khóa
    if(!empty($body['keyword'])){
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator fullname LIKE '%$keyword%' OR email LIKE '%$keyword%'";
        
    }

    // xử lý lọc theo trạng thái
    //xu ly loc status
    if(!empty($body["status"])){
        $status= $body["status"];

        if($status==2){
            $statusSql = 0;
        }else{
            $statusSql = $status; 
        }
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
   
        $filter.="$operator status=$statusSql"; 
    }
    
}

// xử lý phân trang
$allSubscribeNumber = getRows("SELECT * FROM subscribe $filter");// lấy số lượng bản ghi nhóm người dùng

//1. xác định được số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; // mỗi trang có 3 bản ghi

//2. tính số trang
$maxPage = ceil($allSubscribeNumber/$perPage); //hàm ceil: làm tròn lên

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
//truy vấn lấy tất cả bản ghi dữ liệu dịch vụ, kết nối với bảng users để lấy tên người dùng gán vào trường Tên trong phần quản lý services
$listSubscribe = getData("SELECT *  FROM subscribe $filter ORDER BY create_at DESC LIMIT $offset,$perPage");

//xủ lý query string tìm kiếm với phân trang
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=subscribe','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}

// echo '<pre>';
// print_r($allUsers);
// echo '</pre>';
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");

?>
    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <?php if($checkPermissionAdd): ?>
        <a href="<?php echo getLinkAdmin('subscribe','add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm người nhận tin</a>
        <?php endif; ?>
        <hr>
        
        <form action="" method="get">
            <div class="row">
                <div class="col-3">
                    <select name="status" class="form-control">
                        <option value="0">Chọn trạng thái</option>
                        <option <?php echo (!empty($status)&&$status==2)?'selected':false; ?> value="2">Chưa duyệt</option>
                        <option <?php echo (!empty($status)&&$status==1)?'selected':false; ?> value="1">Đẵ duyệt</option>
                    </select>
                </div>
                <div class="col-6">
                    <input type="search" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="subscribe">
        </form>
        <hr>
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Họ tên</th>
                    <th width="15%">Email</th>
                    <?php if($checkPermissionStatus): ?>
                    <th width="15%">Trạng thái</th>
                    <?php endif; ?>
                    <th width="10%">Thời gian</th>
                    <?php if($checkPermissionEdit):?>
                    <th width="10%">Sửa</th>
                    <?php endif; 
                    if($checkPermissionDelete):
                    ?>
                    <th width="10%">Xóa</th>
                    <?php endif; ?>
                </tr>
            </thead>
            
            <tbody>
                <?php if(!empty($listSubscribe)):
                            foreach($listSubscribe as $key=>$item):
                ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $item['fullname'];?></td>
                    <td><?php echo $item['email'];?></td>
                    <?php if($checkPermissionStatus): ?>
                    <td><?php echo ($item['status']==0)?'<button class="btn btn-danger btn-sm">Chưa duyệt</button><br><a href="'._WEB_HOST_ROOT_ADMIN.'/?module=subscribe&action=status&id='.$item['id'].'&status=1">Duyệt</a>':'<button class="btn btn-success btn-sm">Đã duyệt</button><br><a href="'._WEB_HOST_ROOT_ADMIN.'/?module=subscribe&action=status&id='.$item['id'].'&status=0">Bỏ duyệt</a>';?></td>
                    <?php endif; ?>
                    <td><?php echo getDateFormat($item["create_at"],'d/m/Y H:m:s'); ?></td>
                    <?php if($checkPermissionEdit): ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("subscribe","edit",['id'=>$item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <?php endif; 
                    if($checkPermissionDelete):
                    ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("subscribe","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a></td>
                    <?php endif; ?>
                </tr>
                <?php 
                        endforeach; else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Không có đăng ký nhận tin</td>
                    
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination">
                <?php
                    if($page>1){
                        $prevPage = $page-1;
                        echo '<li class="page-item"><a class="page-link" href="?module=subscribe'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
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
                <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=subscribe<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                <!-- thêm active vào class để tô màu cho ô chuyển trang -->
                <?php }?>
                <?php
                    if($page<$maxPage){
                        $lastPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="?module=subscribe'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);