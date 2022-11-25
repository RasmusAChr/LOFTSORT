<?php

// Hvis brugeren er kommet ind på siden ved at trykke på en knap.
if (isset($_POST["submit"])) {

    // Gem brugernavn og password i variabler
    $postUsername = $_POST["username"];
    $postPassword = $_POST["password"];


    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handler)
    if (emptyInputLogin($postUsername, $postPassword) == true) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    // Hvis ingen fejl, så kør funktion som logger brugeren ind
    loginUser($conn, $postUsername, $postPassword);
}
else {
    header("location: ../login.php");
    exit();
}