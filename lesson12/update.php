<?php

    include_once('config.php');

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "UPDATE user SET name=:name, description=:description, quantity=:quantity WHERE id=:id ";


        $prep = $conn->prepare($sql);

        $prep->bindParam('id', $id);
        $prep->bindParam('name', $name);
        $prep->bindParam('description', $description);
        $prep->bindParam('quantity', $quantity);

        $prep->execute();

        header("Location: dashboard.php");

        
    }

?>