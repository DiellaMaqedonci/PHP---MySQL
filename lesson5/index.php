<?php

$singers = array(
    array("Ariana Grande", "33 y/o", "American"),
    array("Adéla", "22 y/o", "Slovakian"),
    array("Dua Lipa", "31 y/o", "Kosovarian")

);


echo $singers[0][0] . "<br>" . "Age: " . $singers[0][1] . "<br>" . "Ethnicity: " . $singers[0][2] . "<br>" . "<br>";
echo $singers[1][0] . "<br>" . "Age: " . $singers[1][1] . "<br>" . "Ethnicity: " . $singers[1][2] . "<br>" . "<br>";
echo $singers[2][0] . "<br>" . "Age: " . $singers[2][1] . "<br>" . "Ethnicity: " . $singers[2][2] . "<br>" . "<br>";


for($row = 0; $row < 3; $row++) {
    echo "<p><b> Row Number $row </b></p>";
    echo "<ul>";
for($col = 0; $col < 3; $col++) {
    echo "<li>" . $singers[$row][$col] . "</li>";
}
    echo "</ul>";
}

echo "<br>";
echo "<br>";

for($i = 0; $i < 5; $i++){
    for($j = 0; $j<=$i; $j++){
        echo "*";
    }
    echo "<br>";
}

?>