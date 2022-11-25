<?php 
require_once("db.inc.php");
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {

    $box_id = $_POST["box_id"];
    $name = $_POST["name"];
    $section = $_POST["section"];
    $note = $_POST["note"];

    editBox($conn, $box_id, $name, $section, $note);
    echo " done ";
}
?>