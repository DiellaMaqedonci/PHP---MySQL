<?php

    include_once("config.php");

    if(isset($_POST['submit'])){

        $email = $_POST['email'];

        $password = $_POST['password'];

        $sql = "INSERT INTO bootstrapexample ( email, password ) VALUES( :email, :password)";

        $sqlQuery = $conn->prepare($sql);

        $sqlQuery->bindParam(':email', $email);

        $sqlQuery->bindParam(':password', $password);

        $sqlQuery->execute();

        echo "INSERTED";

    }

    ?>

    <br><br><br>

    <a href="dashboard.php">Go to Dashboard</a>