<div class="top--navigation has--border">
    <?php
        $menuList = $this->controllerParams['topBarMenuTree'];
        $menuTree = new \bundle\menuTree\MenuTree($menuList);
        $menuTree->printMenuTree();
    ?>
</div>