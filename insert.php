<?php


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        include 'init.php';

        // Get Data

        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $userPhone = $_POST['phone'];
        $userPlace = $_POST['place'];

        // sanitaization --later

        $stmt = $con->prepare('INSERT INTO users(`Name`,Email,Phone,Place) VALUES (?,?,?,?)');

        $stmt->execute(array($userName,$userEmail,$userPhone,$userPlace));

        

    }