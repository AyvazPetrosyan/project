<?php
    require_once "module/admin/views/public_blocks/top_block.php";
?>
<div class="install-form-block">
    <form action=<?php echo "/".$this->controllerParams['rootDir']."/admin/Install/install" ?> method="post">
        <ul>
<!--            <li><input required="required" type="text"   name="host"     placeholder="Host name"  value=""                /></li>-->
<!--            <li><input required="required" type="text"   name="user"     placeholder="user"       value=""                /></li>-->
<!--            <li><input                     type="text"   name="password" placeholder="password"   value=""                /></li>-->
<!--            <li><input required="required" type="text"   name="db"       placeholder="Db name"    value=""                /></li>-->
            <li><input                     type="submit" name="submit"                            value="Create Tables"   /></li>
        </ul>
    </form>
</div>