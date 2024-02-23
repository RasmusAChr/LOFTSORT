<?php
include_once 'header.php';
?>

<div id="upper" class="container">
    <div class="row" style="margin:0;padding:0;">
        <div class="col-md-9" style="padding:0;">
            <h1 id="title">Items</h1>

            <form id="searchItemForm" action="includes/searchitems.inc.php" method="post">
                <input id="name" type="text" name="name" placeholder="name...">
                <input id="section" type="number" name="section" placeholder="section...">
                <input id="box" type="text" name="box" placeholder="box...">
                <input type='submit' id="submit" name='submit' value='Udsøg'>
            </form>

        </div>
        <div id="upperButtons" class="col-md-3">
            <div class="row">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<a id='btnMenu' href='includes/logout.inc.php'><button><img src='icons/logout.svg'></button></a>";
                }
                ?>
                <a id="btnMenu"></a>
                <a id="btnMenu" href="boxes.php"><button><img src="icons/box.svg"></button></a>
                <a id="btnMenu" href="additem.php"><button><img src="icons/addItem.svg"></button></a>
            </div>

        </div>
    </div>




</div>
<div class="main" class="col-md-12">

    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <table class="sortable" style='width:100%'>
        <tr>
            <th style="-webkit-user-select: none;  -moz-user-select: none; -ms-user-select: none; user-select: none;"
                class='col-md-3'>Name</th>
            <th style="-webkit-user-select: none;  -moz-user-select: none; -ms-user-select: none; user-select: none;"
                class='col-md-1'>Section</th>
            <th style="-webkit-user-select: none;  -moz-user-select: none; -ms-user-select: none; user-select: none;"
                class='col-md-1'>Box</th>
            <th style="-webkit-user-select: none;  -moz-user-select: none; -ms-user-select: none; user-select: none;"
                class='col-md-4'>Note</th>
            <th style="-webkit-user-select: none;  -moz-user-select: none; -ms-user-select: none; user-select: none;"
                class='col-md-1'></th>
        </tr>
        <?php
        include 'includes/db.inc.php';

        if (isset($_GET['name'], $_GET['section'], $_GET['box'])) { // Hvis der er skrevet noget i søgefeltet henter den brugernavnet i variablen $afsender_brugernavn.
            $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id WHERE (item.name LIKE '%" . $_GET['name'] . "%' OR item.section = '" . $_GET['section'] . "' OR box.name LIKE '%" . $_GET['box'] . "%');";

        } else { // hvis der ikke er søgt
            $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id ORDER BY item.name ASC";
        }

        // $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id ORDER BY item.name ASC";
        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            // if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
            while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                $editurl = "edititem.php?id=" . $row["id"] . "";
                $deleteurl = "includes/deleteitem.inc.php?id=" . $row["id"] . "";
                echo "
                    <tr>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["section"] . "</td>
                        <td>" . $row["boxname"] . "</td>
                        <td>" . $row["note"] . "</td>
                        <td><div class='row' id='deleteeditrow'><a href='$editurl'><button><img src='icons/edit.svg'></button></a> <a href='$deleteurl'><button><img src='icons/delete.svg'></button></a></div></td>
                    </tr>";
            }
        } else { // Hvis resultatet ($result) så er 0 eller under.
            echo "<p>Ingen match.</p>";
        }
        ?>
    </table>
</div>

<?php
include_once 'footer.php';
?>