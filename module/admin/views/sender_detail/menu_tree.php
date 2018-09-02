<div class="menu-tree">
    <?php
        $menuTreeList = $this->controllerParams['senderDetailMenuTree'];
        $menuTree = new \bundle\menuTree\MenuTree($menuTreeList);
        $menuTree->printMenuTree();
    ?>
</div>