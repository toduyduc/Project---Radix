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
var_dump($checkPermissionStatus);

$data = [
    "pageTitle"=>"Danh sách liên hệ"
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
        $filter.="$operator (message LIKE '%$keyword%' OR fullname LIKE '%$keyword%' OR email LIKE '%$keyword%')";
        
    }

    // xử lý lọc theo phòng ban
    if(!empty($body['type_id'])){
        $typeId = $body['type_id'];
        
        if(!empty($filter) && strpos($filter,'WHERE')>=0){ // strpos($filter,'WHERE')>=0 : nếu như trong $filter có chứa WHERE thì nó trả về giá trị đúng
            $operator = ' AND';
        }else{
            $operator = 'WHERE';
        }
        $filter.="$operator contacts.type_id =$typeId";
        
    }
    
}

// xử lý phân contact
$allContactNumber = getRows("SELECT * FROM `contacts` $filter");// lấy số lượng bản ghi nhóm người dùng

//1. xác định được số lượng bản ghi trên 1 blog
$perPage = _PER_PAGE; // mỗi blog có 3 bản ghi

//2. tính số blog
$maxPage = ceil($allContactNumber/$perPage); //hàm ceil: làm tròn lên

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
//truy vấn lấy tất cả bản ghi dữ liệu liên hệ, kết nối với bảng contact_type
$listContact = getData("SELECT `contacts`.id,`message`, `contacts`.create_at,fullname,email,`status`,note,`contact_type`.`name` as type_name, contacts.type_id FROM contacts JOIN contact_type ON `contacts`.type_id =`contact_type`.id $filter ORDER BY `contacts`.create_at DESC LIMIT $offset,$perPage");

// echo '<pre>';
// print_r($listContact);
// echo '</pre>';
//xủ lý query string tìm kiếm với liên hệ
$queryString = null;
if(!empty($_SERVER['QUERY_STRING'])){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=contacts','',$queryString);
    $queryString = str_replace('&page='.$page,'',$queryString);
    $queryString = trim($queryString,'&');
    $queryString ='&'.$queryString;
}


// câu lệnh truy vấn lấy  dữ liêu trong bảng phòng ban
$allContact_type= getData("SELECT id, `name` FROM contact_type ORDER BY `name`");
// echo '<pre>';
// print_r($allBlog_categorie);
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
                    <select name="type_id" class="form-control">
                        <option value="">Chọn phòng ban</option>
                        <?php
                            if(!empty($allContact_type)){
                                foreach($allContact_type as $item){
                                ?>
                                    <option <?php echo (!empty($typeId)&&$typeId==$item['id'])?'selected':false;?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php
                                }
                            }
                        ?>
                       
                    </select>
                </div>
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
                    <input type="search" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="contacts">
        </form>
        <hr>
        <?php
                getMsg($msg,$msg_type);   // gọi hàm getMsg()
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th  width="15%">Thông tin</th>
                    <th  width="20%">Nội dung liên hệ</th>
                    <?php if($checkPermissionStatus): ?>
                    <th width="10%">Trạng thái</th>
                    <?php endif;?>
                    <th  width="20%">Ghi chú</th>
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
                <?php if(!empty($listContact)):
                            foreach($listContact as $key=>$item):
                ?>
                
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td>
                        Họ tên: 
                        <?php echo $item['fullname'].'<br>';?>
                        Email:
                        <?php echo $item['email'];?>
                        Phòng ban: 
                        <?php echo $item['type_name'];?>
                    </td>
                    <td><?php echo $item['message'];?></td>
                    <?php if($checkPermissionStatus): ?>
                    <td><?php echo ($item['status']==0)?'<button class="btn btn-danger btn-sm">Chưa xử lý</button><br><a href="'._WEB_HOST_ROOT_ADMIN.'/?module=contacts&action=status&id='.$item['id'].'&status=1">Xử lý</a>':'<button class="btn btn-success btn-sm">Đã xử lý</button><br><a href="'._WEB_HOST_ROOT_ADMIN.'/?module=contacts&action=status&id='.$item['id'].'&status=0">Bỏ xử lý</a>'; ?> </td>
                    <?php endif;?>
                    <td><?php echo $item['note'];?></td>
                    <td><?php echo getDateFormat($item["create_at"],'d/m/Y H:m:s'); ?></td>
                    <?php if($checkPermissionEdit): ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("contacts","edit",['id'=>$item['id']]); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <?php endif;
                    if($checkPermissionDelete):
                     ?>
                    <td class="text-center"><a href="<?php echo getLinkAdmin("contacts","delete",['id'=>$item['id']]); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a></td>
                    <?php endif;?>
                </tr>
                <?php 
                        endforeach; else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Không có liên hệ</td>
                    
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-end">
            <ul class="pagination">
                <?php
                    if($page>1){
                        $prevPage = $page-1;
                        echo '<li class="page-item"><a class="page-link" href="?module=contacts'.$queryString.'&page='.$prevPage.'">Trước</a></li>';
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
                <li class="page-item <?php echo ($index==$page)?'active':false; ?>"><a class="page-link" href="?module=contacts<?php echo $queryString; ?>&page=<?php echo $index;?>"><?php echo $index; ?></a></li>
                <!-- thêm active vào class để tô màu cho ô chuyển blog -->
                <?php }?>
                <?php
                    if($page<$maxPage){
                        $lastPage = $page+1;
                        echo '<li class="page-item"><a class="page-link" href="?module=contacts'.$queryString.'&page='.$lastPage.'">Sau</a></li>';
                    }
                ?>
                
            </ul>
        </nav>
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->

<?php
layout('footer','admin',$data);