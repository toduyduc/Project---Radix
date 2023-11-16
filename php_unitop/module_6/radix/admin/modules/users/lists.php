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

$data = [
    "pageTitle"=>"Quản lý người dùng"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
//lấy userId đang đăng nhập
$userId = isLogin()['user_id'];

//xử lý lọc dữ liệu
$filter='';
if(isGet()){
    $body = getBody();

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
    
    // xử lý lọc theo từ khóa
    if(!empty($body['keyword'])){
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator fullname LIKE '%$keyword%'";
        
    }

    // xu ly loc the group
    if(!empty($body['group_id'])){
        $groupId = $body['group_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator group_id LIKE '%$groupId%'";
        
    }
}

// xử lý phân trang
$allUserNumber = getRows("SELECT * FROM users $filter");
//1. xác định được số bản ghi trên 1 trang
$perPage = _PER_PAGE; // mỗi trang có 3 bản ghi

//2. tính số trang
$maxPage = ceil($allUserNumber/$perPage); //hàm ceil: làm tròn lên

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
//truy vấn lấy tất cả bản ghi
$listAll  = getData("SELECT `users`.id, fullname,email,`status`,`users`.create_at,`groups`.`name` as group_name FROM users JOIN `groups` ON `users`.group_id = `groups`.id $filter ORDER BY `users`.create_at DESC LIMIT $offset,$perPage");
// lấy danh sách nhóm
$allGroups = getData("SELECT id,`name` FROM groups ORDER BY `name`");
// echo '<pre>';
// print_r($allGroups);
// echo '</pre>';

//xủ lý query string tìm kiếm với phân trang
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=users','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}

$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");
$errors = getFlashData("errors");
$old = getFlashData("old");
?>
<section class="content">
    <div class="container-fluid">
        <?php if($checkPermissionAdd): ?>
        <p><a href="<?php echo getLinkAdmin('users','add'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm người dùng</a></p>
        <?php endif;?>
        <form action="" method="get">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="0" >Chọn trạng thái</option>
                            <option value="1" <?php echo (!empty($status)&&$status==1)?'selected':false; ?>>Kích hoạt</option>
                            <option value="2" <?php echo (!empty($status)&&$status==2)?'selected':false; ?>>Chưa kích hoạt</option>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <select name="group_id" id="" class="form-control">
                            <option value="" >Chọn nhóm</option>
                            <?php
                            if(!empty($allGroups)){
                                foreach($allGroups as $item){
                                    ?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo (!empty($groupId)&&$groupId==$item['id'])?'selected':false; ?>><?php echo $item['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-4">
                    <input type="search" class="form-control" name="keyword" value="<?php echo (!empty($keyword))?$keyword:false; ?>" placeholder="Từ khóa tìm kiếm...">
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="users">
        </form>
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <table class = "table table-bordered text-center"> <!--class (table-bordered) dùng để thêm viền bảng vào-->
            <thead>
                <tr>
                    <th width = "5%">STT</th>
                    <th width = "10%">Họ Tên</th>
                    <th width = "5%">Email</th>
                    <th width = "10%">Nhóm</th>
                    <th width = "10%">Thời gian</th>
                    <th width = "10%">Trạng Thái</th>
                    <?php if($checkPermissionEdit): ?>
                    <th width = "5%">Sửa</th>
                    <?php endif;
                    if($checkPermissionDelete):
                     ?>
                    <th width = "5%">Xóa</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($listAll)):
                        $count = 0; // hien thi so tt
                        foreach($listAll as $item):
                            $count++;
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><a href="<?php echo ($checkPermissionEdit)?getLinkAdmin("users","edit",['id'=>$item['id']]):'#'; ?>"><?php echo $item["fullname"]; ?></a></td>
                    <td><?php echo $item["email"];?></td>
                    <td><?php echo $item["group_name"] ?></td>
                    <td><?php echo (!empty($item['create_at']))?getDateFormat($item['create_at'],'d/m/Y H:i:s'):false;?></td>
                    <td><?php echo ($item["status"]==1)?'<button type="button" class="btn btn-success btn-sm">Đã kích hoạt</button>':'<button type="button" class="btn btn-danger btn-sm">Chưa kích hoạt</button>';?></td>
                    <?php if($checkPermissionEdit): ?>
                    <td><a href="<?php echo getLinkAdmin("users","edit",['id'=>$item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-lg"></i> Sửa</a></td>
                    <?php endif;
                    if($checkPermissionDelete):
                     ?>
                    <td>
                        <?php if($item['id']!=$userId): //kiểm tra nếu id tài khoản đang đăng nhập trùng với id người dùng trong trang list thì ẩn nút xóa đi, không cho phép xóa tài khoản đang đăng nhập ?>  
                        <a href="<?php echo getLinkAdmin("users","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Are you sure')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-lg"></i> Xóa</a>
                        <?php endif; ?>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach; else:  ?>
                    <tr>
                        <td colspan ="7">
                            <div class="alert alert-danger">không có người dùng</div>
                        </td>
                    </tr>
                <?php endif;  ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination">
                <?php
                    if($page>1){
                        $prevPage = $page-1;
                        echo '<li class="page-item"><a class="page-link" href="?module=users'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
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
                <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=users<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                <!-- thêm active vào class để tô màu cho ô chuyển trang -->
                <?php }?>
                <?php
                    if($page<$maxPage){
                        $lastPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="?module=users'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
        <hr>
    </div>
</section>
<?php
layout('footer','admin',$data);
