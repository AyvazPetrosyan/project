<div class="top--navigation has--border">
    <?php
        $menuList = $this->controllerParams['menuList'];
        topBarMenu($menuList);
        function topBarMenu($menuList)
        {
            echo "<ul>";
            foreach ($menuList as $key=>$menu) {
                if(isset($menu['menu'])) {
                    if ($menu['menu']) {
                        echo "<li>" . $menu['name'] . "</li>";
                        topBarMenu($menu);
                    } else {
                        $href = $menu['href'];
                        echo "<a href='$href'><li>" . $menu['name'] . "</li></a>";
                    }
                }
            }
            echo "</ul>";
        }
    ?>
</div>