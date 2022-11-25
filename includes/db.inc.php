<?php
 $hostName = "localhost";
 $userName = "root";
 $password = "";
 $dbName = "loftsort";
 $conn= new mysqli($hostName,$userName,$password,$dbName);
 if(!$conn){
    echo "not connected";
 }

  ?>
