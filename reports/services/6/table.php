<!DOCTYPE html>
</lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Таблица с выбором</title>
</head>
<body >

<?php require "../../../parts/header.php"?>
<?php
require_once "../../../Script/database_connection.php";
if (isset($_REQUEST['focus'])) {
    $focus = $_REQUEST['focus'];
    $query= sprintf("SELECT * FROM telescops WHERE Focus = \" ".$focus."\"");
    $result = $link->query($query);
} else {
    $query= sprintf("SELECT * FROM telescops");
    $result = $link->query($query);
}

$queryForFilter = sprintf("SELECT DISTINCT Focus FROM telescops ORDER BY Focus ASC");
$result2 = $link->query($queryForFilter);

?>
<h1 class="" style="text-align: center; visibility: visible; ">Телескопы</h1>
<div class="content s12">
    <div class="row">
        <div class="col s4 offset-l4">
            <div class="card grey lighten-3" style="padding-bottom: 20px">
                <h5 class="center" style ="padding: 20px;">Фильтр</h5>
                <br>
                <form method="get">
                    <p><select class="select-dropdown" style="display: block" name="focus" >
                            <option disabled selected>Выберите фокусное расстояние</option>
                            <?php
                            while ($item = $result2->fetch_assoc()) {
                                if ($item["Focus"] == $focus) {
                                    echo '<option value="'.$item['Focus'].'" selected>'.$item['Focus'].'</option>';

                                } else {
                                    echo '<option value="'.$item['Focus'].'">'.$item['Focus'].'</option>';

                                }
                            }
                            ?>
                        </select></p>
                    <div class="center" >
                        <input type="submit" value="Отправить" class="btn center">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card grey lighten-3 ">
                <div class="card-content color-cls">
                    <table class="responsive-table centered qal-tbl-font" id="sortable">
                        <thead>
                        <tr>
                            <th onclick="sortTable(0)">Название</th>
                            <th onclick="sortTable(1)">Фокусное расстояние</th>
                            <th onclick="sortTable(2)">Диаметр, мм</th>
                            <th onclick="sortTable(3)">Вес, кг</th>
                            <th onclick="sortTable(4)">Цена, руб</th>
                        </tr>
                        </thead>
                        <tbody id="mainTable">
                        <?php

                        while ($item = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>".$item["Name"]."</td>
                            <td>".$item["Focus"]."</td>
                            <td>".$item["Diameter"]."</td>
                            <td>".$item["Weight"]."</td>
                            <td>".$item["Price"]."</td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("sortable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (!isNaN(x.innerHTML) && !isNaN(y.innerHTML)) {
                        if ( Number(x.innerHTML) > Number(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (!isNaN(x.innerHTML) && !isNaN(y.innerHTML)) {
                        if (Number(x.innerHTML) < Number(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
<style>
    #sortable thead {
        cursor: pointer;
        background: #c9dff0;
    }
</style>
</body>
<?php require "../../../parts/footer.php"?>
</html>
