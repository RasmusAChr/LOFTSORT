<?php
include_once 'header.php';
?>
<div id="title">
    <h1>Boxes</h1>
</div>
<div id="upper" class="col-md-12" style="background-color:yellow;">
    <p>*Søgeområde*</p>
    <a href="index.php"><button>Back</button></a>
    <a href="addbox.php"><button>Add box</button></a>
</div>
<div class="main" class="col-md-12" style="background-color:red;">

    <table style='width:100%'>
        <tr>
            <th class='col-md-1'>Id</th>
            <th class='col-md-3'>Name</th>
            <th class='col-md-1'>Section</th>
            <th class='col-md-5'>Note</th>
            <th class='col-md-1'></th>

        </tr>
        <?php
        include 'includes/db.inc.php';
        $sql = "SELECT * FROM box";
        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            // if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
            while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                $editurl = "editbox.php?box_id=" . $row["id"] . "";
                $deleteurl = "includes/deletebox.inc.php?box_id=" . $row["id"] . "";
                echo "
                    <tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["section"] . "</td>
                        <td>" . $row["note"] . "</td>
                        <td><a href='$editurl'><button>E</button></a> <a href='$deleteurl'><button>S</button></a></td>
                    </tr>";
            }
        } else { // Hvis resultatet ($result) så er 0 eller under.
            echo "<p>Du har ingen beskeder.</p>";
        }
        ?>
    </table>
</div>
<?php
include_once 'footer.php';
?>