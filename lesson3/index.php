<?php

//conditionals
    $num = 4;

    if($num > 0){
        echo "$num is greater than 0.";
    }
    echo "<br><br>";



    $age = 15;

    if(($age > 12) && ($age < 20)){
        echo "You are a teen.";
    }
    echo "<br><br>";


    $age2 = 19;

    if($age2 < 18){
        echo "You are a baby...";
    }else{
        echo "Legally Adult.";
    }
    echo "<br><br>";



    $number = 26;

    if($number < 0){
        echo "The number $number is a negative number";
    }elseif($number == 18){
        echo "The number $number is equal to 18";
    }else{
        echo "The number $number is a positive number";
    }
    echo "<br><br>";



    $nr1 = 1;
    $nr2 = 10;

    if($nr1 == $nr2){
        echo "$nr1 is equal to $nr2 ";
    }else{
        echo "$nr1 is not equal to $nr2";
    }
    echo "<br><br>";



//switch
    $season = 2;

    switch ($season) {
        case 1:
            echo "We're in SPRING";
            break;

        case 2:
            echo "We're in SUMMER";
            break;

        case 3:
            echo "We're in AUTUMN";
            break;

        case 4:
            echo "We're in WINTER";
            break;
        
        default:
            ECHO "We're inn...... IDK";
            break;
    }
    echo "<br><br>";
    echo "<br><br>";


//ora tjt
//loops

//while loop
    $h = 10;
    
    while ($h <= 15) {
        echo "The number is $h";
        $h++;
        echo "<br><br><br>";
    }



//do while
    $z = 3;

    do{
        echo "The number is $z";
        $z++;
    }while($z >= 5);
    echo "<br><br><br>";



//for loop
    for($le = 82; $le <= 100; $le++){
        echo "The number is $le";
        echo "<br>";
    }
    echo "<br><br>";



//for each - only arrays
    $brands = ["Bershka", "Stradivarius", "PULL&BEAR", "Brandy Melville", "Edikted."];

    foreach ($brands as $value) {
        echo "I shop at $value";
        echo "<br><br>";
    }
    echo "<br><br>";


    $age = array("John" => 18, "Michael" => 20, "Joe" => 13);

    foreach($age as $key => $value){
        echo "$key = $value  <br>";
    }
    




?>