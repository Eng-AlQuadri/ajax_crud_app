<?php

// Retrive User Data

if (isset($_POST['updateId'])) {

    include 'connect.php';  // not init.php because we don't want to return header

    $id = $_POST['updateId'];

    $stmt = $con->prepare('SELECT * FROM users WHERE UserID = ?');
    
    $stmt->execute(array($id));

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    extract($result);

    $data = array(
        'UserID' => $UserID,
        'Name' => $Name,
        'Email' => $Email,
        'Phone' => $Phone,
        'Place' => $Place
    );

    echo json_encode($data);
}


// Edit User Data

if(isset($_POST['hiddendata'])) {

    include 'connect.php';

    // Get The Data
    $uid = $_POST['hiddendata'];
    $name = $_POST['editName'];
    $email = $_POST['editEmail'];
    $phone = $_POST['editPhone'];
    $place = $_POST['editPlace'];

    // Updata The Database

    $stmt = $con->prepare("UPDATE users SET `Name` = ?, Email = ?, Phone = ?, Place = ? WHERE UserID = $uid");

    $stmt->execute(array($name,$email,$phone,$place));
}