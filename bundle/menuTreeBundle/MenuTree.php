<?php
namespace bundle\menuTreeBundle;

use engine\Bundle;

class MenuTree extends Bundle {

    private $menuList = [];

    public function __construct($menuList)
    {
        $this->menuList = $menuList;
    }

    public function printMenuTree()
    {
        $menuList = $this->menuList;
        $this->printMenu($menuList);
    }

    private function printMenu($menuList)
    {
        echo "<ul>";
            foreach ($menuList as $key=>$menu) {
                if(isset($menu['menu'])) {
                    if ($menu['menu']) {
                        echo "<li>" . $menu['name'] . "</li>";
                        $this->printMenu($menu);
                    } else {
                        $href = $menu['href'];
                        echo "<a href='$href'><li>" . $menu['name'] . "</li></a>";
                    }
                }
            }
        echo "</ul>";
    }
}