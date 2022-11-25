<?php

function addItem($conn, $box_id, $name, $section, $note) 
{
    $sql = "INSERT INTO item (name, section, note) VALUES ('$name', $section, '$note')";
 
    if ($conn->query($sql) === TRUE) {
        echo "Item added successfully 1";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    if ($box_id != 0) {
        $latest_item_id = mysqli_insert_id($conn);
        $sql2 = "INSERT INTO iteminbox (item_id, box_id) VALUES ($latest_item_id, $box_id)";

        if ($conn->query($sql2) === TRUE) {
            echo "Item added successfully 2";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }
    

}

function addBox($conn, $name, $section, $note) 
{
    $sql = "INSERT INTO box (name, section, note) VALUES ('$name', $section, '$note')";
 
    if ($conn->query($sql) === TRUE) {
        echo "Box added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function editItem($conn, $id, $box_id, $name, $section, $note) 
{
    // In box
    if ($section == null) {
        echo "in box";
        $sql = "SELECT * FROM iteminbox WHERE item_id='$id'";
        $result = $conn->query($sql);
        // HVIS RELATIONEN EKSISTERE I FORVEJEN
        if ($result !== false && $result->num_rows > 0){
            $sql = "UPDATE iteminbox SET item_id='$id', box_id='$box_id' WHERE id ='$id'";
            if ($conn->query($sql) === TRUE) {
                echo "Item relation edited successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // HVIS RELATIONEN IKKE EKSISTERE I FORVEJEN
        else {
            $sql = "INSERT INTO iteminbox (item_id, box_id) VALUES ($id, $box_id)";
            if ($conn->query($sql) === TRUE) {
                echo "Item relation edited successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $sql = "SELECT section FROM box WHERE id='$box_id'";
            $result = $conn->query($sql);
            if ($result !== false && $result->num_rows > 0){
            // if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
                while ($row = $result->fetch_assoc()) {
                    $section = $row["section"];
                }
            }
        }
    } 
    // Not in box
    else {
        echo "not in box";
        deleteItemRelations($conn, $id);
    }

    $sql = "UPDATE item SET id='$id', section='$section', note='$note' WHERE id ='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Item edited successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // // In box
    // if ($section != null) {
    //     echo "in box";
    //     $sql = "UPDATE iteminbox SET item_id='$id', box_id='$box_id' WHERE id ='$id'";
    //     if ($conn->query($sql) === TRUE) {
    //         echo "Item relation edited successfully";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }
    // } 
    // // Not in box
    // else {
    //     echo "not in box";
    //     deleteItemRelations($conn, $id);
    // }
    
    
    
}

function editBox($conn, $box_id, $name, $section, $note) 
{
    $sql = "UPDATE box SET name='$name', section='$section', note='$note' WHERE id ='$box_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Box edited successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deleteBoxRelations($conn, $box_id) 
{
    $sql = "DELETE FROM iteminbox WHERE box_id = $box_id";

    if ($conn->query($sql) === TRUE) {
        echo "Box relations deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deleteBox($conn, $box_id) 
{
    $sql = "DELETE FROM box WHERE id = $box_id";

    if ($conn->query($sql) === TRUE) {
        echo "Box deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deleteItemRelations($conn, $id) 
{
    $sql = "DELETE FROM iteminbox WHERE item_id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Box relations deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deleteItem($conn, $id) 
{
    $sql = "DELETE FROM item WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function usernameExists($conn, $username) 
{
    // Laver prepared statement for at undgå SQL injection.
    $sql = "SELECT * FROM user WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn); // Starter en forbindelse til databasen.

    // Tjekker om forbindelsen fejler
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=nousernamematch");
        exit();
    }

    // Binder parameterne og eksekvere SQL strengen. 
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    // Gem resultaterne
    $resultData = mysqli_stmt_get_result($stmt);

    // Gemmer resultaterne i en array og returner resultaterne. 
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt); // Luk for det prepared statement
}

function emptyInputLogin($username, $password) 
{
    $result; // Laver variabel som skal indeholde et resultat.
    if (empty($username) || empty($password)) { // Tjekker om variablerne er tomme
        $result = true;
    }
    else {
        $result = false;
    }
    return $result; // Retunerer resultatet til der hvor funktionen blev kaldt.
}

function loginUser($conn, $username, $password) {
    $usernameExists = usernameExists($conn, $username); // Tjekker om brugernavnet eksisterer
    
    // Hvis brugernavnet ikke eksistrer
    if ($usernameExists == false) {
        header("location: ../login.php?error=wrongloginusername");
        exit();
    }
    
    $dbPassword = $usernameExists["password"]; // Gemmer brugerens password

    // Hvis passwordet ikke stemmer overens
    if (md5($password) != $dbPassword) {
        header("location: ../login.php?error=wrongloginpassword");
        exit();
    }

    // Hvis passwordet stemmer overens
    else if (md5($password) == $dbPassword) {
        session_start(); // Starter en session
        $_SESSION["username"] = $usernameExists["username"]; // Laver sessions brugernavn til det angivet
        $_SESSION["name"] = $usernameExists["name"]; // Laver sessions fornavn til brugerens fornavn
        header("location: ../index.php");
        exit();
    }
}

?>