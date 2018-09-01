<?php
    require_once "module/admin/views/public_blocks/top_block.php";
?>
<div class="senders--block container has--border">
    <?php
        if(!empty($this->controllerParams['senders'])){
            $senders = $this->controllerParams['senders'];
        }
    ?>
    <table class="table table-hover">
        <tr>
            <th>Անուն</th>
            <th></th>
        </tr>
        <?php
            if(!empty($senders)){
                foreach ($senders as $sender){
                    $id = $sender['id'];
                    $name = $sender['name'];
                    echo "<tr>";
                        echo "<td><a href='/$this->rootDir/admin/SenderDetail' >$name</a></td>";
                        echo "<td><a href='/$this->rootDir/admin/Senders/deleteSender/id/$id'>ջնջել</a></td>";
                    echo "</tr>";
                }
            }
        ?>
        <tr>
            <form method="post" action="<?php echo "/$this->rootDir/admin/Senders/addSender"?>">
                <td><input type="text" name="sendersName" placeholder="անուն" required="required"></td>
                <td><button type="submit" >ավելացնել</button></td>
            </form>
        </tr>
    </table>
</div>