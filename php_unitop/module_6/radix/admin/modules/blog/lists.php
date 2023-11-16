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
    "pageTitle"=>"Danh sách blog"
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
        $filter.="$operator (title LIKE '%$keyword%' OR content LIKE '%$keyword%')";
        
    }

    // xử lý lọc theo user
    if(!empty($body['user_id'])){
        $userId = $body['user_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator blog.user_id=$userId";
        
    }

    // xử lý lọc theo chuyên mục
    if(!empty($body['cate_id'])){
        $cateId = $body['cate_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator blog.category_id =$cateId";
        
    }
    
}

// xử lý phân blog
$allBlogNumber = getRows("SELECT * FROM `blog` $filter");// lấy số lượng bản ghi blog

//1. xác định được số lượng bản ghi trên 1 blog
$perPage = _PER_PAGE; // mỗi blog có 3 bản ghi

//2. tính số blog
$maxPage = ceil($allBlogNumber/$perPage); //hàm ceil: làm tròn lên

//3. xử lý sô blog dưạ vào phương thức get
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
//truy vấn lấy tất cả bản ghi dữ liệu blog, kết nối với bảng users để lấy tên người dùng gán vào trường Tên trong phần quản lý services
$listBlog = getData("SELECT `blog`.id,`title`, `blog`.create_at,fullname,`users`.id as user_id,view_count,`blog_categories`.`name` as cate_name,category_id FROM `blog` JOIN users ON `blog`.user_id=`users`.id JOIN blog_categories ON `blog`.category_id=`blog_categories`.id  $filter ORDER BY `blog`.create_at DESC LIMIT $offset,$perPage");

//xủ lý query string tìm kiếm với phân blog
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}

// lấy tất cả dữ liệu người dùng bảng users
$allUsers = getData("SELECT id, fullname,email FROM users ORDER BY fullname");

// câu lệnh truy vấn lấy  dữ liêu trong bảng blog_categories
$allBlog_categorie = getData("SELECT id, `name` FROM blog_categories ORDER BY `name`");
// echo '<pre>';
// print_r($allBlog_categorie);
// echo '</pre>';
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");

?>
    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <?php if($checkPermissionAdd): ?>
        <a href="<?php echo getLinkAdmin('blog','add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm blog</a>
        <?php endif;?>
        <hr>
        
        <form action="" method="get">
            <div class="row">
                <div class="col-3">
                    <select name="user_id" class="form-control">
                        <option value="">Chọn người đăng</option>
                        <?php
                            if(!empty($allUsers)){
                                foreach($allUsers as $item){
                                ?>
                                    <option <?php echo (!empty($userId)&&$userId==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>"><?php echo $item['fullname'].' ('.$item['email'].')'; ?></option>
                                <?php
                                }
                            }
                        ?>
                       
                    </select>
                </div>
                <div class="col-3">
                    <select name="cate_id" class="form-control">
                        <option value="">Chọn chuyên mục</option>
                        <?php
                            if(!empty($allBlog_categorie)){
                                foreach($allBlog_categorie as $item){
                                ?>
                                    <option <?php echo (!empty($cateId)&&$cateId==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php
                                }
                            }
                        ?>
                       
                    </select>
                </div>
                <div class="col-3">
                    <input type="search" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="blog">
        </form>
        <hr>
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tiêu đề</th>
                    <th>Chuyên mục</th>
                    <th width="15%">Đăng bởi</th>
                    <th width="10%">Thời gian</th>
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
                <?php if(!empty($listBlog)):
                            foreach($listBlog as $key=>$item):
                ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td>
                        <a href="<?php echo getLinkAdmin("blog","edit",['id'=>$item['id']]); ?>"> <?php echo $item["title"] ?></a> <br> 
                        <?php if($checkPermissionDuplicate): ?>
                        <a class="btn btn-danger btn-sm" style="padding: 0 5px;" href="<?php echo getLinkAdmin("blog","duplicate",['id'=>$item['id']]); ?>"> Nhân bản</a> <span class="btn btn-success btn-sm" style="padding:0 5px;"><?php echo $item['view_count'].' lượt xem'; ?></span> 
                        <?php endif; ?>
                        <a target="_blank" href="<?php echo getLinkModule('blog',$item['id']); ?>" class="btn btn-primary btn-sm" style="padding:0 5px;">Xem</a>
                    </td>
                    <td><a href="?<?php echo getLinkQueryString('cate_id',$item['category_id']); ?>"><?php echo (!empty($item['cate_name']))?$item['cate_name']:false; ?></a></td>
                    <td><a href="?<?php echo getLinkQueryString('user_id',$item['user_id']);?>"><?php echo (!empty($item['fullname']))?$item['fullname']:false; ?></a></td>
                    <td><?php echo getDateFormat($item["create_at"],'d/m/Y H:m:s'); ?></td>
                    <?php if($checkPermissionEdit): ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("blog","edit",['id'=>$item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <?php endif; 
                    if($checkPermissionDelete):
                    ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("blog","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a></td>
                    <?php endif; ?>
                </tr>
                <?php 
                        endforeach; else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Không có blog</td>
                    
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination">
                <?php
                    if($page>1){
                        $prevPage = $page-1;
                        echo '<li class="page-item"><a class="page-link" href="?module=blog'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
                    }
                ?>
                <?php 
                // bước giới hạn ô chuyển blog
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
                <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=blog<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                <!-- thêm active vào class để tô màu cho ô chuyển blog -->
                <?php }?>
                <?php
                    if($page<$maxPage){
                        $lastPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="?module=blog'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);