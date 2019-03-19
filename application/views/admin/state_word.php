<table border="1" width="100%">
    <caption>State Detail</caption>
    <thead>
        <tr>
            <th>State ID</th>
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
