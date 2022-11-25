<?php
    require_once("db.inc.php");
    require_once 'functions.inc.php';
    
    if (isset($_GET["id"])) {
        // Delete all records from relationship table
        $id = $_GET["id"];
        deleteItemRelations($conn, $id);
        
        // Delete record from item table
        deleteItem($conn, $id);
    }
?>