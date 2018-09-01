<?php
    require_once "module/admin/views/public_blocks/top_block.php";
?>
<div class="bread--block container has--border">
    <?php
        if(!empty($this->controllerParams['breads'])){
            $breads = $this->controllerParams['breads'];
        }
    ?>
    <table class="table table-hover">
        <tr>
            <th>Անուն</th>
            <th></th>
        </tr>
        <?php
            if(!empty($breads)){
                foreach ($breads as $bread){
                    $id = $bread['id'];
                    $name = $bread['name'];
                    echo "<tr>";
                    echo "<td><a href='/$this->rootDir/admin/BreadDetail' >$name</a></td>";
                    echo "<td><a href='/$this->rootDir/admin/Bread/deleteBread/id/$id'>ջնջել</a></td>";
                    echo "</tr>";
                }
            }
        ?>
        <tr>
            <form method="post" action="<?php echo "/$this->rootDir/admin/Bread/addBread"?>">
                <td><input type="text" name="breadName" placeholder="անուն" required="required"></td>
                <td><button type="submit" >ավելացնել</button></td>
            </form>
        </tr>
    </table>
</div>