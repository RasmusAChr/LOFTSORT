<?php
    include_once 'header.php';
?>

    <div id="title">
        <h1>Items</h1>
    </div>
    <div id="upper" class="col-md-12" style="background-color:yellow;">
    
    <div>
        <form action="includes/searchitems.inc.php" method="post">
            <input id="name" type="text" name="name" placeholder="name...">
            <input id="section" type="text" name="section" placeholder="section...">
            <input id="box" type="text" name="box" placeholder="box...">
            <input type='submit' name='submit' value='Udsøg'>
        </form>
    </div>

    <a href="boxes.php"><button>Boxes</button></a>
    <a href="additem.php"><button>Add item</button></a>
    </div>
    <div id="main" class="col-md-12" style="background-color:red;">

        <table  style='width:100%'>
                <tr>
                    <th class='col-md-1'>Id</th>
                    <th class='col-md-3'>Name</th>
                    <th class='col-md-1'>Section</th>
                    <th class='col-md-1'>Box</th>
                    <th class='col-md-4'>Note</th>
                    <th class='col-md-1'></th>
                </tr>
        <?php
            include 'includes/db.inc.php';

            if (isset($_GET['name'], $_GET['section'], $_GET['box'] )) { // Hvis der er skrevet noget i søgefeltet henter den brugernavnet i variablen $afsender_brugernavn.
                $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id WHERE (item.name LIKE '%".$_GET['name']."%' OR item.section = '".$_GET['section']."' OR box.name LIKE '%".$_GET['box']."%');";

            }
            else { // hvis der ikke er søgt
                $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id ORDER BY item.name ASC";
            }

            // $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id ORDER BY item.name ASC";
            $result = $conn->query($sql);
            if ($result !== false && $result->num_rows > 0){
            // if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
                while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                    $editurl = "edititem.php?id=".$row["id"]."";
                    $deleteurl = "includes/deleteitem.inc.php?id=".$row["id"]."";
                    echo "
                    <tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["section"]."</td>
                        <td>".$row["boxname"]."</td>
                        <td>".$row["note"]."</td>
                        <td><a href='$editurl'><button>E</button></a> <a href='$deleteurl'><button>S</button></a></td>
                    </tr>";
                }
            }
            else { // Hvis resultatet ($result) så er 0 eller under.
                echo "<p>Ingen match.</p>";
            }
        ?>
        </table>
    </div>

<?php
    include_once 'footer.php';
?>  