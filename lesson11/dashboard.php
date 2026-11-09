<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>

<style>
        body{
            background-color: lavender;
        }


        table, td, th{
            border: 1px solid purple;
            border-collapse: collapse;
            color: purple;
            margin-left: 550px;
            margin-top: 50px;
        }


        td, th{
            padding: 10px 20px;
            font-size: 30px;
        }
</style>

</head>
<body>

    <?php

        include_once('config.php');
        $sql = 'SELECT * FROM bootstrapexample';
        $getUsers = $conn->prepare($sql);
        $getUsers->execute();
        $users = $getUsers->fetchAll();

    ?>

    <table>

        <thead>
            <th>ID</th>
            <th>E-mail</th>
            <th>Password</th>
        </thead>

        <tbody>

        <?php
            foreach($users as $user){
        ?>

            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['password'] ?></td>
            </tr>

            <?php } ?>
        </tbody>

    </table><br>

    
</body>
</html>