<?php if(!defined("_INCODE")) die("unauthorized access..."); ?>
<div class="debug-wrapper" style="width: 600px; padding: 20px 30px; text-align:center; margin: 0px auto;">
    <h3>VUI LÒNG KIỂM TRA VÀ XỬ LÝ CÁC LỖI SAU</h3>
    <hr>
    <p><?php echo "Code: ".$debugError['error_code']."<br>"; ?></p>
    <p><?php echo $debugError['error_message']."<br>"; ?></p>
    <p><?php echo "File: ".$debugError['error_file']."<br>"; ?></p>
    <p><?php echo "Line số :".$debugError['error_line']."<br>"; ?></p>

</div>