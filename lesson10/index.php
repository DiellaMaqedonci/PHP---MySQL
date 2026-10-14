<?php

$host = 'localhost';
$user = 'root';
$db = 'db';
$pass = '';


try {

    $conn = new PDO("mysql:host=$host;dbname=$db" , $user, $pass);

    //CREATED NEW TABLE
    //$sql = "CREATE TABLE CRUD(id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            //username VARCHAR(255) NOT NULL,
            //password VARCHAR(255) NOT NULL)";

    //$conn->exec($sql);

    //echo "Table is Created";



    //CREATED NEW COLUMN
    // $username = "testname";
    // $password = password_hash("12345678", PASSWORD_DEFAULT);

    // $sql = "INSERT INTO test(username, password)  VALUES('$username', '$password')";

    // $conn->exec($sql);

    //echo "ISERTED";



    //ALTER/CHANGE TABLE
    //$sql = "ALTER TABLE test ADD email VARCHAR(255)";



    //DELETE CHANGED TABLE
    //$sql = "ALTER TABLE test DROP email";



    //DELETE TABLE
    $sql = "DROP TABLE crud";

    $conn->exec($sql);

    echo "altered";

} catch (Exeption $e) {
    echo "not connected".$e-getMessage();
}


?>