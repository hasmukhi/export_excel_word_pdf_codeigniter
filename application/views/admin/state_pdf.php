<div class="row">   
    <div class="col-lg-12">
        <h1 style="text-align:center">State Detail</h1>
        <table border="1" width="100%" cellpadding="10">
            <thead>
                <tr>
                    <th>State Id</th>
                    <th>State Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($states as $key => $val) {

                    echo "<tr>";
                    echo "<td>" . $val['state_id'] . "</td>";
                    echo "<td>" . $val['state_name'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
