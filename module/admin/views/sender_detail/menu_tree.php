<div class="menu-tree">
    <?php
        $menuTreeList = $this->controllerParams['senderDetailMenuTreeList'];
        $menuTree = new \bundle\menuTreeBundle\MenuTree($menuTreeList);
        $menuTree->printMenuTree();
    ?>
</div>