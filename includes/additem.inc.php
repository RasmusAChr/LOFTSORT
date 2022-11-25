<?php
require_once("db.inc.php");
require_once 'functions.inc.php';
if (isset($_POST["submit"])) {      // Gør at følgende kode kun kører ved at trykke på send knappen

    $box_id = $_POST["box"];
    $name = $_POST["name"];
    $note = $_POST["note"];

    
// In box
    if ($_POST["section"] != null) {
        $section = $_POST["section"];
    } 
// Not in box
    else {
        $sql = "SELECT section FROM box WHERE id = $box_id";
        $result = $conn->query($sql);
            if ($result !== false && $result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $section = $row["section"];
                }
            }
    }

    addItem($conn,$box_id, $name, $section, $note);
    echo " done ";
}