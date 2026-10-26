<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson11</title>

    <style>

        body{
            background-color: lightblue;
        }

        h1{
            font size: 30px;
            text-align: center;
            text-decoration: underline;
            text-decoration-color: pink;
            color: purple;
        }

        table, td, th{
            border: 1px solid pink;
            border-collapse: collapse;
            color: purple;
        }

        td, th{
            padding: 10px 20px;
        }

        a{
            color: purple;
        }

    </style>

</head>

<body>

    <?php

        include_once('config.php');
        $sql = 'SELECT * FROM user';
        $getUsers = $conn->prepare($sql);
        $getUsers->execute();
        $users = $getUsers->fetchAll();

    ?>

    <h1>Fetching Data</h1><br><br>

    <table>

        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>E-mail</th>
        </thead>

        <tbody>

        <?php
            foreach($users as $user){
        ?>

            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= "<a href='delete.php?id=$user[id]'> Delete </a> | <a href= 'edit.php?id=$user[id]'> Update </a> "?></td>
            </tr>

            <?php } ?>
        </tbody>

    </table><br>

    <a href="index1.php">Add users</a>
    
</body>
</html>