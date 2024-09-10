<?php

    if(isset($_POST['displaySend'])) {

        include 'connect.php';

        // Get Users From Database

        $stmt = $con->prepare('SELECT * FROM users');

        $stmt->execute();

        $rows = $stmt->fetchAll();

        // Fill Table With Data

        $table = '
            <table>
                <thead>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Place</th>
                    <th>Operations</th>
                </thead>
        ';

        $number = 1;

        foreach($rows as $row) {

            $id = $row['UserID'];
            $name = $row['Name'];
            $email = $row['Email'];
            $phone = $row['Phone'];
            $place = $row['Place'];

            $table.= '
                <tr>
                    <td>' . $number . '</td>
                    <td>' . $name . '</td>
                    <td>' . $email . '</td>
                    <td>' . $phone . '</td>
                    <td>' . $place . '</td>
                    <td class="options">
                        <button class="edit" data-id="' . $id . '">Edit</button>
                        <button class="delete" data-id="' . $id . '">Delete</button>
                    </td>
                </tr>
            ';
            $number++;
        }

        $table .= '<table/>';


        echo $table;

        
    }

?>
