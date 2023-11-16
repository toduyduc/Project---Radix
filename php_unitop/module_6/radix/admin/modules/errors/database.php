<?php if(!defined("_INCODE")) die("unauthorized access..."); ?>
<div style="width: 600px; padding: 20px 30px; text-align:center; margin: 0px auto;">
    <h3>Lỗi liên quan đến csdl</h3>
    <hr>
    <p><?php echo $exception->getMessage()."<br>"; ?></p>
    <p><?php echo $exception->getFile()."<br>"; ?></p>
    <p><?php echo "Line số :".$exception->getLine()."<br>"; ?></p>

</div>