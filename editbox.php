<?php
    include_once 'header.php';
?>
    <h1>Edit box</h1>

    <form action="includes/editbox.inc.php" method="post">

    <?php 
        include "includes/db.inc.php";

        if (isset($_GET["box_id"])) {
            $box_id = $_GET["box_id"];

            $sql = "SELECT * from box WHERE id = $box_id";

        }
        else {
            header("boxes.php");
            exit();
        }
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <input id='box_id' type='text' name='box_id' value='".$_GET["box_id"]."' readonly>
                <input id='namefield' type='text' name='name' placeholder='Name' value='".$row['name']."'>
                <input id='section' type='text' name='section' placeholder='Section' value='".$row['section']."'>
                <input type='text' name='note' placeholder='Note' value='".$row['note']."'>
                ";
            }
        }
        else { // Hvis resultatet ($result) så er 0 eller under er brugeren ved en fejl kommet ind, og skal dirigeres tilbage.
            header("boxes.php");
            exit();
        }
    ?>

    
        <!-- <input id="namefield" type="text" name="name" placeholder="Name">
        <input id="section" type="text" name="section" placeholder="Section">
        <input type="text" name="note" placeholder="Note">
        <input type="submit" name="submit" value="Gem"> -->

        <input type='submit' name='submit' value='Gem'>
    </form>
    <a href="boxes.php"><button>back</button></a>

    <?php
    include_once 'footer.php';
?>