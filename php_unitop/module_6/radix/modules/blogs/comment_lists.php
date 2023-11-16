<?php
$commentLists= getData("SELECT comments.*, fullname,users.email as user_email, `groups`.name as group_name FROM comments LEFT JOIN users ON comments.user_id = users.id LEFT JOIN `groups` ON users.group_id=`groups`.id WHERE blog_id = $id AND comments.status=1 ORDER BY comments.create_at DESC");
// echo '<pre>';
// print_r($commentLists);
// echo '</pre>';
?>
<div class="blog-comments" >
    <h2 class="title"><?php echo (!empty($commentLists))?count($commentLists):false; ?> Bình luận</h2>
    <div class="comments-body">
        <?php if(!empty($commentLists)){
            foreach($commentLists as $key=>$item){
                if(!empty($item['user_id'])){
                    $item['name']=$item['fullname'];
                    $item['email']= $item['user_email'];
                    $commentLists[$key]= $item;
                }
                if($item['parent_id']==0){
                    
                ?>  
        <!-- Single Comments -->
        <div class="single-comments">
            <div class="main">
                <div class="head">
                    <img src="<?php echo getAvartar($item['email']); ?>" alt="#">
                </div>
                <div class="body">
                    <h4><?php echo $item['name']; echo (!empty($item['user_id']))?' <span class="badge badge-danger"> '.$item['group_name'].'</span>':false ;?> </h4>
                    <div class="comment-info"> 
                        <p><span><?php echo getDateFormat($item['create_at'],'d-m-Y'); ?><i class="fa fa-clock-o"></i><?php echo getDateFormat($item['create_at'],'H:i'); ?>,</span><a href="<?php echo _WEB_HOST_ROOT.'?module=blogs&action=detail&id='.$id.'&comment_id='.$item['id'].'#comment-form'; ?>"><i class="fa fa-comment-o"></i>Trả lời</a></p>
                    </div>
                    <p><?php echo $item['content']; ?></p>
                </div>
            </div>
            <?php 
            getCommentList($commentLists,$item['id'],$id);
            ?>
        </div>
        <!--/ End Single Comments -->
        <?php
                }
            }
        }else{
            echo '<div class="alert alert-success text-center">Không có bình luận. Hãy là người đầu tiên viêt bình luận</div>';
        }
        ?>
        
    </div>
</div>