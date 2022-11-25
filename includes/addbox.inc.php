<?php
require_once("db.inc.php");
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {      // Gør at følgende kode kun kører ved at trykke på send knappen

    $name = $_POST["name"];
    $section = $_POST["section"];
    $note = $_POST["note"];

    addBox($conn, $name, $section, $note);
    echo " done ";
}