<?php

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



?>