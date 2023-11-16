<?php
if(!defined("_INCODE")) die("unauthorized access...");

//check phân quyền truy cập
$checkPermission = checkCurrentPermission();
if(!$checkPermission){
    rederectPermission();
}
$checkPermissionEdit = checkCurrentPermission('edit');
$checkPermissionDelete = checkCurrentPermission('delete');
$checkPermissionStatus = checkCurrentPermission('status');

$data = [
    "pageTitle"=>"Danh sách bình luận"
];
layout('header','admin',$data);
layout('sidebar','admin',$data);
layout('breadcrumb','admin',$data);
// xử lý lọc dữ liệu
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
   
        $filter.="$operator comments.status=$statusSql"; 
    }

    // xử lý lọc theo từ khóa
    if(!empty($body['keyword'])){
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator comments.name LIKE '%$keyword%' OR comments.email LIKE '%$keyword%' OR comments.website LIKE '%$keyword%' OR comments.content LIKE '%$keyword%'";
        
    } 

    // xử lý lọc theo user
    if(!empty($body['user_id'])){
        $userId = $body['user_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator comments.user_id=$userId";
        
    }
    
}

// xử lý phân trang
$allcommentsNumber = getRows("SELECT * FROM `comments` $filter");// lấy số lượng bản ghi nhóm người dùng

//1. xác định được số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; // mỗi trang có 3 bản ghi

//2. tính số trang
$maxPage = ceil($allcommentsNumber/$perPage); //hàm ceil: làm tròn lên

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
$listcomments = getData("SELECT comments.*,blog.title, fullname,users.email as user_email FROM comments JOIN blog ON comments.blog_id=blog.id LEFT JOIN users ON comments.user_id = users.id $filter ORDER BY comments.create_at DESC LIMIT $offset,$perPage");
// echo '<pre>';
// print_r($listcomments);
// echo '</pre>';
// die();
//xủ lý query string tìm kiếm với phân trang
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=comments','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}


// lấy tất cả dữ liệu người dùng bảng users
$allUsers = getData("SELECT id, fullname,email FROM users ORDER BY fullname");
// echo '<pre>';
// print_r($allUsers);
// echo '</pre>';
$msg = getFlashData("msg");
$msg_type = getFlashData("msg_type");

?>
    <!-- Main content -->
<section class="content">
      <div class="container-fluid">

        <form action="" method="get">
            <div class="row">
                <div class="col-3">
                    <select name="user_id" class="form-control">
                        <option value="">Chọn người dùng</option>
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
                <div class="col-2">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="0" >Chọn trạng thái</option>
                            <option value="1" <?php echo (!empty($status)&&$status==1)?'selected':false; ?>>Đã duyệt</option>
                            <option value="2" <?php echo (!empty($status)&&$status==2)?'selected':false; ?>>Chưa duyệt</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <input type="search" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                </div>
                
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="comments">
        </form>
        <hr>
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Thông tin</th>
                    <th>Nội dung</th>
                    <?php if($checkPermissionStatus):?>
                    <th width="10%">Trạng thái</th>
                    <?php endif;?>
                    <th width="10%">Thời gian</th>
                    <th width="15%">Bài viết</th>
                    <?php if($checkPermissionEdit): ?>
                    <th width="10%">Sửa</th>
                    <?php endif;
                     if($checkPermissionDelete):?>
                    <th width="10%">Xóa</th>
                    <?php endif; ?>
                </tr>
            </thead>
            
            <tbody>
                <?php if(!empty($listcomments)):
                            foreach($listcomments as $key=>$item):
                                if(!empty($item['user_id'])){
                                    $item['name']=$item['fullname'];
                                    $item['email']= $item['user_email'];
                                    $commentLists[$key]= $item;
                                }
                ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td>
                        - Họ tên: <?php echo $item['name'];?><br>
                        - Email: <?php echo $item['email']; ?><br>
                        <?php echo (!empty($item['website']))?'- Website: '.$item['website'].'<br>':false; ?>
                        <?php 
                            $commentData=getComment($item['parent_id']);
                            echo (!empty($commentData['name']))?'- Trả lời: '.$commentData['name']:false;
                        ?>
                    </td>
                    <td><?php echo getLimitText($item['content'],20); ?></td>
                    <?php if($checkPermissionStatus): ?>
                    <td><?php echo ($item['status']==0)?'<button class="btn btn-danger btn-sm">Chưa duyệt</button><br><a href="'._WEB_HOST_ROOT_ADMIN.'/?module=comments&action=status&id='.$item['id'].'&status=1">Duyệt</a>':'<button class="btn btn-success btn-sm">Đã duyệt</button><br><a href="'._WEB_HOST_ROOT_ADMIN.'/?module=comments&action=status&id='.$item['id'].'&status=0">Bỏ duyệt</a>'; ?> </td>
                    <?php endif;?>
                    <td><?php echo getDateFormat($item["create_at"],'d/m/Y H:m:s'); ?></td> 
                    <td><a target="_blank" href="<?php echo getLinkModule('blog',$item['blog_id']); ?>"><?php echo  getLimitText($item['title'],20); ?></a></td>
                    <?php if($checkPermissionEdit): ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("comments","edit",['id'=>$item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <?php endif;
                    if($checkPermissionDelete):
                    ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("comments","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a></td>
                    <?php endif;?>
                </tr>
                
                <?php 
                        endforeach; else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Không có bình luận</td>
                    
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination">
                <?php
                    if($page>1){
                        $prevPage = $page-1;
                        echo '<li class="page-item"><a class="page-link" href="?module=comments'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
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
                <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=comments<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                <!-- thêm active vào class để tô màu cho ô chuyển trang -->
                <?php }?>
                <?php
                    if($page<$maxPage){
                        $lastPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="?module=comments'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);