<?php

    if(isset($_POST['deleteUserID'])) {

        include 'connect.php';

        $id = $_POST['deleteUserID'];

        $stmt = $con->prepare('DELETE FROM users WHERE UserID = ?');

        $stmt->execute(array($id));

    }
?>