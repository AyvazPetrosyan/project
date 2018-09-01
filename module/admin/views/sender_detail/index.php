<?php
    require_once "module/admin/views/public_blocks/top_block.php";
?>
<div class="sender-detail--block container has--border">
    <?php
    $tableInfo = [
        ['breads', 'price'],
        ['value-1', 'value-2'],
        ['value-1', 'value-2']
    ];
        $htmlTable = new \bundle\htmlTableBundle\HtmlTable('table table-hover',$tableInfo);
        $htmlTable->isDynamic = true;
        $htmlTable->printTable();
    ?>
</div>