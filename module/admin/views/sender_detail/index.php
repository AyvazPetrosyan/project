<?php
    require_once "module/admin/views/public_blocks/top_block.php";
?>
<div class="sender-detail--block container has--border">
    <p>Name: <?php echo $this->controllerParams['senderInfo']['name']; ?></p>
    <?php
        require_once "module/admin/views/sender_detail/menu_tree.php";
    ?>
</div>
