<?php

$students = array(
    array("Elena", "16 y/o", "100", "60"),
    array("Angelina", "14 y/o", "100", "98"),
    array("Victoria", "15 y/o", "100", "46")

);


echo $students[0][0] . "<br>" . "<br>" . "Age: " . $students[0][1] . "<br>" . "Number of Activities: " . $students[0][2] . "<br>". "Completed Activities: " . $students[0][3] . "<br>" . "<br>" . "<br>" . "<br>";
echo $students[1][0] . "<br>" . "<br>" ."Age: " . $students[1][1] . "<br>" . "Number of Activities: " . $students[1][2] . "<br>". "Completed Activities: " . $students[1][3] . "<br>" . "<br>" . "<br>" . "<br>";
echo $students[2][0] . "<br>" . "<br>" ."Age: " . $students[2][1] . "<br>" . "Number of Activities: " . $students[2][2] . "<br>". "Completed Activities: " . $students[2][3] . "<br>" . "<br>" . "<br>" . "<br>";




$elenas_compAct = 60;

if($elenas_compAct < 21){
    echo "Elena's number of Completed Activities is BAD.";
}else if($elenas_compAct < 41){
    echo "Elena's number of Completed Activities is GOOD.";
}else if($elenas_compAct < 61){
    echo "Elena's number of Completed Activities is GREAT.";
}else{
    echo "Elena's number of Completed Activities is EXELLENT.";
}
echo "<br>";
echo "<br>";



$angelinas_compAct = 98;

if($angelinas_compAct < 21){
    echo "Angelina's number of Completed Activities is BAD.";
}else if($angelinas_compAct < 41){
    echo "Angelina's number of Completed Activities is GOOD.";
}else if($angelinas_compAct < 61){
    echo "Angelina's number of Completed Activities is GREAT.";
}else{
    echo "Angelina's number of Completed Activities is EXELLENT.";
}
echo "<br>";
echo "<br>";


$victorias_compAct = 46;

if($victorias_compAct < 21){
    echo "Victoria's number of Completed Activities is BAD.";
}else if($victorias_compAct < 41){
    echo "Victoria's number of Completed Activities is GOOD.";
}else if($victorias_compAct < 61){
    echo "Victoria's number of Completed Activities is GREAT.";
}else{
    echo "Victoria's number of Completed Activities is EXELLENT.";
}
echo "<br>";
echo "<br>";

?>