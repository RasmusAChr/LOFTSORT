<?php 
require_once("db.inc.php");
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $section = $_POST["section"];
    $box_id = $_POST["box"];
    $note = $_POST["note"];

    deleteItemRelations($conn, $id);

    // // In box
    // if ($_POST["section"] != null) {
    //     $section = $_POST["section"];
    // } 
    // // Not in box
    // else {
    //     $sql = "SELECT section FROM box WHERE id = $box_id";
    //     $result = $conn->query($sql);
    //         if ($result !== false && $result->num_rows > 0){
    //             while ($row = $result->fetch_assoc()) {
    //                 $section = $row["section"];
    //             }
    //         }
    // }

    editItem($conn, $id, $box_id, $name, $section, $note);
    echo " done ";
}
?>