<?php

    require_once("db.inc.php");
    require_once 'functions.inc.php';

    
    if (isset($_GET["box_id"])) {
        // Delete all records from relationship table
        $box_id = $_GET["box_id"];
        deleteBoxRelations($conn, $box_id);
        
        // Delete record from box table
        deleteBox($conn, $box_id);
    }


    
?>