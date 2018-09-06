<div class="top--navigation has--border">
    <?php
        $menuList = $this->controllerParams['topBarMenuTree'];
        $menuTree = new \bundle\menuTreeBundle\MenuTree($menuList);
        $menuTree->printMenuTree();
    ?>
</div>