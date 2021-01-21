<thead>
    <tr>
        <th class="col-1 border-left border-right"></th>
        <th class="col-1 border-right">S.ID</th>
        <th class="col-1 border-right">PID</th>
        <th class="col-1 border-right">Date</th>
        <th class="col-1 border-right">Name</th>
        <th class="col-1 border-right">Qty</th>
        <th class="col-1 border-right">Price</th>
        <th class="col-1 border-right">Category</th>
        <th class="col-1 border-right">Sub Category</th>
        <?php 
            if (!empty($_SESSION['admin_log'])) {
                if ($_SESSION['admin_log'] == '1') {
                    echo "<th class='col-1 border-right'></th>";
                }
            }
        ?>
        
    </tr>
</thead>