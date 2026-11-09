<?php

    include_once("config.php");

    if(isset($_POST['submit'])){

        $email = $_POST['email'];

        $password = $_POST['password'];

        $sql = "INSERT INTO products ( name, description, quantity ) VALUES( :name, :description, :quantity)";

        $sqlQuery = $conn->prepare($sql);

        $sqlQuery->bindParam(':name', $name);

        $sqlQuery->bindParam(':description', $description);

        $sqlQuery->bindParam(':quantity', $quantity);

        $sqlQuery->execute();

        echo "INSERTED";

    }

    ?>

    <br><br><br>

    <a href="dashboard.php">Go to Dashboard</a>