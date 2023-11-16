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
    "pageTitle"=>"Quản lý dự án"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);

//lấy PortfolioId đang đăng nhập
$userId = isLogin()['user_id'];

//xử lý lọc dữ liệu
$filter='';
if(isGet()){
    $body = getBody();

    //xu ly loc người dùng
    if(!empty($body['user_id'])){
        $userId = $body['user_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator portfolios.user_id=$userId";
        
    }
    
    // xử lý lọc theo từ khóa
    if(!empty($body['keyword'])){
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator portfolios.name LIKE '%$keyword%'";
        
    }

    // xu ly loc the group
    if(!empty($body['cate_id'])){
        $cateId = $body['cate_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator portfolio_category_id  LIKE '%$cateId%'";
        
    }
}

// xử lý phân trang
$allPortfolioNumber = getRows("SELECT * FROM portfolios $filter");
//1. xác định được số bản ghi trên 1 trang
$perPage = _PER_PAGE; // mỗi trang có 3 bản ghi

//2. tính số trang
$maxPage = ceil($allPortfolioNumber/$perPage); //hàm ceil: làm tròn lên

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
$listAll  = getData("SELECT `portfolios`.id, `portfolios`.`name`,`portfolios`.create_at,`portfolio_categories`.`name` as cate_name,`portfolio_categories`.`id` as cate_id,`users`.fullname,`users`.id as user_id FROM portfolios JOIN `portfolio_categories` ON `portfolios`.portfolio_category_id  = `portfolio_categories`.id JOIN users ON `portfolios`.user_id=`users`.id $filter ORDER BY `portfolios`.create_at DESC LIMIT $offset,$perPage");
// lấy danh sách danh mục
$allportfolio_categories = getData("SELECT id,`name` FROM portfolio_categories ORDER BY `name`");

//truy vấn lấy danh sách người dùng
$allUsers = getData("SELECT * FROM users ORDER BY fullname");

// echo '<pre>';
// print_r($allUsers);
// echo '</pre>';

//xủ lý query string tìm kiếm với phân trang
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=portfolios','',$queryString);
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
        <p><a href="<?php echo getLinkAdmin('portfolios','add'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm dự án</a></p>
        <?php endif; ?>
        <form action="" method="get">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <select name="user_id" id="" class="form-control">
                            <option value="0" >Chọn người đăng</option>
                            <?php
                                if(!empty($allUsers)){
                                    foreach($allUsers as $item){
                                        ?>
                                        <option <?php echo (!empty($userId)&&$userId==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>" ><?php echo $item['fullname'].' ('.$item['email'].')'; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <select name="cate_id" id="" class="form-control">
                            <option value="" >Chọn danh mục</option>
                            <?php
                            if(!empty($allportfolio_categories)){
                                foreach($allportfolio_categories as $item){
                                    ?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo (!empty($cateId)&&$cateId==$item['id'])?'selected':false; ?>><?php echo $item['name']; ?></option>
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
            <input type="hidden" name="module" value="portfolios">
        </form>
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <table class = "table table-bordered text-center"> <!--class (table-bordered) dùng để thêm viền bảng vào-->
            <thead>
                <tr>
                    <th width = "5%">STT</th>
                    <th width = "10%">Tên</th>
                    <th width = "10%">Danh mục</th>
                    <th width = "10%">Đăng bởi</th>
                    <th width = "10%">Thời gian</th>
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
                    <td>
                        <a href="<?php echo getLinkAdmin("portfolios","edit",['id'=>$item['id']]); ?>"><?php echo $item["name"]; ?></a><br> 
                        <?php if($checkPermissionDuplicate): ?>
                        <a class="btn btn-danger btn-sm" style="padding: 0 5px;" href="<?php echo getLinkAdmin("portfolios","duplicate",['id'=>$item['id']]); ?>"> Nhân bản</a>
                        <?php endif; ?>
                        <a class="btn btn-danger btn-sm" style="padding: 0 5px; margin-left:5px" target="_blank" href="<?php echo getLinkModule('portfolios',$item['id']); ?>">Xem</a>
                    </td>
                    <td><a href="?<?php echo getLinkQueryString('cate_id',$item['cate_id']); ?>"><?php echo $item["cate_name"] ?></a></td>
                    <td><a href="?<?php echo getLinkQueryString('user_id',$item['user_id']); ?>"><?php echo $item['fullname']; ?></a></td>
                    <td><?php echo (!empty($item['create_at']))?getDateFormat($item['create_at'],'d/m/Y H:i:s'):false;?></td>
                    <?php if($checkPermissionEdit): ?>
                    <td><a href="<?php echo getLinkAdmin("portfolios","edit",['id'=>$item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-lg"></i> Sửa</a></td>
                    <?php endif;
                    if($checkPermissionDelete):
                     ?>
                    <td>
                        <a href="<?php echo getLinkAdmin("portfolios","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Are you sure')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-lg"></i> Xóa</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; else:  ?>
                    <tr>
                        <td colspan ="7">
                            <div class="alert alert-danger">không có dự án</div>
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
                        echo '<li class="page-item"><a class="page-link" href="?module=portfolios'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
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
                <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=portfolios<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                <!-- thêm active vào class để tô màu cho ô chuyển trang -->
                <?php }?>
                <?php
                    if($page<$maxPage){
                        $lastPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="?module=portfolios'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
        <hr>
    </div>
</section>
<?php
layout('footer','admin',$data);
