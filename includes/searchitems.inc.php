<?php

if (isset($_POST["submit"])) {

    $name;
    $section;
    $box;

    if (empty($_POST["name"])){
        $name = 0;
    }
    else{
        $name = $_POST["name"];
    }

    if (empty($_POST["section"])){
        $section = 0;
    }
    else{
        $section = $_POST["section"];;
    }

    if (empty($_POST["box"])){
        $box = 0;
    }
    else{
        $box = $_POST["box"];
    }

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    // Hvis det angivet brugernavn ikke er tomt.
    if (empty($name) == false || empty($section) == false || empty($box) == false) {

        header("location: ../index.php?name=".$name."&section=".$section."&box=".$box."");
        exit();

    }
    else {
        header("location: ../index.php");
        exit();
    }

}

else {
    header("location: ../index.php");
    exit();

}