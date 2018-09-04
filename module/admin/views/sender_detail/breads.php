<?php
    require_once "module/admin/views/public_blocks/top_block.php";
?>
<div class="sender-detail--block container has--border">
    <?php
        require_once "module/admin/views/sender_detail/menu_tree.php";
    ?>
    <?php
        $tableInfo = [];
        if(isset($this->controllerParams['breadsTableInfo'])) {
            $tableInfo = $this->controllerParams['breadsTableInfo'];
            $htmlTable = new \bundle\htmlTableBundle\HtmlTable('table table-hover', $tableInfo);
            $htmlTable->tableForm = $this->controllerParams['breadsTableForm'];
            $htmlTable->printTable();
        } else {
            echo "breads table is empty";
        }
    ?>
</div>