<div class="menu-tree">
    <?php
        $menuTreeList = $this->controllerParams['senderDetailMenuTreeList'];
        $menuTree = new \bundle\menuTree\MenuTree($menuTreeList);
        $menuTree->printMenuTree();
    ?>
</div>